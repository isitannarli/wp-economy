<?php
/*
Plugin Name: WP Ekonomi
Plugin URI: #
Version: 1.0.0
Author: WP Ekonomi
Author URI: #
Description: WP Ekonomi Widgetları
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

/** Register Styles */
function my_head()
{
    echo "<link rel='stylesheet' href='" . plugins_url('/assets/css/main.css', __FILE__) . "' />";
}

add_action( 'wp_head', 'my_head' );

/** Register Scripts */
function my_footer()
{
    echo "<script type='text/javascript' src='" . plugins_url('/assets/js/lodash.min.js', __FILE__) . "'></script>";
    echo "<script type='text/javascript' src='" . plugins_url('/assets/js/functions.js', __FILE__) . "'></script>";
    echo "<script type='text/javascript' src='" . plugins_url('/assets/js/app.js', __FILE__) . "'></script>";
}

add_action('wp_footer', 'my_footer');

/** Include Files */
require_once('includes/doviz.php');
require_once('includes/altin.php');
require_once('includes/hisse.php');
require_once('includes/parite.php');
require_once('includes/parite_shortcode.php');

// Döviz Widget
function register_doviz_widget()
{
    register_widget('doviz');
}

add_action('widgets_init', 'register_doviz_widget');

// Altın Widget
function register_altin_widget()
{
    register_widget('altin');
}

add_action('widgets_init', 'register_altin_widget');

// Hisse Widget
function register_hisse_widget()
{
    register_widget('hisse');
}

add_action('widgets_init', 'register_hisse_widget');

// Parite Widget
function register_parite_widget()
{
    register_widget('parite');
}

add_action('widgets_init', 'register_parite_widget');