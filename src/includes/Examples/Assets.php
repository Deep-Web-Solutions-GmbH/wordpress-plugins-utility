<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\PluginComponents\AbstractPluginFunctionality;
use DeepWebSolutions\Framework\Utilities\Actions\Setupable\SetupStylesTrait;
use DeepWebSolutions\Framework\Utilities\Assets\Handlers\StylesHandler;

defined( 'ABSPATH' ) || exit;

/**
 * Class Assets
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Assets extends AbstractPluginFunctionality {
	use SetupStylesTrait;

	// region INHERITED METHODS

	/**
	 * Registers and/or enqueues styles with WordPress.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @param   StylesHandler   $styles_handler     Instance of the styles handler.
	 */
	public function register_styles( StylesHandler $styles_handler ): void {
		$styles_handler->enqueue_admin_style(
			$this->get_asset_handle( 'example' ),
			$this->get_plugin()->get_assets_base_relative_url() . 'dist/admin/css/example-admin.css',
			$this->get_plugin()->get_plugin_version()
		);
		$styles_handler->enqueue_public_style(
			$this->get_asset_handle( 'example' ),
			$this->get_plugin()->get_assets_base_relative_url() . 'dist/public/css/example-public.css',
			$this->get_plugin()->get_plugin_version()
		);
	}

	// endregion
}
