<?php

/**
 * Registers custom post types and menus for the Nexpress plugin.
 */
class Nexpress_Custom_Post_Type {
    public function __construct() {
        add_action('init', array($this, 'register_custom_post_type'));
    }

    public function register_custom_post_type() {
        register_nav_menus(
            array(
                'PRIMARY' => __( 'PRIMARY MENU' ),
                'FOOTER' => __( 'FOOTER MENU' )
            )
        );
    }
}

new Nexpress_Custom_Post_Type();