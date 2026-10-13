<?php
define( 'WP_CACHE', true );


define('LITESPEED_DISABLE_ALL', true);

define('AUTOMATIC_UPDATER_DISABLED', true);

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u314929967_1A88m' );

/** Database username */
define( 'DB_USER', 'u314929967_2qx08' );

/** Database password */
define( 'DB_PASSWORD', 'WEsyjtpJIt' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '-^JQBF.<Jl@>%cTq-qmRB>f~SW<%I8]8d,4z4$VAPHi$icujEXo-2Iw~p2N.yx!h' );
define( 'SECURE_AUTH_KEY',   '^b8*XdU>r@UK2`Ndy1yw:D!G:Jc`o|zsbid6LwwC{I|TA7;n93xE%R3NOLw?}yfp' );
define( 'LOGGED_IN_KEY',     'k,HzBU&?[;a@`Fr%gJ9+ZZSOt_5SVdqg`J{=o7CSBQ8Mu^WqkK:RE0x`bb^bZi[|' );
define( 'NONCE_KEY',         '@_,oHb!yFqytrv#FGv:>{lO.)@4rM2Kd-0>N(73yZJO%u66~OX[]2IYs]E+D^_m.' );
define( 'AUTH_SALT',         'Azzm:hBqZmr<|=<$o}0k$4uS=kjuogqBE^7QC|&o8`eKWP#$Tk>Emki6~YzB+!*6' );
define( 'SECURE_AUTH_SALT',  '<+Xi|<9?hEIf mYr2cGq/L!yzxpR2t7Hlqq%%xCwQUYzDxeLs+,9t`2Y#Fn1:<q=' );
define( 'LOGGED_IN_SALT',    'j_:LOqp{2X5KC)-00nGAA=9f,f;B5(-e>to,--GG?hvyQanzhRFqYFFQ%[d~uBvy' );
define( 'NONCE_SALT',        'VJs5{n<9nz%!cMc{C/$fFe|p||SDxqTTn0P+gs{6U!xBF DE@+hj1a(~53itH_< ' );
define( 'WP_CACHE_KEY_SALT', ')7g3x,TTpH;`><D:oDp!pjU6*:jb]8D2z$4?ir~PLEUmRzhbQlHH@jCXf,,jR{<]' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/** WordPress Security Settings */
define('DISALLOW_FILE_EDIT', false);
define('DISALLOW_FILE_MODS', false);
define('CONCATENATE_SCRIPTS', false);
define('FORCE_SSL_LOGIN', true);