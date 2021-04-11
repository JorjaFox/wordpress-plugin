<?php
/*
 * Automated Upgrades
 * @version 1.0
 * @package mu-plugins
 */

// Define auto updates
define( 'WP_AUTO_UPDATE_CORE', true );
define( 'CORE_UPGRADE_SKIP_NEW_BUNDLED', true );

// Force auto plugin updates:
add_filter( 'auto_update_plugin', '__return_true' );

// Force auto theme updates
add_filter( 'auto_update_theme', '__return_true' );

// Don't send emails.
function flf_dont_send_email( $send, $type, $core_update, $result ) {
	$do_email = array( 'fail', 'critical' );
	if ( in_array( $type, $do_email, true ) ) {
		return true;
	} else {
		return false;
	}
}
add_filter( 'auto_core_update_send_email', 'flf_dont_send_email', 10, 4 );
