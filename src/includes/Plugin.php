<?php

namespace DeepWebSolutions\Plugins\Utility;

use DeepWebSolutions\Plugins\Utility\Examples\Assets;
use DeepWebSolutions\Plugins\Utility\Examples\Dependencies;
use DeepWebSolutions\Plugins\Utility\Examples\Hooks;
use DeepWebSolutions\Plugins\Utility\Examples\Installation;
use DeepWebSolutions\Plugins\Utility\Examples\Shortcodes;
use DWS_Deps\DeepWebSolutions\Framework\Core\Plugin\AbstractPluginFunctionalityRoot;
use function DeepWebSolutions\Plugins\dws_utility_base_path;

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

	// region SETTERS

	/**
	 * Return the absolute path to the plugin file.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 */
	public function get_plugin_file_path(): string {
		return dws_utility_base_path() . 'bootstrap.php';
	}

	// endregion
}
