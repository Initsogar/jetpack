<?php
/**
 * Test_WPCOM_CSS_Customizer_Nudge file.
 * Test WPCOM_CSS_Customizer_Nudge.
 *
 * @phan-file-suppress PhanDeprecatedFunction -- Ok for deprecated code to call other deprecated code.
 *
 * @package Jetpack
 */

namespace Automattic\Jetpack\Dashboard_Customizations;

require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
require_once ABSPATH . WPINC . '/class-wp-customize-control.php';
require_once ABSPATH . WPINC . '/class-wp-customize-section.php';

/**
 * Class Test_CSS_Customizer_Nudge
 */
class Test_CSS_Customizer_Nudge extends \WP_UnitTestCase {
	/**
	 * A mock Customize manager.
	 *
	 * @var \WP_Customize_Manager
	 */
	private $wp_customize;

	/**
	 * File path for loading the required deprecated file.
	 *
	 * @var string
	 */
	private static $deprecated_file_path = JETPACK__PLUGIN_DIR . 'modules/masterbar/nudges/bootstrap.php';

	/**
	 * Register a customizer manager.
	 *
	 * @return void
	 */
	public function set_up() {
		parent::set_up();

		if ( ! in_array( self::$deprecated_file_path, get_included_files(), true ) ) {
			$this->setExpectedDeprecated( self::$deprecated_file_path );
			$this->setExpectedDeprecated( 'Automattic\Jetpack\Dashboard_Customizations\load_bootstrap_on_init' );
			// phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.NotAbsolutePath -- It's absolute in the class property definition.
			require_once self::$deprecated_file_path;
		}

		do_action( 'init' );

		$this->wp_customize = new \WP_Customize_Manager();
		register_css_nudge_control( $this->wp_customize );
	}

	/**
	 * Check if the assets are registered.
	 *
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\register_css_nudge_control
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\CSS_Customizer_Nudge::__construct
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\CSS_Customizer_Nudge::customize_register_nudge
	 */
	public function test_it_enqueues_the_assets() {
		$nudge      = new CSS_Customizer_Nudge( 'url', 'message' );
		$reflection = new \ReflectionClass( $nudge );
		$wrapper    = $reflection->getProperty( 'css_customizer_nudge_wrapper' );
		$wrapper->setAccessible( true );

		$nudge->customize_register_nudge( $this->wp_customize );

		$this->assertEquals(
			10,
			has_action(
				'customize_controls_enqueue_scripts',
				array(
					$wrapper->getValue( $nudge ),
					'customize_controls_enqueue_scripts_nudge',
				)
			)
		);
	}

	/**
	 * Check if it creates the css nudge control.
	 *
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\register_css_nudge_control
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\CSS_Customizer_Nudge::__construct
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\CSS_Customizer_Nudge::customize_register_nudge
	 */
	public function test_if_it_creates_a_css_nudge_control() {
		$nudge = new CSS_Customizer_Nudge( 'url', 'message' );

		$nudge->customize_register_nudge( $this->wp_customize );

		$this->assertArrayHasKey( 'custom_css_control', $this->wp_customize->controls() );
		$this->assertArrayHasKey( 'custom_css', $this->wp_customize->sections() );
	}

	/**
	 * Check if the url and message are passed correctly to the custom control object.
	 *
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\register_css_nudge_control
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\CSS_Customizer_Nudge::__construct
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\CSS_Customizer_Nudge::customize_register_nudge
	 */
	public function test_if_the_url_and_message_are_passed_correctly() {
		$nudge = new CSS_Customizer_Nudge( 'url', 'message' );

		$nudge->customize_register_nudge( $this->wp_customize );

		$this->assertEquals( 'url', $this->wp_customize->controls()['custom_css_control']->cta_url );
		$this->assertEquals( 'message', $this->wp_customize->controls()['custom_css_control']->nudge_copy );
	}
}
