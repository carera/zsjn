<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Child Theme's Functions and Definitions
 *
 *
 * @file           functions.php
 * @package        Canonical
 * @author         Emil Uzelac, Ulrich Pogson 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1.2
 * @filesource     wp-content/themes/canonical/functions.php
 * @link           http://codex.wordpress.org/Theme_Development#Functions_File
 * @since          available since Release 1.0
 */

/**
 * Fire up the engines boys and girls let's start theme setup.
 */
function canonical_theme_setup() {
	/**
	 * Setup Canonical's textdomain.
	 * Declare textdomain for this child theme.
	 * Translations can be filed in the /lang/ directory.
	 */
	load_child_theme_textdomain( 'canonical', get_stylesheet_directory() . '/lang' );
	/**
	 * Change default logo.
	 * @see http://codex.wordpress.org/Custom_Headers
	 */
	add_theme_support( 'custom-header', array (
		'default-image' => get_stylesheet_directory_uri() . '/images/default-logo.png'
	) );
	/**
	 * This feature enables custompost-thumbnail size for a theme.
	 * Currently used only in front-page.php
	 * @see http://codex.wordpress.org/Function_Reference/the_post_thumbnail
	 */
	add_image_size('featured-image', 620, 200, true);
	add_image_size('post-image', 700, 200, true);
}
add_action( 'after_setup_theme', 'canonical_theme_setup' );

/**
 * Load parent sytlesheets
 * 
 */
function responsive_parent_styles() {
	$theme  = wp_get_theme( 'responsive' );
	// Register the parent stylesheet
	wp_register_style( 'responsive-parent', get_template_directory_uri() . '/style.css', array(), $theme['Version'], 'all' );
	// Register the parent rtl stylesheet
	if ( is_rtl() ) {
	wp_register_style( 'responsive-parent-rtl', get_template_directory_uri() . '/rtl.css', array(), $theme['Version'], 'all' );
	}
	// Enqueue the style
	wp_enqueue_style( 'responsive-parent' );
	wp_enqueue_style( 'responsive-parent-rtl' );
}
add_action( 'wp_enqueue_scripts', 'responsive_parent_styles' );

/**
 * Load Canonical theme sytlesheets
 * 
 */
function canonical_styles() {
	wp_dequeue_style( 'responsive-style' );
	wp_enqueue_style( 'canonical', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'canonical_styles' );

/**
 * Load google web font
 * 
 */
function load_google_fonts() {
	wp_register_style( 'google-web-fonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' );
	wp_enqueue_style( 'google-web-fonts' );
}
add_action( 'wp_print_styles', 'load_google_fonts' );

/**
 * Override responsive theme option defaults
 *
 */
function canonical_default_options ($defaults) {
	$canonical_defaults = array(
		'featured_content' => '<iframe src="http://fast.wistia.com/embed/iframe/fh3u926d9i?controlsVisibleOnLoad=true&version=v1&videoHeight=248&videoWidth=440&volumeControl=true" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" width="440" height="248"></iframe>'
	);
	return $canonical_defaults;
}
add_filter ( 'responsive_option_defaults','canonical_default_options' );

/**
 * WordPress Widgets start right here.
 */
function canonical_widgets_init() {
	register_sidebar(array(
		'name'          => __( 'Post Sidebar', 'canonical' ),
		'description'   => __( 'Area Thirteen - sidebar-post.php', 'canonical' ),
		'id'            => 'post-sidebar',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	));
}
add_action( 'widgets_init', 'canonical_widgets_init', 999 );