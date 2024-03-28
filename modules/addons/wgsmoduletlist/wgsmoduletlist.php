<?php


use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\wgsmoduletlist\Admin\AdminDispatcher;
use WHMCS\Module\Addon\wgsmoduletlist\Client\ClientDispatcher;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}


function wgsmoduletlist_config()
{
    return [
        // Display name for your module
        'name' => 'Modules list',
        // Description displayed within the admin interface
        'description' => 'WGS modules and features list',
        // Module author name
        'author' => 'WGS',
        // Default language
        'language' => 'english',
        // Version number
        'version' => '1.0',
        'fields' => [
            'DeleteTable' => [
                'FriendlyName' => 'Delete Table',
                'Type' => 'yesno',
                'Description' => 'Tick to enable',
            ],
        ]
    ];
}


function wgsmoduletlist_activate()
{
    try {
            if (!Capsule::Schema()->hasTable('mod_wgsmodulelist_modules')) {

                Capsule::schema()->create(
                    'mod_wgsmodulelist_modules',
                    function ($table) {
                        $table->increments('id');
                        $table->string('module_name');
                        $table->string('friendly_name');
                        $table->string('type');
                        $table->string('description');
                        $table->string('download_links');
                        $table->string('Version');
                        $table->string('logo');
                        $table->integer('newlaunch');
                    }
                );
            }
            if (!Capsule::Schema()->hasTable('mod_prodashboard_modules')) {

                Capsule::schema()->create(
                    'mod_prodashboard_modules',
                    function ($table) {
                        $table->increments('id');
                        $table->integer('p_id');
                        $table->string('m_id');
                        $table->timestamps();
                    }
                );
            }
            
            
            if(!Capsule::Schema()->hasTable('mod_wgsmodulelist_modules_description')){
                
                Capsule::schema()->create(
                    
                    'mod_wgsmodulelist_modules_description',
                function ($table){
                      $table->increments('id');
                    $table->text('description');
                }
                );
            }
            return [
                // Supported values here include: success, error or info
                'status' => 'success',
                'description' => 'This is a WGS modules only. ',
            ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            'status' => "error",
            'description' => 'Unable to create mod_wgsmoduletlist: ' . $e->getMessage(),
        ];
    }
}


function wgsmoduletlist_deactivate()
{
    // Undo any database and schema modifications made by your module here
    try {
        $deleteDbTable = Capsule::table('tbladdonmodules')->where('module', 'wgsmoduletlist')->where('setting', 'DeleteTable')->value('value');

        if ($deleteDbTable == 'on') {
            $tables = ['mod_prodashboard_modules','mod_wgsmodulelist_modules'];
            foreach ($tables as $value) {
                Capsule::schema()->dropIfExists($value);
            }

            // Capsule::schema()->dropIfExists('mod_wgsmodulelist_modules');
            //Capsule::schema()->dropIfExists('mod_knowledgebase_cat');

        }
        return [
            'status' => 'success',
            'description' => 'This is a WGS modules only. ',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            "status" => "error",
            "description" => "Unable to drop mod_wgsmoduletlist: {$e->getMessage()}",
        ];
    }
}


function wgsmoduletlist_output($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. wgsmoduletlists.php?module=wgsmoduletlist
    $version = $vars['version']; // eg. 1.0
    $_lang = $vars['_lang']; // an array of the currently loaded language variables

    // Get module configuration parameters
    $configTextField = $vars['Text Field Name'];
    $configPasswordField = $vars['Password Field Name'];
    $configCheckboxField = $vars['Checkbox Field Name'];
    $configDropdownField = $vars['Dropdown Field Name'];
    $configRadioField = $vars['Radio Field Name'];
    $configTextareaField = $vars['Textarea Field Name'];

    // Dispatch and handle request here. What follows is a demonstration of one
    // possible way of handling this using a very basic dispatcher implementation.
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';





    $dispatcher = new AdminDispatcher();
   
    $response = $dispatcher->dispatch($action, $vars);
    echo $response;
}



