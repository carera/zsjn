<?php

/* @package HDboilerplate */

include get_template_directory() . '/widgets.php';


//build a portfolio page from category
function HDboilerplate_show_portfolio($cat) {
  $c = explode(":",$cat);
  $pc = new WP_Query('&category_name='.$c[0].'&orderby=comment_count&posts_per_page=100&meta_key=_thumbnail_id');
  echo '<div class="portfolio_item_wrapper">'; 
  while ($pc->have_posts()) : $pc->the_post();
	echo '<div class="portfolio-item'.$c[1].'">';
	  echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(),array(214,214),array('class' => 'portfolio-item-img'.$c[1].' linkButton')).'</a>';
	  echo '<div class="portfolio-item-title'.$c[1].'">';
	  echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
	  echo '</div>';
	echo '</div>';
  endwhile;		
  echo '</div>';			
}


//add a short code for portfolios
function HDboilerplate_portfolio_short( $atts ) {
	extract( shortcode_atts( array(
		'category' => '',
	), $atts ) );
	HDboilerplate_show_portfolio($category);
}
add_shortcode( 'portfolio', 'HDboilerplate_portfolio_short' );


//fix gallery output clear
function HDboilerplate_fix_gallery_output( $output ) {
	$output = preg_replace("%<br style=.*clear: both.* />%", "", $output);
	return $output;
}
add_filter('the_content', 'HDboilerplate_fix_gallery_output',11, 1);


//remove default gallery styling
add_filter( 'use_default_gallery_style', '__return_false' );


//inserts the featured image above post text
function HDboilerplate_InsertFeaturedImage($content) {
	global $post;
	$original_content = $content;
    if ( current_theme_supports( 'post-thumbnails' ) ) {
        if ((is_page()) || (is_single())) {
            $content = the_post_thumbnail('page-single');
            $content .= $original_content;
            } else {
            $content = the_post_thumbnail('index-categories');
            $content .= $original_content;
        }
    }
    return $content;
}
add_filter( 'the_content', 'HDboilerplate_InsertFeaturedImage' );


//register menus with WordPress
function HDboilerplate_register_my_menus() {
  register_nav_menus(
    array( 'header-menu' => __('Header Menu', 'HDboilerplate'), 'extra-menu' => __('Footer Menu', 'HDbolierplate'))
  );
}
add_action('init', 'HDboilerplate_register_my_menus');


//register CSS with WordPress
function HDboilerplate_register_style() {
	wp_register_style( 'HDboilerplate_CSS', get_stylesheet_directory_uri()."/style.css", false, "1.0", "all" );
	wp_enqueue_style( 'HDboilerplate_CSS');
}
add_action('init', 'HDboilerplate_register_style');


//set the content width based on the theme's design and stylesheet.
if (!isset( $content_width)) $content_width = 570;


/** tell WordPress to run HDboilerplate_setup() when the 'after_setup_theme' hook is run. */
add_action('after_setup_theme', 'HDboilerplate_setup');


if (!function_exists('HDboilerplate_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override HDboilerplate_setup() in a child theme, add your own HDboilerplate_setup to your child theme's
 * functions.php file.
 *
 */
function HDboilerplate_setup() {

	// this theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style('editor-style.css');

	// this theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
    add_image_size('index-categories', 570, 150, true);
    add_image_size('page-single', 570, 150, true);	

	$options = get_option('hdb_options');

	add_theme_support('custom-header');

	//this theme allows users to set a custom background
	$defaults = array(
		'default-color'          => '1c455b'
	);
	add_theme_support( 'custom-background', $defaults );
	default_background();
	
	add_theme_support( 'automatic-feed-links' );

	
	//no CSS, just IMG call. the %s is a placeholder for the theme template directory URI.
	define('HEADER_IMAGE', '%s/images/headers/path.png');

	//the height and width of your custom header. You can hook into the theme's own filters to change these values.
	//add a filter to HDboilerplate_header_image_width and HDboilerplate_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'HDboilerplate_header_image_width', 50 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'HDboilerplate_header_image_height', 50 ) );

	//post thumbnails for custom header images on posts and pages.
	set_post_thumbnail_size(HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	//don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );	
	
	//default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/hdboilerplate.png',
			'thumbnail_url' => '%s/images/headers/hdbolierplate-thumbnail.png',
			/* translators: header image description */
			'description' => __( '[HD]boilerplate', 'HDboilerplate' )
		)
	) );
}
endif;

//get our wp_nav_menu() fallback, wp_page_menu(), to show a home link
function HDboilerplate_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args', 'HDboilerplate_page_menu_args');


//sets the post excerpt length to 40 characters
function HDboilerplate_excerpt_length( $length ) {
	return 40;
}
add_filter('excerpt_length', 'HDboilerplate_excerpt_length');


//returns a "Continue reading" link for excerpts
function HDboilerplate_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __('Continue reading <span class="meta-nav">&rarr;</span>', 'HDboilerplate') . '</a>';
}


//replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and HDboilerplate_continue_reading_link().
function HDboilerplate_auto_excerpt_more( $more ) {
	return ' &hellip;' . HDboilerplate_continue_reading_link();
}
add_filter('excerpt_more', 'HDboilerplate_auto_excerpt_more');


