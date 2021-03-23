<?php
/**
 * The DWS Utility bootstrap file.
 *
 * @since               1.0.0
 * @version             1.0.0
 * @package             DeepWebSolutions\WP-Plugins\Utility
 * @author              Deep Web Solutions GmbH
 * @copyright           2020 Deep Web Solutions GmbH
 * @license             GPL-3.0-or-later
 *
 * @noinspection PhpMissingReturnTypeInspection
 *
 * @wordpress-plugin
 * Plugin Name:         DWS Utility Plugin
 * Description:         A skeleton plugin using the DWS framework that can be used to add site-specific code.
 * Version:             1.0.0
 * Author:              Deep Web Solutions GmbH
 * Author URI:          https://www.deep-web-solutions.de
 * License:             GPL-3.0+
 * License URI:         http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:         dws-utility-plugin
 * Domain Path:         /src/languages
 */

namespace DeepWebSolutions\Plugins;

\defined( 'ABSPATH' ) || exit;

// Start by autoloading dependencies and defining a few functions for running the bootstrapper.
// The conditional check makes the whole thing compatible with Composer-based WP management.
\is_file( __DIR__ . '/vendor/autoload.php' ) && require_once __DIR__ . '/vendor/autoload.php';

// Load plugin-specific bootstrapping functions.
require_once __DIR__ . '/bootstrap-functions.php';

// Check that the DWS WP Framework is loaded
if ( ! \function_exists( '\DWS_Deps\DeepWebSolutions\Framework\dws_wp_framework_get_bootstrapper_init_status' ) ) {
	add_action(
		'admin_notices',
		function() {
			require_once __DIR__ . '/src/templates/installation-error.php';
		}
	);
	return;
}

// Define plugins' constants.
\define( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_NAME', \DWS_Deps\DeepWebSolutions\Framework\dws_wp_framework_get_whitelabel_name() . ': Utility Plugin' );
\define( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_VERSION', '1.0.0' );
\define( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_BASE_PATH', plugin_dir_path( __FILE__ ) );

\define( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_TEMP_DIR_NAME', 'dws-utility-plugin' );
\define( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_TEMP_DIR_PATH', \DWS_Deps\DeepWebSolutions\Framework\dws_wp_framework_get_temp_dir_path() . DWS_UTILITY_PLUGIN_TEMP_DIR_NAME . DIRECTORY_SEPARATOR );
\define( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_TEMP_DIR_URL', \DWS_Deps\DeepWebSolutions\Framework\dws_wp_framework_get_temp_dir_url() . DWS_UTILITY_PLUGIN_TEMP_DIR_NAME . '/' );

// Define minimum environment requirements.
\define( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_MIN_PHP', '7.4' );
\define( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_MIN_WP', '5.5' );

// Start plugin initialization if system requirements check out.
if ( \DWS_Deps\DeepWebSolutions\Framework\dws_wp_framework_check_php_wp_requirements_met( dws_utility_min_php(), dws_utility_min_wp() ) ) {
	include __DIR__ . '/functions.php';
	\add_action( 'plugins_loaded', 'dws_utility_plugin_initialize' );

	\register_activation_hook( __FILE__, 'dws_utility_plugin_activate' );
	\register_uninstall_hook( __FILE__, 'dws_utility_plugin_uninstall' );
} else {
	\DWS_Deps\DeepWebSolutions\Framework\dws_wp_framework_output_requirements_error( dws_utility_name(), dws_utility_version(), dws_utility_min_php(), dws_utility_min_wp() );
}
