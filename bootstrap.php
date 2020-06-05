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

use function DeepWebSolutions\Framework\Bootstrap\dws_wp_framework_check_php_wp_requirements_met;
use function DeepWebSolutions\Framework\Bootstrap\dws_wp_framework_output_requirements_error;
use const DeepWebSolutions\Framework\Core\DWS_WP_FRAMEWORK_CORE_INIT;
use DeepWebSolutions\Plugins\Utility\Plugin;
use DI\ContainerBuilder;

defined( 'ABSPATH' ) || exit;

// Start by autoloading dependencies and defining a few functions for running the plugin.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php'; // The conditional check makes the whole thing compatible with Composer-based WP management.
}

define( 'DWS_UTILITY_PLUGIN_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'DWS_UTILITY_PLUGIN_BASE_URL', plugin_dir_url( __FILE__ ) );

// If the installation is faulty for whatever reason, chances are that the constant doesn't exist.
if ( defined( 'DWS_WP_FRAMEWORK_WHITELABEL_NAME' ) ) {
    define( 'DWS_UTILITY_PLUGIN_NAME', DWS_WP_FRAMEWORK_WHITELABEL_NAME . ': Utility Plugin' );
} else {
    define( 'DWS_UTILITY_PLUGIN_NAME', 'Deep Web Solutions: Utility Plugin' );
}

define( 'DWS_UTILITY_PLUGIN_SLUG', 'wp-utility-plugin' );
define( 'DWS_UTILITY_PLUGIN_VERSION', 'v1.0.0' );
define( 'DWS_UTILITY_PLUGIN_MIN_PHP', '7.4' );
define( 'DWS_UTILITY_PLUGIN_MIN_WP', '5.4' );

if ( ! function_exists( 'DeepWebSolutions\Framework\Bootstrap\dws_wp_framework_check_php_wp_requirements_met' ) ) {
    add_action(
        'admin_notices',
        function() {
            require_once __DIR__ . '/src/templates/installation-error.php';
        }
    );
    return; // DWS WP Framework Core is NOT loaded. Do NOT continue.
}

define( 'DWS_UTILITY_PLUGIN_TEMP_DIR_NAME', 'dws-utility-plugin' );
define( 'DWS_UTILITY_PLUGIN_TEMP_DIR_PATH', DWS_WP_FRAMEWORK_TEMP_DIR_PATH . DWS_UTILITY_PLUGIN_TEMP_DIR_NAME );
define( 'DWS_UTILITY_PLUGIN_TEMP_DIR_URL', DWS_WP_FRAMEWORK_TEMP_DIR_URL . DWS_UTILITY_PLUGIN_TEMP_DIR_NAME );

/* @noinspection PhpDocMissingThrowsInspection */
/**
 * Singleton instance function for the plugin.
 *
 * @return Plugin|mixed
 */
function dws_utility_plugin() {
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
 * @throws  Exception   Thrown if initializing the container fails.
 *
 * @return  \DI\Container
 */
function dws_utility_plugin_container( $environment = 'prod' ) {
    static $container;

    if ( empty( $container ) ) {
        $container_builder = new ContainerBuilder();
        $container_builder->addDefinitions( __DIR__ . "/config_{$environment}.php" );
        $container = $container_builder->build();
    }

    return $container;
}

/**
 * Initialization function shortcut.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
function dws_utility_plugin_init() {
    if (DWS_WP_FRAMEWORK_CORE_INIT) {
        dws_utility_plugin()->init();
    }
}

/**
 * Activate function shortcut.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
function dws_utility_plugin_activate() {
    dws_utility_plugin()->activate();
}

/**
 * Deactivate function shortcut.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
function dws_utility_plugin_deactivate() {
    dws_utility_plugin()->deactivate();
}

/** Start plugin initialization if system requirements check out. */
if ( dws_wp_framework_check_php_wp_requirements_met( DWS_UTILITY_PLUGIN_MIN_PHP, DWS_UTILITY_PLUGIN_MIN_WP ) ) {
    add_action( 'plugins_loaded', 'dws_utility_plugin_init', 1000 );
    register_activation_hook( __FILE__, 'dws_utility_plugin_activate' );
    register_deactivation_hook( __FILE__, 'dws_utility_plugin_deactivate' );
} else {
    dws_wp_framework_output_requirements_error( DWS_UTILITY_PLUGIN_NAME, DWS_UTILITY_PLUGIN_VERSION, DWS_UTILITY_PLUGIN_MIN_PHP, DWS_UTILITY_PLUGIN_MIN_WP );
}
