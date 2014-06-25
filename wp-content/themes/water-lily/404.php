<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package water lily
 */

get_header(); ?>
	
<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">
			
			<div class="entry-content">

				<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'water-lily' ); ?></h1>

				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'water-lily' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .entry-content -->

		</main><!-- #main -->
		
	</div><!-- #primary -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>