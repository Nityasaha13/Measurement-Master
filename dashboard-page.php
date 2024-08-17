<?php

if ( ! defined( 'ABSPATH' ) ) exit;

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


// Register setting and sanitize
function measurement_master_register_settings()
{
    register_setting('measurement_master_options', 'enable_plugin');
}
add_action('admin_init', 'measurement_master_register_settings');