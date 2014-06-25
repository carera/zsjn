<?php
/**
 * Template Name: Archive
 *
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package HDboilerplate
 */

get_header(); ?>

				<div class="main-body">
				
				<?php
					/* Queue the first post, that way we know
					 * what date we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					if ( have_posts() )
						the_post();
				?>
				
				<?php if ( is_day() ) : ?>
								<?php printf( __( '<h2><span class="archives_header">Daily Archives %s</span></h2>', 'HDboilerplate' ), get_the_date() ); ?>
				<?php elseif ( is_month() ) : ?>
								<?php printf( __( '<h2><span class="archives_header">Monthly Archives %s</span></h2>', 'HDboilerplate' ), get_the_date('F Y') ); ?>
				<?php elseif ( is_year() ) : ?>
								<?php printf( __( '<h2><span class="archives_header">Yearly Archives %s</span></h2>', 'HDboilerplate' ), get_the_date('Y') ); ?>
				<?php else : ?>
								<?php 
								_e( '<h1>Archives</h1>', 'HDboilerplate' ); 
								$ashow=1;
								?>
								<div class="page_header_top">
								<?php the_content(); ?>
								</div>
				<?php endif; ?>
				
				<?php if ($ashow) {	?>
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
				<?php 
				} 
				else {
				
					/* Since we called the_post() above, we need to
					* rewind the loop back to the beginning that way
					* we can run the loop properly, in full.
					*/
					rewind_posts();
				
					/* Run the loop for the archives page to output the posts.
					* If you want to overload this in a child theme then include a file
					* called loop-archives.php and that will be used instead.
					*/
					get_template_part( 'loop', 'archive' );
				
				}
				?>				
			<?php edit_post_link( __( 'Edit&nbsp;Page', 'HDboilerplate' ), '', '' ); ?>
			
			</div>
			
   			
   
			 <!-- main widget sidebar -->	  
			 <div class="main-sidebar">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			 </div>		 
			 
		   </div>
	</div>

<?php get_footer(); ?>