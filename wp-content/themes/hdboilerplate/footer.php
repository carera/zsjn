<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the primary wrapper div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package HDboilerplate
 */
 
 $options = get_option('hdb_options');
 
?>
        
	<!-- highlights -->
	<div class="highlight_med"></div>
  
	<div id="content" class="full-width-row">
		<div id="innercontent" class="footer_widget_wide">
		 <!-- large footer area -->	
		  <?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
		</div>
	</div>
	
	<!-- highlights -->	
	<div class="highlight_3"></div>	

	<div id="content" class="widget-row">
		<div id="innercontent" class="oh">
		  <!-- widget row -->	
		  <div class="footer_widget_left">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>	
		  </div>
		  <div class="footer_widget_middle">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>		
		  </div>
		  <div class="footer_widget_right">
			 <?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
		 </div>		 		
		</div>
	</div>

	<!-- highlights -->
	<div class="highlight_4"></div>
	<div class="highlight_2"></div>

	<div id="footer">
	<!-- final footer row -->	
	  <div id="innercontent" class="footer_bottom">
		  
		  <!-- final footer left -->	
		  <div class="footer-left">
		  	<a class="titlelink" href="<?php echo get_option('url'); ?>"><span class="footertitle"><?php bloginfo('name'); ?></span></a>
			  <!-- intro -->
			  <div class="tagline-footer">
			   <?php bloginfo('description'); ?>
			  </div>		  	

		   	 <?php if (!dynamic_sidebar( 'left-footer-widget-area' )) { ?>
	   	 		   	 
		   	 <?php } ?>
		  </div>
		  
		  <!-- final footer middle -->	
		  <div class="footer-middle footer-menu">
		   
		  
		  <div class="footer_default_menu">  
		    <?php if ( has_nav_menu('extra-menu') ) {  ?>
		   <?php $args = array(
			   'depth'        => 0,
			   'show_date'    => '',
			   'date_format'  => get_option('date_format'),
			   'child_of'     => 0,
			   'exclude'      => '',
			   'include'      => '',
			   'echo'         => 1,
			   'authors'      => '',
			   'sort_column'  => 'menu_order, post_title',
			   'link_before'  => '',
			   'link_after'   => '',
			   'walker'       => '' ); ?>			
			<?php wp_nav_menu( array( 'theme_location' => 'extra-menu','menu_class' => 'footer-menu' ) ); ?>		
			<?php } ?>
		   </div>
		   
		  </div>
		  

		  <!-- final footer right -->	
		  <?php
		  $theme = wp_get_theme();
		  ?>
		  <div class="footer-right">			  
			<?php if (!dynamic_sidebar( 'right-footer-widget-area' )) { ?> 
			  <div class="footer_default_badge">
				<div class="footer_default_badge_text">
				 WordPress template by <a target="_blank" class="lightlink" href="<?php echo $theme->{'Theme URI'}; ?>">[HD]boilerplate</a>
				</div>
				<div>
				 <a href="<?php echo $theme->{'Theme URI'}; ?>"><img src="<?php echo get_template_directory_uri() ?>/images/HDfootlogo.png" width="110" height="110" class="footer_default_badge_image"  /></a>
				</div>
			  </div>			
			<?php } ?>
		 </div>	
	</div>
  </div>

  <!-- highlights -->
  <div class="highlight_2"></div>
  <div class="highlight_5"></div>

  <div class="footer-box">
   <div class="footer_copy">
	<!-- copy footer -->              
	<div class="copyright-footer">
		<?php	 
	 	if($options['hdb_footer_text'] != '') {
	 		echo wp_filter_nohtml_kses($options['hdb_footer_text']);
		} else {
		?>
		Copyright &copy; <a class="lightlink" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>, <?php echo date("Y"); ?> All Rights Reserved | Powered by <a class="lightlink" href="http://wordpress.org">WordPress</a>.&nbsp;&nbsp;
   		<?php } ?>  
	</div>
   </div>
  </div>
  
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>

</body>
</html>