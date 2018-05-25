<?php 
/* Template Name: Bundle services */ 
?> 
<?php get_header();?>

<?php while ( have_posts() ) : the_post(); ?>    
<section class="medicom-waypoint">  
    <div class="caption" <?php medicom_caption_image($id); ?>>
       <h1><?php the_title(); ?></h1> <a href="https://healora.lpages.co/help/" target="_blank" type="button" class="btn btn-info btn-lg dark-blue-btn bundle-services-find-procedures">Need Help?</a>
       <p><!-- <?php echo get_post_meta($post->ID, 'caption', true); ?> -->Know the total price for your procedure with no surprises</p>
    </div>
  <!-- Page Content Start -->
    <?php the_content(); ?>

    	<div class="all-bundle-categories-list-mobile">
    		<a href="javascript:void(0);" type="button" class="btn btn-info btn-lg dark-blue-btn bundle-services-find-procedures"><i class="fa fa-arrow-up fa-lg" aria-hidden="true"></i></a>
    	</div>

    	<!-- All categories bottom bar -->
		<div class="all-bundle-categories-list">
		<?php
		global $wpdb;
		$bundlesCategories  = $wpdb->get_results("SELECT DISTINCT(Category) FROM hea_bundles ORDER BY Category asc");
		foreach ($bundlesCategories as $bundlesCategory) {
			echo '<a href="#'.$bundlesCategory->Category.'" type="button" class="btn btn-info btn-lg dark-blue-btn bundle-services-find-procedures">'.$bundlesCategory->Category.'</a>';
		} ?>
		<a href="#all" type="button" class="btn btn-info btn-lg dark-blue-btn bundle-services-find-procedures"><i class="fa fa-arrow-up fa-lg" aria-hidden="true"></i></a>
		</div>


  <!-- Bundle services content -->
  <div class="container">
    <div class="row">
    <div class="col-sm-12 bundle-services-container">

		<?php
		global $wpdb;
		$bundlesTitles  = $wpdb->get_results("SELECT * FROM hea_bundles ORDER BY CPT_ID asc");
		//$bundlesTitles  = $wpdb->get_results("SELECT *, COUNT(CPT) as count FROM hea_bundles ORDER BY CPT_ID asc");
		?>



		<?php
		/*$numberofrows = $bundlesTitles[0]->count;
		echo "number of rows is - ".$numberofrows;

		$comments_per_page = 20;
		$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;

		echo paginate_links( array(
		    'base' => add_query_arg( 'cpage', '%#%' ),
		    'format' => '',
		    'prev_text' => __('&laquo;'),
		    'next_text' => __('&raquo;'),
		    'total' => ceil($bundlesTitles / $comments_per_page),
		    'current' => $page
		));*/
		?>

		<script>
		var $ = jQuery;
		$(document).ready(function(){
			$(".single-bundle-details-show").click(function(){
				$(this).parent().find(".single-bundle-details, .avg-healora-total, .avg-healora-price").toggle('slow', function() {
					if($(this).is(':hidden')) { 
						$(this).parent().find(".single-bundle-title, .bundle-regional-wrapper").css("font-weight", "500");
					} else {
						$(this).parent().find(".single-bundle-title, .bundle-regional-wrapper").css("font-weight", "700");
						/*{
							"font-weight" : "700",
							"text-align" : "start",
						    "display" : "block",
						    "vertical-align" : "bottom",
						    "float" : "right"
						}*/
					}
				});
				($(this).html() === 'Show details') ? $(this).html('Hide details') : $(this).html('Show details');
			});
		});
		</script>

		<table id="all" class="table">
		    <thead>
		        <tr>
		            <th class="bundle-services-total">Insurance price</th>
		            <th class="bundle-services-total" style="text-align: right;">Healora Average Price</th>
		        </tr>
		    </thead>
		    <tbody>

		<?php foreach ($bundlesTitles as $singleBundle) { ?>
			<tr id="<?php echo $singleBundle->Category ?>">

		        <td>
		        <div class="single-bundle-wrapper">
				<?php // Show bundle services category only once
				if ($singleBundle->Category != $showBundleCategoryOnce) { ?>
		        	<h5><strong><?php echo $singleBundle->Category; ?></strong></h5>
  				<?php } ?>

		        <span class="single-bundle-title"><?php echo $singleBundle->CPT; ?> - <?php echo $singleBundle->Title; ?></span><span class="single-bundle-details-show">Show details</span>
		 
		        <?php 	 
		        	$singleBundleItems = $wpdb->get_results("SELECT * FROM hea_bundles_items WHERE Bundle_ID LIKE '".$singleBundle->ID."'");
		        	echo "<div class='single-bundle-details' style='display: none;'>";
			  		foreach ($singleBundleItems as $singleBundleItemsInfo) {
				  		echo "<span class='single-bundle-item-title'>".$singleBundleItemsInfo->Title."</span>";
				  		echo "<span class='single-bundle-item-info'>$".number_format($singleBundleItemsInfo->Regional_price, 2)."</span>";
				  		echo "<br>";
				  	} // END foreach $singleBundleItems
				  	echo "</div>"; ?>
				  	<span class="bundle-regional-wrapper"><span class="bundle-regional-price" style="display: none;">Total: </span>$<?php echo number_format($singleBundle->Regional_price, 2); ?></span>
				</div>
		        </td>
		        <td class="bundle-services-bundle-total"><span class="avg-healora-total" style="display: none;">Avg. Healora Total</span><span class="avg-healora-price">$<?php echo number_format($singleBundle->Healora_price, 2); ?></span><br>
		        <button type="button" class="btn btn-info btn-lg dark-blue-btn modal-window-button bundle-services-request-button" data-toggle="modal" data-target="#bundle<?php echo $singleBundle->ID; ?>">Request</button></td>
		    </tr>


			<!-- MODAL-->
			<div id="bundle<?php echo $singleBundle->ID; ?>" class="modal fade" role="dialog">
	        <div class="modal-dialog">

	          <div class="modal-content">
	            <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal">&times;</button>
	              <?php if(!is_user_logged_in()) { ?>
	                      <div class="registration-note-modal">
		                      <p><b>Doctors could jeopardize their current contracts if they advertise publicly.</b></<br>
		                      <b>Please REGISTER and create password so you can be a Member and see pricing from Doctors.</b></p>
	                      </div>
	              <?php } ?>

	              <?php if(is_user_logged_in()) { ?>
	                      <h4 class="modal-title">BUNDLE SERVICES</h4>
	              <?php } ?>
	            </div>

	              <div class="modal-body" style="text-align: center;">
	               	<?php if(is_user_logged_in()) { ?>

	               	<p>Choose your doctor and find your lowest price!</p>
	               	<p>Doctors offering bundle services:</p>
	               	<ul class="doctors-offering-bundles-list">
		            	<?php $doctorOffersBundles = $wpdb->get_results("SELECT Doctor_ID FROM hea_bundles_doctors WHERE Bundle_ID LIKE '".$singleBundle->ID."'");
			               
		               	if(!empty($doctorOffersBundles)) {
			               foreach ($doctorOffersBundles as $doctorID ) {
			               		$user_info = get_userdata($doctorID->Doctor_ID); ?>
			                    <li><a href="https://healora.com/members/<?php echo $user_info->user_nicename; ?>/" target="_blank"><?php echo xprofile_get_field_data('First Name', $doctorID->Doctor_ID); ?> <?php echo xprofile_get_field_data('Last Name', $doctorID->Doctor_ID); ?></a></li>
		                    <?php } // end foreach $doctorOffersBundles
		                } else { ?>
		                    <p><i> Please call us at for this service.</i></p>
		                <?php } ?>
		                </ul>
		            <?php } ?>

	                   <?php if(!is_user_logged_in()) { ?>
	                      <div class="modal-login-form">
	                      	<p class="modal-login-form-existing-user">Existing Users</p>
	                      	<div class="modal-login-form-wrapper">
	                        	<?php wp_login_form(); ?>
	                        </div>
	                      </div>

	                      <div class="modal-registration-form">
	                      	<p style="color: #fff;">New User?</p>
	                        <?php echo do_shortcode("[rp_register_widget]"); ?>
	                      </div>

	                    <?php } ?>
	            </div>

	            <?php if(!is_user_logged_in()) { ?>
	                  <div class="modal-footer">
	                </div>
	                 <?php } ?>
	            

	             <?php if(is_user_logged_in()) { ?> 
	            <div class="modal-footer">
	              <button type="button" class="btn btn-info btn-lg dark-blue-btn modal-window-button" data-dismiss="modal">Close</button>
	            </div>
	            <?php } ?>
	          </div>

	      </div>
	      <!-- /Modal END -->
	     <?php
	     $showBundleCategoryOnce = $singleBundle->Category; // Show bundle services category only once   
	     ?>

		<?php } ?> <!-- /END foreach $bundlesTitles -->
			</tbody>
		</table>

		<div class="bundle-services-find-procedures-wrapper">
			<a href="https://healora.lpages.co/healoratoday-procedures/" target="_blank" type="button" class="btn btn-info btn-lg dark-blue-btn bundle-services-find-procedures">Couldn’t find your procedures? Ask it here</a>
		</div>

    </div>
  </div>
</div>
  <!-- Bundle services content END -->


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

<script>
	var $ = jQuery;
	$(document).ready(function(){
		$('input#user_login').attr( 'placeholder', 'Username or Email' );
		$('input#user_pass').attr( 'placeholder', 'Password' );
	});
</script>

<script>
	var $ = jQuery;
	$(document).ready(function(){
		$(".all-bundle-categories-list-mobile").click(function(){
			$(".all-bundle-categories-list").toggle("slow");
		});
	});
</script>