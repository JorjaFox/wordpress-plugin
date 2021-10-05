<?php
/*
 * Sometimes when you have NPG in a subfolder of WordPress, the oembed gets
 * REALLY STUPID and thinks it's not NPG. So we have this to force it so
 * Mika doesn't cry.
 */

class FLF_Oembed {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'embed_oembed_html', array( $this, 'wrap_oembed_html' ), 99, 4 );
	}

	public static function wrap_oembed_html( $cached_html, $url, $attr, $post_id ) {
		// If FLF Gallery:
		if ( false !== strpos( $url, '://jorjafox.net/gallery' ) ) {
			$cached_html = '<div class="responsive-check">' . $cached_html . '</div>';

			$cached_html = str_replace( 'wp-embedded-content', 'npg-embedded-content', $cached_html );
			$cached_html = str_replace( 'sandbox="allow-scripts"', '', $cached_html );
			$cached_html = str_replace( 'security="restricted"', '', $cached_html );
		}
		// If The Library:
		if ( false !== strpos( $url, '://jorjafox.net/library' ) ) {
			$cached_html = '<div class="responsive-check">' . $cached_html . '</div>';

			$cached_html = str_replace( 'wp-embedded-content', 'hugo-embedded-content', $cached_html );
			$cached_html = str_replace( 'sandbox="allow-scripts"', '', $cached_html );
			$cached_html = str_replace( 'security="restricted"', '', $cached_html );
			$cached_html = str_replace( 'height="338"', 'height="200"', $cached_html );
		}
		return $cached_html;
	}
}

new FLF_Oembed();
