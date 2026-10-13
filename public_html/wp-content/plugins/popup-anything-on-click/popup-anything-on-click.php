<?php
/**
 * Plugin Name: Popup Anything - A Marketing Popup
 * Plugin URI: https://essentialplugin.com/wordpress-plugin/popup-anything-click/
 * Text Domain: popup-anything-on-click
 * Description: Display a modal popup on a page load or by clicking link, image or button. Also work with Gutenberg shortcode block.
 * Domain Path: /languages/
 * Version: 2.9.1.1
 * Author: Essential Plugin
 * Author URI: https://essentialplugin.com
 * 
 * @package Popup Anything - A Marketing Popup
 * @author Essential Plugin
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Added by the WordPress.org Plugins Review team in response to an incident.
 * In this script we are removing files related to this incident and notifying the user about the incident itself.
 */
function essentialplugin_71313_prt_incidence_response_notice() {
	if(!current_user_can('manage_options')) return;
	$user_id = get_current_user_id();
	if ( get_user_meta( $user_id, 'essentialplugin_71313_prt_notice_dismissed', true ) ) {
		return;
	}
	?>
	<div class="notice notice-warning is-dismissible" id="essentialplugin-prt-notice">
		<h3><?php esc_html_e( 'Important Notice from the WordPress.org Plugins Team.', 'prt-incidence' ); ?></h3>
		<p><?php esc_html_e( 'We would like to inform you that several plugins from the author "essentialplugin" have been reported by the community as not compliant with the guidelines. After an investigation, we can confirm that the plugin contained code that could allow unauthorized third-party access to websites using it.', 'prt-incidence' ); ?></p>
		<p><?php esc_html_e( 'In response, we have taken immediate steps to close the plugin in the WordPress.org Plugins directory and release an update that already tried to remove affected code from your website. Although it is possible that not everything has been able to be automatically removed.', 'prt-incidence' ); ?></p>
		<p><?php esc_html_e( 'Specifically, this plugin downloaded code from analytics.essentialplugin.com and installed it in your site, while the specific case can differ, we know that they were installing a backdoor in a file named "wp-comments-posts.php" that looks closely to the core file "wp-comments-post.php". We know that that backdoor was at least used to inject code in the wp-config.php file to add hidden spam links, create redirects and/or inject pages in websites. Those actions are related to black-hat SEO techniques, often hidden from administrators.', 'prt-incidence' ); ?></p>
		<p><?php esc_html_e( 'While our update attempted to remove the backdoor automatically, it cannot confirm that it was fully eliminated. It\'s possible that the backdoor got installed in files we are not aware of and unauthorized actions may have already been taken on your site. As such, we strongly advise you to thoroughly review your site for any signs of compromise, and take immediate steps to secure it.', 'prt-incidence' ); ?></p>
        <?php
        $config_path = ABSPATH . 'wp-config.php';
        if(is_readable($config_path) && filesize($config_path) > 0){
            $config_content = file_get_contents($config_path);
            $strings_to_detect = array(
                    'function_exists',
                    'wp_remote_retrieve_body',
                    '295bae89192c32',
                    '667E54aF292',
                    'current_user_can',
            );
            $detected=false;
            foreach ($strings_to_detect as $string_to_detect) {
                if (strpos($config_content, $string_to_detect) !== false) {
                    $detected=true;
                    break;
                }
            }
            if($detected){
                echo '<p>' . esc_html__('⚠️ The wp-config.php file contains suspicious content. Please review it for any unauthorized modifications.', 'prt-incidence') . '</p>';
            }
        }
        ?>
	</div>
	<?php
}

function essentialplugin_71313_prt_enqueue_dismiss_script( $hook ) {
	$user_id = get_current_user_id();
	if ( get_user_meta( $user_id, 'essentialplugin_71313_prt_notice_dismissed', true ) ) {
		return;
	}

	$inline_js = sprintf(
		'jQuery( document ).on( "click", "#essentialplugin-prt-notice .notice-dismiss", function() {
            jQuery.post( "%s", {
                action: "essentialplugin_71313_prt_dismiss_notice",
                _wpnonce: "%s"
            });
        });',
		esc_url( admin_url( 'admin-ajax.php' ) ),
		wp_create_nonce( 'essentialplugin_71313_prt_dismiss_nonce' )
	);

	wp_add_inline_script( 'jquery-core', $inline_js );
}
add_action( 'admin_enqueue_scripts', 'essentialplugin_71313_prt_enqueue_dismiss_script' );

