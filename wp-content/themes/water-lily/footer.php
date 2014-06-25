<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package water lily
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'water_lily_credits' ); ?>
			<p><a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Powered by %s', 'water-lily' ), 'WordPress' ); ?></a></p>
			
			<p><?php printf( __( 'Theme by %1$s', 'water-lily' ), '<a href="http://bluelimemedia.com/" rel="designer">Bluelime Media</a>' ); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>