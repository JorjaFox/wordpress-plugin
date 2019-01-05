<?php
/*
 * Custom Post Type for videos
 *
 * @since 1.0
 */

/**
 * class FLF_CPT_Videos
 */
class FLF_CPT_Videos {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );

		add_action( 'init', array( $this, 'create_post_type' ), 0 );
		add_action( 'init', array( $this, 'create_taxonomies' ), 0 );
	}

	/**
	 * Admin Init
	 */
	public function admin_init() {
		add_action( 'admin_head', array($this, 'admin_css') );
		add_action( 'dashboard_glance_items', array( $this, 'dashboard_glance_items' ) );
	}

	/*
	 * CPT Settings
	 *
	 */
	public function create_post_type() {
		$labels = array(
			'name'               => 'Videos',
			'singular_name'      => 'Video',
			'menu_name'          => 'Videos',
			'parent_item_colon'  => 'Parent Video:',
			'all_items'          => 'All Videos',
			'view_item'          => 'View Video',
			'add_new_item'       => 'Add New Video',
			'add_new'            => 'Add New',
			'edit_item'          => 'Edit Video',
			'update_item'        => 'Update Video',
			'search_items'       => 'Search Videos',
			'not_found'          => 'No videos found',
			'not_found_in_trash' => 'No videos in the Trash',
		);
		$args = array(
			'label'               => 'videos',
			'description'         => 'Videos',
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'post-formats', 'genesis-cpt-archives-settings', 'genesis-seo' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_in_rest'        => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'rest_base'           => 'videos',
			'rewrite'             => array( 'slug' => 'video' ),
			'menu_icon'           => 'dashicons-video-alt',
			'menu_position'       => 7,
			'can_export'          => true,
			'has_archive'         => 'videos',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'videos', $args );
	}

	/*
	 * Custom Taxonomies
	 */
	public function create_taxonomies() {

		$names_focus = array(
			'name'                       => 'Subject',
			'singular_name'              => 'Subject',
			'search_items'               => 'Search Subjects',
			'popular_items'              => 'Popular Subjects',
			'all_items'                  => 'All Subjects',
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => 'Edit Subject',
			'update_item'                => 'Update Subject',
			'add_new_item'               => 'Add New Subject',
			'new_item_name'              => 'New Subject Name',
			'separate_items_with_commas' => 'Separate Subjects with commas',
			'add_or_remove_items'        => 'Add or remove Subjects' ,
			'choose_from_most_used'      => 'Choose from the most used Subjects' ,
			'not_found'                  => 'No Subjects found.' ,
			'menu_name'                  => 'Subjects' ,
		);
		//parameters for the new taxonomy
		$args_focus = array(
			'hierarchical'          => false,
			'labels'                => $names_focus,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'focus' ),
		);
		register_taxonomy( 'video_subjects', 'videos', $args_focus );
	}

	/* Post Formats
	 *
	 * Set the default to videos.
	 */
	function default_post_format( $format ) {
		global $post_type;
		if ( $post_type == 'videos' ) $format = 'video';
		return $format;
	}

	/*
	 * Add AMP Support
	 */
	public function amp_init() {
		add_post_type_support( 'videos', AMP_QUERY_VAR );
	}

	/*
	 * Remove Meta Boxes
	 */
	public function remove_metaboxes() {
		remove_meta_box( 'formatdiv', 'videos', 'side' ); // Hide Post Formats
	}

	/*
	 * Style Admin CSS
	 */
	function admin_css() {
	   echo "<style type='text/css'>
			   #adminmenu #menu-posts-videos div.wp-menu-image:before, #dashboard_right_now li.videos-count a:before {
					content: '\\f234';
					margin-left: -1px;
				}
			 </style>";
	}

	/*
	 * Add Videos to dashboard glance
	 */
	public function dashboard_glance_items() {
		foreach ( array( 'videos' ) as $post_type ) {
			$num_posts = wp_count_posts( $post_type );
			if ( $num_posts && $num_posts->publish ) {
				if ( 'videos' == $post_type ) {
					$text = _n( '%s Video', '%s Videos', $num_posts->publish );
				}
				$text = sprintf( $text, number_format_i18n( $num_posts->publish ) );
				printf( '<li class="%1$s-count"><a href="edit.php?post_type=%1$s">%2$s</a></li>', $post_type, $text );
			}
		}
	}

}

new FLF_CPT_Videos();
