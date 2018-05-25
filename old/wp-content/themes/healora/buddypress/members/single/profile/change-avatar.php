<?php
/**
 * BuddyPress - Members Profile Change Avatar
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<!-- <h2><?php _e( 'Change Profile Photo', 'buddypress' ); ?></h2> -->

<?php

/**
 * Fires before the display of profile avatar upload content.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_profile_avatar_upload_content' ); ?>

<style>
section.medicom-waypoint>div.caption {
    display: none;
}
</style>


<!-- Custom -->
<!-- <div class="user-profile-settings-menu">
	<ul>
		<li><a href="<?php echo bp_displayed_user_domain() . '/profile/edit/group/1/'; ?>">Edit Profile</a></li>
		<li><a href="<?php echo bp_displayed_user_domain() . '/profile/change-avatar/'; ?>" style="font-weight: 700;">Change Profile Photo</a></li>
		<li><a href="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>">Edit Password And Email</a></li>
	</ul>
</div> -->
<!-- Custom END -->


<div class="row">
<div class="col-md-6">
<?php if ( !(int)bp_get_option( 'bp-disable-avatar-uploads' ) ) : ?>

	<!-- <p><?php _e( 'Your profile photo will be used on your profile and throughout the site. If there is a <a href="http://gravatar.com">Gravatar</a> associated with your account email we will use that, or you can upload an image from your computer.', 'buddypress' ); ?></p> -->

	<form action="" method="post" id="avatar-upload-form" class="standard-form" enctype="multipart/form-data">

		<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

			<?php wp_nonce_field( 'bp_avatar_upload' ); ?>
			<p><?php _e( 'Click below to select a JPG, GIF or PNG format photo from your computer and then click \'Upload Image\' to proceed.', 'buddypress' ); ?></p>

			<p id="avatar-upload">
				<label for="file" class="bp-screen-reader-text"><?php
					/* translators: accessibility text */
					_e( 'Select an image', 'buddypress' );
				?></label>
				<input type="file" name="file" id="file" />
				<input type="submit" name="upload" id="upload" value="<?php esc_attr_e( 'Upload Image', 'buddypress' ); ?>" />
				<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
			</p>

			<?php if ( bp_get_user_has_avatar() ) : ?>
				<p><?php _e( "If you'd like to delete your current profile photo but not upload a new one, please use the delete profile photo button.", 'buddypress' ); ?></p>
				<p><a class="button edit" href="<?php bp_avatar_delete_link(); ?>"><?php _e( 'Delete My Profile Photo', 'buddypress' ); ?></a></p>
			<?php endif; ?>

		<?php endif; ?>

		<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

			<h5><?php _e( 'Crop Your New Profile Photo', 'buddypress' ); ?></h5>

			<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php esc_attr_e( 'Profile photo to crop', 'buddypress' ); ?>" />

			<div id="avatar-crop-pane">
				<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php esc_attr_e( 'Profile photo preview', 'buddypress' ); ?>" />
			</div>

			<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php esc_attr_e( 'Crop Image', 'buddypress' ); ?>" />

			<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />

			<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>

		<?php endif; ?>

	</form>

	<?php
	/**
	 * Load the Avatar UI templates
	 *
	 * @since  2.3.0
	 */
	bp_avatar_get_templates(); ?>

<?php else : ?>

	<p><?php _e( 'Your profile photo will be used on your profile and throughout the site. To change your profile photo, please create an account with <a href="http://gravatar.com">Gravatar</a> using the same email address as you used to register with this site.', 'buddypress' ); ?></p>

<?php endif; ?>

<?php

