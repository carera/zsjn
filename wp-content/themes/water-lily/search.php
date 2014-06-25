<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package water lily
 */

get_header(); ?>

<div id="primary" class="content-area">
		
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'water-lily' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content' );
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		
		<?php water_lily_paging_nav(); ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>