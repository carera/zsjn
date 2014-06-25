<?php
/**
 * Template Name: Left Sidebar
 *
 * The template for displaying the sidebar on the left.
 *
 * @package HDboilerplate
 */

get_header(); ?>
	
		     <div class="main-body-right">
	
			   <?php
			   /* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*/
				get_template_part( 'loop', 'index' );
			   ?>

			 </div>
   
			 <!-- main widget sidebar -->	  
			 <div class="main-sidebar-left">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			 </div>		 
			 
		   </div>
	</div>

<?php get_footer(); ?>