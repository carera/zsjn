<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Front Page
 *
 *
 * @file           front-page.php
 * @package        Canonical
 * @author         Emil Uzelac, Ulrich Pogson
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 2.0
 * @filesource     wp-content/themes/canonical/front-page.php
 * @link           http://codex.wordpress.org/Template_Hierarchy
 * @since          available since Release 2.0
 */

/**
 * Globalize Theme Options
 */
$responsive_options = responsive_get_options();
/**
 * If front page is set to display the
 * blog posts index, include home.php;
 * otherwise, display static front page
 * content
 */
if ( 'posts' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	get_template_part( 'home' );
} elseif ( 'page' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	$template = get_post_meta( get_option( 'page_on_front' ), '_wp_page_template', true );
	$template = ( $template == 'default' ) ? 'index.php' : $template;
	locate_template( $template, true );
} else { 

	get_header(); 

	//test for first install no database
	$db = get_option( 'responsive_theme_options' );
	//test if all options are empty so we can display default text if they are
	$empty = ( empty( $responsive_options['home_headline'] ) && empty( $responsive_options['home_subheadline'] ) && empty( $responsive_options['home_content_area'] ) ) ? false : true;

?>

		<div id="featured" class="grid col-940">

			<h1 class="featured-title">
				<?php
				if ( isset( $responsive_options['home_headline'] ) && $db && $empty )
					echo $responsive_options['home_headline'];
				else
					_e( 'Hello, World!', 'responsive' );
				?>
			</h1>

			<p>
				<?php
				if ( isset( $responsive_options['home_content_area'] ) && $db && $empty )
					echo do_shortcode( $responsive_options['home_content_area'] );
				else
					_e( 'Your title, subtitle and this very content is editable from Theme Option. Call to Action button and its destination link as well. Image on your right can be an image or even YouTube video if you like.','responsive' );
				?>
			</p>

			<?php if ( empty( $responsive_options['cta_button'] ) ) : ?>

				<div class="call-to-action">

					<a href="<?php echo $responsive_options['cta_url']; ?>" class="blue button">
						<?php 
						if( isset( $responsive_options['cta_text'] ) && $db && $empty )
							echo $responsive_options['cta_text']; 
						else
							_e('Call to Action','responsive');
						?>
					</a>
				
				</div><!-- end of .call-to-action -->

			<?php endif; ?>

		</div><!-- end of #featured -->

		<div id="featured-middle" class="grid col-940">

		<div id="featured-image-title" class="grid col-460">

			<h2 class="featured-subtitle">
				<?php
				if ( isset( $responsive_options['home_subheadline'] ) && $db && $empty )
					echo $responsive_options['home_subheadline'];
				else
					_e( 'Your H2 subheadline here', 'responsive' );
				?>
			</h2>

		</div><!-- end of #featured-image-title -->

		<div id="featured-image" class="grid col-460 fit"> 

			<?php
			$featured_content = ( !empty( $responsive_options['featured_content'] ) ) ? $responsive_options['featured_content'] : 
			'<iframe src="http://fast.wistia.com/embed/iframe/fh3u926d9i?controlsVisibleOnLoad=true&version=v1&videoHeight=248&videoWidth=440&volumeControl=true" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" width="440" height="248"></iframe>'; 
			echo do_shortcode( $featured_content );
			?>

		</div><!-- end of #featured-image --> 

		</div><!-- end of #feaured-middle -->

		<div id="content-news" class="clearfix">

		<div class="grid col-620">

	<?php 
	global $wp_query, $paged;
	if( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	}
	elseif( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}
	else {
		$paged = 1;
	}
	$blog_query = new WP_Query( array( 
		// category name
		'category_name' => 'featured',
		// number of posts
		'posts_per_page' => 3,
		'post_type' => 'post',
		'paged' => $paged
	) );
	$temp_query = $wp_query;
	$wp_query = null;
	$wp_query = $blog_query;

	if ( $blog_query->have_posts() ) :

			while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
				?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<?php responsive_entry_top(); ?>
					
					<?php get_template_part( 'post-meta' ); ?>
					
					<div class="post-entry">
						<?php if ( has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<?php the_post_thumbnail(); ?>
							</a>
						<?php endif; ?>
						<?php the_content(__('Read more &#8250;', 'responsive')); ?>
						<?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
					</div><!-- end of .post-entry -->
					
					<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> -->       
			<?php responsive_entry_after(); ?>
				
		<?php 
		endwhile;

        if (  $wp_query->max_num_pages > 1 ) : 
			?>
			<div class="navigation">
				<div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'responsive' ), $wp_query->max_num_pages ); ?></div>
				<div class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'responsive' ), $wp_query->max_num_pages ); ?></div>
			</div><!-- end of .navigation -->
			<?php 
		endif;

	else : 

		get_template_part( 'loop-no-posts' ); 

	endif; 
	$wp_query = $temp_query;
	wp_reset_postdata();
	?> 

		</div><!-- end of .grid col-620-->               
		<?php get_sidebar('home'); ?>
		</div><!-- end of #content-news -->

<?php get_footer(); } ?>