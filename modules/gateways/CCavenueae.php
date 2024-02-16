
<?php


use Ccavenue\Helper;
use Illuminate\Database\Capsule\Manager as Capsule;


if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

if (file_exists(__DIR__ . '/CCavenueae/Helper.php')) {
    include_once  __DIR__ . '/CCavenueae/Helper.php';
}

// function CCavenueae_MetaData()
// {
//     return array(
//         'DisplayName' => 'Bypay',
//         'APIVersion' => '1.1', // Use API Version 1.1
//     );
// }
function CCavenueae_config()
{
    return array(

        'FriendlyName' => array(
            'Type' => 'System',
            'Value' => 'CCavenueae',
        ),
        // a merchant field type allows for single line text input
        'merchantID' => array(
            'FriendlyName' => 'Merchant ID',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Merchant ID for CCAvenue here',
        ),
        // a access code field type allows for single line text input
        'access_code' => array(
            'FriendlyName' => 'Access Code',
            'Type' => 'text',
            'Size' => '35',
            'Default' => '',
            'Description' => 'Enter your Access Code for CCAvenue here',
        ),
        // a password field type allows for masked text input

        'workingKey' => array(
            'FriendlyName' => 'working Key',
            'Type' => 'password',
            'Size' => '40',
            'Default' => '',
            'Description' => 'Enter the Working Key here',
        ),
        'testmode' => array(
            'FriendlyName' => 'Test Mode',
            'Type' => 'yesno',
            'Size' => '',
            'Default' => '',
        ),

    );
}
function CCavenueae_link($params)
{

    $merchantID = $params['merchantID'];
    $WorkingKey = $params['workingKey'];
    $Order_Id = $params["invoiceid"] . "_" . date("YmdHis");
    $accesskey = $params['access_code'];

    // Invoice Parameters
    $invoiceId = $params['invoiceid'];
    $amount = $params['amount'];
    $currencyCode = $params['currency'];

    // Client Parameters
    $firstname = $params['clientdetails']['firstname'];
    $lastname = $params['clientdetails']['lastname'];
    $email = $params['clientdetails']['email'];
    $address1 = $params['clientdetails']['address1'];
    $address2 = $params['clientdetails']['address2'];
    $city = $params['clientdetails']['city'];
    $state = $params['clientdetails']['state'];
    $postcode = $params['clientdetails']['postcode'];
    $country = $params['clientdetails']['country'];
    $phone = $params['clientdetails']['phonenumber'];
    $language = $params['clientdetails']['language'];

    // System Parameters
    $moduleName = $params['paymentmethod'];

    $Redirect_Url = $params["systemurl"] . 'modules/gateways/callback/' . $moduleName . '.php';
    $returnUrl = $params['systemurl'] . '/viewinvoice.php?id=' . $params['invoiceid'] . '&paymentfailed=true';



    $postfields = array();
    $postfields['merchant_id'] = $merchantID;
    $postfields['amount'] = $amount;
    $postfields['currency'] = $currencyCode;
    $postfields['redirect_url'] = $Redirect_Url;
    $postfields['cancel_url'] = $returnUrl;
    $postfields['language'] = $language;
    $postfields['order_id'] = $Order_Id;
    $postfields['billing_name'] = $firstname . " " . $lastname;
    $postfields['billing_address'] = $address1;
    $postfields['billing_city'] = $city;
    $postfields['billing_state'] = $state;
    $postfields['billing_tel'] = $phone;
    $postfields['billing_email'] = $email;
    $postfields['invoice_id'] = $invoiceId;
    $postfields['billing_zip'] = $postcode;

    $merchant_data = '';
 

    foreach ($postfields as $key => $value) {
        $merchant_data .= $key . '=' . $value . '&';
    }

    $CCAVENUEAE = new Helper($WorkingKey);
    $encrypted_data = $CCAVENUEAE->encryption($merchant_data); // Method for encrypting the data.

    $url = "https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction";
    if ($params['testmode'] == 'on')
        $url = "https://test.ccavenue.ae/transaction/transaction.do?command=initiateTransaction";
    $htmlOutput =      '<form id="ccavenue" method="post" action="' . $url . '">
					<input type="hidden" name="encRequest" value="' . $encrypted_data . '">
					<input type="hidden" name="access_code" value="' . $accesskey . '">
					 <input type="submit" value="Pay Now" class="btn btn-success"/>
					 </form>';
    return $htmlOutput;
}
    
