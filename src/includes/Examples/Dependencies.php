<?php

namespace DeepWebSolutions\Plugins\Utility\Examples;

use DeepWebSolutions\Framework\Core\Abstracts\Functionality;
use DeepWebSolutions\Framework\Core\Traits\Setup\Inactive\DependenciesAdminNotice;


/**
 * Class Dependencies
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Antonius Hegyes <a.hegyes@deep-web-solutions.de>
 * @package DeepWebSolutions\Plugins\Utility\Examples
 */
class Dependencies extends Functionality {
	use DependenciesAdminNotice;

	// region INHERITED FUNCTIONS

	/**
	 * Returns a list of required PHP extensions in order to run this functionality. Also displays a notice in the back-end
	 * about it.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  string[]
	 */
	public function get_required_php_extensions(): array {
		return array( 'test_extension' );
	}

	// endregion
}
