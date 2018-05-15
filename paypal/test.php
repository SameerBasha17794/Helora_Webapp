
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$my_file = 'file.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = implode(" ",$_REQUEST);;
fwrite($handle, $data);
?>