function CCavenueae_refund($params)
{
    // echo "<pre>";
    // print_r($params);
    // die();
    $refundTransactionId = $params['transid'];
    $merchant_Id = $params['merchant_id'];
    $access_code = $params['access_code'];
    $refundAmount = $params['amount'];

    $reference_no = $params['invoiceid'];
    $merchant_data = '';
    $encKey = $params['workingKey'];
    $post_data = [
        "reference_no" => $reference_no,
        "refund_amount" => $refundAmount,
        "refund_ref_no" => $refundTransactionId
    ];
    $merchant_data = json_encode($post_data);
    $CCAVENUEAE = new Helper($encKey);
    $url = "https://api.ccavenue.ae/apis/servlet/DoWebTrans";
    if ($params['testmode'] == 'on')
        $url = "https://apitest.ccavenue.ae/apis/servlet/DoWebTrans";
    $CCAVENUEAE->URL = $url;
    $encrypted_data = $CCAVENUEAE->encryption($merchant_data);
    $command = "refundOrder";
    $data = "request_type=JSON&access_code=" . $access_code . "&command=" . $command . "&response_type=JSON&version=1.1&enc_request=" . $encrypted_data;
    $result = $CCAVENUEAE->api_call($data);
    // print_r($result);
    // die();
    if ($result == 1)
        return array('status' => 'success', 'rawdata' => $result, 'transid' => $refundTransactionId, 'fees' => 0);
    else
        return array('status' => 'failed', 'rawdata' => $result, 'transid' => $refundTransactionId, 'fees' => 0);
}

//refund intilize
// function CCavenueae_refund($params)
// {
//     // echo "<pre>";
//     // print_r($params);
//     // die();
//     $refundTransactionId = $params['transid'];
//     $merchant_Id = $params['merchant_id'];
//     $access_code = $params['access_code'];
//     $refundAmount = $params['amount'];

//     $reference_no = $params['invoiceid'];
//     $merchant_data = '';
//     $encKey = $params['workingKey'];
//     $post_data = [
//         "reference_no" => $reference_no,
//         "refund_amount" => $refundAmount,
//         "refund_ref_no" => $refundTransactionId
//     ];
//     // print_r($post_data);
//     // die();
//     $merchant_data = json_encode($post_data);
//     // $HDFCWSCCAVENUE = new HDFCWSCCAVENUE($encKey);
//     $url = "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
//     if ($params['testmode'] == 'on')
//     $url = "https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction";

//     $encrypted_data = encrypt($merchant_data, $encKey);
//     $command = "refundOrder";
//     $data = "request_type=JSON&access_code=" . $access_code . "&command=" . $command . "&response_type=JSON&version=1.1&enc_request=" . $encrypted_data;
//     $result = api_call($data, $url);

//     if ($result == 'Success')
//     return array('status' => 'success', 'rawdata' => $result, 'transid' => $refundTransactionId, 'fees' => 0);
//     else
//         return array('status' => 'failed', 'rawdata' => $result, 'transid' => $refundTransactionId, 'fees' => 0);
// }

// function encryption($plainText, $key)
// {
//     $key = hextobin(md5($key));
//     $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
//     $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
//     $encryptedText = bin2hex($openMode);
//     return $encryptedText;
// }

// function hextobin($hexString)
// {
//     $length = strlen($hexString);
//     $binString = "";
//     $count = 0;
//     while ($count < $length) {
//         $subString = substr($hexString, $count, 2);
//         $packedString = pack("H*", $subString);
//         if ($count == 0) {
//             $binString = $packedString;
//         } else {
//             $binString .= $packedString;
//         }
//         $count += 2;
//     }
//     return $binString;
// }

// function decrypts($encryptedText, $key)
// {
//     $key = hextobin(md5($key));
//     $initVector = pack("H*", "000102030405060708090a0b0c0d0e0f"); // Use hexadecimal format for the initialization vector
//     $encryptedText = hextobin($encryptedText);

//     $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);

//     if ($decryptedText === false) {
//         return "Decryption failed";
//     }

//     return $decryptedText;
// }

// function api_call($data, $url)
// {
//     echo "hlo";
   
//     global $encKey;
//     echo $encKey;
//     die();
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_VERBOSE, 1);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//     $result = curl_exec($ch);
//     curl_close($ch);

//     $information = explode('&', $result);

//     $status1 = explode('=', $information[0]);
//     $status2 = explode('=', $information[1]);
//     $status3 = explode('=', $information[2]);

//     if ($status1[1] == '1') {
//         $recorddata = $status2[1];
//         return $recorddata . " Error Code:" . $status3[1];
//     } else {
//         $decryptedStatus = decrypts($status2[1], $encKey);
//         return $decryptedStatus;
//     }
// }
