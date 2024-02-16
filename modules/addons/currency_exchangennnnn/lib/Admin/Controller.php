<?php

namespace WHMCS\Module\Addon\currency_exchange\Admin;

use WHMCS\Module\Addon\currency_exchange\Helper;
use WHMCS\Database\Capsule;
use Smarty;


class Controller {
     public $tplFileName;
     public $params;
     public $smarty;
     public $tplVar = array();
     public $message = [];
    public function __construct()
    {
        global $CONFIG;
        $this->tplVar['rootURL'] = $CONFIG["SystemURL"];
        $this->tplVar['urlPath'] = $CONFIG["SystemURL"] . "/modules/addons/{$params['module']}/";
        $this->tplVar['tplDIR'] = ROOTDIR . "/modules/addons/currency_exchange/templates/admin/";
        $this->tplVar['jsonData'] = ROOTDIR . "/resources/country/dist.countries.json";
    }

    public function dashboard($vars)
    {
     try{
        global $whmcs;
        $helper = new Helper();
        if(isset($_POST['Save'])){
            $validation = $helper->insertCode($_POST);
            $this->tplVar['Validation'] = $validation;
        }
    $currencyCode = $helper->currencyDropDown();
    $filePath = $this->tplVar['jsonData'];
    $json_data = file_get_contents($filePath);
    if ($json_data === false) {
        die('Error reading JSON file');
    }
    $countryCode = json_decode($json_data, true);
    
    if ($countryCode === null) {
        die('Error decoding JSON data');
    }
    $custumData = Capsule::table('currency_exchange')->get();
    $this->tplVar['exchangeCountry'] = $custumData[0]->cuntryId;
    $this->tplVar['exchangeCurrency'] = $custumData[0]->currencyId;
    $this->tplVar['currencyCode'] = $currencyCode;
    $this->tplVar['countryCode'] = $countryCode;
        $this->tplFileName = __FUNCTION__;
        $this->output();
    } catch (\Exception $e) {
        logActivity("Error In Controller dashboard" . $e->getMessage());
    }
    }

    private function output()
    {
        try{
        $this->smarty = new Smarty();
        $this->smarty->assign('tplVar', $this->tplVar);
        $this->smarty->assign('fileName', $this->tplFileName);
        if (!empty($this->tplFileName)) {
            $this->smarty->display($this->tplVar['tplDIR'] . $this->tplFileName . '.tpl');
        } else {
            $this->tplVar['errorMsg'] = 'not found';
            $this->smarty->display($this->tplFileName . 'error.tpl');
        }
    } catch (\Exception $e) {
        logActivity("Error In Controller Output" . $e->getMessage());
    }
    }
    }