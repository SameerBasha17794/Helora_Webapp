<?php

/* ********************************************** */
/* ************ Add doctor to bundle ************ */
/* ********************************************** */

function add_doctor_to_bundle() { ?>
	<div class="wrap">
		<h2>Add Doctor to Bundle</h2>
		<hr>

		<?php
		if (!empty($_POST)) {
        global $wpdb;
            $table = hea_bundles_doctors;
            $data = array(
                'Bundle_ID' => $_POST['bundle-id'],
                'Doctor_ID' => $_POST['doctor-id']
            );
            $format = array(
                '%d',
                '%s'
            );
            $success=$wpdb->insert( $table, $data, $format );
            if($success){
            	echo 'Doctor has been added to selected procedure. <a href="https://healora.com/wp-admin/admin.php?page=add-doctor">Add new doctor.</a>' ;
            	//header("location:".$_SERVER['REQUEST_URI']); 
			}
		}
		else { ?>

		<form id="add-new-bundle-table" method="post">
		    <?php settings_fields( 'add-new-bundle-group' ); ?>
		    <?php do_settings_sections( 'add-new-bundle-group' ); ?>
		    <table class="form-table">
		    	<tr valign="top">
		        <th scope="row">Bundle</th>
		        <td>

		        <!-- Get all bundle titles -->
		        <select name="bundle-id">
			        <?php
			        global $wpdb;
			        $getAllBundlesTitles = $wpdb->get_results("SELECT * FROM hea_bundles ORDER BY CPT, CPT_ID");
			        echo '<option value="">----</option>';
			        foreach ($getAllBundlesTitles as $getAllBundlesTitle) {
			        	echo '<option value="'.$getAllBundlesTitle->ID.'">'.$getAllBundlesTitle->CPT.' - '.$getAllBundlesTitle->Title.'</option>';
			        } ?>
		        </select>

		        </td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">Doctor</th>
		        <td><?php
					$blogusers = get_users( 'blog_id=1&orderby=nicename&role=subscriber' );
					echo "<select name='doctor-id' id='autocomplete-doctor-id'>";
					echo '<option value="">----</option>';
					foreach ( $blogusers as $user ) {
						echo '<option value="'.$user->ID.'">' . xprofile_get_field_data('First Name', $user->ID).' '.xprofile_get_field_data('Last Name', $user->ID).' - ' . esc_html( $user->user_email ) . '</option>';
					}
					echo "</select>";?>
				</td>
		        </tr>
		    </table>
		    
		    <?php submit_button(); ?>

		</form>
		<?php } ?>
	</div>
<?php } //add_doctor_to_bundle END ?>