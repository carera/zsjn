<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package water lily
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
		
		<h1 class="page-title"><?php the_title(); ?></h1>
		
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'water-lily' ),
				'after'  => '</div>',
			) );
		?>
		
		<?php edit_post_link( __( 'Edit', 'water-lily' ), '<span class="edit-link">', '</span>' ); ?>
		
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
