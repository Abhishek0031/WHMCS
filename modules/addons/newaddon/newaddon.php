<?php

use WHMCS\Database\Capsule;


  if (!defined("WHMCS")) {
      die("This file cannot be accessed directly");
  }
  // include('lib/Client/ClientDispatcher.php');
  // include('class/class.php');

  
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
  //Admin@123#
   
  function newaddon_config()
  {
      return [
          // Display name for your module
              'name' => 'newaddon',
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




  function newaddon_clientarea($vars) {
      $modulelink = $vars['modulelink'];
      $version = $vars['version'];
      $option1 = $vars['option1'];
      $option2 = $vars['option2'];
      $option3 = $vars['option3'];
      $option4 = $vars['option4'];
      $option5 = $vars['option5'];
      $option6 = $vars['option6'];
      $LANG = $vars['_lang'];
      return array(
          'pagetitle' => 'Addon Module',
          'breadcrumb' => array('index.php?m=newaddon' => 'In Addon'),
          'templatefile' => 'publicpage', // Updated to point to your custom template file
          'requirelogin' => true,
          'forcessl' => false,
          'vars' => array(
              'testvar' => 'newaddon',
              'anothervar' => 'value',
              'sample' => 'test',
          ),
      );
  }
?>