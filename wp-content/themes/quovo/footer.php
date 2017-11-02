<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quovo
 */

?>
</div>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'quovo' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'quovo' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'quovo' ), 'quovo', '<a href="https://www.cleancoded.com"> James Brezenger</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
  jQuery(document).ready(function(){
	UIkit.nav("#primary-menu", {
  	"targets" : ".menu-item-has-children",
     "multiple":true
  });
});
  jQuery(document).ready(function(){
  	jQuery("#top-nav > li.menu-item-has-children").hover(function(){
  		jQuery(this).children(".sub-menu").css("display", "block");
  	}, function(){jQuery(this).children(".sub-menu").css("display", "none");});
  });
</script>

</body>
</html>