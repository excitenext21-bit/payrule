<?php
define( 'DISABLE_WP_CRON', true );
define( 'WP_CACHE', false );
define( 'LITESPEED_DISABLE_ALL', true );
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// Dynamic Environment Configuration (Localhost vs Hostinger Production)
if ( ( isset( $_SERVER['HTTP_HOST'] ) && ( strpos( $_SERVER['HTTP_HOST'], 'localhost' ) !== false || strpos( $_SERVER['HTTP_HOST'], '127.0.0.1' ) !== false ) ) || ( php_sapi_name() === 'cli' && ! file_exists( '/home' ) ) ) {
    define( 'DB_NAME', 'payrule_local' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', '' );
    define( 'DB_HOST', 'localhost' );
    define( 'WP_HOME', 'http://localhost/payrule' );
    define( 'WP_SITEURL', 'http://localhost/payrule' );
    define( 'FORCE_SSL_ADMIN', false );
} else {
    define( 'DB_NAME', 'u314929967_1A88m' );
    define( 'DB_USER', 'u314929967_2qx08' );
    define( 'DB_PASSWORD', 'WEsyjtpJIt' );
    define( 'DB_HOST', 'localhost' );
    define( 'WP_HOME', 'https://payrule.in' );
    define( 'WP_SITEURL', 'https://payrule.in' );
    define( 'FORCE_SSL_ADMIN', true );
}

define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// Security Hardening
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', false );
define( 'CONCATENATE_SCRIPTS', false );

/**#@+
 * Authentication unique keys and salts.
 */
define( 'AUTH_KEY',          'g7X!mP9#qK2$vL8*wR5^yT1&bN4~eZ6@cM3%hU0(jQ8)sD2+fA9=xV5-kL7*mP1$' );
define( 'SECURE_AUTH_KEY',   'wR5^yT1&bN4~eZ6@cM3%hU0(jQ8)sD2+fA9=xV5-kL7*mP1$g7X!mP9#qK2$vL8*' );
define( 'LOGGED_IN_KEY',     'bN4~eZ6@cM3%hU0(jQ8)sD2+fA9=xV5-kL7*mP1$g7X!mP9#qK2$vL8*wR5^yT1&' );
define( 'NONCE_KEY',         'cM3%hU0(jQ8)sD2+fA9=xV5-kL7*mP1$g7X!mP9#qK2$vL8*wR5^yT1&bN4~eZ6@' );
define( 'AUTH_SALT',         'jQ8)sD2+fA9=xV5-kL7*mP1$g7X!mP9#qK2$vL8*wR5^yT1&bN4~eZ6@cM3%hU0(' );
define( 'SECURE_AUTH_SALT',  'fA9=xV5-kL7*mP1$g7X!mP9#qK2$vL8*wR5^yT1&bN4~eZ6@cM3%hU0(jQ8)sD2+' );
define( 'LOGGED_IN_SALT',    'kL7*mP1$g7X!mP9#qK2$vL8*wR5^yT1&bN4~eZ6@cM3%hU0(jQ8)sD2+fA9=xV5-' );
define( 'NONCE_SALT',        'g7X!mP9#qK2$vL8*wR5^yT1&bN4~eZ6@cM3%hU0(jQ8)sD2+fA9=xV5-kL7*mP1$' );
define( 'WP_CACHE_KEY_SALT', 'sD2+fA9=xV5-kL7*mP1$g7X!mP9#qK2$vL8*wR5^yT1&bN4~eZ6@cM3%hU0(jQ8)' );
/**#@-*/

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
