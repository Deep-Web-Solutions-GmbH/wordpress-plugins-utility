<?php
/**
 * The DWS Utility bootstrap file.
 *
 * @since               1.0.0
 * @version             1.0.0
 * @package             DeepWebSolutions\wp-utility-plugin
 * @author              Deep Web Solutions GmbH
 * @copyright           2020 Deep Web Solutions GmbH
 * @license             GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:         DWS Utility Plugin
 * Description:         A skeleton plugin using the DWS framework that can be used to add site-specific code.
 * Version:             1.0.0
 * Author:              Deep Web Solutions GmbH
 * Author URI:          https://www.deep-web-solutions.de
 * License:             GPL-3.0+
 * License URI:         http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:         dws-wp-utility-plugin
 * Domain Path:         /src/languages
 */

namespace DeepWebSolutions\Plugins;

use DeepWebSolutions\Framework\Core\Abstracts\Exceptions\Initialization\FunctionalityInitializationFailure;
use DeepWebSolutions\Plugins\Utility\Plugin;
use DI\Container;
use DI\ContainerBuilder;
use function DeepWebSolutions\Framework\dws_wp_framework_check_php_wp_requirements_met;
use function DeepWebSolutions\Framework\dws_wp_framework_get_temp_dir_path;
use function DeepWebSolutions\Framework\dws_wp_framework_get_temp_dir_url;
use function DeepWebSolutions\Framework\dws_wp_framework_get_whitelabel_name;
use function DeepWebSolutions\Framework\dws_wp_framework_output_requirements_error;

defined( 'ABSPATH' ) || exit;

// Start by autoloading dependencies and defining a few functions for running the bootstrapper.
// The conditional check makes the whole thing compatible with Composer-based WP management.
file_exists( __DIR__ . '/vendor/autoload.php' ) && require_once __DIR__ . '/vendor/autoload.php';

// Check that the DWS WP Framework is loaded
if ( ! defined( 'DeepWebSolutions\Framework\DWS_WP_FRAMEWORK_BOOTSTRAPPER_INIT' ) ) {
	add_action(
		'admin_notices',
		function() {
			define( 'DWS_UTILITY_PLUGIN_NAME', 'Deep Web Solutions: Utility Plugin' );
			require_once __DIR__ . '/src/templates/installation-error.php';
		}
	);
	return;
}

// Define plugins' constants.
define( 'DWS_UTILITY_PLUGIN_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'DWS_UTILITY_PLUGIN_BASE_URL', plugin_dir_url( __FILE__ ) );

define( 'DWS_UTILITY_PLUGIN_NAME', dws_wp_framework_get_whitelabel_name() . ': Utility Plugin' );
define( 'DWS_UTILITY_PLUGIN_VERSION', '1.0.0' );

define( 'DWS_UTILITY_PLUGIN_TEMP_DIR_NAME', 'dws-utility-plugin' );
define( 'DWS_UTILITY_PLUGIN_TEMP_DIR_PATH', dws_wp_framework_get_temp_dir_path() . DWS_UTILITY_PLUGIN_TEMP_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'DWS_UTILITY_PLUGIN_TEMP_DIR_URL', dws_wp_framework_get_temp_dir_url() . DWS_UTILITY_PLUGIN_TEMP_DIR_NAME . '/' );

// Define minimum environment requirements.
define( 'DWS_UTILITY_PLUGIN_MIN_PHP', '7.4' );
define( 'DWS_UTILITY_PLUGIN_MIN_WP', '5.5' );

/**
 * Singleton instance function for the plugin.
 *
 * @noinspection PhpDocMissingThrowsInspection
 *
 * @return  Plugin
 */
function dws_utility_plugin(): Plugin {
	/* @noinspection PhpUnhandledExceptionInspection */
	return dws_utility_plugin_container()->get( Plugin::class );
}

/**
 * Container singleton that enables one to setup unit testing by passing an environment file for class mapping in PHP-DI.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @param   string  $environment    The environment rules that the container should be initialized on.
 *
 * @noinspection PhpDocMissingThrowsInspection
 *
 * @return  Container
 */
function dws_utility_plugin_container( $environment = 'prod' ): Container {
	static $container;

	if ( empty( $container ) ) {
		/* @noinspection PhpUnhandledExceptionInspection */
		$container = ( new ContainerBuilder() )
			->addDefinitions( __DIR__ . "/config_{$environment}.php" )
			->build();
	}

	return $container;
}

/**
 * Initialization function shortcut.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  FunctionalityInitializationFailure|null
 */
function dws_utility_plugin_initialize(): ?FunctionalityInitializationFailure {
	return dws_utility_plugin()->initialize();
}

/**
 * Activate function shortcut.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
function dws_utility_plugin_activate(): void {
	if ( is_null( dws_utility_plugin_initialize() ) ) {
		dws_utility_plugin()->activate();
	}
}

/**
 * Uninstall function shortcut.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
function dws_utility_plugin_uninstall(): void {
	if ( is_null( dws_utility_plugin_initialize() ) ) {
		dws_utility_plugin()->uninstall();
	}
}

// Start plugin initialization if system requirements check out.
if ( dws_wp_framework_check_php_wp_requirements_met( DWS_UTILITY_PLUGIN_MIN_PHP, DWS_UTILITY_PLUGIN_MIN_WP ) ) {
	add_action( 'plugins_loaded', __NAMESPACE__ . '\dws_utility_plugin_initialize' );

	register_activation_hook( __FILE__, __NAMESPACE__ . '\dws_utility_plugin_activate' );
	register_uninstall_hook( __FILE__, __NAMESPACE__ . '\dws_utility_plugin_uninstall' );
} else {
	dws_wp_framework_output_requirements_error(
		DWS_UTILITY_PLUGIN_NAME,
		DWS_UTILITY_PLUGIN_VERSION,
		DWS_UTILITY_PLUGIN_MIN_PHP,
		DWS_UTILITY_PLUGIN_MIN_WP
	);
}
