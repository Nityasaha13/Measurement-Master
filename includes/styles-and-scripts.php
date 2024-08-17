<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// Enqueue style and scripts in plugin admin pages
function measurement_admin_enqueue_scripts()
{
    $current_screen = get_current_screen();
    if ($current_screen->id === 'toplevel_page_measurement-master' || $current_screen->id === 'measurement-master-setting') {

        wp_enqueue_style('measurement-plugin-css', plugins_url('../assets/css/dashboard.css', __FILE__));
        wp_enqueue_script('measurement-plugin-js', plugins_url('../assets/js/script.js', __FILE__), array('jquery'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'measurement_admin_enqueue_scripts');


// Enqueue scripts and styles in frontend
function measurement_enqueue_scripts()
{

    wp_enqueue_style('product-page-css', plugins_url('../assets/css/product.css', __FILE__));
    wp_enqueue_script('product-js', plugins_url('../assets/js/product.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'measurement_enqueue_scripts');