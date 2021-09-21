<?php

class FLF_Comment_Policy_Data {

	public function __construct() {
		// Register Eraser
		add_filter(
			'wp_privacy_personal_data_erasers',
			array( $this, 'register_eraser' ),
			0
		);

		// Register Exporter
		add_filter(
			'wp_privacy_personal_data_exporters',
			array( $this, 'register_exporter' ),
			10
		);

	}

	/**
	 * Register Eraser
	 *
	 * Add our value to the eraser.
	 *
	 * @param  array $erasers      - All items being erased.
	 * @return array
	 */
	public static function register_eraser( $erasers ) {
		$erasers['flf-policy-checkbox'] = array(
			'eraser_friendly_name' => 'Fans of LeFox Comment Policy Checkbox',
			'callback'             => array( $this, 'the_eraser' ),
		);

		return $erasers;
	}

	/**
	 * Register Exporter
	 *
	 * Add our value to the exporter.
	 *
	 * @param  array $exporters      - All items being exported.
	 * @return array
	 */
	public static function register_exporter( $exporters ) {

		$exporters['wp-comment-policy-checkbox'] = array(
			'exporter_friendly_name' => 'Fans of LeFox Comment Policy Checkbox',
			'callback'               => array( $this, 'the_exporter' ),
		);

		return $exporters;

	}

	/**
	 * The Eraser - Remove content related to person in question.
	 * @param  string  $email_address
	 * @param  integer $page
	 * @return array                  - Data being erased
	 */
	public static function the_eraser( $email_address, $page = 1 ) {
		$number = 500; // Limit us to avoid timing out
		$page   = (int) $page;

		$comments = get_comments(
			array(
				'author_email' => $email_address,
				'number'       => $number,
				'paged'        => $page,
				'order_by'     => 'comment_ID',
				'order'        => 'ASC',
			)
		);

		$items_removed = false;

		foreach ( (array) $comments as $comment ) {
			$data_consent = get_comment_meta( $comment->comment_ID, 'flf_policy_accepted', true );

			if ( ! empty( $data_consent ) ) {
				delete_comment_meta( $comment->comment_ID, 'flf_policy_accepted' );
				$items_removed = true;
			}
		}

		// Tell core if we have more comments to work on still
		$done = count( $comments ) < $number;

		return array(
			'items_removed'  => $items_removed,
			'items_retained' => false, // always false in this case
			'messages'       => array(), // no messages in this case
			'done'           => $done,
		);
	}


	/**
	 * The Exporter - Output content related to person in question.
	 * @param  string  $email_address
	 * @param  integer $page
	 * @return array                  - Data being kicked back
	 */
	public static function the_exporter( $email_address, $page = 1 ) {
		$number = 500; // Limit us to avoid timing out
		$page   = (int) $page;

		$export_items = array();

		$comments = get_comments(
			array(
				'author_email' => $email_address,
				'number'       => $number,
				'paged'        => $page,
				'order_by'     => 'comment_ID',
				'order'        => 'ASC',
			)
		);

		foreach ( (array) $comments as $comment ) {
			$data_consent = get_comment_meta( $comment->comment_ID, 'flf_policy_accepted', true );

			// Only add data consent to the export if it is not empty
			if ( ! empty( $data_consent ) ) {
				$item_id     = "comment-{$comment->comment_ID}";
				$group_id    = 'comments';
				$group_label = 'Coments';

				$data = array(
					array(
						'name'  => 'Consent email for personal data storage',
						'value' => $data_consent,
					),
				);

				$export_items[] = array(
					'group_id'    => $group_id,
					'group_label' => $group_label,
					'item_id'     => $item_id,
					'data'        => $data,
				);
			}
		}

		// Tell core if we have more comments to work on still
		$done = count( $comments ) < $number;
		return array(
			'data' => $export_items,
			'done' => $done,
		);
	}

}

new FLF_Comment_Policy_Data();
