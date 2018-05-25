<?php
/**
 * BuddyPress - Members Register
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div id="buddypress">

	<?php

	/**
	 * Fires at the top of the BuddyPress member registration page template.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_register_page' ); ?>

	<div class="page" id="register-page">

		<form action="" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">

		<?php if ( 'registration-disabled' == bp_get_current_signup_step() ) : ?>

			<div id="template-notices" role="alert" aria-atomic="true">
				<?php

				/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
				do_action( 'template_notices' ); ?>

			</div>

			<?php

			/**
			 * Fires before the display of the registration disabled message.
			 *
			 * @since 1.5.0
			 */
			do_action( 'bp_before_registration_disabled' ); ?>

				<p><?php _e( 'User registration is currently not allowed.', 'buddypress' ); ?></p>

			<?php

			/**
			 * Fires after the display of the registration disabled message.
			 *
			 * @since 1.5.0
			 */
			do_action( 'bp_after_registration_disabled' ); ?>
		<?php endif; // registration-disabled signup step ?>

		<?php if ( 'request-details' == bp_get_current_signup_step() ) : ?>

			<div id="template-notices" role="alert" aria-atomic="true">
				<?php

				/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
				do_action( 'template_notices' ); ?>

				<!-- Custom -->
				<h3 class="registration-profile-title"><?php _e( 'Registration Profile' ); ?></h3>
				<h3 class="provider-registration-title"><?php _e( 'Provider Registration' ); ?></h3>
				<!-- Custom END -->

			</div>

			<!-- <p><?php _e( 'Registering for this site is easy. Just fill in the fields below, and we\'ll get a new account set up for you in no time.', 'buddypress' ); ?></p> -->

			<?php

			/**
			 * Fires before the display of member registration account details fields.
			 *
			 * @since 1.1.0
			 */
			do_action( 'bp_before_account_details_fields' ); ?>

			<div class="register-section" id="basic-details-section">

				<?php /***** Basic Account Details ******/ ?>

				<!-- <h2><?php _e( 'Account Details', 'buddypress' ); ?></h2> -->

				<!-- Custom -->
				<h5 style="margin-top: -1px; padding-bottom: 6px;"><?php _e( 'Login Information', 'buddypress' ); ?></h5>
				<!-- Custom END -->

				<label for="signup_username"><?php _e( 'Username', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
				<?php

				/**
				 * Fires and displays any member registration username errors.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_signup_username_errors' ); ?>
				<input type="text" name="signup_username" id="signup_username" value="<?php bp_signup_username_value(); ?>" <?php bp_form_field_attributes( 'username' ); ?>/>

				<label for="signup_email"><?php _e( 'Email Address', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
				<?php

				/**
				 * Fires and displays any member registration email errors.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_signup_email_errors' ); ?>
				<input type="email" name="signup_email" id="signup_email" value="<?php bp_signup_email_value(); ?>" <?php bp_form_field_attributes( 'email' ); ?>/>

				<label for="signup_password"><?php _e( 'Choose a Password', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
				<?php

				/**
				 * Fires and displays any member registration password errors.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_signup_password_errors' ); ?>
				<input type="password" name="signup_password" id="signup_password" value="" class="password-entry" <?php bp_form_field_attributes( 'password' ); ?>/>
				<div id="pass-strength-result"></div>

				<label for="signup_password_confirm"><?php _e( 'Confirm Password', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
				<?php

				/**
				 * Fires and displays any member registration password confirmation errors.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_signup_password_confirm_errors' ); ?>
				<input type="password" name="signup_password_confirm" id="signup_password_confirm" value="" class="password-entry-confirm" <?php bp_form_field_attributes( 'password' ); ?>/>

				<?php

				/**
				 * Fires and displays any extra member registration details fields.
				 *
				 * @since 1.9.0
				 */
				do_action( 'bp_account_details_fields' ); ?>

			</div><!-- #basic-details-section -->

			<?php

			/**
			 * Fires after the display of member registration account details fields.
			 *
			 * @since 1.1.0
			 */
			do_action( 'bp_after_account_details_fields' ); ?>

			<?php /***** Extra Profile Details ******/ ?>

			<?php if ( bp_is_active( 'xprofile' ) ) : ?>

				<?php

				/**
				 * Fires before the display of member registration xprofile fields.
				 *
				 * @since 1.2.4
				 */
				do_action( 'bp_before_signup_profile_fields' ); ?>

				<!-- Custom -->
				<h5 class="profile-information-title"><?php _e( 'Profile Information', 'buddypress' ); ?></h5>

				<h5 class="doctor-profile-information-title"><?php _e( 'Doctor Profile Information', 'buddypress' ); ?></h5>
				<!-- Custom END -->

				<div class="register-section" id="profile-details-section">

					<!-- <h2><?php _e( 'Profile Details', 'buddypress' ); ?></h2> -->

					<?php /* Use the profile field loop to render input fields for the 'base' profile field group */ ?>
					<?php if ( bp_is_active( 'xprofile' ) ) : if ( bp_has_profile( array( 'profile_group_id' => 1, 'fetch_field_data' => false ) ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

						<div<?php bp_field_css_class( 'editfield' ); ?>>

							<?php
							$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
							$field_type->edit_field_html();

							/**
							 * Fires before the display of the visibility options for xprofile fields.
							 *
							 * @since 1.7.0
							 */
							do_action( 'bp_custom_profile_edit_fields_pre_visibility' );

							if ( bp_current_user_can( 'bp_xprofile_change_field_visibility' ) ) : ?>
								<p class="field-visibility-settings-toggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
									<?php
									printf(
										__( 'This field can be seen by: %s', 'buddypress' ),
										'<span class="current-visibility-level">' . bp_get_the_profile_field_visibility_level_label() . '</span>'
									);
									?>
									<button type="button" class="visibility-toggle-link"><?php _ex( 'Change', 'Change profile field visibility level', 'buddypress' ); ?></button>
								</p>

								<div class="field-visibility-settings" id="field-visibility-settings-<?php bp_the_profile_field_id() ?>">
									<fieldset>
										<legend><?php _e( 'Who can see this field?', 'buddypress' ) ?></legend>

										<?php bp_profile_visibility_radio_buttons() ?>

									</fieldset>
									<button type="button" class="field-visibility-settings-close"><?php _e( 'Close', 'buddypress' ) ?></button>

								</div>
							<?php else : ?>
								<p class="field-visibility-settings-notoggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
									<?php
									printf(
										__( 'This field can be seen by: %s', 'buddypress' ),
										'<span class="current-visibility-level">' . bp_get_the_profile_field_visibility_level_label() . '</span>'
									);
									?>
								</p>
							<?php endif ?>

							<?php

							/**
							 * Fires after the display of the visibility options for xprofile fields.
							 *
							 * @since 1.1.0
							 */
							do_action( 'bp_custom_profile_edit_fields' ); ?>

							<p class="description"><?php bp_the_profile_field_description(); ?></p>

						</div>

					<?php endwhile; ?>

					<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_field_ids(); ?>" />

					<?php endwhile; endif; endif; ?>

					<?php

					/**
					 * Fires and displays any extra member registration xprofile fields.
					 *
					 * @since 1.9.0
					 */
					do_action( 'bp_signup_profile_fields' ); ?>

					<!-- Custom -->
					<div id="doctor-button-registration-page">
						<p>Are You A Doctor?<br>REGISTER with HEALORA</p>
					</div>	
					<!-- Custom -->

				</div><!-- #profile-details-section -->


				<!-- Custom - terms and conditions modal -->
				<div class="terms-conditions-container">
					<legend>Terms &amp; Conditions<span class="bp-required-field-label">(required)</span></legend>
					<input type="checkbox" name="termsConditions" value="agreeTermsConditions" id="terms-conditions-checked"> I agree to honor pricing on all service(s) performed at the scheduled appointment IF the patient pays at the time of service.<br>
					<span class="terms-conditions-hover" data-toggle="modal" data-target="#tearmsAndConditions">Read terms &amp; conditions.</span>
				</div>

				<script>
				var $ = jQuery;
				$(document).ready(function(){
					$('#signup_submit').attr('disabled',true);
				    $('#terms-conditions-checked').click(function(){
				        if($(this).val().length !=0)
				            $('#signup_submit').attr('disabled', false);            
				        else
				            $('#signup_submit').attr('disabled',true);
				    })
				});
				</script>

				<!-- Modal -->
				<div id="tearmsAndConditions" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-lg">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Providers direct pay network agreement</h4>
				      </div>
				      <div class="modal-body">
				        <p>Thank you for your interest in Healora. We connect physicians as <b>direct pay</b> providers, including all specialties of physicians, labs, and imaging centers, surgical centers, and hospitals with our network of employees willing to pay at the time of service.  We ask that the direct pay provider agrees to:</p>
				        	<ol type="1">
								<li>The direct pay provider agrees to honor <u>lowest</u> <b>agreed</b> <u>price by provider and patient</u> for the <b>specific procedure</b> requested for the visit when the patient has met the provider’s conditions and pays at the time of service.</li>
								<li>The direct pay provider agrees to honor the maximum <u>displayed</u> percentage <u>above</u> Medicare pricing (Medicare + 65%) as listed for all other CPT codes performed when a patient visits the office and there is a need for <b>additional or alternate services</b> that day on that specific visit.  Doctor agrees that this is the cash price for our network unless specific service has been negotiated to the lower reserve level set by the doctor.  This protects the doctor for any other services that are required or performed on the day of the visit.</li>
								<li>The direct pay provider does not <em>discriminate</em> on the basis of race, color, religion (creed), gender, gender expression, age, national origin (ancestry), disability, marital status, sexual orientation, or military status, in any of its activities or operations.</li>
							</ol>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default dark-blue-btn" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>


				<div id="ajax-response"></div>
				<!-- Custom END - terms and conditions modal -->


				<?php

				/**
				 * Fires after the display of member registration xprofile fields.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_after_signup_profile_fields' ); ?>

			<?php endif; ?>

			<?php if ( bp_get_blog_signup_allowed() ) : ?>

				<?php

				/**
				 * Fires before the display of member registration blog details fields.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_before_blog_details_fields' ); ?>

				<?php /***** Blog Creation Details ******/ ?>

				<div class="register-section" id="blog-details-section">

					<h2><?php _e( 'Blog Details', 'buddypress' ); ?></h2>

					<p><label for="signup_with_blog"><input type="checkbox" name="signup_with_blog" id="signup_with_blog" value="1"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes, I\'d like to create a new site', 'buddypress' ); ?></label></p>

					<div id="blog-details"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?>class="show"<?php endif; ?>>

						<label for="signup_blog_url"><?php _e( 'Blog URL', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
						<?php

						/**
						 * Fires and displays any member registration blog URL errors.
						 *
						 * @since 1.1.0
						 */
						do_action( 'bp_signup_blog_url_errors' ); ?>

						<?php if ( is_subdomain_install() ) : ?>
							http:// <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value(); ?>" /> .<?php bp_signup_subdomain_base(); ?>
						<?php else : ?>
							<?php echo home_url( '/' ); ?> <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value(); ?>" />
						<?php endif; ?>

						<label for="signup_blog_title"><?php _e( 'Site Title', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
						<?php

						/**
						 * Fires and displays any member registration blog title errors.
						 *
						 * @since 1.1.0
						 */
						do_action( 'bp_signup_blog_title_errors' ); ?>
						<input type="text" name="signup_blog_title" id="signup_blog_title" value="<?php bp_signup_blog_title_value(); ?>" />

						<fieldset class="register-site">
							<legend class="label"><?php _e( 'Privacy: I would like my site to appear in search engines, and in public listings around this network.', 'buddypress' ); ?></legend>
							<?php

							/**
							 * Fires and displays any member registration blog privacy errors.
							 *
							 * @since 1.1.0
							 */
							do_action( 'bp_signup_blog_privacy_errors' ); ?>

							<label for="signup_blog_privacy_public"><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_public" value="public"<?php if ( 'public' == bp_get_signup_blog_privacy_value() || !bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes', 'buddypress' ); ?></label>
							<label for="signup_blog_privacy_private"><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_private" value="private"<?php if ( 'private' == bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'No', 'buddypress' ); ?></label>
						</fieldset>

						<?php

						/**
						 * Fires and displays any extra member registration blog details fields.
						 *
						 * @since 1.9.0
						 */
						do_action( 'bp_blog_details_fields' ); ?>

					</div>

				</div><!-- #blog-details-section -->

				<?php

				/**
				 * Fires after the display of member registration blog details fields.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_after_blog_details_fields' ); ?>

			<?php endif; ?>

			<?php

			/**
			 * Fires before the display of the registration submit buttons.
			 *
			 * @since 1.1.0
			 */
			do_action( 'bp_before_registration_submit_buttons' ); ?>

			<div class="submit">
				<input type="submit" name="signup_submit" id="signup_submit" value="<?php esc_attr_e( 'Complete Sign Up', 'buddypress' ); ?>" />
			</div>

			<?php

			/**
			 * Fires after the display of the registration submit buttons.
			 *
			 * @since 1.1.0
			 */
			do_action( 'bp_after_registration_submit_buttons' ); ?>

			<?php wp_nonce_field( 'bp_new_signup' ); ?>

		<?php endif; // request-details signup step ?>

		<?php if ( 'completed-confirmation' == bp_get_current_signup_step() ) : ?>

			<div id="template-notices" role="alert" aria-atomic="true">
				<?php

				/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
				do_action( 'template_notices' ); ?>

			</div>

			<?php

			/**
			 * Fires before the display of the registration confirmed messages.
			 *
			 * @since 1.5.0
			 */
			do_action( 'bp_before_registration_confirmed' ); ?>

			<div id="template-notices" role="alert" aria-atomic="true">
				<?php if ( bp_registration_needs_activation() ) : ?>
					<p><?php _e( 'You have successfully created your account! To begin using this site you will need to activate your account via the email we have just sent to your address.', 'buddypress' ); ?></p>
				<?php else : ?>
					<p><?php _e( 'You have successfully created your account! Please log in using the username and password you have just created.', 'buddypress' ); ?></p>
				<?php endif; ?>
			</div>

			<?php

			/**
			 * Fires after the display of the registration confirmed messages.
			 *
			 * @since 1.5.0
			 */
			do_action( 'bp_after_registration_confirmed' ); ?>

		<?php endif; // completed-confirmation signup step ?>

		<?php

		/**
		 * Fires and displays any custom signup steps.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_custom_signup_steps' ); ?>

		</form>

	</div>

	<?php

	/**
	 * Fires at the bottom of the BuddyPress member registration page template.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_register_page' ); ?>

</div><!-- #buddypress -->


<!-- Custom -->
<script>
	var $ = jQuery;
	
	$(document).ready(function(){
		//Replace title name from procedures dropdowns to "Procedure"
		$('.field_1950 label, .field_1952 label, .field_1954 label, .field_1956 label, .field_2020 label, .field_1960 label, .field_2022 label, .field_1962 label, .field_1966 label, .field_2024 label, .field_2026 label, .field_2028 label, .field_1974 label, .field_1982 label, .field_1984 label, .field_1986 label, .field_1988 label, .field_2030 label, .field_1990 label, .field_1992 label, .field_1994 label, .field_2032 label, .field_1996 label, .field_2034 label, .field_1998 label, .field_2000 label, .field_2036 label, .field_2002 label, .field_2004 label, .field_2006 label, .field_2008 label, .field_2010 label, .field_2012 label, .field_2014 label, .field_2016 label, .field_2018 label').append("Procedures");


		// Insert "Select All" option
		$("<a href='javascript:void(0)' class='select-all-values'>Select all</a>").insertAfter($('a.clear-value'));
	
		 $('.select-all-values').click(function () {    
		     $(this).parent().find("option").prop('selected', true);;    
		 });

		 // Add FAQ button after "Medicare Pricing" label
		 $('<div style="display: flex; margin-bottom: 5px;"><span data-toggle="modal" data-target="#registrationPageFAQ" style="font-size: 10px; color: #fff; background-color: #2b96cc; padding: 2px 8px; border-radius: 5px; display: flex; width: 32px; margin: -5px 0 0 0; cursor: pointer;">FAQ</span><span style="font-weight: 700; color: #00aeef; font-size: 11px; padding-left: 10px;">Over 20 please call 424-270-0714</span></div>').insertAfter($('.field_1786 label'));

		 // Insert registration steps after "Doctor Profile Information"
		 $('<span data-toggle="modal" data-target="#registrationStepsInfo" style="font-size: 10px; color: #fff; background-color: #2b96cc; padding: 2px 8px; border-radius: 5px; display: flex; width: 64px; margin: -5px 0 2px 0; cursor: pointer;">MORE INFO</span>').insertAfter($(".doctor-profile-information-title"));

		 // Remove first empty option from "Medicare pricing" in registratio page
		 $("#field_1786").find('option[value=""]').remove();
	});
</script>


<!-- FAQ's Modal -->
<div id="registrationPageFAQ" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">PROVIDER REGISTRATION FAQ</h4>
		</div>
	<div class="modal-body">
		<h5><b>How do I start with HELORA NETWORK?</b></h5>
		<ul>
			<li>Go to www.HELORA.com and choose “Registration” on upper right menu.</li>
			<li>Begin “Provider” registration process to enter office contact information.</li>
			<li>Choose your hidden reserve discount pricing, if applicable.</li>
		</ul>

		<h5><b>Why I should I join HELORA now when it is still FREE to join?</b></h5>
		<ul>
			<li>HELORA is available, if needed, to walk your office manager through the very simple process of registration and application protocol.</li>
			<li>We want to hear from you at every level to improve all aspects of the process and user experience for your specific practise flow.</li>
		</ul>

		<p>We want this to be the best, most streamlined and seamless application it can be. Our aim is to develop the best user experience to help you get started and set-up right from the beginning.</p>

		<p>We are creating a medical market platform where self-paying patients can benefit from similar discounts you offer to your participating payers. You are spared:</p>
		<ol type="1">
			<li>Onerous network participation contracts</li>
			<li>Costly administrative compliance</li>
			<li>Chart reviews</li>
			<li>Delays in payment</li>
		</ol>

		<p>As long as you are a qualified member of the HELORA NETWORK the patient’s insurer will often accept your standard bill toward the patient’s deductible if the service complies with patient’s insurance contract. This is Irrespective of insurance type or plan the provider service is paid by patient at time of service.</p>

		<p>Patient and their employer benefit from the special pricing you offer (with conditions you set) and your office benefits from timely payment with no payment withhold, review, delay, or take back.</p>

		<p>With insurer cooperation we will provide patients with mobile applications that will appraise the patient of what is covered and the impact of your service on their deductible. Your office staff will no longer have to answer these complex coverage questions for new incoming Healora patients. The treating physician gets paid at time of service (surgical procedures will be prepaid), and is free to take care of the patient without having to deal with the insurer.</p>

		<p>The patient is paying out of pocket and is empowered to choose their provider and negotiate the price for services without embarrassment or insurer network restrictions.</p>

		<p>This is a win-win for the patient and provider alike.  Join your progressive colleagues at HELORA NETWORK. <u>Let us together make healthcare a binary system between patient and doctor.</u></p>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default dark-blue-btn" data-dismiss="modal" style="font-size: 13px; padding: 4px 10px;">Close</button>
	</div>
   </div>
  </div>
</div>


<!-- Registration steps modal -->
<div id="registrationStepsInfo" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">REGISTRATION STEPS</h4>
		</div>
	<div class="modal-body">
		<ol type="1">
			<li><h5><b>Provider registers</b></h5> and members are then shown the <b>MEDICARE PRICING + 65% pricing</b>.If provider chooses, provide may select a hidden reserve discount, as a percentage above medicare.
				<p>Hidden Reserve Discount Choices</p>
				<ul>
					<li>Medicare pricing + 20%*Most common hidden reserve level</li>
					<li>Medicare pricing + 15%</li>
					<li>Medicare pricing + 10%</li>
					<li>Medicare pricing + 5%</li>
					<li>Medicare pricing + 0%</li>
				</ul>
			</li>

			<li><h5><b>Patient chooses</h5></b> encounter and reserves the price and procedure.</li>  

			<li><h5><b>Patient receives</b></h5> provider contact information so visit can be scheduled w/Provider.</li>

			<li><h5><b>Patient pays provider</b></h5> directly at time of service or prior to procedure.
			* Discount is void If the patient fails to make pre-negotiated encounter price prior to time of service</li>
		</ol>


		<p>Any additional/alternate services performed at time of encounter are agreed at <b>Medicare + 65% pricing</b>. (No liability if within reasonable target range.)</p>

		<p>Your office will provide patient with __________ so services can be credited to the patients deductible. No precertification, no RAC, no hassle, just self-paying new patients for your practice.</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default dark-blue-btn" data-dismiss="modal" style="font-size: 13px; padding: 4px 10px;">Close</button>
	</div>
   </div>
  </div>
</div>



<style>
	.select2-container {width:88% !important;}
</style>

<script>
	var $=jQuery;
	// Hide all procedures and subspecialties
	function hideAllSubcategories() {

		$(".editfield.field_1950").hide();
		$(".editfield.field_1952").hide();
		$(".editfield.field_1954").hide();
		$(".editfield.field_1956").hide();
		$(".editfield.field_1960").hide();
		$(".editfield.field_1962").hide();
		$(".editfield.field_1966").hide();
		$(".editfield.field_1974").hide();
		$(".editfield.field_1982").hide();
		$(".editfield.field_1984").hide();
		$(".editfield.field_1986").hide();
		$(".editfield.field_1988").hide();
		$(".editfield.field_1990").hide();
		$(".editfield.field_1992").hide();
		$(".editfield.field_1994").hide();
		$(".editfield.field_1996").hide();
		$(".editfield.field_1998").hide();
		$(".editfield.field_2000").hide();
		$(".editfield.field_2002").hide();
		$(".editfield.field_2004").hide();
		$(".editfield.field_2006").hide();
		$(".editfield.field_2008").hide();
		$(".editfield.field_2010").hide();
		$(".editfield.field_2012").hide();
		$(".editfield.field_2014").hide();
		$(".editfield.field_2016").hide();
		$(".editfield.field_2018").hide();
		$(".editfield.field_2020").hide();
		$(".editfield.field_2022").hide();
		$(".editfield.field_2024").hide();
		$(".editfield.field_2026").hide();
		$(".editfield.field_2028").hide();
		$(".editfield.field_2030").hide();
		$(".editfield.field_2032").hide();
		$(".editfield.field_2034").hide();
		$(".editfield.field_2036").hide();
	}

		function showSubcategory( v ) {
			if (v=="Allergy and Immunology")						{$(".editfield.field_1950").show();}
			if (v=="Anesthesiology")						{$(".editfield.field_1952").show();}
			if (v=="Colon and Rectal Surgery")						{$(".editfield.field_1954").show();}
			if (v=="Dermatology")							{$(".editfield.field_1956").show();}
			if (v=="Ears, Nose Thr(ENT)")							{$(".editfield.field_2020").show();}
			if (v=="Emergency Medicine")							{$(".editfield.field_1960").show();}
			if (v=="Endocrinology")							{$(".editfield.field_2022").show();}
			if (v=="Family Medicine")							{$(".editfield.field_1962").show();}
			if (v=="Gastroenterology")							{$(".editfield.field_1966").show();}
			if (v=="General Surgery")							{$(".editfield.field_2024").show();}
			if (v=="Gynecology")							{$(".editfield.field_2026").show();}
			if (v=="Infectious Disease")							{$(".editfield.field_2028").show();}
			if (v=="Internal Medicine")							{$(".editfield.field_1974").show();}
			if (v=="Medical Genetics")							{$(".editfield.field_1982").show();}
			if (v=="Neurology")							{$(".editfield.field_1984").show();}
			if (v=="Nuclear Medicine")							{$(".editfield.field_1986").show();}
			if (v=="Obgyn")							{$(".editfield.field_1988").show();}
			if (v=="Obstetrics and Gynecology")							{$(".editfield.field_2030").show();}
			if (v=="Oncology")							{$(".editfield.field_1990").show();}
			if (v=="Ophthalmology")							{$(".editfield.field_1992").show();}
			if (v=="Orthopedic Surgery")							{$(".editfield.field_1994").show();}
			if (v=="Orthopedics")							{$(".editfield.field_2032").show();}
			if (v=="Otolaryngology")							{$(".editfield.field_1996").show();}
			if (v=="Pain Management")							{$(".editfield.field_2034").show();}
			if (v=="Pathology")							{$(".editfield.field_1998").show();}
			if (v=="Pediatrics")							{$(".editfield.field_2000").show();}
			if (v=="Physical Medicine")							{$(".editfield.field_2036").show();}
			if (v=="Physical Medicine and Rehab")							{$(".editfield.field_2002").show();}
			if (v=="Plastic Surgery")							{$(".editfield.field_2004").show();}
			if (v=="Preventative Medicine")							{$(".editfield.field_2006").show();}
			if (v=="Psychiatry")							{$(".editfield.field_2008").show();}
			if (v=="Pulmonary")							{$(".editfield.field_2010").show();}
			if (v=="Radiology")							{$(".editfield.field_2012").show();}
			if (v=="Surgery")							{$(".editfield.field_2014").show();}
			if (v=="Thoracic Surgery")							{$(".editfield.field_2016").show();}
			if (v=="Urology")							{$(".editfield.field_2018").show();}
	}


	$(document).ready(function() {
	
		$("select[name='field_2']").change(function() {
			hideAllSubcategories();
			showSubcategory( $(this).val() );		

		});
		
		
		hideAllSubcategories();
		showSubcategory( $("select[name='field_2']").val() );

		$("#field_1950, #field_1952, #field_1954, #field_1956, #field_2020, #field_1960, #field_2022, #field_1962, #field_1966, #field_2024, #field_2026, #field_2028, #field_1974, #field_1982, #field_1984, #field_1986, #field_1988, #field_2030, #field_1990, #field_1992, #field_1994, #field_2032, #field_1996, #field_2034, #field_1998, #field_2000, #field_2036, #field_2002, #field_2004, #field_2006, #field_2008, #field_2010, #field_2012, #field_2014, #field_2016, #field_2018").select2();
	});
</script>

<script>
	$('#profile-details-section').on('change', 'select', function (e) {
		sendAjax()
	});

	$("#field_2").click(function(){
		$("#profile-details-section option:selected").not("#field_1786 option:selected, #field_2 option:selected").removeAttr("selected");
	});

	function sendAjax() {
	  var mmaRemovePlus = $("#field_1786").val()
	  var mma = mmaRemovePlus.slice(1);
	  var selected = $("#field_1950\\[\\]").val() ||
	  				 $("#field_1952\\[\\]").val() ||
	  				 $("#field_1954\\[\\]").val() ||
	  				 $("#field_1956\\[\\]").val() ||
	  				 $("#field_2020\\[\\]").val() ||
	  				 $("#field_1960\\[\\]").val() ||
	  				 $("#field_2022\\[\\]").val() ||
	  				 $("#field_1962\\[\\]").val() ||
	  				 $("#field_1966\\[\\]").val() ||
	  				 $("#field_2024\\[\\]").val() ||
	  				 $("#field_2026\\[\\]").val() ||
	  				 $("#field_2028\\[\\]").val() ||
	  				 $("#field_1974\\[\\]").val() ||
	  				 $("#field_1982\\[\\]").val() ||
	  				 $("#field_1984\\[\\]").val() ||
	  				 $("#field_1986\\[\\]").val() ||
	  				 $("#field_1988\\[\\]").val() ||
	  				 $("#field_2030\\[\\]").val() ||
	  				 $("#field_1990\\[\\]").val() ||
	  				 $("#field_1992\\[\\]").val() ||
	  				 $("#field_1994\\[\\]").val() ||
	  				 $("#field_2032\\[\\]").val() ||
	  				 $("#field_1996\\[\\]").val() ||
	  				 $("#field_2034\\[\\]").val() ||
	  				 $("#field_1998\\[\\]").val() ||
	  				 $("#field_2000\\[\\]").val() ||
	  				 $("#field_2036\\[\\]").val() ||
	  				 $("#field_2002\\[\\]").val() ||
	  				 $("#field_2004\\[\\]").val() ||
	  				 $("#field_2006\\[\\]").val() ||
	  				 $("#field_2008\\[\\]").val() ||
	  				 $("#field_2010\\[\\]").val() ||
	  				 $("#field_2012\\[\\]").val() ||
	  				 $("#field_2014\\[\\]").val() ||
	  				 $("#field_2016\\[\\]").val() ||
	  				 $("#field_2018\\[\\]").val()
	  $.ajax({
	  type:"GET",
	  url: "http://healora.com/wp-content/themes/healora/buddypress/members/get-info.php",
	  data: { procedure: selected, mmaPrice: mma }
	  }).done(function(msg){
	  $("#ajax-response").html(msg);
	  });
	 }
</script>

<script>
$("div#doctor-button-registration-page").click(function() {
     $(".field_100, .field_101, .field_10249, .field_102, .field_1711, .field_1713, .field_1714, .field_1715, .field_1786, .field_2, .field_10718, .field_11130, .field_11135, .field_11139, .field_11533, .upload-profile-image-registration, .doctor-profile-information-title, .provider-registration-title").css("display", "block");
     $(".field_11565, .field_11566").css("display", "flex");

     $(".field_11120, .field_11127, .field_11128, .field_11129, #doctor-button-registration-page, .profile-information-title, .registration-profile-title, .field_10718").css("display", "none");

      $("div.editfield.field_11130.field_doctor-info.optional-field.visibility-public.alt.field_type_checkbox").addClass("doctors-extra-styling");

      $(".field_2").addClass("doctors-extra-specialty-styling");

      $(".field_1950, .field_1952, .field_1954, .field_1956, .field_2020, .field_1960, .field_2022, .field_1962, .field_1966, .field_2024, .field_2026, .field_2028, .field_1974, .field_1982, .field_1984, .field_1986, .field_1988, .field_2030, .field_1990, .field_1992, .field_1994, .field_2032, .field_1996, .field_2034, .field_1998, .field_2000, .field_2036, .field_2002, .field_2004, .field_2006, .field_2008, .field_2010, .field_2012, .field_2014, .field_2016, .field_2018").addClass("doctors-extra-procedures-styling");
    });
</script>
<!-- Custom END -->