<?php
/**
 * Name: Blocks
 * Description: Blocks for Gutenberg
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) || ! function_exists( 'register_block_type' ) ) {
	exit;
}

class FLF_Library_Gutenberg {

	protected static $directory;

	public function __construct() {
		self::$directory = dirname( __FILE__ );

		// Add a block category
		add_filter(
			'block_categories_all',
			function( $categories, $post ) {
				return array_merge(
					$categories,
					array(
						array(
							'slug'  => 'flfblocks',
							'title' => 'Fans of LeFox Blocks',
						),
					)
				);
			},
			10,
			2
		);

		add_action( 'enqueue_block_assets', array( $this, 'block_assets' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_assets' ) );
	}

	public function block_assets() {
		// Styles.
		$build_css = 'build/style-index.css';
		wp_enqueue_style(
			'flf-blocks-style', // Handle.
			plugins_url( $build_css, __FILE__ ),
			array( 'wp-editor' ),
			filemtime( self::$directory . '/' . $build_css )
		);
	}

	public function block_editor_assets() {
		// Scripts.
		$build_js = 'build/index.js';
		wp_enqueue_script(
			'flf-blocks-editor', // Handle.
			plugins_url( $build_js, __FILE__ ),
			array( 'wp-i18n', 'wp-element' ),
			filemtime( self::$directory . '/' . $build_js ),
			true
		);

		// Styles.
		$editor_css = 'build/index.css';
		wp_enqueue_style(
			'flf-blocks-editor', // Handle.
			plugins_url( $editor_css, __FILE__ ),
			array(),
			filemtime( self::$directory . '/' . $editor_css )
		);
	}
}

new FLF_Library_Gutenberg();
