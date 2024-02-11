<?php
add_action('admin_menu', 'wp_webp_images_settings_menu');

// Function to create the settings page
function wp_webp_images_settings_menu() {
    add_options_page(
        'WP Webp Images Settings', // Page title
        'WP Webp Images', // Menu title
        'manage_options', // Capability required to access the page
        'wp-webp-images-settings', // Page slug
        'wp_webp_images_settings_page' // Callback function to render page content
    );
}

// Function to render the settings page
function wp_webp_images_settings_page() {
    ?>
    <div class="wrap">
        <h2>WP Webp Images Settings</h2>
        <form method="post" action="options.php">
            <?php
            // Output hidden fields for security
            settings_fields('wp_webp_images_settings_group');
            do_settings_sections('wp-webp-images-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}