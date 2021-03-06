<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require __DIR__  . '/vendor/autoload.php';
// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
// Testing
// $apiContext = new \PayPal\Rest\ApiContext(
//     new \PayPal\Auth\OAuthTokenCredential(
//         'AYCKuZ1CU6juGfxtVv8yEBzjiG-z3H23MdKe_RCNYYiGNrSbcWeyrXiG89YLtVWyeepjLe2pb1sS_eOo',     // ClientID
//         'ED5RoHz0c8gTv4HgwHyaBUehUvA4ChHOspglDpVjL84ni44WSYO4JuCjClhqTlE-SVipOkjemMTW5dEb'      // ClientSecret
//     )
// );
// Live
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AafMyAO2rTUNi0pAd-fX8BT_OSwRYhzBDY_VpbCbEudDhPbTj6ty5MbZf1IROi3aAATNCljtacgUOLlh',     // ClientID
        'EH30UWXXKsv0oEFxu9jX3QUtDu6tE3s_H5qVrTu4EPYQ0ftpf7qtor1PPbSfrWgGAmdRKRksPrYX78hA'      // ClientSecret
    )
);
$apiContext->setConfig(
    array(
        'mode' => 'LIVE'
    )
);  
$placeOrderId = $_REQUEST["placeOrderId"];

// 3. Lets try to create a Payment
// https://developer.paypal.com/docs/api/payments/#payment_create
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');
$amount = new \PayPal\Api\Amount();


$ch1 = curl_init();
$param = array("id" => $_REQUEST["placeOrderId"]); 
$param = json_encode($param);
curl_setopt($ch1, CURLOPT_URL,"https://api.healora.com/product/getOrderPrice/");
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS,$param);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                           
$server_output1 = curl_exec ($ch1);
$server_output1 = (array)json_decode($server_output1);
curl_close ($ch1);


$amount->setTotal($server_output1["amount"]);
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://healora.com/paypal/payresponse.php")
    ->setCancelUrl("https://healora.com/paypal/payresponse.php");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);
// 4. Make a Create Call and print the values
// echo "here";
try {
    // print_r($apiContext);
    $data = $payment->create($apiContext);
    // echo $data;die;
    // echo "<pre>";
    // echo $payment->getId();
    // echo "</pre>";
    // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
    $approvalUrl = $payment->getApprovalLink();

    $ch = curl_init();
    // echo "<pre>";
    // echo "fasdfdad";
    $myparam = array("temp" => "2", "payment_id" => (string)$payment->getId(), "request" => (string)$payment, "placeOrderId" => (string)$placeOrderId); 
    $myparam = json_encode($myparam);
    curl_setopt($ch, CURLOPT_URL,"https://api.healora.com/product/placeOrder/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$myparam);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                           
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    // print_r($server_output);
   // echo "fasdfasdf";

}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // echo "<pre>";
    // print_r($ex);
    echo $ex->getData();
}
// echo "here";
?>

<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
    <center><h1>Please do not refresh this page...</h1></center>
        <form method="post" action="<?=$approvalUrl?>" name="f1">
        <table border="1">
            <tbody>
            <?php
            foreach($payment as $name => $value) {
                echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
            }
            ?>
            <!-- <input type="submit" name="submit" value="submit"> -->
            </tbody>
        </table>
        <script type="text/javascript">
            document.f1.submit();
        </script>
    </form>
</body>
</html>