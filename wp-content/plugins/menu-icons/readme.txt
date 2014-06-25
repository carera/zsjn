=== Menu Icons ===
Contributors: kucrut
Donate Link: http://kucrut.org/#coffee
Tags: menu, nav-menu, icons, navigation
Requires at least: 3.8
Tested up to: 3.9
Stable tag: 0.3.2
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add icons to your nav menu items.


== Description ==
This plugin gives you the ability to add icons to your menu items, similar to the look of the latest dashboard menu.

= Usage =
1. After the plugin is activated, go to *Appearance* > *Menus* to edit your menus
1. Enable/Disable icon types in "Menu Icons Settings" meta box
1. Set default settings for current nav menu; these settings will be inherited by the newly added menu items
1. Select icon by clicking on the "Select icon" link
1. Save the menu

= Supported icon types =
- Dashicons (WordPress core icon fonts)
- [Font Awesome](http://fontawesome.io/) by [Dave Gandy](http://twitter.com/davegandy)
- [Elusive Icons](http://shoestrap.org/downloads/elusive-icons-webfont/) by [Aristeides Stathopoulos](http://shoestrap.org/blog/author/aristath/)
- [Genericons](http://genericons.com/) by [Automattic](http://automattic.com/)

= Planned supported icon types =
- Image (attachment file & URL)

= Planned features =
1. Provide menus preview on the front end
1. Provide setting page

Development of this plugin is done on [GitHub](https://github.com/kucrut/wp-menu-icons). **Pull requests welcome**. Please see [issues reported](https://github.com/kucrut/wp-menu-icons/issues) there before going to the plugin forum.


== Screenshots ==
1. Menu Editor
2. Icon selection
3. Twenty Fourteen with Dashicons
4. Twenty Fourteen with Genericons
5. Twenty Thirteen with Dashicons
6. Twenty Thirteen with Genericons
7. Settings Meta Box (Global)
8. Settings Meta Box (Menu)


== Installation ==

1. Upload `menu-icons` to the `/wp-content/plugins/` directory
1. Activate the plugin through the *Plugins* menu in WordPress


== Frequently Asked Questions ==

= The icons are not showing! =
Make sure that your active theme is using the default walker for displaying the nav menu. If it's using its own custom walker, make sure that the menu item titles are filterable (please consult your theme author about this).

= The icon positions don't look right =
If you're comfortable with editing your theme stylesheet, then you can override the styles from there.
Otherwise, I recommend you to use the [Simple Custom CSS plugin](http://wordpress.org/plugins/simple-custom-css/)

= Some font icons are not rendering correctly =
This is a bug with the font icon itself. When the font is updated, this plugin will update its font too.

= Is this plugin extendable? =
**Certainly!** Here's how you can remove an icon type from your plugin/theme:
`
function myplugin_remove_menu_icons_type( $types ) {
	unset( $types['genericon'] );
	return $types;
}
add_filter( 'menu_icons_types', 'myplugin_remove_menu_icons_type' );
`

To add a new icon type, take a look at the `type-*.php` files inside the `includes` directory of this plugin.

= Can you please add X icon font? =
Let me know via [GitHub issues](https://github.com/kucrut/wp-menu-icons/issues) and I'll see what I can do.


== Changelog ==
= 0.3.2 =
* Add missing minified CSS for Elusive font icon, props [zazou83](http://profiles.wordpress.org/zazou83)

= 0.3.1 =
* Fix fatal error on outdated PHP versions, props [dellos](http://profiles.wordpress.org/dellos)

= 0.3.0 =
* Add Settings meta box on Menu screen
* New feature: Settings inheritance (nav menu > menu items)
* New feature: Hide menu item labels
* New Icon type: Elusive Icons
* Update Font Awesome to 4.1.0

= 0.2.3 =
* Add new group for Dashicons: Media

= 0.2.1 =
* Fix icon selector compatibility with WP 3.9

= 0.2.0 =
* Media frame for icon selection
* New font icon: Font Awesome

= 0.1.5 =
* Invisible, but important fixes and improvements

= 0.1.4 =
* Fix menu saving

= 0.1.3 =
* Provide icon selection fields on newly added menu items

= 0.1.2 =
* Improve extra stylesheet

= 0.1.1 =
* Improve icon selection UX

= 0.1.0 =
* Initial public release
