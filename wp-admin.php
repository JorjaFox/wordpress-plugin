<?php
/*
Plugin Name: Admin Styling
Plugin URI:
Description: Restyling parts of the Admin End
Version: 1.0
Author: Mika Epstein
Author URI: http://www.ipstenu.org/
*/

function jfo_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', plugins_url('wp-admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'jfo_admin_theme_style');


// MP6
function change_admin_color($result) {
    return 'ocean';
}
//add_filter('get_user_option_admin_color', 'change_admin_color');

// Main Dash as two columns
// http://wordpress.stackexchange.com/questions/126301/wordpress-3-8-dashboard-1-column-screen-options
function wpse126301_dashboard_columns() {
    add_screen_option(
        'layout_columns',
        array(
            'max'     => 2,
            'default' => 1
        )
    );
}
add_action( 'admin_head-index.php', 'wpse126301_dashboard_columns' );
