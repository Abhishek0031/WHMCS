<?php


use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\wgsproductlist\Admin\AdminDispatcher;
use WHMCS\Module\Addon\wgsproductlist\Client\ClientDispatcher;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}


function wgsproductlist_config()
{
    return [
        // Display name for your module
        'name' => 'WGS Products list',
        // Description displayed within the admin interface
        'description' => 'WGS Products and features list',
        // Module author name
        'author' => 'WGS',
        // Default language
        'language' => 'english',
        // Version number
        'version' => '1.0',
        'fields' => [
            // a text field type allows for single line text input
            'Text Field Name' => [
                'FriendlyName' => 'Text Field Name',
                'Type' => 'text',
                'Size' => '25',
                'Default' => 'Default value',
                'Description' => 'Description goes here',
            ],
            // a password field type allows for masked text input
            'Password Field Name' => [
                'FriendlyName' => 'Password Field Name',
                'Type' => 'password',
                'Size' => '25',
                'Default' => '',
                'Description' => 'Enter secret value here',
            ],
            // the yesno field type displays a single checkbox option
            'Checkbox Field Name' => [
                'FriendlyName' => 'Checkbox Field Name',
                'Type' => 'yesno',
                'Description' => 'Tick to enable',
            ],
            // the dropdown field type renders a select menu of options
            'Dropdown Field Name' => [
                'FriendlyName' => 'Dropdown Field Name',
                'Type' => 'dropdown',
                'Options' => [
                    'option1' => 'Display Value 1',
                    'option2' => 'Second Option',
                    'option3' => 'Another Option',
                ],
                'Default' => 'option2',
                'Description' => 'Choose one',
            ],
            // the radio field type displays a series of radio button options
            'Radio Field Name' => [
                'FriendlyName' => 'Radio Field Name',
                'Type' => 'radio',
                'Options' => 'First Option,Second Option,Third Option',
                'Default' => 'Third Option',
                'Description' => 'Choose your option!',
            ],
            // the textarea field type allows for multi-line text input
            'Textarea Field Name' => [
                'FriendlyName' => 'Textarea Field Name',
                'Type' => 'textarea',
                'Rows' => '3',
                'Cols' => '60',
                'Default' => 'A default value goes here...',
                'Description' => 'Freeform multi-line text input field',
            ],
        ]
    ];
}


function wgsproductlist_activate()
{
    // Create custom tables and schema required by your module
    try {
        
        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success or instruct a '
                    . 'user how to get started with it here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            'status' => "error",
            'description' => 'Unable to create mod_addonexample: ' . $e->getMessage(),
        ];
    }
}


function wgsproductlist_deactivate()
{
    // Undo any database and schema modifications made by your module here
    try {
       

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            "status" => "error",
            "description" => "Unable to drop mod_addonexample: {$e->getMessage()}",
        ];
    }
}


function wgsproductlist_output($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. wgsproductlists.php?module=wgsproductlist
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

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

    $dispatcher = new AdminDispatcher();
    $response = $dispatcher->dispatch($action, $vars);
    echo $response;
}



