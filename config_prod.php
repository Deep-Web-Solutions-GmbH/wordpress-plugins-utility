<?php

use DeepWebSolutions\Plugins\Utility\Plugin;
use DWS_Deps\DeepWebSolutions\Framework\Core\PluginComponents\Actions\Installation;
use DWS_Deps\DeepWebSolutions\Framework\Core\PluginComponents\Actions\Internationalization;
use DWS_Deps\DeepWebSolutions\Framework\Foundations\Logging\LoggingHandler;
use DWS_Deps\DeepWebSolutions\Framework\Foundations\Logging\LoggingService;
use DWS_Deps\DeepWebSolutions\Framework\Foundations\Plugin\PluginInterface;
use DWS_Deps\DeepWebSolutions\Framework\Helpers\WordPress\Assets;
use DWS_Deps\DeepWebSolutions\Framework\Helpers\WordPress\Request;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Hooks\Handlers\DefaultHooksHandler;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Hooks\HooksService;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Shortcodes\ShortcodesService;
use DWS_Deps\Monolog\Handler\RotatingFileHandler;
use DWS_Deps\Monolog\Logger;
use function DeepWebSolutions\Plugins\dws_utility_temp_dir_path;
use function DWS_Deps\DI\autowire;
use function DWS_Deps\DI\factory;
use function DWS_Deps\DI\get;

defined( 'ABSPATH' ) || exit;

return array(
	// Utilities
	PluginInterface::class      => get( Plugin::class ),
	LoggingService::class       => factory(
		function( PluginInterface $plugin ) {
			$min_log_level = Request::has_debug() ? Logger::DEBUG : Logger::ERROR;
			$handler       = new RotatingFileHandler( dws_utility_temp_dir_path() . 'errors.log', 30, $min_log_level );
			$handlers      = array(
				new LoggingHandler( 'framework', new Logger( 'framework', array( $handler ) ) ),
				new LoggingHandler( 'plugin', new Logger( 'plugin', array( $handler ) ) ),
			);

			return new LoggingService( $plugin, $handlers, Request::has_debug() );
		}
	),

	HooksService::class         => factory(
		function( Plugin $plugin, LoggingService $logging_service, DefaultHooksHandler $handler ) {
			$hooks_service = new HooksService( $plugin, $logging_service, $handler );
			$plugin->register_runnable_on_setup( $hooks_service );
			return $hooks_service;
		}
	),
	ShortcodesService::class    => factory(
		function( Plugin $plugin, LoggingService $logging_service ) {
			$shortcodes_service = new ShortcodesService( $plugin, $logging_service );
			$plugin->register_runnable_on_setup( $shortcodes_service );
			return $shortcodes_service;
		}
	),

	// Core
	Installation::class         => autowire()->constructorParameter( 'component_name', 'Installation' ),
	Internationalization::class => autowire()->constructorParameter( 'component_name', 'Internationalization' ),

	// Plugin
	Assets::class               => autowire()->constructorParameter( 'component_name', 'Example Assets' ),
);
