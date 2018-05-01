<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

/**
 * Display all users without GEO my WP location
 *
 * @since 1.4
 *
 * @author Eyal Fitoussi
 */
class GMW_XF_Admin_Users_Table {

	/**
	 * [__construct description]
	 */
	public function __construct() {

		// add submenu item to GEO my WP menu
		add_filter( 'gmw_admin_menu_items', array( $this, 'submenu_item' ) );
	}

	/**
	 * Submenu item
	 * 
	 * @param  [type] $menu_items [description]
	 * @return [type]             [description]
	 */
	function submenu_item( $menu_items ) {

		$menu_items[] = array( 
			'page_title' 		=> __( 'GEO my WP Users Locations Status', 'GMW-XF' ), 
			'menu_title' 		=> __( 'Members Locations Status', 'GMW-XF' ), 
			'capability' 		=> 'manage_options', 
			'menu_slug'  		=> 'gmw-xf-users-location-status',
			'callback_function' => array( $this, 'users_table_content' ) 
		);

		return $menu_items;
	}

	/**
	 * Page content 
	 * 
	 * @return [type] [description]
	 */
	public function users_table_content() {

		global $wpdb;

		// get all members without location
		$members = $wpdb->get_results( "
			SELECT users.*
			FROM {$wpdb->users} users LEFT JOIN wppl_friends_locator gmw on users.ID = gmw.member_id
			WHERE gmw.member_id IS NULL" );
		?>
		<div class="wrap">

			<h1><?php _e( 'GEO my WP Members Locations status', 'GMW-XF' ); ?></h1>

			<?php if ( ! empty( $members ) ) { ?>
				
				<p><strong><?php _e( 'Showing all members with missing GEO my WP location.', 'GMW-XF' ); ?></strong></p>

				<table class="wp-list-table widefat fixed striped posts">
					
					<thead>
						<th><?php _e( 'User ID', 'GMW-XF' ); ?></th>
						<th><?php _e( 'User name', 'GMW-XF' ); ?></th>
						<th><?php _e( 'Action', 'GMW-XF' ); ?></th>
					</thead>
					
					<tbody>
						
						<?php foreach ( $members as $member ) { ?>
							
							<tr>
								<td><?php echo esc_attr( $member->ID ); ?></td>
								<td><?php echo esc_attr( $member->display_name ); ?></td>
								<td><a href="<?php echo esc_url( admin_url( 'users.php?page=bp-profile-edit&user_id=' . $member->ID ) ) ; ?>"><?php _e( 'Edit user', 'GMW-XF' ); ?></a></td>
							</tr>

						<?php } ?>
					
					</tbody>
				
				</table>
			
			<?php } else { ?>

				<p><strong><?php _e( 'All members location properly set in GEO my WP database.', 'GMW-XF' ); ?></strong></p>
			
			<?php } ?>
		
		</div>
		<?php
	}
}
new GMW_XF_Admin_Users_Table();