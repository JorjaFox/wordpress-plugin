<?php
/*
Plugin Name: JFO Shortcodes Stuff
Plugin URI:
Description: Shortcodes etc
Version: 1.0
Author: Mika Epstein
Author URI: http://www.ipstenu.org/
*/

// Crowdrise [crowdrise id="ID"]
function crowdrise_func( $atts ) {
	extract( shortcode_atts( array(
		'id' => 'stupidcancer',
	), $atts ) );
	return '<script type="text/javascript" src="https://www.crowdrise.com/widgets/donate/fundraiser/'.$id.'/"></script>';
	}
add_shortcode( 'crowdrise', 'crowdrise_func' );

// JFO Ads [jfoads id=liquidweb-325x38]
function jfoads_func( $atts ) {
    extract( shortcode_atts( array(
        'id' => 'default',
    ), $atts ) );

    ob_start();
    	$_GET['name'] = $id;
	include("/home/jorjafox/public_html/content/code/ads/adboxes.php");
	$content = ob_get_clean();
    return $content;
}

add_shortcode( 'jfoads', 'jfoads_func' );

// Year

function jfo_year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'jfo_year_shortcode');