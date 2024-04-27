<?php
/**
 * Plugin Name: WP Nexpress Plugin
 * Description: This plugin provides additional functionality to WordPress using the Nexpress API.
 * Version: 0.1
 * Author: Gary Dubb
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The main plugin class for WP Nexpress Plugin.
 */
class WP_Nexpress_Plugin {
    /**
     * Constructor function for WP_Nexpress_Plugin.
     * Includes the necessary files for the plugin.
     */
    public function __construct() {
        // Include the Wordpress Files
        require_once plugin_dir_path(__FILE__) . 'inc/wordpress/np-wp-menus.php';

        // Include the Nexpress API Files for Woocommerce
        require_once plugin_dir_path(__FILE__) . 'inc/woocommerce/np-wc-settings.php';
    }
}

new WP_Nexpress_Plugin();