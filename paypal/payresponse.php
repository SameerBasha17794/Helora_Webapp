<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<pre>";
$result = $_REQUEST;
$myparam = array("temp" => "3", "payment_id" => $_REQUEST['paymentId'],"payer_id" => $_REQUEST['PayerID'], "responce" => (string)"REQUEST"); 
$myparam = json_encode($myparam);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://api.healora.com/product/placeOrder/");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$myparam);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                           
$server_output = curl_exec ($ch);
curl_close ($ch);


$userpass = "AafMyAO2rTUNi0pAd-fX8BT_OSwRYhzBDY_VpbCbEudDhPbTj6ty5MbZf1IROi3aAATNCljtacgUOLlh:EH30UWXXKsv0oEFxu9jX3QUtDu6tE3s_H5qVrTu4EPYQ0ftpf7qtor1PPbSfrWgGAmdRKRksPrYX78hA";
$tokenUrl = "https://api.paypal.com/v1/oauth2/token";
$htoken = curl_init();
curl_setopt($htoken, CURLOPT_URL,$tokenUrl);
curl_setopt($htoken, CURLOPT_POST, 1);
curl_setopt($htoken, CURLOPT_POSTFIELDS,"grant_type=client_credentials");
curl_setopt($htoken, CURLOPT_USERPWD, $userpass);
curl_setopt($htoken, CURLOPT_RETURNTRANSFER, true);
curl_setopt($htoken, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Accept-Language: en_US'));                                           
$tokenOut = curl_exec ($htoken);
curl_close ($htoken);
$tokenOut = (array)json_decode($tokenOut);


$myarr = array("payer_id" => (string)$_REQUEST['PayerID']); 
$myarr = json_encode($myarr);
$executeUrl = "https://api.paypal.com/v1/payments/payment/".(string)$_REQUEST['paymentId']."/execute";
$auth="Authorization:Bearer ".$tokenOut['access_token'];
$chobj = curl_init();
curl_setopt($chobj, CURLOPT_URL,$executeUrl);
curl_setopt($chobj, CURLOPT_POST, 1);
curl_setopt($chobj, CURLOPT_POSTFIELDS, $myarr);
curl_setopt($chobj, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chobj, CURLOPT_HTTPHEADER, array('Content-Type: application/json',$auth));                                           
$finalOut = curl_exec ($chobj);
$finalOut = (array)json_decode($finalOut);
curl_close ($chobj);


$executeUrl = "https://api.paypal.com/v1/payments/payment/".(string)$_REQUEST['paymentId'];
$auth="Authorization:Bearer ".$tokenOut['access_token'];
$chobj1 = curl_init();
curl_setopt($chobj1, CURLOPT_URL,$executeUrl);
curl_setopt($chobj1, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($chobj1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chobj1, CURLOPT_HTTPHEADER, array('Content-Type: application/json',$auth));                                           
$finalOut1 = curl_exec ($chobj1);
$finalOut1 = (array)json_decode($finalOut1);
curl_close ($chobj1);

print_r($finalOut1['state']); 
// die("testing");

if($finalOut1['state']=="approved"){
    $result = $_REQUEST;
    $myparam = array("temp" => "4", "payment_id" => $_REQUEST['paymentId'],"comments" => $finalOut1['state'],"status"=>"1", "responce" => (string)"REQUEST"); 
    $myparam = json_encode($myparam);
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL,"http://api.healora.com/product/placeOrder/");
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_POSTFIELDS,$myparam);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                           
    $updateRes = curl_exec ($ch1);
    curl_close ($ch1);
    $url = $_SERVER[HTTP_HOST]."/#/success/".$_REQUEST['paymentId'];
    // echo $url; die;
    header("Location:http://".$url);
}else{
    $url = $_SERVER[HTTP_HOST]."/#/fail/".$_REQUEST['paymentId'];
    header("Location:http://".$url);
}




?>