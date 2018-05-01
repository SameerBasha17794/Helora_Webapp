<?php

/* ************************************************************ */
/* ******************** Some basic settings ******************* */
/* ************************************************************ */

/* Include main theme style.css file */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}


/* Add autocomplete */
function add_autocomplete() {

	wp_deregister_script('jquery');
	wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js');
	wp_enqueue_script('jquery');

	wp_enqueue_script('autocomplete-script', get_stylesheet_directory_uri() . '/js/autocomplete/dist/jquery-editable-select.min.js', array( 'jquery'));
 	wp_register_style('autocomplete_css', get_stylesheet_directory_uri() .'/js/autocomplete/dist/jquery-editable-select.min.css', array(), null, 'all' );
  	wp_enqueue_style('autocomplete_css');
}
add_action( 'wp_enqueue_scripts', 'add_autocomplete' );



/* Block access to wp-admin for all users, except administrators and editors */
/* Checking if user can delete post, because both roles can do it */
function restrict_admin(){
	if (!current_user_can('delete_others_posts') && (!wp_doing_ajax())) {
        wp_die( __('You are not allowed to access this part of the site'));
    }
}
add_action( 'admin_init', 'restrict_admin', 1 );



/* Hide Visual Composer tab from menu, but not from admin */
function custom_menu_page_removing() {
    remove_menu_page('vc-welcome');
}
add_action( 'admin_menu', 'custom_menu_page_removing' );



