<?php
/**
 * BuddyPress - Members Profile Loop
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_before_profile_loop_content' ); ?>


<?php
global $wpdb;
$currentCategory = get_query_var('currentCategory');
$currentProcedure = get_query_var('currentProcedure');
$cameFromDoctorsSearch = get_query_var('doctor');

$currentCategoryID = $wpdb->get_row("SELECT * FROM hea_bp_xprofile_fields WHERE name LIKE '".$currentCategory."'", ARRAY_A);

$currentProcedureData = $wpdb->get_row("SELECT * FROM hea_bp_xprofile_fields WHERE name LIKE '".$currentProcedure ."' AND parent_id = '".$currentCategoryID["id"]."'", ARRAY_A);

// Get current category image
$currentCategoryImage = $wpdb->get_row("SELECT procedure_image FROM hea_bp_xprofile_fields WHERE id LIKE '".$currentProcedureData["parent_id"]."'", ARRAY_A);

$currentCategoryImageURL = $currentCategoryImage["procedure_image"];
?>

<style>
	section.medicom-waypoint>div.caption {
    display: none;
}
</style>


<?php if($cameFromDoctorsSearch != "true") { ?>
<div class="search-results-container">
	<div class="search-results-main-category">
		<img src="<?php echo $currentCategoryImageURL; ?>">
		<h1 class="search-results-current-category-title"><?php echo $currentCategory; ?></h1>
	</div>
</div>
<?php } ?>


<?php if ( bp_has_profile() ) : ?>

	<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

		<?php if ( bp_profile_group_has_fields() ) : ?>

			<?php

			/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
			do_action( 'bp_before_profile_field_content' ); ?>

			<div class="bp-widget <?php bp_the_profile_group_slug(); ?>">

				<h2><?php bp_the_profile_group_name(); ?></h2>

				<table class="profile-fields">

					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

						<?php if ( bp_field_has_data() ) : ?>

							<tr<?php bp_field_css_class(); ?>>

								<td class="label"><?php bp_the_profile_field_name(); ?></td>

								<td class="data"><?php bp_the_profile_field_value(); ?></td>

							</tr>

						<?php endif; ?>

						<?php

						/**
						 * Fires after the display of a field table row for profile data.
						 *
						 * @since 1.1.0
						 */
						do_action( 'bp_profile_field_item' ); ?>

					<?php endwhile; ?>

				</table>
			</div>

			<?php

			/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
			do_action( 'bp_after_profile_field_content' ); ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
	do_action( 'bp_profile_field_buttons' ); ?>

<?php endif; ?>


<div class="col-md-12 col-sm-12 col-xs-12 doctor-first-last-name-single-profile clearfix">
	<div class="row">

		<!-- Doctor name -->
		<div class="col-md-12 doctor-profile-name-wrapper">

			<!-- Doctor picture -->
			<div class="user-avatar">
					<?php bp_displayed_user_avatar( 'type=full&height=135&width=135' ); ?>
			</div>


			<!-- Doctor first/last name, location -->
			<div class="doctor-address">
				<!-- <a href="<?php bp_member_permalink(); ?>">
					<?php echo xprofile_get_field_data('First Name', bp_get_member_user_id()); ?>
					<?php echo xprofile_get_field_data('Last Name', bp_get_member_user_id()); ?>
				</a> -->
				<span><?php echo xprofile_get_field_data('First Name', bp_get_member_user_id()); ?> <?php echo xprofile_get_field_data('Last Name', bp_get_member_user_id()); ?></span><br>
				<span><?php echo do_shortcode("[gmw_member_info info='state,country']");?></span><br>
				<span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo do_shortcode("[gmw_member_info info='street,city,zipcode']");?></span>
			</div>

			<!-- Select doctor button -->
			<div class="select-doctor-wrapper">
				<?php if($cameFromDoctorsSearch != "true") { ?>
				<div class="select-doctor-procedure-title">
					<span class="search-results-current-category-title"><?php echo $currentCategory; ?></span>
					<img src="<?php echo $currentCategoryImageURL; ?>">
				</div>
				<?php } ?>
		</div>

	</div>
