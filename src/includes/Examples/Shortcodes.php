<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\Abstracts\Functionality;
use DeepWebSolutions\Framework\Core\Traits\Setup\IsActive\Shortcodes as ShortcodesSetup;
use DeepWebSolutions\Framework\Utilities\Handlers\ShortcodesHandler;

/**
 * Class Shortcodes
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Shortcodes extends Functionality {
	use ShortcodesSetup;

	// region INHERITED FUNCTIONS

	/**
	 * Registers shortcodes with WordPress.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     ShortcodesSetup::register_shortcodes()
	 *
	 * @param   ShortcodesHandler   $shortcodes_handler     Instance of the shortcodes handler.
	 */
	protected function register_shortcodes( ShortcodesHandler $shortcodes_handler ): void {
		$shortcodes_handler->add_shortcode( 'dws_utility_test_shortcode', $this, 'shortcode_test' );
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
