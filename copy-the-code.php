<?php
/**
 * Plugin Name: Copy Anything to Clipboard
 * Plugin URI: https://github.com/maheshwaghmare/copy-the-code/
 * Description: Copy the Text or HTML into the clipboard 📋 (clipboard). You can use it for code snippets, special symbols, discount codes, or anything which you want. By default it add the copy to clipboard button to the <code>&lt;pre&gt;</code> tag. Documentations and more visit <a href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/"> on GitHub</a>.
 * Version: 2.2.0
 * Author: Mahesh M. Waghmare
 * Author URI: https://maheshwaghmare.wordpress.com/
 * Text Domain: copy-the-code
 *
 * @package Copy the Code
 */

// Set constants.
define( 'COPY_THE_CODE_TITLE', esc_html__( 'Copy Anything to Clipboard', 'copy-the-code' ) );
define( 'COPY_THE_CODE_VER', '2.2.0' );
define( 'COPY_THE_CODE_FILE', __FILE__ );
define( 'COPY_THE_CODE_BASE', plugin_basename( COPY_THE_CODE_FILE ) );
define( 'COPY_THE_CODE_DIR', plugin_dir_path( COPY_THE_CODE_FILE ) );
define( 'COPY_THE_CODE_URI', plugins_url( '/', COPY_THE_CODE_FILE ) );

require_once COPY_THE_CODE_DIR . 'classes/class-copy-the-code.php';
