<?php
/**
 * The Template for displaying all single posts.
 *
 * @package HDboilerplate
 */

get_header(); ?>

			<div class="main-body">

			  <?php if (function_exists('HDboilerplate_breadcrumbs')) HDboilerplate_breadcrumbs(); ?>

			  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>			
				  <?php //previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'HDboilerplate' ) . ' %title' ); ?>
				  <?php //next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'HDboilerplate' ) . '' ); ?>
				  <h1><a class="title" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'HDboilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			  
				  <div class="post-header">
				  <?php HDboilerplate_posted_on(); ?>
				  <?php HDboilerplate_posted_in(); ?>
				  </div>
				  
				  <hr class="divider-line" />
				  
				  <div class="main-entry">
				  <?php the_content(); ?>
				  </div>
				  
          <div style="width:100%;clear:both;"></div>
          
				  <?php edit_post_link( __( 'Edit Post', 'HDboilerplate' ), '', '' ); ?>

				  <?php
				  $tags_list = get_the_tag_list( '', ', ' );
				  if ( $tags_list ) { ?>
				  
				  <hr class="divider-line-tags" />
				  <div class="post-footer">

				  <?php printf( __( 'Tagged %2$s', 'HDboilerplate' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
				  
				  </div>
				  <?php } ?>
				  
				  <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'HDboilerplate' ), 'after' => '' ) ); ?>
				  <br />
				  <h3>Share this Post</h3>
				  <hr class="divider-line">
				  <div id="social-wrapper">
				   <ul style="margin-left:0px;padding-left:0px;">
				   <li><a target="_blank" rel="nofollow" title="Tweet on Twitter" href="http://twitter.com/share/?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>"><img alt="Twitter" width="32px" height="32px" src="<?php echo get_template_directory_uri() ?>/images/twitter.png"></a> </li></li>
				   <li> <a target="_blank" rel="nofollow" title="Link on Facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;src=sp"><img alt="Facebook" width="32px" height="32px" src="<?php echo get_template_directory_uri() ?>/images/facebook.png"></a> </li>
				   <li> <a target="_blank" rel="nofollow" title="Post on Reddit" href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"><img alt="Reddit" width="32px" height="32px" src="<?php echo get_template_directory_uri() ?>/images/reddit.png"></a> </li>
				   <li> <a target="_blank" rel="nofollow" title="Stumble at StumbleUpon" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"><img alt="Stumble" width="32px" height="32px" src="<?php echo get_template_directory_uri() ?>/images/stumbleupon.png"></a> </li>
				   </ul>
				  </div>
			  
				  <?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'HDboilerplate' ) . ' %title' ); ?>
				  <?php //next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'HDboilerplate' ) . '' ); ?>
			  
				  <div id="author-wrapper">
				  
				  <a href="<?php the_author_meta('user_url'); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?></a>
				  
				  <p><?php the_author_meta('description'); ?></p>
					  <p>See all posts by  <?php the_author_posts_link(); ?> </p>
				  </div>
				  
				  <?php comments_template( '', true ); ?>
			  
			  <?php endwhile; // end of the loop. ?>

			 </div>
   
			 <!-- main widget sidebar -->	  
			 <div class="main-sidebar">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			 </div>		 
			 
		   </div>
	</div>

<?php get_footer(); ?>