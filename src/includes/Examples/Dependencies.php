<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DWS_Deps\DeepWebSolutions\Framework\Core\Actions\Foundations\Setupable\States\SetupableInactiveTrait;
use DWS_Deps\DeepWebSolutions\Framework\Core\PluginComponents\AbstractPluginFunctionality;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Actions\Initializable\InitializeDependenciesHandlerTrait;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Actions\Setupable\SetupDependenciesAdminNoticesTrait;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Dependencies\Checkers\PHPExtensionsChecker;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Dependencies\Checkers\PHPFunctionsChecker;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Dependencies\DependenciesServiceAwareTrait;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Dependencies\Handlers\MultiCheckerHandler;

defined( 'ABSPATH' ) || exit;

/**
 * Class Dependencies
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.com>
 * DeepWebSolutions\WP-Plugins\Utility\Examples
 */
class Dependencies extends AbstractPluginFunctionality {
	// region TRAITS

	use DependenciesServiceAwareTrait;
	use InitializeDependenciesHandlerTrait;
	use SetupableInactiveTrait;
	use SetupDependenciesAdminNoticesTrait;

	// endregion

	// region INHERITED METHODS

	/**
	 * Initializes the dependencies checker.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  MultiCheckerHandler
	 */
	public function get_dependencies_handler(): MultiCheckerHandler {
		static $handler = null;

		if ( is_null( $handler ) ) {
			$handler = new MultiCheckerHandler( $this->get_id() );
			$handler->register_checker( new PHPExtensionsChecker( $this->get_id() . 'optional', array( 'test_extension' ) ) );
			$handler->register_checker( new PHPFunctionsChecker( $this->get_id(), array( 'test_function' ) ) );
		}

		return $handler;
	}

	// endregion
}
