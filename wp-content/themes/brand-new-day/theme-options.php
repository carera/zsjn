<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'brandnewday_options', 'brandnewday_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {

	global $bnd_options_hook;
	$bnd_options_hook = add_theme_page( __( 'Theme Options', 'brand-new-day' ), __( 'Theme Options', 'brand-new-day' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );

	add_action( 'load-'.$bnd_options_hook, 'bnd_contextual_help' );
}

/**
 * Add a contextual help menu to the Theme Options panel
 */
function bnd_contextual_help() {

	global $bnd_options_hook;

	$screen = get_current_screen();

	if (  $bnd_options_hook == $screen->id ) {

		$contextual_help = '<p><a href="http://wordpress.org/tags/brand-new-day?forum_id=5" target="_blank">' . __( 'For basic support, please post in the WordPress forums.', 'brand-new-day' ) . '</a></p>';
		$contextual_help .= '<p><strong>' . __( 'Theme Style', 'brand-new-day' ) . '</strong> - ' . __( 'This is where you can choose the overall look and feel of your blog. Defaults to Daylight.', 'brand-new-day' ) . '</p>';
		$contextual_help .= '<p><strong>' . __( 'Sidebar Options', 'brand-new-day' ) . '</strong> - ' . __( 'Choose whether you want the sidebar aligned to the right or left, or hide the sidebar entirely. Defaults to Right Sidebar.', 'brand-new-day' ) . '</p>';
		$contextual_help .= '<p><strong>' . __( 'Remove Search', 'brand-new-day' ) . '</strong> - ' . __( 'Checking this removes the default search box in the upper-right-hand corner of the theme.', 'brand-new-day' ) . '</p>';
		$contextual_help .= '<p><strong>' . __( 'Enable Simple Blog Mode', 'brand-new-day' ) . '</strong> - ' . __( 'Checking this removes the sidebar (regardless of previous Sidebar Options settings), the search bar (regardless of previous Remove Search setting) and narrows the content column. Simple Blog Mode is great for bringing focus to the post content. Ideal for "microblogs" or Tumblr-style websites.', 'brand-new-day' ) . '</p>';
		$contextual_help .= '<p><strong>' . __( 'Custom CSS', 'brand-new-day' ) . '</strong> - ' . __( 'You can override the theme\'s default CSS by putting your own code here.  It should be in the format:', 'brand-new-day' ) . '</p>';
		$contextual_help .= '<blockquote><pre>.some-class { width: 100px; }</pre>';
		$contextual_help .= '<pre>#some-id { background-color: #fff; }</pre></blockquote>';
		$contextual_help .= '<p>' . __( 'Replacing any classes, ID\'s, etc. with the ones you want to override, and within them the attributes you want to change.', 'brand-new-day' ) . '</p>';
		$contextual_help .= '<p><strong>' . __( 'Support Caroline Themes/Hide Donate Button', 'brand-new-day' ) . '</strong> - ' . __( 'If you like my themes and find them useful, please donate!  Checking the box will hide this information.', 'brand-new-day' ) . '</p>';
		$contextual_help .= '<p><a href="http://www.carolinethemes.com" target="_blank">' . __( 'Visit Caroline Themes for more free WordPress themes!', 'brand-new-day' ) . '</a></p>';

		$screen->add_help_tab( array(
								'id' => 'bnd-theme-options',
								'title' => 'Theme Options',
								'content' => $contextual_help
								)
							);
	}

}

/**
 * Create arrays for our theme styles and sidebar options
 */

$bnd_themestyle_options = array(
	'daylight' => array(
		'value' => 'daylight',
		'label' => __( 'Daylight', 'brand-new-day' )
	),
	'nightlight' => array(
		'value' => 'nightlight',
		'label' => __( 'Nightlight', 'brand-new-day' )
	),
	'winterlight' => array(
		'value' => 'winterlight',
		'label' => __( 'Winterlight', 'brand-new-day' )
	),
	'autumnlight' => array(
		'value' => 'autumnlight',
		'label' => __( 'Autumnlight', 'brand-new-day' )
	)
);

