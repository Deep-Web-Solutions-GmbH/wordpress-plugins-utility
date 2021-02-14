<?php

namespace DeepWebSolutions\Plugins\Utility;

use DeepWebSolutions\Framework\Core\Abstracts\PluginRoot;
use DeepWebSolutions\Plugins\Utility\Examples\Assets;
use DeepWebSolutions\Plugins\Utility\Examples\Dependencies;
use DeepWebSolutions\Plugins\Utility\Examples\Hooks;
use DeepWebSolutions\Plugins\Utility\Examples\Shortcodes;
use function DeepWebSolutions\Plugins\dws_utility_plugin_container;

defined( 'ABSPATH' ) || exit;

/**
 * Main utility plugin class.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility
 */
final class Plugin extends PluginRoot {
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
	protected function define_children(): array {
		return array_merge( parent::define_children(), array( Dependencies::class, Hooks::class, Shortcodes::class, Assets::class ) );
	}

	// endregion

	// region SETTERS

	/**
	 * Sets the static instance of the PHP-DI container.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     PluginBase::set_container()
	 *
	 * @throws  \Exception   Thrown if initializing the container fails.
	 */
	protected function set_container(): void {
		$this->container = dws_utility_plugin_container();
	}

	/**
	 * Sets the absolute path to the plugin file.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     PluginBase::set_plugin_file_path()
	 */
	protected function set_plugin_file_path(): void {
		$this->plugin_file_path = DWS_UTILITY_PLUGIN_BASE_PATH . 'bootstrap.php';
	}

	// endregion

	// region WP-SPECIFIC METHODS

	/**
	 * Activation routine.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     PluginBase::activate()
	 */
	public function activate(): void {
		/* empty on purpose */
	}

	/**
	 * Deactivation routine.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     PluginBase::deactivate()
	 */
	public function deactivate(): void {
		/* empty on purpose */
	}

	/**
	 * Uninstallation routine.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @see     PluginBase::uninstall()
	 */
	public function uninstall(): void {
		/* empty on purpose */
	}

	// endregion
}