/* Hide WP update notices for all, except admin */
function hide_update_notice_to_all_but_admin_users()
{
    if (!current_user_can('update_core')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_head', 'hide_update_notice_to_all_but_admin_users', 1 );



/* Remove admin bar from the top */
add_filter( 'show_admin_bar', '__return_false' );
remove_action( 'personal_options', '_admin_bar_preferences' );



// Change email from name and email address
function wpb_sender_email( $original_email_address ) {
    return 'help@healora.com';
}
function wpb_sender_name( $original_email_from ) {
	return 'Healora.com';
}
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );



/* Redirect to home page after logout */
add_filter('logout_url', 'logout_home', 10, 2);
function logout_home($logouturl, $redir)
{
$redir = get_option('siteurl');
return $logouturl . '&redirect_to=' . urlencode($redir);
}


/* wp-login page logo */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url("https://healora.com/wp-content/uploads/2016/02/healora-logo-new.png");
            padding-bottom: 30px;
            background-size: 270px 83px;
            width: 270px;
            height: 83px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/* END - Some basic settings */


/* ************************************************************ */
/* ******************** Doctors procedures ******************** */
/* ************************************************************ */
function doctors_procedure_list() {
	echo xprofile_get_field_data('Allergy and Immunology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Anesthesiology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Colon and Rectal Surgery', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Dermatology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Emergency Medicine', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Family Medicine', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Gastroenterology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Internal Medicine', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Medical Genetics', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Neurology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Nuclear Medicine', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Obgyn', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Oncology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Ophthalmology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Orthopedic Surgery', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Otolaryngology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Pathology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Pediatrics', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Physical Medicine and Rehab', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Plastic Surgery', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Preventative Medicine', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Psychiatry', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Pulmonary', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Radiology', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Surgery', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Thoracic Surgery', bp_get_member_user_id(), $multi_format = 'comma');
	echo xprofile_get_field_data('Urology', bp_get_member_user_id(), $multi_format = 'comma');
}
add_action("procedure_list", "doctors_procedure_list");



/* ************************************************************ */
/* ************ Generate random code for discount ************* */
/* ************************************************************ */
function genCodeString() {
    //return substr(md5(uniqid(mt_rand(), true)), 0, 8);
	return strtoupper(uniqid());
}
add_shortcode('randomcode', 'genCodeString');



/* *********************************************************************** */
/* Give "patient" role to new register users, registered from pop up forms */
/* *********************************************************************** */

/* Login form in pop up modal */
function register_role($user_id, $password="", $meta=array()) {
	$userdata = array();
	$userdata['ID'] = $user_id;
	$userdata['role'] = $_POST['role'];

	if ($userdata['role'] == "patient"){
		wp_update_user($userdata);

		/* Email to patient */
	    $user_info = get_userdata($user_id);
	    $to = $user_info->user_email;
	    $subject = 'Welcome to Healora';
	    $message = 'Welcome to Healora. Thank you for registering. If you want to speak to a specialist please call (424) 270-0714';
	    wp_mail($to, $subject, $message);

	    /* Email to admin about new register patient */
	    $subject = 'New patient registration on Healora';
	    $message = 'New patient has just registered on healora.com';
	    wp_mail($admin_email, $subject, $message);

	    /* Redirect to thank you page */
	    //wp_redirect( 'https://healora.com/welcome-to-healora/');
	    //exit;
	}
}

add_action('user_register', 'register_role');



/* Registration page */
function bp_custom_registration_role($user_id, $key, $user) {
    $userdata = array();
    $userdata['ID'] = $user_id;
    $patientSelect = xprofile_get_field_data('User info', $user_id, $multi_format = 'comma');
    $doctorSelect = xprofile_get_field_data('Doctor info', $user_id, $multi_format = 'comma');
    $admin_email = get_option( 'admin_email' );

    if (($patientSelect == 'Patient') or ($patientSelect == 'Employer') or ($patientSelect == 'Third Party Administrator')) {
        $userdata['role'] = 'patient';
        wp_update_user($userdata);

        /* Email to patient */
	    $user_info = get_userdata($user_id);
	    $to = $user_info->user_email;
	    $subject = 'Welcome to Healora';
	    $message = 'Welcome to Healora. Thank you for registering. If you want to speak to a specialist please call (424) 270-0714';
	    wp_mail($to, $subject, $message);

	    /* Email to admin about new register patient */
	    $subject = 'New patient registration on Healora';
	    $message = 'New patient has just registered on healora.com';
	    wp_mail($admin_email, $subject, $message);

	    /* Redirect to thank you page */
	    //wp_redirect( 'https://healora.com/welcome-to-healora/');
	    //exit;
    }


    if (($doctorSelect == 'Physician') or ($doctorSelect == 'Facility') or ($doctorSelect == 'Lab') or ($doctorSelect == 'Imaging')) {
        $userdata['role'] = 'subscriber';
        wp_update_user($userdata);

        /* Email to doctor */
        $user_info = get_userdata($user_id);
	    $to = $user_info->user_email;
	    $subject = 'Welcome to Healora';
	    $message = '
	    Welcome to HEALORA - the cash patient network.

We are delighted that you are registered as one of our partner doctors and we look forward to referring cash paying patients to you soon.  As you know the big advantage of using Healora as a referral partner is that there is never any cost to you for receiving our clients.

Over the next three (3) months we will be building our network here in California and you should expect to receive referrals at that time.  In the meantime, you can change your Medicare /MMA price + 20% that you are willing to accept anytime in your member profile.

If you have any questions please don’t hesitate to contact us.';
	    wp_mail($to, $subject, $message);

	    /* Email to admin about new register patient */
	    $subject = 'New doctor registration on Healora';
	    $message = 'New doctor has just registered on healora.com';
	    wp_mail($admin_email, $subject, $message);
   	}
}
add_action('bp_core_activated_user', 'bp_custom_registration_role',10 , 3);


/* ************************************************************ */
/* ****** Check the password to be at least 6 characters ****** */
/* ************************************************************ */
function bp_password_beefing() {
 global $bp;
 if ( !empty( $_POST['signup_password'] ) )
   if ( strlen( $_POST['signup_password'] ) < 6 )
    $bp->signup->errors['signup_password'] = __( 'Your password needs to be at least 6 characters', 'buddypress' );
 }
 add_action( 'bp_signup_validate', 'bp_password_beefing');



/* ************************************************************* */
/* *** Show all xprofile field options for selected field ID *** */
/* ************************************************************* */
function bundles_xprofile_get_field_options( $field_id ) {
	$field = xprofile_get_field( $field_id );
	$options = $field->get_children();
	return wp_list_pluck( $options, 'name' );
}



/* ************************************************************** */
/* *** "No results" when no members found in geo-my-wp search *** */
/* ************************************************************** */
/*//  Temporary changed in sftp://kappa.apogee.gr//home/healora/public_html/wp-content/plugins/geo-my-wp/includes/geo-my-wp-gmw-class.php
function gmw_custom_no_results_message( $no_results, $gmw, $message ) {
    //$no_results: the final "No results" message which needs to be modified
    //$gmw: the form being modified
    //$the original message pass to the no_results function

    $no_results  = '';
    $no_results .= '<div class="no-results-wrapper">';
    $no_results .= '<p>Nothing was found. Please try a different location</p>';
    $no_results .= '</div>';

    return $no_results;
}
add_filter( 'gmw_fl_no_results_message', 'gmw_custom_no_results_message', 10, 3 );
apply_filters( "gmw_fl_no_results_message", $no_results, $this->form, $message );*/




/* *********************************** */
/* *** Home page human body search *** */
/* *********************************** */

/* Human body image & procedures*/
function human_body_procedures_search() { ?>

<script type="text/javascript">
	var $ = jQuery;

	// Enable tooltip
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	});


	$(document).ready(function(){
    /* Multiselect convert to simple select */
    $("#gmw-1-field-14552, #gmw-1-field-14576, #gmw-1-field-14578, #gmw-1-field-14580, #gmw-1-field-14582, #gmw-1-field-14584, #gmw-1-field-14586, #gmw-1-field-14588, #gmw-1-field-14590, #gmw-1-field-14592, #gmw-1-field-14594, #gmw-1-field-14596, #gmw-1-field-14598, #gmw-1-field-14600, #gmw-1-field-14602, #gmw-1-field-14604, #gmw-1-field-14606, #gmw-1-field-14608, #gmw-1-field-14610, #gmw-1-field-14612, #gmw-1-field-14614, #gmw-1-field-14616, #gmw-1-field-14618, #gmw-1-field-14620").removeAttr("multiple");

    /* Change label */
	$(".gmw-1-field-14576-wrapper label, .gmw-1-field-14578-wrapper label, .gmw-1-field-14580-wrapper label, .gmw-1-field-14582-wrapper label, .gmw-1-field-14584-wrapper label, .gmw-1-field-14586-wrapper label, .gmw-1-field-14588-wrapper label, .gmw-1-field-14590-wrapper label, .gmw-1-field-14592-wrapper label, .gmw-1-field-14594-wrapper label, .gmw-1-field-14596-wrapper label, .gmw-1-field-14598-wrapper label, .gmw-1-field-14600-wrapper label, .gmw-1-field-14602-wrapper label, .gmw-1-field-14604-wrapper label, .gmw-1-field-14606-wrapper label, .gmw-1-field-14608-wrapper label, .gmw-1-field-14610-wrapper label, .gmw-1-field-14612-wrapper label, .gmw-1-field-14614-wrapper label, .gmw-1-field-14616-wrapper label, .gmw-1-field-14618-wrapper label, .gmw-1-field-14620-wrapper label").text("STEP 2 - Choose your procedure:");


	function hideAllSelect() {
		$(".gmw-1-field-14576-wrapper, .gmw-1-field-14578-wrapper, .gmw-1-field-14580-wrapper, .gmw-1-field-14582-wrapper, .gmw-1-field-14584-wrapper, .gmw-1-field-14586-wrapper, .gmw-1-field-14588-wrapper, .gmw-1-field-14590-wrapper, .gmw-1-field-14592-wrapper, .gmw-1-field-14594-wrapper, .gmw-1-field-14596-wrapper, .gmw-1-field-14598-wrapper, .gmw-1-field-14600-wrapper, .gmw-1-field-14602-wrapper, .gmw-1-field-14604-wrapper, .gmw-1-field-14606-wrapper, .gmw-1-field-14608-wrapper, .gmw-1-field-14610-wrapper, .gmw-1-field-14612-wrapper, .gmw-1-field-14614-wrapper, .gmw-1-field-14616-wrapper, .gmw-1-field-14618-wrapper, .gmw-1-field-14620-wrapper").css("display", "none");
	}

	  /* Click on human body */
	  $(".pw-circle").click(function(){
      $("#gmw-1-field-14552 option").removeProp('selected');
      $("#gmw-1-field-14552 option").removeAttr('selected');
			hideAllSelect();
			$(".homepage-body-search-categories-container").hide();
			$(".homepage-body-search-categories-container").show();
			$(".homepage-body-search-intro").hide();

			var tooltipValue = $(this).attr("data-termslug");
			var tooltipID = $(this).attr("data-termid");

	        //console.log("procedure " +tooltipValue+ " **** id " +tooltipID);
	        $("#gmw-1-field-14552 option[value='" + tooltipValue + "']").prop('selected','selected');
	        $("#gmw-1-field-14552 option[value='" + tooltipValue + "']").attr('selected','selected');
		    $(".gmw-1-field-" + tooltipID + "-wrapper").css("display", "block");



		    $("#gmw-submit-1").click(function(e){
		    	if($(".gmw-1-field-" + tooltipID + "-wrapper").css('display') == 'block' && $(".gmw-1-field-" + tooltipID + "-wrapper option:selected").val() === "" ) {
		    		e.preventDefault();
		    		alert("Please select procedure to continue.");
		    	}


		    	/*$(".gmw-1-field-" + tooltipID + "-wrapper").change(function(e) {
					if(!$(this).val() === "") {
			    		e.preventDefault();
			    		alert("Please select procedure to continue.");
			    	}
			    });*/
		    });


			/* Send selected option value via ajax */
			/*$(".gmw-1-field-" + tooltipID + "-wrapper").on('change', 'select', function (e) {
		      $(".choose-your-doctor-left-column, .choose-your-doctor-right-column").remove();
		      $.ajax({
		        method: "POST",
		        url: ajaxurl,
		        data: { 'action': 'send_selected_value',
		        		'dadCategoryid': tooltipID,
		        		'procedureName': this.value
		        	}
		      })

		      .done(function( data ) {
		        //console.log('Successful AJAX Call! /// Return Data: ' + data);
		        data = JSON.parse( data );
		        $( '.choose-your-doctor-wrapper' ).append('<div class="choose-your-doctor-left-column"><span class="avg-insurance-title">Avg Insurance Price</span><span class="avg-insurance-price">$'+ data.insurance_price +'</span></div><div class="choose-your-doctor-right-column"><span class="avg-healora-title">Avg Healora Price</span><span class="avg-healora-price">$'+ data.healora_price +'</span></div>');
		      })

		      .fail(function( data ) {
		        console.log('Failed AJAX Call :( /// Return Data: ' + data);
		      });
		    });*/
		    /* Send selected option value via ajax  END */

		});


		/* Click on specialty select */
		function showSelect( v ) {
			if (v=="Ankle")						{$(".gmw-1-field-14606-wrapper").show();}
			if (v=="Breast")					{$(".gmw-1-field-14616-wrapper").show();}
			if (v=="Ears")						{$(".gmw-1-field-14580-wrapper").show();}
			if (v=="Elbow")						{$(".gmw-1-field-14598-wrapper").show();}
			if (v=="Eye")						{$(".gmw-1-field-14592-wrapper").show();}
			if (v=="Foot and Ankle")			{$(".gmw-1-field-14608-wrapper").show();}
			if (v=="Fractures")					{$(".gmw-1-field-14602-wrapper").show();}
			if (v=="Gastroenterology")			{$(".gmw-1-field-14586-wrapper").show();}
			if (v=="General Surgery")			{$(".gmw-1-field-14584-wrapper").show();}
			if (v=="Hip")						{$(".gmw-1-field-14610-wrapper").show();}
			if (v=="Knee")						{$(".gmw-1-field-14604-wrapper").show();}
			if (v=="Neck")						{$(".gmw-1-field-14612-wrapper").show();}
			if (v=="Neurology")					{$(".gmw-1-field-14588-wrapper").show();}
			if (v=="Nose")						{$(".gmw-1-field-14582-wrapper").show();}
			if (v=="Obgyn")						{$(".gmw-1-field-14590-wrapper").show();}
			if (v=="Pain Management")			{$(".gmw-1-field-14614-wrapper").show();}
			if (v=="Radiology")					{$(".gmw-1-field-14618-wrapper").show();}
			if (v=="Shoulder")					{$(".gmw-1-field-14596-wrapper").show();}
			if (v=="Skin")						{$(".gmw-1-field-14576-wrapper").show();}
			if (v=="Spine")						{$(".gmw-1-field-14576-wrapper").show();}
			if (v=="Throat")					{$(".gmw-1-field-14578-wrapper").show();}
			if (v=="Urology")					{$(".gmw-1-field-14620-wrapper").show();}
			if (v=="Wrist & Hand")				{$(".gmw-1-field-14600-wrapper").show();}
		}


		$("select[name='field_14552[]']").change(function() {
			hideAllSelect();
			showSelect( $(this).val() );
		});

		hideAllSelect();
		showSelect( $("select[name='field_14552[]']").val() );
	});
