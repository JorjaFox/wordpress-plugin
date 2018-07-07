<?php
/*
 * Jetpack tweaks
 * @version 1.0
 * @package mu-plugins
 */

class FLF_Jetpack {

	public function __construct() {
		add_action( 'publish_post', array( $this, 'custom_message_save' ) );
		add_action( 'init', array( $this, 'register_taxonomy_hashtag' ) );
	}

	public function register_taxonomy_hashtag() {

		//parameters for the new taxonomy
		$arguments = array(
			'label'                 => 'Hashtags',
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'rewrite'               => false,
		);

		register_taxonomy( 'flf_hashtags', 'post', $arguments );
	}

	public function publicize_hashtags() {
		$post      = get_post();
		$hash_tags = '';

		// If the post isn't empty AND it's a post (not a page etc), let's go!
		if ( ! empty( $post ) && 'post' === get_post_type( $post->ID ) ) {

			// First let's add the hashtags
			$post_tags = get_the_terms( $post->ID, 'flf_hashtags' );
			if ( ! empty( $post_tags ) ) {
				// Create list of tags with hashtags in front of them
				foreach ( $post_tags as $tag ) {
					// Change tag from this-name to thisname and slap a hashtag on it.
					$tag_name   = str_replace( '-', '', $tag->slug );
					$hash_tags .= ' #' . $tag_name;
				}
			}

			// Next we add a category in specific situations.
			$post_cats = get_the_category( $post->ID );
			if ( ! empty( $post_cats ) ) {
				// Create list of tags with hashtags in front of them
				foreach ( $post_cats as $cat ) {
					if ( 'jorja-fox' === $cat->slug ) {
						// Change slug from this-name to thisname and slap a hashtag on it.
						$cat_name   = str_replace( '-', '', $cat->slug );
						$hash_tags .= ' #' . $cat_name;
					}
				}
			}
		}

		// Loop back. If there are hashtags, we add them.
		if ( '' !== $hash_tags ) {
			// Create our custom message
			$custom_message = 'New post! ' . get_the_title() . $hash_tags;
			update_post_meta( $post->ID, '_wpas_mess', $custom_message );
		}
	}

	// Save that message
	public function custom_message_save() {
		add_action( 'save_post', array( $this, 'publicize_hashtags' ) );
	}

}

new FLF_Jetpack();
