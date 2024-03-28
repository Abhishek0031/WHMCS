<?php

use WHMCS\Module\Addon\exchange_currency\Helper;
use WHMCS\Database\Capsule;

require("../../../../init.php");
require("../../../../includes/clientfunctions.php");
require("../../../..//includes/domainfunctions.php");




if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
$helper = new Helper();
if($_POST['ajaxMethdos']  === 'getTable'){
    $helper->getTableData($_POST);
}

    if($_POST['ajaxMethdos']  === 'GetCurrency'){
     $helper->GetAllCurrency();
    }
    

    if ($_POST['AjaxCheck'] === 'step3Ajax') {
        $array = $_POST;
        $viewStepData = $helper->viewSelectedValue($array);
        echo json_encode($viewStepData);
        exit;
    }


if ($_POST['AjaxCheck'] === 'performUpdate') {
$performUpdate = $helper->updatePrice($_POST);   
    echo json_encode($performUpdate);
    exit;
}

