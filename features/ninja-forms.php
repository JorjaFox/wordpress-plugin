<?php

/**
 * Support IPs in Ninja Forms.
 * https://dzone.com/articles/register-hidden-fields-ninja
 */

 function flf_register_ninja_form_fields() {
	$args_ip = array(
		'name'             => 'User IP',
		'display_function' => 'collect_user_ip_display',
		'sidebar'          => 'template_fields',
		'display_label'    => false,
		'display_wrap'     => false,
	);

	if ( function_exists( 'ninja_forms_register_field' ) ) {
		ninja_forms_register_field( 'user_ip', $args_ip );
	}
}

add_action( 'init', 'flf_register_ninja_form_fields' );

function flf_collect_user_ip_display( $field_id, $data ) {
	global $post;

	$id = $_SERVER['REMOTE_ADDR'];

	if ( ! empty( $post ) ) {
		?>
			<input type="hidden" name="ninja_forms_field_<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_attr( $id ); ?>">
		<?php
	}

	if ( is_admin() ) {
		?>
			<div class="field-wrap text-wrap label-above">
				<label for="ninja_forms_field_<?php echo esc_attr( $field_id ); ?>">User IP</label>
				<input type="text" name="ninja_forms_field_<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_attr( $data['default_value'] ); ?>">
				<p><a href="http://whois.domaintools.com/<?php esc_attr( $data['default_value'] ); ?>" target="_blank">Find out more about this person</a></p>
			</div>
		<?php
	}
}