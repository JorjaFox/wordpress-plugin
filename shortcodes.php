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

// Paypal [paypaltapes]
function paypaltapes_func( $atts ) {
	return '<p>Ta=hank you for your interest, the giveaway is completed.</p>';
	}
add_shortcode( 'paypaltapes', 'paypaltapes_func' );

// Event Time
// eventtime [eventtime time="14:00" length="1" date="2/20/2013" tz="ET"]
function eventtime_func( $atts ) {
	extract( shortcode_atts( array(
		'time' => '14:00',
		'length' => '1',
		'date' => '2/20/2013',
		'tz' => 'ET',
	), $atts ) );
	
	if ( $tz == 'ET') $timezone = '5128581';
	if ( $tz == 'PT') $timezone = '5368361';
		
	return '<span class="wtb-ew-v1" style="width: 560px; display:inline-block;padding-bottom:5px;"><script src="http://www.worldtimebuddy.com/event_widget.js?h='.$timezone.'&md='.$date.'&mt='.$time.'&ml='.$length.'&sts=0&sln=0&wt=ew-lt"></script><i><a target="_blank" href="http://www.worldtimebuddy.com/">Time converter</a> at worldtimebuddy.com</i><noscript><a href="http://www.worldtimebuddy.com/">Time converter</a> at worldtimebuddy.com</noscript><script>window[wtb_event_widgets.pop()].init()</script></span>';
	}
add_shortcode( 'eventtime', 'eventtime_func' );

// JFO Ads [jfoads type="ID"]
function jfoads_func( $atts ) {
    extract( shortcode_atts( array(
        'id' => 'paypal',
    ), $atts ) );

     $filename = '/home/jorjafox/public_html/content/code/ads/'.$id.'.php';
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