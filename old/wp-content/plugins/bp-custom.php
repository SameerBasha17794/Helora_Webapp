<?php 

function descrition_field_remove_html_filter() {
	remove_filter( 'bp_get_the_profile_field_description', 'wp_filter_kses' );
}
add_action( 'bp_init', 'descrition_field_remove_html_filter' );

?>