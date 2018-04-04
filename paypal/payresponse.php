<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<pre>";
$result = $_REQUEST;
$myparam = array("temp" => "3", "payment_id" => $_REQUEST['paymentId'],"payer_id" => $_REQUEST['PayerID'], "responce" => (string)"REQUEST"); 
$myparam = json_encode($myparam);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"127.0.0.1:5000/product/placeOrder/");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$myparam);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                           
$server_output = curl_exec ($ch);
curl_close ($ch);


$userpass = "AYCKuZ1CU6juGfxtVv8yEBzjiG-z3H23MdKe_RCNYYiGNrSbcWeyrXiG89YLtVWyeepjLe2pb1sS_eOo:ED5RoHz0c8gTv4HgwHyaBUehUvA4ChHOspglDpVjL84ni44WSYO4JuCjClhqTlE-SVipOkjemMTW5dEb";
$tokenUrl = "https://api.sandbox.paypal.com/v1/oauth2/token";
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
$executeUrl = "https://api.sandbox.paypal.com/v1/payments/payment/".(string)$_REQUEST['paymentId']."/execute";
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


$executeUrl = "https://api.sandbox.paypal.com/v1/payments/payment/".(string)$_REQUEST['paymentId'];
$auth="Authorization:Bearer ".$tokenOut['access_token'];
$chobj1 = curl_init();
curl_setopt($chobj1, CURLOPT_URL,$executeUrl);
curl_setopt($chobj1, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($chobj1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chobj1, CURLOPT_HTTPHEADER, array('Content-Type: application/json',$auth));                                           
$finalOut1 = curl_exec ($chobj1);
$finalOut1 = (array)json_decode($finalOut1);
curl_close ($chobj1);


if($finalOut1['state']=="approved"){
    $result = $_REQUEST;
    $myparam = array("temp" => "4", "payment_id" => $_REQUEST['paymentId'],"comments" => $finalOut1['state'],"status"=>"1", "responce" => (string)"REQUEST"); 
    $myparam = json_encode($myparam);
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL,"127.0.0.1:5000/product/placeOrder/");
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_POSTFIELDS,$myparam);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                           
    $updateRes = curl_exec ($ch1);
    curl_close ($ch1);
    $url = $_SERVER[HTTP_HOST]."/healora_webapp/#/success/".$_REQUEST['paymentId'];
    // echo $url; die;
    header("Location:http://".$url);
}else{
    $url = $_SERVER[HTTP_HOST]."#/fail/".$_REQUEST['paymentId'];
    header("Location:http://".$url);
}




?>