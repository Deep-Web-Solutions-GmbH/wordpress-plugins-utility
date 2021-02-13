<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\Abstracts\Functionality;
use DeepWebSolutions\Framework\Core\Traits\Setup\IsActive\Hooks as HooksSetup;
use DeepWebSolutions\Framework\Helpers\WordPress\Requests;
use DeepWebSolutions\Framework\Utilities\Handlers\HooksHandler;

/**
 * Class Hooks
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Hooks extends Functionality {
	use HooksSetup;

	// region INHERITED FUNCTIONS

	/**
	 * Registers hooks with WordPress.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @param   HooksHandler    $hooks_handler      Instance of the hooks handler.
	 */
	protected function register_hooks( HooksHandler $hooks_handler ): void {
		$hooks_handler->add_filter( 'the_content', $this, 'test' );
	}

	// endregion

	// region HOOKS

	/**
	 * Test for the hooks functionality.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @param   string  $content    The content to output on the website.
	 *
	 * @return  string
	 */
	public function test( $content ) {
		if ( Requests::is_request( Requests::FRONTEND_REQUEST ) ) {
			$content .= 'HOOKS OUTPUT ON FRONTEND REQUEST WORKS';
		}

		return $content;
	}

	// endregion
}
