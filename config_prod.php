<?php

use DeepWebSolutions\Framework\Core\PluginComponents\Actions\Installation;
use DeepWebSolutions\Framework\Core\PluginComponents\Actions\Internationalization;
use DeepWebSolutions\Framework\Foundations\Plugin\PluginInterface;
use DeepWebSolutions\Framework\Helpers\WordPress\Request;
use DeepWebSolutions\Framework\Utilities\Hooks\HooksService;
use DeepWebSolutions\Framework\Utilities\Logging\LoggerFactory;
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
	LoggerFactory::class        => factory(
		function() {
			$min_log_level = Request::has_debug() ? Logger::DEBUG : Logger::ERROR;
			$handler       = new RotatingFileHandler( DWS_UTILITY_PLUGIN_TEMP_DIR_PATH . 'errors.log', 30, $min_log_level );

			$logger_factory = new LoggerFactory();

			$logger_factory->register_callable(
				'framework',
				function() use ( $handler ) {
					return new Logger( 'framework', array( $handler ) );
				}
			);
			$logger_factory->register_callable(
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
		->method( 'register_runnable_on_setup', get( HooksService::class ) )
		->method( 'register_runnable_on_setup', get( ShortcodesService::class ) ),

	Assets::class               => DI\autowire()->constructorParameter( 'node_name', 'Example Assets' ),
);
