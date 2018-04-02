<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require __DIR__  . '/vendor/autoload.php';
// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AYCKuZ1CU6juGfxtVv8yEBzjiG-z3H23MdKe_RCNYYiGNrSbcWeyrXiG89YLtVWyeepjLe2pb1sS_eOo',     // ClientID
        'ED5RoHz0c8gTv4HgwHyaBUehUvA4ChHOspglDpVjL84ni44WSYO4JuCjClhqTlE-SVipOkjemMTW5dEb'      // ClientSecret
    )
);
$placeOrderId = $_REQUEST["placeOrderId"];

// 3. Lets try to create a Payment
// https://developer.paypal.com/docs/api/payments/#payment_create
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');
$amount = new \PayPal\Api\Amount();
$amount->setTotal('1.00');
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://front.healora.com/payresponce.php")
    ->setCancelUrl("http://front.healora.com/payresponce.php");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);
// 4. Make a Create Call and print the values

try {
    // print_r($apiContext);
    $data = $payment->create($apiContext);
    // echo "<pre>";
    // echo $payment->getId();
    // echo "</pre>";
    // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
    $approvalUrl = $payment->getApprovalLink();

    $ch = curl_init();
    echo "<pre>";
    $myparam = array("temp" => "2", "payment_id" => (string)$payment->getId(), "request" => (string)$payment, "placeOrderId" => (string)$placeOrderId); 
    $myparam = json_encode($myparam);
    curl_setopt($ch, CURLOPT_URL,"127.0.0.1:5000/product/placeOrder/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$myparam);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                           
    $server_output = curl_exec ($ch);
    curl_close ($ch);
   

}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getData();
}
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