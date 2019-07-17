<?php
/*
 * Some extra magic for the top bar
 * @version 1.0
 * @package mu-plugins
 */

class FLF_MU_Top_Bar {


	public function __construct() {
		add_action( 'customize_save_after', array( $this, 'save_top_file' ) );
	}


	/**
	 * Safe the top file
	 * When customizer is saved, copy the get_theme_mod() data and parse it
	 * into a file: wp-content/top-bar.html
	 * @return n/a
	 */
	public function save_top_file() {
		$default     = 'A fan site for Jorja Fox';
		$banner_text = get_theme_mod( 'authority-top-banner-text', $default );

		$fp = fopen( WP_CONTENT_DIR . '/top-bar.html', 'w' );
		fwrite( $fp, $banner_text );
		fclose( $fp );

	}

}

new FLF_MU_Top_Bar();
