<?php
/**
 * A very early error message displayed if something doesn't check out.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @package DeepWebSolutions\wp-utility-plugin\templates
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="error notice">
	<p>
		<?php
		echo wp_kses(
			sprintf(
				/* translators: %s: DWS Utility Plugin Name */
				__( 'It seems like <strong>%s</strong> is corrupted. Please reinstall!', 'dws-wp-utility-utility' ),
				DWS_UTILITY_PLUGIN_NAME
			),
			array(
				'strong' => array(),
			)
		);
		?>
	</p>
</div>
