<?php

use WHMCS\Module\Addon\exchange_currency\Helper;
use WHMCS\Database\Capsule;

require("../../../../init.php");
require("../../../../includes/clientfunctions.php");
require("../../../..//includes/domainfunctions.php");

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

global $whmcs;
$whmcs->get_req_var('note');
$helper = new Helper();
    if($whmcs->get_req_var('ajaxMethdos')  === 'getTable'){
        $helper->getTableData($_POST);
    }

    if($whmcs->get_req_var('ajaxMethdos')  === 'GetCurrency'){
     $helper->GetAllCurrency();
    }
    
    if ($whmcs->get_req_var('AjaxCheck') === 'step3Ajax') {
        $array = $_POST;
        $viewStepData = $helper->viewSelectedValue($array);
        echo json_encode($viewStepData);
        exit;
    }

    if ($whmcs->get_req_var('AjaxCheck') === 'performUpdate') {
    $performUpdate = $helper->updatePrice($_POST);   
        echo json_encode($performUpdate);
        exit;
    }

