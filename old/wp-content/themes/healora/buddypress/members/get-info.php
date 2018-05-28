
<?php

$con = mysqli_connect("localhost", "WPhealora", "vqpRmgUV-DtB", "healora");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
$name=$_GET['procedure']; 
$mma=$_GET['mmaPrice']; 

foreach ($name as $value) {

	$sql = "SELECT * FROM hea_bp_xprofile_fields WHERE name LIKE '%".$value."%'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	/* Count procedure price with selected MMA value */
	$originalPrice = $row['price'];
	$mmmPercent = $mma/100;
	$percentSaved = $originalPrice * $mmmPercent;
	$offeredPrice = $originalPrice + $percentSaved;
	/* Count procedure price with selected MMA value END */

	echo '<div class="procedure-info-container">';
	echo '<div class="procedure-info"><div class="procedure-info-label">Procedure:</div> ' . $row['name'] .'</div>';
	echo '<div class="procedure-info"><div class="procedure-info-label">Code:</div> ' . $row['cpt_code'] .'</div>';
	echo '<div class="procedure-info"><div class="procedure-info-label">Price Offered:</div> $'. $offeredPrice .'</div>';
	echo '<br>';
	echo '</div>';
	echo '<br>';
	
}
?>