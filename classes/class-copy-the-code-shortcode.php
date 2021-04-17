<?php
/**
 * Shortcode
 *
 * @package Copy the Code
 * @since 2.2.0
 */

if ( ! class_exists( 'Copy_The_Code_Shortcode' ) ) :

	/**
	 * Shortcode
	 *
	 * @since 2.2.0
	 */
	class Copy_The_Code_Shortcode {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class Instance.
		 * @since 2.2.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 2.2.0
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
			add_action( 'after_setup_theme', array( $this, 'init_admin_settings' ) );
			add_shortcode( 'copy', array( $this, 'shortcode_markup' ) );
		}

		/**
		 * Shortcode markup
		 *
		 * @since 2.2.0
		 * @param array $atts Shortcode parameters.
		 * @param mixed $content Shortcode content.
		 * @return mixed
		 */
		public function shortcode_markup( $atts = array(), $content = '' ) {

			$atts = shortcode_atts(
				array(
					'target'      => '',
					'text'        => 'Copy',
					'copied-text' => 'Copied!',
					'tag'         => 'a',
					'class'       => '',
					'copy-as'     => 'text',
					'content'     => $content,
				),
				$atts
			);

			return '<' . esc_html( $atts['tag'] ) . ' class="copy-the-code-shortcode ' . esc_attr( $atts['class'] ) . '" data-target="' . esc_attr( $atts['target'] ) . '" data-button-text="' . esc_attr( $atts['text'] ) . '" data-button-copy-text="' . esc_attr( $atts['copied-text'] ) . '" data-content="' . esc_attr( $atts['content'] ) . '" data-copy-as="' . esc_attr( $atts['copy-as'] ) . '">' . esc_html( $atts['text'] ) . '</' . esc_html( $atts['tag'] ) . '>';
		}

		/**
		 * Register menus
		 *
		 * @since 2.2.0
		 * @return void
		 */
		function init_admin_settings() {
			if ( current_user_can( 'edit_posts' ) ) {
				add_action( 'admin_menu', array( $this, 'register' ) );
			}
		}

		/**
		 * Registers the add new portfolio form admin menu for adding portfolios.
		 *
		 * @since 2.2.0
		 *
		 * @return void
		 */
		public function register() {
			add_submenu_page(
				'edit.php?post_type=copy-to-clipboard',
				__( 'Shortcode', 'copy-the-code' ),
				__( 'Shortcode', 'copy-the-code' ),
				'manage_options',
				'shortcode',
				array( $this, 'shortcode_page_markup' )
			);
		}

		/**
		 * Shortcode Page Markup
		 *
		 * @since 2.2.0
		 */
		public function shortcode_page_markup() {
			?>
			<h1>Shortcode</h1>
			<p>Use below shortcode to copy the target into the clipboard.</p>

			<p>Just use the shortcode as:</p>

			<p><code>[copy]hello world[/copy]</code></p>

			<p>The above shortcode shows the link with the text “Copy” and on click, on that link, the text “hello world” copied into the clipboard.</p>

			<p>We see the text “Copied” after clicking on the link which indicates user something is copied to the clipboard.</p>

			<p>See short video:</p>

			<iframe title="copy-content-with-shortcode-mp4" width="640" height="340" src="https://videopress.com/embed/Mo6nR60h?preloadContent=metadata&amp;hd=1" frameborder="0" allowfullscreen=""></iframe>

			<p>That’s it.</p>

			<p>Read more at <a href='https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#shortcode' target="_blank">copy with shortcode</a></p>
			<?php
		}

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Copy_The_Code_Shortcode::get_instance();

endif;
