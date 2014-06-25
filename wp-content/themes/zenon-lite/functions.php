<?php	
    add_theme_support('custom-background');
	add_theme_support('automatic-feed-links');
	if ( ! isset( $content_width ) )
	$content_width = 630;

//Post Thumbnail	

   add_theme_support( 'post-thumbnails' );

//Register Menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'zenon' ),
		'footer' => __( 'Footer Navigation', 'zenon' )
	) );
	
	
//Include CSS
function znn_customstyle() { ?>

<?php if(of_get_option('prmtrans_checkbox') == "1"){ ?>    
<style type="text/css">
#zn_slider, .midrow_blocks, .lay1 .hentry, .lay2, .lay3 .post_image, .lay3 .post_content, .single_post, .commentlist li, #commentform, #commentform label, #sidebar .widgets .widget, #footer, #copyright, .amp_current, .amp_page:hover, .amp_next:hover, .amp_prev:hover, .page-numbers:hover, .navigation .current, #related_wrap ul, .trigger_wrap, .search_term, ol#controls li, .amp_page, .amp_next, .amp_prev, .page-numbers{ background:url(<?php echo get_template_directory_uri(); ?>/images/trans_black4.png) repeat; }
.comment-form-comment textarea, .comment-form-author input, .comment-form-email input, .comment-form-url input{background:url(<?php echo get_template_directory_uri(); ?>/images/trans_black3.png) repeat;}
.lay3_bridge{ display:none;}

.skew_bottom_big, .skew_bottom_right, .skew_top_big, .skew_top_right, .single_skew, .single_skew .skew_bottom_big, .single_skew .skew_bottom_right, .depth-1 .single_skew, .single_skew_comm, .single_skew_comm .skew_top_big, .single_skew_comm .skew_top_right, #respond_wrap .single_skew, #respond_wrap .single_skew_comm{display:none!important;}
.commentlist .depth-1{ margin-top:10px;}
.midrow_blocks{ margin-top:30px;}
.commentlist li{border-bottom:1px solid #ececec; border-top:1px solid #ececec;}
</style>
<?php } ?>

<?php if(of_get_option('rounded_checkbox') == "1"){ ?>    
<style type="text/css">
.skew_bottom_big, .skew_bottom_right, .skew_top_big, .skew_top_right, .single_skew, .single_skew .skew_bottom_big, .single_skew .skew_bottom_right, .depth-1 .single_skew, .single_skew_comm, .single_skew_comm .skew_top_big, .single_skew_comm .skew_top_right, #respond_wrap .single_skew, #respond_wrap .single_skew_comm{display:none!important;}
.commentlist .depth-1{ margin-top:10px;}
.midrow_blocks{ margin-top:30px;}
.commentlist li{border-bottom:1px solid #ececec; border-top:1px solid #ececec;}

.home #topmenu{border-radius: 8px 8px 0 0; -moz-border-radius: 8px 8px 0 0; -webkit-border-radius: 8px 8px 0 0;behavior: url(<?php echo get_template_directory_uri(); ?>/images/PIE.htc);}
#zn_slider, #topmenu ul li ul{border-radius: 0 0 8px 8px; -moz-border-radius: 0 0 8px 8px; -webkit-border-radius: 0 0 8px 8px;behavior: url(<?php echo get_template_directory_uri(); ?>/images/PIE.htc);}
#topmenu, .midrow_blocks, #footer, #copyright, .lay1 .hentry, .single_post, #sidebar .widgets .widget, .commentlist .depth-1, #commentform, .comment-form-comment textarea, .form-submit input, #searchsubmit, #related_wrap ul, .znn_paginate span, .znn_paginate a, .navigation a, .navigation span, .lay2, .lay3 .post_image, .lay3 .post_content, .comment-form-author input, .comment-form-email input, .comment-form-url input, .commentlist li ul li .comment-body{border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px;behavior: url(<?php echo get_template_directory_uri(); ?>/images/PIE.htc);}
#commentform label{border-radius: 8px 0 0 8px; -moz-border-radius: 8px 0 0 8px; -webkit-border-radius: 8px 0 0 8px;behavior: url(<?php echo get_template_directory_uri(); ?>/images/PIE.htc);}

</style>
<?php } ?>

<?php if(of_get_option('skewed_checkbox') == "0"){ ?>    
<style type="text/css">
.skew_bottom_big, .skew_bottom_right, .skew_top_big, .skew_top_right, .single_skew, .single_skew .skew_bottom_big, .single_skew .skew_bottom_right, .depth-1 .single_skew, .single_skew_comm, .single_skew_comm .skew_top_big, .single_skew_comm .skew_top_right, #respond_wrap .single_skew, #respond_wrap .single_skew_comm{display:none!important;}
.commentlist .depth-1{ margin-top:10px;}
.midrow_blocks{ margin-top:30px;}
.commentlist li{border-bottom:1px solid #ececec; border-top:1px solid #ececec;}
</style>
<?php } else { ?>  
<style type="text/css">#zn_slider{ border:none;}</style>
<?php } ?>

<?php }

add_action( 'wp_head', 'znn_customstyle' );

	
function znn_mobile_css() { 
if ( !is_admin() ) {	
wp_enqueue_style( 'znn_mobile', get_template_directory_uri() . '/mobile.css', false, '1.0', 'only screen and (max-width: 400px)' );
	}
}
add_action('wp_enqueue_scripts', 'znn_mobile_css');	

function znn_ie_css() { 
if ( !is_admin() ) {
    wp_register_style( 'znn_ie', get_template_directory_uri().'/css/ie.css', false, 1.5 );
    $GLOBALS['wp_styles']->add_data( 'znn_ie', 'conditional', 'IE 8' );
    wp_enqueue_style( 'znn_ie' );
	}
}
add_action('wp_enqueue_scripts', 'znn_ie_css');	

function znn_other_css() { 
if ( !is_admin() ) {
wp_enqueue_style('customfont',get_template_directory_uri().'/fonts/'.$zn_fonts = of_get_option('font_select', 'yanone_kaffeesatz' ).'.css');
if(of_get_option('disslight_checkbox') == "0"){ ?><?php wp_enqueue_style('fancybox',get_template_directory_uri().'/css/fancybox.css'); }
	}
}
add_action('wp_enqueue_scripts', 'znn_other_css');	
	
//Load Java Scripts to header
function znn_head_js() { 
if ( !is_admin() ) {
wp_enqueue_script('jquery');
wp_enqueue_script('znn_js',get_template_directory_uri().'/zenon.js');
wp_enqueue_script('znn_other',get_template_directory_uri().'/js/other.js');
wp_enqueue_script('znn_transform',get_template_directory_uri().'/js/jquery.transform.min.js');
if(of_get_option('slider_select') == "easyslider"){ wp_enqueue_script('znn_easyslider',get_template_directory_uri().'/js/easyslider.js');}
if(of_get_option('disslight_checkbox') == "0"){ wp_enqueue_script('znn_fancybox',get_template_directory_uri().'/js/fancybox.js'); }

	}
}
add_action('wp_enqueue_scripts', 'znn_head_js');

//Load Java Scripts to Footer
add_action('wp_footer', 'znn_load_js');
 
function znn_load_js() { ?>

<?php if(of_get_option('slider_select') == "easyslider"){ ?>
    <script type="text/javascript">
		/* <![CDATA[ */
    jQuery(function(){
	jQuery("#slider").easySlider({
		auto: true,
		continuous: true,
		numeric: true,
		pause: <?php echo of_get_option('sliderspeed_text'); ?>
		});
	});
	/* ]]> */
	</script>
<?php } ?>
    
 <?php if(of_get_option('stickm_checkbox') == "1"){ ?>   
    <script type="text/javascript"> 
	/* <![CDATA[ */   
    //Sticky MENU
	jQuery(window).load(function($) {
	if (jQuery("body").hasClass('logged-in')) {
			jQuery("#topmenu").sticky({topSpacing:27});
		}
		else {
			jQuery("#topmenu").sticky({topSpacing:0});
	}
	jQuery("#topmenu").css({"z-index":"11"});
	});
	//JQUERY Site title Animation
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() < 150) {
			jQuery(".scroll_title").hide();
		}
		else {
			jQuery(".scroll_title").show('fast');
		}
	});
	/* ]]> */
	</script>
<?php } ?>

<?php if(of_get_option('ajaxd_checkbox') == "1"){ ?>
<script type="text/javascript">
/* <![CDATA[ */ 
//AJAX PAGINATION
jQuery(document).ready(function(){
jQuery('.amp_next, .amp_prev').css({"display":"none"});
jQuery('.znn_paginate a:first').each(function () {
    var href = jQuery(this).attr('href');
    jQuery(this).attr('href', href + '?paged=1');
});

jQuery('.znn_paginate a').each(function(){
        this.href = this.href.replace('/page/', '?paged=');
});
    jQuery('.znn_paginate a').live('click', function(e)  {
	jQuery('.znn_paginate a, span.amp_page').removeClass('amp_current'); // remove if already existant
    jQuery(this).addClass('amp_current');

<?php if(of_get_option('layout_images') == "layout1"){ ?>
	e.preventDefault();
			var link = jQuery(this).attr('href');
	jQuery('.lay1_wrap').html('<div class="zn_ajaxwrap"><div class="zn_ajax"></div></div>').load(link + '.lay1_wrap .post', function() {
			var divs = jQuery(".lay1 .post");
			for(var i = 0; i < divs.length; i+=3) {
			  divs.slice(i, i+3).wrapAll("<div class='zn_row'></div>"); }
    jQuery('.lay1_wrap').fadeIn(500); });
<?php } ?>	
	
    });
});  // end ready function
/* ]]> */
</script> 
<?php } ?>


    <?php } 