</script>


<div id="human-body-search-container" class="vc_row wpb_row vc_row-fluid">
	<div class="wpb_column vc_column_container vc_col-sm-6">
		<div class="homepage-body-search-intro">
			<img src="https://healora.com/wp-content/uploads/2017/11/arrow-right.png">
			<p class="homepage-body-search-title"> Select your dot to start</p>
		</div>

		<div class="homepage-body-search-categories-container">
			<?php echo do_shortcode('[gmw form="1"]');?>
		</div>
	</div>

	<div class="wpb_column vc_column_container vc_col-sm-6">
		<div id="pricing-widget" class="right">
			<img src="https://healora.com/wp-content/uploads/2014/04/body.png" alt="">
			<div class="pw-circle tooltip" data-x="43" data-y="275" style="left:43px; top:275px" data-termid="14608" data-termslug="Foot/Ankle" data-toggle="tooltip" title="Foot/Ankle"></div>
			<div class="pw-circle tooltip" data-x="337" data-y="254" style="left:337px; top:254px" data-termid="14602" data-termslug="Fractures" data-toggle="tooltip" title="Fractures"></div>
			<div class="pw-circle tooltip" data-x="47" data-y="75" style="left:47px; top:75px" data-termid="14616" data-termslug="Breast" data-toggle="tooltip" title="Breast"></div>
			<!-- <div class="pw-circle tooltip" data-x="77" data-y="75" style="left:77px; top:75px" data-termid="25" data-termslug="cardiovascular"></div> -->
			<div class="pw-circle tooltip" data-x="394" data-y="82" style="left:394px; top:82px" data-termid="14580" data-termslug="Ears" data-toggle="tooltip" title="Ears"></div>
			<div class="pw-circle tooltip" data-x="174" data-y="104" style="left:174px; top:104px" data-termid="14598" data-termslug="Elbow" data-toggle="tooltip" title="Elbow"></div>
			<div class="pw-circle tooltip" data-x="354" data-y="64" style="left:354px; top:64px" data-termid="14592" data-termslug="Eye" data-toggle="tooltip" title="Eye"></div>
			<div class="pw-circle tooltip" data-x="83" data-y="287" style="left:83px; top:287px" data-termid="14606" data-termslug="Ankle" data-toggle="tooltip" title="Ankle"></div>
			<div class="pw-circle tooltip" data-x="411" data-y="254" style="left:411px; top:254px" data-termid="14576" data-termslug="Skin" data-toggle="tooltip" title="Skin"></div>
			<div class="pw-circle tooltip" data-x="442" data-y="286" style="left:442px; top:286px" data-termid="14618" data-termslug="Radiology" data-toggle="tooltip" title="Radiology"></div>
			<div class="pw-circle tooltip" data-x="62" data-y="133" style="left:62px; top:133px" data-termid="14590" data-termslug="Obgyn" data-toggle="tooltip" title="Gynecology (Obgyn)"></div>
			<div class="pw-circle tooltip" data-x="442" data-y="254" style="left:442px; top:254px" data-termid="14584" data-termslug="General Surgery" data-toggle="tooltip" title="General Surgery"></div>
			<!-- <div class="pw-circle tooltip" data-x="45" data-y="158" style="left:45px; top:158px" data-termid="14" data-termslug="hernia-usually-includes-mesh"></div> -->
			<div class="pw-circle tooltip" data-x="196" data-y="150" style="left:196px; top:150px" data-termid="14610" data-termslug="Hip" data-toggle="tooltip" title="Hip"></div>
			<div class="pw-circle tooltip" data-x="80" data-y="212" style="left:80px; top:212px" data-termid="14604" data-termslug="Knee" data-toggle="tooltip" title="Knee"></div>
			<div class="pw-circle tooltip" data-x="337" data-y="285" style="left:337px; top:285px" data-termid="14614" data-termslug="Pain Management" data-toggle="tooltip" title="Pain Management"></div>
			<div class="pw-circle tooltip" data-x="219" data-y="38" style="left:219px; top:38px" data-termid="14612" data-termslug="Neck" data-toggle="tooltip" title="Neck"></div>
			<div class="pw-circle tooltip" data-x="324" data-y="97" style="left:324px; top:97px" data-termid="14582" data-termslug="Nose" data-toggle="tooltip" title="Nose"></div>
			<!-- <div class="pw-circle tooltip" data-x="375" data-y="119" style="left:375px; top:119px" data-termid="28" data-termslug="oral-maxillofacial"></div> -->
			<!-- <div class="pw-circle tooltip" data-x="411" data-y="286" style="left:411px; top:286px" data-termid="18" data-termslug="pain"></div> -->
			<!-- <div class="pw-circle tooltip" data-x="336" data-y="127" style="left:336px; top:127px" data-termid="27" data-termslug="pediatric-dentistry"></div> -->
			<div class="pw-circle tooltip" data-x="93" data-y="48" style="left:93px; top:48px" data-termid="14596" data-termslug="Shoulder" data-toggle="tooltip" title="Shoulder"></div>
			<div class="pw-circle tooltip" data-x="220" data-y="82" style="left:220px; top:82px" data-termid="14594" data-termslug="Spine" data-toggle="tooltip" title="Spine"></div>
			<div class="pw-circle tooltip" data-x="380" data-y="159" style="left:380px; top:159px" data-termid="14578" data-termslug="Throat" data-toggle="tooltip" title="Throat"></div>
			<div class="pw-circle tooltip" data-x="77" data-y="159" style="left:77px; top:159px" data-termid="14620" data-termslug="Urology" data-toggle="tooltip" title="Urology"></div>
			<div class="pw-circle tooltip" data-x="277" data-y="143" style="left:277px; top:143px" data-termid="14600" data-termslug="Wrist/Hand" data-toggle="tooltip" title="Wrist/Hand"></div>
			<div class="pw-circle tooltip" data-x="62" data-y="12" style="left:62px; top:12px" data-termid="14588" data-termslug="Neurology" data-toggle="tooltip" title="Neurology"></div>
			<div class="pw-circle tooltip" data-x="62.80000305175781" data-y="102.80000305175781" style="left:62.80000305175781px; top:102.80000305175781px" data-termid="14586" data-termslug="Gastroenterology" data-toggle="tooltip" title="Gastroenterology"></div>
		</div>
	</div>

