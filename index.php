<?php
/*
Plugin Name: Fans of LeFox Functions
Plugin URI: https://jorjafox.net/
Description: Instead of putting it all in my functions.php, I've made a functional plugin.
Version: 1.5.2
Author: Mika Epstein
Author URI: https://ipstenu.org/
*/

class FLF_MU_Plugins {

	/**
	 * Constructor
	 */
	public function __construct() {
		if ( ! isset( $content_width ) ) {
			$content_width = 600;
		}

		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		add_action( 'pre_ping', array( $this, 'no_self_ping' ) );
		add_filter( 'comments_open', array( $this, 'no_comments_open' ), 10, 2 );
		add_filter( 'ast_block_templates_disable', '__return_true' );
		add_action( 'enqueue_block_editor_assets', array( $this, 'disable_editor_fullscreen_by_default' ) );
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

	/**
	 * Disable Gutenberg's full screen editor default. WHY?! I still think Matt was wrong.
	 */
	public function disable_editor_fullscreen_by_default() {
		$script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";
		wp_add_inline_script( 'wp-blocks', $script );
	}

}

new FLF_MU_Plugins();

// Require the add-ons
require_once 'add-ons/comment-probation.php';
require_once 'add-ons/shortcodes.php';
require_once 'add-ons/tvmaze.php';
require_once 'add-ons/upgrades.php';
require_once 'add-ons/videos.php';
require_once 'cpts/videos.php';
