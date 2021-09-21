<?php

class FLF_Comment_Policy_Admin {

	public function __construct() {
		add_action( 'admin_init', array( $this, 'add_settings_section' ) );
		add_filter( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_init', array( $this, 'add_setting_fields' ) );
	}

	public function add_settings_section() {
		add_settings_section(
			'toscoc-section',
			'Comment Policy/Terms of Use',
			array( $this, 'setting_section_description' ),
			'discussion'
		);
	}

	public function register_settings() {
		register_setting(
			'discussion',
			'flf_policy_page',
			array( $this, 'sanitize_flf_policy_page' ),
		);

		register_setting(
			'discussion',
			'flf_policy_top_copy',
			array( $this, 'sanitize_flf_policy_top_copy' ),
		);

	}

	public function add_setting_fields() {
		add_settings_field(
			'flf_policy_page_fields',
			'Policy Page URL',
			array( $this, 'policy_page_callback' ),
			'discussion',
			'toscoc-section',
		);

		add_settings_field(
			'flf_policy_top_copy',
			'Ppolicy basic information',
			array( $this, 'top_copy_callback' ),
			'discussion',
			'toscoc-section'
		);
	}

	public function setting_section_description() {
		echo '<p>The terms of use shows up on the comment field for every non-logged in order. This is an attempt to get people to actually confirm they have read. They won\'t but we still try.</p>';
	}

	public function policy_page_callback( $args ) {
		?>
		<fieldset>
			<legend class="screen-reader-text"><span>Comment Policy/Terms of Use URL</span></legend>
			<p><label for="flf_policy_page">The page with the privacy policy to which you will link the text of the checkbox will be the identifed privacy policy, or a custom URL listed below.</label></p>
			<input type="url" name="flf_policy_page" value="<?php echo esc_url( get_option( 'flf_policy_page' ) ); ?>" placeholder="<?php echo esc_url( get_privacy_policy_url() ); ?>" spellcheck="false" style="width:100%">
		</fieldset>
		<?php
	}

	public function top_copy_callback() {
		?>
		<fieldset>
			<legend class="screen-reader-text"><span>Comment Policy/Terms of Use Basic Information</span></legend>
			<p><label for="flf_policy_top_copy">Write down the basic information for your comment policy/terms of use. This information will appear above the check box for your policy.</label></p>

			<p>
			<textarea name="flf_policy_top_copy" rows="5" cols="50" id="flf_policy_top_copy" class="large-text code" placeholder="Be excellent to one another."><?php echo wp_kses_post( get_option( 'flf_policy_top_copy' ) ); ?></textarea>
			</p>
		</fieldset>
		<?php
	}

	public function sanitize_flf_policy_page( $input ) {
		$new_input = sanitize_url( $input );
		return $new_input;
	}

	public function sanitize_flf_policy_top_copy( $input ) {
		$new_input = wp_kses_post( $input );
		return $new_input;
	}

}

new FLF_Comment_Policy_Admin();
