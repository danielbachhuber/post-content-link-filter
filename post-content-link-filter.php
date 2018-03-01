<?php
/**
 * Plugin Name:     Post Content Link Filter
 * Description:     Process content for its links and allow transformation with a filter.
 * Author:          Daniel Bachhuber
 * Author URI:      https://danielbachhuber.com
 * Text Domain:     post-content-link-filter
 * Domain Path:     /languages
 * Version:         0.1.0-alpha
 *
 * @package         Post_Content_Link_Filter
 */

/**
 * Process content for its links, and allow transformation of the link.
 *
 * @param string $content Content to be processed.
 * @return string
 */
function post_content_link_filter( $content ) {

	$content = preg_replace_callback( '#<a[^>]*href=[\'\"]([^\'\"]+)[\'\"][^>]*>[^<]*<\/a>#', function( $matches ) {

		/**
		 * Permit third-party modification of all identified links.
		 *
		 * @param string $html Full link HTML.
		 * @param string $href Link href.
		 */
		$matches[0] = apply_filters( 'post_content_link_filter', $matches[0], $matches[1] );

		return $matches[0];
	}, $content );

	return $content;
}
add_filter( 'the_content', 'post_content_link_filter' );
