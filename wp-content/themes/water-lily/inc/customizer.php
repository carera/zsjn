<?php
/**
 * Water Lily Theme Customizer
 *
 * @package water lily
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function water_lily_customize_register( $wp_customize ) {
	
	
    // Logo upload
    $wp_customize->add_section( 'water_lily_logo_section' , array(
	    'title'       => __( 'Logo', 'water-lily' ),
	    'priority'    => 30,
	    'description' => __( 'Logo', 'water-lily' ),
	) );
	$wp_customize->add_setting( 'water_lily_logo' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'water_lily_logo', array(
		'label'      => 	__( 'Upload logo to replace the default site name ( 220px wide max )', 'water-lily' ),
		'section'    => 		'water_lily_logo_section',
		'settings'   => 		'water_lily_logo',
	) ) );
	
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'water_lily_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function water_lily_customize_preview_js() {
	wp_enqueue_script( 'water_lily_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'water_lily_customize_preview_js' );
