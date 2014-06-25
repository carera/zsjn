<?php
/**
 * The template for displaying 404 pages (Page Not Found).
 *
 * @package HDboilerplate
 */
 
get_header(); ?>

			<div class="main-body">
			  <h1><?php _e( 'Not Found', 'HDboilerplate' ); ?></h1>
			  <p><?php _e( 'Apologies, but the page you requested could not be found.', 'HDboilerplate' ); ?></p>

				<p>
				<h2>
					<?php _e('The Last 30 Posts','HDboilerplate'); ?>
				</h2>
				<ul>
					<?php query_posts('showposts=30'); ?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php $wp_query->is_home = false; ?>
					<li>
						<?php the_time('Y, M j') ?> - <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</li>
					<?php endwhile; endif; ?>
				</ul>
				</p>
				<p>
				<h2>
					<?php _e('Categories','HDboilerplate'); ?>
				</h2>
				<ul>
					<?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
				</ul>
				</p>
				<p>
				<h2>
					<?php _e('Monthly Archives','HDboilerplate'); ?>
				</h2>
				<ul>
					<?php wp_get_archives('type=monthly&show_post_count=1') ?>	
				</ul>
				</p>



			</div>
   
			<!-- main widget sidebar -->	  
			<div class="main-sidebar">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			</div>		 
			
		</div>
</div>

<?php get_footer(); ?>