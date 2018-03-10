<?php
/*
Plugin Name: Fans of LeFox Shortcodes Stuff
Plugin URI:
Description: Shortcodes etc
Version: 1.1
Author: Mika Epstein
Author URI: http://www.ipstenu.org/
*/

class FLF_Shortcodes {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'crowdrise', array( $this, 'crowdrise' ) );
		add_shortcode( 'year', array( $this, 'year' ) );
	}

	/**
	 * flf_crowdrise_func function.
	 *
	 * [crowdrise id="ID"]
	 * @access public
	 * @param mixed $atts
	 * @return void
	 */
	function crowdrise( $atts ) {
		extract( shortcode_atts( array(
			'id' => 'stupidcancer',
		), $atts ) );
		return '<script type="text/javascript" src="https://www.crowdrise.com/widgets/donate/fundraiser/'.$id.'/"></script>';
	}

	/**
	 * year function.
	 *
	 * @access public
	 * @return void
	 */
	function year() {
		$year = date('Y');
		return $year;
	}

}

new FLF_Shortcodes();