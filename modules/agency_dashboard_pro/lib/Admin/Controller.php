<?php

namespace WHMCS\Module\Addon\agency_dashboard_pro\Admin;

use WHMCS\Module\Addon\agency_dashboard_pro\Helper;
use WHMCS\Database\Capsule;
use Smarty;
// use \WHMCS\Module\RegistrarSetting;

$wgsResetEmailTemplate = "Password Reset Email";

class Controller {
     public $tplFileName;
     public $params;
     public $smarty;
     public $tplVar = array();
     public $message = [];
    public function __construct($vars)
    {
        global $CONFIG;
        
        // $this->tplVar['rootURL'] = $CONFIG["SystemURL"];
        // $this->tplVar['urlPath'] = $CONFIG["SystemURL"] . "/modules/addons/{$params['module']}/";
   
        $this->tplVar['license_key'] = $vars['license_key'];
        $this->tplVar['license_info'] = $vars['license_info'];
        $this->tplVar['productid'] = $vars['license_info']['productid'];
        // $this->tplVar['prod_ids'] = this->tplVar['license_info'][];
        $this->tplVar['tplDIR'] = ROOTDIR . "/modules/addons/agency_dashboard_pro/templates/admin/";
        $this->tplVar['imgPath'] = $CONFIG["SystemURL"] . "/modules/addons/agency_dashboard_pro/assets/image/wgs-logo.svg";
        $this->tplVar['header'] = ROOTDIR . "/modules/addons/agency_dashboard_pro/templates/admin/header.tpl";


    }

    public function verifylicense($vars)
    {
        try{
            global $whmcs;
            $this->tplFileName = __FUNCTION__;
           
            $this->output();
        } catch (\Exception $e) {
            logActivity("Error In Controller dashboard" . $e->getMessage());
        }
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

    public function productlist($vars)
    {

        try{
            global $whmcs;
            $this->tplFileName = __FUNCTION__;
            $helper = new Helper();

            if(isset($_POST['SaveProductGroupbtn'])){
                $fields =$_POST;
                $helper->storeProductGroupInTable($fields);
                // echo "<pre>";
                // print_r($_POST);
                // die;
            }
            if(isset($_POST['saveConfig'])){
                $fields =$_POST;
                // echo "<pre>";
                // print_r($_POST);
                // die;
                $result = $helper->saveConfigFields($fields);
                if($result['status'] == 'error'){
                   
                }

            }
            $moduleList = $helper->getModulesListApi($this->tplVar['productid']);
            $this->tplVar['tplProductList'] = $moduleList;
           
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