<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\PluginComponents\AbstractPluginFunctionality;
use DeepWebSolutions\Framework\Utilities\Actions\Setupable\SetupShortcodesTrait;
use DeepWebSolutions\Framework\Utilities\Shortcodes\ShortcodesService;

defined( 'ABSPATH' ) || exit;

/**
 * Class Shortcodes
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Shortcodes extends AbstractPluginFunctionality {
	use SetupShortcodesTrait;

	// region INHERITED METHODS

	/**
	 * Registers shortcodes with WordPress.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     SetupShortcodesTrait::register_shortcodes()
	 *
	 * @param   ShortcodesService   $shortcodes_service     Instance of the shortcodes service.
	 */
	protected function register_shortcodes( ShortcodesService $shortcodes_service ): void {
		$shortcodes_service->add_shortcode( 'dws_utility_test_shortcode', $this, 'shortcode_test' );
	}

	// endregion

	// region SHORTCODES

	/**
	 * Computes the output of the shortcode ''dws_utility_test_shortcode'.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  string
	 */
	public function shortcode_test() {
		return 'THIS SHORTCODES WORKS';
	}

	// endregion
}
