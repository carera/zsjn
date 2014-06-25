<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'zsjn');

/** MySQL database username */
define('DB_USER', 'zsjn');

/** MySQL database password */
define('DB_PASSWORD', 'ahoj12');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '@-yN-Es-~d$I|4QuvZxuHyHQC&)1GA|;;ztI[0NaYy@ +5Hc@3LE_73{Sc,J)jp&');
define('SECURE_AUTH_KEY',  'qav::XTc}lK +Oyni{)1UbH+O[~3<sE.Eu?|X@j,oylrU7|H+#g++NCii6xeJ?+H');
define('LOGGED_IN_KEY',    '1hjxEGTnlKf9IEN1>yr$,1JYJNE:p~+cL7~{0UM<Z[|yIjmt(}+Y!O|3v])JW}{`');
define('NONCE_KEY',        'LGF{Bv}$Mm>(>E2~B#@z ^C#D:M+oQzQ3Qupc32qHP%U$}U_q_aNj/7.M$f7D;)H');
define('AUTH_SALT',        'b78_yD_}8K.bCs~|Bp|&6PnH:?-eLepqPutq%nYi-|&qxId-W)z1sx|L^$4x,=%Q');
define('SECURE_AUTH_SALT', 'ujxiIb+oZ4Vn/njOz1Y>K7<sqX/M{O~v-B%4ze3MEim$8zdO*nxH%(i92m-(v@S*');
define('LOGGED_IN_SALT',   '4Bsz;vT(F`A3MysL@nL`P;~YY}AAKSBr|ERSp0T4o(w3*EH]I]^LdvU~{18:t]No');
define('NONCE_SALT',       'QyU+=[c}KD1Y5U/>d*qK*KAH~^j ftlK%$NX3D8G~~8)V(/x Lg9)nk<]WOtNxvC');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'cs_CZ');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
