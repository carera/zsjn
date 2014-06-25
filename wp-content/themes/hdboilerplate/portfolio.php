<?php
/**
 * Template Name: Portfolio
 *
 * The template for displaying a portfolio of any category.
 *
 * @package HDboilerplate
 */

get_header(); ?>
			<div class="main-page-fullwidth">
				<h1><?php the_title(); ?></h1>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="clear portfolio_wrapper">
					<?php the_content(); ?>
					</div>
					<?php endwhile; endif; ?>
			 </div>	 
		   </div>
	</div>
<?php get_footer(); ?>