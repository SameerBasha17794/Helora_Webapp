<?php 
/* Template Name: Thank you for your Paypal payment */ 
?> 
<?php get_header();?>

<script>
window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
</script>

<?php while ( have_posts() ) : the_post(); ?>    
<section class="medicom-waypoint">  
    <div class="caption" <?php medicom_caption_image($id); ?>>
       <h1><?php the_title(); ?></h1>
       <p><?php echo get_post_meta($post->ID, 'caption', true); ?></p>
    </div>
  <!-- Page Content Start -->
    <?php the_content(); ?>


    <div class="container">
      <div class="row">
        <div class="col-md-12 thank-you-for-payment-wrapper">


          <?php
          // Get last post of current user (last procedure that user bought)
          $currentLoggedUserID = bp_loggedin_user_id();

          $args = array(
                  'author'        =>  $currentLoggedUserID,
                  'post_type'     =>  'easy_payment_list',
                  'post_status'   =>  'publish',
                  'orderby'       =>  'post_date',
                  'order'         =>  'DESC',
                  'posts_per_page' => 1
                  );
          $current_user_posts = get_posts($args);

          foreach ($current_user_posts as $post) {
                 $payedProcedureID = $post->ID;
          }


          // Custom
          $allText = get_post_meta($payedProcedureID, 'item_name', true);
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


          <div class="thank-you-for-payment-procedure">
            <p>Congratulations! You reserve your price for</p>
            <p><b><?php echo $currentCategoryINFO["name"]; ?></b></p>

            <?php // $bookedProcedureData = $wpdb->get_row("SELECT * FROM hea_bp_xprofile_fields WHERE name = '".$currentProcedureTitle."'", ARRAY_A); ?>

            <p>CPT: <?php echo $currentCategoryINFO["cpt"]; ?> - SKU: <?php echo $currentCategoryINFO["sku"]; ?></p>
            <p>with <?php echo xprofile_get_field_data('First Name', $getDoctorID); ?> <?php echo xprofile_get_field_data('Last Name', $getDoctorID); ?></p>
            <p><b>Your Coupon Number</b></p>
            <p><span><?php echo $getCouponCode; ?></span></p>
          </div>


          <div class="thank-you-for-payment-appointment">
            <p><span class="thank-you-for-payment-appointment-numbers">1</span> Make an appointment with the doctor:</p>
            <p style="text-align: center;"><b><?php echo xprofile_get_field_data('Office Phone', $getDoctorID); ?>, <?php echo xprofile_get_field_data('Office Email', $getDoctorID); ?><br>
            <?php echo xprofile_get_field_data('Office Address / Street', $getDoctorID); ?>, 
            <?php echo xprofile_get_field_data('Office Address / City', $getDoctorID); ?>, 
            <?php echo xprofile_get_field_data('Office Address / State', $getDoctorID); ?>, 
            <?php echo xprofile_get_field_data('Office Address / ZIP code', $getDoctorID); ?>

            </b></p>
            <p><span class="thank-you-for-payment-appointment-numbers">2</span> Bring the Coupon Number with you</p>
            <p><span class="thank-you-for-payment-appointment-numbers">3</span> Have the procedure done!</p>
            <br>

            <p class="text-right">Total price: $<?php echo $currentCategoryINFO["healora_price"]; ?><br>
            <b>Balance due to doctor: $<?php echo $currentCategoryINFO["provider_price"]; ?></b></p>
            <br>
            <?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>
          </div>
          

          <div class="doctor-profile-location-wrapper">
            <h3>Location</h3>
            <?php echo do_shortcode('[gmw_single_location item_type="member" item_id="'.$getDoctorID.'" elements="map" map_width="100%" map_height="450px" map_type="ROADMAP"]'); ?>
          </div>

        </div>
      </div>
    </div>



    <?php if (comments_open()){ ?>    
    <div class="bg-color white"><div class="container"><div class="row"><div class="col-md-9">    
        <div id="comment" class="comments-wrapper">
              <?php comments_template(); ?>
        </div>
    </div></div></div></div>
    <?php } ?>
</section>
<?php endwhile; // end of the loop. ?>
<?php get_footer();?>