</div>
<?php }

add_shortcode("human_body_search", "human_body_procedures_search");



/* Steps after selecting the procedure */
/*function choose_your_doctor_step($gmw) { ?>
	<div class="choose-your-doctor-container">
		<!-- <div class="choose-your-doctor-wrapper"></div> -->

		<!-- Registration modal container -->

        <script>
        $(document).ready(function(){
            $("input#gmw-submit-1").val("CHECK YOUR PROCEDURE");
          });
        </script>

  		 <?php if(!is_user_logged_in()) { ?>
  			<script>
  				$(document).ready(function(){
  					$(".register-with-us-button").click(function(){
  						$(".homepage-registration-form").show();
  						$(".register-withus-form").hide();
  					});

  					$(".homepage-registration-form-have-account").click(function(){
  						$(".homepage-registration-form").hide();
  						$(".homepage-registration-form").show();
  					});

  					$(".homepage-registration-form-new-to-healora").click(function(){
  						$(".homepage-registration-form").show();
  						$(".homepage-registration-form").hide();
  					});
  				});
  			</script>

			<a class="accent-color-button" href="#" data-toggle="modal" data-target="#register">CHECK YOUR PROCEDURE</a>

			<!-- Registration modal -->
			<div class="modal fade" id="register" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			      	<div class="register-withus-form">
				        <p>To see specific doctor prices</p>
				        <a class="homepage-find-your-doctor-button register-with-us-button" href="javascript:void(0);">REGISTER WITH US</a>
				        <p>Don't worry, it is only your email!</p>
			        </div>

			        <div class="homepage-registration-form">
			       		<p>Register with us</p>
			       		<p>Save up to 70% on Healthcare Procedures</p>

			       		<!-- Registration form -->
			       		<div class="homepage-registration-form">
				          	<?php echo do_shortcode("[RM_Form id='4']"); ?>
				          	<p class="homepage-registration-form-have-account">Have an account?</p>
				        </div>
				        <!-- Registration form END -->

				        <!-- Login form -->
				        <div class="homepage-registration-form">
				          	<?php echo do_shortcode("[RM_Login]"); ?>
				          	<p class="homepage-registration-form-new-to-healora">New to Healora?</p>
				        </div>
				        <!-- Login form END -->
			        </div>

			      </div><!-- /.modal-body -->
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		<?php } ?>
		<!-- Registration modal container END -->

	</div>
<?php }
add_action("gmw_search_form_end", "choose_your_doctor_step");*/



