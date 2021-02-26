<?php

use DeepWebSolutions\Framework\Core\Actions\Installation;
use DeepWebSolutions\Framework\Core\Actions\Internationalization;
use DeepWebSolutions\Framework\Helpers\WordPress\Requests;
use DeepWebSolutions\Framework\Utilities\Factories\LoggerFactory;
use DeepWebSolutions\Framework\Utilities\Handlers\AdminNoticesHandler;
use DeepWebSolutions\Framework\Utilities\Handlers\HooksHandler;
use DeepWebSolutions\Framework\Utilities\Handlers\ShortcodesHandler;
use DeepWebSolutions\Framework\Utilities\Interfaces\Resources\Pluginable;
use DeepWebSolutions\Framework\Utilities\Services\LoggingService;
use DeepWebSolutions\Plugins\Utility\Examples\Assets;
use DeepWebSolutions\Plugins\Utility\Examples\Dependencies;
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
	Pluginable::class           => get( Plugin::class ),
	LoggerFactory::class        => factory(
		function() {
			$min_log_level = Requests::has_debug() ? Logger::DEBUG : Logger::ERROR;
			$handler       = new RotatingFileHandler( DWS_UTILITY_PLUGIN_TEMP_DIR_PATH . 'errors.log', 30, $min_log_level );

			$logger_factory = new LoggerFactory();

			$logger_factory->register_factory_callable(
				'framework',
				function() use ( $handler ) {
					return new Logger( 'framework', array( $handler ) );
				}
			);
			$logger_factory->register_factory_callable(
				'plugin',
				function() use ( $handler ) {
					return new Logger( 'plugin', array( $handler ) );
				}
			);

			return $logger_factory;
		}
	),
	LoggingService::class       => autowire()->constructorParameter( 'include_sensitive', false ),

	// Core
	Installation::class         => autowire()->constructorParameter( 'node_name', 'Installation' ),
	Internationalization::class => autowire()->constructorParameter( 'node_name', 'Internationalization' ),

	// Plugin
	Plugin::class               => autowire()
		->method( 'set_container', dws_utility_plugin_container() )
		->method( 'register_runnable_on_setup', get( HooksHandler::class ) )
		->method( 'register_runnable_on_setup', get( ShortcodesHandler::class ) ),

	Assets::class               => DI\autowire()
		->constructorParameter( 'node_name', 'Example Assets' ),
	Dependencies::class         => DI\autowire()
		->methodParameter( 'set_admin_notices_handler', 'admin_notices_handler', DI\get( AdminNoticesHandler::class ) ),
);
