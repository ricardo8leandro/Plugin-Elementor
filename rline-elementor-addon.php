<?php

/**

* Plugin Name: RLine Elementor Widget

* Plugin URI: RIC

* Description: Nessessário para o funcionamento dos elementos do Elementor

* Author: Jonatas Arão

* Version: 1.0

* Author URI: http://github.com/Jonatas-Arao/

*/

 

if ( ! defined( 'ABSPATH' ) ) {

    exit; // Exit if accessed directly.

}

 

function rline_elementor_addon() {

 

    // Load plugin file

    require_once( __DIR__ . '/includes/plugin.php' );

 

    // Run the plugin

    \Rline_Elementor_Addon\Plugin::instance();

 

}

add_action( 'plugins_loaded', 'rline_elementor_addon' );