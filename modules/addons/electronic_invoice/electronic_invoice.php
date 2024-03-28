<?php


use WHMCS\Database\Capsule;



if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function electronic_invoice_config()
{

    return [
        'name' => 'Electronic Invoice',
        'description' => 'This module provides to download xml file of paid invoice',
        'author' => '<a href="http://whmcsglobalservices.com/" target="_blank"><img src="/modules/addons/electronic_invoice/assests/img/whmcsglobalservices.svg" alt="WHMCS GLOBAL SERVICES"  width="150"></a>',
        'language' => 'english',
        'version' => '1.0',
        'fields' => [
            'registration_name' => [
                'FriendlyName' => 'Seller Registration Name',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your Registration Name Here',
            ],
            'registration_email' => [
                'FriendlyName' => 'Seller Registration Email',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your Registration Email Here',
            ],
            'identification_code' => [
                'FriendlyName' => 'Seller Identification Code',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your Identification Code Here',
            ],
            'tax_company_id' => [
                'FriendlyName' => 'Seller Tax Scheme Company ID',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your Tax Scheme Company ID Here',
            ],
            'legalentity_company_id' => [
                'FriendlyName' => 'Seller Legal Entity Company ID',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your Legal Entity Company ID Here',
            ],
            'postal_zone' => [
                'FriendlyName' => 'Seller PostalZone',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your PostalZone Here',
            ],
            'telephone' => [
                'FriendlyName' => 'Seller Telephone',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your Telephone Here',
            ],
            'street_name' => [
                'FriendlyName' => 'Seller Street Name',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your Street Name Here',
            ],
            'city_name' => [
                'FriendlyName' => 'Seller City Name',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your City Name Here',
            ],
            'country_subentity' => [
                'FriendlyName' => 'Seller Country Subentity',
                'Type' => 'text',
                'Size' => '25',
                'Description' => 'Enter Your Country Subentity Here',
            ],

        ]
    ];
}


function electronic_invoice_activate()
{
    try {
        return [
            'status' => 'success',
            'description' => 'This is a electronic invoice module Activated Successfully. ',
        ];
    } catch (\Exception $e) {
        return [

            'status' => "error",
            'description' => 'Unable to : module Activated' . $e->getMessage(),
        ];
    }
}


function electronic_invoice_deactivate()
{
    try {
        return [
            'status' => 'success',
            'description' => 'This is a electronic invoice module Deactivated Successfully. ',
        ];
    } catch (\Exception $e) {
        return [

            "status" => "error",
            "description" => "Unable to module Deactivated: {$e->getMessage()}",
        ];
    }
}
