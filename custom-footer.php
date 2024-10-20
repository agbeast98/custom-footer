<?php
/*
Plugin Name: Custom Footer
Description: Adds a customizable footer to all pages.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
// Add admin menu
add_action('admin_menu', 'custom_footer_menu');

function custom_footer_menu() {
    add_menu_page(
        'Custom Footer Settings',
        'Footer Settings',
        'manage_options',
        'custom-footer-settings',
        'custom_footer_settings_page',
        'dashicons-admin-generic'
    );
}

function custom_footer_settings_page() {
    ?>
    <div class="wrap">
        <h1>Custom Footer Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('footer_settings_group');
            do_settings_sections('custom-footer-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
add_action('admin_init', 'custom_footer_settings_init');

function custom_footer_settings_init() {
    register_setting('footer_settings_group', 'footer_text_1');
    register_setting('footer_settings_group', 'footer_text_2');
    register_setting('footer_settings_group', 'footer_text_3');

    add_settings_section(
        'footer_settings_section',
        'Footer Text Settings',
        null,
        'custom-footer-settings'
    );

    add_settings_field(
        'footer_text_1',
        'Footer Text 1',
        'footer_text_1_render',
        'custom-footer-settings',
        'footer_settings_section'
    );

    add_settings_field(
        'footer_text_2',
        'Footer Text 2',
        'footer_text_2_render',
        'custom-footer-settings',
        'footer_settings_section'
    );

    add_settings_field(
        'footer_text_3',
        'Footer Text 3',
        'footer_text_3_render',
        'custom-footer-settings',
        'footer_settings_section'
    );
}

function footer_text_1_render() {
    $value = get_option('footer_text_1', '');
    echo '<input type="text" name="footer_text_1" value="' . esc_attr($value) . '" />';
}

function footer_text_2_render() {
    $value = get_option('footer_text_2', '');
    echo '<input type="text" name="footer_text_2" value="' . esc_attr($value) . '" />';
}

function footer_text_3_render() {
    $value = get_option('footer_text_3', '');
    echo '<input type="text" name="footer_text_3" value="' . esc_attr($value) . '" />';
}
// Display the footer
add_action('wp_footer', 'custom_footer_display');

function custom_footer_display() {
    $footer_text_1 = get_option('footer_text_1', '');
    $footer_text_2 = get_option('footer_text_2', '');
    $footer_text_3 = get_option('footer_text_3', '');
    echo '<div class="custom-footer">';
    echo '<p>' . esc_html($footer_text_1) . '</p>';
    echo '<p>' . esc_html($footer_text_2) . '</p>';
    echo '<p>' . esc_html($footer_text_3) . '</p>';
    echo '</div>';
}

// Add styles
add_action('wp_head', 'custom_footer_styles');

function custom_footer_styles() {
    echo '
    <style>
    .custom-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px 0;
    }
    </style>
    ';
}