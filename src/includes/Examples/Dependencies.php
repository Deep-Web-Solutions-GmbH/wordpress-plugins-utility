<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\Actions\Foundations\Setupable\States\SetupableInactiveTrait;
use DeepWebSolutions\Framework\Core\PluginComponents\AbstractPluginFunctionality;
use DeepWebSolutions\Framework\Utilities\Actions\Initializable\InitializeDependenciesChecker;
use DeepWebSolutions\Framework\Utilities\Actions\Setupable\SetupDependenciesAdminNoticesTrait;
use DeepWebSolutions\Framework\Utilities\Dependencies\Checkers\HandlerChecker;
use DeepWebSolutions\Framework\Utilities\Dependencies\DependenciesCheckerAwareInterface;
use DeepWebSolutions\Framework\Utilities\Dependencies\DependenciesCheckerAwareTrait;
use DeepWebSolutions\Framework\Utilities\Dependencies\DependenciesCheckerInterface;
use DeepWebSolutions\Framework\Utilities\Dependencies\Handlers\PHPExtensionsHandler;
use DeepWebSolutions\Framework\Utilities\Dependencies\Handlers\PHPFunctionsHandler;

defined( 'ABSPATH' ) || exit;

/**
 * Class Dependencies
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Dependencies extends AbstractPluginFunctionality implements DependenciesCheckerAwareInterface {
	// region TRAITS

	use DependenciesCheckerAwareTrait;
	use InitializeDependenciesChecker;
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
	 * @return  HandlerChecker
	 */
	protected function register_dependencies_checker(): DependenciesCheckerInterface {
		$dependencies_checker = new HandlerChecker();

		$dependencies_checker->register_handler( new PHPExtensionsHandler( $this->get_instance_name() . 'optional', array( 'test_extension' ) ) );
		$dependencies_checker->register_handler( new PHPFunctionsHandler( $this->get_instance_name(), array( 'test_function' ) ) );

		return $dependencies_checker;
	}

	// endregion
}
