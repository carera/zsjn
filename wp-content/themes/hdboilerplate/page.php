<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package HDboilerplate
 */

get_header(); ?>

			<div class="main-body">
			
			<?php if (function_exists('HDboilerplate_breadcrumbs')) HDboilerplate_breadcrumbs(); ?>

			  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			  
					 <?php if ( is_front_page() ) { ?>
						 <h2><?php the_title(); ?></h2>
					 <?php } else { ?>	
						 <h1><?php the_title(); ?></h1>
					 <?php } ?>				
 
						 <?php the_content(); ?>
						 <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'HDboilerplate' ), 'after' => '' ) ); ?>
						 <?php edit_post_link( __( 'Edit&nbsp;Page', 'HDboilerplate' ), '', '' ); ?>
 
				 <?php comments_template( '', true ); ?>
			  
			  <?php endwhile; ?>

			 </div>
   
			 <!-- main widget sidebar -->	  
			 <div class="main-sidebar">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			 </div>		 
			 
		   </div>
	</div>

<?php get_footer(); ?>