/* Fetch selected option data from DB by value */
/*function get_selected_option_value() {
	global $wpdb;
	$procedureDadID = $_POST['dadCategoryid'];
	$namevalue = $_POST['procedureName'];
	$procedureName = $_POST['procedureName'];
	$data = $wpdb->get_row( 'SELECT * FROM hea_bp_xprofile_fields WHERE parent_id = "'.$procedureDadID.'" AND name LIKE "'.$procedureName.'"', ARRAY_A );
	echo json_encode($data);
	wp_die();
	}
add_action( 'wp_ajax_nopriv_send_selected_value', 'get_selected_option_value' );
add_action( 'wp_ajax_send_selected_value', 'get_selected_option_value' );*/



// Register variables that passes in links (search results to single doctor profile)
function register_variables_add_query_vars_filter( $vars ){
    $vars[] = "currentCategory";
    $vars[] = "currentProcedure";
    $vars[] = "doctor";
    return $vars;
}
add_filter( 'query_vars', 'register_variables_add_query_vars_filter' );


function provider_employer_buttons_homepage() {
	return '

	<div class="vc_row wpb_row vc_row-fluid">

		<a href="https://healora.com/provider-register/">
			<div class="homepage-box-buttons-containers-left wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
				<div class="wpb_text_column wpb_content_element ">
					<div class="wpb_wrapper">
						<p style="text-align: center; font-size: 50px;"><span style="color: #00b2e2;">Are you a provider?</span></p>
			<p><img class="aligncenter wp-image-2104" src="https://healora.com/wp-content/uploads/2017/12/Provider-300x300.png" alt="" width="100" height="100" srcset="https://healora.com/wp-content/uploads/2017/12/Provider-300x300.png 300w, https://healora.com/wp-content/uploads/2017/12/Provider-150x150.png 150w, https://healora.com/wp-content/uploads/2017/12/Provider-1024x1024.png 1024w, https://healora.com/wp-content/uploads/2017/12/Provider.png 1200w" sizes="(max-width: 100px) 100vw, 100px"></p>

					</div>
				</div>
			</div></div></div>
		</a>




		<a href="https://healora.com/employer-register/">
			<div class="homepage-box-buttons-containers-right wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
				<div class="wpb_text_column wpb_content_element ">
					<div class="wpb_wrapper">
						<p style="text-align: center; font-size: 50px;"><span style="color: #00b2e2;">Are you an employer?</span></p>
			<p><img class="aligncenter wp-image-2103" src="https://healora.com/wp-content/uploads/2017/12/Employer-300x300.png" alt="" width="100" height="100" srcset="https://healora.com/wp-content/uploads/2017/12/Employer-300x300.png 300w, https://healora.com/wp-content/uploads/2017/12/Employer-150x150.png 150w, https://healora.com/wp-content/uploads/2017/12/Employer-1024x1024.png 1024w, https://healora.com/wp-content/uploads/2017/12/Employer.png 1200w" sizes="(max-width: 100px) 100vw, 100px"></p>

					</div>
				</div>
			</div></div></div>
		</a>
	</div>';
}

add_shortcode("provider_employer_buttons", "provider_employer_buttons_homepage");




add_filter('wp_nav_menu_items','add_todaysdate_in_menu', 10, 2);
function add_todaysdate_in_menu( $items, $args ) {
    //if( $args->theme_location == 'main-menu')  {
	if ( is_user_logged_in() ) {
	    $user_ID = get_current_user_id();
		$user_info = get_userdata($user_ID);
        $items .=  '<li class="firstitem bp-menu bp-profile-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown" style="text-transform: uppercase;"><a href="https://healora.com/members/'.$user_info->user_nicename.'/profile/change-avatar/">HELLO, '.$user_info->display_name.'</a><ul class="dropdown-menu " style="display: none;"><li id="nav-menu-item-1368" class=" bp-menu bp-logout-nav menu-item menu-item-type-custom menu-item-object-custom "><a href="'.wp_logout_url().'">Log Out</a></li></ul></li>';
 	}
    //}
    return $items;
}