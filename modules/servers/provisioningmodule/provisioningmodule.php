<?php

use WHMCS\Database\Capsule;
use WHMCS\Module\servers\provisioningmodule\provisioningModuleClass; 

include('class/class.php');
$provisioning_obj = new provisioningmoduleClass();


function provisioningmodule_MetaData()
{
    return array(
        'DisplayName' => 'Provisioning',
        'APIVersion' => '1.1', // Use API Version 1.1
        'RequiresServer' => true, // Set true if module requires a server to work
        'DefaultNonSSLPort' => '1111', // Default Non-SSL Connection Port
        'DefaultSSLPort' => '1112', // Default SSL Connection Port
        'ServiceSingleSignOnLabel' => 'Login to Panel as User',
        'AdminSingleSignOnLabel' => 'Login to Panel as Admin',
    );
}   

function provisioningmodule_ConfigOptions()
{
    $provisioning_obj = new provisioningmoduleClass();

    $provisioning_obj->createCustomField();
    
    return array(
        'WHM Pakage Name' => array(
            'Type' => 'text',
            'Size' => '25',
            'Default' => '1024',
            'Description' => '',
        ),
        'Max FTP Accounts' => array(
            'Type' => 'text',
            'Size' => '5',
            'Default' => '',
            'Description' => '',
        ),
        'Web space Quota' => array(
            'Type' => 'text',
            'Size' => '5',
            'Default' => '',
            'Description' => 'MB',
        ),
        'Max Emain Account' => array(
            'Type' => 'text',
            'Size' => '5',
            'Default' => '',
            'Description' => '',
        ),
        'Band Width Limit' => array(
            'Type' => 'text',
            'Size' => '5',
            'Default' => '',
            'Description' => 'MB',
        ),
        'Dedicated Id' => array(
            'Type' => 'yesno',
        ),
        'Shell Access' => array(
            'Type' => 'yesno',
            'Description' => 'Check To grant Access',
        ),
        // ... (and so on, continuing with the rest of the array elements)
        'Reseller Ownership' => array(
            'Type' => 'yesno',
            'Description' => 'Set the reseller own their own account',
        ),
    );
    
}

function provisioningmodule_CreateAccount(array $params)
{
    $clientFirstName = $params['clientsdetails']['firstname'];
    $clientLastName = $params['clientsdetails']['lastname'];
    $clientEmail = $params['customfields']['email'];
    $clientAddress = $params['clientsdetails']['address1'];
    $clientCity = $params['clientsdetails']['city'];
    $clientState = $params['clientsdetails']['state'];
    $clientPostCode = $params['clientsdetails']['postcode'];
    $clientCountry = $params['clientsdetails']['country'];
    $clientPhoneNo = $params['clientsdetails']['phonenumber'];
    $orderid = $params['clientsdetails']['phonenumber'];

    $command = 'AddClient';
    $postData = array(
        'firstname' => $clientFirstName,
        'lastname' => $clientLastName,
        'email' => $clientEmail,
        'address1' => $clientAddress,
        'city' => $clientCity,
        'state' => $clientState,
        'postcode' => $clientPostCode,
        'country' => $clientCountry,
        'phonenumber' => $clientPhoneNo,
        'password2' => 'user@123',
    );

    $results = localAPI($command, $postData);   

    $provisioning_obj = new provisioningmoduleClass();

    $provisioning_obj->CustomFieldValues($results,$params);

    if($results['result'] == 'error'){
        logModuleCall(
                    'provisioningmodule',
                    __FUNCTION__,
                    $params,
                    $results['result'],
                    $results['message']
                );
    }
    return 'success';
}


function provisioningmodule_SuspendAccount(array $params)
{    
    $clientId = $params['customfields']['id'];
    $updateClientParams = array(
                'clientid' => $clientId,
                'status' => 'Inactive'
            );
            $updateResult = localAPI('UpdateClient', $updateClientParams);
    
            if ($updateResult['result'] == 'success') {
                return 'success';
            } else {
                logActivity('Error updating client status: ' . $updateResult['message']);
                return 'error';
            }
}


function provisioningmodule_UnsuspendAccount(array $params)
{
    $clientId = $params['customfields']['id'];
    $updateClientParams = array(
                'clientid' => $clientId,
                'status' => 'Active'
            );
            
            $updateResult = localAPI('UpdateClient', $updateClientParams);
    
            if ($updateResult['result'] == 'success') {
                return 'success';
            } else {
                logActivity('Error updating client status: ' . $updateResult['message']);
                return 'error';
            }
}



function provisioningmodule_TerminateAccount(array $params)
{
    $clientId = $params['customfields']['id'];
    $command = 'DeleteClient';
    $postData = array(
        'clientid' => $clientId,
        'deleteusers' => true,
        'deletetransactions' => true,
    );
    
    $results = localAPI($command, $postData);
    $provisioning_obj = new provisioningmoduleClass();

    $provisioning_obj->deleteCustomFieldValue($params,$results);
    return 'success';

}


// function provisioningmodule_ChangePassword(array $params)
// {
//     $command = 'EncryptPassword'; 
//     $postData = array(
//         'password' => 'aaaaaaaa',
//     );
    
//     $results = localAPI($command, $postData);
//     $clientId = $params['customfields']['id'];
//     // print_r($results['password']);
//     // die;
//    if($results['result'] == 'success'){
//        $postData = array(
//            'clientid' => $clientId,
//            'password' => $results['password'],
//        );   
//         $results = localAPI('UpdateClient', $postData);
//         // print_r($insert);
//         // die;
//         return 'success';
//     }
// }


function provisioningmodule_ChangePassword(array $params)
{
    $passwordToEncrypt = 'Client@123$#';
    $encryptedPassword = localAPI('EncryptPassword', ['password' => $passwordToEncrypt]);

    if ($encryptedPassword['result'] === 'success') {
        $clientId = $params['customfields']['id'];
        // print_r($clientId);
        // die;
        $updateResult = localAPI('UpdateClient', [
            'clientid' => $clientId,
            'password2' => $encryptedPassword['password'], // Using 'password2' for WHMCS v8.x
        ]);

        return ($updateResult['result'] === 'success') ? 'success' : 'error updating password';
    }

    return 'error encrypting password';
}

?>

