
<?php 
error_reporting(E_ALL);
// $_REQUEST = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43", "Joe"=>"43");
ini_set('display_errors', 1);
$my_file = 'file.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = implode(" ",$_REQUEST);
$output = implode(', ', array_map(
    function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
    $_REQUEST,
     array_keys($_REQUEST)
 ));
//$output = gettype($_REQUEST);
fwrite($handle, (string) $output);
?>
