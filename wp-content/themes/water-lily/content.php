<?php
/**
 * This is the main blog template. We want to display post thumbnails here and the title only.
 *
 * @package water lily
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<a href="<?php the_permalink(); ?>" rel="bookmark"><div class="entry">
			
		<?php if( has_post_thumbnail() ) : 
			
			echo the_post_thumbnail( 'featured-image' ); ?>
			
			<h2><?php the_title(); ?></h2>	
			
		<?php else : ?>
			
			<h2 class="entry-title"><?php the_title(); ?></h2>	
			
			<?php the_excerpt(); ?>
			
		<?php endif; ?>	

	</div></a><!-- .entry -->
	
</article><!-- #post-## -->
