<?php

namespace DeepWebSolutions\Plugins\Utility;

use DeepWebSolutions\Plugins\Utility\Examples\Assets;
use DeepWebSolutions\Plugins\Utility\Examples\Dependencies;
use DeepWebSolutions\Plugins\Utility\Examples\Hooks;
use DeepWebSolutions\Plugins\Utility\Examples\Installation;
use DeepWebSolutions\Plugins\Utility\Examples\Shortcodes;
use DWS_Deps\DeepWebSolutions\Framework\Core\Plugin\AbstractPluginFunctionalityRoot;

defined( 'ABSPATH' ) || exit;

/**
 * Main utility plugin class.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.com>
 * DeepWebSolutions\WP-Plugins\Utility
 */
final class Plugin extends AbstractPluginFunctionalityRoot {
	// region METHODS

	/**
	 * Register plugin components.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     Functionality::register_children_functionalities()
	 *
	 * @return  array
	 */
	protected function get_di_container_children(): array {
		return array_merge(
			parent::get_di_container_children(),
			array(
				Dependencies::class,
				Hooks::class,
				Shortcodes::class,
				Assets::class,
				Installation::class,
			)
		);
	}

	// endregion
}
