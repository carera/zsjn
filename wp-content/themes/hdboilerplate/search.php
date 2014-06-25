<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package HDboilerplate
 */

get_header(); ?>

			<div class="main-body">
			  <?php if ( have_posts() ) : ?>
					<h2 class="subheading"><?php printf( __( 'Search: %s', 'HDboilerplate' ), '' . get_search_query() . '' ); ?></h2>
					<?php
					/* Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called loop-search.php and that will be used instead.
					 */
					 get_template_part( 'loop', 'search' );
					?>
			  <?php else : ?>
					<h2><?php _e( 'Nothing Found', 'HDboilerplate' ); ?></h2>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'HDboilerplate' ); ?></p>
					<?php get_search_form(); ?>
			  <?php endif; ?>
			 </div>
   
			 <!-- main widget sidebar -->	  
			 <div class="main-sidebar">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			 </div>		 
			 
		   </div>
	</div>

<?php get_footer(); ?>