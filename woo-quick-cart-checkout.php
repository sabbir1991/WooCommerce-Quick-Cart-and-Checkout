<?php
/*
Plugin Name: WooCommerce Quick Cart and Checkout
Plugin URI: http://sabbir.pro/
Description: Instanct cart and checkout for customers
Version: 1.0.0
Author: Sabbir Ahmed
Author URI: http://sabbir.pro/
License: GPL2
*/

/**
 * Copyright (c) YEAR Sabbir Ahmed (email: sabbir@wedevs.com). All rights reserved.
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
class Woo_Quick_Cart_Checkout {

     /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.0';

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

        //includes file
        $this->includes();

        // init actions and filter
        $this->init_filters();
        $this->init_actions();

        // initialize classes
        $this->init_classes();

        do_action( 'woo_quick_cart_checkout_loaded', $this );
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
     * Placeholder for activation function
     *
     * Nothing being called here yet.
     */
    public static function activate() {

    }

    /**
     * Placeholder for deactivation function
     *
     * Nothing being called here yet.
     */
    public static function deactivate() {

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
    private function init_filters() {
        // Load all filters
    }

    /**
    * Init all actions
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function init_actions() {
        // Localize our plugin
        add_action( 'init', array( $this, 'localization_setup' ) );

        // Loads frontend scripts and styles
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'wp_footer', array( $this, 'load_template' ), 10 );
    }

    /**
    * Inistantiate all classes
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function init_classes() {
        // Create instnace for all class
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

    /**
     * Enqueue admin scripts
     *
     * @since 1.0.0
     *
     * Allows plugin assets to be loaded.
     *
     * @return void
     */
    public function enqueue_scripts() {

        wp_enqueue_style( 'wooqcc-styles', WOO_QUICK_CART_CHECKOUT_ASSETS . '/css/style.css', false, date( 'Ymd' ) );
        wp_enqueue_script( 'wooqcc-scripts', WOO_QUICK_CART_CHECKOUT_ASSETS . '/js/script.js', array( 'jquery' ), false, true );

        /**
         * Example for setting up text strings from Javascript files for localization
         *
         * Uncomment line below and replace with proper localization variables.
         */
        // $translation_array = array( 'some_string' => __( 'Some string to translate', 'baseplugin' ), 'a_value' => '10' );
        // wp_localize_script( 'base-plugin-scripts', 'baseplugin', $translation_array ) );
    }

    /**
     * Load template
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function load_template() {
        ?>
        <div class="cd-cart-container">
            <a href="#0" class="cd-cart-trigger">
                Cart
                <ul class="count"> <!-- cart items count -->
                    <li>0</li>
                    <li>0</li>
                </ul> <!-- .count -->
            </a>

            <div class="cd-cart">
                <div class="wrapper">
                    <header>
                        <h2>Cart</h2>
                        <span class="undo">Item removed. <a href="#0">Undo</a></span>
                    </header>

                    <div class="body">

                        <ul>
                            <?php foreach ( WC()->cart->get_cart_contents() as $key => $cart_item ): ?>

                            <?php endforeach ?>
                        </ul>
                    </div>

                    <footer>
                        <a href="#0" class="checkout btn"><em>Checkout - $<span>0</span></em></a>
                    </footer>
                </div>
            </div> <!-- .cd-cart -->
        </div> <!-- cd-cart-container -->
        <?php
    }

    /**
    * Load admin scripts
    *
    * @since 1.0.0
    *
    * @return void
    **/
    public function admin_enqueue_scripts( $hooks ) {
        // Load your admin scripts..
    }

} // Woo_Quick_Cart_Checkout

$woo_quick_cart_checkout = Woo_Quick_Cart_Checkout::init();

register_activation_hook( __FILE__, array( 'Woo_Quick_Cart_Checkout', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Woo_Quick_Cart_Checkout', 'deactivate' ) );
