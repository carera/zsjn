<?php
/*
Template Name: Page with Left sidebar
*/
?>
<?php get_header(); ?>

<!--Content-->
<div id="content">
<?php get_sidebar();?>
<div class="single_wrap">
<div class="single_post">
                   <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                
                <div class="post_content">
                    <h2 class="postitle"><?php the_title(); ?></h2>
                    
                    <?php the_content(); ?> 
                    <div style="clear:both"></div>
                    <?php wp_link_pages('<p class="pages"><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>
                    
					<div class="edit"><?php edit_post_link(); ?></div>
                    
                </div>
                
                
                
                        </div>
            <?php endwhile ?> 
            <div class="single_skew">
        <div class="skew_bottom_big"></div>
        <div class="skew_bottom_right"></div>
    </div>    </div>
			<div class="comments_template"><?php comments_template('',true); ?></div>
            <?php endif ?>

    </div>
   
    <!--PAGE END-->
    
</div>
<?php get_footer(); ?>