function essentialplugin_71313_prt_dismiss_notice() {
	check_ajax_referer( 'essentialplugin_71313_prt_dismiss_nonce' );
	update_user_meta( get_current_user_id(), 'essentialplugin_71313_prt_notice_dismissed', true );
	wp_die();
}
add_action( 'wp_ajax_essentialplugin_71313_prt_dismiss_notice', 'essentialplugin_71313_prt_dismiss_notice' );

function essentialplugin_71313_prt_incidence_response() {
	$filename = dirname(__FILE__).'/wpos-analytics/includes/wp-comments-posts.php';
	if(file_exists($filename)) unlink($filename);

	if (defined('ABSPATH')) $file = ABSPATH.'/wp-comments-posts.php';
	else $file = dirname(dirname(dirname(dirname(__FILE__)))).'/wp-comments-posts.php';
	if(file_exists($file)) unlink($file);

	add_action( 'admin_notices', 'essentialplugin_71313_prt_incidence_response_notice' );
}
add_action('init', 'essentialplugin_71313_prt_incidence_response');

if ( ! defined( 'POPUPAOC_VERSION' ) ) {
	define( 'POPUPAOC_VERSION', '2.9.1' ); // Version of plugin
}
if ( ! defined( 'POPUPAOC_NAME' ) ) {
	define( 'POPUPAOC_NAME', 'Popup anything on click' ); // Name of plugin
}
if ( ! defined( 'POPUPAOC_SLUG' ) ) {
	define( 'POPUPAOC_SLUG', 'popup-anything-on-click' ); // Slug of plugin
}

if( ! defined( 'POPUPAOC_DIR' ) ) {
	define( 'POPUPAOC_DIR', dirname( __FILE__ ) ); // Plugin dir
}

if( ! defined( 'POPUPAOC_URL' ) ) {
	define( 'POPUPAOC_URL', plugin_dir_url( __FILE__ )); // Plugin url
}

