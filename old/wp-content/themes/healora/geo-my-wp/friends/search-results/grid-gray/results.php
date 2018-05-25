<?php
/**
 * Members locator "grid-gray" search results template file.
 *
 * The information on this file will be displayed as the search results.
 *
 * The function pass 2 args for you to use:
 * $gmw    - the form being used ( array )
 * $member - each member in the loop
 *
 * You could but It is not recomemnded to edit this file directly as your changes will be overridden on the next update of the plugin.
 * Instead you can copy-paste this template ( the "grid-gray" folder contains this file and the "css" folder )
 * into the theme's or child theme's folder of your site and apply your changes from there.
 *
 * The template folder will need to be placed under:
 * your-theme's-or-child-theme's-folder/geo-my-wp/friends/search-results/
 *
 * Once the template folder is in the theme's folder you will be able to choose it when editing the Members locator form.
 * It will show in the "Search results" dropdown menu as "Custom: grid-gray".
 */
?>

<?php

$searchFormID = $gmw["ID"];

global $wpdb;
$currentCategory = $_GET['field_14552'];
$currentSpecialty = $_GET['specialty'];

// Get current procedure
$get_counter=0;
foreach($_GET as $key=>$value) {
	$get_counter++;
	if ($get_counter==2) {
		$currentProcedure  = $_GET[ $key ][0];
	}
}

$currentCategoryID = $wpdb->get_row("SELECT * FROM hea_bp_xprofile_fields WHERE name LIKE '".$currentCategory[0]."'", ARRAY_A);

$currentProcedoreData = $wpdb->get_row("SELECT * FROM hea_bp_xprofile_fields WHERE name = '".$currentProcedure."' AND parent_id = '".$currentCategoryID["id"]."'", ARRAY_A);

/*echo "SELECT * FROM hea_bp_xprofile_fields WHERE name LIKE '".$currentCategory[0]."'";
echo "<br>";
echo "<hr>";
echo "current category - ".$currentCategory[0]."<br>";
echo "current procedure - ".$currentProcedure."<br>";
echo "current category ID - ".$currentCategoryID["id"]."<br>";
echo "<br>";
echo "<hr>";


var_dump($currentCategoryID);*/

// Get current category image
//$currentCategoryImage = $wpdb->get_row("SELECT procedure_image FROM hea_bp_xprofile_fields WHERE id LIKE '".$currentProcedoreData["parent_id"]."'", ARRAY_A);
?>


<div class="search-results-container">

