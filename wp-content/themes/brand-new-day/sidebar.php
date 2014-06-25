<?php
/**
 * @package Brand New Day
 */
 
$options = get_option('brandnewday_theme_options');
 
$bnd_sidebaroptions = $options['sidebaroptions'];
$bnd_quickblog = $options['simpleblogmode'];

?>

<ul id="sidebar" class="sidebar" <?php if ( $bnd_sidebaroptions == "none" || $bnd_quickblog == 1 ) { echo "style='display: none;'"; } ?>>
<?php if ( !dynamic_sidebar( __( 'Vertical Sidebar' , 'brand-new-day' ) ) ) : ?>
	<li id="navmenu" class="navmenu">
		<?php wp_nav_menu(); ?>
	</li>
<?php endif; ?>
</ul>
