<?php
/**
 * Settings Page
 *
 * @package Copy the Code
 * @since 1.2.0
 */

if ( ! class_exists( 'Copy_The_Code_Page' ) ) :

	/**
	 * Copy_The_Code_Page
	 *
	 * @since 1.2.0
	 */
	class Copy_The_Code_Page {

		/**
		 * Instance
		 *
		 * @since 1.2.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.2.0
		 *
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
		 *
		 * @since 1.2.0
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
			add_action( 'plugin_action_links_' . COPY_THE_CODE_BASE, array( $this, 'action_links' ) );
			add_action( 'after_setup_theme', array( $this, 'save_settings' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_assets' ) );
		}

		/**
		 * Enqueue Assets.
		 *
		 * @version 1.7.0
		 *
		 * @return void
		 */
		function admin_enqueue_assets() {
			wp_enqueue_script( 'copy-the-code-page', COPY_THE_CODE_URI . 'assets/js/page.js', array( 'jquery' ), COPY_THE_CODE_VER, true );
		}

		/**
		 * Enqueue Assets.
		 *
		 * @version 1.0.0
		 *
		 * @return void
		 */
		function enqueue_assets() {
			wp_enqueue_style( 'copy-the-code', COPY_THE_CODE_URI . 'assets/css/copy-the-code.css', null, COPY_THE_CODE_VER, 'all' );
			wp_enqueue_script( 'copy-the-code', COPY_THE_CODE_URI . 'assets/js/copy-the-code.js', array( 'jquery' ), COPY_THE_CODE_VER, true );
			wp_localize_script(
				'copy-the-code',
				'copyTheCode',
				apply_filters(
					'copy_the_code_localize_vars',
					array(
						'selector' => 'pre', // Selector in which have the actual `<code>`.
						'settings' => $this->get_page_settings(),
						'string'   => array(
							'title'  => $this->get_page_setting( 'button-title', __( 'Copy to Clipboard', 'copy-the-code' ) ),
							'copy'   => $this->get_page_setting( 'button-text', __( 'Copy', 'copy-the-code' ) ),
							'copied' => $this->get_page_setting( 'button-copy-text', __( 'Copied!', 'copy-the-code' ) ),
						),
					)
				)
			);
		}

		/**
		 * Admin Settings
		 *
		 * @return void
		 */
		function save_settings() {

			if ( isset( $_REQUEST['page'] ) && strpos( $_REQUEST['page'], 'copy-the-code' ) !== false ) {

				// Only admins can save settings.
				if ( ! current_user_can( 'manage_options' ) ) {
					return;
				}

				// Make sure we have a valid nonce.
				if ( isset( $_REQUEST['copy-the-code'] ) && wp_verify_nonce( $_REQUEST['copy-the-code'], 'copy-the-code-nonce' ) ) {

					// Stored Settings.
					$stored_data = $this->get_page_settings();

					// New settings.
					$new_data = array(
						'selector'         => ( isset( $_REQUEST['selector'] ) ) ? $_REQUEST['selector'] : 'pre',
						'copy-as'          => ( isset( $_REQUEST['copy-as'] ) ) ? $_REQUEST['copy-as'] : 'html',
						'button-text'      => ( isset( $_REQUEST['button-text'] ) ) ? $_REQUEST['button-text'] : 'Copy',
						'button-title'     => ( isset( $_REQUEST['button-title'] ) ) ? $_REQUEST['button-title'] : 'Copy',
						'button-copy-text' => ( isset( $_REQUEST['button-copy-text'] ) ) ? $_REQUEST['button-copy-text'] : 'Copied!',
						'button-position'  => ( isset( $_REQUEST['button-position'] ) ) ? $_REQUEST['button-position'] : 'inside',
					);

					// Merge settings.
					$data = wp_parse_args( $new_data, $stored_data );

					// Update settings.
					update_option( 'copy-the-code-settings', $data );
				}
			}
		}

		/**
		 * Get Setting
		 *
		 * @return mixed Single Setting.
		 */
		function get_page_setting( $key = '', $default_value = '' ) {
			$settings = $this->get_page_settings();

			if ( array_key_exists( $key, $settings ) ) {
				return $settings[ $key ];
			}

			return $default_value;
		}

		/**
		 * Settings
		 *
		 * @return array Settings.
		 */
		function get_page_settings() {
			$defaults = apply_filters(
				'copy_the_code_default_page_settings',
				array(
					'selector'         => 'pre',
					'copy-as'          => 'html',
					'button-text'      => __( 'Copy', 'copy-the-code' ),
					'button-title'     => __( 'Copy to Clipboard', 'copy-the-code' ),
					'button-copy-text' => __( 'Copied!', 'copy-the-code' ),
					'button-position'  => 'inside',
				)
			);

			$stored = get_option( 'copy-the-code-settings', $defaults );

			return apply_filters( 'copy_the_code_page_settings', wp_parse_args( $stored, $defaults ) );
		}

		/**
		 * Show action links on the plugin screen.
		 *
		 * @param   mixed $links Plugin Action links.
		 * @return  array
		 */
		function action_links( $links ) {
			$action_links = array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=copy-the-code' ) . '" aria-label="' . esc_attr__( 'Settings', 'copy-the-code' ) . '">' . esc_html__( 'Settings', 'copy-the-code' ) . '</a>',
			);

			return array_merge( $action_links, $links );
		}

		/**
		 * Register menu
		 *
		 * @since 1.2.0
		 * @return void
		 */
		function register_admin_menu() {
			add_submenu_page( 'options-general.php', __( 'Copy to Clipboard', 'copy-the-code' ), __( 'Copy to Clipboard', 'copy-the-code' ), 'manage_options', 'copy-the-code', array( $this, 'options_page' ) );
		}

		/**
		 * Tabs
		 *
		 * @since 1.7.0
		 * @return array
		 */
		function get_tabs() {
			return array(
				'general' => esc_html__( 'General', 'copy-the-code' ),
				'style' => esc_html__( 'Style', 'copy-the-code' ),
			);
		}

		/**
		 * Option Page
		 *
		 * @since 1.2.0
		 * @return void
		 */
		function options_page() {
			$data = $this->get_page_settings();
			?>
			<div class="wrap copy-the-code" id="sync-post">
				<div class="wrap">
					<h1><?php echo esc_html( COPY_THE_CODE_TITLE ); ?> <small>v<?php echo esc_html( COPY_THE_CODE_VER ); ?></small></h1>
					<div id="poststuff">
						<div id="post-body" class="columns-2">
							<div id="post-body-content">

								<div class="nav-tab-wrapper">
									<?php $tabs = $this->get_tabs(); ?>
									<?php foreach ($tabs as $tab_slug => $tab_title) { ?>
										<a class="nav-tab" style="cursor: pointer;" data-id="tab-<?php echo esc_attr( $tab_slug ); ?>"><?php echo esc_html( $tab_title ); ?></a>
									<?php } ?>
								</div>	

								<form enctype="multipart/form-data" method="post">
									<div class="tabs">
										<div id="tab-general" style="padding: 30px;">
											<table class="form-table">
												<tr>
													<th scope="row"><?php _e( 'Selector', 'copy-the-code' ); ?></th>
													<td>
														<fieldset>
															<input type="text" name="selector" class="regular-text" value="<?php echo esc_attr( $data['selector'] ); ?>" />
															<p class="description"><?php _e( 'It is the selector which contain the content  which you want to copy.<br/>Default its &lt;pre&gt; html tag.', 'copy-the-code' ); ?></p>
														</fieldset>
													</td>
												</tr>
												<tr>
													<th scope="row"><?php _e( 'Copy Content As', 'copy-the-code' ); ?></th>
													<td>
														<fieldset>
															<select name="copy-as">
																<option value="html" <?php selected( $data['copy-as'], 'html' ); ?>><?php echo 'HTML'; ?></option>
																<option value="text" <?php selected( $data['copy-as'], 'text' ); ?>><?php echo 'Text'; ?></option>
															</select>
															<p class="description"><?php _e( 'Copy the content as Text or HTML.', 'copy-the-code' ); ?></p>
														</fieldset>
													</td>
												</tr>
											</table>
										</div>
										<div id="tab-style" style="padding: 30px; display: none;">
											<table class="form-table">
												<tr>
													<th scope="row"><?php _e( 'Button Text', 'copy-the-code' ); ?></th>
													<td>
														<fieldset>
															<input type="text" name="button-text" class="regular-text" value="<?php echo esc_attr( $data['button-text'] ); ?>" />
															<p class="description"><?php _e( 'Copy button text. Default \'Copy\'.', 'copy-the-code' ); ?></p>
														</fieldset>
													</td>
												</tr>
												<tr>
													<th scope="row"><?php _e( 'Button Copy Text', 'copy-the-code' ); ?></th>
													<td>
														<fieldset>
															<input type="text" name="button-copy-text" class="regular-text" value="<?php echo esc_attr( $data['button-copy-text'] ); ?>" />
															<p class="description"><?php _e( 'Copy button text which appear after click on it. Default \'Copied!\'.', 'copy-the-code' ); ?></p>
														</fieldset>
													</td>
												</tr>
												<tr>
													<th scope="row"><?php _e( 'Button Title', 'copy-the-code' ); ?></th>
													<td>
														<fieldset>
															<input type="text" name="button-title" class="regular-text" value="<?php echo esc_attr( $data['button-title'] ); ?>" />
															<p class="description"><?php _e( 'It is showing on hover on the button. Default \'Copy to Clipboard\'.', 'copy-the-code' ); ?></p>
														</fieldset>
													</td>
												</tr>
												<tr>
													<th scope="row"><?php _e( 'Button Position', 'copy-the-code' ); ?></th>
													<td>
														<fieldset>
															<select name="button-position">
																<option value="inside" <?php selected( $data['button-position'], 'inside' ); ?>><?php echo 'Inside'; ?></option>
																<option value="outside" <?php selected( $data['button-position'], 'outside' ); ?>><?php echo 'Outside'; ?></option>
															</select>
															<p class="description"><?php _e( 'Button Position Inside/Outside. Default Inside.', 'copy-the-code' ); ?></p>
														</fieldset>
													</td>
												</tr>
											</table>
										</div>
									</div>

									<input type="hidden" name="message" value="saved" />
									<?php wp_nonce_field( 'copy-the-code-nonce', 'copy-the-code' ); ?>

									<?php submit_button(); ?>

								</form>

							</div>

							<div class="postbox-container" id="postbox-container-1">
								<div id="side-sortables" style="">
									<div class="postbox">
										<h2 class="hndle"><span><?php _e( 'Getting Started', 'copy-the-code' ); ?></span></h2>
										<div class="inside">
											<ul class="items">
												<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#how-does-it-work"><?php esc_html_e( 'How does it work?', 'copy-the-code' ); ?></a></li>
												<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#what-is-the-selector"><?php esc_html_e( 'What is the selector?', 'copy-the-code' ); ?></a></li>
												<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-1-using-html-tag-as-a-selector"><?php esc_html_e( 'Example 1 - Using HTML tag as a selector', 'copy-the-code' ); ?></a></li>
												<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-2-using-class-as-a-selector"><?php esc_html_e( 'Example 2 - Using class as a selector', 'copy-the-code' ); ?></a></li>
												<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-3-using-id-as-a-selector"><?php esc_html_e( 'Example 3 - Using ID as a selector', 'copy-the-code' ); ?></a></li>
												<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-4-using-nested-selector"><?php esc_html_e( 'Example 4 - Using nested selector', 'copy-the-code' ); ?></a></li>
												<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-5-copy-content-as-html-as-text"><?php esc_html_e( 'Example 5 - Copy content as HTML as Text', 'copy-the-code' ); ?></a></li>
											</ul>
										</div>
									</div>

									<div class="postbox">
										<h2 class="hndle"><span><?php _e( 'Support', 'copy-the-code' ); ?></span></h2>
										<div class="inside">
											<p><?php _e( 'Do you have any issue with this plugin? Or Do you have any suggessions?', 'copy-the-code' ); ?></p>
											<p><?php _e( 'Please don\'t hesitate to <a href="http://maheshwaghmare.wordpress.com/?p=999" target="_blank">send request »</a>.', 'copy-the-code' ); ?></p>
										</div>
									</div>

									<?php
									$response = wp_dev_remote_request_get( 'https://maheshwaghmare.com/wp-json/wp/v2/posts/?_fields=id,title,link&per_page=5' );
									if( $response['success'] ) {
									?>
										<div class="postbox">
											<h2 class="hndle"><span><?php _e( 'Latest News', 'copy-the-code' ); ?></span></h2>
											<div class="inside">
												<ul>
													<?php foreach ($response['data'] as $key => $item) { ?>
														<li data-id="<?php echo esc_attr( $item['id'] ); ?>">
															» <a style="text-decoration: none;" href="<?php echo esc_attr( $item['link'] ); ?>?utm_source=copy-the-code&utm_medium=plugin&utm_campaign=wp.org" target="_blank"><?php echo esc_html( $item['title']['rendered'] ); ?>
															</a>
														</li>
													<?php } ?>
												</ul>
												<p><a href="https://maheshwaghmare.com/blog/?utm_source=copy-the-code&utm_medium=plugin&utm_campaign=wp.org" target="_blank"><?php esc_html_e( 'Read More »', 'copy-the-code' ); ?></a></p>
											</div>
										</div>
									<?php } ?>

									<div class="postbox">
										<h2 class="hndle"><span><?php _e( 'Donate', 'copy-the-code' ); ?></span></h2>
										<div class="inside">
											<p><?php _e( 'Would you like to support the advancement of this plugin?', 'copy-the-code' ); ?></p>
											<a href="https://www.paypal.me/mwaghmare7/" target="_blank" class="button button-primary"><?php _e( 'Donate Now!', 'copy-the-code' ); ?></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Copy_The_Code_Page::get_instance();

endif;
