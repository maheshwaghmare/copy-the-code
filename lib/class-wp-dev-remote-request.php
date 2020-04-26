<?php
/**
 * WP Dev Remote Request
 *
 * How to use?
 * 
 * Example 1: Simple.
 * 
 * $response = wp_dev_remote_request_get( 'http://example.com/wp-json/wp/v2/posts/' ); // Required.
 *
 * OR
 *
 * Example 2: Advanced.
 * 
 * $response = wp_dev_remote_request_get( array(
 * 					'url' => '', // Required. Rest API URL. Default empty.
 * 					'request_args' => array(), // Optional. Rest API arguments list. E.g. timeout etc.  Default array( 'timeout' => 60 )
 * 					'force' => true, // Optional. Avoid `expiration` check and forcefully trigger the request. Default false. 
 * 					'expiration' => 30, // Optional. Expiry time of transient. Default MONTH_IN_SECONDS.
 *					'generate_json_file' => array(  // Optional. File Generation. Default empty.
 *						'file_name' => '', // Required. File name.
 *						'option_name' => '', // Required. Option name to save the values.
 *						'location' => '', // Required. File location.
 *						'generate_file_if' => true, // Required. Generate though condition.
 *					)
 *				) );
 *
 * @package WP Dev Remote Request
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Dev_Remote_Request' ) ) :

	/**
	 * WP Dev Remote Request API
	 *
	 * @since 1.0.0
	 */
	class WP_Dev_Remote_Request {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class object.
		 * @since 1.0.0
		 */
		private static $instance;
		private $max_request_limit = 3;

		private $default_request_args = array(
			'timeout' => 60,
		);

		private $default_args = array(
			'url' => '',
			'args' => array(),
			'expiration' => MONTH_IN_SECONDS,
			'force' => false, // Avoid `expiration` check and forcefully trigger the request.
			'generate_json_file' => false, // Avoid `expiration` check and forcefully trigger the request.
		);

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
		}

		/**
		 * Remote GET API Request
		 *
		 * @since x.x.x
		 *
		 * @param  mixed  $args    Request URL/Array of arguments for the API request.
		 * @return mixed            Return the API request result.
		 */
		public function remote_get( $args = array() ) {

			if( empty( $args ) ) {
				return new WP_Error( __( 'Invalid Arguments.', 'wp-dev-remote-request' ) );
			}

			$request_endpoint = '';
			$request_args = $this->default_request_args;
			$force = false;
			$expiration = MONTH_IN_SECONDS;

			// If $args contain only API url then set the default arguments.
			if( is_string( $args ) && ! is_array( $args ) ) {
				$request_endpoint = sanitize_text_field( $args );
				$request_args = $this->default_request_args;
			} else {
				if( isset( $args['url'] ) ) {
					$request_endpoint = sanitize_text_field( $args['url'] );
				}
				if( isset( $args['args'] ) ) {
					$request_args = wp_parse_args( $args['args'], $this->default_request_args );
				}
				if( isset( $args['transient_key'] ) ) {
					$transient_key = sanitize_key( $args['transient_key'] );
				}
				if( isset( $args['expiration'] ) ) {
					$expiration = sanitize_key( $args['expiration'] );
				}
				if( isset( $args['force'] ) ) {
					$force = $args['force'];
				}
			}

			// If empty then return.
			if( empty( $request_endpoint ) ) {
				return new WP_Error( __( 'Invalid Request Endpoint', 'wp-dev-remote-request' ) );
			}

			$unique_request_key = md5( $request_endpoint . json_encode( $request_args ) );
			$transient_key = 'wp-dev-remote-request-' . $unique_request_key;

			// Request URL.
			// $request_url = trailingslashit( $this->get_domain() ) . $request_endpoint;
			$request_url = $request_endpoint;

			/**
			 * If `force` is not set then check request maximum requests count. If it reach the maximum requests the return transient output.
			 */
			if( false === $force ) {
				// Check in transient and return its cached transient data.			
				$transient_flag = get_transient( $transient_key );

				// Check Max Request Limit.
				// Avoid multiple requests and serve data from the transient.
				$request_limit_key = 'wp-dev-remote-request-request-limit-' . $unique_request_key;
				$request_limit = (int) get_transient( $request_limit_key );
				if( $request_limit >= $this->max_request_limit ) {
					return array(
						'success' => true,
						'message' => __( 'Reached MAX remote requests. Response from transient.', 'wp-dev-remote-request' ),
						'data'    => $transient_flag,
						'expiration'  => $expiration,
					);
				}
				set_transient( $request_limit_key, ($request_limit + 1), $expiration );

				// Serve response from the transient if transient data is not empty.
				if( false !== $transient_flag ) {
					return array(
						'success' => true,
						'message' => __( 'Response from transient.', 'wp-dev-remote-request' ),
						'data'    => $transient_flag,
						'expiration'  => $expiration,
					);
				}
			}

			$request = wp_remote_get( $request_url, $request_args );
			$result = $this->request( $request, $args );

			if( $result['success'] ) {
				set_transient( $transient_key, $result['data'], $expiration );

				// file generation.
				$this->generate_file( $args, $result );
			}

			return $result;
		}

		/**
		 * API Request
		 *
		 * Handle the API request and return the result.
		 *
		 * @since 1.0.0
		 *
		 * @param  array $request    Array of arguments for the API request.
		 * @return mixed           Return the API request result.
		 */
		public function request( $request, $args = array() ) {

			// Is WP Error?
			if ( is_wp_error( $request ) ) {
				return array(
					'success' => false,
					'message' => $request->get_error_message(),
					'data'    => wp_remote_retrieve_body($request),
				);
			}

			// Invalid response code.
			if ( wp_remote_retrieve_response_code( $request ) != 200 ) {
				return array(
					'success' => false,
					'message' => $request['response'],
					'data'    => wp_remote_retrieve_body($request),
				);
			}

			// Get body data.
			$body = wp_remote_retrieve_body( $request );

			// Is WP Error?
			if ( is_wp_error( $body ) ) {
				return array(
					'success' => false,
					'message' => $body->get_error_message(),
					'data'    => $request,
				);
			}

			// Decode body content.
			$body_decoded = json_decode( $body, true );

			return array(
				'success' => true,
				'message' => __( 'Response from live site.', 'wp-dev-remote-request' ),
				'data'    => (array) $body_decoded,
			);
		}

		public function generate_file( $args = array(), $response = array() ) {
			if( empty( $args ) ) {
				return;
			}

			$file_generate_args = isset( $args['generate_json_file'] ) ? array_map('esc_attr', $args['generate_json_file']) : array();

			// Not have file generation arguments.
			if( empty( $file_generate_args ) ) {
				return;
			}

			$file_name = isset( $file_generate_args['file_name'] ) ? sanitize_file_name( $file_generate_args['file_name'] ) : '';
			$option_name = isset( $file_generate_args['file_name'] ) ? sanitize_text_field( $file_generate_args['option_name'] ) : '';
			$location = isset( $file_generate_args['location'] ) ? trailingslashit( $file_generate_args['location'] ) : '';
			$generate_file_if = isset( $file_generate_args['generate_file_if'] ) ? $file_generate_args['generate_file_if'] : false;

			// Return if file generation flag is false.
			if( false === $generate_file_if ) {
				return;
			}

			// File name/location is empty then return.
			if( empty( $file_name ) || empty( $location ) ) {
				return;
			}

			// If response is empty then return.
			if( empty( $response ) ) {
				return;
			}

			// Remove unwanted data to save in JSON file.
			unset( $response['success'] );
			unset( $response['message'] );

			// Save in option table if option name is provided.
			if( ! empty( $option_name ) ) {
				update_option( $option_name, $response );
				
				$response['option_name'] = $option_name;
			}

			$this->get_filesystem()->put_contents( $location . $file_name . '.json', wp_json_encode( $response ) );
		}

		/**
		 * Get an instance of WP_Filesystem_Direct.
		 *
		 * @since 2.0.0
		 * @return object A WP_Filesystem_Direct instance.
		 */
		public function get_filesystem() {
			global $wp_filesystem;

			require_once ABSPATH . '/wp-admin/includes/file.php';

			WP_Filesystem();

			return $wp_filesystem;
		}

	}

	// Initialize class object with 'get_instance()' method.
	WP_Dev_Remote_Request::get_instance();

endif;

if( ! function_exists( 'wp_dev_remote_request_get' ) ) :
	function wp_dev_remote_request_get( $args = array() ) {
		return WP_Dev_Remote_Request::get_instance()->remote_get( $args );
	}
endif;
