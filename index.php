
<?php
/*
Plugin Name: WP Economy
Plugin URI: http://github.com/isitannarli
Version: 1.0.0
Author: Ahmet Işıtan Narlı
Author URI: http://github.com/isitannarli
Description: Economy Widget & Shortcode plugin for Wordpress
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('includes/parity.php');

// register widgets
function register_parity_widget() {
  register_widget( 'parity' );
}

add_action( 'widgets_init', 'register_parity_widget' );

// add_action( 'wp_head', 'my_facebook_tags' );
// function my_facebook_tags() {
//   echo '<script src="' . the_permalink() . '/wp-content/plugins/wp-economy/assets/js/app.js"></script>';
// }





add_action( 'wp_enqueue_scripts', 'my_enqueued_assets' );

function my_enqueued_assets() {
  wp_enqueue_script( 'app', plugin_dir_url( __FILE__ ) . 'assets/js/app.js', array( 'jquery' ), '1.0', true );
}
