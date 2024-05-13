<?php
/*
 * Plugin Name: Daoine - Simplify Registration
 * Plugin URI: https://redvilla.tech/apps/plugins/daoine-simplify-registration
 * Description: Daoine is a Lightweight WordPress and WooCommerce plugin that simplifies the sign-up process for onboarding new customers and users.
 * Author: RedVilla Plugins
 * Author URI: https://redvilla.tech/creator/redvilla-plugins
 * Version: 1.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: daoine-simplify-registration
 */

add_filter( 'woocommerce_min_password_strength', 'custom_password_strength' );

function custom_password_strength() {
    return 'medium';
}

// Check Check New Updates
function daoine_simplify_registration_update_check() {
    $plugin_info = get_plugin_data( __FILE__ );
    $current_version = $plugin_info['Version'];

    $remote_version = get_transient( 'daoine_simplify_registration_update_check' );

    if ( false === $remote_version ) {
        $api_args = array(
            'slug' => plugin_basename( __FILE__ ),
            'version' => $current_version,
            'author' => $plugin_info['Author'],
        );
        $request = wp_remote_post( 'https://codex.wordpress.org/WordPress.org_API', array( 'body' => $api_args ) );

        if ( ! is_wp_error( $request ) ) {
            $response = json_decode( wp_remote_retrieve_body( $request ) );
            if ( isset( $response->new_version ) && $response->new_version > $current_version ) {
                set_transient( 'daoine_simplify_registration_update_check', $response->new_version, DAY_IN_SECONDS ); // Update check every day
            }
        }
    }
}
add_filter( 'plugins_api', 'daoine_simplify_registration_update_check', 10, 2 );
