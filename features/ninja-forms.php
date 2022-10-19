<?php
/**
 * Ninja Forms
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


class FLF_NinjaForms {
	/**
	 * On load.
	 */
	public function __construct() {
		add_filter( 'ninja_forms_submit_data', array( $this, 'comment_blocklist' ) );
	}

	/**
	 * List of disallowed emails
	 *
	 * We omit anything that isn't an email address or has an @ in the string.
	 *
	 * @return array the list
	 */
	public static function list() {
		$disallowed_emails = array();
		$disallowed_array  = explode( "\n", get_option( 'disallowed_keys' ) );

		// Make a list of spammer emails and domains.
		foreach ( $disallowed_array as $spammer ) {
			if ( is_email( $spammer ) || ( strpos( $spammer, '@' ) !== false ) ) {
				// Anything with an @-symbol is probably an email, so let's trust it.
				$disallowed_emails[] = trim( $spammer );
			}
		}

		return $disallowed_emails;
	}

	/**
	 * Ninja Forms: Server side email protection using WordPress comment blocklist
	 * https://developer.ninjaforms.com/codex/custom-server-side-validation
	 *
	 * @param array $form_data Form data array.
	 * @return array $form_data email checked form data array.
	 */
	public function comment_blocklist( $form_data ) {
		$disallowed = self::list();

		foreach ( $form_data['fields'] as $field ) {
			// If this is email, we will do some playing.
			if ( 'email' === $field['key'] ) {
				$email_address = sanitize_email( strtolower( $field['value'] ) );

				// Break apart email into parts
				$emailparts = explode( '@', $email_address );
				$username   = $emailparts[0];       // i.e. foobar
				$domain     = '@' . $emailparts[1]; // i.e. @example.com

				// Remove all periods (i.e. foo.bar > foobar )
				$clean_username = str_replace( '.', '', $username );

				// Remove everything AFTER a + sign (i.e. foobar+spamavoid > foobar )
				$clean_username = ( false !== strpos( $clean_username, '+' ) ) ? strstr( $clean_username, '+', true ) : $clean_username;

				// rebuild email now that it's clean.
				$email = $clean_username . '@' . $emailparts[1];

				// If the email OR the domain is an exact match in the array, then it's a spammer
				if ( in_array( $email, $disallowed, true ) || in_array( $domain, $disallowed, true ) ) {
					//$form_data['_honeypot'] = 'I suck';
					$form_data['errors']['fields'][ $field['id'] ] = 'Error: Invalid data.';
				}
			}
		}
		return $form_data;
	}

}

new FLF_NinjaForms();
