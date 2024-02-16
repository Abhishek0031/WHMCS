<?php

namespace WHMCS\Module\Addon\TicketTag\Admin;


use WHMCS\Module\Addon\TicketTag\Helper;
use WHMCS\Database\Capsule;
use Smarty;


class Controller {

    /**
     * Index action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */

     public $tplFileName;
     public $params;
     public $smarty;
     public $tplVar = array();
     public $message = [];
    public function __construct()
    {
        global $CONFIG;
        $this->params = $params;
        $this->tplVar['rootURL'] = $CONFIG["SystemURL"];
        $this->tplVar['urlPath'] = $CONFIG["SystemURL"] . "/modules/addons/{$params['module']}/";
        $this->tplVar['_lang'] = $params["_lang"];
        $this->tplVar['moduleLink'] = $params['modulelink'];
        $this->tplVar['module'] = $params['module'];
        $this->tplVar['license'] = $params['license'];
        $this->tplVar['license_key'] = $params['license_key'];
        $this->tplVar['version'] = $params['version'];
        $this->tplVar['license_key'] = $params['license_key'];
        $this->tplVar['tplDIR'] = ROOTDIR . "/modules/addons/ticket_tag/templates/admin/";
        $this->tplVar['header'] = ROOTDIR . "/modules/addons/ticket_tag/templates/admin/header.tpl";
        $this->tplVar['footer'] = ROOTDIR . "/modules/addons/ticket_tag/templates/admin/footer.tpl";
    }

    public function dashboard($vars)
    {      
    global $whmcs;
    $obj = new Helper();

    if ($whmcs->get_req_var('insert') == 'submit') {
        $tag_manager = $whmcs->get_req_var('tag_manager');
        $tag_color = $whmcs->get_req_var('tag_color');
        
        if (isset($tag_manager, $tag_color)) {
            $result = $obj->addTicketTag($tag_manager, $tag_color);
            $this->tplVar['insertMsg']= $result;
           
        }
        
    }
    
    // $this->tplVar['errorField']= $result;
    
    $result= $obj->showTicketTag();
        $this->tplVar['tag_manager_details']= $result;


        $this->tplFileName = __FUNCTION__;
        $this->output();
    }

    public function output()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('tplVar', $this->tplVar);
        $this->smarty->assign('fileName', $this->tplFileName);
  

     
        if (!empty($this->tplFileName)) {
            $this->smarty->display($this->tplVar['tplDIR'] . $this->tplFileName . '.tpl');
        } else {
            $this->tplVar['errorMsg'] = 'not found';
            $this->smarty->display($this->tplFileName . 'error.tpl');
        }
    }
    }