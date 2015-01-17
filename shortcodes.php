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

// JFO Ads [jfoads type="ID"]
function jfoads_func( $atts ) {
    extract( shortcode_atts( array(
        'id' => 'paypal',
    ), $atts ) );

     $filename = ABSPATH.'/content/code/ads/'.$id.'.php';
     if ( !file_exists($filename) ) { return '<!-- Ad would go here, but you messed up! '.$filename.' not found -->'; }

     ob_start();
     include($filename);
     $content = ob_get_clean();
     return '<div id="'.$id.'">'.$content.'</div>';
}

add_shortcode( 'jfoads', 'jfoads_func' );

// Year

function jfo_year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'jfo_year_shortcode');