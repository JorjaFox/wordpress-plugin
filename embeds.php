<?php
/*
Plugin Name: Embed Fixes
Plugin URI: http://halfelf.org
Description: Instagram Sucks
Version: 1.0
Author: Mika Epstein
Author URI: http://www.ipstenu.org/
*/


// Emojii fixes
// https://core.trac.wordpress.org/ticket/27961

function replace_4byte_characters_callback( $match ) {
	return ( strlen( $match[0] ) < 4 ) ? $match[0] : '';
}

function replace_4byte_characters_27961( $output ) {
	return preg_replace_callback( '/./u', 'replace_4byte_characters_callback', $output );
}
add_filter( 'oembed_result', 'replace_4byte_characters_27961' );
//add_filter( 'wp_insert_post_data', 'replace_4byte_characters_27961', '', 2 );