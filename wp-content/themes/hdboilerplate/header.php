<?php
/**
 * The Header for the [HD]boilerplate theme.
 *
 * Displays all of the <head> section.
 *
 * @package HDboilerplate
 */
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php language_attributes(); ?>>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<head>
<title><?php bloginfo( 'name' ); ?> <?php wp_title( ); ?></title>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head> 

<body <?php body_class('"'); ?>>

<div id="container">
	
	<div id="header">
		<div id="innercontent" class="header_wrapper">
		  
		  <?php if (is_home()) { ?>
		  
			<!-- Left Header -->
			<div class="header-home-left">
			  <?php if (get_header_image()) { ?>
			  <!-- logo -->
			  <a href="<?php echo home_url() ; ?>">
			   <img class="header_default_image" src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" border="0" align="left" valign="absmiddle" />
			  </a>
			  <?php } ?>
			  <!-- title -->
			  <a class="titlelink" href="<?php echo home_url();  ?>">
			   <h1 class="title-home-size"><?php bloginfo('name'); ?></h1>		
			  </a>	
			  <div class="header-home-message">		
			  <?php dynamic_sidebar( 'left-header-widget-area' ); ?>
			  </div>
			</div>
			
			<!-- Right Header -->
			<div class="header-home-right">
				<?php dynamic_sidebar( 'right-header-widget-area' ); ?>	  
			</div>
		  
		  <?php } else { ?>
		  
			<div class="header-page-left">
			  <?php if (get_header_image()) { ?>
			  <!-- logo -->
			  <a href="<?php echo home_url(); ?>">
			   <img class="header_default_image" src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" border="0" align="left" valign="absmiddle" />
			  </a>
			  <?php } ?>			
			  <!-- title -->
			  <a class="titlelink" href="<?php echo home_url(); ?>">
			   <h1 class="title-page-size"><?php bloginfo('name'); ?></h1>		
			  </a>
			  <!-- intro -->
			  <div class="tagline-header">
			   <?php bloginfo('description'); ?>
			  </div>
			</div>
			
			<!-- Right Header -->
			<div class="header-page-right">
				<?php dynamic_sidebar( 'small-header-widget-area' ); ?>	  
			</div>		  
			
		  <?php } ?>
		  
		</div>
	</div>

  <!-- highlights -->
  <div class="highlight_2"></div>
  <div class="highlight_5"></div>

  <?php if ( has_nav_menu('header-menu') ) {  ?>
  <!-- menu -->
  <div id="content">
  	  <div class="header-menu">
	  <div class="menu_wrapper">
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_id' => 'nav', 'menu_class' => '' ) ); ?>	
	  </div>
	  </div>
  </div>
  <?php }  else {  ?>
  <!-- menu -->
  <div id="content">
  	  <div class="header-menu">
	  <div class="menu_wrapper">
		<?php wp_nav_menu( array( 'theme_location' => '', 'menu_id' => 'nav', 'menu_class' => '' ) ); ?>	
	  </div>
	  </div>
  </div>
  <?php } ?>
  

  <!-- highlight -->
  <div class="highlight_5"></div>
  <div class="highlight_1"></div>

	<?php if (is_home()) { ?>
	<!-- popular -->
	<div id="content" class="popular-row">
		<div id="innercontent" class="widget-no-title">
		  <div>
		  <?php dynamic_sidebar( 'popular-widget-area' ); ?>	
		  </div>	
		</div>
	</div>
	<?php } ?>
	
	<!-- highlight -->
    <div class="highlight_6"></div>

	<!-- first block -->
	<div id="content" class="body_background">
		<div id="innercontent" class="body_wrapper">