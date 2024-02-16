
<?php
require_once __DIR__ . '/../../../init.php';
 
use Ccavenue\Helper;
 
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
if (file_exists(__DIR__ . '../../CCavenueae/Helper.php')) {
    include_once  __DIR__ . '../../CCavenueae/Helper.php';
}
use WHMCS\Database\Capsule;
 
App::load_function('gateway');
App::load_function('invoice');
$gatewayModuleName = basename(__FILE__, '.php');
// Fetch gateway configuration parameters.
 
$gatewayParams = getGatewayVariables($gatewayModuleName);
// Verify the module is active.
if (!$gatewayParams['type']) {
    die("Module Not Activated");
}
 
$workingKey = $gatewayParams['workingKey'];
$encResponse = $_POST["encResp"];
$CCAVENUEAE = new Helper($workingKey);
$rcvdString = $CCAVENUEAE->decrypting($encResponse);
 
$order_status = "";
$decryptValues = explode('&', $rcvdString);
$dataSize = count($decryptValues);
for ($i = 0; $i < $dataSize; $i++) {
    $information = explode('=', $decryptValues[$i]);
    $response_details[$information[0]] = $information[1];
}
 
if ($response_details['order_status'] === "Success") {
    $transaction_id = explode("_", $response_details['order_id']);
    $invoiceId = $transaction_id[0];
    $returnUrl = $gatewayParams['systemurl'] . "viewinvoice.php?id=" . $invoiceId . "&paymentsuccess=true";
    $invoiceId = checkCbInvoiceID($invoiceId, $gatewayParams['name']);
    checkCbTransID($transaction_id[1]);
 
    // echo "<pre>";
    // print_r($response_details);
    // die();
 
    addInvoicePayment(
        (int) $invoiceId,
        (string)$transaction_id[1],
        $response_details['amount'],
        (float)0,
        (string)$gatewayParams['name']
    );
    logTransaction($gatewayParams['name'], $invoiceDetails, "Payment has been Successfully.");
    callback3DSecureRedirect((string)$invoiceId, true);
    exit;
} else {
    $returnUrl = $gatewayParams['systemurl'] . "viewinvoice.php?id=" . $invoiceId . "&paymentfailed=true";
    logTransaction($gatewayParams['name'], $invoiceDetails, "Payment has been failed");
    header("Location: $returnUrl");
    exit;
}