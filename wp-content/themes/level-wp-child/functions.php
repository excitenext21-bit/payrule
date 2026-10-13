<?php

/**
 * Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UiCore
 */
defined('ABSPATH') || exit;

add_action( 'wp_enqueue_scripts', 'ui_child_enqueue_styles', 20 );
function ui_child_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.1' );

    // Ensure Elementor icon list widget styles are loaded on all pages for top header phone & email
    if ( defined( 'ELEMENTOR_ASSETS_URL' ) && defined( 'ELEMENTOR_VERSION' ) ) {
        wp_enqueue_style(
            'elementor-widget-icon-list',
            ELEMENTOR_ASSETS_URL . 'css/widget-icon-list.min.css',
            array(),
            ELEMENTOR_VERSION
        );
    }
}

// Automatically enforce clean SEO-friendly permalinks (/%postname%/) without requiring manual WP-admin configuration
add_action( 'init', function() {
    if ( get_option( 'permalink_structure' ) !== '/%postname%/' ) {
        global $wp_rewrite;
        update_option( 'permalink_structure', '/%postname%/' );
        if ( is_object( $wp_rewrite ) ) {
            $wp_rewrite->set_permalink_structure( '/%postname%/' );
            $wp_rewrite->flush_rules( false );
        }
    }
} );
