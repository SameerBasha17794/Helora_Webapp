<?php
/**
 * Plugin Name: Bundle Services
 * Plugin URI: https://enki.tech
 * Description: Healora bundle services extension.
 * Version: 1.0.0
 * Author: Enki Technologies
 * Author URI: https://enki.tech
 * License: GPL2
 */
defined( 'ABSPATH' ) or die( 'Not allowed!' );


include("templates/add-new.php");
include("templates/add-procedure-to-bundle.php");
include("templates/add-doctor-to-bundle.php");


// Main menu
function my_plugin_menu() {
	add_menu_page('All Bundle Services', 'All Bundle Services', 'delete_others_posts', 'bundle-services', 'bundle_services_page', 'dashicons-screenoptions');
	add_submenu_page( 'bundle-services', 'Add New Bundle', 'Add New Bundle', 'delete_others_posts', 'add-new-bundle', 'addNewBundle');
	add_submenu_page( 'bundle-services', 'Add Bundle Procedures', 'Add Bundle Procedures', 'delete_others_posts', 'add-bundle-procedure', 'add_bundle_procedures');
	add_submenu_page( 'bundle-services', 'Add Doctors', 'Add Doctors', 'delete_others_posts', 'add-doctor', 'add_doctor_to_bundle');
}
add_action('admin_menu', 'my_plugin_menu');


