
<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// $_REQUEST = array("msisdn"=>"447789435790", "to"=>"to", "messageId"=>"messageId", "text"=>"what is si", "type"=>"type", "keyword"=>"keyword", "message-timestamp"=>"message-timestamp");
//$_REQUEST = array("from"=>"+13102799918", "to"=>"to", "messageId"=>"messageId", "text"=>"what is si", "type"=>"type", "keyword"=>"keyword", "message-timestamp"=>"message-timestamp");
//$_REQUEST = array("from"=>"+13102799918", "to"=>"to", "messageId"=>"messageId", "text"=>"what is si", "type"=>"type", "keyword"=>"keyword", "message-timestamp"=>"message-timestamp");

//>>>>>>> a6464c0dde983627500a482198343ba2836a13fa
// $my_file = 'file.txt';
// $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = implode(" ",$_REQUEST);
$ch1 = curl_init();
//<<<<<<< HEAD
//$param = array("msisdn" => $_REQUEST["msisdn"],"to" => $_REQUEST["to"],"messageId" => $_REQUEST["messageId"],"text" => $_REQUEST["text"],"type" => $_REQUEST["type"]
//	,"keyword" => $_REQUEST["keyword"],"message-timestamp" => $_REQUEST["message-timestamp"]); 
$param = array("msisdn" => $_REQUEST["from"],"to" => $_REQUEST["to"],"messageId" => $_REQUEST["messageId"],"text" => $_REQUEST["text"]); 
$param = json_encode($param);
// curl_setopt($ch1, CURLOPT_URL,"http://pom.simplifyreality.com/analysis/messageRead");
curl_setopt($ch1, CURLOPT_URL,"pom.simplifyreality.com/analysis/messageReadBand");
//=======
//$param = array("msisdn" => $_REQUEST["from"],"to" => $_REQUEST["to"],"messageId" => $_REQUEST["messageId"],"text" => $_REQUEST["text"]); 
//$param = json_encode($param);
// curl_setopt($ch1, CURLOPT_URL,"http://pom.simplifyreality.com/analysis/messageRead");
//curl_setopt($ch1, CURLOPT_URL,"127.0.0.1:5000/analysis/messageReadBand");
//>>>>>>> a6464c0dde983627500a482198343ba2836a13fa
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS,$param);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                           
$server_output1 = curl_exec($ch1);
echo $server_output1;
print_r($server_output1);
echo curl_error($ch1); 
// $server_output1 = (array)json_decode($server_output1);
curl_close ($ch1);
echo "dddd";

?>
// fwrite($handle, (string) $server_output1);
