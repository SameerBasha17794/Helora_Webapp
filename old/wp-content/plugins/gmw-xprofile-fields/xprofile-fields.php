<?php
/*
  Plugin Name: GMW Add-on - Xprofile Fields
  Plugin URI: http://www.geomywp.com
  Description: Integrate Xprofile fields with GEO my WP. Allow the members of your site add their location in the registration form and add/update it from the "Edit Profile" page.
  Author: Eyal Fitoussi
  Version: 1.4.0.1
  Author URI: http://www.geomywp.com
  Requires at least: 4.0
  Tested up to: 4.5.1
  GEO my WP: 2.6.1+
  Text Domain: GMW-XF
  Domain Path: /languages/
  License: GNU General Public License v3.0
  License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * GMW_Xprofile_Fields
 */
class GMW_Xprofile_Fields {

   	/**
     * __construct function.
     */
    public function __construct() {
    	
    	define( 'GMW_XF_ITEM_NAME', 'Xprofile Fields' );
    	define( 'GMW_XF_LICENSE_NAME', 'xprofile_fields' );
    	define( 'GMW_XF_VERSION', '1.4.0.1' );
    	define( 'GMW_XF_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
    	define( 'GMW_XF_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
    	define( 'GMW_XF_FILE', __FILE__ );
    	
        // load plugin text domain
        add_action( 'plugins_loaded', array( $this, 'textdomain' ) );

        // do some actions
        add_filter( 'gmw_admin_addons_page', array( $this, 'addon_init' ) );

        // make sure GEO my WP is activated and compare version, otherwise abort.
        if ( ! class_exists( 'GEO_my_WP' ) || version_compare( GMW_VERSION, '2.6.1', '<' ) ) {
            add_action( 'admin_notices', array( $this, 'gmw_admin_notice' ) );      
            return;
        }

        // check if addon is activeted via GEO my WP
        if ( ! GEO_my_WP::gmw_check_addon( 'xprofile_fields' ) ) {
            return;
        }

        // verofy Members Locator add-on
        if ( ! GEO_my_WP::gmw_check_addon( 'friends' ) ) {
            add_action( 'admin_notices', array( $this, 'gmw_fl_admin_notice' ) );      
            return;
        }

        // verify BuddyPress
        if ( ! class_exists( 'BuddyPress' ) || ( class_exists( 'BuddyPress' ) && BP_VERSION < '2.0' ) ) {
            add_action( 'admin_notices', array( $this, 'buddypress_admin_notice' ) );      
            return;
        }
        
        // init add-on bp_init
        add_action( 'bp_init', array( $this, 'init' ) );
    }

    /**
     * lad plugin testdomain
     * 
     * @return [type] [description]
     */
    public function textdomain() {
        load_plugin_textdomain( 'GMW-XF', FALSE, dirname(plugin_basename(__FILE__)).'/languages/' );
    }

    /**
     * Include addon function.
     *
     * @access public
     * @return $addons
     */
    public function addon_init( $addons ) {

        $addons[GMW_XF_LICENSE_NAME] = array(
            'name'          => GMW_XF_LICENSE_NAME,
            'item'          => GMW_XF_ITEM_NAME,
            'item_id'       => null,
            'title'         => __( ' GEO Xprofile Fields', 'GMW-XF' ),
            'version'       => GMW_XF_VERSION,
            'file'          => GMW_XF_FILE,
            'basename'      => plugin_basename( GMW_XF_FILE ),
            'author'        => 'Eyal Fitoussi',  
            'desc'          => __( 'BuddyPress xprofile fields and GEO my WP integration.', 'GMW-XF' ),
            'image'         => false,
            'require'       => array(),
            'license'       => true,
            'auto_trigger'  => true,
            'min_version'   => false,
            'stand_alone'   => false,
            'core'          => false,
            'gmw_version'   => '2.5'
        );

        return $addons;
    }

    /**
     * GEO my WP admin notice
     * 
     * @return [type] [description]
     */
    public function gmw_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'Xprofile Fields add-on version 1.4 requires GEO my WP plugin version 2.6.1 or higher.', 'GMW-XF' ); ?></p>
        </div>  
        <?php
    }