<!-- Doctor name END -->


		<!-- Procedure details -->
		<?php if($cameFromDoctorsSearch != "true") { ?>
		<div class="col-md-12 doctor-profile-procedure-details-wrapper">
			<div class="doctor-profile-procedure-details text-left">
				<h3 class="search-results-current-procedure-title"><?php echo $currentProcedure; ?></h3>
				<span>CPT: <?php echo $currentProcedureData["cpt"]; ?></span>
				<span>SKU: <?php echo $currentProcedureData["sku"]; ?></span>
			</div>
			<div class="doctor-profile-procedure-details text-right">
				<span class="doctor-profile-procedure-price">$<?php echo $currentProcedureData["healora_price"]; ?></span>
				<a class="accent-color-button" data-toggle="modal" data-target="#reservePrice">RESERVE THE PRICE</a>
			</div>

			<?php $reservationFee = $currentProcedureData["healora_price"] - $currentProcedureData["provider_price"]; ?>

			<!-- Modal -->
			<div id="reservePrice" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-lg">

			    <!-- Modal content-->
			    <div class="modal-content">
				      <div class="modal-body reserve-price-wrapper">
					        <h3><?php echo $currentProcedureData["name"]; ?></h3>
					        <span>CPT: <?php echo $currentProcedureData["cpt"]; ?> - SKU: <?php echo $currentProcedureData["sku"]; ?></span>
					        <p class="reserve-price-doctor-name">with <?php echo xprofile_get_field_data('First Name', bp_get_member_user_id()); ?> <?php echo xprofile_get_field_data('Last Name', bp_get_member_user_id()); ?></p>
					        <h3>Reserve your price now!</h3>
									<div class="reserve-price-total">
										<div class="reserve-price-total-prices">
						        	<span>DUE NOW: Reservation fee</span><span>$<?php echo $reservationFee; ?></span>
										</div>
										<div class="reserve-price-total-prices">
						        	<span>Amount due at visit:</span><span>$<?php echo $currentProcedureData["provider_price"]; ?></span>
										</div>
										<div class="reserve-price-total-prices">
						        	<span>Total price:</span><span>$<?php echo $currentProcedureData["healora_price"]; ?></span>
										</div>
									</div>

									<?php
									$currentLoggedUserID = bp_loggedin_user_id();
									$displayedDoctorID = bp_displayed_user_id();
									$couponCode = do_shortcode('[randomcode]');
									
									echo do_shortcode('[easy_payment item_name="PATIENT ID:'.$currentLoggedUserID.', DOCTOR ID:'.$displayedDoctorID.', SKU:'.$currentProcedureData["sku"].', COUPON CODE:'.$couponCode.'END" amount="'.$reservationFee.'"]'); ?>
				      </div>
			    </div>

			  </div>
			</div>
			<!-- Modal END -->


		</div>
		<?php } ?>
		<!-- Procedure details END -->


		<?php if($cameFromDoctorsSearch == "true") { ?>
		<!-- All doctor procedures -->
		<div class="col-md-12 doctor-procedures-wrapper">
		<h3>Procedures</h3>

		<?php $specialtyProcedures = xprofile_get_field_data('Skin', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Throat', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Ears', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Nose', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('General Surgery', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Gastroenterology', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Neurology', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Obgyn', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Eye', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Spine', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Shoulder', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Elbow', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Wrist/Hand', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Fractures', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Knee', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Foot', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Foot & Ankle', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Hip', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Neck', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Pain Management', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Breast', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Radiology', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>


		<?php $specialtyProcedures = xprofile_get_field_data('Urology', bp_displayed_user_id(), $format = 'array');
			  foreach ($specialtyProcedures as $procedure) {
			    echo "<p>".$procedure."</p>";
		} ?>
		</div>
		<!-- All doctor procedures END -->
		<?php } ?>


		<!-- Doctors location -->
		<div class="col-md-12 doctor-profile-location-wrapper">
			<h3>Location</h3>
			<?php echo do_shortcode('[gmw_single_location item_type="member" item_id="'.bp_displayed_user_id().'" elements="map" map_width="100%" map_height="450px" map_type="ROADMAP"]'); ?>
		</div>
		<!-- Doctors location END -->


		<!-- Other doctor procedures -->
		<div class="col-md-12 text-center doctor-profile-see-more-providers">
			<?php $searchResultsURL = $_SERVER['HTTP_REFERER']; ?>
			<a class="accent-color-inverse-button" href="<?php echo $searchResultsURL; ?>">SEE MORE PROVIDERS</a>
		</div>
		<!-- Other doctor procedures END -->



	<!-- <div class="doctor-profile-info-wrapper">
		<div>
			<a href="<?php bp_displayed_user_link(); ?>">
				<?php bp_displayed_user_avatar( 'type=full&height=135&width=135' ); ?>
			</a>
		</div>
	</div> -->

	<!-- <div class="doctor-profile-info-wrapper">
		<h2><?php echo xprofile_get_field_data('First Name', bp_get_member_user_id()); ?> <?php echo xprofile_get_field_data('Last Name', bp_get_member_user_id()); ?></h2>

		<div class="additional-doctor-info">
			<span class="doctor-specialty">
				<?php echo xprofile_get_field_data('Specialty', bp_get_member_user_id(), $multi_format = 'comma'); ?>
			</span>
			<br>
		</div>

		<br>

		<div class="doctor-address">
		<i class="fa fa-map-marker fa-2x" aria-hidden="true"></i><?php echo do_shortcode('[gmw_member_info]'); ?>
	</div> -->

	<?php /*
			$procedures['Allergy and Immunology'] = xprofile_get_field_data('Allergy and Immunology', bp_get_member_user_id());
			$procedures['Anesthesiology'] = xprofile_get_field_data('Anesthesiology', bp_get_member_user_id());
			$procedures['Colon and Rectal Surgery'] = xprofile_get_field_data('Colon and Rectal Surgery', bp_get_member_user_id());
			$procedures['Dermatology'] = xprofile_get_field_data('Dermatology', bp_get_member_user_id());
			$procedures['Emergency Medicine'] = xprofile_get_field_data('Emergency Medicine', bp_get_member_user_id());
			$procedures['Family Medicine'] = xprofile_get_field_data('Family Medicine', bp_get_member_user_id());
			$procedures['Gastroenterology'] = xprofile_get_field_data('Gastroenterology', bp_get_member_user_id());
			$procedures['Internal Medicine'] = xprofile_get_field_data('Internal Medicine', bp_get_member_user_id());
			$procedures['Medical Genetics'] = xprofile_get_field_data('Medical Genetics', bp_get_member_user_id());
			$procedures['Neurology'] = xprofile_get_field_data('Neurology', bp_get_member_user_id());
			$procedures['Nuclear Medicine'] = xprofile_get_field_data('Nuclear Medicine', bp_get_member_user_id());
			$procedures['Obgyn'] = xprofile_get_field_data('Obgyn', bp_get_member_user_id());
			$procedures['Oncology'] = xprofile_get_field_data('Oncology', bp_get_member_user_id());
			$procedures['Ophthalmology'] = xprofile_get_field_data('Ophthalmology', bp_get_member_user_id());
			$procedures['Orthopedic Surgery'] = xprofile_get_field_data('Orthopedic Surgery', bp_get_member_user_id());
			$procedures['Otolaryngology'] = xprofile_get_field_data('Otolaryngology', bp_get_member_user_id());
			$procedures['Pathology'] = xprofile_get_field_data('Pathology', bp_get_member_user_id());
			$procedures['Pediatrics'] = xprofile_get_field_data('Pediatrics', bp_get_member_user_id());
			$procedures['Physical Medicine and Rehab'] = xprofile_get_field_data('Physical Medicine and Rehab', bp_get_member_user_id());
			$procedures['Plastic Surgery'] = xprofile_get_field_data('Plastic Surgery', bp_get_member_user_id());
			$procedures['Preventative Medicine'] = xprofile_get_field_data('Preventative Medicine', bp_get_member_user_id());
			$procedures['Psychiatry'] = xprofile_get_field_data('Psychiatry', bp_get_member_user_id());
			$procedures['Pulmonary'] = xprofile_get_field_data('Pulmonary', bp_get_member_user_id());
			$procedures['Radiology'] = xprofile_get_field_data('Radiology', bp_get_member_user_id());
			$procedures['Surgery'] = xprofile_get_field_data('Surgery', bp_get_member_user_id());
			$procedures['Thoracic Surgery'] = xprofile_get_field_data('Thoracic Surgery', bp_get_member_user_id());
			$procedures['Urology'] = xprofile_get_field_data('Urology', bp_get_member_user_id());
		?>

			<?php foreach($procedures as $key=>$value) {
				if ($value != '') {
					foreach ($value as $v) {
						$where1.="name LIKE '%$v%' OR";
					}
				}
			}

			global $wpdb;
			$proceduresInfo = $wpdb->get_results("SELECT * FROM hea_bp_xprofile_fields WHERE $where1 1=0", ARRAY_A); */ ?>

		<!-- </div>
		<div class="about-physisian-section">
			<?php $aboutDoctor = xprofile_get_field_data('About', bp_get_member_user_id());
				if ($aboutDoctor !== '') { ?>
					<h3>About physisian</h3>
					<p><?php echo xprofile_get_field_data('About', bp_get_member_user_id()); ?></p>
			<?php } ?>
		</div>
		</div>
	</div> -->


<!-- <div class="col-md-7 col-sm-12 col-xs-12 doctor-profile-info-wrapper">
	<div class="procedures-table doctor-profile-procedures-table">
		<div class="table-head">
			<div class="procedures-table-services">PROCEDURES</div>
			<div class="procedures-table-regional">REGIONAL</div>
			<div class="procedures-table-healora">
				<?php if(!is_user_logged_in()) { ?>
					HEALORA AVG
				<?php } ?>
				<?php if(is_user_logged_in()) { ?>
					HEALORA
				<?php } ?>
			</div>
			<div class="procedures-table-claim">REQUEST</div>
		</div>
		<div class="table-body">

		<!-- Show bundle services on the top of the table -->
		<?php
		/*global $wpdb;
		$displayedDoctorID = bp_displayed_user_id();

		$doctorOffersBundles = $wpdb->get_results("SELECT * FROM hea_bundles_doctors WHERE Doctor_ID = $displayedDoctorID");

		foreach ($doctorOffersBundles as $doctorOffersBundle) {

			$bundlesTitles  = $wpdb->get_results("SELECT * FROM hea_bundles WHERE CPT_ID LIKE '".$doctorOffersBundle->Bundle_ID."' AND Category LIKE '".$currentCategory."' ORDER BY CPT_ID asc");

			foreach ($bundlesTitles as $singleBundle) { ?>

			<div class="table-content">
				<div class="procedures-table-service-name"><span class="bundled-services-title"><b><?php echo $singleBundle->CPT; ?> - <?php echo $singleBundle->Title; ?></b></span></div>
				<div class="procedures-table-initial-price"><?php echo '$'.number_format($singleBundle->Regional_price, 2); ?></div>
				<div class="procedures-table-healora-price"><?php echo '$'.number_format($singleBundle->Healora_price, 2); ?></div>
				<div class="procedures-table-claim"><button type="button" id="<?php echo $ProcedureID; ?>" class="btn btn-info btn-lg dark-blue-btn modal-window-button" data-toggle="modal" data-target="#bundle<?php echo $singleBundle->ID; ?>">Select</button></div>
			</div>

				<!-- MODAL-->
				<div class="modal fade" id="bundle<?php echo $singleBundle->ID; ?>" role="dialog">
					    <div class="modal-dialog">

					      <!-- Modal content-->
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					            <?php if(!is_user_logged_in()) { ?>
						          	<div class="registration-note-modal">
					                      <p><b>Doctors could jeopardize their current contracts if they advertise publicly.</b><br>
					                      <b>Please REGISTER and create password so you can be a Member and see pricing from Doctors.</b></p>
	                      			</div>
						    	<?php } ?>

					          	<?php if(is_user_logged_in()) { ?>
					          		<h4 class="modal-title">ADDITIONAL SAVINGS</h4>
					          	<?php } ?>
					        </div>

					        <div class="modal-body">
						        <?php if(is_user_logged_in()) {
									$couponCode = do_shortcode('[randomcode]'); ?>

						       		<div class="coupon-code-modal">
						       			<h4 style="font-weight: 600;"><?php echo $singleBundle->Title; ?></h4>
						       			<span>Bundle code - <?php echo $singleBundle->CPT; ?></span>
							        	<h4><span>Coupon number:</span><br>
							        	<?php echo $couponCode; ?></h4>
							        	<p class="pay-to-activate">Pay reservation to book procedure now.</p>
						        	</div>

						        	<?php
						        	$bundleReservationFee = $singleBundle->Healora_price - $singleBundle->Doctor_amount;
						        	?>
						        	<div class="procedures-table-modal">
									    <div>
										    <span class="procedures-table-modal-align-left">Amount Due At Visit:</span>
										    <span class="procedures-table-modal-align-right">$<?php echo number_format($singleBundle->Doctor_amount, 2); ?></span>
									    </div>
									    <div style="border-top: 1px solid #e5e5e5;">
										    <span class="procedures-table-modal-align-left">Reservation Fee Now:</span>
										    <span class="procedures-table-modal-align-right">$<?php echo number_format($bundleReservationFee, 2); ?></span>
									    </div>
									    <div style="border-top: 1px solid #e5e5e5;">
										    <span class="procedures-table-modal-align-left"><b>TOTAL PRICE:</b></span>
										    <span class="procedures-table-modal-align-right">$<?php echo number_format($singleBundle->Healora_price, 2); ?></span>
									    </div>
									</div>
									<br>

									<?php
									$patientFirstName = xprofile_get_field_data('First Name', bp_loggedin_user_id());
									$patientLastName = xprofile_get_field_data('Last Name', bp_loggedin_user_id());
									$patientPhone = xprofile_get_field_data('Phone', bp_loggedin_user_id());
									$doctorFirstName = xprofile_get_field_data('First Name', bp_get_member_user_id());
									$doctorLastName = xprofile_get_field_data('Last Name', bp_get_member_user_id());
									$doctorOfficePhone = xprofile_get_field_data('Office Phone', bp_get_member_user_id());
									$doctorOfficeEmail = xprofile_get_field_data('Office Email', bp_get_member_user_id());
									$doctorOfficeCity = xprofile_get_field_data('Office Address / City', bp_get_member_user_id());
									?>

						        	<?php echo do_shortcode('[easy_payment item_name="PATIENT NAME: '.$patientFirstName.' '. $patientLastName.'PATIENT PHONE '.$patientPhone.'PROVIDER INFO: '.$doctorFirstName.' '.$doctorLastName.'PROCEDURE DESCRIPTION: '.$singleBundle->Title.' ('.$singleBundle->CPT.')COUPON CODE: '.$couponCode.'TOTAL PRICE: $'.number_format($singleBundle->Healora_price, 2).'BALANCE DUE AT VISIT: $'.number_format($singleBundle->Doctor_amount, 2).'FEE PAID: $'.number_format($bundleReservationFee, 2).'DOCTOR OFFICE PHONE'.$doctorOfficePhone.'DOCTOR OFFICE EMAIL'.$doctorOfficeEmail.'DOCTOR OFFICE CITY'.$doctorOfficeCity.' PAYMENT INFO END" amount="'.number_format($bundleReservationFee, 2).'"]'); ?>
						        <?php } ?>


						        <?php if(!is_user_logged_in()) { ?>
						        	<div class="modal-login-form modal-login-form-doctor-profile">
				                      	<p class="modal-login-form-existing-user">Existing Users</p>
				                      	<div class="modal-login-form-wrapper">
				                        	<?php wp_login_form(); ?>
				                        </div>
				                    </div>

				                    <div class="modal-registration-form modal-registration-form-doctor-profile">
				                      	<p style="color: #fff;">New User?</p>
				                        <?php echo do_shortcode("[rp_register_widget]"); ?>
				                    </div>
						        <?php } ?>
					        </div>

					        <?php if(!is_user_logged_in()) { ?>
						        <div class="modal-footer"></div>
						    <?php } ?>
					    </div>
					</div>
				</div> <!-- /Modal END -->

			<?php } ?> <!-- END foreach $bundlesTitles -->

		<?php } */ ?> <!-- END $doctorOffersBundles -->


		<!-- Show bundle services on the top of the table END -->



			<?php /*foreach ($ProcedureList as $value) {

				// Procedure ID
				$ProcedureID = $value["id"];

				// MMA PRICE
				$MMAprice = $value["price"];

				// Count Healora price
				$ShowHealoraPrice = $MMAprice * 1.65;

				// Regional price
				$RegionalPrice = $MMAprice * 3.5;

				// Save 10%
				$Save10PercentPriceCount = $ShowHealoraPrice * 0.1;
				$Save10PercentPrice = $ShowHealoraPrice - $Save10PercentPriceCount;

				// What doctor is taking, depending from selected "Medicare Pricing + (Lowest acceptable)" in registration page
				$SelectedMedicarePricing = xprofile_get_field_data('Medicare Pricing + (Lowest acceptable)', bp_get_member_user_id());

				// Remove + from the beginning of number
				$SelectedMedicarePricing = ltrim($SelectedMedicarePricing, '+');

				$SelectedMedicarePricingPercent = $SelectedMedicarePricing / 100;
				$SelectedMedicarePricingFinal = 1 + $SelectedMedicarePricingPercent;
				$DoctorFee = $MMAprice * $SelectedMedicarePricingFinal;

				// Registration fee for Healora
				$DoctorFeeWith20Percent = $MMAprice * 1.2; // Always take 20%;
				$RegistrationFeeForHealora = $Save10PercentPrice - $DoctorFeeWith20Percent;

				// Total price for procedure
				$TotalPriceForProcedure = $DoctorFee + $RegistrationFeeForHealora;

				// Doctor first and last name
				$doctorFirstName = xprofile_get_field_data('First Name', bp_get_member_user_id());
				$doctorLastName = xprofile_get_field_data('Last Name', bp_get_member_user_id());
			?>
			<div class="table-content">
				<div class="procedures-table-service-name"><?php echo $value["name"]; ?></div>
				<div class="procedures-table-initial-price">$<?php echo number_format($RegionalPrice, 2); ?></div>
				<div class="procedures-table-healora-price"><?php echo "$".number_format($ShowHealoraPrice, 2); ?></div>
				<div class="procedures-table-claim"><button type="button" id="<?php echo $ProcedureID; ?>" class="btn btn-info btn-lg dark-blue-btn modal-window-button" data-toggle="modal" data-target="#AdditionalSavingsModal<?php echo $ProcedureID; ?>">Pricing</button></div>


				<!-- Additional Savings modal -->
				  <div class="modal fade" id="AdditionalSavingsModal<?php echo $ProcedureID; ?>" role="dialog">
				    <div class="modal-dialog">

				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				            <?php if(!is_user_logged_in()) { ?>
				          		<h4 class="modal-title-registration"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> REGISTRATION FORM</h4>
					          	<h4 class="modal-title-login"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> LOGIN FORM</h4>
					    	<?php } ?>

				          	<?php if(is_user_logged_in()) { ?>
				          		<h4 class="modal-title">ADDITIONAL SAVINGS</h4>
				          	<?php } ?>
				        </div>

				        <div class="modal-body">
					        <?php if(is_user_logged_in()) {
								$couponCode = do_shortcode('[randomcode]'); ?>

					       		<div class="coupon-code-modal">
					       			<h4 style="font-weight: 600;"><?php echo $value["name"]; ?></h4>
						        	<h4><span>Coupon number:</span><br>
						        	<?php echo $couponCode; ?></h4>
						        	<p class="pay-to-activate">Pay reservation to book procedure now.</p>
					        	</div>


					        	<div class="procedures-table-modal">
								    <div>
									    <span class="procedures-table-modal-align-left">Amount Due At Visit:</span>
									    <span class="procedures-table-modal-align-right">$<?php echo number_format($DoctorFee, 2); ?></span>
								    </div>
								    <div style="border-top: 1px solid #e5e5e5;">
									    <span class="procedures-table-modal-align-left">Reservation Fee Now:</span>
									    <span class="procedures-table-modal-align-right">$<?php echo number_format($RegistrationFeeForHealora, 2); ?></span>
								    </div>
								    <div style="border-top: 1px solid #e5e5e5;">
									    <span class="procedures-table-modal-align-left"><b>TOTAL PRICE:</b></span>
									    <span class="procedures-table-modal-align-right">$<?php echo number_format($TotalPriceForProcedure, 2); ?></span>
								    </div>
								</div>
								<br>


								<?php
								$patientFirstName = xprofile_get_field_data('First Name', bp_loggedin_user_id());
								$patientLastName = xprofile_get_field_data('Last Name', bp_loggedin_user_id());
								$patientPhone = xprofile_get_field_data('Phone', bp_loggedin_user_id());
								$doctorOfficePhone = xprofile_get_field_data('Office Phone', bp_get_member_user_id());
								$doctorOfficeEmail = xprofile_get_field_data('Office Email', bp_get_member_user_id());
								$doctorOfficeCity = xprofile_get_field_data('Office Address / City', bp_get_member_user_id());
								?>

					        	<?php echo do_shortcode('[easy_payment item_name="PATIENT NAME: '.$patientFirstName.' '. $patientLastName.'PATIENT PHONE '.$patientPhone.'PROVIDER INFO: '.$doctorFirstName.' '.$doctorLastName.'PROCEDURE DESCRIPTION: '.$value["name"].'COUPON CODE: '.$couponCode.'TOTAL PRICE: $'.number_format($TotalPriceForProcedure, 2).'BALANCE DUE AT VISIT: $'.number_format($DoctorFee, 2).'FEE PAID: $'.number_format($RegistrationFeeForHealora, 2).'DOCTOR OFFICE PHONE'.$doctorOfficePhone.'DOCTOR OFFICE EMAIL'.$doctorOfficeEmail.'DOCTOR OFFICE CITY'.$doctorOfficeCity.' PAYMENT INFO END" amount="'.number_format($RegistrationFeeForHealora, 2).'"]'); ?>
					        <?php } ?>


					        <?php if(!is_user_logged_in()) { ?>
					        	<div class="registration-note-modal">
					        		<p><b>Doctors could jeopardize their current contracts if they advertise publicly.</b></p>
	                        		<p><b>Please REGISTER and create password so you can be a Member and see pricing from Doctors.</b></p>
 								</div>

						        <div class="modal-registration-form">
						        	<?php echo do_shortcode("[rp_register_widget]"); ?>
						        </div>

						        <div class="modal-login-form">
							        	<?php wp_login_form(); ?>
							    </div>
					        <?php } ?>
				        </div>

				        <?php if(!is_user_logged_in()) { ?>
					        <div class="modal-footer">
						    	<button type="button" class="btn btn-info btn-lg dark-blue-btn pull-right login-button">Sign in</button>
						    	<button type="button" class="btn btn-info btn-lg dark-blue-btn pull-right register-button">Register</button>
						    </div>
					    <?php } ?>
				      </div>
				    </div>
				  </div> <!-- Modal END -->
				</div>

				<!-- Depending from selected procedure, highlight it in list -->
					<script>
						var $ = jQuery;

						$(".modal-window-button").click(function() {
							var procedureID = $(this).prop('id');
							$(".doctor-procedure-box").not("#"+procedureID).css("background-color", "#36454f");
						});

						// If clicked on modal X, make all procedures blue
						$(".modal-dialog, .modal-header>.close").click(function(){
							$(".doctor-procedure-box").css("background-color", "#00aeef");
						});

						// If clicked outside modal, make all procedures blue
						$(document).mouseup(function (e){
							var container = $(".modal-window-content");
					        if (!container.is(e.target)
					           && container.has(e.target).length === 0)
					        {
					            $(".doctor-procedure-box").css("background-color", "#00aeef");
					        }
				   		});
					</script>


			<?php } */ ?>
		</div> <!-- /table body -->
	</div> <!-- /table -->
</div>

<?php
echo "<style>
.modal-login-form-wrapper p.login-username input#user_login, .modal-login-form-wrapper p.login-username input#user_pass, .reg-form-group > input[type=password] {
	width: 49% !important;
	float: left;
}

.modal-login-form-wrapper p.login-username input#user_pass {
	margin-left: 2%;
	margin-top: 0px !important;
}

.modal-login-form-wrapper p.login-username input#user_login {
	padding: 4px;
}
</style>";
?>
<!-- Custom END -->

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_after_profile_loop_content' ); ?>
