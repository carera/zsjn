<?php
/**
 * @package Brand New Day
 */

get_header();
?>

	<div id="content" class="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="navigation">
					<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
					<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
				</div>
			<h2 class="page_title"><?php the_title(); ?></h2>
			<small><span class="post-author"><?php _e( 'by' , 'brand-new-day' ); ?> <?php the_author() ?></span> <?php _e( 'on' , 'brand-new-day' ); ?> <?php the_time( get_option( 'date_format' ) ); ?></small>

			<div class="entry">
				<?php the_content('<p>' . __( 'Read the rest of this entry' , 'brand-new-day' ) . ' &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p class="clear"><strong>' . __( 'Pages:' , 'brand-new-day' ) . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				<p class="postmetadata clear"><?php _e( 'Posted in' , 'brand-new-day' ) ?> <?php the_category(', '); ?></p>
				<?php the_tags( '<p class="postmetadata clear">' . __( 'Tags:', 'brand-new-day' ) . ' ', ', ', '</p>'); ?>
				<div class="edit-link"><?php edit_post_link( __( 'Edit this entry', 'brand-new-day' ) , '', ''); ?></div>
				
				<?php comments_template(); ?>
				
			</div>
			
		</div>

	

	<?php endwhile; else: ?>

		<h2 class="page_title"><?php _e( 'Not Found' , 'brand-new-day' ) ?></h2>
		<p class="aligncenter"><?php _e( 'Sorry, no posts matched your criteria.', 'brand-new-day' ) ?></p>
		<?php get_search_form(); ?>

<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>