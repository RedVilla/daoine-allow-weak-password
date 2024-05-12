<?php
/*
 * Plugin Name: Daoine - Allow Weak Password
 * Plugin URI: https://redvilla.tech/apps/plugins/daoine-allow-weak-passwords
 * Description: Daoine is a Lightweight plugin to allow users to add weak passwords on WordPress and WooCommerce websites.
 * Author: RedVilla Plugins
 * Author URI: https://redvilla.tech/creator/redvilla-plugins
 * Version: 1.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: daoin-allow-weak-password
 */

add_filter( 'woocommerce_min_password_strength', 'custom_password_strength' );

function custom_password_strength() {
    return 'medium';
}