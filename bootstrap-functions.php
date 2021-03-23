<?php
/**
 * Defines module-specific getters and functions.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.com>
 * @package DeepWebSolutions\WP-Plugins\Utility
 *
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace DeepWebSolutions\Plugins;

\defined( 'ABSPATH' ) || exit;

/**
 * Returns the whitelabel name of the plugin.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function dws_utility_name() {
	return \defined( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_NAME' ) ? \constant( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_NAME' ) : 'Utility Plugin';
}

/**
 * Returns the version of the plugin.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function dws_utility_version() {
	return \constant( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_VERSION' );
}

/**
 * Returns the base path of the plugin.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function dws_utility_base_path() {
	return \constant( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_BASE_PATH' );
}

/**
 * Returns the temp directory name of the plugin.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function dws_utility_temp_dir_name() {
	return \constant( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_TEMP_DIR_NAME' );
}

/**
 * Returns the filesystem path to the temp directory of the plugin.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function dws_utility_temp_dir_path() {
	return \constant( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_TEMP_DIR_PATH' );
}

/**
 * Returns the URL to the temp directory of the plugin.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function dws_utility_temp_dir_url() {
	return \constant( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_TEMP_DIR_URL' );
}

/**
 * Returns the minimum PHP version required to run the plugin.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function dws_utility_min_php() {
	return \constant( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_MIN_PHP' );
}

/**
 * Returns the minimum WP version required to run the plugin.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function dws_utility_min_wp() {
	return \constant( __NAMESPACE__ . '\DWS_UTILITY_PLUGIN_MIN_WP' );
}
