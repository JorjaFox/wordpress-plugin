<?php
/**
 * Template Name: Videos
 *
 * This file adds a Videos page template.
 */


remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_before_loop', 'flf_videos_before_loop', 12);
function flf_videos_before_loop() {
	?>
	<article class="videos type-videos archive entry">

		<header class="entry-header">
			<h1 class="entry-title" itemprop="headline">Videos</h1>
			<p class="entry-meta">By the Fans of Le Fox Librarians <?php edit_post_link( '(Edit)' ); ?></p>
		</header>
	<?php
}

add_action( 'genesis_after_loop', 'flf_videos_after_loop', 12);
function flf_videos_after_loop() {
		FLF_Utility_Pro::post_meta_footer();
	?>
	</article>
	<?php
}

add_action( 'genesis_loop', 'flf_videos_loop' );
function flf_videos_loop() {

    global $paged; // current paginated page
    global $query_args; // grab the current wp_query() args

	$query_args = wp_parse_args(
		genesis_get_custom_field( 'query_args' ),
			array(
				'post_type'      => 'videos',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => '24',
				'paged'          => $paged, // respect pagination
			)
		);

	genesis_custom_loop( $query_args );
}

// Remove post content from archives
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// Remove header title (We add it back in flf_post_info)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Move post meta to below the post
remove_action( 'genesis_entry_header', 'genesis_post_info' , 12);

// Edit custom classes
add_filter( 'genesis_attr_entry', 'atp_post_class' );
function atp_post_class( $attributes ) {
	$attributes['class'] = 'indexalbum';
	return $attributes;
}

// Post Info
add_action( 'genesis_entry_content', 'flf_entry_content', 12 );
function flf_entry_content ( $post_info ) {

	global $post;
	?>
	<div class="thumb">
    	<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'alt' => get_the_title($post->ID), 'title' => get_the_title($post->ID) ) ); ?></a>
	</div>
	<div class="albumdesc">
    	<h3><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
		<p style="clear: both; "></p>
	</div>
	<?php
}

// Move featured image above header
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );


// Run the Genesis loop.
genesis();
