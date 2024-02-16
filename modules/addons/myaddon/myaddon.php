<?php

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\MyAddon\Client\ClientDispatcher;
use WHMCS\Module\Addon\MyAddon\Class\mymodule as classAddonObject;

  if (!defined("WHMCS")) {
      die("This file cannot be accessed directly");
  }
  require_once('class/class.php');

  /**
   * Define addon module configuration parameters.
   *
   * Includes a number of required system fields including name, description,
   * author, language and version.
   *
   * Also allows you to define any configuration parameters that should be
   * presented to the user when activating and configuring the module. These
   * values are then made available in all module function calls.
   *
   * Examples of each and their possible configuration parameters are provided in
   * the fields parameter below.
   *
   * @return array
   */
  //Admin@123$#
   
  function myaddon_config()
  {
      return [
          // Display name for your module
              'name' => 'myaddon',
              // Description displayed within the admin interface
              'description' => 'This module provides an example WHMCS Addon Module'
                  . ' which can be used as a basis for building a custom addon module.',
              // Module author name
              'author' => 'whmcs',
              // Default language
              'language' => 'english',
              // Version number
              'version' => '1.0',
      ];
  }

    function myaddon_output($var){
        $mymoduleObject=new classAddonObject();
        $postData = $_POST;
        if($_POST['ajaxMethdos'] === "true"){
            $mymoduleObject->getMenu($_POST);  
            exit;
        } elseif($_POST['ajaxCheck'] === "navDropDown"){
            $mymoduleObject->getNavMenu($_POST);  
            exit;
        }
        include('page/homepage.php'); 
    }

  function myaddon_clientarea($vars) {
    $mymoduleObject = new classAddonObject();
    // $clientData = $mymoduleObject->clientGet();
    $jspath = "modules/addons/myaddon/templates/js/";
    if($_POST['ajaxMethdos'] === "true"){
         $mymoduleObject->clientGet($_POST);  
        // print_r($val);
        exit;
    }
    return array(
        'pagetitle' => 'myaddon',
        'breadcrumb' => array(
            'index.php?m=myaddon' => 'myaddon',
            // 'index.php?m=myaddon&action=secret' => 'Secret Page',
        ),
        'templatefile' => 'clienthome',
        'requirelogin' => true, // Set true to restrict access to authenticated client users
        'forcessl' => false, // Deprecated as of Version 7.0. Requests will always use SSL if available.
        'vars' => array( 
            'jspath' => $jspath,
        ),
    );   
  }

    function myaddon_activate() {

        $custumfeildArray = [  
            [
                'fieldname' => 'exchangeCurrency|Agree Exchange Currency',
                'fieldtype' => 'tickbox',
                'description' => 'I am aware of this price exchange.',
                'regexpr' => '',
                'type' => 'client',
                'relid' => '',
                'showinvoice' => '',
                'showorder' => 'on',
                'required' => 'on',
                'adminonly' => ''
            ],
        ];

        foreach ($custumfeildArray as $element) {
            $CheckFieldName = explode('|', $element['fieldname'])[0] . '%';
            $checkCount = count(
                Capsule::table('tblcustomfields')
                    ->where([
                        ['fieldname', 'like', $CheckFieldName],
                        ['type', $element['type']]
                    ])->get()
            );

            if ($checkCount == 0) {
                Capsule::table("tblcustomfields")->insert($element);
            }
        }




        // try {
        //     Capsule::Schema()->create(
        //         'mod_menu_manager',
        //         function($table){
        //             $table->increments('id');
        //             $table->integer('parent_id')->nullable();
        //             $table->string('menu_name')->unique();
        //             $table->string('menu_url');
        //             $table->enum('menu_type',['parent_menu', 'sub_menu','child_menu'])->default('parent_menu');
        //             $table->string('icon')->nullable();
        //             $table->string('menu_class')->nullable();
        //             $table->enum('status',['Active', 'Inactive'])->default('Active');
        //             $table->timestamps();
        //         }
        //     );
        //     return [
        //         // Supported values here include: success, error or info
        //         'status' => 'success',
        //         'description' => 'table created successfully ',
        //     ];
        // } catch (\Exception $e) {
        //     return [
        //         // Supported values here include: success, error or info
        //         'status' => "error",
        //         'description' => 'Unable to create mod_menu_manager: ' . $e->getMessage(),
        //     ];
        // }    
    }
        

?>