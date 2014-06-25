<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	if (function_exists('wp_get_theme')){
	$themename = wp_get_theme('theme-name');
	} else {
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');	
	}
	
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$number_array = array("1" => "One","2" => "Two","3" => "Three","4" => "Four","5" => "Five", "6" => "Six","7" => "Seven","8" => "Eight","9" => "Nine","10" => "Ten");
	
	// Fonts Array	
	$fonts_array = array(
	"yanone_kaffeesatz" => "Yanone Kaffeesatz",
	"exo" => "Exo",
	"lobster" => "Lobster"
	);
	
	// Test data
	$slider_array = array("easyslider" => "Easyslider","noslider" => "No Slider");
	
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/admin/images/';
		
	$options = array();
		
	$options[] = array( "name" => __('Basic', 'zenon'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Select Font', 'zenon'),
						"desc" => "",
						"id" => "font_select",
						"std" => "yanone_kaffeesatz",
						"type" => "select",
						"class" => "mini",
						"options" => $fonts_array);
						
						
	$options[] = array( "name" => __('Sticky Menu', 'zenon'),
						"desc" => "Enable Sticky menu.",
						"id" => "stickm_checkbox",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Skewed Desgin', 'zenon'),
						"desc" => "Enable Skewed Desgin.",
						"id" => "skewed_checkbox",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Rounded', 'zenon'),
						"desc" => "Enable Rounded corner",
						"id" => "rounded_checkbox",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Ajax Pagination', 'zenon'),
						"desc" => "Enable Ajax Pagination",
						"id" => "ajaxd_checkbox",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Footer Content', 'zenon'),
						"desc" => "Footer Text.",
						"id" => "footer_textarea",
						"std" => "",
						"type" => "textarea"); 
							

	$options[] = array( "name" => __('Front Page', 'zenon'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Front Page Layout', 'zenon'),
						"desc" => "select a front page layout",
						"id" => "layout_images",
						"std" => "layout1",
						"type" => "images",
						"options" => array(
							'layout1' => $imagepath . 'layout1.png'
							)
						);
						
	$options[] = array( "name" => __('Enable Latest Posts', 'zenon'),
						"desc" => "Enable the posts under the blocks on homepage",
						"id" => "latstpst_checkbox",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Enable Blocks', 'zenon'),
						"desc" => "Enable the homepage blocks.",
						"id" => "blocks_checkbox",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Block 1 Heading', 'zenon'),
						"desc" => "",
						"id" => "block1_text",
						"std" => "We Work Efficiently",
						"type" => "text");
							
	$options[] = array( "name" => __('Block 1 Text', 'zenon'),
						"desc" => "",
						"id" => "block1_textarea",
						"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibendum ac.",
						"type" => "textarea"); 
						
	$options[] = array( "name" => __('Block 2 Heading', 'zenon'),
						"desc" => "",
						"id" => "block2_text",
						"std" => "24/7 Live Support",
						"type" => "text");
							
	$options[] = array( "name" => __('Block 2 Text', 'zenon'),
						"desc" => "",
						"id" => "block2_textarea",
						"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibendum ac. Sed ultrices leo.",
						"type" => "textarea"); 

	$options[] = array( "name" => __('Block 3 Heading', 'zenon'),
						"desc" => "",
						"id" => "block3_text",
						"std" => "Confide",
						"type" => "text");
							
	$options[] = array( "name" => __('Block 3 Text', 'zenon'),
						"desc" => "",
						"id" => "block3_textarea",
						"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibendum ac. ",
						"type" => "textarea"); 

	$options[] = array( "name" => __('Block 4 Heading', 'zenon'),
						"desc" => "",
						"id" => "block4_text",
						"std" => "Gurantee Like No Other",
						"type" => "text");
							
	$options[] = array( "name" => __('Block 4 Text', 'zenon'),
						"desc" => "",
						"id" => "block4_textarea",
						"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum.",
						"type" => "textarea"); 
						
	$options[] = array( "name" => __('Facebook', 'zenon'),
						"desc" => "Your Facebook url",
						"id" => "fbsoc_text",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Twitter', 'zenon'),
						"desc" => "Your Twitter url",
						"id" => "ttsoc_text",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Google Plus', 'zenon'),
						"desc" => "Your Google Plus url",
						"id" => "gpsoc_text",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Youtube', 'zenon'),
						"desc" => "Your Youtube url",
						"id" => "ytbsoc_text",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Flickr', 'zenon'),
						"desc" => "Your Flickr url",
						"id" => "flkrsoc_text",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Linkedin', 'zenon'),
						"desc" => "Your Linkedin url",
						"id" => "lnkdsoc_text",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Pinterest', 'zenon'),
						"desc" => "Your Pinterest url",
						"id" => "pinsoc_text",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Rss', 'zenon'),
						"desc" => "Your RSS url",
						"id" => "rsssoc_text",
						"std" => "",
						"type" => "text");
						
							
						
	$options[] = array( "name" => __('Slider', 'zenon'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Select Slider', 'zenon'),
						"desc" => "",
						"id" => "slider_select",
						"std" => "easyslider",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $slider_array);
						
						
	$options[] = array( "name" => __('Slider Speed', 'zenon'),
						"desc" => "milliseconds",
						"id" => "sliderspeed_text",
						"std" => "3000",
						"class" => "mini",
						"type" => "text");	
						
	$options[] = array( "name" => __('Number of Slides', 'zenon'),
						"desc" => "",
						"id" => "number_select",
						"std" => "5",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $number_array);
						
	$options[] = array( "name" => __('Slider Content', 'zenon'),
						"desc" => "Show Slider text",
						"id" => "sldrtxt_checkbox",
						"std" => "1",
						"type" => "checkbox");					
						

	$options[] = array( "name" => __('Miscelleneous', 'zenon'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Post Sharing', 'zenon'),
						"desc" => "Disable Share buttons under posts",
						"id" => "dissshare_checkbox",
						"std" => "0",
						"type" => "checkbox");

						
	$options[] = array( "name" => __('Post Author Name', 'zenon'),
						"desc" => "Hide Post Author Name",
						"id" => "dissauth_checkbox",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Category & Tags', 'zenon'),
						"desc" => "Hide Post Categories and Tags",
						"id" => "disscats_checkbox",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Lightbox', 'zenon'),
						"desc" => "Disable Fancybox Lightbox",
						"id" => "disslight_checkbox",
						"std" => "0",
						"type" => "checkbox");

						
	$options[] = array( "name" => __('Documentation', 'zenon'),
						"type" => "heading");
						
	$options[] = array( "name" => __('About', 'zenon'),
						"type" => "heading");	
						
	$options[] = array( "name" => __('Upgrade', 'zenon'),
						"type" => "heading");
													
	return $options;
}