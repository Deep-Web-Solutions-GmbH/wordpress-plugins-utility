<?php

namespace DeepWebSolutions\Plugins\Utility;

use DeepWebSolutions\Framework\Core as CoreFramework;

defined( 'ABSPATH' ) || exit;

/**
 * Main utility plugin class.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility
 */
final class Plugin extends CoreFramework\Abstracts\PluginBase {
	/* empty on purpose */
	protected function set_container(): void {
		$this->container = dws_utility_plugin_container();
	}

	protected function set_plugin_file_path(): void {
		$this->plugin_file_path = DWS_UTILITY_PLUGIN_BASE_PATH . 'bootstrap.php';
	}
}
