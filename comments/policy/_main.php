<?php

/**
 * Comment Policy and Checkbox
 *
 * Forked from https://github.com/fcojgodoy/wp-comment-policy-checkbox
 *
 * Add a checkbox and custom text to the comment forms so that the user can be
 * informed and give consent to the web's privacy policy. And save this consent in the database.
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once 'admin_page.php';
require_once 'data_managment.php';

class FLF_Comment_Policy {

	public function __construct() {
		add_filter( 'comment_form_default_fields', array( $this, 'comment_form_default_fields' ) );
		add_action( 'comment_post', array( $this, 'add_custom_comment_field' ) );
		add_filter( 'preprocess_comment', array( $this, 'verify_policy_check' ) );
	}

	public static function comment_form_default_fields( $fields ) {

		// Determine URL to show
		if ( get_option( 'flf_comment_policy_page' ) ) {
			$url = get_option( 'flf_comment_policy_page' );
		} else {
			$url = get_privacy_policy_url();
		}

		$intro = ( get_option( 'flf_policy_top_copy' ) ) ? get_option( 'flf_policy_top_copy' ) : '';
		$link  = '<a href="' . $url . '"target="_blank" " class="comment-form-policy__see-more-link">Terms of Use</a>';

		$fields['intro']  = '<div role="note" class="comment-form-policy-top-copy" style="font-size:80%">' . wpautop( wp_kses_post( $intro ) ) . '</div>';
		$fields['policy'] = '<p class="comment-form-policy"><label for="policy" style="display:block !important"> <input id="policy" name="policy" value="policy-key" class="comment-form-policy__input" type="checkbox" style="width:auto; margin-right:7px;" aria-required="true">' . sprintf( 'I have read and accepted the %s', $link ) . '<span class="comment-form-policy__required required"> *</span></label></p>';

		return $fields;
	}

	/**
	 * Add comment meta for each comment with checkbox approved
	 */
	public static function add_custom_comment_field( $comment_id ) {
		if ( isset( $_POST[ 'email' ] ) && ! is_user_logged_in() ) { // phpcs:ignore
			add_comment_meta( $comment_id, 'flf_policy_accepted', sanitize_email( $_POST[ 'email' ] ), true ); // phpcs:ignore
		}
	}

	/**
	 * Add the filter to check whether the comment meta data has been filled
	 */
	public static function verify_policy_check( $policydata ) {
		if ( ! isset( $_POST['policy'] ) && ! is_user_logged_in() ) { // phpcs:ignore
			wp_die( '<strong>WARNING</strong> -- All commenters must accept the Terms of Use. <p><a href="javascript:history.back()">Back</a></p>' );
		}

		return $policydata;
	}

}

new FLF_Comment_Policy();