//Zenon get the first image of the post Function
function znn_get_images($overrides = '', $exclude_thumbnail = false)
{
    return get_posts(wp_parse_args($overrides, array(
        'numberposts' => -1,
        'post_parent' => get_the_ID(),
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'order' => 'ASC',
        'exclude' => $exclude_thumbnail ? array(get_post_thumbnail_id()) : array(),
        'orderby' => 'menu_order ID'
    )));
}


// Change what's hidden by default
add_filter('default_hidden_meta_boxes', 'znn_hidden_meta_boxes', 10, 2);
function znn_hidden_meta_boxes($hidden, $screen) {
	if ( 'post' == $screen->base || 'page' == $screen->base || 'slider' == $screen->base  )
		$hidden = array('slugdiv', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
		// removed 'postcustom',
	return $hidden;
}


//Custom Excerpt Length
function znn_excerptlength_teaser($length) {
    return 33;
}
function znn_excerptlength_index($length) {
    return 12;
}
function znn_excerptmore($more) {
    return '...';
}

function znn_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

//SIDEBAR
function znn_widgets_init(){
	register_sidebar(array(
	'name'          => __('Right Sidebar', 'zenon'),
	'id'            => 'sidebar',
	'description'   => __('Right Sidebar', 'zenon'),
	'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="widget_top"></div><div class="widget_wrap">',
	'after_widget'  => '</div><div class="widget_bottom"></div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
	));
	
	register_sidebar(array(
	'name'          => __('Footer Widgets', 'zenon'),
	'id'            => 'foot_sidebar',
	'description'   => __('Widget Area for the Footer', 'zenon'),
	'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="widget_wrap">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
	));
}

add_action( 'widgets_init', 'znn_widgets_init' );


//ZENON COMMENTS
function znn_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div class="single_skew_comm">
        <div class="skew_top_big"></div>
        <div class="skew_top_right"></div>
    </div>
      
     <div id="comment-<?php comment_ID(); ?>" class="comment-body">
      <div class="comment-author vcard">
      <div class="avatar"><?php echo get_avatar($comment,$size='50' ); ?></div>
      </div>
      <div class="comment-meta commentmetadata">
      <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> <?php _e('on' , 'zenon'); ?> <a class="comm_date"><?php printf(get_comment_date()) ?></a> <a class="comm_time"><?php printf( get_comment_time()) ?></a>
        </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'zenon') ?></em>
         <br />
      <?php endif; ?>

      <div class="org_comment"><?php comment_text() ?>
      	<div class="comm_meta_reply">
        <div class="comm_reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
        <div class='comm_edit'><?php edit_comment_link(__('Edit', 'zenon'),'  ','') ?></div></div>
     </div>
     
     </div><div class="single_skew">
        <div class="skew_bottom_big"></div>
        <div class="skew_bottom_right"></div>
    </div>
