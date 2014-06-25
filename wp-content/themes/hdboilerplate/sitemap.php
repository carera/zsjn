<?php
/**
 * Template Name: Sitemap
 *
 * The template for displaying a sitemap of your site.
 *
 * @package HDboilerplate
 */

get_header(); ?>

			<div class="main-body">
			
				<h1><?php the_title(); ?></h1>
				<div>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="sitemap_wrapper">
					<?php the_content(); ?>
					</div>
					<?php endwhile; endif; ?>
					<p>
					<h2>
						<?php _e('Pages','standardtheme'); ?>
					</h2>
					<ul>
						<?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' ); ?>
					</ul>
					</p>
					<p>
					<h2>
						<?php _e('Categories','standardtheme'); ?>
					</h2>
					<ul>
						<?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
					</ul>
					</p>
					<p>
					<h2>
						<?php _e('Posts Per Category','standardtheme'); ?>
					</h2>
					<div class="sitemap_categories">
					<?php 
					$cats = get_categories();
					foreach ($cats as $cat) { 
						query_posts('cat='.$cat->cat_ID);
					?>
						<h4>
							<?php echo $cat->cat_name; ?>
						</h4>
						<ul>
							<?php while (have_posts()) : the_post(); ?>
								<li class="sitemap_categories_items">
									<?php the_time('Y, M j') ?> - <a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php _e('Comments','standardtheme'); ?> (<?php echo $post->comment_count ?>)
								</li>
							<?php endwhile;	 ?>
						</ul>
						<br />
					<?php } ?>
					</div>
					<?php edit_post_link( __( 'Edit&nbsp;Page', 'HDboilerplate' ), '', '' ); ?>
					</p>
				</div>
			 </div>
   
			 <!-- main widget sidebar -->	  
			 <div class="main-sidebar">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			 </div>		 
			 
		   </div>
	</div>
<?php get_footer(); ?>