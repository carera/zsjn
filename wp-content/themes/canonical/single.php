<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Single Posts Template
 *
 *
 * @file           single.php
 * @package        Canonical
 * @author         Emil Uzelac, Ulrich Pogson
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/canonical/single.php
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

<div id="content" class="grid col-700">

<?php get_template_part( 'loop-header' ); ?>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="post-title"><?php the_title(); ?></h1>

				<div class="post-entry">

					<?php the_content(__('Read more &#8250;', 'responsive')); ?>

					<?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>

				</div><!-- end of .post-entry -->

				<div class="navigation">
					<div class="previous"><?php previous_post_link( '&#8249; %link' ); ?></div>
					<div class="next"><?php next_post_link( '%link &#8250;' ); ?></div>
				</div><!-- end of .navigation -->

				<div class="post-data">
					<?php the_tags(__('Tagged with:', 'responsive') . ' ', ', ', '<br />'); ?> 
					<?php printf(__('Posted in %s', 'responsive'), get_the_category_list(', ')); ?> 
				</div><!-- end of .post-data -->             

			<div class="post-edit"><?php edit_post_link(__('Edit', 'responsive')); ?></div>             
			</div><!-- end of #post-<?php the_ID(); ?> -->

			<?php comments_template( '', true ); ?>

	<?php 
	endwhile; 

		get_template_part( 'loop-nav' ); 

	else : 

		get_template_part( 'loop-no-posts' ); 

	endif; 
	?>

</div><!-- end of #content -->

<?php get_sidebar('post'); ?>
<?php get_footer(); ?>
