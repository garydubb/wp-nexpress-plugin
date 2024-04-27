<?php

/**
 * Class Nexpress_WC_Settings
 * 
 * This class handles the settings for the Nexpress plugin in WooCommerce.
 */

class Nexpress_WC_Settings {

    /**
     * Nexpress_WC_Settings constructor.
     * 
     * Initializes the class and sets up the necessary hooks.
     */
    public function __construct() {
        add_filter('woocommerce_settings_tabs_array', array($this, 'add_settings_tab'), 50);
        add_action('woocommerce_settings_tabs_nexpress', array($this, 'settings_tab'));
        add_action('woocommerce_update_options_nexpress', array($this, 'settings_save'));
        add_action('graphql_register_types', array($this, 'register_graphql_field'));
    }

    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     * 
     * @param array $settings_tabs The existing settings tabs array.
     * @return array The updated settings tabs array.
     */
    public function add_settings_tab($settings_tabs) {
        $settings_tabs['nexpress'] = __('Nexpress', 'woocommerce');
        return $settings_tabs;
    }

    /**
     * Uses the WooCommerce admin fields API to output settings.
     */
    public function settings_tab() {
        woocommerce_admin_fields($this->get_settings());
    }

    /**
     * Save settings.
     */
    public function settings_save() {
        woocommerce_update_options($this->get_settings());
    }

    /**
     * Get all settings for the settings tab.
     * 
     * @return array The settings array.
     */
    public function get_settings() {
        $settings = array(
            'section_title' => array(
                'name'     => __('Nexpress Settings', 'woocommerce'),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_nexpress_section_title'
            ),
            'header_text' => array(
                'name' => __('Header', 'woocommerce'),
                'type' => 'text',
                'desc' => __('Update text here for theme header.', 'woocommerce'),
                'id'   => 'wc_nexpress_header_text'
            ),
            'footer_text' => array(
                'name' => __('Footer Text', 'woocommerce'),
                'type' => 'text',
                'desc' => __('This is the footer text.', 'woocommerce'),
                'id'   => 'wc_nexpress_footer_text'
            ),
            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wc_nexpress_section_end'
            )
        );
        return apply_filters('wc_nexpress_settings', $settings);
    }

    /**
     * Register GraphQL field.
     */
    public function register_graphql_field() {
        register_graphql_object_type('Nexpress', [
            'description' => __('Nexpress settings', 'your-textdomain'),
            'fields' => [
                'headerText' => [
                    'type' => 'String',
                    'description' => __('Header Text from Nexpress settings', 'your-textdomain'),
                    'resolve' => function() {
                        return get_option('wc_nexpress_header_text');
                    },
                ],
                'footerText' => [
                    'type' => 'String',
                    'description' => __('Footer Text from Nexpress settings', 'your-textdomain'),
                    'resolve' => function() {
                        return get_option('wc_nexpress_footer_text');
                    },
                ],
            ],
        ]);
    
        register_graphql_field('RootQuery', 'nexpress', [
            'type' => 'Nexpress',
            'description' => __('Nexpress settings', 'your-textdomain'),
            'resolve' => function() {
                // Return a non-null value to resolve the 'nexpress' field.
                // The 'header_text' and 'footer_text' fields will be resolved separately.
                return [];
            },
        ]);
    }

}

new Nexpress_WC_Settings();
