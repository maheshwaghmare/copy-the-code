<?php
/**
 * Initialize Plugin
 *
 * @package Copy the Code
 * @since 1.0.0
 */
if( ! class_exists( 'Copy_The_Code' ) ) :

	class Copy_The_Code
	{
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
		public function __construct()
		{
			if( apply_filters( 'copy_the_code_enabled', true ) )
			{
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			}
		}

		/**
		 * Enqueue Assets.
		 *
		 * @version 1.0.0
		 *
		 * @return void
		 */
		function enqueue_assets()
		{
			wp_enqueue_style( 'copy-the-code', COPY_THE_CODE_URI . 'assets/css/copy-the-code.css', NULL, COPY_THE_CODE_VER, 'all' );
			wp_enqueue_script( 'copy-the-code', COPY_THE_CODE_URI . 'assets/js/copy-the-code.js', array( 'jquery' ), COPY_THE_CODE_VER, true );
			wp_localize_script( 'copy-the-code', 'copyTheCode', apply_filters( 'copy_the_code_localize_vars', array(
				'selector' => 'pre', // Selector in which have the actual `<code>`.
				'string'   => array(
					'title'  => __( 'Copy the Code', 'copy-the-code' ),
					'copy'   => __( 'Copy', 'copy-the-code' ),
					'copied' => __( 'Copied!', 'copy-the-code' ),
				),
			)));
		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Copy_The_Code::get_instance();

endif;