<?php

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\TicketTag\Helper;
use WHMCS\Module\Addon\TicketTag\Admin\AdminDispatcher;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
} 

function ticket_tag_config()
{
    return [
        // Display name for your module
        'name' => 'Ticket Tag',
        // Description displayed within the admin interface
        'description' => 'Ticket Tag',
        // Module author name
        'author' => '<a href="http://whmcsglobalservices.com/" target="_blank"><img src="/modules/addons/electronic_invoice/assests/img/whmcsglobalservices.svg" alt="WHMCS GLOBAL SERVICES"  width="150"></a>',
        // Default language
        'language' => 'english',
        // Version number
        'version' => '1.0',
        'delete_db' => [
            'FriendlyName' => 'Delete Database Table',
            'Type' => 'yesno',
            'Description' => 'Tick this box to delete the addon module database table when deactivating the module.',
        ]
    ];
}

function ticket_tag_activate() 
{
    if (!Capsule::schema()->hasTable('mod_tag_manager')) {
    try {
        Capsule::schema()->create('mod_tag_manager', function ($table) {
            $table->increments('id');
            $table->string('tag_manager');
            $table->string('tag_color');
            $table->timestamps();
        }
    );
    }
        catch (Exception $e) {
        logActivity('Unable to Create Table  :' .$e->getMessage()); 
        }
    }

    if (!Capsule::schema()->hasTable('mod_assign_tag_ticket')) {
        try {
            Capsule::schema()->create('mod_assign_tag_ticket', function ($table) {

                $table->increments('id');
                $table->integer('tag_id');
                $table->integer('ticket_id');
                $table->string('tag_value');
                $table->timestamps();
            }
        );
    }
        catch (Exception $e) {
        logActivity('Unable to Create Table  :' .$e->getMessage());
        }
    }
}

function gohighlevel_deactivate()
{
    try {
        $deleteDbTable = Capsule::table('tbladdonmodules')->where('module', 'ticket_tag')->where('setting', 'delete_db')->value('value');

        if ($deleteDbTable == 'on') {
            $tables = array('mod_tag_manager');
            foreach ($tables as $value) {
                Capsule::schema()->dropIfExists($value);
            }
        }
        
        return array('status' => 'success', 'description' => 'Deactivated successfully.');
    } catch (\Exception $e) {
        return ['status' => "error", 'description' => 'Unable to deactivate module: ' . $e->getMessage(),];
    }
}

function ticket_tag_output($var)
{
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'dashboard';

  
    $dispatcher = new AdminDispatcher();

   
    $response = $dispatcher->dispatch($action, $var);

    echo $response;
}

?>