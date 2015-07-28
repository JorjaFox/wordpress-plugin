<?php
/*
Plugin Name: JFO Custom Post-Types
Plugin URI: http://jorjafox.net
Description: All CPT code.
Version: 1.0
Author: Mika Epstein
Author URI: http://www.ipstenu.org/
*/

/*
 * This is the video CPT
 */

add_action( 'init', 'create_jfo_post_types', 25 );

function create_jfo_post_types() {

$domain = 'jfonline';
$prefix = 'jfo';
        // Labels for the Videos post type.
        $video_labels = array(
                'name' => __( 'Videos', $domain ),
                'singular_name' => __( 'Video', $domain ),
                'add_new' => __( 'Add New', $domain ),
                'add_new_item' => __( 'Add New Video', $domain ),
                'edit' => __( 'Edit', $domain ),
                'edit_item' => __( 'Edit Video', $domain ),
                'new_item' => __( 'New Video', $domain ),
                'view' => __( 'View Video', $domain ),
                'view_item' => __( 'View Video', $domain ),
                'search_items' => __( 'Search Videos', $domain ),
                'not_found' => __( 'No videos found', $domain ),
                'not_found_in_trash' => __( 'No videos found in Trash', $domain ),
        );

        // Arguments for the Videos post type.
        $video_args = array(
                'labels' => $video_labels,
                'capability_type' => 'post',
                'public' => true,
                'has_archive' => true,
                'can_export' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'video', 'with_front' => true ),
                'taxonomies' => array( 'post_tag'),
                'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'genesis-cpt-archives-settings', "{$prefix}-post-settings" ),
                'menu_position' => 5,
        );

        // Register the Videos post type.
        register_post_type( apply_filters( 'jfo_video_post_type', 'video' ), apply_filters( 'jfo_video_post_type_args', $video_args ) );
}

// Adding to Right Now
add_action( 'dashboard_glance_items', 'jfocpt_right_now' );

function jfocpt_right_now() {
        	foreach ( array( 'video' ) as $post_type ) {
        		$num_posts = wp_count_posts( $post_type );
        		if ( $num_posts && $num_posts->publish ) {
        			if ( 'video' == $post_type ) {
        				$text = _n( '%s Video', '%s Videos', $num_posts->publish );
        			}
        			$text = sprintf( $text, number_format_i18n( $num_posts->publish ) );
        			printf( '<li class="%1$s-count"><a href="edit.php?post_type=%1$s">%2$s</a></li>', $post_type, $text );
        		}
        	}
}

// Styling Icons
function jfo_video_post_type_css() {
   echo "<style type='text/css'>
           #adminmenu #menu-posts-video div.wp-menu-image:before, #dashboard_right_now li.video-count a:before {
                content: '\\f126';
                margin-left: -1px;
            }
         </style>";

}

add_action('admin_head', 'jfo_video_post_type_css');

