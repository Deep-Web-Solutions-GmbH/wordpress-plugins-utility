<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\Actions\Installable\InstallFailureException;
use DeepWebSolutions\Framework\Core\Actions\Installable\UninstallFailureException;
use DeepWebSolutions\Framework\Core\Actions\Installable\UpdateFailureException;
use DeepWebSolutions\Framework\Core\Actions\InstallableInterface;
use DeepWebSolutions\Framework\Core\PluginComponents\AbstractPluginFunctionality;

defined( 'ABSPATH' ) || exit;

/**
 * Class Installation
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Installation extends AbstractPluginFunctionality implements InstallableInterface {
	// region INHERITED METHODS

	/**
	 * Runs the installable's installation script.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  InstallFailureException|null
	 */
	public function install(): ?InstallFailureException {
		return null;
	}

	/**
	 * Runs the installable's update script.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @param   string  $current_version    The currently installed version.
	 *
	 * @return  UpdateFailureException|null
	 */
	public function update( string $current_version ): ?UpdateFailureException {
		return null;
	}

	/**
	 * Runs the installable's uninstallation script.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @param   string  $current_version    The currently installed version.
	 *
	 * @return  UninstallFailureException|null
	 */
	public function uninstall( string $current_version ): ?UninstallFailureException {
		return null;
	}

	/**
	 * Returns the current version of the installable.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  string
	 */
	public function get_current_version(): string {
		return '5.0.0';
	}

	// endregion
}
