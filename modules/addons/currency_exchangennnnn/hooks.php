<?php

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\currency_exchange\Helper;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
//ShoppingCartValidateProductUpdate
add_hook('ShoppingCartValidateCheckout', 1, function($vars) {
try{
    $helper = new Helper();
    $fieldName = "exchangeCurrency|Agree Exchange Currency";
    // $CheckFieldName = explode('|', $fieldName)[0] . '%';
    $type = "client";
    $clientId = isset($_SESSION['uid']) ? (int)$_SESSION['uid'] : 0;
    $custumFeildData = $helper->checkCustumFeildValue($fieldName,$type,$clientId);
if($custumFeildData !== 'on'){
    return '<b>Please ensure that the client is aware of the price exchange by checking their profile.</b>';
}
} catch (\Exception $e) {
    logActivity("Error Exchange Currency Hook" . $e->getMessage());
}
});
