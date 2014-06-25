<?php get_header(); ?>
<div class="lay1">

<div class="search_term"><h2 class="postsearch"><?php printf( __( 'Search Results for: %s', 'zenon' ), '<span>' . esc_html( get_search_query() ) . '</span>'); ?></h2>
            <a class="search_count"><?php _e('Total posts found for', 'zenon'); ?> <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = esc_html($s, 1); $count = $allsearch->post_count; _e('', 'zenon'); _e('<span class="search-terms">"', 'zenon'); echo $key; _e('"</span>', 'zenon'); _e(' &mdash; ', 'zenon'); echo $count . ''; wp_reset_query(); ?></a>
            <?php get_search_form(); ?>
            </div>

<div class="lay1_wrap">
                   <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                
                <div class="post_content">
                    <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <?php znn_excerpt('znn_excerptlength_index', 'znn_excerptmore'); ?> 
                    
                </div>
                
                <div class="post_image">
                     <!--CALL TO POST IMAGE-->
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="imgwrap">

                        <div class="date_meta"><?php the_time('d'); ?><?php the_time('S'); ?> <?php the_time('M'); ?></div>
                        <div class="block_comm"><?php if (!empty($post->post_password)) { ?>
                <?php } else { ?><div class="comments"><?php comments_popup_link( __('0</br>Comment', 'zenon'), __('1</br>Comment', 'zenon'), __('%</br>Comments', 'zenon'), '', __('Off' , 'zenon')); ?></div><?php } ?></div>

                        
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a></div>
                    
                    <?php elseif($photo = znn_get_images('numberposts=1', true)): ?>
    
                    <div class="imgwrap">

                        <div class="date_meta"><?php the_time('d'); ?><?php the_time('S'); ?> <?php the_time('M'); ?></div>
                        <div class="block_comm"><?php if (!empty($post->post_password)) { ?>
                <?php } else { ?><div class="comments"><?php comments_popup_link( __('0</br>Comment', 'zenon'), __('1</br>Comment', 'zenon'), __('%</br>Comments', 'zenon'), '', __('Off' , 'zenon')); ?></div><?php } ?></div>

                        
                	<a href="<?php the_permalink();?>"><?php echo wp_get_attachment_image($photo[0]->ID ,'medium'); ?></a></div>
                
                    <?php else : ?>
                    
                    <div class="imgwrap">

                        <div class="date_meta"><?php the_time('d'); ?><?php the_time('S'); ?> <?php the_time('M'); ?></div>
                        <div class="block_comm"><?php if (!empty($post->post_password)) { ?>
                <?php } else { ?><div class="comments"><?php comments_popup_link( __('0</br>Comment', 'zenon'), __('1</br>Comment', 'zenon'), __('%</br>Comments', 'zenon'), '', __('Off' , 'zenon')); ?></div><?php } ?></div>

                        
                    <a href="<?php the_permalink();?>"><img src="<?php echo get_template_directory_uri(); ?>/images/blank_img.png" alt="<?php the_title_attribute(); ?>" class="znn_thumbnail"/></a></div>   
                             
                    <?php endif; ?>

                </div>
                
                        </div>
            <?php endwhile ?> 

            <?php endif ?>
</div>
            <?php if (function_exists("znn_paginate")) {znn_paginate();} ?>
            <div class="hidden_nav"><?php paginate_links(); ?></div>

    </div>
<?php get_footer(); ?>