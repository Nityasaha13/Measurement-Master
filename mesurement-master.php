<?php
/*
Plugin Name: Measurement Master
Plugin URI:        https://codesocials.com/measurement-master/
Description: This plugin provides measurement functionalities for your shop or fashion store.
Version: 1.0
Author: Nitya Saha
Author URI:        https://codesocials.com/nitya-gopal-saha/
*/

if ( ! defined( 'ABSPATH' ) ) exit;

require_once('components/human-body.php');
require_once('includes/activation-notice.php');
require_once('includes/styles-and-scripts.php');
require_once('includes/the-measurement-form.php');
require_once('settings-page.php');
require_once('dashboard-page.php');


register_activation_hook(__FILE__, 'measurement_master_activate');
function measurement_master_activate()
{
    // Create transient data for activation notice
    set_transient('measurement-master-activation-notice', true, 5);
}

register_deactivation_hook(__FILE__, 'measurement_master_deactivate');
function measurement_master_deactivate()
{
}


//Check the functionality is on or not, if on than it will show in the product page
$plugin_enabled = get_option('enable_plugin');
if ($plugin_enabled == "on") {
    require_once('includes/plugin-functions-setting.php');
}


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