$bnd_sidebar_options = array(
	'right' => array(
		'value' => 'right',
		'label' => __( 'Right Sidebar', 'brand-new-day' )
	),
	'left' => array(
		'value' => 'left',
		'label' => __( 'Left Sidebar', 'brand-new-day' )
	),
	'none' => array(
		'value' => 'none',
		'label' => __( 'No Sidebar', 'brand-new-day' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $bnd_themestyle_options, $bnd_sidebar_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'brand-new-day' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'brand-new-day' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'brandnewday_options' ); ?>
			<?php $options = get_option( 'brandnewday_theme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * Theme Style
				 */
				?>
				<tr valign="top"><th scope="row"><strong><?php _e( 'Theme Style', 'brand-new-day' ); ?></strong></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Theme Style', 'brand-new-day' ); ?></span></legend>
						<?php

							foreach ( $bnd_themestyle_options as $option ) {
								$radio_setting = $options['themestyle'];
								?>
								<div style="width: 240px; float: left; margin-right: 30px; text-align: center; margin-bottom: 20px;">
									<label class="description">
										<img src="<?php echo get_template_directory_uri() . '/images/' . $option['label'] . '.png'; ?>" style="width: 240px;" alt="<?php echo $option['label']; ?> Style" /><br /><input type="radio" name="brandnewday_theme_options[themestyle]" value="<?php esc_attr_e( $option['value'] , 'brand-new-day' ); ?>" <?php checked( $option['value'] , $options['themestyle'] ); ?> /> <?php _e( $option['label'], 'brand-new-day' ); ?>
									</label>
								</div>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php
				/**
				 * Sidebar Options
				 */
				?>
				<tr valign="top"><th scope="row"><strong><?php _e( 'Sidebar Options', 'brand-new-day' ); ?></strong></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Sidebar Options', 'brand-new-day' ); ?></span></legend>
						<?php

							foreach ( $bnd_sidebar_options as $option ) {
								$radio_setting = $options['sidebaroptions'];
								?>
								<label class="description">
									<input type="radio" name="brandnewday_theme_options[sidebaroptions]" value="<?php esc_attr_e( $option['value'] , 'brand-new-day' ); ?>" <?php checked( $option['value'] , $options['sidebaroptions'] ); ?> /> <?php _e( $option['label'] , 'brand-new-day' ); ?>
								</label><br />
						<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php
				/**
				 * Remove Search
				 */
				?>
				<tr valign="top"><th scope="row"><strong><?php _e( 'Remove Search', 'brand-new-day' ); ?></strong></th>
					<td>
						<input id="brandnewday_theme_options[removesearch]" name="brandnewday_theme_options[removesearch]" type="checkbox" value="1" <?php checked( '1', $options['removesearch'] ); ?> />
						<label class="description" for="brandnewday_theme_options[removesearch]">
							<?php _e( 'Remove search bar from header', 'brand-new-day' ); ?>
						</label>
					</td>
				</tr>

				<?php
				/**
				 * Enable Simple Blog Mode
				 */
				?>
				<tr valign="top"><th scope="row"><strong><?php _e( 'Enable Simple Blog Mode', 'brand-new-day' ); ?></strong></th>
					<td>
						<input id="brandnewday_theme_options[simpleblogmode]" name="brandnewday_theme_options[simpleblogmode]" type="checkbox" value="1" <?php checked( '1', $options['simpleblogmode'] ); ?> />
						<label class="description" for="brandnewday_theme_options[simpleblogmode]">
							<?php _e( 'Remove the sidebar, search bar and narrow the content column', 'brand-new-day' ); ?>
						</label>
					</td>
				</tr>

				<?php
				/**
				 * Custom CSS
				 */
				?>
				<tr valign="top"><th scope="row"><strong><?php _e( 'Custom CSS', 'brand-new-day' ); ?></strong></th>
					<td>
						<textarea id="brandnewday_theme_options[customcss]" class="large-text" cols="50" rows="10" name="brandnewday_theme_options[customcss]"><?php echo esc_textarea( $options['customcss'] ); ?></textarea>
						<label class="description" for="brandnewday_theme_options[customcss]">
							<?php _e( 'Add any custom CSS rules here so they will persist through theme updates.', 'brand-new-day' ); ?>
						</label>
					</td>
				</tr>

				<?php
				/**
				 * Pitiful begging. ;)
				 */

				 if ( $options['support'] !== 1 ) {
				?>
				<tr valign="top" style="background-color: rgb(255, 255, 224);"><th scope="row"><strong><?php _e( 'Support Caroline Themes', 'brand-new-day' ); ?></strong></th>
					<td>
						<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6G3NYZ5EN28EY" target="_blank"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="PayPal - The safer, easier way to pay online!" class="alignright"></a>

						<?php _e( 'If you enjoy my themes, please consider making a secure donation using the PayPal button to your right. Anything is appreciated!', 'brand-new-day' ); ?>

						<br /><input id="brandnewday_theme_options[support]" name="brandnewday_theme_options[support]" type="checkbox" value="1" <?php checked( '1', $options['support'] ); ?> />
						<label class="description" for="brandnewday_theme_options[support]">
							<?php _e( 'No, thank you! Dismiss this message.', 'brand-new-day' ); ?>
						</label>

					</td>
				</tr>
				<?php }
				else { ?>
				<tr valign="top"><th scope="row"><strong>
						<label class="description" for="brandnewday_theme_options[support]">
							<?php _e( 'Hide Donate Button', 'brand-new-day' ); ?>
						</label></strong></th>
					<td>
						<input id="brandnewday_theme_options[support]" name="brandnewday_theme_options[support]" type="checkbox" value="1" <?php checked( '1', $options['support'] ); ?> />

					</td>
				</tr>
				<?php } ?>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'brand-new-day' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $bnd_themestyle_options, $bnd_sidebar_options;

	// Our Simple Blog value is either 0 or 1
	if ( ! isset( $input['simpleblogmode'] ) )
		$input['simpleblogmode'] = null;
	$input['simpleblogmode'] = ( $input['simpleblogmode'] == 1 ? 1 : 0 );

	// Our Remove Search value is either 0 or 1
	if ( ! isset( $input['removesearch'] ) )
		$input['removesearch'] = null;
	$input['removesearch'] = ( $input['removesearch'] == 1 ? 1 : 0 );

	// Our Support value is either 0 or 1
	if ( ! isset( $input['support'] ) )
		$input['support'] = null;
	$input['support'] = ( $input['support'] == 1 ? 1 : 0 );

	// Our Theme Styles must actually be in our array of radio options
	if ( ! isset( $input['themestyle'] ) )
		$input['themestyle'] = null;
	if ( ! array_key_exists( $input['themestyle'], $bnd_themestyle_options ) )
		$input['themestyle'] = null;

	// Our Sidebar Options must actually be in our array of radio options
	if ( ! isset( $input['sidebaroptions'] ) )
		$input['sidebaroptions'] = null;
	if ( ! array_key_exists( $input['sidebaroptions'], $bnd_sidebar_options ) )
		$input['sidebaroptions'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['customcss'] = wp_filter_nohtml_kses( $input['customcss'] );

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

?>