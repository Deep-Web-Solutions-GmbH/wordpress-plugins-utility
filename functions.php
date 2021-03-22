<?php

use DeepWebSolutions\Plugins\Utility\Plugin;
use DWS_Deps\DeepWebSolutions\Framework\Core\PluginComponents\Exceptions\FunctionalityInitFailureException;
use DWS_Deps\DI\Container;
use DWS_Deps\DI\ContainerBuilder;

defined( 'ABSPATH' ) || exit;

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
 * @return  FunctionalityInitFailureException|null
 */
function dws_utility_plugin_initialize(): ?FunctionalityInitFailureException {
	return dws_utility_plugin()->initialize();
}

/**
 * Activate function shortcut.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
function dws_utility_plugin_activate() {
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
function dws_utility_plugin_uninstall() {
	if ( is_null( dws_utility_plugin_initialize() ) ) {
		dws_utility_plugin()->uninstall();
	}
}