<?php if($searchFormID != "2") { ?>

	<div class="search-results-main-category">
		<?php if (!empty($currentSpecialty)) {
			if($currentSpecialty == "Dermatology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Dermatology-Blue.png";
			else if($currentSpecialty == "ENT") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/ENT-Blue.png";
			else if($currentSpecialty == "Gastroenterology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Gastroenterology-Blue.png";
			else if($currentSpecialty == "Urology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Urology-Blue.png";
			else if($currentSpecialty == "General Surgery") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/General-Surgery-Blue.png";
			else if($currentSpecialty == "Neurology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Neurology-Blue.png";
			else if($currentSpecialty == "OBGYN") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/OBGYN-Blue.png";
			else if($currentSpecialty == "Ophthalmology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Ophthalmology-Blue.png";
			else if($currentSpecialty == "Orthopedics") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Orthopedics-Blue.png";
			else if($currentSpecialty == "Pain Management") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Pain-Management-Blue.png";
			else if($currentSpecialty == "Plastic Surgery") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Plastic-Surgery-Blue.png";
			else if($currentSpecialty == "Podiatry") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Podiatry-Blue.png";
			else if($currentSpecialty == "Radiology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Radiology-Blue.png";
		?>
		<img src="<?php echo $specialtyIcon; ?>">
		<h1 class="search-results-current-category-title"><?php echo $currentSpecialty; ?></h1>
		<?php } else { ?>
		<img src="<?php echo $currentCategoryID['procedure_image']; ?>">
		<h1 class="search-results-current-category-title"><?php echo $currentCategory[0]; ?></h1>
		<?php } ?>
	</div>

<?php
if (empty($currentSpecialty)) {
	if ($currentProcedure != "1") { ?>
	<div class="procedure-info-container">

		<!-- Procedure title/sku/cpt -->
		<div class="row">
			<div class="col-md-6">
				<h3 class="search-results-current-procedure-title"><?php echo $currentProcedure; ?></h3>
			</div>
			<div class="col-md-6 text-right search-results-current-procedure-cpt-sku">
				<span>CPT: <?php echo $currentProcedoreData["cpt"]; ?></span>
				<span>SKU: <?php echo $currentProcedoreData["sku"]; ?></span>
			</div>
		</div>

		<!-- Procedure description -->
		<div class="row">
			<div class="col-md-12 search-results-description">
				<p><?php echo $currentProcedoreData["description"]; ?></p>
			</div>
		</div>

		<!-- Procedure prices -->
		<div class="row">
			<div class="col-md-12 search-results-procedure-prices text-right">
				<?php
				$procedureSavings = $currentProcedoreData["insurance_price"] - $currentProcedoreData["healora_price"];
				?>
				<span>Avg Insurance Price: $<?php echo $currentProcedoreData["insurance_price"]; ?></span><br>
				<span style="font-weight: 600; color: #fff;">Avg Healora Price: $<?php echo $currentProcedoreData["healora_price"]; ?></span><br>
				<span style="font-weight: 600;">Saving: $<?php echo $procedureSavings; ?></span>
			</div>
		</div>

	</div> <!-- .procedure-info-container -->
<?php } // if ($currentProcedure != "1")
} // (!empty($currentSpecialty))
} // if($searchFormID != "2"
?>

<?php if($searchFormID == "2") { ?>
<div style="text-align: center;">
	<a class="accent-color-inverse-button" href="https://healora.com/search-doctor/">SEARCH ANOTHER DOCTOR</a>
</div>
<?php }?>

</div> <!-- .search-results-container -->




<!-- When user came from specialty icons -->
<?php if (!empty($currentSpecialty)) { ?>
	<div class="choose-your-doctor">
		<h3 class="text-center"><?php echo $currentSpecialty; ?> Pick your procedure</h3>
	</div>


	<?php
	if($currentSpecialty == "Dermatology") $URLcategory = "Skin";
	else if($currentSpecialty == "ENT") $URLcategory = "Throat&amp;field_14552%5B1%5D=Ears&amp;field_14552%5B1%5D=Nose";
	else if($currentSpecialty == "Gastroenterology") $URLcategory = "Gastroenterology";
	else if($currentSpecialty == "Urology") $URLcategory = "Urology";
	else if($currentSpecialty == "General Surgery") $URLcategory = "General%20Surgery";
	else if($currentSpecialty == "Neurology") $URLcategory = "Neurology";
	else if($currentSpecialty == "OBGYN") $URLcategory = "Obgyn";
	else if($currentSpecialty == "Ophthalmology") $URLcategory = "Eye";
	else if($currentSpecialty == "Orthopedics") $URLcategory = "Ankle&amp;field_14552%5B1%5D=Elbow&amp;field_14552%5B2%5D=Foot%20%26%20Ankle&amp;field_14552%5B3%5D=Fractures&amp;field_14552%5B4%5D=Hip&amp;field_14552%5B5%5D=Knee&amp;field_14552%5B6%5D=Neck&amp;field_14552%5B7%5D=Shoulder&amp;field_14552%5B8%5D=Spine&amp;field_14552%5B9%5D=Wrist%20%26%20Hand";
	else if($currentSpecialty == "Pain Management") $URLcategory = "Pain%20Management";
	else if($currentSpecialty == "Plastic Surgery") $URLcategory = "Breast";
	else if($currentSpecialty == "Podiatry") $URLcategory = "Foot%20and%20Ankle";
	else if($currentSpecialty == "Radiology") $URLcategory = "Radiology";
	?>

	<?php
	$allCurrentSpecialtyProcedures = $wpdb->get_results("SELECT * FROM hea_bp_xprofile_fields WHERE specialty LIKE '".$currentSpecialty."'", OBJECT);


	foreach ($allCurrentSpecialtyProcedures as $singleProcedure) { ?>

		<div class="single-procedure-container">
			<h3><?php echo $singleProcedure->name; ?></h3>
			<a class="accent-color-button" style="padding: 4px 20px !important; font-size: 18px !important; height: 40px !important;" href="https://healora.com/geo-search/?field_14552%5B0%5D=<?php echo $singleProcedure->body_zone; ?>&field_<?php echo $singleProcedure->parent_id; ?>%5B0%5D=<?php echo $singleProcedure->name; ?>&gmw_form=1&gmw_per_page=20&action=gmw_post">SELECT</a>
		</div>

	<?php } ?>
<?php } else { ?>
<!-- When user came from specialty icons END -->




<!--  Main results wrapper -->
<div class="gmw-results-wrapper gmw-results-wrapper-<?php echo $gmw['ID']; ?> gmw-fl-grid-gray-results-wrapper">

	<div class="choose-your-doctor">
		<h3 class="text-center">Choose your doctor or provider</h3>
	</div>

	<?php do_action( 'gmw_search_results_start' , $gmw ); ?>

	<div class="results-count-wrapper">
		<p><?php bp_members_pagination_count(); ?><?php gmw_results_message( $gmw, false ); ?></p>
	</div>

	<div class="pagination-per-page-wrapper top">
		<!-- per page -->
		<?php gmw_per_page( $gmw, $gmw['total_results'], 'paged' ); ?>

		<!-- pagination -->
		<div class="pagination-wrapper">
			<?php gmw_pagination( $gmw, 'paged', $gmw['max_pages'] ); ?>
		</div>
	</div>

	 <!-- GEO my WP Map -->
    <?php
    if ( $gmw['search_results']['display_map'] == 'results' ) {
        gmw_results_map( $gmw );
    }
    ?>

    <?php do_action( 'gmw_search_results_before_loop' , $gmw ); ?>


    <div class="row">
    <ul class="members-list-wrapper col-md-12 col-xs-12">

    	<!-- members loop -->
    	<?php while ( bp_members() ) : bp_the_member(); ?>

    <!-- Custom - Show only user with "Doctor" role in search results -->
		<?php
		   $user_id = bp_get_member_user_id();
		   $user = new WP_User( $user_id );

		   if ( $user->roles[0] != 'subscriber' )
		   continue; ?>
		<!-- Show only user with "Doctor" role in search results END -->


    		<!-- do not remove this line -->
    		<?php $member = $members_template->member; ?>

	            <li class="single-member<?php echo $member->ID; ?>" style="width: 100%;">

	        		<!-- do not remove this line -->
                <?php do_action( 'gmw_search_results_loop_item_start', $gmw, $member ); ?>

				<div class="wrapper-inner">

					<div class="top-wrapper">

						<?php do_action( 'gmw_search_results_before_title', $gmw, $member); ?>

						<!-- <h2 class="user-name-wrapper">
	                		<span class="member-count"><?php echo $member->member_count; ?>)</span>
	                    	<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
	                    </h2> -->

	                    <span class="radius">
                    		<?php gmw_distance_to_location( $members_template->member, $gmw ); ?>
                    	</span>
	                </div>

	                <div class="user-info">

		                <?php do_action( 'gmw_search_results_before_avatar', $gmw, $member); ?>


										<!-- Doctor picture -->
		                <?php if ( isset( $gmw['search_results']['avatar']['use'] ) ) { ?>
		                    <div class="user-avatar">
		                        <a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar( array( 'type' => 'full', 'width' => $gmw['search_results']['avatar']['width'], 'height' => $gmw['search_results']['avatar']['height'] ) ); ?></a>
		                    </div>
		        				<?php } ?>


										<!-- Doctor first/last name, location -->
										<div class="doctor-address">
											<!-- <a href="<?php bp_member_permalink(); ?>">
												<?php echo xprofile_get_field_data('First Name', bp_get_member_user_id()); ?>
												<?php echo xprofile_get_field_data('Last Name', bp_get_member_user_id()); ?>
											</a> -->
											<span><?php echo xprofile_get_field_data('First Name', bp_get_member_user_id()); ?> <?php echo xprofile_get_field_data('Last Name', bp_get_member_user_id()); ?></span><br>
											<span><?php echo do_shortcode("[gmw_member_info info='state,country']");?></span><br>
											<span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php //echo do_shortcode('[gmw_member_info]');
											echo do_shortcode("[gmw_member_info info='street,city,zipcode']");?></span>
										</div>


										<!-- Doctor quote -->
										<div style="display: none;">
										<?php
										//$currentSearchResultsUrl = esc_url_raw("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
										//'searchResultsURL' => $currentSearchResultsUrl
										$buildURL = add_query_arg( array(
													'currentCategory' => $currentCategory[0],
													'currentProcedure' => $currentProcedure),
													bp_member_permalink() );
															

										$URLwhenComeFromDoctorsSearch = add_query_arg('doctor', 'true', bp_member_permalink()); ?>
										</div>

										<!-- Select doctor button -->
										<div class="select-doctor-wrapper">

											<div class="select-doctor-procedure-title">

											<?php if($searchFormID != "2") { ?>
											
												<?php if (!empty($currentSpecialty)) {
														if($currentSpecialty == "Dermatology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Dermatology-Blue.png";
														else if($currentSpecialty == "ENT") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/ENT-Blue.png";
														else if($currentSpecialty == "Gastroenterology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Gastroenterology-Blue.png";
														else if($currentSpecialty == "Urology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Urology-Blue.png";
														else if($currentSpecialty == "General Surgery") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/General-Surgery-Blue.png";
														else if($currentSpecialty == "Neurology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Neurology-Blue.png";
														else if($currentSpecialty == "OBGYN") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/OBGYN-Blue.png";
														else if($currentSpecialty == "Ophthalmology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Ophthalmology-Blue.png";
														else if($currentSpecialty == "Orthopedics") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Orthopedics-Blue.png";
														else if($currentSpecialty == "Pain Management") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Pain-Management-Blue.png";
														else if($currentSpecialty == "Plastic Surgery") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Plastic-Surgery-Blue.png";
														else if($currentSpecialty == "Podiatry") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Podiatry-Blue.png";
														else if($currentSpecialty == "Radiology") $specialtyIcon = "https://healora.com/wp-content/uploads/2017/11/Radiology-Blue.png";


													?>
												<span class="search-results-current-category-title"><?php echo $currentSpecialty; ?></span>
												<img src="<?php echo $specialtyIcon; ?>">
												<?php } else { ?>
												<span class="search-results-current-category-title"><?php echo $currentCategory[0]; ?></span>
												<img src="<?php echo $currentCategoryID['procedure_image']; ?>">
												<?php } ?>

												<?php } //if($searchFormID != "2") ?>
											</div>
											<?php
											if($searchFormID != "2") {
												if(is_user_logged_in()) { ?>
														<a class="accent-color-button" style="padding: 4px 20px; font-size: 22px;" href="<?php bp_member_permalink(); ?><?php echo $buildURL; ?>">SELECT</a>
														<?php } else { ?>
														<a class="accent-color-button" style="padding: 4px 20px; font-size: 22px;" data-toggle="modal" data-target="#registerModal">SELECT</a>


											<!-- Registration modal -->
											<!-- <script>
												$(document).ready(function(){
													$(".register-with-us-button").click(function(){
														$(".homepage-registration-form-container, .homepage-registration-form").show();
														$(".register-withus-form, .homepage-login-form").hide();
													});

													$(".homepage-registration-form-have-account").click(function(){
														$(".homepage-registration-form").hide();
														$(".homepage-login-form").show();
													});

													$(".homepage-registration-form-new-to-healora").click(function(){
														$(".homepage-registration-form").show();
														$(".homepage-login-form").hide();
													});
												});
											</script> -->

								 			<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
								 			  <div class="modal-dialog" role="document">
								 			    <div class="modal-content">

								 			      <div class="modal-body">

								 			      	<div class="register-withus-form">
								 				        <p>To see specific doctor prices</p>
	
			<a class="homepage-find-your-doctor-button register-with-us-button accent-color-button" href="/register/" style="margin-bottom: 15px;">REGISTER WITH US</a>
														<a class="homepage-find-your-doctor-button register-with-us-button accent-color-button" href="/login/">Got already an account?</a>
								 				        <p>Don't worry, it is only your email!</p>
								 			        </div>

								 			        <div class="homepage-registration-form-container">
								 			       		<p>Register with us</p>
								 			       		<p>Save up to 70% on Healthcare Procedures</p>

								 			       		<div class="homepage-registration-form">
								 				          	<?php echo do_shortcode("[RM_Form id='4']"); ?>
								 				          	<p class="homepage-registration-form-have-account">Have an account?</p>
								 				        </div>


								 				        <div class="homepage-login-form">
								 				          	<?php echo do_shortcode("[RM_Login]"); ?>
								 				          	<p class="homepage-registration-form-new-to-healora">New to Healora?</p>
								 				        </div>
								 			        </div>

								 			      </div>  <!-- /.modal-body -->
								 			   <!--  </div> /.modal-content -->
								 			  <!-- </div> /.modal-dialog -->
								 			<!-- </div> /.modal -->
								 		<?php }

								 		} else { // if($searchFormID != "2") ?>
								 			<a class="accent-color-button" style="padding: 4px 20px; font-size: 22px;" href="<?php bp_member_permalink(); ?><?php echo $URLwhenComeFromDoctorsSearch; ?>">SELECT</a>
								 		 <?php } ?>
										<!-- Registration modal container END -->

							</div> <!-- /.select-doctor-wrapper -->




	                    <span class="activity">
	                    	<?php bp_member_last_active(); ?>
	                    </span>

		        		<?php do_action( 'bp_directory_members_actions' ); ?>

		                <?php if ( bp_get_member_latest_update() ) : ?>
		                	<div class="update"><?php bp_member_latest_update(); ?></div>
		        		<?php endif; ?>

	               		<?php do_action( 'bp_directory_members_item' ); ?>

					</div>

					<div class="bottom-wrapper">

						<?php do_action( 'gmw_search_results_before_get_directions', $gmw, $member); ?>

						<!-- Get directions -->
		   				<?php if ( isset( $gmw['search_results']['get_directions'] ) ) { ?>
			    			<i class="get-directions-icon fa fa-map-marker"></i>
		    				<?php gmw_directions_link( $members_template->member, $gmw, $members_template->member->address ); ?>

			    		<?php } else { ?>
			    			<div class="address-wrapper">
			                    <?php gmw_location_address( $members_template->member, $gmw ); ?>
			    			</div>
		    		  	<?php  } ?>

						 <!--  Driving Distance -->
						<?php if ( isset( $gmw['search_results']['by_driving'] ) ) { ?>
		    				<?php gmw_driving_distance( $member, $gmw, false ); ?>
		    			<?php } ?>

		    		</div>

				</div>

	        	<?php do_action( 'gmw_search_results_loop_item_end', $gmw, $member ); ?>

			</li>

    	<?php endwhile; ?>

    </ul>
	</div>


	<?php do_action( 'gmw_search_results_before_loop' , $gmw ); ?>

    <?php do_action( 'bp_after_directory_members_list' ); ?>

    <?php bp_member_hidden_fields(); ?>


	<div class="pagination-per-page-wrapper bottom">
		<?php gmw_per_page( $gmw, $gmw['total_results'], 'paged' ); ?>
		<div class="pagination-wrapper">
			<?php gmw_pagination( $gmw, 'paged', $gmw['max_pages'] ); ?>
		</div>
	</div>
</div>
<?php } // if (!empty($currentSpecialty)) ?>
