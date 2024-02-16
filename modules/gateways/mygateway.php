
<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Mygateway\Helper;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

if (file_exists(__DIR__ . '/mygateway/Helper.php')) {
    include_once  __DIR__ . '/mygateway/Helper.php';    
}


function mygateway_config()
{
    return array(
        'FriendlyName' => array(
            'Type' => 'System',
            'Value' => 'mygateway',
        ),
        'merchantID' => array(
            'FriendlyName' => 'Merchant ID',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Merchant ID for CCAvenue here',
        ),
        'access_code' => array(
            'FriendlyName' => 'Access Code',
            'Type' => 'text',
            'Size' => '35',
            'Default' => '',
            'Description' => 'Enter your Access Code for CCAvenue here',
        ),
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

function mygateway_link($params)
{
    $merchantID = $params['merchantID'];
    $WorkingKey = $params['workingKey'];
    $Order_Id = $params["invoiceid"] . "_" . date("YmdHis");
    $accesskey = $params['access_code'];

    $invoiceId = $params['invoiceid'];
    $amount = $params['amount'];
    $currencyCode = $params['currency'];

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

    $mygateway = new Helper($WorkingKey);
    $encrypted_data = $mygateway->encryption($merchant_data);

    // $url = "https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction";
    // $url = "https://www.example.com/checkout";
    $url = $params['systemurl'].'module/gateways/mygateway/data.php';
    // print_r($url);
    // echo "<pre>";
    // // print_r($params);
    // die();

    // if ($params['testmode'] == 'on')
    //     $url = "https://test.ccavenue.ae/transaction/transaction.do?command=initiateTransaction";

    $htmlOutput = '<form id="ccavenue" method="post" action="' . $url . '">
                    <input type="hidden" name="encRequest" value="' . $encrypted_data . '">
                    <input type="hidden" name="access_code" value="' . $accesskey . '">
                    <input type="submit" value="Pay Now" class="btn btn-success"/>
                  </form>';
    return $htmlOutput;
}


