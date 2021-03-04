<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\PluginComponents\AbstractPluginFunctionality;
use DeepWebSolutions\Framework\Foundations\Actions\Initializable\InitializableLocalTrait;
use DeepWebSolutions\Framework\Foundations\Actions\Initializable\InitializationFailureException;
use DeepWebSolutions\Framework\Utilities\Actions\Setupable\SetupDependenciesAdminNoticesTrait;
use DeepWebSolutions\Framework\Utilities\Dependencies\Checkers\HandlerChecker;
use DeepWebSolutions\Framework\Utilities\Dependencies\DependenciesCheckerAwareInterface;
use DeepWebSolutions\Framework\Utilities\Dependencies\DependenciesCheckerAwareTrait;
use DeepWebSolutions\Framework\Utilities\Dependencies\Handlers\PHPExtensionsHandler;

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
	use DependenciesCheckerAwareTrait;
	use InitializableLocalTrait;
	use SetupDependenciesAdminNoticesTrait;

	// region INHERITED METHODS

	/**
	 * Initializes the dependencies checker.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  InitializationFailureException|null
	 */
	protected function initialize_local(): ?InitializationFailureException {
		$dependencies_checker = new HandlerChecker();
		$dependencies_checker->register_handler( new PHPExtensionsHandler( $this->get_instance_name(), array( 'test_extension' ) ) );
		$this->set_dependencies_checker( $dependencies_checker );

		return null;
	}

	// endregion
}
