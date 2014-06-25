<?php
/**
 * Menu editor handler
 *
 * @package Menu_Icons
 * @author Dzikri Aziz <kvcrvt@gmail.com>
 */


/**
 * Nav menu admin
 */
final class Menu_Icons_Admin_Nav_Menus {

	/**
	 * Holds active icon types
	 *
	 * @since  0.3.0
	 * @access private
	 * @var    array
	 */
	private static $_icon_types;


	/**
	 * Initialize class
	 *
	 * @since   0.1.0
	 * @wp_hook action load-nav-menus.php
	 */
	public static function init() {
		$active_types = Menu_Icons_Settings::get( 'global', 'icon_types' );
		if ( empty( $active_types ) ) {
			return;
		}

		self::_collect_icon_types();

		add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, '_filter_wp_edit_nav_menu_walker' ), 99 );
		add_filter( 'menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 3 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, '_enqueue_assets' ), 101 );
		add_action( 'print_media_templates', array( __CLASS__, '_media_templates' ) );

		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
	}


	/**
	 * Custom walker
	 *
	 * @since   0.3.0
	 * @access  protected
	 * @wp_hook filter    wp_edit_nav_menu_walker/10/1
	 */
	public static function _filter_wp_edit_nav_menu_walker( $walker ) {
		// Load menu item custom fields plugin
		if ( ! class_exists( 'Menu_Item_Custom_Fields_Walker' ) ) {
			require_once Menu_Icons::get( 'dir' ) . 'includes/walker-nav-menu-edit.php';
		}
		$walker = 'Menu_Item_Custom_Fields_Walker';

		return $walker;
	}


	/**
	 * Collect icon types
	 *
	 * @since  0.3.0
	 * @access private
	 */
	private static function _collect_icon_types() {
		$registered_types = Menu_Icons::get( 'icon_types' );
		foreach ( Menu_Icons_Settings::get( 'global', 'icon_types' ) as $id ) {
			self::$_icon_types[ $id ] = $registered_types[ $id ];
		}
	}


	/**
	 * Get icon types
	 *
	 * @since  0.1.0
	 * @access protected
	 * @uses   apply_filters() Calls 'menu_icons_types' on returned array.
	 *
	 * @return array
	 */
	protected static function _get_types() {
		$types = array_merge(
			array(
				'' => array(
					'id'    => '',
					'label' => __( '&mdash; Select &mdash;', 'menu-icons' )
				),
			),
			self::$_icon_types
		);

		return $types;
	}


	/**
	 * Enqueue scripts & styles on wp-admin/nav-menus.php
	 *
	 * @since   0.1.1
	 * @access  protected
	 * @wp_hook admin_enqueue_scripts
	 */
	public static function _enqueue_assets() {
		global $nav_menu_selected_id;

		$data = array(
			'text'         => array(
				'title'  => __( 'Select Icon', 'menu-icons' ),
				'select' => __( 'Select', 'menu-icons' ),
				'all'    => __( 'All', 'menu-icons' ),
			),
			'base_url'     => untrailingslashit( Menu_Icons::get( 'url' ) ),
			'admin_url'    => untrailingslashit( admin_url() ),
			'menuSettings' => Menu_Icons_Settings::get_menu_settings( $nav_menu_selected_id ),
		);

		foreach ( self::$_icon_types as $id => $props ) {
			if ( ! empty( $props['frame_cb'] ) ) {
				$icon_types[ $id ] = array(
					'type'    => $id,
					'id'      => sprintf( 'mi-%s', $id ),
					'title'   => $props['label'],
					'data'    => call_user_func_array( $props['frame_cb'], array( $id ) ),
				);
				Menu_Icons::enqueue_type_stylesheet( $id, $props );
			}
		}

		/**
		 * WP 3.8 bug, fixed in 3.9
		 *
		 * We need to dequeue and re-enqueue this one later,
		 * otherwise we won't get the dashboard's colors
		 *
		 * @todo Remove in 4.0.1
		 */
		wp_dequeue_style( 'colors' );

		$data['iconTypes'] = $icon_types;
		$data['typeNames'] = array_keys( self::$_icon_types );

		// re-enqueue color style
		wp_enqueue_style( 'colors' );

		wp_localize_script( 'menu-icons', 'menuIcons', $data );
	}


	/**
	 * Get preview
	 *
	 * @since 0.2.0
	 * @access private
	 * @param int $id Menu item ID
	 * @param array $meta_value Menu item meta value
	 * @return mixed
	 */
	private static function _get_preview( $id, $meta_value ) {
		$text = esc_html__( 'Select', 'menu-icons' );
		if ( empty( $meta_value['type'] ) ) {
			return $text;
		}

		$type  = $meta_value['type'];
		$types = self::_get_types();
		if ( empty( $types[ $type ] ) ) {
			return $text;
		}

		if ( empty( $meta_value[ "{$type}-icon" ] ) ) {
			return $text;
		}

		if ( empty( $types[ $type ]['preview_cb'] )
			|| ! is_callable( $types[ $type ]['preview_cb'] )
		) {
			return $text;
		}

		$preview = call_user_func_array(
			$types[ $type ]['preview_cb'],
			array( $id, $meta_value )
		);
		if ( ! empty( $preview ) ) {
			return $preview;
		}

		return $text;
	}


	/**
	 * Get Fields
	 *
	 * @since  0.3.0
	 * @access private
	 * @return array
	 */
	private static function _get_fields() {
		$sections = Menu_Icons_Settings::get_fields();
		$fields   = $sections['menu']['fields'];

		foreach ( $fields as &$field ) {
			$field['default']    = $field['value'];
			$field['attributes'] = array_merge(
				array(
					'class'    => '_setting',
					'data-key' => $field['id'],
				),
				isset( $field['attributes'] ) ? $field['attributes'] : array()
			);
		}

		return $fields;
	}


	/**
	 * Print fields
	 *
	 * @since   0.1.0
	 * @access  protected
	 * @uses    add_action() Calls 'menu_icons_before_fields' hook
	 * @uses    add_action() Calls 'menu_icons_after_fields' hook
	 * @wp_hook action       menu_item_custom_fields/10/3
	 *
	 * @param object $item  Menu item data object.
	 * @param int    $depth Nav menu depth.
	 * @param array  $args  Menu item args.
	 * @param int    $id    Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $item, $depth, $args = array(), $id = 0 ) {
		require_once Menu_Icons::get( 'dir' ) . 'includes/library/form-fields.php';

		$type_ids   = array_values( array_filter( array_keys( self::_get_types() ) ) );
		$input_id   = sprintf( 'menu-icons-%d', $item->ID );
		$input_name = sprintf( 'menu-icons[%d]', $item->ID );
		$current    = wp_parse_args(
			Menu_Icons::get_meta( $item->ID ),
			Menu_Icons_Settings::get_menu_settings( Menu_Icons_Settings::get_current_menu_id() )
		);
		?>
			<div class="field-icon description-wide menu-icons-wrap">
				<?php
					/**
					 * Allow plugins/themes to inject HTML before menu icons' fields
					 *
					 * @param object $item  Menu item data object.
					 * @param int    $depth Nav menu depth.
					 * @param array  $args  Menu item args.
					 * @param int    $id    Nav menu ID.
					 *
					 */
					do_action( 'menu_icons_before_fields', $item, $depth, $args, $id );
				?>
				<?php
				?>
				<div class="easy">
					<p class="description submitbox">
						<label><?php esc_html_e( 'Icon:' ) ?></label>
						<?php printf(
							'<a id="menu-icons-%1$d-select" class="_select" title="%2$s" data-id="%1$d" data-text="%2$s">%3$s</a>',
							esc_attr__( $item->ID ),
							esc_attr__( 'Select icon', 'menu-icons' ),
							self::_get_preview( $item->ID, $current )
						) ?>
						<?php printf(
							'<a id="menu-icons-%1$d-remove" class="_remove hidden submitdelete" data-id="%1$d">%2$s</a>',
							$item->ID,
							esc_attr__( 'Remove', 'menu-icons' )
						) ?>
					</p>
				</div>
				<div class="original hidden">
					<p class="description">
						<label for="<?php echo esc_attr( $input_id ) ?>-type"><?php esc_html_e( 'Icon type', 'menu-icons' ); ?></label>
						<?php printf(
							'<select id="%s-type" name="%s[type]" class="_type hasdep" data-dep-scope="div.menu-icons-wrap" data-dep-children=".field-icon-child" data-key="type">',
							esc_attr( $input_id ),
							esc_attr( $input_name )
						) ?>
							<?php foreach ( self::_get_types() as $id => $props ) : ?>
								<?php printf(
									'<option value="%s"%s>%s</option>',
									esc_attr( $id ),
									selected( ( isset( $current['type'] ) && $id === $current['type'] ), true, false ),
									esc_html( $props['label'] )
								) ?>
							<?php endforeach; ?>
						</select>
					</p>

					<?php foreach ( self::_get_types() as $props ) : ?>
						<?php if ( ! empty( $props['field_cb'] ) && is_callable( $props['field_cb'] ) ) : ?>
							<?php call_user_func_array( $props['field_cb'], array( $item->ID, $current ) ); ?>
						<?php endif; ?>
					<?php endforeach; ?>

					<?php foreach ( self::_get_fields() as $field ) :
						$field['value'] = $current[ $field['id'] ];
						$field = Kucrut_Form_Field::create(
							$field,
							array(
								'keys'               => array( 'menu-icons', $item->ID ),
								'inline_description' => true,
							)
						);
					?>
						<p class="description field-icon-child" data-dep-on='<?php echo json_encode( $type_ids ) ?>'>
							<?php printf(
								'<label for="%s">%s</label>',
								esc_attr( $field->id ),
								esc_html( $field->label )
							) ?>
							<?php $field->render() ?>
						</p>
					<?php endforeach; ?>
				</div>
				<?php
					/**
					 * Allow plugins/themes to inject HTML after menu icons' fields
					 *
					 * @param object $item  Menu item data object.
					 * @param int    $depth Nav menu depth.
					 * @param array  $args  Menu item args.
					 * @param int    $id    Nav menu ID.
					 *
					 */
					do_action( 'menu_icons_after_fields', $item, $depth, $args, $id );
				?>
			</div>
		<?php
	}


	/**
	 * Add our field to the screen options toggle
	 *
	 * @since   0.1.0
	 * @access  private
	 * @wp_hook action manage_nav-menus_columns
	 * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/manage_posts_columns Action: manage_nav-menus_columns/99
	 *
	 * @param array $columns Menu item columns
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns['icon'] = __( 'Icon', 'menu-icons' );

		return $columns;
	}


	/**
	 * Save menu item's icons values
	 *
	 * @since  0.1.0
	 * @access protected
	 * @uses   apply_filters() Calls 'menu_icons_values' on returned array.
	 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/wp_update_nav_menu_item Action: wp_update_nav_menu_item/10/2
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		// Sanitize
		if ( ! empty( $_POST['menu-icons'][ $menu_item_db_id ] ) ) {
			$value = (array) $_POST['menu-icons'][ $menu_item_db_id ];
		}
		else {
			$value = array();
		}

		/**
		 * Allow plugins/themes to filter the values
		 *
		 * @since 0.1.0
		 * @param array $value Metadata value
		 */
		$value = apply_filters( 'menu_icons_values', $value, $menu_item_db_id );

		// Update
		if ( ! empty( $value ) ) {
			update_post_meta( $menu_item_db_id, 'menu-icons', $value );
		}
		else {
			delete_post_meta( $menu_item_db_id, 'menu-icons' );
		}
	}


	/**
	 * Get and print media templates from all types
	 *
	 * @since 0.2.0
	 * @wp_hook action print_media_templates
	 */
	public static function _media_templates() {
		$id_prefix = 'tmpl-menu-icons';

		// Common templates
		$templates = array(
			'sidebar-title' => sprintf(
				'<h3>%s</h3>',
				esc_html__( 'Preview', 'menu-icons' )
			),
			'settings' => sprintf(
				'<label class="setting">
					<span>%1$s</span>
					<select data-setting="position">
						<option value="before">%2$s</option>
						<option value="after">%3$s</option>
					</select>
				</label>
				<label class="setting">
					<span>%4$s</span>
					<input type="number" min="0.1" step="0.1" data-setting="font_size" value="{{ data.font_size }}" />
					em
				</label>
				<label class="setting">
					<span>%5$s</span>
					<select data-setting="vertical_align">
						<option value="">%6$s</option>
						<option value="super">%7$s</option>
						<option value="top">%8$s</option>
						<option value="text-top">%9$s</option>
						<option value="middle">%10$s</option>
						<option value="baseline">%11$s</option>
						<option value="text-bottom">%12$s</option>
						<option value="bottom">%13$s</option>
						<option value="sub">%14$s</option>
					</select>
				</label>
				<label class="setting">
					<span>%15$s</span>
					<select data-setting="hide_label">
						<option value="">%16$s</option>
						<option value="1">%17$s</option>
					</select>
				</label>
				<p class="_info"><em>%18$s</em></p>',
				esc_html__( 'Position', 'menu-icons' ),
				esc_html__( 'Before', 'menu-icons' ),
				esc_html__( 'After', 'menu-icons' ),
				esc_html__( 'Size', 'menu-icons' ),
				esc_html__( 'Vertical Align', 'menu-icons' ),
				esc_html__( '&ndash; Select &ndash;', 'menu-icons' ),
				esc_html__( 'Super', 'menu-icons' ),
				esc_html__( 'Top', 'menu-icons' ),
				esc_html__( 'Text Top', 'menu-icons' ),
				esc_html__( 'Middle', 'menu-icons' ),
				esc_html__( 'Baseline', 'menu-icons' ),
				esc_html__( 'Bottom', 'menu-icons' ),
				esc_html__( 'Text Bottom', 'menu-icons' ),
				esc_html__( 'Sub', 'menu-icons' ),
				esc_html__( 'Hide Label', 'menu-icons' ),
				esc_html__( 'No', 'menu-icons' ),
				esc_html__( 'Yes', 'menu-icons' ),
				sprintf(
					esc_html__( "Please note that the actual look of the icons on the front-end will also be affected by your active theme's style. You can use %s if you need to override it.", 'menu-icons' ),
					'<a target="_blank" href="http://wordpress.org/plugins/simple-custom-css/">Simple Custom CSS</a>'
				)
			),
		);
		$templates = apply_filters( 'menu_icons_media_templates', $templates );

		foreach ( $templates as $key => $template ) {
			$id = sprintf( '%s-%s', $id_prefix, $key );
			self::_print_tempate( $id, $template );
		}

		// Icon type templates
		foreach ( self::_get_types() as $type => $props ) {
			if ( ! empty( $props['templates'] ) ) {
				foreach ( $props['templates'] as $key => $template ) {
					$id = sprintf( '%s-%s-%s', $id_prefix, $type, $key );
					self::_print_tempate( $id, $template );
				}
			}
		}
	}


	/**
	 * Print media template
	 *
	 * @since 0.2.0
	 * @param string $id       Template ID
	 * @param string $template Media template HTML
	 */
	protected static function _print_tempate( $id, $template ) {
		?>
			<script type="text/html" id="<?php echo esc_attr( $id ) ?>">
				<?php echo $template // xss ok ?>
			</script>
		<?php
	}
}
