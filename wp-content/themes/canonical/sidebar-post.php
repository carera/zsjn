<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Main Widget Template
 *
 *
 * @file           sidebar-post.php
 * @package        Canonical
 * @author         Emil Uzelac, Ulrich Pogson
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/canonical/sidebar-post.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>
		<div id="widgets" class="grid col-220 fit">

			<div class="widget-wrapper">

			<div class="post-meta-wrapper">
			<?php responsive_post_meta_data(); ?>

			<div class="post-meta">

				<?php if ( comments_open() ) : ?>
					<span class="comments-link">
					<?php comments_popup_link( __( 'No Comments', 'responsive' ), __( '&larr; 1 Comment', 'responsive' ), __( '&larr; % Comments', 'responsive' ) ); ?>
					</span>
				<?php endif; ?> 

			</div><!-- end of .post-meta -->

			</div><!-- end of .post-meta-wrapper -->

			<?php if ( get_the_author_meta('description') != '' ) : ?>

				<div id="author-meta">
					<?php if ( function_exists('get_avatar') ) { echo get_avatar( get_the_author_meta('email'), '200' ); }?>
					<p><?php the_author_meta('description') ?></p>      
				</div><!-- end of #author-meta -->

			<?php endif; // no description, no author's meta ?>

			</div><!-- end of .widget-wrapper -->

			<?php responsive_widgets(); // above widgets hook ?>

				<?php if (!dynamic_sidebar('post-sidebar')) : ?>

				<?php endif; //end of post-sidebar ?>

			<?php responsive_widgets_end(); // after widgets hook ?>

		</div><!-- end of #widgets -->