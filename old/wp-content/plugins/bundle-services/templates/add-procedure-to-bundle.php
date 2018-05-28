<?php
/* ********************************************** */
/* *********** Add procedure to bundle ********** */
/* ********************************************** */
function add_bundle_procedures() { ?>

	<div class="wrap">
		<h2>Add Bundle Procedures</h2>
		<hr>

		<?php if (!empty($_POST)) {
			$procedureName = $_POST['procedure_name'];
			$procedureCPT = $_POST['procedure_cpt'];
			$procedureRegionalPrice = $_POST['procedure_regional_price'];
			$procedureMMA = $_POST['procedure_mma_price'];
			$bundleID = $_POST['bundle-id'];

	        global $wpdb;

	        for($i=0; $i < count($procedureName); $i++) {
	            $table = hea_bundles_items;
	            $data = array(
	                'Title' => $procedureName[$i],
	                'CPT' => $procedureCPT[$i],
	                'Regional_price' => $procedureRegionalPrice[$i],
	                'MMA' => $procedureMMA[$i],
	                'Bundle_ID' => $bundleID
	            );
	            $format = array(
	                '%s',
	                '%s',
	                '%s',
	                '%s',
	                '%d'
	            );
	            $success=$wpdb->insert( $table, $data, $format );
	            if($success){
	            	echo 'Procedure has beed added to bundle. <a href="https://healora.com/wp-admin/admin.php?page=add-bundle-procedure">Add new procedure.</a>' ; 
	            	header("location:".$_SERVER['REQUEST_URI']);
				}
			}
		}
		else { ?>

		<form id="add-new-bundle-table" method="post">
		<?php settings_fields( 'add-new-bundle-group' ); ?>
		<?php do_settings_sections( 'add-new-bundle-group' ); ?>

		<div class="add-new-bundle-wrapper"> 
			<button class="add_field_button button-primary pull-right">Add one more procedure</button>   
		    <div class="add-new-bundle-item">
		    	<p class="new-bundle-item-bundle-name"><label><b>Bundle Name</b></label>
		        <select name="bundle-id">
			        <?php
			        global $wpdb;
			        $getAllBundlesTitles = $wpdb->get_results("SELECT * FROM hea_bundles ORDER BY CPT, CPT_ID");
			        echo '<option value="">----</option>';
			        foreach ($getAllBundlesTitles as $getAllBundlesTitle) {
			        	echo '<option value="'.$getAllBundlesTitle->ID.'">'.$getAllBundlesTitle->CPT.' - '.$getAllBundlesTitle->Title.'</option>';
			        } ?>
		        </select></p>

		        <p><label>Procedure</label>
		        <input type="text" name="procedure_name[]" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('procedure_name') ); ?>" /></p>

		        <p><label>CPT</label>
		        <input type="text" name="procedure_cpt[]" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('procedure_cpt') ); ?>" /></p>

		        <p><label>MMA</label>
		        <input type="text" name="procedure_mma_price[]" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('procedure_mma_price') ); ?>" /></p>

		        <p><label>Regional Price</label>
		        <input type="text" name="procedure_regional_price[]" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('procedure_regional_price') ); ?>" /></p>
		    </div>
		</div>

		    <?php submit_button(); ?>

		</form>
		<?php } ?>


		<!-- Add one more procedure -->
		<script> 
		var $ = jQuery;
		$(document).ready(function() {
		var wrapper = $(".add-new-bundle-wrapper");
		var add_button = $(".add_field_button");
		var x = 1;

		$(add_button).click(function(e){
		    e.preventDefault();
		        x++;
		        $(wrapper).append('<div class="add-new-bundle-item"><p><label>Procedure</label><input type="text" name="procedure_name[]" class="bundle-services-form-input" value="<?php echo esc_attr(get_option('procedure_name')); ?>" /></p><p><label>CPT</label><input type="text" name="procedure_cpt[]" class="bundle-services-form-input" value="<?php echo esc_attr(get_option('procedure_cpt')); ?>" /></p><p><label>MMA</label><input type="text" name="procedure_mma_price[]" class="bundle-services-form-input" value="<?php echo esc_attr(get_option('procedure_mma_price')); ?>" /></p><p><label>Regional Price</label><input type="text" name="procedure_regional_price[]" class="bundle-services-form-input" value="<?php echo esc_attr(get_option('procedure_regional_price')); ?>" /></p><a href="#" class="remove_field" style="color: red;">Remove</a></div>');
		});
		    
		$(wrapper).on("click",".remove_field", function(e){
		    e.preventDefault(); $(this).parent('div').remove(); x--;
		    })
		});
		</script>

	</div>
<?php } // add_bundle_procedures END ?>