    /**
     * Members Locator admin notice
     * 
     * @return [type] [description]
     */
    public function gmw_fl_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'Xprofile Fields add-on version 1.4 requires requires GEO my WP Memebrs Locator add-on.', 'GMW-XF' ); ?></p>
        </div>  
        <?php
    }

    /**
     * BuddyPress admin notice
     * 
     * @return [type] [description]
     */
    public function buddypress_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'Xprofile Fields add-on requires Buddypress plugin version 2.0 or higher.', 'GMW-XF' ); ?></p>
        </div>  
        <?php
    }

    /**
     * Verify xprofile component
     * 
     * @return [type] [description]
     */
    public function bp_xprofile_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'GEO Xprofle Fields add-on requires Buddypress\'s Extended Profiles component to be activate.', 'GMW-XF' ); ?></p>
        </div>  
        <?php
    }
    
    /**
     * Initiate add-on on bp_init
     * 
     * @return [type] [description]
     */
    public function init() {

        // abort if xprofile component is inactive
        if ( ! bp_is_active( 'xprofile' ) ) {
            add_action( 'admin_notices', array( $this, 'buddypress_xprofile_admin_notice' ) );      
            return;
        }

        // gmw settings
        $this->settings = get_option( 'gmw_options' );

        // enqueue scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
        
        // update profile fields when Location tab updated
        add_action( 'gmw_fl_after_location_saved', array( $this, 'xprofile_location_tab_sync' ), 10, 2 );
        
        // delete prfoile fields data when Location tab deleted
        add_action( 'gmw_fl_after_location_deleted', array( $this, 'xprofile_location_tab_sync' ), 10 );

        // include files in admin
        if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
            include( 'includes/admin/gmw-xf-admin.php' );
            include( 'includes/admin/gmw-xf-admin-users-table-class.php' );
        }

        // action for frontend only
        if ( ! is_admin() ) {

            // disable locaiton tab
            $this->disable_location_tab();
        }

        // include file only where necessary
        if ( bp_is_register_page() || bp_is_user_profile_edit() || ( is_admin() && ! empty( $_GET['page'] ) && $_GET['page'] == 'bp-profile-edit' ) ) {
            
            include( 'includes/gmw-xf-location-geocoder-class.php' );
        }
    }

    /**
     * register scripts function.
     *
     * @access public
     * @return void
     */
    public function register_scripts() {
        wp_register_script( 'gmw-xf', GMW_XF_URL . '/assets/js/gmw.xf.min.js', array( 'jquery' ), GMW_XF_VERSION, true );
    }

    /**
     * Disable location tab
     * 
     * @return [type] [description]
     */
    public function disable_location_tab() {  	
    	
        // Remove location tab and display map instead
        if ( is_user_logged_in() && isset( $this->settings['xprofile_fields']['my_location_tab'] ) ) {

            if ( $this->settings['xprofile_fields']['my_location_tab'] == 'disabled' ) {
               
                bp_core_remove_nav_item('location');

                add_filter( 'gmw_fl_setup_admin_bar', '__return_false', 10 );

            } elseif ( $this->settings['xprofile_fields']['my_location_tab'] == 'map' ) {

                add_filter( 'gmw_fl_location_tab_mine', '__return_false' );
            }
        }	
    }

    /**
     * Update / delete xprofile fields when Location tab udpate
     * 
     * @param  [type] $user_id  [description]
     * @param  array  $location [description]
     * 
     * @return [type]           [description]
     */
    public function xprofile_location_tab_sync( $user_id, $location = array() ) {

        foreach ( array( 'street', 'apt', 'city', 'state', 'zipcode', 'country', 'address' ) as $afield ) {

            if ( ! empty( $location ) && ! empty( $this->settings['xprofile_fields']['address_fields'][$afield] ) ) {
                xprofile_set_field_data( $this->settings['xprofile_fields']['address_fields'][$afield], $user_id, $location['gmw_'.$afield] );
            } else {
                xprofile_delete_field_data( $this->settings['xprofile_fields']['address_fields'][$afield], $user_id );
            } 
        }
    }
}
$gmw_xf_init = new GMW_Xprofile_Fields();