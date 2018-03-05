<?php

/**
 * WpBean Auto updater init
 */

if ( ! defined( 'ABSPATH' ) ) exit;

final class WPB_WAMC_Plugin_Updater_Init {

	private static $instance;
	public $prefix = 'wpb_wamc_';
	public $textdomain = 'wpb-accordion-menu-or-category';
	public $license_page_slug = 'wpb-wamc-license';
	public $setting_page_slug = 'wpb_wcma_settings';
	public $store_url = 'https://wpbean.com';
	public $version = WPB_WAMC_VERSION;
	public $item_name = 'WPB Accordion Menu or Category PRO';

	public static function get_instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WPB_WAMC_Plugin_Updater_Init ) ) {
			self::$instance = new WPB_WAMC_Plugin_Updater_Init;
			self::$instance->hooks();
		}

		return self::$instance;
	}

	public function hooks() {
		add_filter( 'wpb_wamc_settings_sections', array( $this, 'wpb_license_menu') );
		add_filter( 'wpb_wamc_settings_settings_fields', array( $this, 'wpb_license_page_content') );
		add_action( 'admin_init', array( $this, 'wpb_activate_license') );
		add_action( 'admin_init', array( $this, 'wpb_deactivate_license') );
		add_action( 'admin_notices', array( $this, 'wpb_admin_notices') );
	}

	public function __construct() {
		self::$instance = $this;
	}


	/**
	 * Add license tab to the settings 
	 */

	function wpb_license_menu( $sections ) {
		$sections[] = array(
            'id'    => $this->license_page_slug,
            'title' => __( 'License', $this->textdomain )
        );
        return $sections;
	}

	/**
	 * Add license tab content to the settings 
	 */

	function wpb_license_page_content( $settings_fields ) {

		$license = wpb_wmca_get_option( $this->prefix.'license_key', $this->license_page_slug );
		$status  = get_option( $this->prefix.'license_status' );

		$settings_fields[$this->license_page_slug][] = array(
            'name'              => $this->prefix.'license_key',
            'label'             => __( 'License Key', $this->textdomain ),
            'desc'              => __( 'Enter your license key here. Required for getting automatic updates.', $this->textdomain ),
            'type'              => 'text'
        );

        if( $license && '' != $license ){
        	$settings_fields[$this->license_page_slug][] = array(
	            'name'              => $this->prefix.'license_key_active',
	            'label'             => __( 'Activate License', $this->textdomain ),
	            'type'              => 'license'
	        );
        }

		return $settings_fields;
	}


	/************************************
	* this illustrates how to activate
	* a license key
	*************************************/

	function wpb_activate_license() {

		// listen for our activate button to be clicked
		if( isset( $_POST[$this->prefix.'license_activate'] ) ) {

			// run a quick security check
		 	if( ! check_admin_referer( $this->prefix.'nonce', $this->prefix.'nonce' ) )
				return; // get out if we didn't click the Activate button

			// retrieve the license from the database
			$license = trim( wpb_wmca_get_option( $this->prefix.'license_key', $this->license_page_slug ) );


			// data to send in our API request
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => $license,
				'item_name'  => urlencode( $this->item_name ),
				'url'        => home_url()
			);

			// Call the custom API.
			$response = wp_remote_post( $this->store_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

			// make sure the response came back okay
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = __( 'An error occurred, please try again.', $this->textdomain );
				}

			} else {

				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

				if ( false === $license_data->success ) {

					switch( $license_data->error ) {

						case 'expired' :

							$message = sprintf(
								__( 'Your license key expired on %s.', $this->textdomain ),
								date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
							);
							break;

						case 'revoked' :

							$message = __( 'Your license key has been disabled.', $this->textdomain );
							break;

						case 'missing' :

							$message = __( 'Invalid license.', $this->textdomain );
							break;

						case 'invalid' :
						case 'site_inactive' :

							$message = __( 'Your license is not active for this URL.', $this->textdomain );
							break;

						case 'item_name_mismatch' :

							$message = sprintf( __( 'This appears to be an invalid license key for %s.', $this->textdomain ), $this->item_name );
							break;

						case 'no_activations_left':

							$message = __( 'Your license key has reached its activation limit.', $this->textdomain );
							break;

						default :

							$message = __( 'An error occurred, please try again.', $this->textdomain );
							break;
					}

				}

			}

			// Check if anything passed on a message constituting a failure
			if ( ! empty( $message ) ) {
				$base_url = admin_url( 'options-general.php?page=' . $this->setting_page_slug );
				$redirect = add_query_arg( array( $this->prefix.'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

				wp_redirect( $redirect );
				exit();
			}

			// $license_data->license will be either "valid" or "invalid"

			update_option( $this->prefix.'license_status', $license_data->license );
			wp_redirect( admin_url( 'options-general.php?page=' . $this->setting_page_slug ) );
			exit();
		}
	}


	/***********************************************
	* Illustrates how to deactivate a license key.
	* This will decrease the site count
	***********************************************/

	function wpb_deactivate_license() {

		// listen for our activate button to be clicked
		if( isset( $_POST[$this->prefix.'license_deactivate'] ) ) {

			// run a quick security check
		 	if( ! check_admin_referer( $this->prefix.'nonce', $this->prefix.'nonce' ) )
				return; // get out if we didn't click the Activate button

			// retrieve the license from the database
			$license = trim( wpb_wmca_get_option( $this->prefix.'license_key', $this->license_page_slug ) );


			// data to send in our API request
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license'    => $license,
				'item_name'  => urlencode( $this->item_name ),
				'url'        => home_url()
			);

			// Call the custom API.
			$response = wp_remote_post( $this->store_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

			// make sure the response came back okay
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = __( 'An error occurred, please try again.', $this->textdomain );
				}

				$base_url = admin_url( 'options-general.php?page=' . $this->setting_page_slug );
				$redirect = add_query_arg( array( $this->prefix.'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

				wp_redirect( $redirect );
				exit();
			}

			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// $license_data->license will be either "deactivated" or "failed"
			if( $license_data->license == 'deactivated' ) {
				delete_option( $this->prefix.'license_status' );
			}

			wp_redirect( admin_url( 'options-general.php?page=' . $this->setting_page_slug ) );
			exit();

		}
	}


	/************************************
	* this illustrates how to check if
	* a license key is still valid
	* the updater does this for you,
	* so this is only needed if you
	* want to do something custom
	*************************************/

	function wpb_check_license() {

		global $wp_version;

		$license = trim( wpb_wmca_get_option( $this->prefix.'license_key', $this->license_page_slug ) );

		$api_params = array(
			'edd_action' => 'check_license',
			'license' => $license,
			'item_name' => urlencode( $this->item_name ),
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( $this->store_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if( $license_data->license == 'valid' ) {
			echo 'valid'; exit;
			// this license is still valid
		} else {
			echo 'invalid'; exit;
			// this license is no longer valid
		}
	}

	/**
	 * This is a means of catching errors from the activation method above and displaying it to the customer
	 */
	function wpb_admin_notices() {
		if ( isset( $_GET[$this->prefix.'sl_activation'] ) && ! empty( $_GET['message'] ) ) {

			switch( $_GET[$this->prefix.'sl_activation'] ) {

				case 'false':
					$message = urldecode( $_GET['message'] );
					?>
					<div class="error">
						<p><?php echo $message; ?></p>
					</div>
					<?php
					break;

				case 'true':
				default:
					// Developers can put a custom success message here for when activation is successful if they way.
					break;

			}
		}
	}
}



/**
 * init the updater class
 */

function wpb_wamc_updater_init() {
	return WPB_WAMC_Plugin_Updater_Init::get_instance();
}
add_action( 'init', 'wpb_wamc_updater_init' );