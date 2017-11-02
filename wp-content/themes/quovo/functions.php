<?php
/**
 * quovo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package quovo
 */

if ( ! function_exists( 'quovo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function quovo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on quovo, use a find and replace
		 * to change 'quovo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'quovo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'quovo' ),
      'menu-2' => esc_html__('Topbar', 'quovo' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'quovo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'quovo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quovo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'quovo_content_width', 640 );
}
add_action( 'after_setup_theme', 'quovo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function quovo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'quovo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'quovo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'quovo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function quovo_scripts() {
	wp_enqueue_style( 'quovo-style', get_stylesheet_uri() );

	wp_enqueue_script( 'quovo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
  
  wp_enqueue_script( 'quovo-uikit', get_template_directory_uri() . '/js/uikit.min.js', array('jquery'), false, true );
  
  wp_enqueue_script( 'quovo-uikit-icons', get_template_directory_uri() . '/js/uikit-icons.min.js', array('jquery', 'quovo-uikit'), false, false);

	wp_enqueue_script( 'quovo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'quovo_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

function add_search_bar_menu($items, $args){
  
  if( $args->theme_location === "menu-2" ):
  $search_field = '<li class="searchbar"><div class="uk-inline"><form action="'.site_url().'" method="get" role="search"><span class="uk-form-icon" uk-icon="icon: search"></span><input class="uk-input" type="text" name="s" placeholder="Search Documentation" /></form></div></li>';
  $items = $search_field . $items; 
  endif;
  return $items;
}

add_filter('wp_nav_menu_items', 'add_search_bar_menu', 10, 2);

//shortcode - cards
function column_grid($atts, $content=null){
  $a = shortcode_atts(array(
    "columns" => 1
  ),$atts);
 // $content_output = do_shortcode($content);
  return '<div class="uk-child-width-expand@s" uk-grid>'.do_shortcode($content).'</div>';
}
function doc_card($atts){
  $a = shortcode_atts(array(
    "icon" => "",
    "title" => "",
    "content" => "",
  ), $atts);
  
  return '<div><div class="doc_card uk-card-default uk-card-hover uk-card-body">
  <i uk-icon="icon: '.$atts["icon"].'"></i>
  <h2 class="uk-card-title">'.$atts["title"].'</h2>
  <p>'.$atts["content"].'</p>
  </div></div>';
}
function code_block_display($atts, $content = null){
  return '<div class="code"><pre><code>'.$content.'</code></pre></div>';
}
function clear_row(){
  return '<div class="clearrow"></div>';
}
remove_filter('the_content','wpautop');
add_shortcode('rcode', 'code_block_display');
add_shortcode('grid', 'column_grid');
add_shortcode('doc_card', "doc_card");
add_shortcode("clearrow", "clear_row");