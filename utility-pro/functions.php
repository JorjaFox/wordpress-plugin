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

		// Actions
		add_action( 'wp_head', array( $this, 'header' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'genesis_setup', array( $this, 'theme_setup' ), 20 );
		add_action( 'genesis_entry_header', array( $this, 'genesis_entry_header' ), 11 );
		add_action( 'genesis_after_entry_content', array( $this, 'genesis_after_entry_content' ), 15 );
		add_action( 'genesis_before_comment_form', array( $this, 'before_comment_form_policy' ) );
		add_action( 'genesis_before_comments', array( $this, 'before_comments_ads' ) );

		// Filters
		add_filter( 'admin_post_thumbnail_html', array( $this, 'admin_post_thumbnail_html' ) );
		add_filter( 'excerpt_more', array( $this, 'more_link_text' ) );
		add_filter( 'the_content_more_link', array( $this, 'more_link_text' ) );
		add_filter( 'genesis_attr_content', array( $this, 'custom_facetwp_class' ) );
		add_filter( 'genesis_post_info', array( $this, 'genesis_post_info' ) );
		add_filter( 'genesis_post_meta', array( $this, 'genesis_post_meta' ) );
		add_filter( 'genesis_title_comments', array( $this, 'genesis_title_comments' ) );
		add_filter( 'genesis_comment_list_args', array( $this, 'comment_list_args' ) );
		add_filter( 'comment_form_defaults', array( $this, 'comment_form_defaults' ) );
		add_filter( 'genesis_footer_creds_text', array( $this, 'footer_creds' ), 99 );
	}

	/**
	 * Enqueue scripts and styles
	 *
	 * @access public
	 * @return void
	 */
	function enqueue_scripts() {
		wp_enqueue_style( 'flf-style', WP_CONTENT_URL . '/mu-plugins/utility-pro/style.css' );
		wp_enqueue_script( 'content', 'https://static.jorjafox.net/content/code/js/content.min.js', array(), '1.3.1', true );
		wp_dequeue_script( 'utility-pro-fonts' );

		// Load Backstretch scripts only if custom background is being used
		if ( ! get_background_image() ) {
			return;
		}

		// Re-enqueue becuase we want this on all pages (sorry, Carrie)
		wp_enqueue_script( 'utility-pro-backstretch', get_stylesheet_directory_uri() . '/js/backstretch.min.js', array( 'jquery' ), '2.0.1', true );

		wp_dequeue_script( 'utility-pro-backstretch-args' );
		wp_enqueue_script( 'utility-pro-backstretch-args',  WP_CONTENT_URL . '/mu-plugins/utility-pro/backstretch.args.js', array( 'utility-pro-backstretch' ), '1.3.1', true );

		wp_localize_script( 'utility-pro-backstretch-args', 'utilityBackstretchL10n', array( 'src' => get_background_image() ) );
	}

	/**
	 * Customize Read More.
	 *
	 * @access public
	 * @return void
	 */
	function more_link_text() {
		return '&#x02026; <a class="more-link" href="'. get_permalink( get_the_ID() ) . '">[' . genesis_a11y_more_link( 'Continue Reading' ) . ']</a>';
	}

	/**
	 * Customize read-more after entry
	 *
	 * @access public
	 * @return void
	 */
	function genesis_after_entry_content() {
		global $post;
		if ( has_excerpt( $post->ID ) && !is_singular() ) {
			echo '<p><a class="more-link" href="'. get_permalink( $post->ID ) . '">[' . genesis_a11y_more_link( 'Continue Reading' ) . ']</a></p>';
		}
	}

	/**
	 * Display sizes for featured images so I don't forget.
	 *
	 * @access public
	 * @param mixed $content
	 * @return void
	 */
	function admin_post_thumbnail_html( $content ) {
		global $_wp_additional_image_sizes;

		$featured_image = $_wp_additional_image_sizes['feature-large']['width'].'x'.$_wp_additional_image_sizes['feature-large']['height'];
		$imagesize      = '<p>Image Size:' . $featured_image . ' px</p>';
		$content        = $imagesize . $content;

		return $content;
	}

	/**
	 * Custom Header Code
	 *
	 * @access public
	 * @return void
	 */
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

	/**
	 * Modify name of comments section
	 *
	 * @access public
	 * @return void
	 */
	function genesis_title_comments() {
		$title = '<h3>Discussion:</h3>';
		return $title;
	}

	/**
	 * Customize Comments for avatar size and MY callback.
	 *
	 * @access public
	 * @param mixed $args
	 * @return void
	 */
	function comment_list_args($args) {
	        $args['callback'] = $this->comment_callback;
	        return $args;
	}

	/**
	 * replace comment callback with my own.
	 *
	 * @access public
	 * @param mixed $comment
	 * @param mixed $args
	 * @param mixed $depth
	 * @return void
	 */
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
							$userrole = 'Administrator';
						} elseif ( $comment->user_id === $post->post_author ) {
							$userrole = 'Post Author';
						} elseif ( user_can( $comment->user_id, 'editor' ) ) {
							$userrole = 'Moderator';
						} else {
							$userrole = 'Member';
						}
						?><span class="screen-reader-text"><?php echo $userrole; ?></span>
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

	/**
	 * Default settings for comment form.
	 *
	 * @access public
	 * @param mixed $defaults
	 * @return void
	 */
	function comment_form_defaults( $defaults ) {
		$defaults['comment_notes_after'] = '';
		return $defaults;
	}

	/**
	 * Comment Policy.
	 *
	 * @access public
	 * @return void
	 */
	function before_comment_form_policy() {

		if ( is_single() && comments_open() ) {
		    ?>
		    <div class="comment-policy-box entry-comments">
		        <p class="comment-policy"><strong>Comment Policy:</strong> By posting a comment, you agree to our <a href="https://jorjafox.net/terms-of-use/">Terms of Use</a> and promise to abide by our <a href="https://jorjafox.net/policy/">Policies</a>. Violations will result in posts being deleted, moderated, or banned. To create your own custom avatar, please register at <a href="http://gravatar.com">Gravatar</a> with the email address you use when commenting.</p>
		</div>
			<?php
		}
	}

	/**
	 * Display ads before comments.
	 *
	 * @access public
	 * @return void
	 */
	function before_comments_ads() {
	    echo '<div class="adboxes-footerwidget">'.do_shortcode('[jfoads id=google-large-rectangle]').do_shortcode('[jfoads id=studiopress-120x240]').do_shortcode('[jfoads id=line-buttons-500x250]').'</div>';
	}

	/**
	 * Change the footer text.
	 *
	 * @access public
	 * @param string $creds Existing credentials.
	 * @return string Footer credentials, as shortcodes.
	 */
	function footer_creds( $creds ) {
		return '<p>Copyright [footer_copyright first="1996"] <em><a href="https://jorjafox.net/">Fans of LeFox</a></em><br />Powered by <a href="https://wordpress.org/">WordPress</a> & <a href="http://www.shareasale.com/r.cfm?b=778546&u=728549&m=61628&urllink=&afftrack=">Utility Pro</a> & <a href="http://helf.us/genesis/">Genesis Framework</a>.<br />Hosted by <a href="https://liquidweb.evyy.net/c/294289/297312/4464">Liquidweb</a>.</p><div class="adboxes-footer">[jfoads id=leaderboard-728x90]</div>';
	}

	/**
	 * Filter post info.
	 *
	 * @access public
	 * @param mixed $post_info
	 * @return void
	 */
	function genesis_post_info( $post_info = '' ) {
		if ( is_singular( array ( 'videos', 'page' ) ) )
			$post_info = 'By the Fans of Le Fox Librarians [post_edit]';
		return $post_info;
	}

	/**
	 * Filter headers so pages show post info.
	 *
	 * @access public
	 * @return void
	 */
	function genesis_entry_header() {
		$post_info = $this->genesis_post_info();
		if ( is_page() ) printf( '<p class="entry-meta">%s</p>', do_shortcode( $post_info ) );
	}

	/**
	 * Theme setup.
	 *
	 * Attach all of the site-wide functions to the correct hooks and filters. All
	 * the functions themselves are defined below this setup function.
	 *
	 * @access public
	 */
	function theme_setup() {

		// Genesis accessibility
		add_theme_support( 'genesis-accessibility', array( 'headings', 'search-form', 'skip-links' ) );

		// Add another image size
	 	add_image_size( 'feature-med', 661, 228, true );

		// Register new widget areas
		genesis_register_sidebar( array(
			'id'            => 'slide-up-bit',
			'name'          => __( 'Slide Up Bit', 'jfgenesis' ),
			'description'   => __( 'This is a widget area that slides up.', 'jfgenesis' ),
		) );

		/**
		 * Widget area for slide-up-bit.
		 *
		 * @access public
		 * @return void
		 */
		function slide_up_bit() {
		    genesis_widget_area( 'slide-up-bit', array(
		        'before' => '<div id="bit" class=""><a class="bsub" href="javascript:void(0)"><span id="bsub-text">Follow Us</span></a><div id="bitsubscribe">',
		        'after' => '</div></div>',
			) );
		}
		add_action( 'genesis_after_footer', 'slide_up_bit' );
	}

	/**
	 * Custom Post Meta
	 *
	 * @access public
	 * @return void
	 */
	public function post_meta_footer( $type = '' ) {

		switch ( $type ) {
			case 'videos':
				$text = 'Per our <a href="/copyrights/">Copyrights</a> and <a href="/terms-of-use/">Terms of Use</a>, you are welcome to copy and reuse videos from this site provided you credit this site in some way (via a link back, or simply by mentioning us by name).';
				break;
			default:
				$text = '';
		}

		return $text;
	}

	/**
	 * Footer Meta
	 *
	 * @access public
	 * @param string $post_meta (default: '')
	 * @return void
	 */
	function genesis_post_meta( $post_meta = '' ) {
		if ( is_singular( array( 'videos' ) ))
			$post_meta = '[post_terms taxonomy="video_subjects"]</p><p class="entry-meta-copyright">' . $this->post_meta_footer( 'videos' );
		return $post_meta;
	}

	/**
	 * Add FacetWP to classes for Genesis.
	 *
	 * @access public
	 * @param mixed $atts
	 * @return void
	 */
	function custom_facetwp_class( $atts ) {
		$atts['class'] .= ' facetwp-template';
		return $atts;
	}
}

new FLF_Utility_Pro();