<?php
        }
		
//ZENON TRACKBACKS & PINGS
function znn_ping($comment, $args, $depth) {
 
$GLOBALS['comment'] = $comment; ?>
	
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   
     <div id="comment-<?php comment_ID(); ?>" class="comment-body">
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'zenon') ?></em>
         <br />
      <?php endif; ?>

      <div class="org_ping">
      	<?php printf(__('<cite class="citeping">%s</cite> <span class="says">:</span>'), get_comment_author_link()) ?>
	  	<?php comment_text() ?>
            <div class="comment-meta commentmetadata">
            <a class="comm_date"><?php printf(get_comment_date()) ?></a>
            <a class="comm_time"><?php printf( get_comment_time()) ?></a>
            <div class='comm_edit'><?php edit_comment_link(__('Edit', 'zenon'),'  ','') ?></div></div>
     </div>
     </div>
     
     
<?php }

//Add Custom Slider Post
add_action('init', 'znn_slider_register');
 
function znn_slider_register() {
 
	$labels = array(
		'name' => __('Slider', 'zenon'),
		'singular_name' => __('Slider Item', 'zenon'),
		'add_new' => __('Add New', 'zenon'),
		'add_new_item' => __('Add New Slide', 'zenon'),
		'edit_item' => __('Edit Slides', 'zenon'),
		'new_item' => __('New Slider', 'zenon'),
		'view_item' => __('View Sliders', 'zenon'),
		'search_items' => __('Search Sliders', 'zenon'),
		'menu_icon' => get_stylesheet_directory_uri() . 'images/article16.png',
		'not_found' =>  __('Nothing found', 'zenon'),
		'not_found_in_trash' => __('Nothing found in Trash', 'zenon'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/slides.png',
		'rewrite' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','excerpt','thumbnail'),
		'register_meta_box_cb' => 'znn_add_meta'
	  ); 
 
	register_post_type( 'slider' , $args );
}
//Slider Link Meta Box
add_action("admin_init", "znn_add_meta");
 
function znn_add_meta(){
  add_meta_box("znn_credits_meta", "Link", "znn_credits_meta", "slider", "normal", "low");
}
 

function znn_credits_meta( $post ) {

  // Use nonce for verification
  $znndata = get_post_meta($post->ID, 'znn_slide_link', TRUE);
  wp_nonce_field( 'znn_meta_box_nonce', 'meta_box_nonce' ); 

  // The actual fields for data entry
  echo '<input type="text" id="znn_sldurl" name="znn_sldurl" value="'.$znndata.'" size="75" />';
}

//Save Slider Link Value
add_action('save_post', 'znn_save_details');
function znn_save_details($post_id){
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'znn_meta_box_nonce' ) ) return; 

  if ( !current_user_can( 'edit_post', $post_id ) )
        return;

$znndata = esc_url( $_POST['znn_sldurl'] );
update_post_meta($post_id, 'znn_slide_link', $znndata);
return $znndata;  
}



add_action('do_meta_boxes', 'znn_slider_image_box');

function znn_slider_image_box() {
	remove_meta_box( 'postimagediv', 'slider', 'side' );
	add_meta_box('postimagediv', __('Slide Image', 'zenon'), 'post_thumbnail_meta_box', 'slider', 'normal', 'high');
}

/* 
 * Loads the Options Panel
 */
 


	/* Set the file path based on whether we're in a child theme or parent theme */

	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/admin/');
	}

	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');


include(TEMPLATEPATH . '/lib/script/pagination.php');
include(TEMPLATEPATH . '/lib/includes/shortcodes.php');
include(TEMPLATEPATH . '/lib/includes/widgets.php');
?>