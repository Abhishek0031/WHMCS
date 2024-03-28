<?php

namespace WHMCS\Module\Addon\pay_to_address\Admin;

use WHMCS\Module\Addon\pay_to_address\Helper;
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
        $this->tplVar['tplDIR'] = ROOTDIR . "/modules/addons/pay_to_address/templates/admin/";
        $this->tplVar['jsonData'] = ROOTDIR . "/resources/country/dist.countries.json";
        $this->tplVar['imgPath'] = $CONFIG["SystemURL"] . "/modules/addons/pay_to_address/assets/image/wgs-logo.svg";

    }

    public function dashboard($vars)
    {
     try{
        global $whmcs;

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