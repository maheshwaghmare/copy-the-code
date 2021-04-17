<?php
/**
 * Initialize Plugin
 *
 * @package Copy the Code
 * @since 1.0.0
 */

if ( ! class_exists( 'Copy_The_Code' ) ) :

	/**
	 * Copy the Code
	 *
	 * @since 1.0.0
	 */
	class Copy_The_Code {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class Instance.
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			require_once COPY_THE_CODE_DIR . 'classes/class-copy-the-code-update.php';
			require_once COPY_THE_CODE_DIR . 'classes/class-copy-the-code-page.php';
			require_once COPY_THE_CODE_DIR . 'classes/class-copy-the-code-shortcode.php';
		}

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Copy_The_Code::get_instance();

endif;
