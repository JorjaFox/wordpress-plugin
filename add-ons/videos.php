<?php
/*
 * Videos
 * @version 1.0
 * @package mu-plugins
 */

class FLF_Videos {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'embed_oembed_html', array( $this, 'oembed_filter' ), 10, 3 );
		add_filter( 'video_embed_html', array( $this, 'oembed_filter' ), 10, 3 );
		add_filter( 'wp_video_shortcode', array( $this, 'video_shortcode' ), 10, 5 );
		add_action( 'init', array( $this, 'cbscom_embed_register_handler' ) );
		add_shortcode( 'ooyala', array( $this, 'ooyala_shortcode' ) );
	}

	// Filter Videos and wrap in a class:
	public function oembed_filter( $html ) {
		$html = '<div class="responsive-oembed">' . $html . '</div>';
		return $html;
	}

	// Make a new embed size
	public function new_embed_size() {
		return array( 'width' => 650 );
	}

	// Filter video shortcode and add a link if there's an MP4
	public function video_shortcode( $html, $attr, $video, $post_id, $library ) {
		if ( ! empty( $attr['mp4'] ) ) {
			$html .= '<p>Can\'t see the whole video? Click <a href="' . $attr['mp4'] . '">here</a>.</p>';
		}

		return $html;
	}

	/**
	 * cbscom_embed_register_handler function.
	 *
	 * @access public
	 * @return void
	 */
	public function cbscom_embed_register_handler() {
		wp_embed_register_handler( 'cbscom', '|https?://www.cbs.com/shows/.*|i', array( $this, 'cbscom_embed_handler' ) );
	}

	/**
	 * flf_cbscom_embed_handler function.
	 *
	 * @access public
	 * @param mixed $matches
	 * @param mixed $attr
	 * @param mixed $url
	 * @param mixed $rawattr
	 * @return void
	 */
	public function cbscom_embed_handler( $matches, $attr, $url, $rawattr ) {
		global $post, $wp_embed;

		// no post, no worky
		if ( empty( $post ) ) {
			return $wp_embed->maybe_make_link( $url );
		}

		// we use this cache key for our metadata because WP itself handles clearing
		// it on post saves as part of oembed
		$cachekey = '_oembed_' . md5( $url . serialize( $attr ) );

		$ret = get_post_meta( $post->ID, $cachekey, true );

		// Failures are cached
		if ( '{{unknown}}' === $ret ) {
			return $wp_embed->maybe_make_link( $url );
		}

		// return early, no need to redo all this work
		if ( $ret ) {
			return $ret;
		}

		// get the html from cbs.com
		$response = wp_remote_get( $url );
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			update_post_meta( $post->ID, $cachekey, '{{unknown}}' );
			return $wp_embed->maybe_make_link( $url );
		}
		$html = wp_remote_retrieve_body( $response );

		// find the og:video tag
		preg_match( '|<meta.*?og:video.*?>|i', $html, $m );

		// parse it
		if ( ! empty( $m ) ) {
			$meta = $m[0];
			if ( preg_match_all( '/<meta(.+?)>/', $meta, $m ) ) {
				foreach ( $m[1] as $match ) {
					foreach ( wp_kses_hair( $match, array( 'http' ) ) as $a ) {
						$info[ $a['name'] ] = $a['value'];
					}
				}
			}

			// get the content attribute
			if ( ! empty( $info['content'] ) ) {
				$parsed_url = $info['content'];
			}
		}

		// no content, give up
		if ( empty( $parsed_url ) ) {
			update_post_meta( $post->ID, $cachekey, '{{unknown}}' );
			return $wp_embed->maybe_make_link( $url );
		}

		// fix the url to look like their normal embed code
		$parsed_url = remove_query_arg( array('partner','autoPlayVid'), $parsed_url );
		$parsed_url = add_query_arg( array('partner'=>'cbs'), $parsed_url );

		// decide on width and height
		if ( !empty($rawattr['width']) && !empty($rawattr['height']) ) {
			$width  = (int) $rawattr['width'];
			$height = (int) $rawattr['height'];
		} else {
			list( $width, $height ) = wp_expand_dimensions( 480, 270, $attr['width'], $attr['height'] );
		}

		// yuck.. but it's their embed code. blame them for it.
		$ret = "<object width='{$width}' height='{$height}'>
		<param name='movie' value='{$parsed_url}'></param>
		<param name='allowFullScreen' value='true'></param>
		<param name='allowScriptAccess' value='always'></param>
		<embed width='{$width}' height='{$height}' src='{$parsed_url}' allowFullScreen='true' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
		</object>
		<p>Source: <a href='".$url."'>CBS Video</a></p>";

		// cache, and return
		update_post_meta( $post->ID, $cachekey, $ret );
		return $ret;
	}


	/**
	 * Ooyala Shortcodes
	 * Usually for crap like TV Guide
	 * Example: [ooyala video_pcode="VlajQ6DTdv9-OYPHSJq6w4eU0Bfi" width="222" embedCode="NwdzM3aDp4BB3-MEdPemlMJK5XH7ZVdn"]
	 */
	public function ooyala_shortcode( $atts ) {
		extract(shortcode_atts(array(
			'width' => '500',
			'video_pcode' => '',
			'embedcode' => '',
			), $atts
		));

		$width = (int) $width;
		$height = floor( $width*9/16 );

		if ( !is_feed() ) {
			$output = '<script src="http://player.ooyala.com/player.js?video_pcode='.$video_pcode.'&width='.$width.'&deepLinkEmbedCode='.$embedcode.'&height='.$height.'&embedCode='.$embedcode.'"></script>';
		} elseif ( $options['show_in_feed']  ) {
			$output = __('[There is a video that cannot be displayed in this feed. ', 'ooyalavideo').'<a href="'.get_permalink().'">'.__('Visit the blog entry to see the video.]','ooyalavideo').'</a>';
		}
		return $output;
	}

}

new FLF_Videos();
