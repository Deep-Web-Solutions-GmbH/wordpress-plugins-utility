<?php

use DeepWebSolutions\Framework\Core\PluginComponents\Actions\Installation;
use DeepWebSolutions\Framework\Core\PluginComponents\Actions\Internationalization;
use DeepWebSolutions\Framework\Foundations\Plugin\PluginInterface;
use DeepWebSolutions\Framework\Helpers\WordPress\Request;
use DeepWebSolutions\Framework\Utilities\Hooks\Handlers\HooksHandler;
use DeepWebSolutions\Framework\Utilities\Hooks\HooksService;
use DeepWebSolutions\Framework\Utilities\Logging\LoggingService;
use DeepWebSolutions\Framework\Utilities\Shortcodes\ShortcodesService;
use DeepWebSolutions\Plugins\Utility\Examples\Assets;
use DeepWebSolutions\Plugins\Utility\Plugin;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use function DeepWebSolutions\Plugins\dws_utility_plugin_container;
use function DI\factory;
use function DI\get;
use function DI\autowire;

defined( 'ABSPATH' ) || exit;

return array(
	// Utilities
	PluginInterface::class      => get( Plugin::class ),
	LoggingService::class       => factory(
		function( PluginInterface $plugin ) {
			$logging_service = new LoggingService( $plugin, array(), false );

			$min_log_level = Request::has_debug() ? Logger::DEBUG : Logger::ERROR;
			$handler       = new RotatingFileHandler( DWS_UTILITY_PLUGIN_TEMP_DIR_PATH . 'errors.log', 30, $min_log_level );

			$logging_service->register_logger( 'framework', new Logger( 'framework', array( $handler ) ) );
			$logging_service->register_logger( 'plugin', new Logger( 'plugin', array( $handler ) ) );

			return $logging_service;
		}
	),

	HooksService::class         => factory(
		function( Plugin $plugin, LoggingService $logging_service, HooksHandler $handler ) {
			$hooks_service = new HooksService( $plugin, $logging_service, $handler );
			$plugin->register_runnable_on_setup( $hooks_service );
			return $hooks_service;
		}
	),
	ShortcodesService::class    => factory(
		function( Plugin $plugin, LoggingService $logging_service ) {
			$shortcodes_Service = new ShortcodesService( $plugin, $logging_service );
			$plugin->register_runnable_on_setup( $shortcodes_Service );
			return $shortcodes_Service;
		}
	),

	// Core
	Installation::class         => autowire()->constructorParameter( 'component_name', 'Installation' ),
	Internationalization::class => autowire()->constructorParameter( 'component_name', 'Internationalization' ),

	// Plugin
	Plugin::class               => autowire()->method( 'set_container', dws_utility_plugin_container() ),
	Assets::class               => autowire()->constructorParameter( 'component_name', 'Example Assets' ),
);
