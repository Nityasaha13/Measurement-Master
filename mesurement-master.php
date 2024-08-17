<?php
/*
Plugin Name: Measurement Master
Plugin URI:        https://codesocials.com/measurement-master/
Description: This plugin provides measurement functionalities for your shop or fashion store.
Version: 1.0
Author: Nitya Saha
Author URI:        https://codesocials.com/nitya-gopal-saha/
*/


require_once('includes/components/human-body.php');


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


// Add admin notice
add_action('admin_notices', 'measurement_master_activate_admin_notice');

/**
 * Admin Notice on Activation.
 */
function measurement_master_activate_admin_notice() {
    // Check transient, if available display notice
    if (get_transient('measurement-master-activation-notice')) {
        ?>
        <div class="updated notice is-dismissible">
            <p><?php esc_html_e('Enable the measurement settings plugin from Measurement Master settings page.', 'plugin-text-domain'); ?></p>
        </div>
        <?php
        // Delete transient, only display this notice once
        delete_transient('measurement-master-activation-notice');
    }
}


//Check the functionality is on or not, if on than it will show in the product page
$plugin_enabled = get_option('enable_plugin');
if ($plugin_enabled == "on") {
    require_once('includes/plugin-functions.php');
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

// Enqueue style and scripts in plugin admin pages
function measurement_admin_enqueue_scripts()
{
    $current_screen = get_current_screen();
    if ($current_screen->id === 'toplevel_page_measurement-master' || $current_screen->id === 'measurement-master-setting') {

        wp_enqueue_style('measurement-plugin-css', plugins_url('/assets/css/dashboard.css', __FILE__));
        wp_enqueue_script('measurement-plugin-js', plugins_url('/assets/js/script.js', __FILE__), array('jquery'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'measurement_admin_enqueue_scripts');

// Enqueue scripts and styles in frontend
function measurement_enqueue_scripts()
{

    wp_enqueue_style('product-page-css', plugins_url('/assets/css/product.css', __FILE__));
    wp_enqueue_script('product-js', plugins_url('/assets/js/product.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'measurement_enqueue_scripts');


// Register setting and sanitize
function measurement_master_register_settings()
{
    register_setting('measurement_master_options', 'enable_plugin');
}
add_action('admin_init', 'measurement_master_register_settings');


// Callback function for Measurement Master admin page
function measurement_master_admin_page()
{
?>
    <div class="wrap">
        <h2>Dashboard</h2>
        <p>Welcome to Measurement Master!</p>
        <p>Note: This plugin will add a custom field to your custom single product page. This allows you to add custom measurements in a dress for your customer.</p>
        <form method="post" action="options.php">
            <?php settings_fields('measurement_master_options'); ?>
            <div class="settings-button">
                <div class="input-field">
                    <input type="checkbox" name="enable_plugin" id="enable-btn" class="enable-btn" <?php checked(get_option('enable_plugin'), 'on'); ?>>
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


// Function to handle saving of settings
function measurement_master_save_settings()
{
    if (isset($_POST['save_plugin_settings'])) {
        update_option('enable_plugin', isset($_POST['enable_plugin']) ? 'on' : 'off');
    }
}
add_action('admin_post_save_plugin_settings', 'measurement_master_save_settings');


// Callback function for Measurement Master settings page
function measurement_master_settings_page()
{
?>
    <div class="wrap">
        <h2>Measurement Settings</h2>
        <p>Welcome to Measurement Master settings page!</p>
    </div>
<?php
}

