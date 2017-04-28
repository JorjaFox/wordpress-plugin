<?php
/**
 * Fans of LeFox code for Genesis
 *
 * @package      jfgenesis
 * @link         https://jorjafox.net
 * @author       Mika Epstein
 * @copyright    Copyright (c) 2015, Mika Epstein
 * @license      GPL-2.0+
 */

class FLF_Utility_Pro {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'genesis_after_entry_content', array( $this, 'genesis_after_entry_content' ), 15 );
		add_action( 'wp_head', array( $this, 'header' ) );
		add_action( 'genesis_before_comment_form', array( $this, 'before_comment_form_policy' ) );
		add_action( 'genesis_before_comments', array( $this, 'before_comments_ads' ) );
		add_action( 'genesis_setup', array( $this, 'theme_setup' ), 20 );

		add_filter( 'the_content_more_link', array( $this, 'more_link_text' ) );
		add_filter( 'excerpt_more', array( $this, 'more_link_text' ) );
		add_filter( 'admin_post_thumbnail_html', array( $this, 'admin_post_thumbnail_html' ) );
		add_filter( 'script_loader_src', array( $this, 'remove_script_version' ), 15, 1 );
		add_filter( 'style_loader_src', array( $this, 'remove_script_version' ), 15, 1 );
		add_filter( 'genesis_title_comments', array( $this, 'genesis_title_comments' ) );
		add_filter( 'genesis_comment_list_args', array( $this, 'comment_list_args' ) );
		add_filter( 'comment_form_defaults', array( $this, 'comment_form_defaults' ) );
		add_filter( 'genesis_footer_creds_text', array( $this, 'footer_creds' ), 99 );
	}

	function enqueue_scripts() {
		wp_enqueue_style( 'flf-style', WP_CONTENT_URL . '/mu-plugins/themes/utility-pro.css' );
		wp_enqueue_script( 'content', 'https://static.jorjafox.net/content/code/js/content.min.js', array(), '1.3.1', true );
		wp_dequeue_script( 'utility-pro-backstretch-args' );
		wp_dequeue_script( 'utility-pro-fonts' );
		wp_enqueue_script( 'utility-pro-backstretch-args',  WP_CONTENT_URL . '/mu-plugins/themes/backstretch.args.js', array( 'utility-pro-backstretch' ), '1.3.1', true );
	}

	function more_link_text() {
		return '&#x02026; <a class="more-link" href="'. get_permalink( get_the_ID() ) . '">[' . genesis_a11y_more_link( 'Continue Reading' ) . ']</a>';
	}

	function genesis_after_entry_content() {
		global $post;
		if ( has_excerpt( $post->ID ) && !is_singular() ) {
			echo '<p><a class="more-link" href="'. get_permalink( $post->ID ) . '">[' . genesis_a11y_more_link( 'Continue Reading' ) . ']</a></p>';
		}
	}

	function admin_post_thumbnail_html( $content ) {

		// Get featured image size
		global $_wp_additional_image_sizes;

		$featured_image = $_wp_additional_image_sizes['feature-large']['width'].'x'.$_wp_additional_image_sizes['feature-large']['height'];

		// Apply
		$imagesize = '<p>Image Size:' . $featured_image . ' px</p>';
		$content = $imagesize . $content;

		return $content;

	}

	function header() {
	    include( FLF_STATIC_CONTENT . '/static/content/code/ads/loader.php' );
		include( FLF_STATIC_CONTENT . '/static/content/code/analyticstracking.php' );
	    ?>
		<link type="text/plain" rel="author" href="https://jorjafox.net/humans.txt" />
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="Fans of LeFox" />
		<link href="https://plus.google.com/112696204123972047628/" rel="publisher" />
	    <?php
	}

	// Remove Query strings from Static Resources.
	function remove_script_version( $src ){
	    $parts = explode( '?', $src );
	    return $parts[0];
	}


	/*
	 * Comment Section
	 */

	// Modify comments title text in comments


	function genesis_title_comments() {
		$title = '<h3>Discussion:</h3>';
		return $title;
	}

	// Customize Comments for avatar size and MY callback


	function comment_list_args($args) {
	        $args['callback'] = 'comment_callback';
	        return $args;
	}

	// replace comment callback with my own
	function comment_callback( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		global $post;
		?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<?php do_action( 'genesis_before_comment' ); ?>

			<div class="comment-header">

				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, $size = $args['avatar_size'] ); ?>

					<div class="comment-meta commentmetadata"><small>
						On <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s', 'genesis' ), get_comment_date(), get_comment_time() ); ?></a>
					</small></div><!-- end .comment-meta -->

					<span class="jf-title">
						<?php
						if ( user_can( $comment->user_id, 'administrator' ) ) {
							?><span class="screen-reader-text">Administrator</span><?php
						} elseif ( $comment->user_id === $post->post_author ) {
							?><span class="screen-reader-text">Post Author</span><?php
						} elseif ( user_can( $comment->user_id, 'editor' ) ) {
							?><span class="screen-reader-text">Moderator</span><?php
						} else {
							?><span class="screen-reader-text">Member</span><?php
						}
						?>
					</span>

					<?php printf( '<cite><span class="fn">%1$s</span></cite> <span class="says">%2$s:</span>',
							get_comment_author_link(),
							apply_filters( 'comment_author_says_text', __( 'said', 'genesis' ) ) ); ?>
			 	</div><!-- end .comment-author -->
			</div>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="alert"><em><?php echo apply_filters( 'genesis_comment_awaiting_moderation', __( 'Your comment is awaiting moderation. Please patient while we review the evidence.', 'genesis' ) ); ?></em></p>
				<?php endif; ?>

				<?php comment_text(); ?>
			</div><!-- end .comment-content -->

			<?php if ( comments_open() ) : ?>
				<div class="comment-reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => 1, 'max_depth' => 2 ) ) ); ?>
					<?php edit_comment_link( __( 'Edit', 'genesis' ), '' ); ?>
				</div>
			<?php endif; ?>
			<?php do_action( 'genesis_after_comment' );

		/** No ending </li> tag because of comment threading */
	}

	function comment_form_defaults( $defaults ) {
		$defaults['comment_notes_after'] = '';
		return $defaults;
	}

	// Comment Policy
	function before_comment_form_policy() {

		if ( is_single() && comments_open() ) {
		    ?>
		    <div class="comment-policy-box entry-comments">
		        <p class="comment-policy"><strong>Comment Policy:</strong> By posting a comment, you agree to our <a href="https://jorjafox.net/terms-of-use/">Terms of Use</a> and promise to abide by our <a href="https://jorjafox.net/policy/">Policies</a>. Violations will result in posts being deleted, moderated, or banned. If you want your own avatar, register at <a href="http://gravatar.com">Gravatar</a> with the email you use when commenting.</p>
		</div>
			<?php
		}
	}


	// Ads below comment form
	function before_comments_ads() {
	    echo '<div class="adboxes-footerwidget">'.do_shortcode('[jfoads id=google-large-rectangle]').do_shortcode('[jfoads id=studiopress-120x240]').do_shortcode('[jfoads id=line-buttons-500x250]').'</div>';
	}


	/**
	 * Change the footer text.
	 *
	 * @param string $creds Existing credentials.
	 * @return string Footer credentials, as shortcodes.
	 */
	function footer_creds( $creds ) {
		return '<p>Copyright [footer_copyright first="1996"] <em><a href="https://jorjafox.net/">Fans of LeFox</a></em><br />Powered by <a href="https://wordpress.org/">WordPress</a> & <a href="http://www.shareasale.com/r.cfm?b=778546&u=728549&m=61628&urllink=&afftrack=">Utility Pro</a></p><div class="adboxes-footer">[jfoads id=leaderboard-728x90]</div>';
	}


	/**
	 * Theme setup.
	 *
	 * Attach all of the site-wide functions to the correct hooks and filters. All
	 * the functions themselves are defined below this setup function.
	 *
	 */
	function theme_setup() {

		// Genesis accessibility
		add_theme_support( 'genesis-accessibility', array( 'headings', 'search-form', 'skip-links' ) );

		// Add another image size
	 	add_image_size( 'feature-med', 661, 228, true );

		/**
		 * Hook after post widget area after post content
		 */

		// Register side-up-bit area
		genesis_register_sidebar( array(
			'id'            => 'slide-up-bit',
			'name'          => __( 'Slide Up Bit', 'jfgenesis' ),
			'description'   => __( 'This is a widget area that slides up.', 'jfgenesis' ),
		) );

		//
		add_action( 'genesis_after_footer', 'slide_up_bit' );

		function slide_up_bit() {
		    genesis_widget_area( 'slide-up-bit', array(
		        'before' => '<div id="bit" class=""><a class="bsub" href="javascript:void(0)"><span id="bsub-text">Follow Us</span></a><div id="bitsubscribe">',
		        'after' => '</div></div>',
			) );
		}
	}
}

new FLF_Utility_Pro();