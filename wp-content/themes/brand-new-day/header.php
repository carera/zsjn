<?php
/**
 * @package Brand New Day
 */

    $options = get_option('brandnewday_theme_options');

    $bnd_sidebaroptions = $options['sidebaroptions'];
    $bnd_quickblog = $options['simpleblogmode'];
    $bnd_search = $options['removesearch'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<?php 
if ( $bnd_sidebaroptions == "none" && $bnd_quickblog != 1 ) {
	$class = 'no-right-sidebar';
}
else if ( $bnd_sidebaroptions == "left" && $bnd_quickblog != 1 ) {
	$class = 'left-sidebar';
}
else if ( $bnd_quickblog == 1 ) {
	$class = 'quickblog';
}
else {
	$class = 'right-sidebar';
}
?>
<body <?php body_class( $class ); ?>>
<div class="clouds"></div>
<div class="wrapper">
	<div class="header">
    	<h1 class="title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
    	<div id="search" <?php if ( $bnd_search == 1 || $bnd_quickblog == 1 ) { echo "style='display: none'"; } ?>><?php get_search_form(); ?></div>
    	<h2 class="tagline"><?php bloginfo('description'); ?></h2>
    	
  	</div>
  	
  	