<?php
/**
 * CSS_Nudge_Customize_Control file.
 * Test CSS_Nudge_Customize_Control.
 *
 * @phan-file-suppress PhanDeprecatedFunction -- Ok for deprecated code to call other deprecated code.
 *
 * @package Jetpack
 */

namespace Automattic\Jetpack\Dashboard_Customizations;

require_once ABSPATH . WPINC . '/class-wp-customize-control.php';
require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';

/**
 * Class Test_CSS_Nudge_Customize_Control
 */
class Test_CSS_Nudge_Customize_Control extends \WP_UnitTestCase {

	/**
	 * File path for loading the required deprecated file.
	 *
	 * @var string
	 */
	private static $deprecated_file_path = JETPACK__PLUGIN_DIR . 'modules/masterbar/nudges/bootstrap.php';

	/**
	 * Runs before each test.
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
	}

	/**
	 * Check if the HTML for the nudge section is properly generated.
	 *
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\register_css_nudge_control
	 * @expectedDeprecated Automattic\Jetpack\Dashboard_Customizations\CSS_Nudge_Customize_Control::render_content
	 */
	public function test_if_the_html_is_generated_properly() {
		$manager = new \WP_Customize_Manager();

		register_css_nudge_control( $manager );
		$control = new CSS_Nudge_Customize_Control(
			$manager,
			'foo',
			array(
				'cta_url'    => 'https://wordpress.com',
				'nudge_copy' => 'foo',
			)
		);

		$this->assertEquals( 'https://wordpress.com', $control->cta_url );
		$this->assertEquals( 'foo', $control->nudge_copy );
		ob_start();
		$control->render_content();
		$content = ob_get_contents();
		ob_end_clean();
		$expected_output = '<div class="nudge-container">
				<p>
					foo
				</p>
				<div class="button-container">
					<button type="button" class="button-primary navigate-to" data-navigate-to-page="https://wordpress.com">Upgrade now</button>
				</div>
			</div>';
		$this->assertEquals( $expected_output, $content );
	}
}
