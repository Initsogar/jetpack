<?php
/**
 * Test_WPORG_Additional_Css_Manager file.
 * Test WPORG_Additional_CSS_Manager.
 *
 * @phan-file-suppress PhanDeprecatedFunction -- Ok for deprecated code to call other deprecated code.
 *
 * @package Jetpack
 */

namespace Automattic\Jetpack\Dashboard_Customizations;

require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
require_once ABSPATH . WPINC . '/class-wp-customize-control.php';
require_once ABSPATH . WPINC . '/class-wp-customize-section.php';

require_once JETPACK__PLUGIN_DIR . 'modules/masterbar/nudges/additional-css/class-atomic-additional-css-manager.php';
require_once JETPACK__PLUGIN_DIR . 'modules/masterbar/nudges/additional-css/class-css-nudge-customize-control.php';
require_once JETPACK__PLUGIN_DIR . 'modules/masterbar/nudges/additional-css/class-css-customizer-nudge.php';

/**
 * Class Test_Atomic_Additional_CSS_Manager
 */
class Test_Atomic_Additional_CSS_Manager extends \WP_UnitTestCase {
	/**
	 * A mock Customize manager.
	 *
	 * @var \WP_Customize_Manager
	 */
	private $wp_customize;

	/**
	 * Register a customizer manager.
	 *
	 * @return void
	 */
	public function set_up() {
		parent::set_up();

		$this->wp_customize = new \WP_Customize_Manager();
	}

	/**
	 * Check if the nudge contains the proper url and message copy.
	 *
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\Atomic_Additional_CSS_Manager::__construct
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\Atomic_Additional_CSS_Manager::register_nudge
	 */
	public function test_it_generates_proper_url_and_nudge() {
		$manager = new Atomic_Additional_CSS_Manager( 'foo.com' );

		$manager->register_nudge( $this->wp_customize );

		$this->assertEquals(
			'/checkout/foo.com/business',
			$this->wp_customize->controls()['custom_css_control']->cta_url
		);

		$this->assertEquals(
			'Purchase the Creator plan to<br> activate CSS customization',
			$this->wp_customize->controls()['custom_css_control']->nudge_copy
		);
	}
}
