<?php
/**
 * @package Brand New Day
 */
?>
</div> <!-- end div.wrapper -->
<div class="footer-wrapper">
	<div class="sun"></div>
	<div class="trees"></div>
	<div class="stars"></div>
	<div class="footer-grass"></div>
	<div class="footer-sidebar-wrapper">
		<div class="footer-sidebar-list-wrapper">
		<?php get_sidebar('footer1');
		      get_sidebar('footer2');
		      get_sidebar('footer3');
		      get_sidebar('footer4'); ?>
		</div>
	</div>
	<div class="footer-colophon">
		<a href="http://www.carolinemoore.net" target="_blank"><?php _e( 'Brand New Day Theme by Caroline Moore', 'brand-new-day' ) ?></a> | 
		<?php _e ( 'Copyright' , 'brand-new-day' ) ?> <?php echo date('Y'); ?> <?php bloginfo('name'); ?> | 
		<?php _e ( 'Powered by' , 'brand-new-day' ) ?> <a href="http://www.wordpress.org" target="_blank"><?php _e ( 'WordPress' , 'brand-new-day' ) ?></a>
	</div>
</div>
<?php wp_footer(); ?>

</body>
</html>

		