//adds a pretty "Continue reading" link to custom post excerpts.
function HDboilerplate_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= HDboilerplate_continue_reading_link();
	}
	return $output;
}
add_filter('get_the_excerpt', 'HDboilerplate_custom_excerpt_more');
  
        
if (!function_exists( 'HDboilerplate_comment' )) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own HDboilerplate_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function HDboilerplate_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'HDboilerplate' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'HDboilerplate' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'HDboilerplate' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'HDboilerplate' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'HDboilerplate' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'HDboilerplate'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function theme_slug_enqueue_comment_reply_script() {
         if ( comments_open() && get_option( 'thread_comments' ) ) {
                 wp_enqueue_script( 'comment-reply' );
         }
 }
 add_action( 'comment_form_before', 'theme_slug_enqueue_comment_reply_script' );

//register widgetized areas
function HDboilerplate_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Home Header Widget Left', 'HDboilerplate' ),
		'id' => 'left-header-widget-area',
		'description' => __( 'The home page left header widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Home Header Widget Right', 'HDboilerplate' ),
		'id' => 'right-header-widget-area',
		'description' => __( 'The home page right header widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Single Page Header Widget', 'HDboilerplate' ),
		'id' => 'small-header-widget-area',
		'description' => __( 'The smaller single page header widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Above the Fold', 'HDboilerplate' ),
		'id' => 'popular-widget-area',
		'description' => __( 'The above the fold widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar Widget', 'HDboilerplate' ),
		'id' => 'sidebar-widget-area',
		'description' => __( 'The primary sidebar widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Widget Row - Left', 'HDboilerplate' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The left widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Widget Row - Middle', 'HDboilerplate' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The middle widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Widget Row - Right', 'HDboilerplate' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The right widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Full Width Widget', 'HDboilerplate' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The full page width widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Left Footer Widget', 'HDboilerplate' ),
		'id' => 'left-footer-widget-area',
		'description' => __( 'The bottom left footer widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Right Footer Widget', 'HDboilerplate' ),
		'id' => 'right-footer-widget-area',
		'description' => __( 'The bottom right footer widget area', 'HDboilerplate' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );		
}


//register sidebars by running HDboilerplate_widgets_init() on the widgets_init hook
add_action('widgets_init', 'HDboilerplate_widgets_init');


//removes the default styles that are packaged with the Recent Comments widget.
function HDboilerplate_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action('widgets_init', 'HDboilerplate_remove_recent_comments_style');


if (!function_exists( 'HDboilerplate_posted_on')) :
//prints HTML with meta information for the current post—date/time and author
function HDboilerplate_posted_on() {
	printf( __( '<span class="%1$s"></span> %2$s <span class="meta-sep">on</span> %3$s', 'HDboilerplate' ),
		'meta-prep meta-prep-author',
		sprintf( '<span class="author vcard">By <a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'HDboilerplate' ), get_the_author() ),
			get_the_author()
		),
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		)
	);
}
endif;


if (!function_exists( 'HDboilerplate_posted_in')) :
//prints HTML with meta information for the current post (category, tags and permalink)
function HDboilerplate_posted_in() {
	if ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'in %1$s. <a href="%3$s" title="Permalink to %4$s" rel="bookmark">Permalink</a>.', 'HDboilerplate' );
	} else {
		$posted_in = __( '<a href="%3$s" title="Permalink to %4$s" rel="bookmark">Permalink</a>.', 'HDboilerplate' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list=0,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


//custom excerpt
function HDboilerplate_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}


//process sending a message
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = 'From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

}


function HDboilerplate_breadcrumbs() {
  $delimiter = '&raquo;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="breadcrumbs">';
 
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page', 'HDboilerplate') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end HDboilerplate_breadcrumbs()


//if there is no background color use default
function default_background() {
	$bgcolor = get_background_color();

	if(empty($bgcolor) && !is_admin()) {
		echo "<style type='text/css'>\n";
		echo "body { background-color: #1c455b; }; \n";
		echo "</style>";
	}
	
}


//bonus class to work with Image/Flickr feeds
class HDboilerplate_flickr {

	//function that removes double-quotes so they don't interfere with the HTML
	function cleanup($s = null) {
		if (!$s) {
			return false;
		}
		else {
			return str_replace('"', '', $s);
		}
	}
	
	//function that returns the correctly sized photo URL.
	function HDboilerplate_photo($url, $size) {
		$url = explode('/', $url);
		$photo = array_pop($url);
		switch($size) {
			case 'square':
			$r = preg_replace('/(_(s|t|m|b))?\./i', '_s.', $photo);
			break;
			case 'thumb':
			$r = preg_replace('/(_(s|t|m|b))?\./i', '_t.', $photo);
			break;
			case 'small':
			$r = preg_replace('/(_(s|t|m|b))?\./i', '_m.', $photo);
			break;
			case 'large':
			$r = preg_replace('/(_(s|t|m|b))?\./i', '_b.', $photo);
			break;
			default: // Medium
			$r = preg_replace('/(_(s|t|m|b))?\./i', '.', $photo);
			break;
		}
		$url[] = $r;
		return implode('/', $url);
	}
	
	//function that looks through the description and finds the first image
	function HDboilerplate_find_photo($data) {
		preg_match_all('/<div style="clear:both"></div><img src="([^" alt="" />]*)&gt;/i', $data, $m);
		return $m[1][0];
	}

}

?>