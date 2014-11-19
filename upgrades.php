<?php

/*
Plugin Name: Upgrade Control
Plugin URI:  http://halfelf.org
Description: Control for upgrades
Version: 1.0
Author: Mika Epstein
Author URI: http://ipstenu.org/
*/

// auto updates
define( 'WP_AUTO_UPDATE_CORE', true );
//define( 'CORE_UPGRADE_SKIP_NEW_BUNDLED', true );

// Force auto plugin updates:
add_filter( 'auto_update_plugin', '__return_true' );

// Force auto theme updates
add_filter( 'auto_update_theme', '__return_true' );

// Suspend emails
//add_filter( 'auto_core_update_send_email', '__return_false', 1 );
//add_filter( 'automatic_updates_send_debug_email', '__return_false', 1 );

// SSL fixes
//add_filter('https_ssl_verify', '__return_false');
//add_filter('https_local_ssl_verify', '__return_false');
