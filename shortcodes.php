<?php
/*
Plugin Name: Fans of LeFox Shortcodes Stuff
Plugin URI:
Description: Shortcodes etc
Version: 1.1
Author: Mika Epstein
Author URI: http://www.ipstenu.org/
*/

// Crowdrise [crowdrise id="ID"]
function flf_crowdrise_func( $atts ) {
	extract( shortcode_atts( array(
		'id' => 'stupidcancer',
	), $atts ) );
	return '<script type="text/javascript" src="https://www.crowdrise.com/widgets/donate/fundraiser/'.$id.'/"></script>';
	}
add_shortcode( 'crowdrise', 'flf_crowdrise_func' );

// JFO Ads [jfoads id=liquidweb-325x38]
function flf_ads_func( $atts ) {
    extract( shortcode_atts( array(
        'id' => 'default',
    ), $atts ) );

    ob_start();
    	$_GET['name'] = $id;
	include("/home/jorjafox/public_html/static/content/code/ads/adboxes.php");
	$content = ob_get_clean();
    return $content;
}

add_shortcode( 'jfoads', 'flf_ads_func' );

// Year

function flf_year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'flf_year_shortcode');