<?php
/*
 * Shortcodes Stuff
 * @version 1.1
 * @package mu-plugins
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
	public function crowdrise( $atts ) {
		$attributes = shortcode_atts(
			array(
				'id' => 'stupidcancer',
			),
			$atts
		);

		$id = sanitize_text_field( $attributes['id'] );
		return '<script type="text/javascript" src="https://www.crowdrise.com/widgets/donate/fundraiser/' . $id . '/"></script>'; // phpcs:ignore
	}

	/**
	 * year function.
	 *
	 * @access public
	 * @return void
	 */
	public function year() {
		$year = gmdate( 'Y' );
		return $year;
	}

}

new FLF_Shortcodes();
