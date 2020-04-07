<?php
/**
 * Plugin Name: Copy Anything to Clipboard
 * Plugin URI: https://github.com/maheshwaghmare/copy-the-code/
 * Description: Copy anything into 📋 (clipboard). By default it add a copy button to the <code>&lt;pre&gt;</code> tag and copy the content from it. We can change the selector and add the copy button anywhere from settings page.
 * Version: 1.6.0
 * Author: Mahesh M. Waghmare
 * Author URI: https://maheshwaghmare.wordpress.com/
 * Text Domain: copy-the-code
 *
 * @package Copy the Code
 */

/**
 * Set constants.
 */
define( 'COPY_THE_CODE_TITLE', 'Copy Anything to Clipboard' );
define( 'COPY_THE_CODE_VER', '1.6.0' );
define( 'COPY_THE_CODE_FILE', __FILE__ );
define( 'COPY_THE_CODE_BASE', plugin_basename( COPY_THE_CODE_FILE ) );
define( 'COPY_THE_CODE_DIR', plugin_dir_path( COPY_THE_CODE_FILE ) );
define( 'COPY_THE_CODE_URI', plugins_url( '/', COPY_THE_CODE_FILE ) );

require_once COPY_THE_CODE_DIR . 'classes/class-copy-the-code.php';
