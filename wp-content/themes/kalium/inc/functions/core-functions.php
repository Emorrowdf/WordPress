<?php
/**
 *	Kalium WordPress Theme
 *
 *	Core Theme Functions
 *	
 *	Laborator.co
 *	www.laborator.co 
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 *	Get template from Kalium theme
 */
function kalium_get_template( $file, $args = array() ) {

	// Templates prefix
	$file = sprintf( 'templates/%s', $file );
	
	// Locate template file
	$located = locate_template( $file, false );
	
	// Apply filters to current template file
	$template_file = apply_filters( 'kalium_get_template', $located, $file, $args );
	
	// File does not exists
	if ( ! file_exists( $template_file ) ) {
		kalium_doing_it_wrong( __FUNCTION__, sprintf( '%s does not exist.', '<code>' . $file . '</code>' ), '2.1' );
		return;
	}
	
	// Filter arguments by "kalium_get_template-filename.php"
	$args = apply_filters( "kalium_get_template-{$file}", $args );
	
	// Extract arguments (to use in template file)
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}
	
	// Actions before parsing template
	do_action( 'kalium_get_template_before', $located, $file, $args );
	
	include( $template_file );
	
	// Actions after parsing template
	do_action( 'kalium_get_template_after', $located, $file, $args );
}

/**
 *	Doing it wrong, the Kalium way
 */
function kalium_doing_it_wrong( $function, $message, $version ) {
	$message .= ' Backtrace: ' . wp_debug_backtrace_summary();

	if ( defined( 'DOING_AJAX' ) ) {
		do_action( 'doing_it_wrong_run', $function, $message, $version );
		error_log( "{$function} was called incorrectly. {$message}. This message was added in version {$version}." );
	} else {
		_doing_it_wrong( $function, $message, $version );
	}
}

/**
 * Generate infinite scroll pagination object for JavaScript
 */
function kalium_infinite_scroll_pagination_js_object( $id, $args = array() ) {
	
	if ( ! empty( $id ) ) {
		// Defaults
		extract( array_merge( array(
			
			// Total items
			'total_items' => 1,
			
			// Posts per page
			'posts_per_page' => 10,
			
			// Fetched ID's,
			'fetched_items' => array(),
			
			// Base query
			'base_query' => array(),
			
			// WP Ajax Action
			'action' => 'kalium_endless_pagination_get_paged_items',
			
			// Posts loop template function (PHP)
			'loop_template' => '',
			
			// JS Callback Function
			'callback' => '',
			
			// Selectors
			'trigger_element' => sprintf( '.pagination--infinite-scroll-show-more[data-endless-pagination-id="%s"]', esc_attr( $id ) ),
			
			// Container Element
			'container_element' => sprintf( '#%s', esc_attr( $id ) ),
			
			// Auto-reveal
			'auto_reveal' => false,
			
			// Extra arguments
			'args' => array(),
			
		), $args ) );
		
		// Remove unnecessary keys from query
		foreach ( array( 'pagename', 'page_id', 'name', 'portfolio', 'preview' ) as $query_arg ) {
			if ( isset( $base_query[ $query_arg ] ) ) {
				unset( $base_query[ $query_arg ] );
			}
		}
		
		// Generate Security Nonce
		$nonce = wp_create_nonce( $action );
		
		// Instance object
		$endless_pagination_obj_data = array(
			// Query to use
			'baseQuery' => $base_query,
			
			// Extra Query Filter Args
			'queryFilter' => null,
			
			// Pagination info
			'pagination' => array(
				'totalItems'    => $total_items,
				'perPage'       => $posts_per_page,
				'fetchedItems'  => $fetched_items,
			),
			
			// WP AJAX Action
			'action' => $action,
			
			// Loop template
			'loopTemplate' => $loop_template,
			
			// JavaScript Callback
			'callback' => $callback,
			
			// Triggers
			'triggers' => array(
				
				// CSS Selector
				'selector' => $trigger_element,
				
				// Items container (where to append results)
				'container' => $container_element,
				
				// Auto Reveal
				'autoReveal' => $auto_reveal,
				
				// Classes added on events
				'classes' => array(
					
					// Ready
					'isReady' => 'pagination--infinite-scroll-has-items',
					
					// Loading
					'isLoading' => 'pagination--infinite-scroll-is-loading',
					
					// Pagination reached the end
					'allItemsShown' => 'pagination--infinite-scroll-all-items-shown'
				),
			),
			
			// Extra arguments
			'args' => $args,
			
			// Security Nonce
			'_wpnonce' => $nonce
		);
		
	
		?>
		<script>
		var infiniteScrollPaginationInstances = infiniteScrollPaginationInstances || {};
		infiniteScrollPaginationInstances['<?php echo sanitize_title( $id ); ?>'] = <?php echo json_encode( apply_filters( 'kalium_endless_pagination_object', $endless_pagination_obj_data, $id ) ); ?>;
		</script>
		<?php
	}
}

/**
 * Get Post Ids from WP_Query
 */
function kalium_get_post_ids_from_query( $query ) {
	$ids = array();
	
	foreach ( $query->posts as $post ) {
		if ( is_object( $post ) ) {
			$ids[] = $post->ID;
		} else if ( is_numeric( $post ) ) {
			$ids[] = $post;
		}
	}
	
	return $ids;
}

/**
 * Get enabled options (SMOF Theme Options array)
 */
function kalium_get_enabled_options( $items ) {
	$enabled = array();
	
	if ( isset( $items['visible'] ) ) {
		foreach ( $items['visible'] as $item_id => $item ) {
			
			if ( $item_id == 'placebo' ) {
				continue;
			}
			
			$enabled[ $item_id ] = $item;
		}
	}
	
	return $enabled;
}

/**
 * Video JS Autoplay attribute
 *
 * @type filter
 */
function kalium_videojs_set_auto_play( $attrs ) {
	
	if ( is_array( $attrs ) ) {
		$attrs['autoplay'] = true;
	}
	
	return $attrs;
}

/**
 * Extract aspect ratio from string
 */
function kalium_extract_aspect_ratio( $str = '' ) {
	
	if ( ! empty( $str ) ) {
		$aspect_ratio = trim( $str );
		
		if ( preg_match( '/^[0-9]+:[0-9]+$/', $aspect_ratio ) ) {
			list( $width, $height ) = explode( ':', $aspect_ratio );
			
			return array( 'width' => $width, 'height' => $height );
		}
	}
	
	return array();
}
