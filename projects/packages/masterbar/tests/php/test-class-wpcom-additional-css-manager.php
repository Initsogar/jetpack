<?php
/**
 * Test WPCOM_Additional_CSS_Manager.
 *
 * @package automattic/jetpack-masterbar
 */

namespace Automattic\Jetpack\Masterbar;

use PHPUnit\Framework\TestCase;

require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
require_once ABSPATH . WPINC . '/class-wp-customize-control.php';
require_once ABSPATH . WPINC . '/class-wp-customize-section.php';

/**
 * Class Test_WPCOM_Additional_Css_Manager
 *
 * @covers Automattic\Jetpack\Masterbar\WPCOM_Additional_CSS_Manager
 */
class Test_WPCOM_Additional_Css_Manager extends TestCase {

	/**
	 * A mock Customize manager.
	 *
	 * @var \WP_Customize_Manager
	 */
	private $wp_customize;

	/**
	 * Register a customizer manager.
	 *
	 * @before
	 */
	public function set_up() {
		$this->wp_customize = new \WP_Customize_Manager();
	}

	/**
	 * Check if the manager constructs the proper url and copy message.
	 */
	public function test_it_generates_proper_url_and_nudge() {
		$manager = new WPCOM_Additional_CSS_Manager( 'foo.com' );

		$manager->register_nudge( $this->wp_customize );
		$this->assertEquals(
			'/checkout/foo.com/premium',
			$this->wp_customize->controls()['jetpack_custom_css_control']->cta_url
		);
		$this->assertEquals(
			'Purchase the Explorer plan to<br> activate CSS customization',
			$this->wp_customize->controls()['jetpack_custom_css_control']->nudge_copy
		);
	}
}
