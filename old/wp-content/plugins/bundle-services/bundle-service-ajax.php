<?php
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
    include_once($_SERVER['DOCUMENT_ROOT'].'/wordpress/wp-config.php' );

    global $wpdb;

    $itemIDs = $_GET['itemID'];

    $order = 0;
    foreach ($itemIDs as $itemID) {
        $order++;
        //echo "item id - ".$itemID." order - ".$order;
        //echo "<br>";

        $table = hea_bundles;
        $data = array (
            'CPT_ID' => $order
        );
        $where = array (
            'ID' => $itemID
        );
        $format = array (
            '%d'
        );
        $where_format = array (
            '%d'
        );

        $wpdb->update($table, $data, $where, $format, $where_format);
    }
?>