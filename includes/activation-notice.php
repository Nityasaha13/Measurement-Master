<?php

if ( ! defined( 'ABSPATH' ) ) exit;


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