/* Load admin CSS */
function load_custom_css_wp_admin_bundle_style($hook) {
	if (!in_array($hook, array('toplevel_page_bundle-services', 'all-bundle-services_page_add-new-bundle', 'all-bundle-services_page_add-bundle-procedure', 'all-bundle-services_page_add-doctor'))) {
        return;	
	}
    wp_enqueue_style( 'custom_wp_admin_css', plugins_url('css/admin-style.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'load_custom_css_wp_admin_bundle_style' );
/* END Load admin CSS */



/* Load admin JS */
function load_custom_js_wp_admin_bundle_style($hook) {
	if (!in_array($hook, array('toplevel_page_bundle-services', 'all-bundle-services_page_add-new-bundle', 'all-bundle-services_page_add-bundle-procedure', 'all-bundle-services_page_add-doctor'))) {
        return;	
	}
    wp_enqueue_script( 'my_custom_script', plugins_url('js/script.js', __FILE__));
}
add_action( 'admin_enqueue_scripts', 'load_custom_js_wp_admin_bundle_style' );
/* END Load admin JS */



function bundle_services_page() { ?>
	<div class="wrap">
		<h2>All bundles list</h2>
		<hr>

		<!-- Latest bundle services -->
		<div class="container">
		    <div class="row">
		    <div class="col-sm-12 bundle-services-container">

				<?php
				global $wpdb;
				$bundlesTitles  = $wpdb->get_results("SELECT * FROM hea_bundles ORDER BY CPT_ID asc");
				?>


				<?php
				// Delete single bnundle
				if (!empty($_POST['delete-bundle-procedure'])) {
					global $wpdb;
					$table = hea_bundles_items;
					$where = array (
						'ID' => $_POST['bundle-procedure-id']
					);
					$where_format = array (
						'%d'
					);
					$success = $wpdb->delete( $table, $where, $where_format);
					if($success) {
						echo 'Procedure has been deleted.';
						header("location:".$_SERVER['REQUEST_URI']);
					}
				} //Delete END



				//Update
				elseif (!empty($_POST['submit-edit-procedure'])) {
				global $wpdb;
					$table = hea_bundles_items;
					$data = array(
						'CPT' => $_POST['procedure_cpt'],
						'Title' => $_POST['procedure_name'],
						'MMA' => $_POST['procedure_mma_price'],
						'Regional_price' => $_POST['procedure_regional_price']
						//'Bundle_ID' => $_POST['bundle_healora_total']
					);
					$where = array (
						'ID' => $_POST['bundle-procedure-id']
					);
					$format = array(
						'%s',
						'%s',
						'%s',
						'%s'
						//'%s'
					);
					$where_format = array (
						'%d'
					);
					$success = $wpdb->update( $table, $data, $where, $format, $where_format );
						if($success){
							echo 'Procedure has been updated.' ;
							header("location:".$_SERVER['REQUEST_URI']);
						}
					} ?>



				<table class="table admin-all-bundles-list">
					<tbody id="sortable">
					<?php foreach ($bundlesTitles as $singleBundle) { ?>
						<tr class="table admin-all-bundles-list-item" data-post-id='<?php echo $singleBundle->ID; ?>'>
					        <td><b><strong><?php echo $singleBundle->CPT ?> - </strong><?php echo $singleBundle->Title ?></b> <a href="javascript:void(0);" class="edit-bundle-button"> Edit</a>
					        <ul class="admin-all-bundles-list-procedures">
					        <?php 	 
					        $singleBundleItems = $wpdb->get_results("SELECT * FROM hea_bundles_items WHERE Bundle_ID LIKE '".$singleBundle->ID."'");
						  	foreach ($singleBundleItems as $singleBundleItemsInfo) {
							  	echo "<li>".$singleBundleItemsInfo->Title." <a href='javascript:void(0);' class='edit-bundle-procedure-button'>Edit</a>"; ?>

								<div class="edit-single-bundle-procedure-wrapper" style="display: none;">
									<form id="edit-single-procedure" method="post">
									    <div class="edit-single-bundle-procedure">
									        <p><label>Procedure</label>
									        <input type="text" name="procedure_name" class="bundle-services-form-input" value="<?php echo $singleBundleItemsInfo->Title; ?>" /></p>

									        <p><label>CPT</label>
									        <input type="text" name="procedure_cpt" class="bundle-services-form-input" value="<?php echo $singleBundleItemsInfo->CPT; ?>" /></p>

									        <p><label>MMA</label>
									        <input type="text" name="procedure_mma_price" class="bundle-services-form-input" value="<?php echo $singleBundleItemsInfo->MMA; ?>" /></p>

									        <p><label>Regional Price</label>
									        <input type="text" name="procedure_regional_price" class="bundle-services-form-input" value="<?php echo $singleBundleItemsInfo->Regional_price; ?>" /></p>
									    </div>
									<p class="delete-bundle-procedure-wrapper">
									<input type="hidden" name="bundle-procedure-id" value="<?php echo $singleBundleItemsInfo->ID; ?>">
									<input type="checkbox" name="delete-bundle-procedure" value="delete-bundle-procedure" class="delete-bundle-procedure"> I want to delete this procedure</p>
									<input type="submit" name="submit-edit-procedure" id="submit" class="button button-primary edit-bundle-submit" value="Update">
									</form>
								</div>
								</li>
							<?php } ?> <!-- END foreach $singleBundleItems -->
							</ul>


								<?php
								// Delete
								if (!empty($_POST['delete_bundle'])) {
								global $wpdb;
									$table = hea_bundles;
									$where = array (
										'ID' => $_POST['bundle_id']
									);
									$where_format = array (
										'%d'
									);
									$success = $wpdb->delete( $table, $where, $where_format);
									if($success) {
										echo 'Bundle has been deleted.';
										header("location:".$_SERVER['REQUEST_URI']);
									}
								} //Delete END


							  	//Update
							  	elseif (!empty($_POST['submit-edit-bundle'])) {
								    global $wpdb;
								        $table = hea_bundles;
								        $data = array(
								            'Title' => $_POST['bundle_name'],
								            'Category' => $_POST['bundle_category'],
								            'Regional_price' => $_POST['bundle_regional_price'],
								            'Healora_price' => $_POST['bundle_healora_price'],
								            'Healora_total' => $_POST['bundle_healora_total'],
								            'Doctor_amount' => $_POST['bundle_doctor_amount'],
								            'CPT' => $_POST['bundle_cpt']
								        );
								        $where = array (
								            'ID' => $_POST['bundle_id']
								        );
								        $format = array(
								            '%s',
								            '%s',
								            '%s',
								            '%s',
								            '%s',
								            '%s',
								            '%s'
								        );
								        $where_format = array (
								            '%d'
								        );
								        $success = $wpdb->update( $table, $data, $where, $format, $where_format );
								        if($success){
								            echo 'Bundle has been updated.' ; 
								            header("location:".$_SERVER['REQUEST_URI']);
										}
								} else { ?>


							  	<div class="edit-bundle-container" style="display: none;">
							  		<form id="edit-bundle" method="post">
							  			<?php
										$editBundles = $wpdb->get_results("SELECT * FROM hea_bundles WHERE ID = $singleBundle->ID");
										foreach ($editBundles as $editBundle) { ?>

											<input type="hidden" name="bundle_id" value="<?php echo $editBundle->ID; ?>">

											<p><label>Bundle Title</label>
									        <input type="text" name="bundle_name" class="bundle-services-form-input" value="<?php echo $editBundle->Title; ?>" /></p>

									        <p><label>CPT</label>
									        <input type="text" name="bundle_cpt" class="bundle-services-form-input" value="<?php echo $editBundle->CPT; ?>"/></p>

									        <p><label>Category</label>

									        <?php $allprocedures = (bundles_xprofile_get_field_options(2)); ?>
									        <select id="bundle_category" name="bundle_category">
												<?php foreach ($allprocedures as $procedure) { ?>
													<option value="<?php echo $procedure; ?>" <?php if($editBundle->Category == $procedure) echo 'selected = "selected"'; ?>><?php echo $procedure; ?></option>
												<?php } ?>
											</select></p>

									        <p><label>Regional Price</label>
									        <input type="text" name="bundle_regional_price" class="bundle-services-form-input" value="<?php echo $editBundle->Regional_price; ?>" /></p>

									        <p><label>Healora Avg</label>
									        <input type="text" name="bundle_healora_price" class="bundle-services-form-input" value="<?php echo $editBundle->Healora_price; ?>" /></p>

									        <p><label>Healora Total</label>
									        <input type="text" name="bundle_healora_total" class="bundle-services-form-input" value="<?php echo $editBundle->Healora_total; ?>" /></p>

									        <p><label>Doctor Total</label>
									        <input type="text" name="bundle_doctor_amount" class="bundle-services-form-input" value="<?php echo $editBundle->Doctor_amount; ?>" /></p>

										<?php } ?> <!-- $editBundles-->

										<p class="delete-bundle-wrapper"><input type="checkbox" name="delete_bundle" value="delete-bundle" class="delete-bundle"> I want to delete this bundle</p>

										<input type="submit" name="submit-edit-bundle" id="submit" class="button button-primary edit-bundle-submit" value="Update">
							  		</form>

							  	</div>

								<?php } ?>

					        </td>
					    </tr>
					<?php } ?> <!-- END foreach $bundlesTitles -->
					</tbody>
				</table>
		    </div>
		  </div>
		</div>
  		<!-- END Latest bundle services -->
	</div>



<?php 
$test  = $wpdb->get_results("SELECT * FROM hea_test ORDER BY ID_SORT asc");
?>

<!-- <ul id="sortable">
<?php foreach ($test as $item) {
	echo "<li data-post-id='".$item->ID_SORT."'>Post ".$item->ID_SORT."</li>";
} ?>
</ul>
<div id="console"></div>
<div id="ajax-response"></div> -->


<!-- Drag & Drop -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
var $ = jQuery;
$(document).ready(function(){

    $('#sortable').sortable({
        update: function(event, ui) {

        //$('#console').html('<b>posts[id] = pos:</b><br>');

	    //$('#sortable').children().each(function(i) {
            var id = $(this).attr('data-post-id');
            var order = $(this).index() + 1;

            //console.log($("#sortable").sortable('toArray', {attribute: 'data-post-id'}));

	        $('#console').html($('#console').html() + 'posts[' + id + '] = ' + order + '<br>');	   

		        $.ajax({
		        	type:"GET",
	  				url: "https://healora.com/wp-content/plugins/bundle-services/bundle-service-ajax.php",
	                data:{
	                  action: 'item_sort',
	                  itemID: $("#sortable").sortable('toArray', {attribute: 'data-post-id'})
		        	}
		        }).done(function(msg){
		        	$("#ajax-response").html(msg);
		        }); // done
            //}); // #sortable children
        } // update
    }); // #sortable
}); // Document ready
</script>
<!-- Drag & Drop END -->



<script>
var $ = jQuery;
$(document).ready(function(){
	$(".edit-bundle-button").click(function(){
		$(this).parent().find(".edit-bundle-container").toggle("slow");
		($(this).text() === "Edit") ? $(this).text("Hide") : $(this).text("Edit");
	});

	$(".edit-bundle-procedure-button").click(function(){
		$(this).parent().find(".edit-single-bundle-procedure-wrapper").toggle("slow");
		($(this).text() === "Edit") ? $(this).text("Hide") : $(this).text("Edit");
	});
});
</script>
<?php } ?>