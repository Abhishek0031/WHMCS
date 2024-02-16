<?php

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\currency_exchange\Helper;


if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('ShoppingCartValidateProductUpdate', 1, function($vars) {
try{
    echo "<pre>";
    print_r($vars);
    die;
    $helper = new Helper();
    $fieldName = "exchangeCurrency|Agree Exchange Currency";
    $CheckFieldName = explode('|', $fieldName)[0] . '%';
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


add_hook('ClientAreaFooterOutput', 1, function($vars) {

if($vars['filename'] === 'cart'  && $vars['pagetitle'] === 'Shopping Cart'){
// echo "<pre>";
// print_r($vars);
// die;
    $html = " 
    <style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
    <script type='text/javascript'>
    $(document).ready(function(){
        // $('.product-info').addClass('tooltip');
        // $('.product-info').append('<span class=\"tooltiptext\">Tooltip text</span>');
    });
    </script>
    ";
    // return $html;
}
});