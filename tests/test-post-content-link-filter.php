<?php
/**
 * Class PostContentLinkFilter
 *
 * @package Post_Content_Link_Filter
 */

/**
 * Test application of post content link filtering.
 */
class PostContentLinkFilterTest extends WP_UnitTestCase {

	/**
	 * Ensure data is passed through to the filter as expected.
	 */
	public function test_data_passed_filter() {
		$post_content = <<<EOT
This is a <a href="http://apple.com">Apple</a> link.
EOT;
		$called_once = false;
		$filter = function( $html, $href ) use ( &$called_once ) {
			$called_once = true;
			$this->assertEquals( '<a href="http://apple.com">Apple</a>', $html );
			$this->assertEquals( 'http://apple.com', $href );
			return $html;
		};
		add_filter( 'post_content_link_filter', $filter, 10, 2 );
		$post_content = post_content_link_filter( $post_content );
		$this->assertTrue( $called_once );
	}

}
