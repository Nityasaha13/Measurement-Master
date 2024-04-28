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


// Add a menu to the WordPress admin panel
function appycodes_leads_menu()
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
add_action('admin_menu', 'appycodes_leads_menu');

// Callback function for Measurement Master admin page
function measurement_master_admin_page() {
    ?>
    <div class="wrap">
        <h2>Dashboard</h2>
        <p>Welcome to Measurement Master Dashboard!</p>
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
