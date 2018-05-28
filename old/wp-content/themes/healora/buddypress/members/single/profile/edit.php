<?php
/**
 * BuddyPress - Members Single Profile Edit
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires after the display of member profile edit content.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_profile_edit_content' );

if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) :
	while ( bp_profile_groups() ) : bp_the_profile_group(); ?>


<!-- Custom -->
<?php
	if(current_user_can("patient")) {
  		echo "<style>.field_11130, .field_100, .field_101, .field_10249, .field_102, .field_1711, .field_1713, .field_1714, .field_1715, .field_11135, .field_11139, .field_1786, .field_1786, .field_11565, .field_11566, .field_2, .field_1950, .field_1952, .field_1954, .field_1956, .field_2020, .field_1960, .field_2022, .field_1962, .field_1966, .field_2024, .field_2026, .field_2028, .field_1974, .field_1982, .field_1984, .field_1986, .field_1988, .field_2030, .field_1990, .field_1992, .field_1994, .field_2032, .field_1996, .field_2034, .field_1998, .field_2000, .field_2036, .field_2002, .field_2004, .field_2006, .field_2008, .field_2010, .field_2012, .field_2014, .field_2016, .field_2018 {display: none;}</style>"; }
  	if(current_user_can("subscriber")) {
  		echo "<style>.field_11120{display: none;}</style>"; }
?>

<div class="user-profile-settings-menu">
	<ul>
		<li><a href="<?php echo bp_displayed_user_domain() . '/profile/edit/group/1/'; ?>" style="font-weight: 700;">Edit Profile</a></li>
		<li><a href="<?php echo bp_displayed_user_domain() . '/profile/change-avatar/'; ?>">Change Profile Photo</a></li>
		<li><a href="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>">Edit Password And Email</a></li>
	</ul>
</div>
<!-- Custom END -->


<form action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="standard-form <?php bp_the_profile_group_slug(); ?>">

	<?php

		/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
		do_action( 'bp_before_profile_field_content' ); ?>

		<!-- <h2><?php printf( __( "Editing '%s' Profile Group", 'buddypress' ), bp_get_the_profile_group_name() ); ?></h2> -->

		<?php if ( bp_profile_has_multiple_groups() ) : ?>
			<ul class="button-nav" aria-label="<?php esc_attr_e( 'Profile field groups', 'buddypress' ); ?>" role="navigation">

				<?php bp_profile_group_tabs(); ?>

			</ul>
		<?php endif ;?>

		<div class="clear"></div>

		<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

			<div<?php bp_field_css_class( 'editfield' ); ?>>

				<?php
				$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
				$field_type->edit_field_html();

				/**
				 * Fires before the display of visibility options for the field.
				 *
				 * @since 1.7.0
				 */
				do_action( 'bp_custom_profile_edit_fields_pre_visibility' );
				?>

				<?php if ( bp_current_user_can( 'bp_xprofile_change_field_visibility' ) ) : ?>
					<p class="field-visibility-settings-toggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
						<?php
						printf(
							__( 'This field can be seen by: %s', 'buddypress' ),
							'<span class="current-visibility-level">' . bp_get_the_profile_field_visibility_level_label() . '</span>'
						);
						?>
						<button type="button" class="visibility-toggle-link"><?php _e( 'Change', 'buddypress' ); ?></button>
					</p>

					<div class="field-visibility-settings" id="field-visibility-settings-<?php bp_the_profile_field_id() ?>">
						<fieldset>
							<legend><?php _e( 'Who can see this field?', 'buddypress' ) ?></legend>

							<?php bp_profile_visibility_radio_buttons() ?>

						</fieldset>
						<button type="button" class="field-visibility-settings-close"><?php _e( 'Close', 'buddypress' ) ?></button>
					</div>
				<?php else : ?>
					<div class="field-visibility-settings-notoggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
						<?php
						printf(
							__( 'This field can be seen by: %s', 'buddypress' ),
							'<span class="current-visibility-level">' . bp_get_the_profile_field_visibility_level_label() . '</span>'
						);
						?>
					</div>
				<?php endif ?>

				<?php

				/**
				 * Fires after the visibility options for a field.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_custom_profile_edit_fields' ); ?>

				<p class="description"><?php bp_the_profile_field_description(); ?></p>
			</div>

		<?php endwhile; ?>

	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
	do_action( 'bp_after_profile_field_content' ); ?>

	<div class="submit">
		<input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" value="<?php esc_attr_e( 'Save Changes', 'buddypress' ); ?> " />
	</div>

	<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_field_ids(); ?>" />

	<?php wp_nonce_field( 'bp_xprofile_edit' ); ?>

</form>

<?php endwhile; endif; ?>

<?php

/**
 * Fires after the display of member profile edit content.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_profile_edit_content' ); ?>
