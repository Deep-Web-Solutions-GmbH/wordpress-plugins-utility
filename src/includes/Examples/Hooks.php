<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DWS_Deps\DeepWebSolutions\Framework\Core\Plugin\AbstractPluginFunctionality;
use DWS_Deps\DeepWebSolutions\Framework\Helpers\WordPress\Request;
use DWS_Deps\DeepWebSolutions\Framework\Helpers\WordPress\RequestTypesEnum;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Actions\Setupable\SetupHooksTrait;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Hooks\HooksService;

defined( 'ABSPATH' ) || exit;

/**
 * Class Hooks
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.com>
 * DeepWebSolutions\WP-Plugins\Utility\Examples
 */
class Hooks extends AbstractPluginFunctionality {
	use SetupHooksTrait;

	// region INHERITED METHODS

	/**
	 * Registers hooks with WordPress.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     SetupHooksTrait::register_hooks()
	 *
	 * @param   HooksService    $hooks_service      Instance of the hooks service.
	 */
	public function register_hooks( HooksService $hooks_service ): void {
		$hooks_service->add_filter( 'the_content', $this, 'test' );
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
		if ( Request::is_type( RequestTypesEnum::FRONTEND_REQUEST ) ) {
			$content .= 'HOOKS OUTPUT ON FRONTEND REQUEST WORKS 222';
		}

		return $content;
	}

	// endregion
}
