<?php
/*
 * TVMaze Embeds
 * @version 1.0
 * @package mu-plugins
 *
 * CSI: http://api.tvmaze.com/shows/50361
 */

// Widget

class FLF_TVMaze extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'flf_tvmaze', // Base ID
			'FLF TVMaze', // Name
			array( 'description' => 'Displays the next episode of a TV show, based on the TVMaze info.' ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */

	public function widget( $args, $instance ) {
		// Get what's needed from $args array ($args populated with options from widget area register_sidebar function)
		$before_widget = isset( $args['before_widget'] ) ? $args['before_widget'] : '';
		$after_widget  = isset( $args['after_widget'] ) ? $args['after_widget'] : '';
		$before_title  = isset( $args['before_title'] ) ? $args['before_title'] : '';
		$after_title   = isset( $args['after_title'] ) ? $args['after_title'] : '';

		// Get what's needed from $instance array ($instance populated with user inputs from widget form)
		$title = isset( $instance['title'] ) && ! empty( trim( $instance['title'] ) ) ? $instance['title'] : 'Next Episode';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$url   = isset( $instance['url'] ) && ! empty( trim( $instance['url'] ) ) ? $instance['url'] : 'https://www.tvmaze.com/shows/50361/csi-vegas';

		// Process the URL
		$parsed_url = wp_parse_url( $url );
		$path_parts = explode( '/', $parsed_url['path'] );
		foreach ( $path_parts as $part ) {
			if ( is_numeric( $part ) ) {
				$show_id = $part;
			}
			if ( is_string( $part ) && 'shows' !== $part ) {
				$slug = $part;
			}
		}

		/** Output widget HTML BEGIN **/
		// phpcs:ignore WordPress.Security.EscapeOutput
		echo $before_widget;

		$widget_title = '<h2 class="widget-title">' . $title . '</h2>';

		if ( isset( $show_id ) ) {
			// This is where you run the code and display the output
			// Extract Show name and next ep.
			$show_get = wp_remote_get( 'http://api.tvmaze.com/shows/' . $show_id );
			if ( is_array( $show_get ) && ! is_wp_error( $show_get ) ) {
				$show_info = json_decode( $show_get['body'], true );
				if ( isset( $show_info['_links']['nextepisode']['href'] ) ) {
					$next_get = wp_remote_get( $show_info['_links']['nextepisode']['href'] );
					if ( is_array( $next_get ) && ! is_wp_error( $next_get ) ) {
						$next_info = json_decode( $next_get['body'], true );
						if ( isset( $next_info['summary'] ) ) {
							$next_date_time   = DateTime::createFromFormat( 'Y-m-d', $next_info['airdate'] );
							$next_date_string = $next_date_time->format( 'M d, Y' );

							$content  = '<p><strong>' . $next_info['name'] . '</strong><br />Episode ' . $next_info['season'] . 'x' . $next_info['number'] . '; ' . $next_date_string . '</p><small>' . $next_info['summary'] . '</small>';
							$content .= '<p><a href="https://jorjafox.net/library/actor/' . $slug . '">More <em>' . $show_info['name'] . '</em> Episodes</a><br /><small><a href="' . $url . '">Powered by TV Maze</a></small>';
						}
					}
				}
			}
		}

		if ( ! isset( $content ) ) {
			$content = ( isset( $slug ) ) ? '<p><a href="https://jorjafox.net/library/actor/' . $slug . '">Coming soon...</a></p>' : '<p>Coming soon...</p>';
		}

		echo wp_kses_post( $widget_title . $content );

		// phpcs:ignore WordPress.Security.EscapeOutput
		echo $after_widget;
		/** Output widget HTML END **/

	}

	/**
	 * Sanitize widget form values as they are saved.
	 */

	public function update( $new_instance, $old_instance ) {

		// Set old settings to new $instance array
		$instance = $old_instance;

		// Update Title
		$instance['title'] = wp_strip_all_tags( $new_instance['title'] );

		// Update URL
		$tvmaze_urls     = array( 'www.tvmaze.com', 'tvmaze.com', 'api.tvmaze.com' );
		$parsed_url      = wp_parse_url( $new_instance['url'] );
		$instance['url'] = ( in_array( $parsed_url['host'], $tvmaze_urls, true ) ) ? esc_url( $new_instance['url'] ) : $old_instance['url'];

		return $instance;
	}

	/**
	 * Back-end widget form.
	 */

	public function form( $instance ) {

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$url   = isset( $instance['url'] ) ? $instance['url'] : '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title (optional)' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'URL of Show' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
		</p>
		<?php
	}

}

// Register widget
function register_flf_tvmaze() {
	register_widget( 'FLF_TVMaze' );
}
add_action( 'widgets_init', 'register_flf_tvmaze' );
