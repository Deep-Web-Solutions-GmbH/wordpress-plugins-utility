<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\Abstracts\PluginFunctionality;
use DeepWebSolutions\Framework\Core\Interfaces\Actions\Exceptions\Installable\InstallFailure;
use DeepWebSolutions\Framework\Core\Interfaces\Actions\Exceptions\Installable\UninstallFailure;
use DeepWebSolutions\Framework\Core\Interfaces\Actions\Exceptions\Installable\UpdateFailure;
use DeepWebSolutions\Framework\Core\Interfaces\Actions\Installable;

/**
 * Class Installation
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Installation extends PluginFunctionality implements Installable {
	// region INHERITED METHODS

	/**
	 * Runs the installable's installation script.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  InstallFailure|null
	 */
	public function install(): ?InstallFailure {
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
	 * @return  UpdateFailure|null
	 */
	public function update( string $current_version ): ?UpdateFailure {
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
	 * @return  UninstallFailure|null
	 */
	public function uninstall( string $current_version ): ?UninstallFailure {
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
