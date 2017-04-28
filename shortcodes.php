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
		add_shortcode( 'jfoads', array( $this, 'jfoads' ) );
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
	 * flf_ads_func function.
	 *
	 * [jfoads id=liquidweb-325x38]
	 * @access public
	 * @param mixed $atts
	 * @return void
	 */
	function jfoads( $atts ) {
	    extract( shortcode_atts( array(
	        'id' => 'default',
	    ), $atts ) );

	    ob_start();
	    	$_GET['name'] = $id;
		include( FLF_STATIC_CONTENT . '/static/content/code/ads/adboxes.php' );
		$content = ob_get_clean();
	    return $content;
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