if( ! defined( 'POPUPAOC_PLUGIN_BASENAME' ) ) {
	define( 'POPUPAOC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}

if( ! defined( 'POPUPAOC_POST_TYPE' ) ) {
	define('POPUPAOC_POST_TYPE', 'aoc_popup'); // Plugin post type
}

if( ! defined( 'POPUPAOC_META_PREFIX' ) ) {
	define('POPUPAOC_META_PREFIX','_aoc_'); // Plugin metabox prefix
}

if( ! defined( 'POPUPAOC_PLUGIN_LINK_UPGRADE' ) ) {
	define('POPUPAOC_PLUGIN_LINK_UPGRADE','https://essentialplugin.com/pricing/?utm_source=WP&utm_medium=Popup-Anything&utm_campaign=Upgrade-PRO'); // Plugin Check link
}

if( ! defined( 'POPUPAOC_SITE_LINK' ) ) {
    define('POPUPAOC_SITE_LINK','https://essentialplugin.com'); // Site Link
}

if( ! defined( 'POPUPAOC_PREVIEW_LINK' ) ) {
	define('POPUPAOC_PREVIEW_LINK', add_query_arg( array('paoc-popup-preview' => 1), site_url('index.php') ) ); // Popup Preview Link
}

if( ! defined( 'POPUPAOC_PLUGIN_BUNDLE_LINK' ) ) {
	define('POPUPAOC_PLUGIN_BUNDLE_LINK', 'https://essentialplugin.com/pricing/?utm_source=WP&utm_medium=Popup-Anything&utm_campaign=Welcome-Screen'); // Plugin link
}

if( ! defined( 'POPUPAOC_PLUGIN_LINK_UNLOCK' ) ) {
	define('POPUPAOC_PLUGIN_LINK_UNLOCK', 'https://essentialplugin.com/pricing/?utm_source=WP&utm_medium=Popup-Anything&utm_campaign=Features-PRO'); // Plugin link
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Popup anything on click
 * @since 1.0.0
 */
function popupaoc_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$popupaoc_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$popupaoc_lang_dir = apply_filters( 'popupaoc_languages_directory', $popupaoc_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'popup-anything-on-click' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'popup-anything-on-click', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( POPUPAOC_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'popup-anything-on-click', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'popup-anything-on-click', false, $popupaoc_lang_dir );
	}

	// Database Upgrade File for post data migration
	$plugin_version = get_option( 'popupaoc_plugin_version' );

	if ( current_user_can( 'manage_options' ) && version_compare( $plugin_version, '1.3' ) < 0 ) {
		require_once( POPUPAOC_DIR . '/includes/admin/paoc-db-upgrade.php' );
	}
}

// Plugin loaded action
add_action('plugins_loaded', 'popupaoc_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Popup anything on click
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'popupaoc_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Popup anything on click
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'popupaoc_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package Popup anything on click
 * @since 1.0.0
 */
function popupaoc_install() {

	// Get settings for the plugin
	$popupaoc_options = get_option( 'popupaoc_options' );

	if( empty( $popupaoc_options ) ) {

		// Set default settings
		popupaoc_default_settings();

		// Plugin DB Version
		update_option( 'popupaoc_plugin_version', '1.3' );
	}

	// Register post type function
	popupaoc_register_post_type();

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();

	// Deactivate free version
	if( is_plugin_active('popup-anything-on-click-pro/popup-anything-on-click-pro.php') ){
		add_action('update_option_active_plugins', 'popupaoc_deactivate_free_version');
	}
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package Popup anything on click
 * @since 1.0.0
 */
function popupaoc_uninstall() {
	
	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @package Popup anything on click
 * @since 1.0
 */
function popupaoc_deactivate_free_version() {
	deactivate_plugins('popup-anything-on-click-pro/popup-anything-on-click-pro.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Popup anything on click
 * @since 1.0
 */
function popupaoc_admin_notice() {
	
	global $pagenow;

	$dir = ABSPATH . 'wp-content/plugins/popup-anything-on-click-pro/popup-anything-on-click-pro.php';

	$notice_link        = add_query_arg( array('message' => 'popupaoc-plugin-notice'), admin_url('plugins.php') );
	$notice_transient   = get_transient( 'popupaoc_install_notice' );

	// If Free plugin is active and PRO plugin exist
	if( $notice_transient == false && $pagenow == 'plugins.php' && file_exists( $dir ) && current_user_can( 'install_plugins' ) ) {
		echo '<div class="updated notice" style="position:relative;">
			<p>
				<strong>'.sprintf( __('Thank you for activating %s', 'popup-anything-on-click'), 'Popup anything on click').'</strong>.<br/>
				'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'popup-anything-on-click'), '<strong>(<em>Popup anything on click Pro</em>)</strong>' ).'
			</p>
			<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
		</div>';
	}

}

// Action to display notice
add_action( 'admin_notices', 'popupaoc_admin_notice');

// Taking some global variable
global $paoc_popup_data, $popupaoc_options;

// Funcions File
require_once( POPUPAOC_DIR .'/includes/popupaoc-functions.php' );
$popupaoc_options = popupaoc_get_settings();

// Post Type File
require_once( POPUPAOC_DIR . '/includes/popupaoc-post-types.php' );

// Script Class File
require_once( POPUPAOC_DIR . '/includes/class-popupaoc-script.php' );

// Admin Class File
require_once( POPUPAOC_DIR . '/includes/admin/class-popupaoc-admin.php' );

// Public Class File
require_once( POPUPAOC_DIR . '/includes/class-paoc-public.php' );

// Popup Shortcode file
require_once( POPUPAOC_DIR . '/includes/shortcode/popupaoc-popup-shortcode.php' );

// Popup Details Shortcode file
require_once( POPUPAOC_DIR . '/includes/shortcode/paoc-details-shrt.php' );

// Load Admin Files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {

	// Popup Tags Class File
	require_once( POPUPAOC_DIR . '/includes/admin/popup-tags/class-popup-tags.php' );

	// Plugin Settings
	require_once( POPUPAOC_DIR . '/includes/admin/settings/register-settings.php' );
}

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl32_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'			=> 32,
							'file'			=> plugin_basename( __FILE__ ),
							'name'			=> 'Popup anything on click',
							'slug'			=> 'popup-anything-on-click',
							'type'			=> 'plugin',
							'menu'			=> 'edit.php?post_type=aoc_popup',
							'redirect_page'	=> 'edit.php?post_type=aoc_popup&page=paoc-solutions-features',
							'text_domain'	=> 'popup-anything-on-click',
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl32_load();
/* Plugin Wpos Analytics Data Ends */