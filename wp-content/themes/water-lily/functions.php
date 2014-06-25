<?php
/**
 * Water Lily functions and definitions
 *
 * @package water lily
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800; /* pixels */
}

if ( ! function_exists( 'water_lily_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function water_lily_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on water-lily, use a find and replace
	 * to change 'water-lily' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'water-lily', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' 	=> 	__( 'Primary Menu', 'water-lily' ),
	) );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-image', 350, 9999, false );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'water_lily_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // water_lily_setup
add_action( 'after_setup_theme', 'water_lily_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function water_lily_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'water-lily' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'water_lily_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function water_lily_scripts() {
	wp_enqueue_style( 'water-lily-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'water-lily-oswald' );	
	wp_enqueue_style( 'water-lily-noto-sans' );
	
	if ( !is_singular() && !is_404() && !is_author() ) {
		wp_enqueue_script( 'masonry');
		wp_enqueue_script( 'water-lily-masonry', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20120206', true );
	}

	wp_enqueue_script( 'water-lily-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'water-lily-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'water_lily_scripts' );


/**
 * Register Google Fonts
 */
function water_lily_google_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	/*	translators: If there are characters in your language that are not supported
		by Noto Sans, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'water-lily' ) ) {

		wp_register_style( 'water-lily-noto-sans', "$protocol://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic" );

	}
	
	$protocol = is_ssl() ? 'https' : 'http';

	/*	translators: If there are characters in your language that are not supported
		by Oswald, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'water-lily' ) ) {

		wp_register_style( 'water-lily-oswald', "$protocol://fonts.googleapis.com/css?family=Oswald:400,700" );

	}
}
add_action( 'init', 'water_lily_google_fonts' );

/**
 * Enqueue Google Fonts for custom headers
 */
function water_lily_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'water-lily-noto-sans' );
	wp_enqueue_style( 'water-lily-oswald' );

}
add_action( 'admin_enqueue_scripts', 'water_lily_admin_scripts' );


add_filter( 'excerpt_more', 'water_lily_excerpt' );
if ( ! function_exists( 'water_lily_excerpt' ) ) :
/**
 * Adds a read more link to all excerpts
 * This function is attached to the 'excerpt_more' filter hook.
 *
 * @param	int $more
 * @return	Custom excerpt ending
 *
	 * @since 1.0.0
 */
function water_lily_excerpt( $more ) {
	return '&hellip;';
}
endif; // water_lily_excerpt


add_filter( 'wp_trim_excerpt', 'water_lily_excerpt_more' );
if ( ! function_exists( 'water_lily_excerpt_more' ) ) :
/**
 * Adds a read more link to all excerpts
 * This function is attached to the 'wp_trim_excerpt' filter hook.
 *
 * @param	string $text
 * @return	Custom read more link
 * @since 1.0.0
 */
function water_lily_excerpt_more( $text ) {
	if ( is_singular() )
		return $text;

	return '<p class="excerpt">' . $text . ' <span class="more-link">' . __( 'more', 'water-lily' ) . '</span></p>';
}
endif; // water_lily_excerpt_more

add_filter( 'the_content_more_link', 'water_lily_content_more_link', 10, 2 );
if ( ! function_exists( 'water_lily_content_more_link' ) ) :
/**
 * Customize read more link for content
 * This function is attached to the 'the_content_more_link' filter hook.
 *
 * @param	string $link
 * @param	string $text
 * @return	Custom read more link
 * @since 1.0.0
 */
function water_lily_content_more_link( $link, $text ) {
	return '<a href="' . get_permalink( get_the_ID() ) . '">' . $text . '</a>';
}
endif; // water_lily_content_more_link

add_filter( 'excerpt_length', 'water_lily_excerpt_length', 999 );
if ( ! function_exists( 'water_lily_excerpt_length' ) ) :
/**
 * Custom excerpt length
 * This function is attached to the 'excerpt_length' filter hook.
 *
 * @param	int $length
 * @return	Custom excerpt length
 * @since 1.0.0
 */
function water_lily_excerpt_length( $length ) {
	global $water_lily_custom_excerpt_length;

	if ( $water_lily_custom_excerpt_length )
		return $water_lily_custom_excerpt_length;

	return 30;
}
endif; // water_lily_excerpt_length

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Adds a body class for masonry layouts
 *
 * @since Visual 0.1
 */
 
function water_lily_body_class( $classes ) {
	if ( !is_singular() && !is_404() && !is_author() )
		$classes[] = 'masonry';
	return $classes;
}

add_filter('body_class','water_lily_body_class');


/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 * This ensures that are google fonts display in the admin.
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string
 */
function water_lily_mce_css( $mce_css ) {

	$protocol = is_ssl() ? 'https' : 'http';

	$font = "$protocol://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic|Oswald:400,700";

	if ( empty( $font ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$font = str_replace( ',', '%2C', $font );
	$font = esc_url_raw( str_replace( '|', '%7C', $font ) );

	return $mce_css . $font;
}
add_filter( 'mce_css', 'water_lily_mce_css' );
