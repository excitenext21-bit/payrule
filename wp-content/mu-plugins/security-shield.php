<?php
/**
 * Plugin Name: Payrule Security Shield
 * Description: Essential security hardening - blocks XML-RPC, user enumeration, login probing, and generator leaks.
 * Version: 1.0.0
 * Author: Payrule Security
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Completely Disable XML-RPC (Prevents brute-force amplification and DDoS)
add_filter('xmlrpc_enabled', '__return_false');
add_filter('xmlrpc_methods', '__return_empty_array');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// 2. Block REST API User Enumeration for Anonymous Visitors
add_filter('rest_endpoints', function($endpoints) {
    if (!is_user_logged_in()) {
        if (isset($endpoints['/wp/v2/users'])) {
            unset($endpoints['/wp/v2/users']);
        }
        if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
            unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
        }
    }
    return $endpoints;
});

// 3. Remove WordPress Version Leakage (Prevents version-specific vulnerability scans)
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// 4. Obscure Login Errors (Prevents username enumeration on wp-login.php)
add_filter('login_errors', function() {
    return 'Invalid login credentials.';
});

// 5. Disable Pingbacks
add_filter('pings_open', '__return_false', 9999);

// 6. Prevent external telemetry timeouts when running locally
if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    add_filter('pre_http_request', function($preempt, $parsed_args, $url) {
        if (strpos($url, 'rest-hosting.hostinger.com') !== false || strpos($url, 'amplitude.com') !== false) {
            return array(
                'response' => array('code' => 200, 'message' => 'OK'),
                'body'     => '{}'
            );
        }
        return $preempt;
    }, 10, 3);
}

