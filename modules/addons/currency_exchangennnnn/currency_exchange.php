<?php

use WHMCS\Module\Addon\currency_exchange\Admin\AdminDispatcher;
use WHMCS\Module\Addon\currency_exchange\Helper;

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function currency_exchange_config()
  {
      return [
              'name' => 'Currency Exchange',
              'description' => 'This module is use to exchange currency',
              'author' => '<a href="http://whmcsglobalservices.com/" target="_blank"><img src="../modules/addons/currency_exchange/assets/image/wgs-logo.svg" alt="WHMCS GLOBAL SERVICES"  width="150"></a>',
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


  function currency_exchange_activate() 
{
    try {
    $helper = new Helper();
    $helper->createCustomField();
    if (!Capsule::schema()->hasTable('currency_exchange')) {
        Capsule::schema()->create('currency_exchange', function ($table) {
            $table->increments('id');
            $table->string('cuntryId');
            $table->string('currencyId');
            $table->timestamps();
        });
    if (!Capsule::schema()->hasTable('currency_rate')) {
        Capsule::schema()->create('currency_rate', function ($table) {
            $table->increments('id');
            $table->string('invoiceId');
            $table->string('currencyId');
            $table->string('exchange_rate');
            $table->timestamps();
        });
    }
    }
    }catch (Exception $e) {
        logActivity('fail to Create (currency_exchange) Table :' .$e->getMessage()); 
    }
}


function currency_exchange_deactivate()
{
    try {
        $deleteDbTable = Capsule::table('tbladdonmodules')->where('module', 'currency_exchange')->where('setting', 'delete_db')->value('value');
        if ($deleteDbTable == 'on') {
            $tables = ['currency_exchange','currency_rate'];
            foreach ($tables as $value) {
                Capsule::schema()->dropIfExists($value);
            }
        }
        return array('status' => 'success', 'description' => 'Deactivated successfully.');
    } catch (\Exception $e) {
        return ['status' => "error", 'description' => 'Unable to deactivate module: ' . $e->getMessage(),];
    }
}



  function currency_exchange_output($vars){
try{
    $whmcs = WHMCS\Application::getInstance();
    $action = !empty($whmcs->get_req_var("action")) ? $whmcs->get_req_var("action") : 'dashboard';
    $dispatcher = new AdminDispatcher(); 
    $response = $dispatcher->dispatch($action, $vars);
} catch (\Exception $e) {
    return ['status' => "error", 'description' => 'Somting Went Wrong In Module' . $e->getMessage(),];
}
}