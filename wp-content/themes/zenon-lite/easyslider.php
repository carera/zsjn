
<div id="slider" class="easyslider">
        <ul>
        <?php $loop = new WP_Query( array( 'post_type' => 'slider', 'posts_per_page' => ''.$zn_fonts = of_get_option('number_select', '3').'' ) ); ?>
        <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
         <li> 
          <?php $znndata = get_post_meta($post->ID, 'znn_slide_link', TRUE); ?>        
		 <?php if(of_get_option('sldrtxt_checkbox') == "1"){ ?>
         <div class="slider-content">

            <?php the_title( '<h2 class="entry-title"><a href="' . $znndata . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); ?>
                <?php the_excerpt(); ?>
            </div>  
         <?php } ?> 
         
        <a href="<?php echo $znndata; ?>"><?php the_post_thumbnail(); ?></a>
            </li>
        <?php endwhile; else: ?>
        
        <li>
            <div class="slider-content">
            <h2 class="entry-title"><?php echo of_get_option('block1_text'); ?></h2>
            <p><?php echo of_get_option('block1_textarea'); ?></p>
            </div>
        	<img src="<?php echo get_template_directory_uri(); ?>/images/slide1.jpg"  />
        </li>
        
        <li>
            <div class="slider-content">
            <h2 class="entry-title"><?php echo of_get_option('block2_text'); ?></h2>
            <p><?php echo of_get_option('block2_textarea'); ?></p>
            </div>
        	<img src="<?php echo get_template_directory_uri(); ?>/images/slide2.jpg"  />
        </li>
        
        <?php endif; ?>
        </ul>
</div>