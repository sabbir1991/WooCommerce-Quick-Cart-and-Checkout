<?php
/*
Plugin Name: WooCommerce Quick Cart and Checkout
Plugin URI: http://sabbir.pro/
Description: Instant cart and checkout for customers
Version: 1.0.0
Author: Sabbir Ahmed
Author URI: http://sabbir.pro/
License: GPL2
*/

/**
 * Copyright (c) YEAR Sabbir Ahmed (email: sabbir.081070@gmail.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Woo_Quick_Cart_Checkout class
 *
 * @class Woo_Quick_Cart_Checkout The class that holds the entire Woo_Quick_Cart_Checkout plugin
 */
final Woo_Quick_Cart_Checkout {

     /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * Minimum PHP version required
     *
     * @var string
     */
    private $min_php = '5.6.0';

    /**
     * Constructor for the Woo_Quick_Cart_Checkout class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @uses register_activation_hook()
     * @uses register_deactivation_hook()
     * @uses is_admin()
     * @uses add_action()
     */
    public function __construct() {

        // Define all constant
        $this->define_constant();

        if ( ! $this->is_supported_php() ) {
            return;
        }

        add_action( 'woocommerce_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Initializes the Woo_Quick_Cart_Checkout() class
     *
     * Checks for an existing Woo_Quick_Cart_Checkout() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new Woo_Quick_Cart_Checkout();
        }

        return $instance;
    }

    /**
    * Defined constant
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function define_constant() {
        define( 'WOO_QUICK_CART_CHECKOUT_VERSION', $this->version );
        define( 'WOO_QUICK_CART_CHECKOUT_FILE', __FILE__ );
        define( 'WOO_QUICK_CART_CHECKOUT_PATH', dirname( WOO_QUICK_CART_CHECKOUT_FILE ) );
        define( 'WOO_QUICK_CART_CHECKOUT_ASSETS', plugins_url( '/assets', WOO_QUICK_CART_CHECKOUT_FILE ) );
    }

    /**
     * Check if the PHP version is supported
     *
     * @return bool
     */
    public function is_supported_php() {
        if ( version_compare( PHP_VERSION, $this->min_php, '<=' ) ) {
            return false;
        }

        return true;
    }

    /**
     * Init plugin files after loaded WooCommerce
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init_plugin() {
        $this->includes();

        $this->init_hooks();

        do_action( 'woo_quick_cart_checkout_loaded', $this );
    }
    /**
    * Includes all files
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function includes() {
        // Includes all files in your plugins
    }

    /**
    * Init all filters
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function init_hooks() {
        // Localize our plugin
        add_action( 'init', array( $this, 'localization_setup' ) );
        add_action( 'init', array( $this, 'init_classes' ) );
    }

    /**
    * Init all actions
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function init_classes() {

    }

    /**
     * Initialize plugin for localization
     *
     * @since 1.0.0
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup() {
        load_plugin_textdomain( 'woo-quick-cart-checkout', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

}

$woo_quick_cart_checkout = Woo_Quick_Cart_Checkout::init();