/**
 * Fires after the display of profile avatar upload content.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_profile_avatar_upload_content' ); ?>

</div>


<div class="col-md-6 patient-profile-information">
<?php 
$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
?>
	<h1><?php echo xprofile_get_field_data('First Name', bp_get_member_user_id()); ?> <?php echo xprofile_get_field_data('Last Name', bp_get_member_user_id()); ?></h1>
	<p><?php echo $user_info->user_email; ?></p>
	<p><a href="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>">edit password</a></p>
	<!-- <p>phone number</p> -->
</div>
</div>


<?php
// Get last post of current user (last procedure that user bought)
$currentLoggedUserID = bp_loggedin_user_id();

$args = array(
      'author'        =>  $currentLoggedUserID,
      'post_type'     =>  'easy_payment_list',
      'post_status'   =>  'publish',
      'orderby'       =>  'post_date',
      'order'         =>  'DESC',
      'posts_per_page' => 48
      );
$current_user_posts = get_posts($args);

if (!empty($current_user_posts)) { ?>

	<div class="row">
	<div class="col-md-12 user-profile-booked-procedures-wrapper">
	<h2>BOOKED PROCEDURES</h2>


	<?php foreach ($current_user_posts as $post) {

		// Custom
		$allText = get_post_meta($post->ID, 'item_name', true);
		$findPatientID = "PATIENT ID:";
		$findDoctorID = ", DOCTOR ID:";
		$findProcedureSKU = ", SKU:"; 
		$findCouponCode = ", COUPON CODE:";
		$infoEND = "END";


		// Get patient ID
		$startPosition = strpos ($allText, $findPatientID) + strlen($findPatientID);
		if (strpos($allText, $findPatientID) !== false) {
		  $endPosition = strpos($allText, $findDoctorID, $startPosition);
		  $getPatientID = substr($allText, $startPosition, $endPosition - $startPosition);
		}

		// Get doctor ID
		$startPosition = strpos ($allText, $findDoctorID) + strlen($findDoctorID);
		if (strpos($allText, $findDoctorID) !== false) {
		  $endPosition = strpos($allText, $findProcedureSKU, $startPosition);
		  $getDoctorID = substr($allText, $startPosition, $endPosition - $startPosition);
		}

		// Get procedure SKU
		$startPosition = strpos ($allText, $findProcedureSKU) + strlen($findProcedureSKU);
		if (strpos($allText, $findProcedureSKU) !== false) {
		  $endPosition = strpos($allText, $findCouponCode, $startPosition);
		  $getProcedureSKU = substr($allText, $startPosition, $endPosition - $startPosition);
		}

		// Get coupon code
		$startPosition = strpos ($allText, $findCouponCode) + strlen($findCouponCode);
		if (strpos($allText, $findCouponCode) !== false) {
		  $endPosition = strpos($allText, $infoEND, $startPosition);
		  $getCouponCode = substr($allText, $startPosition, $endPosition - $startPosition);
		}

		// Get procedures info
		global $wpdb;
		$currentCategoryINFO = $wpdb->get_row("SELECT * FROM hea_bp_xprofile_fields WHERE sku = '".$getProcedureSKU."'", ARRAY_A); ?>

		<div class="col-md-4 user-profile-booked-procedures">
			<div class="user-profile-booked-procedures-container">
				<h3><?php echo $currentCategoryINFO["name"]; ?></h3>
				<p>CPT - <?php echo $currentCategoryINFO["cpt"]; ?>, SKU - <?php echo $currentCategoryINFO["sku"]; ?></p>
				<h3><?php echo xprofile_get_field_data('First Name', $getDoctorID); ?> <?php echo xprofile_get_field_data('Last Name', $getDoctorID); ?></h3>
				<br>
				<h3><?php echo $getCouponCode; ?></h3>
				<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>
				<a class="accent-color-inverse-button" href="#">FIND LOCATION</a>
			</div>
		</div>
	<?php } ?>

	</div>
	</div>

<?php } //if (!empty($current_user_posts)) ?>


<div class="row">
<div class="col-md-12 patient-profile-questions">
	<a class="accent-color-inverse-button" href="https://healora.com/contact/">QUESTION?</a>
</div>
</div>