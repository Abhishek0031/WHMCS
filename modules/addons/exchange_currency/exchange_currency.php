<?php

use WHMCS\Module\Addon\exchange_currency\Admin\AdminDispatcher;
use WHMCS\Module\Addon\exchange_currency\Helper;

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function exchange_currency_config()
  {
      return [
              'name' => 'Currency Exchange Module',
              'description' => 'This module is use to exchange currency',
              'author' => '<a href="http://whmcsglobalservices.com/" target="_blank"><img src="../modules/addons/exchange_currency/assets/image/wgs-logo.svg" alt="WHMCS GLOBAL SERVICES"  width="150"></a>',
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


function exchange_currency_output($vars){
try{
    $whmcs = WHMCS\Application::getInstance();
    $action = !empty($whmcs->get_req_var("action")) ? $whmcs->get_req_var("action") : 'dashboard';
    $dispatcher = new AdminDispatcher(); 
    $response = $dispatcher->dispatch($action, $vars);
} catch (\Exception $e) {
    return ['status' => "error", 'description' => 'Somting Went Wrong In Module' . $e->getMessage(),];
}
}