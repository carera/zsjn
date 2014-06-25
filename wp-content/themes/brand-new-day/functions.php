<?php
/**
 * @package Brand New Day
 */

require_once ( get_template_directory() . '/theme-options.php' );

add_action( 'wp_enqueue_scripts', 'bnd_print_styles' );

function bnd_print_styles() {

	$options = get_option('brandnewday_theme_options');

	$bnd_themestyle = $options['themestyle'];
	$bnd_customcss = $options['customcss'];

	if ( file_exists( get_template_directory() . '/nightlight.css' ) && 'nightlight' == $bnd_themestyle ) {
		wp_register_style( 'bnd_nightlight', get_template_directory_uri() . '/nightlight.css' );
		wp_enqueue_style( 'bnd_nightlight' );
	} else if ( file_exists( get_template_directory() . '/winterlight.css' ) && 'winterlight' == $bnd_themestyle ) {
		wp_register_style( 'bnd_winterlight', get_template_directory_uri() . '/winterlight.css' );
		wp_enqueue_style( 'bnd_winterlight' );
	} else if ( file_exists( get_template_directory() . '/autumnlight.css' ) && 'autumnlight' == $bnd_themestyle ) {
		wp_register_style( 'bnd_autumnlight', get_template_directory_uri() . '/autumnlight.css' );
		wp_enqueue_style( 'bnd_autumnlight' );
	} else if ( file_exists( get_template_directory() . '/daylight.css' ) ){
		wp_register_style( 'bnd_daylight', get_template_directory_uri() . '/daylight.css' );
		wp_enqueue_style( 'bnd_daylight' );
	}

	if ( $bnd_customcss ) {
		echo "<style type='text/css'>";
		echo $bnd_customcss;
		echo "</style>";
	}

}

add_action( 'widgets_init', 'bnd_sidebars' );

function bnd_sidebars() {

	register_sidebar( array(
		'id' => 'vertical-sidebar',
		'name' => __( 'Vertical Sidebar', 'brand-new-day' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
		) );

	register_sidebar( array(
		'id' => 'footer-sidebar1',
		'name' => __( 'Footer Sidebar 1', 'brand-new-day' ),
		'before_widget' => '<li id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="footer-widgettitle">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'id' => 'footer-sidebar2',
		'name' => __( 'Footer Sidebar 2', 'brand-new-day' ),
		'before_widget' => '<li id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="footer-widgettitle">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'id' => 'footer-sidebar3',
		'name' => __( 'Footer Sidebar 3', 'brand-new-day' ),
		'before_widget' => '<li id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="footer-widgettitle">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'id' => 'footer-sidebar4',
		'name' => __( 'Footer Sidebar 4', 'brand-new-day' ),
		'before_widget' => '<li id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="footer-widgettitle">',
		'after_title' => '</h3>',
	) );
}

function bnd_theme_setup() {

	if ( ! isset( $content_width ) ) $content_width = 630;

	add_theme_support( 'automatic-feed-links' );

	add_editor_style();

	load_theme_textdomain( 'brand-new-day', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ) {
		require_once( $locale_file );
	}

}

add_action( 'after_setup_theme', 'bnd_theme_setup' );

// Add .navmenu class to custom menu widget
function bnd_nav_menu_args( $args ) {
        $args['container_class'] = 'navmenu';
        return $args;
}
add_filter( 'wp_nav_menu_args', 'bnd_nav_menu_args' );

/**
 * Add support for Theme Options in the Customizer
 */

function brandnewday_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'brandnewday_theme_options', array(
		'title'		=> __( 'Theme Options', 'brand-new-day' ),
		'priority'	=> 35,
		'transport'	=> 'postMessage',
	) );

	$wp_customize->add_setting( 'brandnewday_theme_options[themestyle]', array(
		'default'		=> 'daylight',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'brandnewday_theme_options[sidebaroptions]', array(
		'default'		=> 'right',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'brandnewday_theme_options[removesearch]', array(
		'default'		=> '0',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'brandnewday_theme_options[simpleblogmode]', array(
		'default'		=> '0',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
	) );

	$wp_customize->add_control( 'brandnewday_theme_style', array(
		'label'		=> __( 'Theme Style', 'brand-new-day' ),
		'section'	=> 'brandnewday_theme_options',
		'settings'	=> 'brandnewday_theme_options[themestyle]',
		'type'		=> 'select',
		'choices'	=> array(
						'daylight' 		=> __( 'Daylight', 'brand-new-day' ),
						'nightlight' 	=> __( 'Nightlight', 'brand-new-day' ),
						'winterlight' 	=> __( 'Winterlight', 'brand-new-day' ),
						'autumnlight' 	=> __( 'Autumnlight', 'brand-new-day' ),
					),
	) );

	$wp_customize->add_control( 'brandnewday_sidebaroptions', array(
		'label'		=> __( 'Sidebar Options', 'brand-new-day' ),
		'section'	=> 'brandnewday_theme_options',
		'settings'	=> 'brandnewday_theme_options[sidebaroptions]',
		'type'		=> 'select',
		'choices'	=> array(
						'right' => __( 'Right Sidebar', 'brand-new-day' ),
						'left' 	=> __( 'Left Sidebar', 'brand-new-day' ),
						'none' 	=> __( 'No Sidebar', 'brand-new-day' ),
					),
	) );

	$wp_customize->add_control( 'brandnewday_removesearch', array(
		'label'		=> __( 'Remove the search bar', 'brand-new-day' ),
		'section'	=> 'brandnewday_theme_options',
		'settings'	=> 'brandnewday_theme_options[removesearch]',
		'type'		=> 'checkbox',
		'choices'	=> array(
						'1' => __( 'Remove the search bar', 'brand-new-day' ),
					),
	) );

	$wp_customize->add_control( 'brandnewday_simpleblogmode', array(
		'label'		=> __( 'Enable simple blog mode', 'brand-new-day' ),
		'section'	=> 'brandnewday_theme_options',
		'settings'	=> 'brandnewday_theme_options[simpleblogmode]',
		'type'		=> 'checkbox',
		'choices'	=> array(
						'1' => __( 'Remove the sidebar, search bar and narrow the content column', 'brand-new-day' ),
					),
	) );

}

add_action( 'customize_register', 'brandnewday_customize_register' );


?>