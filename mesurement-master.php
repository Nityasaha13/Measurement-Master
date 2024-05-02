<?php
/*
Plugin Name: Measurement Master
Description: This plugin provides measurement functionalities.
Version: 1.0
Author: Nitya Saha
*/


register_activation_hook( __FILE__, 'measurement_master_activate' );
function measurement_master_activate() {

}

register_deactivation_hook( __FILE__, 'measurement_master_deactivate' );
function measurement_master_deactivate() {
    
}

require_once('includes/plugin-functions.php');

// Add a menu to the WordPress admin panel
function measurement_master_menu()
{
    add_menu_page(
        'Measurement Master',
        'Measurement Master',
        'manage_options',
        'measurement-master',
        'measurement_master_admin_page'
    );
    add_submenu_page(
        'measurement-master', // Use the parent menu slug here
        'Settings',
        'Settings', // Updated submenu title
        'manage_options',
        'measurement-master-setting', // Updated submenu slug
        'measurement_master_settings_page'
    );
}
add_action('admin_menu', 'measurement_master_menu');


function measurement_admin_enqueue_scripts() {
    $current_screen = get_current_screen();
    if ($current_screen->id === 'toplevel_page_measurement-master' || $current_screen->id === 'measurement-master-setting') {
        
        wp_enqueue_style('measurement-plugin-css', plugins_url('/assets/css/dashboard.css', __FILE__));
        wp_enqueue_script('measurement-plugin-js', plugins_url('/assets/js/script.js', __FILE__), array('jquery'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'measurement_admin_enqueue_scripts');


function measurement_enqueue_scripts(){
    
        wp_enqueue_style('product-page-css', plugins_url('/assets/css/product.css', __FILE__));
        wp_enqueue_script('product-js', plugins_url('/assets/js/product.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts','measurement_enqueue_scripts');


function measurement_master_register_settings() {
    register_setting( 'measurement_master_options', 'enable_plugin' );
}
add_action( 'admin_init', 'measurement_master_register_settings' );


// Function to handle saving of settings
function measurement_master_save_settings() {
    if ( isset( $_POST['save_plugin_settings'] ) ) {
        update_option( 'enable_plugin', isset( $_POST['enable_plugin'] ) ? 'on' : 'off' );
    }
}
add_action( 'admin_post_save_plugin_settings', 'measurement_master_save_settings' );


// Callback function for Measurement Master admin page
function measurement_master_admin_page() {
    ?>
    <div class="wrap">
        <h2>Dashboard</h2>
        <p>Welcome to Measurement Master!</p>
        <p>[Note:This plugin will a custom field to your custom single product page. This allows you add custom mesurements in a dress for your customer.]</p>
        <form method="post" action="">
            <?php settings_fields( 'measurement_master_options' ); ?>
            <div class="settings-button">
                <div class="input-field">
                    <input type="checkbox" name="enable_plugin" id="enable-btn" class="enable-btn" <?php checked( get_option( 'enable_plugin' ), 'on' ); ?>>
                    <label for="enable-btn" class="enable-btn-label">Enable this plugin</label>
                </div>
                <div class="submit-btn">
                    <input type="submit" value="Save" class="button-primary" name="save_plugin_settings">
                </div>
            </div>
        </form>
    </div>
    <?php
}

// Callback function for Measurement Master settings page
function measurement_master_settings_page() {
    ?>
    <div class="wrap">
        <h2>Measurement Settings</h2>
        <p>Welcome to Measurement Master settings page!</p>
    </div>
    <?php
}