<?php

/**
 * level functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uicore-theme
 */
defined('ABSPATH') || exit;

//Global Constants
define('UICORE_THEME_VERSION', '1.0.6');
define('UICORE_THEME_NAME', 'Level');
define('UICORE_FRAMEWORK_VERSION', '3.2.7');


$level_includes = array(
	'/setup.php',
	'/default.php',
	'/template-tags.php',
	'/plugin-activation.php'
);

foreach ($level_includes as $file) {
	require_once get_template_directory() . '/inc' . $file;
}


//Required
if ( ! isset( $content_width ) ) {
	$content_width = 1000;
}
if ( is_singular() ) {
	wp_enqueue_script( "comment-reply" );
}

add_filter('uicore_settings_default_admin', 'uicore_default_admin_options');
function uicore_default_admin_options($default) {
	$settings = array(
		'pFont' => [
			'f' => 'Inter',
			'st' => '700',
		],
		'sFont' => [
			'f' => 'Inter',
			'st' => '600',
		],
		'tFont' => [
			'f' => 'Inter',
			'st' => 'normal',
		],
		'aFont' => [
			'f' => 'Inter',
			'st' => '500',
		],
	);
	return wp_parse_args($settings, $default);
}

add_filter('uicore_settings_default_front', 'uicore_default_front_options');
function uicore_default_front_options($default) {
	$settings = [
		'pColor'					=> '#00B4BC',
		'sColor'					=> '#0B0A27',
		'aColor'					=> '#EA5246',
		'hColor'					=> '#282434',
		'bColor'					=> '#6E7A84',
		'dColor'					=> '#1D1D1F',
		'lColor'					=> '#F8FCFC',
		'logo'						=> 'https://level.uicore.co/layouts/wp-content/uploads/sites/20/2022/01/level-logo.png',
		'fav'						=> 'https://level.uicore.co/layouts/wp-content/uploads/sites/20/2022/01/level-favicon.png',
		'pagetitle_bg' 				=> [
			'type' 			=> 'solid',
			'solid' 		=> '#EDF6F7',
			'gradient' 		=> [
				'angle' 		=> '85',
				'color1' 		=> '#CBE7E5',
				'color2' 		=> '#FAF4F3',
			],
			'image' 		=> [
				'url' 			=> '',
				'attachment' 	=> 'scroll',
				'position' 		=> [
					'd' => 'bottom center',
					't' => 'center center',
					'm' => 'center center',
				],
				'repeat' 		=> 'no-repeat',
				'size' 			=> [
					'd' => 'cover',
					't' => 'cover',
					'm' => 'contain',
				],
			],
		],
		'pagetitle_color'			=> 'Dark Neutral'
	];
	return wp_parse_args($settings, $default);
}

//disable element pack self update
function ui_disable_plugin_updates( $value ) {

    $pluginsToDisable = [
        'bdthemes-element-pack/bdthemes-element-pack.php',
        'metform-pro/metform-pro.php'
    ];

    if ( isset($value) && is_object($value) ) {
        foreach ($pluginsToDisable as $plugin) {
            if ( isset( $value->response[$plugin] ) ) {
                unset( $value->response[$plugin] );
            }
        }
    }
    return $value;
}
add_filter( 'site_transient_update_plugins', 'ui_disable_plugin_updates' );
