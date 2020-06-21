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
			add_filter( 'admin_url', array( $this, 'admin_url' ), 10, 3 );

			add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
			add_action( 'plugin_action_links_' . COPY_THE_CODE_BASE, array( $this, 'action_links' ) );
			add_action( 'init', array( $this, 'save_settings' ), 11 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_assets' ) );
			add_action( 'init', array( $this, 'register_post_type' ) );
			add_action( 'after_setup_theme', array( $this, 'init_admin_settings' ) );

		}

		/**
		 * Filters the admin area URL.
		 *
		 * @since 1.0.2
		 *
		 * @param string   $url     The complete admin area URL including scheme and path.
		 * @param string   $path    Path relative to the admin area URL. Blank string if no path is specified.
		 * @param int|null $blog_id Site ID, or null for the current site.
		 */
		public function admin_url( $url, $path, $blog_id ) {

			if ( 'post-new.php?post_type=copy-to-clipboard' !== $path ) {
				return $url;
			}

			$url  = get_site_url( $blog_id, 'wp-admin/', 'admin' );
			$path = 'edit.php?post_type=copy-to-clipboard&page=copy-to-clipboard-add-new';

			if ( $path && is_string( $path ) ) {
				$url .= ltrim( $path, '/' );
			}

			return $url;
		}

		function init_admin_settings() {
			if ( current_user_can( 'edit_posts' ) ) {
				add_action( 'admin_menu', array( $this, 'register' ) );
				add_action( 'submenu_file', array( $this, 'submenu_file' ), 999, 2 );
			}
		}

		/**
		 * Sets the active menu item for the builder admin submenu.
		 *
		 * @since 1.0.2
		 *
		 * @param string $submenu_file  Submenu file.
		 * @param string $parent_file   Parent file.
		 * @return string               Submenu file.
		 */
		public function submenu_file( $submenu_file, $parent_file ) {
			global $pagenow;

			$screen = get_current_screen();

			if ( isset( $_GET['page'] ) && 'copy-to-clipboard-add-new' === $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$submenu_file = 'copy-to-clipboard-add-new';
			} elseif ( 'post.php' === $pagenow && 'copy-to-clipboard' === $screen->post_type ) {
				$submenu_file = 'edit.php?post_type=copy-to-clipboard';
			}

			return $submenu_file;
		}

		/**
		 * Registers the add new portfolio form admin menu for adding portfolios.
		 *
		 * @since 1.0.2
		 *
		 * @return void
		 */
		public function register() {
			global $submenu, $_registered_pages;

			$parent        = 'edit.php?post_type=copy-to-clipboard';
			$add_new_hook  = 'copy-to-clipboard_page_copy-to-clipboard-add-new';

			$submenu[ $parent ]     = array(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$submenu[ $parent ][10] = array( __( 'All Items', 'copy-the-code' ), 'edit_posts', $parent ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$submenu[ $parent ][20] = array( __( 'Add New', 'copy-the-code' ), 'edit_posts', 'copy-to-clipboard-add-new', '' ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			add_action( $add_new_hook, array( $this, 'add_new_page' ) );
			$_registered_pages[ $add_new_hook ] = true; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		}

		/**
		 * Add new page
		 *
		 * @since 1.0.2
		 */
		public function add_new_page() {
			$data = $this->get_page_settings();
			require_once COPY_THE_CODE_DIR . 'includes/add-new-form.php';
		}

		/**
		 * Registers a new post type
		 * @uses $wp_post_types Inserts new post type object into the list
		 *
		 * @param string  Post type key, must not exceed 20 characters
		 * @param array|string  See optional args description above.
		 * @return object|WP_Error the registered post type object, or an error object
		 */
		function register_post_type() {
		
			$labels = array(
				'name'               => __( 'Copy the Code', 'copy-the-code' ),
				'singular_name'      => __( 'Copy the Code', 'copy-the-code' ),
				'add_new'            => _x( 'Add New Copy the Code', 'copy-the-code', 'copy-the-code' ),
				'add_new_item'       => __( 'Add New Copy the Code', 'copy-the-code' ),
				'edit_item'          => __( 'Edit Copy the Code', 'copy-the-code' ),
				'new_item'           => __( 'New Copy the Code', 'copy-the-code' ),
				'view_item'          => __( 'View Copy the Code', 'copy-the-code' ),
				'search_items'       => __( 'Search Copy the Code', 'copy-the-code' ),
				'not_found'          => __( 'No Copy the Code found', 'copy-the-code' ),
				'not_found_in_trash' => __( 'No Copy the Code found in Trash', 'copy-the-code' ),
				'parent_item_colon'  => __( 'Parent Copy the Code:', 'copy-the-code' ),
				'menu_name'          => __( 'Copy the Code', 'copy-the-code' ),
			);
		
			$args = array(
				'labels'              => $labels,
				'hierarchical'        => false,
				'description'         => 'description',
				'taxonomies'          => array(),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => null,
				'menu_icon'           => null,
				'show_in_nav_menus'   => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'has_archive'         => true,
				'query_var'           => true,
				'can_export'          => true,
				'rewrite'             => true,
				'capability_type'     => 'post',
				'supports'            => array(
					'title',
					// 'editor',
					'author',
					// 'thumbnail',
					// 'excerpt',
					'custom-fields',
					// 'trackbacks',
					// 'comments',
					// 'revisions',
					// 'page-attributes',
					// 'post-formats',
				),
			);
		
			register_post_type( 'copy-to-clipboard', $args );
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

			wp_localize_script(
				'copy-the-code-page',
				'copyTheCode',
				$this->get_localize_vars()
			);
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
				$this->get_localize_vars()				
			);
		}

		function get_localize_vars() {

			$query_args = array(
				'post_type'      => 'copy-to-clipboard',
			
				// Query performance optimization.
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'posts_per_page' => -1,
			);
			
			$query = new WP_Query( $query_args );
			$selectors = array();
			// vl( $query->posts );
			// wp_die();
			if ( $query->posts ) {
				foreach ( $query->posts as $key => $post_id ) {
					$selectors[] = array(
						'selector' => get_post_meta( $post_id, 'selector', true ),
						'style' => get_post_meta( $post_id, 'style', true ),
						// '/ $copy_as' => get_post_meta( $post_id, 'copy-as', true ),
						'button_text' => get_post_meta( $post_id, 'button-text', true ),
						'button_title' => get_post_meta( $post_id, 'button-title', true ),
						'button_copy_text' => get_post_meta( $post_id, 'button-copy-text', true ),
						'button_position' => get_post_meta( $post_id, 'button-position', true ),
					);
				}
			}

			// vl( $selectors );
			// wp_die();
			return apply_filters(
				'copy_the_code_localize_vars',
				array(
					'previewMarkup' => '&lt;h2&gt;Hello World&lt;/h2&gt;',
					'buttonMarkup' => '<button class="copy-the-code-button" title=""></button>',
					'buttonSvg' => '<svg viewBox="-21 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m186.667969 416c-49.984375 0-90.667969-40.683594-90.667969-90.667969v-218.664062h-37.332031c-32.363281 0-58.667969 26.300781-58.667969 58.664062v288c0 32.363281 26.304688 58.667969 58.667969 58.667969h266.664062c32.363281 0 58.667969-26.304688 58.667969-58.667969v-37.332031zm0 0"></path><path d="m469.332031 58.667969c0-32.40625-26.261719-58.667969-58.664062-58.667969h-224c-32.40625 0-58.667969 26.261719-58.667969 58.667969v266.664062c0 32.40625 26.261719 58.667969 58.667969 58.667969h224c32.402343 0 58.664062-26.261719 58.664062-58.667969zm0 0"></path></svg>',
					'selectors' => $selectors,
					'selector' => 'pre', // Selector in which have the actual `<code>`.
					'settings' => $this->get_page_settings(),
					'string'   => array(
						'title'  => $this->get_page_setting( 'button-title', __( 'Copy to Clipboard', 'copy-the-code' ) ),
						'copy'   => $this->get_page_setting( 'button-text', __( 'Copy', 'copy-the-code' ) ),
						'copied' => $this->get_page_setting( 'button-copy-text', __( 'Copied!', 'copy-the-code' ) ),
					),
					'image-url' => COPY_THE_CODE_URI . '/assets/images/copy-1.svg',
				)
			);
		}

		/**
		 * Admin Settings
		 *
		 * @return void
		 */
		function save_settings() {

			if( ! isset( $_REQUEST['page'] ) || ! isset( $_REQUEST['copy-the-code'] ) ) {
				return;
			}

			if (  strpos( $_REQUEST['page'], 'copy-to-clipboard-add-new' ) === false ) {
				return;
			}

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Make sure we have a valid nonce.
			if ( ! wp_verify_nonce( $_REQUEST['copy-the-code'], 'copy-the-code-nonce' ) ) {
				return;
			}

			$selector = ( isset( $_REQUEST['selector'] ) ) ? $_REQUEST['selector'] : 'pre';

			$query_args = array(
				'post_type'      => 'copy-to-clipboard',
			
				// Query performance optimization.
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'posts_per_page' => -1,
				'meta_key' => 'selector',
				'meta_value' => $selector,
			);
			
			$query = new WP_Query( $query_args );
			if( $query->post_count ) {
				add_action( 'admin_notices', array( $this, 'selector_exist_notice' ) );
				return;
			}

			

			// Stored Settings.
			// $stored_data = $this->get_page_settings();

			// New settings.
			$new_data = array(
				'selector'         => $selector,
				'style'         => ( isset( $_REQUEST['style'] ) ) ? $_REQUEST['style'] : 'button',
				// 'copy-as'          => ( isset( $_REQUEST['copy-as'] ) ) ? $_REQUEST['copy-as'] : 'text',
				'button-text'      => ( isset( $_REQUEST['button-text'] ) ) ? $_REQUEST['button-text'] : 'Copy',
				'button-title'     => ( isset( $_REQUEST['button-title'] ) ) ? $_REQUEST['button-title'] : 'Copy',
				'button-copy-text' => ( isset( $_REQUEST['button-copy-text'] ) ) ? $_REQUEST['button-copy-text'] : 'Copied!',
				'button-position'  => ( isset( $_REQUEST['button-position'] ) ) ? $_REQUEST['button-position'] : 'inside',
			);

			// copy-to-clipboard
			$data = array(
				'post_type'   => 'copy-to-clipboard',
				'post_status' => 'publish',
				'post_title'  => $new_data['selector'],
				'meta_input'  => $new_data,
			);
			wp_insert_post( $data );
			// vl( $new_data );
			// wp_die();

			wp_safe_redirect( admin_url( 'edit.php?post_type=copy-to-clipboard' ) );

			exit();

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

		function selector_exist_notice() {
			?>
			<div class="notice notice-error">
				<p>The selector is already exist! Please try another selector.</p>
			</div>
			<?php
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
					// 'copy-as'          => 'text',
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
				'settings' => '<a href="' . admin_url( 'edit.php?post_type=copy-to-clipboard&page=copy-to-clipboard-add-new' ) . '" aria-label="' . esc_attr__( 'Settings', 'copy-the-code' ) . '">' . esc_html__( 'Settings', 'copy-the-code' ) . '</a>',
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
			add_submenu_page( 'edit.php?post_type=copy-to-clipboard', __( 'Settings', 'copy-the-code' ), __( 'Settings', 'copy-the-code' ), 'manage_options', 'copy-the-code', array( $this, 'options_page' )  );
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
			

			
		}
	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Copy_The_Code_Page::get_instance();

endif;





/**
 * Add custom column
 * 
 * @todo Change the `prefix_` and with your own unique prefix.
 * 
 * @since 1.0.0
 */
if( ! function_exists( 'prefix_add_custom_column' ) ) :
	function prefix_add_custom_column( $columns = array() ) {
		
		if( isset( $columns['author'] ) ) {
			unset( $columns['author'] );
		}
		
		if( isset( $columns['date'] ) ) {
			unset( $columns['date'] );
		}
		
		$new_columns = array(
			'style' => __( 'Style', 'copy-the-code' ),
			'settings' => __( 'Settings', 'copy-the-code' ),
			'author' => 'Author',
			'date' => 'Date',
		);

    	return wp_parse_args( $new_columns, $columns );
   }
   add_filter('manage_copy-to-clipboard_posts_columns', 'prefix_add_custom_column', 10);
endif;

/**
 * Column markup
 * 
 * @todo Change the `prefix_` and with your own unique prefix.
 * 
 * @since 1.0.0
 *
 * @param  string Column slug.
 * @param  integer Post ID.
 * @return void
 */
if( ! function_exists( 'prefix_custom_column_markup' ) ) :
	function prefix_custom_column_markup( $column_name = '', $post_id = 0 ) {

		if ( $column_name == 'style') {
	        $style = get_post_meta( $post_id, 'style', true );
	        if( $style ) {
	        	switch ( $style) {
	        		case 'cover':
	        					echo 'Cover';
	        			break;
	        		case 'svg-icon':
	        					echo 'SVG Icon';
	        			break;
	        		case 'button':
	        					echo 'Button';
	        			break;
	        	}
	        }
	    }
	    if ( $column_name == 'settings') {
			$button_text = get_post_meta( $post_id, 'button-text', true );
			if( ! empty( $button_text  ) ) {
				echo '<i>Button Text: </i><b>' . $button_text . '</b><br/>';
			}
		    $button_title = get_post_meta( $post_id, 'button-title', true );
			if( ! empty( $button_title  ) ) {
				echo '<i>Button Title: </i><b>' . $button_title . '</b><br/>';
			}
		    $button_copy_text = get_post_meta( $post_id, 'button-copy-text', true );
			if( ! empty( $button_copy_text  ) ) {
				echo '<i>Button Copy Text: </i><b>' . $button_copy_text . '</b><br/>';
			}
		    $button_position = get_post_meta( $post_id, 'button-position', true );
			if( ! empty( $button_position  ) ) {
				echo '<i>Button Position: </i><b>' . $button_position . '</b><br/>';
			}
	    }

   }
   add_action('manage_copy-to-clipboard_posts_custom_column', 'prefix_custom_column_markup', 10, 2);
endif;
