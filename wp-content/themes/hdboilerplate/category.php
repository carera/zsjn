<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package HDboilerplate
 */

get_header(); ?>

			<div class="main-body">
			
			   <h2 class="subheading"><?php
				   printf( __( 'Category Archives: %s', 'HDboilerplate' ), '' . single_cat_title( '', false ) . '' );
			   ?></h2>
			   <?php
				   $category_description = category_description();
				   if ( ! empty( $category_description ) )
					   echo '' . $category_description . '';
			   
			   /* Run the loop for the category page to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-category.php and that will be used instead.
				*/
			   get_template_part( 'loop', 'category' );
			   ?>

			 </div>
   
			 <!-- main widget sidebar -->	  
			 <div class="main-sidebar">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			 </div>		 
			 
		   </div>
	</div>

<?php get_footer(); ?>