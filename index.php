<?php
/*
Plugin Name: Fans of LeFox Functions
Plugin URI: https://jorjafox.net/
Description: Instead of putting it all in my functions.php, I've made a plugin.
Version: 2.0
Author: Mika Epstein
*/

class FLF_MU_Plugins {

	/**
	 * Constructor
	 */
	public function __construct() {
		if ( ! isset( $content_width ) ) {
			$content_width = 600;
		}

		//add_filter( 'http_request_args', array( $this, 'disable_wp_update' ), 10, 2 );
		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		add_action( 'pre_ping', array( $this, 'no_self_ping' ) );
		add_filter( 'comments_open', array( $this, 'no_comments_open' ), 10, 2 );
		add_filter( 'ast_block_templates_disable', '__return_true' );
	}

	/**
	 * Disable WP from updating this plugin..
	 *
	 * @access public
	 * @param mixed $return - array to return.
	 * @param mixed $url    - URL from which checks come and need to be blocked (i.e. wp.org)
	 * @return array        - $return
	 */
	public function disable_wp_update( $return, $url ) {
		if ( 0 === strpos( $url, 'https://api.wordpress.org/plugins/update-check/' ) ) {
			$my_plugin = plugin_basename( __FILE__ );
			$plugins   = json_decode( $return['body']['plugins'], true );
			unset( $plugins['plugins'][ $my_plugin ] );
			unset( $plugins['active'][ array_search( $my_plugin, $plugins['active'], true ) ] );
			$return['body']['plugins'] = wp_json_encode( $plugins );
		}
		return $return;
	}

	/**
	 * upload_mimes function.
	 *
	 * @access public
	 * @param mixed $existing_mimes
	 * @return void
	 */
	public function upload_mimes( $existing_mimes ) {
		$existing_mimes['epub'] = 'application/epub+zip'; //allow epub files
		$existing_mimes['webm'] = 'video/webm'; //allow webm file
		return $existing_mimes;
	}

	/**
	 * no_self_ping function.
	 *
	 * @access public
	 * @param mixed &$links
	 * @return void
	 */
	public function no_self_ping( &$links ) {
		$home = get_option( 'home' );
		foreach ( $links as $l => $link ) {
			if ( 0 === strpos( $link, $home ) ) {
				unset( $links[ $l ] );
			}
		}
	}

	/**
	 * no_comments_open function.
	 *
	 * @access public
	 * @param mixed $open
	 * @param mixed $post_id
	 * @return void
	 */
	public function no_comments_open( $open, $post_id ) {
		$post = get_post( $post_id );
		if ( 'attachment' === $post->post_type ) {
			return false;
		}
		return $open;
	}

}

new FLF_MU_Plugins();

// Require the add-ons
require_once 'blocks/_main.php';
require_once 'cpts/videos.php';
require_once 'features/_main.php';
