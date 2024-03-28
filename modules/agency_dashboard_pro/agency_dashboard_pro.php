<?php

use WHMCS\Module\Addon\agency_dashboard_pro\Admin\AdminDispatcher;
use WHMCS\Module\Addon\agency_dashboard_pro\Helper;
use \WHMCS\Module\RegistrarSetting;

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function agency_dashboard_pro_config()
  {
      return [
              'name' => 'Agency Dashboard Pro',
              'description' => 'This module is use to exchange currency',
              'author' => '<a href="http://whmcsglobalservices.com/" target="_blank"><img src="../modules/addons/agency_dashboard_pro/assets/image/wgs-logo.svg" alt="WHMCS GLOBAL SERVICES"  width="150"></a>',
              'language' => 'english',
              'version' => '1.0',
              'fields' => [
                  'delete_db' => [
                      'FriendlyName' => 'Delete Database Table',
                      'Type' => 'yesno',
                      'Description' => 'Tick this box to delete the Agency Dashboard Pro addon module database table when deactivating the module.',
                  ]
              ]
        ];
  }




function agency_dashboard_pro_activate(){

    try {
        if (!Capsule::schema()->hasTable('mod_agencylicence_list')) {
            Capsule::schema()->create('mod_agencylicence_list', function ($table) {
                $table->increments('id');
                $table->string('licensekey');
                $table->string('status');
                $table->timestamps();
            });
        }
        if (!Capsule::Schema()->hasTable('mod_agencydashboard_installed')) {
            Capsule::schema()->create(
                'mod_agencydashboard_installed',
                function ($table) {
                    $table->increments('id');
                    $table->string('module_name');
                    $table->string('type');
                    $table->string('version');
                    $table->timestamps();
                }
            );
        }
        }catch (Exception $e) {
            logActivity('fail to Create (mod_agencylicence_list) Table :' .$e->getMessage()); 
        }
}

function agency_dashboard_pro_deactivate(){
    try {
        $deleteDbTable = Capsule::table('tbladdonmodules')->where('module', 'agency_dashboard_pro')->where('setting', 'delete_db')->value('value');
        if ($deleteDbTable == 'on') {
            $tables = ['mod_agencylicence_list','mod_agencydashboard_installed'];
            foreach ($tables as $value) {
                Capsule::schema()->dropIfExists($value);
            }
        }
        return array('status' => 'success', 'description' => 'Deactivated successfully.');
    } catch (\Exception $e) {
        return ['status' => "error", 'description' => 'Unable to deactivate module: ' . $e->getMessage(),];
    }
}

function agency_dashboard_pro_output($vars){
    try{
        global $whmcs;   
        $action = !empty($whmcs->get_req_var("action")) ? $whmcs->get_req_var("action") : 'verifylicense';
        $checkLicense = Capsule::table( 'mod_agencylicence_list' )->where( 'status', 'Active')->count();
        if($checkLicense == 0){
            $action  = 'verifylicense';
        }
        if($checkLicense > 0 && empty($whmcs->get_req_var("action"))){
            $action = 'dashboard' ;
        }
        $checkLicenseList = Capsule::table( 'mod_agencylicence_list' )->where( 'status', 'Active')->first();
        $vars['license_key'] = $checkLicenseList->licensekey;
        $helper = new Helper();
        $vars['license_info'] = $helper->checkLicence($vars['license_key']);
        $zip = new ZipArchive;
        $_SESSION['zipclass'] =  $zip;

        $dispatcher = new AdminDispatcher(); 
        $response = $dispatcher->dispatch($action, $vars);
    } catch (\Exception $e) {
        return ['status' => "error", 'description' => 'Somting Went Wrong In Module' . $e->getMessage(),];
    }
}