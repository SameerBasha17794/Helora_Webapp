<?php
function addNewBundle() { ?>
	<div class="wrap">
		<h2>Add New Bundle</h2>
		<hr>

		<?php
		if (!empty($_POST)) {
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
            $format = array(
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
            );
            $success=$wpdb->insert( $table, $data, $format );
            if($success){
            	echo 'Bundle has been added. <a href="https://healora.com/wp-admin/admin.php?page=add-new-bundle">Add new bundle.</a>' ; 
            	//header("location:".$_SERVER['REQUEST_URI']);
			}
		}
		else { ?>

		<form id="add-new-bundle-table" method="post">
		    <table class="form-table">
		        <tr valign="top">
		        <th scope="row">Bundle Title</th>
		        <td><input type="text" name="bundle_name" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('bundle_name') ); ?>" /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">SKU</th>
		        <td><input type="text" name="bundle_cpt" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('bundle_cpt') ); ?>" /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">Category</th>
		        <?php $allprocedures = (bundles_xprofile_get_field_options(2)); ?>
		        <td><select id="bundle_category" name="bundle_category">
				<option value="">----</option>
				<?php foreach ($allprocedures as $procedure) { ?>
					<option value="<?php echo $procedure; ?>"><?php echo $procedure; ?></option>
				<?php } ?>
				</select></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">Regional Price</th>
		        <td><input type="text" name="bundle_regional_price" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('bundle_regional_price') ); ?>" /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">Healora Avg</th>
		        <td><input type="text" name="bundle_healora_price" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('bundle_healora_price') ); ?>" /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">Healora Total</th>
		        <td><input type="text" name="bundle_healora_total" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('bundle_healora_total') ); ?>" /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">Doctor Total</th>
		        <td><input type="text" name="bundle_doctor_amount" class="bundle-services-form-input" value="<?php echo esc_attr( get_option('bundle_doctor_amount') ); ?>" /></td>
		        </tr>
		    </table>
		    
		    <?php submit_button(); ?>

		</form>
		<?php } ?>
	</div>
<?php } ?>