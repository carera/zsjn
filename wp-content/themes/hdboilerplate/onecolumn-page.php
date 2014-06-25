<?php
/**
 * Template Name: No Sidebar
 *
 * A custom page template without the main sidebar.
 *
 * @package HDboilerplate
 */

get_header(); ?>

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		     <div class="main-page-fullwidth">

				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'HDboilerplate' ), 'after' => '' ) ); ?>
				<?php edit_post_link( __( 'Edit&nbsp;Page', 'HDboilerplate' ), '', '' ); ?>

				<?php comments_template( '', true ); ?>

				<?php endwhile; ?>
				
			</div>
			 
		   </div>
	</div>

<?php get_footer(); ?>