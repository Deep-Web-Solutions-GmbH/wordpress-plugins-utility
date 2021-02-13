<?php

use DeepWebSolutions\Framework\Helpers\WordPress\Requests;
use DeepWebSolutions\Framework\Utilities\Factories\LoggerFactory;
use DeepWebSolutions\Framework\Utilities\Handlers\HooksHandler;
use DeepWebSolutions\Framework\Utilities\Handlers\ShortcodesHandler;
use DeepWebSolutions\Framework\Utilities\Interfaces\Pluginable;
use DeepWebSolutions\Framework\Utilities\Services\LoggingService;
use DeepWebSolutions\Plugins\Utility\Examples\Assets;
use DeepWebSolutions\Plugins\Utility\Plugin;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

defined( 'ABSPATH' ) || exit;

return array(
	Plugin::class         => DI\factory(
		function( LoggingService $logging_service, HooksHandler $hooks_handler, ShortcodesHandler $shortcodes_handler ) {
			$plugin = new Plugin( $logging_service );

			$plugin->register_runnable( $hooks_handler );
			$plugin->register_runnable( $shortcodes_handler );

			return $plugin;
		}
	),
	Pluginable::class     => DI\get( Plugin::class ),
	LoggingService::class => DI\autowire()
		->constructorParameter( 'include_sensitive', false )
		->methodParameter( 'set_logger_factory', 'logger_factory', DI\get( LoggerFactory::class ) ),
	LoggerFactory::class  => DI\factory(
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

	Assets::class         => DI\autowire()->constructorParameter( 'root_name', 'Example Assets' ),
);
