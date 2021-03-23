<?php
/**
 * A very early error message displayed if something doesn't check out.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @package DeepWebSolutions\WP-Plugins\Utility\templates
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="error notice dws-plugin-corrupted-error">
	<p>
		<?php
		echo wp_kses(
			sprintf(
				/* translators: %s: DWS Utility Plugin Name */
				__( 'It seems like <strong>%s</strong> is corrupted. Please reinstall!', 'dws-utility-plugin' ),
				\DeepWebSolutions\Plugins\dws_utility_name()
			),
			array(
				'strong' => array(),
			)
		);
		?>
	</p>
</div>
