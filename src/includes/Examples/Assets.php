<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\Abstracts\PluginFunctionality;
use DeepWebSolutions\Framework\Core\Traits\Setup\Assets as AssetsSetup;
use DeepWebSolutions\Framework\Utilities\Handlers\AssetsHandler;

/**
 * Class Assets
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Assets extends PluginFunctionality {
	use AssetsSetup;

	// region INHERITED METHODS

	/**
	 * Registers and/or enqueues assets with WordPress.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @param   AssetsHandler   $assets_handler     Instance of the assets handler.
	 */
	protected function enqueue_assets( AssetsHandler $assets_handler ): void {
		$assets_handler->enqueue_admin_style(
			$this->get_asset_handle( 'example' ),
			$this->get_plugin()->get_assets_base_relative_url() . 'dist/admin/css/example-admin.css',
			$this->get_plugin()->get_plugin_version()
		);
		$assets_handler->enqueue_public_style(
			$this->get_asset_handle( 'example' ),
			$this->get_plugin()->get_assets_base_relative_url() . 'dist/public/css/example-public.css',
			$this->get_plugin()->get_plugin_version()
		);
	}

	// endregion
}
