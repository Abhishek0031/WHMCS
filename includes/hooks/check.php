<?php

use WHMCS\Database\Capsule;
use \WHMCS\Module\RegistrarSetting;

// $data = Capsule::table('tblbannedips')->delete();
// print_r($data);
// die;
// if(file_exists("../../init.php")){

//     require "../../init.php";
// } else{
//     echo 'ndsmn';
// }
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('AdminAreaFooterOutput', 1, function ($vars) {



// $data = Capsule::table('tblpaymentgateways')
// ->select('gateway')
// // ->where('setting','visible')
// ->distinct()
// ->get();
// echo "<pre>";

// print_r($data);
// die;

//     RegistrarSetting::insert(
//         [
//             'registrar' => 'kakaka',
//             'setting' => 'myfield',
//             'value' => encrypt('hiiiii')
//         ]);
//         echo '<pre>';
//     $setting = RegistrarSetting::get();
//     echo ($setting.'1111');
//     // die;
// // $value = decrypt('fo4w1aLayc75QtLWzt5fcs0BKi0=');
// print_r(json_decode($setting));
// die;

    
// $strong = 'jiiiiii';
// echo hash('sha256', 'Welcome to Tutorialspoint');
// $key_size = 32; // 256 bits
// $encryption_key = openssl_random_pseudo_bytes($key_size, $strong);
// echo $encryption_key;
// $command = 'DecryptPassword';
// $postData = array(
//     'password2' => 'l2Ld9Tpn63+PHhs1ko2WMkWhZe4=',
// );
// $results = localAPI($command, $postData);
// print_r($results);
// die;





    // Encrypted string
    // $encryptedString = "fwSHUkH69jiozM3+E8uQ4QyxHPRj8xwHQSSWgX+GcQ==";
    // $key = "your_decryption_key_here"; // Replace "your_decryption_key_here" with your actual decryption key
    
    // // Algorithm
    // $algorithm = "aes-256-cbc"; // Assuming AES with 256-bit key and CBC mode was used for encryption
    
    // // Initialization vector
    // $iv = base64_decode("Your_IV_Here"); // Replace "Your_IV_Here" with your actual IV
    
    // // Decrypt the string
    // $decryptedString = openssl_decrypt(base64_decode($encryptedString), $algorithm, $key, OPENSSL_RAW_DATA, $iv);
    
    // if ($decryptedString === false) {
    //     echo "Decryption failed: " . openssl_error_string();
    // } else {
    //     echo "Decrypted string: " . $decryptedString;
    // }
    
   
    
    // die;





    // function isExtensionAllowedUpload($filename){
    //     if (strpos($filename, ".") === 0) {
    //         return 'false';
    //     }
                    

    //     $alwaysBannedExtensions = array("php", "cgi", "pl", "htaccess");
    //     $filenameParts = pathinfo($filename);

    //     $fileExtension = strtolower($filenameParts["extension"]);
    //     if (in_array($fileExtension, $alwaysBannedExtensions)) {
    //         return 'false';
    //     }else{
    //         return 'true';
    //     }
    // }

    // $checkFileTy = isExtensionAllowedUpload('abc.php');

    // // $checkFileTy = isExtensionAllowedUpload($FILES[$uploadingTarget]["tmp_name"]);
    // if(!$checkFileTy){
    //     $message = "Sorry, only JPG, JPEG, PNG, SVG, ICO & WEBP files are allowed.";
    //     $uploadOk = 0;
    //     $response = ["status" => "error","msg" => $message];
    //     return $response;
    // }


//     $directoryfile = dirname(dirname(__DIR__)). '/modules/servers/globalsignssl/globalsignssl.php';
    
//     if(file_exists($directoryfile))
//     {

//         require_once $directoryfile;
//         // $confList = 'cpanel_ConfigOptions';
//         $confList = globalsignssl_ConfigOptions([]);

//         // $data = Capsule::table('tbladdonmodules')->get();
//         echo '<pre>';
//         // print_r($data);
//         print_r($confList);
//         die;
// }
//     print_r($directoryfile);
//     die;




    // $command = 'GetModuleConfigurationParameters';
    // $postData = array(
    //     'moduleType' => 'registrar',
    //     'moduleName' => 'godaddy',
    // );                    
    // $results = localAPI($command, $postData);
    // echo '<pre>kkkk';
    // // print_r($results);
    // $array = [];
    // foreach($results['parameters'] as $item){
    //     $array[$item['name']] = [
    //         'displayName' => $item['displayName'],
    //         'fieldType' => $item['fieldType'],
    //     ];
    // }
    // print_r($array);
    // die;
//     echo "<pre>";
//     print_r($vars);
// die;

// $array = array(
//     'moduleName' => 'guestinvoices',
//     'license_key' => 'jjjjj',
//     'remove_database' => '',
//     'access' => array(
//         0 => 1,
//         1 => 2
//     ),
//     'saveConfig' => 'Save'
// );

// $moduleName = $array['moduleName'];

// foreach ($array as $key => $item) {
//     if ($key == 'moduleName' || $key == 'saveConfig') {
//         continue;
//     }

//     if ($key == 'access') {
//         $item = implode(",", $item);
//     }

//     $existingRecord = Capsule::table('tbladdonmodules')
//         ->where('module', $moduleName)
//         ->where('setting', $key)
//         ->first();

//     if (!$existingRecord) {
//         Capsule::table('tbladdonmodules')->insert(
//             [
//                 'module' => $moduleName,
//                 'setting' => $key,
//                 'value' => $item
//             ]
//         );
//     } else {
//         Capsule::table('tbladdonmodules')
//             ->where('module', $moduleName)
//             ->where('setting', $key)
//             ->update(
//                 [
//                     'value' => $item
//                 ]
//             );
//     }
// }

// die;







    // $directory = '../modules/addons/';
    // $array = [];
    //     if (is_dir($directory)) {
    //         $files = scandir($directory);
    //     $count = 0;
    //         foreach ($files as $file) {
    //             if (is_dir($directory . $file) && $file != '.' && $file != '..') {
    //                 $array[$count++] = $file;
    //             }
    //         }
    //     } else {
    //         echo "Directory not found: $directory <br>";
    //     }
    //     echo "<pre>";
    //     print_r($array);
    // die;
//     try {
//         $filename = basename($_SERVER['SCRIPT_NAME']);
//         if ($vars['pagetitle'] === "Apps & Integrations" && $vars['filename'] === "index") {
//             $htmlStyle = ".powered-by {
//                 display: inline;
//                 font-size: 18px;
//             }";
//             $htmlJquery = "
//                 var htmlText = '<div class=\"powered-by\">Powered by <span class=\"ChangeColor\"> <b>GreenClick </b></span> MARKETPLACE.</div>';
//                 $('.hidden-xs.hidden-sm').html(htmlText);";
//         } elseif ($vars['pagetitle'] === "System Settings") {
//             $htmlStyle = "";
//             $htmlJquery = "                
//                 var htmlText = 'Set up & configure your <span class=\"ChangeColor\"><b> GreenClick </b></span> MarketPlace.';
//                 $('.lead').html(htmlText);";
//         } elseif ($filename === "update.php") {
//             $htmlJquery = "   
//                 $('#contentarea div h1').html('Update <span class=\"ChangeColor\"><b> GreenClick </b></span> Platform'); 
//             ";
//         }
//         $html = "<style>
//             #wizardStep0 .wizard-transition-step .title {
//                 font-size: 40px;
//             }

//             .ChangeColor {
//                 color: rgb(89, 194, 122);
//             }" . $htmlStyle . "
//             </style>
//             <script type='text/javascript'>
//             $(document).ready(function(){
//                 $('#Menu-Utilities-Update').html('Update <span class=\"ChangeColor\"><b> GreenClick </b></span>'); 
//                 $('#Menu-Utilities-WHMCS_Connect').html('<span class=\"ChangeColor\"><b> GreenClick </b></span> Connect'); 
//                     $('#Menu-Config-SetupWizard').click(function(){
//                         var myInterval = setInterval(function() {
//                             var textdata = $('#wizardStep0 .wizard-transition-step .title').text();
//                             if (textdata !== 'Welcome to  GreenClick! ') {
//                                 // console.log(textdata.replace(/ /g, '_'));
//                                 var text = 'Welcome to <span class=\"ChangeColor\"><b> GreenClick! </b></span>';
//                                 $('#wizardStep0 .wizard-transition-step .title').html(text); 
//                             } else {
//                                 clearInterval(myInterval);
//                                 myInterval = null;
//                             }
//                         }, 100);
//                     });
//                 " . $htmlJquery . "
//             });
//             </script>";
//         return $html;
//     } catch (\Exception $e) {
//         logActivity("Error GreenClick Text Hook" . $e->getMessage());
//     }
// });


// add_hook('ShoppingCartCheckoutCompletePage', 1, function($vars) {
//     echo"<pre>";
//     print_r($vars);
//     die;
//     // return [
//     //     'Error message feedback error 1',
//     //     'Error message feedback error 2',
//     // ];
});
