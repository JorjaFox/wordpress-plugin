<?php
/*
Plugin Name: Embed Fixes
Plugin URI: http://halfelf.org
Description: Instagram Sucks
Version: 1.0
Author: Mika Epstein
Author URI: http://www.ipstenu.org/
*/

// <iframe src="//instagram.com/p/eBFI8vIiMq/embed/" width="612" height="710" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
// http://embedresponsively.com/ ?

wp_embed_register_handler( 'instagram', '#http://instagr(\.am|am\.com)/p/([^/]+)#i', 'custom_embed_handler_instagram' ); 

function custom_embed_handler_instagram( $matches, $attr, $url, $rawattr ) { 
  if ( !empty($rawattr['width']) && !empty($rawattr['height']) ) { 
		$width  = (int) $rawattr['width']; 
		$height = (int) $rawattr['height']; 
	} else { 
		list( $width, $height ) = wp_expand_dimensions( 400, 498, $attr['width'], $attr['height'] ); 
	} 

	return apply_filters( 'embed_instagram', "<iframe src='//instagram.com/p/". esc_attr($matches[2]). "/embed/' width='{$width}' height='{$height}' frameborder='0' scrolling='no' allowtransparency='true'></iframe>" ); 
} 

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