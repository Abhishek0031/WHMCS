<?php

use WHMCS\Module\Addon\pay_to_address\Admin\AdminDispatcher;
use WHMCS\Module\Addon\pay_to_address\Helper;

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function pay_to_address_config()
  {
      return [
              'name' => 'Pay To Address Module',
            //   'description' => 'This module is use to exchange currency',
              'author' => '<a href="http://whmcsglobalservices.com/" target="_blank"><img src="../modules/addons/pay_to_address/assets/image/wgs-logo.svg" alt="WHMCS GLOBAL SERVICES"  width="150"></a>',
              'language' => 'english',
              'version' => '1.0',
              'fields' => [
                  'delete_db' => [
                      'FriendlyName' => 'Delete Database Table',
                      'Type' => 'yesno',
                      'Description' => 'Tick this box to delete the currencyExchange addon module database table when deactivating the module.',
                  ]
              ]
        ];
  }


function pay_to_address_output($vars){
try{
    $whmcs = WHMCS\Application::getInstance();
    $action = !empty($whmcs->get_req_var("action")) ? $whmcs->get_req_var("action") : 'dashboard';
    $dispatcher = new AdminDispatcher(); 
    $response = $dispatcher->dispatch($action, $vars);
} catch (\Exception $e) {
    return ['status' => "error", 'description' => 'Somting Went Wrong In Module' . $e->getMessage(),];
}
}