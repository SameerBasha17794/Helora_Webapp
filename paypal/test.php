
<?php 
$my_file = 'file.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = 'This is tddddddddhe data';
fwrite($handle, $data);
?>