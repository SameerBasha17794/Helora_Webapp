<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * GMW_Xprofile_Fields
 */
class GMW_XF_Location_Geocoder {

	/**
	 * __construct function.
	 */
	public function __construct() {
		
		// geo my wp settings
		$this->settings = get_option( 'gmw_options' );

		// abort if feature disabled
		if ( empty( $this->settings['xprofile_fields']['xf_use'] ) || $this->settings['xprofile_fields']['xf_use'] == 'disabled' ) { 
			return;
		}

		// xprofile settings
		$this->xf_settings = $this->settings['xprofile_fields'];
		
		// set the address field in the settings based on the used method
		if ( $this->xf_settings['xf_use'] == 'single' ) {
			
			$this->address_fields = array(
				'address' => $this->xf_settings['address_fields']['address']
			);

		} else {

			$this->address_fields = $this->xf_settings['address_fields'];
			unset( $this->address_fields['address'] );
		}

		// get user data
		$this->get_user_data();

		$this->geocoder_fields = false;

		// run actions and filters
		$this->hooks();
	}	

	/**
	 * Do actions nad filters
	 * 
	 * @return [type] [description]
	 */
	public function hooks() {

		//register scrips admin
		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
		
		// generate admin meta boxes in user profile page
		add_action( 'bp_members_admin_xprofile_metabox', array( $this, 'admin_meta_box' ), 99, 3 );

		// modify the field element with geocoder data
		add_filter( 'bp_xprofile_field_edit_html_elements' , array( $this, 'modify_address_field_element' )	);
		
		// add hidden geocoder field to the form
		add_filter( 'bp_before_registration_submit_buttons', array( $this, 'generate_geocoder_fields' ) );
		add_action( 'bp_after_profile_field_content', 		 array( $this, 'generate_geocoder_fields' ) );

		// update user location on registration and profile update
		add_action( 'user_register', 			array( $this, 'get_location_data' ), 10, 1 );
		add_action( 'xprofile_updated_profile', array( $this, 'get_location_data' ), 5 );
	 	
	 	// delete location
	 	add_action( 'gmw_fl_after_location_deleted'	, array( $this, 'delete_location' ), 10, 1 );
	}

	/**
	 * register google maps on user edit profile page in admin
	 * @return [type] [description]
	 */
	public function register_scripts() {

		if ( ! wp_script_is( 'google-maps', 'enqueued' ) ) {
			wp_enqueue_script( 'google-maps' );
		}
	}

	/**
	 * Get user ID and user location
	 * 
	 * @return [type] [description]
	 */
	public function get_user_data() {

		$this->user_id = 0;

		// look for user ID ( displayed user ID ) in front-end
		if ( ! is_admin() ) {
			
			global $bp;

			$this->user_id = ( is_user_logged_in() && ! empty( $bp->displayed_user->id ) ) ? $bp->displayed_user->id : 0;
		
		// look for user ID in admin profile page
		} elseif ( is_admin() && ! empty( $_GET['user_id'] ) ) {

			$this->user_id = $_GET['user_id'];
		}

		// if user ID found look for use's location
		if ( ! empty( $this->user_id ) ) {
		
			global $wpdb;

			// check for user location
			$this->user_location = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `wppl_friends_locator` WHERE `member_id` = %d", $this->user_id ), ARRAY_A );
			
			if ( ! empty( $this->user_location ) ) {

				$this->user_location['status'] = '1';

			} else {

				$this->user_location = false;
			}
		} 
	}

	/**
	 * Generate admin meta boxes in user profile page
	 * 
	 * @param  [type] $user_id           [description]
	 * @param  [type] $current_screen_id [description]
	 * @param  [type] $metabox           [description]
	 * 
	 * @return [type]                    [description]
	 */
	function admin_meta_box( $user_id, $current_screen_id, $metabox ) {

		?>
		<style type="text/css">
			#gmw_xf_geocoder_fields {
				display: none !important;
			}
		</style>
		<?php 

		// GEO my WP location status
		add_meta_box(
			'gmw_xf_location_status',
			__( 'GEO my WP Location Status', 'GMW-XF' ),
			array( $this, 'location_status_meta_box_content' ),
			$current_screen_id,
			'side',
			'low'
		);

