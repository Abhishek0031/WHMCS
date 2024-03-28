<?php

use WHMCS\Module\Addon\agency_dashboard_pro\Helper;
use WHMCS\Database\Capsule;

require("../../../../init.php");

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
global $whmcs;
$helper = new Helper();

if ($whmcs->get_req_var('AjaxCheck') === 'licenceKeyCheck') {
    $licenceKey = $_POST['licenceKeyValue'];
    $licenceResponce = $helper->checkLicence($licenceKey);
    if($licenceResponce['status'] == 'Active')
    {
            if ( ( Capsule::table( 'mod_agencylicence_list' )->where( 'licensekey', $licenceKey )->count() ) !== 0 ) {
                $updatedData = [
                    'status' => $licenceResponce[ 'status' ],
                    'updated_at' => date( 'Y-m-d H:i:s', time() )
                ];
                $result = Capsule::table( 'mod_agencylicence_list' )->where( 'licensekey', $licenceKey )->update( $updatedData );
            } else {

                $insertData = [
                    'licensekey' => $licenceKey,
                    'status' => $licenceResponce[ 'status' ],
                    'created_at' => date( 'Y-m-d H:i:s', time() ),
                    'updated_at' => date( 'Y-m-d H:i:s', time() )
                ];

                $result =  Capsule::table( 'mod_agencylicence_list' )->insert( $insertData );
            }        
    }
    $liceStatus = array('status' => $licenceResponce['status']);
    echo json_encode($liceStatus);
    die;

// here we can check the license From $licenceResponce = $helper->checkLicence($array); 
// when we add dynamic product

    if($_POST['licenceKeyValue'] === 'valid'){
    $productlistingData = $helper->productListing();
    $licenceResponce = array_merge($licenceResponce,$productlistingData);
    }
    echo json_encode($licenceResponce);
    exit;
}

if($_POST['AjaxCheck'] === 'checkProductInstallation'){

    $productlistingData = $helper->checkProductInstallation();
    echo json_encode($productlistingData);
    exit;
}

if($_POST['AjaxCheck'] === 'installModule'){

    $res = json_decode(html_entity_decode($_POST['moddata']));

    $filedownload_url = $_POST['downloadlink'];
    // $respo = $helper->downloadfile($filedownload_url);

    $finalRes = $helper->checkmodinstalled_tbl($filedownload_url,$res);
    echo json_encode($finalRes);
    exit;
}

if($_POST['AjaxCheck'] === 'slugCheck'){
    if(isset($_POST['fieldValue'])) {
        $string = $_POST['fieldValue'];
        $slugResult = $helper->checkSlugValidation($string);
        echo json_encode($slugResult);
        exit;
    }
}


if($_POST['AjaxCheck'] === 'createGroup'){
    $orderFormArray = $helper->getOrderformTemplate();
    $paymentMethods = $helper->getPaymentMethods();
   $html .= $helper->serverModulePrdGroupHtml($orderFormArray,$paymentMethods);
   echo $html;
}

if($_POST['AjaxCheck'] === 'createProduct'){
    // echo "product listing";
    $getProductGroup = $helper->getProductGroup();
    // echo "<pre>";
    // print_r($getProductGroup);

   $html .= $helper->serverModuleProductHtml($getProductGroup);
   echo $html;
}

// if($_POST['AjaxCheck'] === 'createProduct'){
//     if(isset($_POST['fieldValue'])) {
//         $string = $_POST['fieldValue'];
//         $slugResult = $helper->checkSlugValidation($string);
//         echo json_encode($slugResult);
//         exit;
//     }
// }

