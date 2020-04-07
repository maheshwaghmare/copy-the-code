<?php
/**
 * Freemius
 *
 * @package Copy the Code
 * @since 1.0.0
 */

// Create a helper function for easy SDK access.
function ctc_fs() {
	global $ctc_fs;

	if ( ! isset( $ctc_fs ) ) {
		// Include Freemius SDK.
		require_once COPY_THE_CODE_DIR . 'freemius/start.php';

		$ctc_fs = fs_dynamic_init(
			array(
				'id'              => '2780',
				'slug'            => 'copy-the-code',
				'type'            => 'plugin',
				'public_key'      => 'pk_15a174f8c30f506a9a35ccbf0fa76',
				'is_premium'      => false,
				'has_addons'      => false,
				'has_paid_plans'  => false,
				'has_affiliation' => 'selected',
				'menu'            => array(
					'slug'           => 'copy-the-code',
					'override_exact' => true,
					'first-path'     => 'options-general.php?page=copy-the-code',
					'network'        => true,
					'parent'         => array(
						'slug' => 'options-general.php',
					),
				),
			)
		);
	}

	return $ctc_fs;
}

// Init Freemius.
ctc_fs();
// Signal that SDK was initiated.
do_action( 'ctc_fs_loaded' );

function ctc_fs_settings_url() {
	return admin_url( 'options-general.php?page=copy-the-code' );
}

ctc_fs()->add_filter( 'connect_url', 'ctc_fs_settings_url' );
ctc_fs()->add_filter( 'after_skip_url', 'ctc_fs_settings_url' );
ctc_fs()->add_filter( 'after_connect_url', 'ctc_fs_settings_url' );
ctc_fs()->add_filter( 'after_pending_connect_url', 'ctc_fs_settings_url' );