		// Geocoder fields meta box
		add_meta_box(
			'gmw_xf_geocoder_fields',
			__( 'GEO my WP Geocoder Fields', 'GMW-XF' ),
			array( $this, 'generate_geocoder_fields' ),
			$current_screen_id,
			'normal',
			'low'
		);
	}

	/**
	 * Location status meta box content 
	 * 
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	function location_status_meta_box_content( $user_id ) {

		if ( ! empty( $this->user_location ) ) {
			echo '<p style="color: green"><span class="dashicons dashicons-yes"></span>'. __( 'Location OK', 'GMW-XF' ).'</p>';
		} else {
			echo '<p style="color: red"><span class="dashicons dashicons-no"></span>'.__( 'Location not found', 'GMW-XF' ) .'</p>';
		}

	}

	/**
	 * Add geocoder fields data to form field element
	 * 
	 * @param [type] $r    [description]
	 */
	public function modify_address_field_element( $output ) {
    	
    	// get the field ID
		$field_id = bp_get_the_profile_field_id();

		// check if field setup as location field
    	if ( $this->xf_settings['xf_use'] != 'disabled' && in_array( $field_id, $this->address_fields ) ) {

    		$address_field = array_search( $field_id, $this->address_fields );
    		
    		$autocomplete = ( $address_field == 'address' && ! empty( $this->xf_settings['xf_autocomplete'] ) ) ? 'data-address_autocomplete="1"' : '';

    		// add the geocoder data
    		echo 'data-gmw_xf_geocoder_enabled="1" data-geocoder_field="'.$address_field.'" '.$autocomplete;

    		// enabled geocoder address fields generator
    		$this->geocoder_fields = true;
		}

		return $output;
	}

	/**
	 * Add geocoded hidden fields to form
	 * @return [type] [description]
	 */
	public function generate_geocoder_fields() {

		// abort if address field are not set
		if ( ! $this->geocoder_fields ) {
			return;
		}

		$geo_updated = ! empty( $_POST['gmw_xf_geocoder_updated'] ) ? '1' : '';
		$autofill    = ! empty( $this->xf_settings['autofill'] ) ? '1' : '';

		echo '<div id="gmw-xf-geocoder-fields-wrapper" style="display:none">';

		// set hidden fields
 		echo '<input type="hidden" name="gmw_xf_geocoder" id="gmw_xf_geocoder" value="'. esc_attr( sanitize_text_field( $this->xf_settings['xf_use'] ) ).'" />';
		echo '<input type="hidden" name="gmw_xf_geocoder_updated" id="gmw_xf_geocoder_updated" value="'.$geo_updated.'" />';

		$address_fields = array(
			'status',
			'street',
			'city',
			'state_short',
			'state_long',
			'zipcode',
			'country_short',
			'country_long',
			'formatted_address',
			'lat',
			'lng'
		);

		$location_data = array();

		// on form load check if form failed to submit and get the location 
		// data from the submitted values if exist 
		if ( ! empty( $_POST['gmw_xf_location']['status'] ) ) {
		
			$location_data = $_POST['gmw_xf_location'];
		
		// otherwise, get the location data from user's location if saved in database already
		} elseif ( ! empty( $this->user_location['status'] ) ) {

			$location_data = $this->user_location;
		}

		// generate the hidden fields
		foreach ( $address_fields as $afield ) {

			if ( $afield == 'lng' && array_key_exists( 'long', $location_data ) ) {
				$value = ! empty( $location_data['long'] ) ? sanitize_text_field( esc_attr( $location_data['long'] ) ) : '';
			} else {
				$value = ! empty( $location_data[$afield] ) ? sanitize_text_field( esc_attr( $location_data[$afield] ) ) : '';
			}

			echo '<input type="hidden" name="gmw_xf_location['.esc_attr( $afield ).']" class="gmw-xf-geocoder-field" id="gmw_xf_'. esc_attr( $afield ).'" value="'.$value.'" />'; 
		}

		// enable address autofill field
		if ( bp_is_register_page() && isset( $this->xf_settings['autofill'] ) && empty( $location_data ) ) {
			echo '<input type="hidden" id="gmw_xf_autofill_enabled" />';
		}

		echo '</div>';

		// load geocoder file
		wp_enqueue_script( 'gmw-xf' );
		wp_localize_script( 'gmw-xf', 'gmw_xf_settings', $this->settings );
	}

	/**
	 * Collect the location data
	 * 
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	function get_location_data( $user_id ) {

		// abort if geocoder is not present in the page
		if ( empty( $_POST['gmw_xf_geocoder'] ) ) {
			return;
		}

		// continue only if this is a registration form, if updating the address
		// or if the user does not have location set
		if ( ! bp_is_register_page() && empty( $_POST['gmw_xf_geocoder_updated'] ) && ! empty( $this->user_location ) ) {
			return;
		}

		// Get the entered address when using single address field
		if ( $this->xf_settings['xf_use'] == 'single' ) {
			
			$verify_address = ! empty( $_POST['field_'. $this->xf_settings['address_fields']['address']] ) ? str_replace( ' ', '', $_POST['field_'. $this->xf_settings['address_fields']['address']] ) : '';
			
			// delete location from gmw database and abort if address is empty
			if ( empty( $verify_address ) ) {
				$this->delete_location( $user_id );
				return;
			}

			// Grab only the full address field ID from settings
			$entered_address = array(
				'address' => $_POST['field_'. $this->xf_settings['address_fields']['address']]
			);
								
		// When using multiple address fields
		} else {
			
			// remove the full address field ID from settings
			//unset( $this->xf_settings['address_fields']['address'] );
			
			$entered_address = array();
			
			// get the full address field from submitted address fields
			foreach ( $this->xf_settings['address_fields'] as $key => $field_id ) {
								
				if ( ! empty( $_POST['field_'.$field_id] ) && $key != 'address' ) {
					
					$entered_address[$key] = $_POST['field_'.$field_id];
				}
			}

			// verify that address is not empty
			$verify_address = implode( ' ', $entered_address );
			$verify_address = str_replace( ' ', '', $entered_address );
			
			// delete location from gmw database and abort if address is empty
			if ( empty( $verify_address ) ) {
				$this->delete_location( $user_id );
				return;
			}
		}	

		// get geocoded data from hidden fields if geocoded via client-side
		if ( ! empty( $_POST['gmw_xf_location']['status'] ) ) {
			
			$geocoded_address = $_POST['gmw_xf_location'];
		
		// otherwise try to geocode the address via HTTP call
		} else {

			// IN case that we use multiple address fields,
			// remove the apt value from the adress we need to geocode as it
			// not always works well with Google Geocoder.
			$geo_address = $entered_address;
			unset( $geo_address['apt'] );

			//geocode the address
			$geocoded_address = GEO_my_WP::geocoder( implode( ' ', $geo_address ) );
		}

		// if address successfully geocoded
		if ( ! empty( $geocoded_address['lat'] ) && ! empty( $geocoded_address['lng'] ) ) {
			 
			// default location field
			$defaults = array(
				'member_id'			=> $user_id,
				'status'			=> '',
				'street'			=> '',
				'apt'				=> '',
				'city' 				=> '',
				'state_short' 		=> '',
				'state_long' 		=> '',
				'zipcode'			=> '',
				'country_short' 	=> '',
				'country_long'	 	=> '',
				'address'			=> '',
				'formatted_address' => '',
				'lat'				=> '',
				'lng'				=> '',
				'map_icon'			=> '_default.png'
			);

			// merge default field with geocodede fields
			$location_data = wp_parse_args( $geocoded_address, $defaults );

			// set the rest of the address xprofile fields if set in hte settings.
			// That is in case that the admin will switch method in the future
			if ( $this->xf_settings['xf_use'] == 'single' ) { 
				
				$location_data['address'] = $entered_address['address'];

				foreach ( array( 'street', 'apt', 'city', 'zipcode' ) as $afield ) {

					if ( ! empty( $this->xf_settings['address_fields'][$afield] ) ) {
						xprofile_set_field_data( $this->xf_settings['address_fields'][$afield], $user_id, $location_data[$afield] );
					}
				}

				if ( ! empty( $this->xf_settings['address_fields']['state'] ) ) {
					xprofile_set_field_data( $this->xf_settings['address_fields']['state'], $user_id, $location_data['state_long'] );
				}

				if ( ! empty( $this->xf_settings['address_fields']['country'] ) ) {
					xprofile_set_field_data( $this->xf_settings['address_fields']['country'], $user_id, $location_data['country_long'] );
				}

			// otherwise, set the full address field, if set, when using multiple address fields method.
			} else {

				// replace the geocoded data fields with the values of the entered fields.
				// We don't want the saved address to be different than the address
				// the user entered
				foreach ( array( 'street', 'apt', 'city', 'zipcode' ) as $afield ) {

					if ( ! empty( $entered_address[$afield] ) ) {
						$location_data[$afield] = $entered_address[$afield];
					}
				}

				// set the full address into "full address" profile fields 
				$location_data['address'] = $location_data['street'] .' '. $location_data['apt'] .' '. $location_data['city'] .' ' . $location_data['state_long'] .' ' . $location_data['zipcode'] .' ' . $location_data['country_short'];

				if ( ! empty( $this->xf_settings['address_fields']['address'] ) ) {
					xprofile_set_field_data( $this->xf_settings['address_fields']['address'], $user_id, $location_data['address'] );
				}

				if ( ! empty( $this->xf_settings['address_fields']['state'] ) && ! empty( $location_data['state_long'] ) ) {
					xprofile_set_field_data( $this->xf_settings['address_fields']['state'], $user_id, $location_data['state_long'] );
				}

				if ( ! empty( $this->xf_settings['address_fields']['country'] ) && ! empty( $location_data['country_short'] ) ) {
					xprofile_set_field_data( $this->xf_settings['address_fields']['country'], $user_id, $location_data['country_short'] );
				}
			}

			// save location in databased
			$this->update_location( $location_data, $user_id );
		
		// if geocoding failed					
		} else {

			// delete locaiton from databased
			$this->delete_location( $user_id );
		}
	}
	
	/**
	 * Save location to database
	 * 
	 * @param  [type] $location_data [description]
	 * @param  [type] $user_id       [description]
	 * @return [type]                [description]
	 */
	public function update_location( $location_data, $user_id ) {
		
		// look for map icon
		$location_data['map_icon'] = ! empty( $_POST['map_icon'] ) ? $_POST['map_icon'] : '_default.png';

		// modify the data before saved
		$location = apply_filters( 'gmw_xf_location_before_updated', $location_data, $user_id );
		
		global $wpdb;

		// add location to database
		$wpdb->replace( 'wppl_friends_locator', array(
			'member_id'			=> $user_id,
			'street'			=> $location_data['street'],
			'apt'				=> $location_data['apt'],
			'city' 				=> $location_data['city'],
			'state' 			=> $location_data['state_short'],
			'state_long' 		=> $location_data['state_long'],
			'zipcode'			=> $location_data['zipcode'],
			'country' 			=> $location_data['country_short'],
			'country_long'	 	=> $location_data['country_long'],
			'address'			=> $location_data['address'],
			'formatted_address' => $location_data['formatted_address'],
			'lat'				=> $location_data['lat'],
			'long'				=> $location_data['lng'],
			'map_icon'			=> $location_data['map_icon']
		));

		// possible to disable activity update		
		if ( apply_filters( 'gmw_xf_update_location_activity', true ) ) {
			
			$args = array(
				'location'  => apply_filters( 'gmw_xf_address_activity_update', $location_data['address'], $location_data, $this->settings ),
				'user_id'	=> $user_id
			);

			$activity_id = gmw_location_record_activity( $args );
		}
	}

	/**
	 * Delete location from database
	 * 
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	public function delete_location( $user_id ) {
			
		global $wpdb;
		
		// delete location from GEO my WP database
		$wpdb->query(
			$wpdb->prepare(
				"DELETE FROM wppl_friends_locator WHERE member_id=%d", $user_id
			)
		);

		// delete location from profile fields
		foreach ( array( 'street', 'apt', 'city', 'state', 'zipcode', 'country', 'address' ) as $afield ) {

			if ( ! empty( $this->xf_settings['address_fields'][$afield] ) ) {
            	xprofile_delete_field_data( $this->xf_settings['address_fields'][$afield], $user_id ); 
        	}
        }
	}
}
$gmw_xf_geocoder = new GMW_XF_Location_Geocoder;
?>