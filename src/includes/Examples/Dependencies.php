<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DWS_Deps\DeepWebSolutions\Framework\Core\Plugin\AbstractPluginFunctionality;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Actions\Initializable\InitializeAdminNoticesServiceTrait;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Dependencies\Actions\InitializeDependenciesHandlersTrait;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Dependencies\Actions\SetupDependenciesAdminNoticesTrait;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Dependencies\Checkers\PHPExtensionsChecker;
use DWS_Deps\DeepWebSolutions\Framework\Utilities\Dependencies\Checkers\PHPFunctionsChecker;
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

	use InitializeAdminNoticesServiceTrait;
	use InitializeDependenciesHandlersTrait;
	use SetupDependenciesAdminNoticesTrait;

	// endregion

	// region INHERITED METHODS

	/**
	 * Initializes the dependencies checker.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  MultiCheckerHandler[]
	 */
	public function get_dependencies_handlers(): array {
		static $handler = null;

		if ( is_null( $handler ) ) {
			$handler = new MultiCheckerHandler( $this->get_id() . '_active' );
			$handler->register_checker( new PHPExtensionsChecker( $this->get_id() . 'optional', array( 'test_extension' ) ) );
			$handler->register_checker( new PHPFunctionsChecker( $this->get_id(), array( 'test_function' ) ) );
		}

		return array( $handler );
	}

	// endregion
}
