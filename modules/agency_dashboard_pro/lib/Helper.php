<?php

namespace WHMCS\Module\Addon\agency_dashboard_pro;

use WHMCS\Database\Capsule;
use \WHMCS\Module\Registrar;
use \WHMCS\Module\RegistrarSetting;

use WHMCS\Domains;

$dir =  dirname(dirname(dirname(dirname(__DIR__)))).'/includes/registrarfunctions.php';
if(file_exists($dir)){
    // echo $dir;
    // die;
    require_once $dir;
}

class Helper
{
    public function checkLicence($licensekey, $localkey = ""){

        $whmcsurl = "http://my.agency-portal.io/";
        $licensing_secret_key = 'Ascent@2024#%Q@F';
        $check_token = time() . md5(mt_rand(1000000000, 1e+010) . $licensekey);
        $checkdate = date("Ymd");
        $usersip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
        $localkeydays = 5;
        $allowcheckfaildays = 3;
        $localkeyvalid = false;
        /*for local key start*/
        $lkey = Capsule::table('tblconfiguration')->where('setting', 'agency_dashboard_pro_localkey')->get(); //add for local key
   
        if ($lkey) {
   
            $localkey = $lkey[0]->value;
        }
        /* for local key end */
        if ($localkey) {
   
            $localkey = str_replace("\n", "", $localkey);
   
            $localdata = substr($localkey, 0, strlen($localkey) - 32);
   
            $md5hash = substr($localkey, strlen($localkey) - 32);
   
            if ($md5hash == md5($localdata . $licensing_secret_key)) {
   
                $localdata = strrev($localdata);
   
                $md5hash = substr($localdata, 0, 32);
   
                $localdata = substr($localdata, 32);
   
                $localdata = base64_decode($localdata);
   
                $localkeyresults = unserialize($localdata);
   
                $originalcheckdate = $localkeyresults['checkdate'];
   
                if ($md5hash == md5($originalcheckdate . $licensing_secret_key)) {
   
                    $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - $localkeydays, date("Y")));
   
                    if ($localexpiry < $originalcheckdate) {
   
                        $localkeyvalid = true;
   
                        $results = $localkeyresults;
   
                        $validdomains = explode(",", $results['validdomain']);
   
                        if (!in_array($_SERVER['SERVER_NAME'], $validdomains)) {
   
                            $localkeyvalid = false;
   
                            $localkeyresults['status'] = "Invalid";
   
                            $results = array();
                        }
   
   
   
                        $validips = explode(",", $results['validip']);
   
                        if (!in_array($usersip, $validips)) {
   
                            $localkeyvalid = false;
   
                            $localkeyresults['status'] = "Invalid";
   
                            $results = array();
                        }
   
   
   
                        if ($results['validdirectory'] != dirname(__FILE__)) {
   
                            $localkeyvalid = false;
   
                            $localkeyresults['status'] = "Invalid";
   
                            $results = array();
                        }
                    }
                }
            }
        }
   
       
        if (!$localkeyvalid) {
   
            $postfields['licensekey'] = $licensekey;
   
            $postfields['domain'] = $_SERVER['SERVER_NAME'];
   
            $postfields['ip'] = $usersip;
   
            $postfields['dir'] = dirname(__FILE__);
   
            if ($check_token) {
   
                $postfields['check_token'] = $check_token;
            }
   
   
            if (function_exists("curl_exec")) {
   
                $ch = curl_init();
   
                curl_setopt($ch, CURLOPT_URL, $whmcsurl . "modules/servers/licensing/verify.php");
   
                curl_setopt($ch, CURLOPT_POST, 1);
   
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
   
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
   
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   
                $data = curl_exec($ch);
   
                curl_close($ch);
            } else {
   
                $fp = fsockopen($whmcsurl, 80, $errno, $errstr, 5);
   
                if ($fp) {
   
                    $querystring = "";
   
                    foreach ($postfields as $k => $v) {
   
                        $querystring .= "{$k}=" . urlencode($v) . "&";
                    }
   
                    $header = "POST " . $whmcsurl . "modules/servers/licensing/verify.php HTTP/1.0\r\n";
   
                    $header .= "Host: " . $whmcsurl . "\r\n";
   
                    $header .= "Content-type: application/x-www-form-urlencoded\r\n";
   
                    $header .= "Content-length: " . @strlen(@$querystring) . "\r\n";
   
                    $header .= "Connection: close\r\n\r\n";
   
                    $header .= $querystring;
   
                    $data = "";
   
                    @stream_set_timeout(@$fp, 20);
   
                    @fputs(@$fp, @$header);
   
                    $status = @socket_get_status(@$fp);
   
   
   
                    while (!feof(@$fp) && $status) {
   
                        $data .= @fgets(@$fp, 1024);
   
                        $status = @socket_get_status(@$fp);
                    }
   
                    @fclose(@$fp);
                }
            }
   
   
            if (!$data) {
   
                $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - ($localkeydays + $allowcheckfaildays), date("Y")));
   
                if ($localexpiry < $originalcheckdate) {
   
                    $results = $localkeyresults;
                } else {
 
                    $results['status'] = "Invalid";
   
                    $results['description'] = "Remote Check Failed";
   
                    return $results;
                }
            }
   
            preg_match_all("/<(.*?)>([^<]+)<\\/\\1>/i", $data, $matches);
   
            $results = array();
   
            foreach ($matches[1] as $k => $v) {
   
                $results[$v] = $matches[2][$k];
            }
 
            if ($results['md5hash'] && $results['md5hash'] != md5($licensing_secret_key . $check_token)) {
         
                $results['status'] = "Invalid";
   
                $results['description'] = "MD5 Checksum Verification Failed";
   
                return $results;
            }
               
           
            if ($results['status'] == "Active") {
   
                $results['checkdate'] = $checkdate;
   
                $data_encoded = serialize($results);
   
                $data_encoded = base64_encode($data_encoded);
   
                $data_encoded = md5($checkdate . $licensing_secret_key) . $data_encoded;
   
                $data_encoded = strrev($data_encoded);
   
                $data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
   
                $data_encoded = wordwrap($data_encoded, 80, "\n", true);
   
                $results['localkey'] = $data_encoded;
   
                /* for local key start */
   
                if (!Capsule::table('tblconfiguration')->where('setting', 'agency_dashboard_pro_localkey')->get()) {
   
                    Capsule::table('tblconfiguration')->insert(
                        [
                            'setting' => 'agency_dashboard_pro_localkey',
                            'value' => $results['localkey']
                        ]
                    );
                } else {
   
                    Capsule::table('tblconfiguration')
                        ->where('setting', 'agency_dashboard_pro_localkey')
                        ->update(
                            [
                                'value' => $results['localkey']
                            ]
                        );
                }
   
                /* for local key end */
            }
   
            $results['remotecheck'] = true;
        }
        
        unset($postfields);
   
        unset($data);
   
        unset($matches);
   
        unset($whmcsurl);
   
        unset($licensing_secret_key);
   
        unset($checkdate);
   
        unset($usersip);
   
        unset($localkeydays);
   
        unset($allowcheckfaildays);
   
        unset($md5hash);
        
        return $results;
       
    }

    // public function productListing(){
    //     for ($i = 1; $i <= 10; $i++) {
    //         $array["product$i"] = [
    //             "name" => "Product$i",
    //             "description" => "Add description here for product $i"
    //         ];
    //     }
    //     return $array;
    // }

    public function getModulesListApi($pid)
    {
        $url = 'https://my.agency-portal.io/api/index.php/module/getproductlist';
        $method = 'POST';
        $data = [
            'product_id' => $pid,
        ];
      
        $response_getproducts = $this->curlcall($url, $method, $data);
        $response_getproducts = json_decode($response_getproducts);
        // echo '<pre>';
        // print_r($response_getproducts); die;
        return $response_getproducts;
    }

    public function curlcall($url, $method, $data)
    {
       
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
            )
        );
        $response = curl_exec($curl);
        // echo '<pre>';
        // print_r($response); die;
        curl_close($curl);
        return $response;
    }

    public function checkProductInstallation(){
        $moduleList = $this->getsinglemoduleList($_POST['moduleName']);
        $checkModule = $this->checkModuleInstall($moduleList);
        $ModuleName = ucfirst($checkModule['name']);
        $html = '';
        if($checkModule['status'] == 'not installed'){
           
            $status = 'Install Now';
            $html .= '
                <div class="LoadWrapper" style="display:none;">
                    <div class="Loadbox">
                        <div class="Loadcontainer">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </div>
            <div class="module-tab-pane" id="installModuleContainer">
                <div class="col-md-6 col-sm-6"> 
                    <div class="wgs-product-vmware-card">
                        <div class="wgs-product-vmware-card-upper">
                            <div class="mod_logo">
                                <a href="demo.agency-portal.io/../configaddonmods.php" target="_blank"><img src="'.$checkModule['logo'].'" alt="" style="height: 165px;margin-bottom: 10px;"></a>
                            </div>
                            <a href="demo.agency-portal.io/../configaddonmods.php" target="_blank">
                                <p class="wgs-product-vmware-card-para">'.$ModuleName.'</p>
                            </a>
                            <div class="wgs-product-vmware-version">
                                <img src="../modules/addons/dashboardaddonmodule/img/dot.svg" alt="">
                                    <p class="wgs-product-vmware-para">VERSION <span>'.$checkModule['version'].'</span></p>
                            </div>
                        </div>
                        <div class="wgs-product-vmware-card-lower">
                            <a id="install_mod" class="wgs-product-vmware-install-box" mod="'.$checkModule['moduleName'].'" prod_name="'.$checkModule['name'].'" downloadlink="'.$checkModule['link'].'" style="cursor: auto;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                    <path opacity="0.3" d="M18 12.8V14.4C18 15.2836 17.1046 16 16 16H2C0.8954 16 0 15.2836 0 14.4V12.8C0 11.9163 0.8954 11.2 2 11.2H4.2792C4.7096 11.2 5.0918 11.4203 5.2279 11.747L5.5441 12.506C5.8163 13.1593 6.5806 13.6 7.4415 13.6H10.5584C11.4193 13.6 12.1836 13.1593 12.4558 12.506L12.772 11.747C12.9081 11.4204 13.2902 11.2 13.7207 11.2H15.9999C17.1045 11.2 18 11.9163 18 12.8Z" fill="#3B82F6"></path>
                                    <path d="M7.99995 1.6V7.63144L5.68646 5.78065C5.68645 5.78064 5.68643 5.78063 5.68642 5.78062C5.30216 5.47313 4.69784 5.47332 4.31361 5.7806C4.11407 5.94017 4 6.16284 4 6.40001C4 6.63717 4.11406 6.85985 4.31358 7.01946L8.31358 10.2195C8.5107 10.3772 8.76001 10.45 9.00005 10.45C9.24009 10.45 9.4894 10.3772 9.68652 10.2195L13.6865 7.01948C13.886 6.85989 14.0001 6.63721 14.0001 6.40005C14 6.16291 13.886 5.94026 13.6866 5.78065C13.3023 5.47316 12.698 5.47319 12.3137 5.78062L10.0001 7.63144V1.6C10.0001 1.0814 9.49709 0.75 8.99995 0.75C8.50272 0.75 7.99995 1.08147 7.99995 1.6Z" fill="#3B82F6" stroke="#5492F7" stroke-width="0.5"></path>
                                </svg>
                                
                                <span class="'.$checkModule['moduleName'].'"><span class="wgs-product-install-mod">'.$status.'</span></span>
                            </a>
                            <input type="hidden" id="moduleData" name="moduleData" value = \''.json_encode($moduleList).'\'>
                            
                        </div>
                    </div>
                </div>
           </div>';
        } else{
            $html .= '
            <div class="LoadWrapper" style="display:none;">
                <div class="Loadbox">
                    <div class="Loadcontainer">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>
            <div class="modulte-tabs-wrapper" id="sideBarContainer">
            <div class="module-tab-box">
            <div class="module-tab-pane installed-mod">
                <div class="col-md-12 col-sm-12">
                    <div class="wgs-product-wrapper">
                       <div class="wgs-product-wrapper-inner">
                       <a href="demo.agency-portal.io/../configaddonmods.php" target="_blank">
                       <p class="wgs-product-vmware-card-para">'.$ModuleName.'</p>
                   </a>
                   <div class="wgs-product-vmware-version">
                      
                           <p class="wgs-product-vmware-para">VERSION <span>'.$checkModule['version'].'</span></p>
                   </div>
                       </div>
                        <div class="update-plan-outer"><a href="#" class="update-plan-module"><span class="wgs-product-install-mod">Upgrade</span></a></div>
                    </div>
                </div>
            ';
            // Function to create form fields
            if($moduleList->type == 'gateways' || $moduleList->type == 'registrars'){
                $moduleType =  substr($moduleList->type, 0, -1);
                $command = 'GetModuleConfigurationParameters';
                $postData = array(
                    'moduleType' => $moduleType,
                    'moduleName' => $moduleList->module_name,
                );                    
                $results = localAPI($command, $postData);
                $array = [];

                // echo '<pre>';
                // print_r($results); die;
                foreach($results['parameters'] as $item){
                    $array[$item['name']] = [
                        'FriendlyName' => $item['displayName'],
                        'Type' => $item['fieldType'],
                    ];
                }
                $confList['fields'] =$array;
                $Discription = 'Here is the configuration of the '.strtoupper($moduleList->module_name) . ' '.ucfirst($moduleList->type) .' Module';


            }elseif($moduleList->type == 'servers'){
                $directoryfile = dirname((dirname(dirname(__DIR__)))).'/'.$moduleList->type.'/'.$moduleList->module_name.'/'.$moduleList->module_name.'.php';

                if(file_exists($directoryfile))
                {
                    require_once $directoryfile;
                    $confList = $moduleList->module_name .'_ConfigOptions';
                    $confList = $confList([]);
                    // if($confList['description'] == ''){
                    //     $Discription = 'Here is the configuration of the '.strtoupper($moduleList->module_name) . ' '.ucfirst($moduleList->type) .' Module';
                    // } else{
                    //     $Discription = $confList['description'];
                    // }
            }
            } else{
                $roles = $this->getAdminRole();
                $directoryfile = dirname((dirname(dirname(__DIR__)))).'/'.$moduleList->type.'/'.$moduleList->module_name.'/'.$moduleList->module_name.'.php';
                if(file_exists($directoryfile))
                {
                    require_once $directoryfile;
                    $confList = $moduleList->module_name .'_config';
                    $confList = $confList([]);
                    if($confList['description'] == ''){
                        $Discription = $moduleList->module_name . 'Addon Module';
                    } else{
                        $Discription = $confList['description'];
                    }
            }
        }
        if($moduleList->type == 'gateways' || $moduleList->type == 'registrars' || $moduleList->type == 'addons'){
            $html .= '<div class="col-md-12 col-sm-12">
            <div class="module-heading-bx">
            <h3>Configuration</h3>
            <p>&nbsp;' . $Discription . '</p>
            </div>';
        } else{
            $html .= '<div class="col-md-12 col-sm-12">';
        }
        if($moduleList->type == 'addons' || $moduleList->type == 'registrars' || $moduleList->type == 'gateways'){
                    $formHtml = $this->createConfigFields($confList['fields'],$roles,$moduleList->module_name,$moduleList->type);

                                $html .= '<form class="module-form" id="configForm" method="POST" action="addonmodules.php?module=agency_dashboard_pro&action=productlist">
                            <div class="module-form-bx">
                            <input type="hidden" id="custId" name="moduleName" value="'.$moduleList->module_name.'">
                            <input type="hidden" id="custVersion" name="version" value="'.$checkModule['version'].'">
                            <input type="hidden" id="moduleType" name="moduleType" value="' . $moduleList->type . '" />';

                    $html .= $formHtml;
                    $html .= '</div><div class="center-submit-btn"><input type="submit" class="btn submit-btn" name="saveConfig" id="saveConfig" value="Activate"></form></div>';

                } elseif($moduleList->type == 'servers'){
                    $html .= '
                    <div class="module-heading-bx">
                    <h3>Products/Services</h3>
                    <p>This is where you configure all your products and services. Each product must be assigned to a group which can either be visible or hidden from the order page (products may also be hidden individually). A product which is in a hidden group can still be ordered using the Direct Order Link shown when editing the package.</p>
                    </div>
                    <div class="btn-group" role="group">
                     <button id="Create-Group-link" class="btn btn-default"><i class="fas fa-plus"></i> Create a New Group</button>
                     <button id="Create-Product-link" class="btn btn-default"><i class="fas fa-plus-circle"></i> Create a New Product</button>
                    </div>
                    <div class="createProductForm" id="createProductForm"></div>
                    <div class="LoadWrapper"  id="productFormLoader" style="display:none;">
                        <div class="Loadbox">
                            <div class="Loadcontainer">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                        </div>
                    </div>
                    ';
                //     $orderFormArray = $this->getOrderformTemplate();
                //     $paymentMethods = $this->getPaymentMethods();
                //    $html .= $this->serverModulePrdGroupHtml($orderFormArray,$paymentMethods);
                }

                $html .= '</div></div></div>';
        }   

        echo $html;
        exit;
       

    }

    public function getAddonConfigFields($moduleName,$setting,$moduleType)
    {
        $registrar = new RegistrarSetting();
        if($moduleType == 'addons'){
            $tableName = 'tbladdonmodules';
            $columnName = 'module';
        } elseif($moduleType == 'servers'){
            // $tableName = 'tbladdonmodules';
            // $columnName = 'module';
            // ---------- server--------------
        } elseif($moduleType == 'gateways'){
            $tableName = 'tblpaymentgateways';
            $columnName = 'gateway';
        } elseif($moduleType == 'registrars'){
            $tableName = 'tblregistrars';
            $columnName = 'registrar';

            $result = getRegistrarConfigOptions($moduleName);
            // echo '<pre>';
            // print_r($result);
            // die;
            return $result[$setting];

            // $value = RegistrarSetting::where('registrar',$moduleName)->where('setting',$setting)->value('value');
            // echo $value;
            // die;
            // return $value;
        }

        $value = Capsule::table($tableName)->where($columnName, $moduleName)->where('setting', $setting)->value('value');
        return $value;
    }

    public function createConfigFields($customFields,$roles,$moduleName,$moduleType){
        // print_r($moduleType);
        // die;
    $formFields = '';
    if($moduleType == 'gateways'){
        $displayName = $this->getAddonConfigFields($moduleName,'name',$moduleType);
        $visible = $this->getAddonConfigFields($moduleName,'visible',$moduleType);
        $visibleChecked = ($visible == 'on') ? 'checked' : '';
        if($displayName == ''){
            $displayName = $moduleName;
        }
        $formFields .= '<div class="module-checkbox">
        <input type="hidden" name="visible" value="" />
        <input type="checkbox" id="visible" name="visible" '.$visibleChecked.'>
        <label class="cstm-checkbox" for="visible">Show on Order Form</label>
        </div>';
        $formFields .= '<div class="module-form-field">
        <label>Display Name</label>
        <input type="text" class="lisence-input" name="name"  value="'.$displayName.'">
        </div>';
    }
    foreach ($customFields as $key => $field) {
        if($key == 'FriendlyName'){
            continue;
        }
        $fieldName = $field['FriendlyName'];
        $fieldType = $field['Type'];
        $fieldDescription = $field['Description'];
        $fieldRequired = $field['required'] ? 'required' : '';
        // $module_list = Capsule::table('tbladdonmodules')->where('module', $moduleList->module_name)->count();
        $getVal = $this->getAddonConfigFields($moduleName,$key,$moduleType);
        // $data = Capsule::table('tblpaymentgateways')->get();
        // echo "<pre>";
        // print_r($data);
        // die;
                
        switch ($fieldType) {
            case 'text':
                $formFields .= '<div class="module-form-field">
                                    <label>' . $fieldName . '</label>
                                <input type="text" class="lisence-input" name="' . $key . '"  ' . $fieldRequired . ' value="'.$getVal.'">
                            </div>';
                break;
            case 'textarea':
                $formFields .= '<div class="module-form-field">
                            <label>' . $fieldName . '</label>
                            <textarea class="lisence-input" name="' . $key . '" ' . $fieldRequired . '>'.$getVal.'</textarea>
                    </div>';
                break;
            case 'yesno':
                // if($field['Options']){
                //     foreach ($field['Options'] as $option) {
                //         $checked = ($option == $field['Default']) ? 'checked' : '';
                //         $formFields .= '<div class="module-checkbox">
                //         <input type="checkbox" id="'.$fieldName.'" name="' . $fieldName . '" value="' . $option . '" ' . $checked . ' ' . $fieldRequired . '><label for="'.$fieldName.'">'.$fieldName.'</label></div>';
                //     }
                // }
                   
                $checked = ($getVal == 'on') ? 'checked' : '';
                // $val = ($getVal == 'on') ? 'on' : '';
                $formFields .= '<div class="module-checkbox">
                <input type="hidden" name="' . $key . '" value="" />
                <input type="checkbox" class="lisence-input"  '.$checked.'  id="'.$key.'" name="' . $key . '" ' . $fieldRequired . '>
                <label class="cstm-checkbox" for="'.$key.'">'.$fieldName.'</label>
                </div>';
                break;
            case 'dropdown':
                $formFields .= '<div class="module-form-field">
                                <label>' . $fieldName . '</label>
                                <select class="lisence-input" name="' . $fieldName . '" ' . $fieldRequired . '>';
                                foreach ($field['Options'] as $option) {
                                    $formFields .= '<option value="' . $option . '">' . $option . '</option>';
                                }
                                $formFields .= '</select></div>';
             break; 
                case 'radio':
                    $formFields .= '<div class="module-radio-wrapper">';
                    foreach ($field['Options'] as $option) {
                        $checked = ($option == $field['Default']) ? 'checked' : '';
                        $formFields .= '<div class="radio-box">
                        <input id="product-enable&quot;" class="lisence-input" type="radio" name="' . $fieldName . '" value="' . $option . '" ' . $checked . ' ' . $fieldRequired . '> 
                                        <label for="product-enable&quot;" class="radio-label">' . $fieldName . '
                                        </label>
                                        </div>';
                    }
                    break;
                    case 'password':
                        $formFields .= '<div class="module-form-field">
                                            <label>' . $fieldName . '</label>
                                        <input type="password" class="lisence-input" name="' . $key . '"  ' . $fieldRequired . ' value="'.$getVal.'">
                                    </div>';
                        break;
            default:
                // $formFields .= 'Unsupported Field Type';
        }
        // $formFields .= '<br><small>' . $fieldDescription . '</small><br>';
    }
    if($moduleType == 'addons'){
        $getAccessVal = $this->getAddonConfigFields($moduleName,'access','addons');
        $formFields .= '<b>Access Control</b><div class="module-checkbox">';
        foreach ($roles as $field) {
            $checked = (in_array($field->id,explode(',',$getAccessVal))) ? 'checked' : '';
            $formFields .= '<div class="rule-checkbox">
            <input type="checkbox" '.$checked.' id="access[agency_dashboard_pro][' . $field->id . ']" class="lisence-input" name="access[]" value="' . $field->id . '" >
            <label class="cstm-checkbox" for="access[agency_dashboard_pro][' . $field->id . ']"> ' . $field->name . '</label></div>';
        }
        $formFields.'</div>';
    }

    return $formFields;
}


    public function checkModuleInstall($moduleList)
    {
        $directoryfile = dirname((dirname(dirname(__DIR__)))).'/'.$moduleList->type.'/'.$moduleList->module_name.'/'.$moduleList->module_name.'.php';
        if($moduleList->type == "gateways"){
             $directoryfile = dirname((dirname(dirname(__DIR__)))).'/'.$moduleList->type.'/'.$moduleList->module_name.'.php';
        } 
        switch ($moduleList->type) 
        {

            case 'addons':

                $module_list = Capsule::table('tbladdonmodules')->where('module', $moduleList->module_name)->count();
                $modtableres = Capsule::table('mod_agencydashboard_installed')->where('module_name', $moduleList->module_name)->where('type', $moduleList->type)->count(); 

                $res = 'not installed';
                $returnVal['status'] = $res;
                $returnVal['version'] = $moduleList->Version;

                if ($modtableres > 0 && file_exists($directoryfile)) {

                    $res = 'installed';
                    $returnVal['status'] = $res;

                    $modtableres = Capsule::table('mod_agencydashboard_installed')->where('module_name', $moduleList->module_name)->where('type', $moduleList->type)->first();
                    
                    $returnVal['version'] = $modtableres->version;
                }

                $returnVal['moduleName'] = $moduleList->module_name;
                $returnVal['logo'] = $moduleList->logo;
                $returnVal['name'] = $moduleList->friendly_name;
                $returnVal['link'] = $moduleList->download_links;
                $moduleList = $returnVal;
                break;
            case 'servers':
                
                $module_list = Capsule::table('tblservers')->where('type', $key)->count();
                $modtableres = Capsule::table('mod_agencydashboard_installed')->where('module_name', $moduleList->module_name)->where('type', $moduleList->type)->count(); 

                $res = 'not installed';
                $returnVal['status'] = $res;
                $returnVal['version'] = $moduleList->Version;

                if ($modtableres > 0 && file_exists($directoryfile)) {

                    $res = 'installed';
                    $returnVal['status'] = $res;

                    $modtableres = Capsule::table('mod_agencydashboard_installed')->where('module_name', $moduleList->module_name)->where('type', $moduleList->type)->first();
                    
                    $returnVal['version'] = $modtableres->version;
                }

                $returnVal['moduleName'] = $moduleList->module_name;
                $returnVal['logo'] = $moduleList->logo;
                $returnVal['name'] = $moduleList->friendly_name;
                $returnVal['link'] = $moduleList->download_links;
                $moduleList = $returnVal;
                break;
            case 'registrars':
                $module_list = Capsule::table('tblregistrars')->where('registrar', $key)->count();
                $modtableres = Capsule::table('mod_agencydashboard_installed')->where('module_name', $moduleList->module_name)->where('type', $moduleList->type)->count();
                $res = 'not installed';
                $returnVal['status'] = $res;
                $returnVal['version'] = $moduleList->Version;
                if ($modtableres > 0 && file_exists($directoryfile)) {
                    $res = 'installed';
                    $returnVal['status'] = $res;
                    $modtableres = Capsule::table('mod_agencydashboard_installed')->where('module_name', $moduleList->module_name)->where('type', $moduleList->type)->first();
                    $returnVal['version'] = $modtableres->version;
                }

                $returnVal['moduleName'] = $moduleList->module_name;
                $returnVal['logo'] = $moduleList->logo;
                $returnVal['name'] = $moduleList->friendly_name;
                $returnVal['link'] = $moduleList->download_links;
                $moduleList = $returnVal;
                break;
            case 'gateways':
                $module_list = Capsule::table('tblpaymentgateways')->where('gateway', $key)->count();
                
                $modtableres = Capsule::table('mod_agencydashboard_installed')->where('module_name', $moduleList->module_name)->where('type', $moduleList->type)->count();
               
                $res = 'not installed';
                $returnVal['status'] = $res;
                $returnVal['version'] = $moduleList->Version;
                if ($modtableres > 0 && file_exists($directoryfile)) {

                    $res = 'installed';
                    $returnVal['status'] = $res;
                    $modtableres = Capsule::table('mod_agencydashboard_installed')->where('module_name', $moduleList->module_name)->where('type', $moduleList->type)->first();
                    $returnVal['version'] = $modtableres->version;
                }

                $returnVal['moduleName'] = $moduleList->module_name;
                $returnVal['logo'] = $moduleList->logo;
                $returnVal['name'] = $moduleList->friendly_name;
                $returnVal['link'] = $moduleList->download_links;
                $moduleList = $returnVal;
                break;
            default:
        }
        
        return $moduleList;
    }


    public function getsinglemoduleList($key)
    {
        $url = 'https://my.agency-portal.io/api/index.php/module/getmodulelist';
        $method = 'POST';
        $data = [
            'module_name' => $key,
        ];
      
        $response_getproducts = $this->curlcall($url, $method, $data);
        $response = json_decode($response_getproducts);
        return $response;

    }

    public function downloadfile($fileurl)  
    {
        
        $filedownload_url_Arr = explode("***", $fileurl);
        $filedownload_url_php7 = $filedownload_url_Arr[0];
        $filedownload_url_php8 = $filedownload_url_Arr[1];
        $phpversion = phpversion();
        $moduledownload_url = $filedownload_url_php7;
        if ($phpversion >= 8) {
            $moduledownload_url = $filedownload_url_php8;
        }
        $file_name = basename(parse_url($moduledownload_url, PHP_URL_PATH));

        $local_path_with_file_name = "../../" .$file_name;

        copy($moduledownload_url, $local_path_with_file_name);
        
        if (!class_exists('ZipArchive')) {
            $response['staus'] = 'error';
            $response['msg'] = 'Error: Your PHP version does not support unzip functionality.';
            $result = $response;
            die;
        }

        if(isset($_SESSION['zipclass'])){
            $zip = $_SESSION['zipclass'];
        } else{
            echo ['status' => 'fail'];
        }
        
        $res = $zip->open($local_path_with_file_name);
       
        if ($res === TRUE) {
            $zip->extractTo('../../../../');
            $zip->close();
            $result =  ['status' => 'success'];
           
        } else{
            $result =  ['status' => 'fail'];
        }
        // if (isset($crons_dir) && !empty($crons_dir)) {
        //     $pathtofile = '../modules/custom_cron/';
        //     $sub_files = scandir($pathtofile);
        //     $num = count((array) $sub_files);
        //     for ($i = 2; $i < $num; $i++) {
        //         if (is_file($pathtofile . $sub_files[$i])) {
        //             $status = rename($pathtofile . $sub_files[$i], "../../../" . $crons_dir . pathinfo($pathtofile . $sub_files[$i], PATHINFO_BASENAME));
        //         }
        //     }
        // }
        unlink($local_path_with_file_name);
        return $result;
    }

    
    public function checkmodinstalled_tbl($downloadlink,$res)
    {   
        $versionRes = $res->Version;
        $response = Capsule::table('mod_agencydashboard_installed')->where('module_name', $res->module_name)->where('type', $res->type)->first();
        $directoryfileCheck = dirname((dirname(dirname(__DIR__)))).'/'.$res->type.'/'.$res->module_name.'/'.$res->module_name.'.php';
        if($res->type == "gateways"){
             $directoryfileCheck = dirname((dirname(dirname(__DIR__)))).'/'.$res->type.'/'.$res->module_name.'.php';
        }

        $data = [
            'module_name' => $res->module_name,
            'type' => $res->type,
            'Version' => $res->Version,
            "created_at" => date("Y-m-d H:i:s", time()),
            "updated_at" => date("Y-m-d H:i:s", time())
        ];
        if (!file_exists($directoryfileCheck)) {
            $responseRes = $this->downloadfile($downloadlink);
            if($responseRes['status'] == 'success')
            {   
                if(empty($response)){
                Capsule::table('mod_agencydashboard_installed')->insert($data);
                } else{
                Capsule::table('mod_agencydashboard_installed')
                ->where('module_name',$res->module_name)
                ->where('type',$res->type)
                ->update($data);

                }
            }
            return $responseRes;
        }
        $result =  ['status' => 'fail'];
        Capsule::table('mod_agencydashboard_installed')->insert($data);
        return $result;

        // $getList = Capsule::table('mod_agencydashboard_installed')->select('version')->where('module_name', $modulename)->where('type', $type)->first();
        // echo '<pre>';
        // print_r($getList); die;
        // return $getList->version;
        
    }
    public function getAdminRole(){
        $roles = Capsule::table('tbladminroles')->select('id','name')->get();
        return $roles;
    }


    public function saveConfigFields($fields){
// $data = Capsule::table('tblregistrars')->get();
// echo '<pre>';
// print_r($fields);
// die;
// getRegistrarConfigOptions($registrar);
      $moduleName = $fields['moduleName'];
        $moduleType = $fields['moduleType'];

        if(count($fields) != 0){
        switch ($fields['moduleType']) 
        {
            case 'addons':
                foreach ($fields as $key => $item) {
                    if ($key == 'moduleName' || $key == 'saveConfig' || $key == 'moduleType') {
                        continue;
                    }
                    if ($key == 'access') {
                        $item = implode(",", $item);
                    }
                
                    $existingRecord = Capsule::table('tbladdonmodules')
                        ->where('module', $moduleName)
                        ->where('setting', $key)
                        ->first();
    
                    if (!$existingRecord) {
                        Capsule::table('tbladdonmodules')->insert(
                            [
                                'module' => $moduleName,
                                'setting' => $key,
                                'value' => $item
                            ]
                        );
                    } else {
                        Capsule::table('tbladdonmodules')
                            ->where('module', $moduleName)
                            ->where('setting', $key)
                            ->update(
                                [
                                    'value' => $item
                                ]
                            );
                    }
                }
                break;
            case 'servers':
                //--------------------Add server configruration here in table-------------------
              
                break;
            case 'registrars':

                foreach ($fields as $key => $item) {
                    if ($key == 'moduleName' || $key == 'saveConfig' || $key == 'moduleType' ) {
                        continue;
                    }
                    $existingRecord = Capsule::table('tblregistrars')
                        ->where('registrar', $moduleName)
                        ->where('setting', $key)
                        ->first();
   
                    if (!$existingRecord) {
                        Capsule::table('tblregistrars')->insert(
                            [
                                'registrar' => $moduleName,
                                'setting' => $key,
                                'value' => encrypt($item)
                            ]
                        );
                    } else {
                        Capsule::table('tblregistrars')
                            ->where('registrar', $moduleName)
                            ->where('setting', $key)
                            ->update(
                                [
                                    'value' => encrypt($item)
                                ]
                            );
                    }
                }
                break;
            case 'gateways':
                foreach ($fields as $key => $item) {
                    if ($key == 'moduleName' || $key == 'saveConfig'|| $key == 'moduleType' ) {
                        continue;
                    }
                    if ($key == 'access') {
                        $item = implode(",", $item);
                    }
                
                    $existingRecord = Capsule::table('tblpaymentgateways')
                        ->where('gateway', $moduleName)
                        ->where('setting', $key)
                        ->first();
    
                    if (!$existingRecord) {
                        Capsule::table('tblpaymentgateways')->insert(
                            [
                                'gateway' => $moduleName,
                                'setting' => $key,
                                'value' => $item
                            ]
                        );
                    } else {
                        Capsule::table('tblpaymentgateways')
                            ->where('gateway', $moduleName)
                            ->where('setting', $key)
                            ->update(
                                [
                                    'value' => $item
                                ]
                            );
                    }
                }
                break;
            default:
        }

        $moduleType =  substr($fields['moduleType'], 0, -1);

        $command = 'ActivateModule';
        $postData = array(
            'moduleType' => $moduleType,
            'moduleName' => $moduleName,
            // 'parameters' => array('email' => 'billing@example.com', 'forcesubscriptions' => true),
        );
        $results = localAPI($command, $postData);
        global $customadminpath;
        // $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
        //       === 'on' ? "https" : "http") . "://" . 
        //       $_SERVER['HTTP_HOST'] . '/'.$customadminpath.'/configaddonmods.php';
        echo '<div class="box">';
        if ($results['result'] == 'success' || $results['message'] == 'Failed to activate: Module already active') {
            echo '<div class="alert alert-success"><b>Activated Successfully</b></div>';
        } else {
            echo '<div class="alert alert-danger">' . $results['message'] . '<br/><center>';
            // <a href= "'.$link.'" target="_blank">Click Here to activate Module</a></center></div>';'
            // $errorHtml = '<center><a href= "https://prodashboard.shinedezign.pro/admin/configaddonmods.php?deactivated=true">Click Here to activate Module</a></center>';
        }
        // echo $errorHtml;
        echo '</div>';
    }
    }

   public function serverModulePrdGroupHtml($orderFormTemplate,$gatewayArray){
        $fileDirectory =dirname(dirname(dirname(dirname(__DIR__))));
        global $customadminpath;
        $path = $_SERVER['HTTP_HOST'] . '/' . $customadminpath;
        $directory = dirname(dirname(dirname($fileDirectory)))."../templates/orderforms/";

            $html .= '<div class="contentarea Servercontentarea" id="Servercontentarea">
            <div style="float:left;width:100%;">
                <h2>Create Group</h2>
                <form id="addProductGroupForm" method="post" action="addonmodules.php?module=agency_dashboard_pro&action=productlist">
                <input type="hidden" name="token" value="e09cba946d035afbd73e3adcc2ece558540a532a">
                <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
                <tbody>
                <tr>
                <td width="25%" class="fieldlabel">Product Group Name</td>
                <td class="fieldarea">
                    <input type="text" name="name" value="" class="form-control input-400 input-inline new" placeholder="eg. Shared Hosting" id="inputGroupName"  required>
                </td>
                </tr>
        <tr>
            <td width="25%" class="fieldlabel">
                URL    </td>
            <td class="fieldarea">
                <div class="inline-edit-wrapper">
                    <span id="spanRoutePath">'. $path . '/index.php?rp=/store/</span>
                    <input type="text" name="slug" value="" class="form-control input-inline inline-edit" id="inputSlug"  style="width:8px" tabindex="-1" required>
                        <button class="btn btn-sm" id="btnCopyToClipboard" type="button" disabled="disabled">
                            <img src="../assets/img/clippy.svg" alt="Copy to clipboard" width="15">
                        </button>
                    
                    <span id="slugLoader" class="hidden">
                        <i class="fa fa-spinner fa-spin"></i>
                        Validating...            </span>
                    <span id="slugOk" class="text-success hidden">
                        <i class="fa fa-check"></i>
                        OK            </span>
                    <span class="text-danger hidden" id="slugInvalidError"></span>
                    <span class="text-info" id="slug-change-warning" style="display:none;">
                        <i class="fad fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" title="" id="slug-change-tooltip" data-original-title="The product group URL has changed. This will invalidate your current product group URL if you link to it from outside of WHMCS."></i>
                    </span>
                </div>
            </td>
        </tr>


        <tr>
            <td class="fieldlabel">
                Product Group Headline    </td>
            <td class="fieldarea">
                <input type="text" id="headline" name="headline" value="" class="form-control input-700 input-inline" placeholder="eg. Select Your Perfect Plan">
            </td>
        </tr>
        <tr>
            <td class="fieldlabel">
                Product Group Tagline    </td>
            <td class="fieldarea">
                <input type="text" id="tagline" name="tagline" value="" class="form-control input-700 input-inline" placeholder="eg. With our 30 Day Money Back Guarantee You Can\'t Go Wrong!">
                    </td>
        </tr>
        <tr>
            <td class="fieldlabel">
                Group Features    </td>
            <td class="fieldarea">
                <div style="padding:7px 10px;color:#888;font-style:italic;">You must save the product group for the first time before you can add features</div>    </td>
        </tr>
        <tr>
            <td class="fieldlabel">Order Form Template</td>
            <td class="fieldarea">
                        <div id="orderFormTemplateOptions" style="padding:15px;clear:both;">

        ';
        foreach($orderFormTemplate as $template){
        $words = explode('_', $template);
        $capitalizedWords = array_map('ucfirst', $words);
        $templateName = implode(' ', $capitalizedWords);
            if($template == 'standard_cart'){
                $checked = 'checked';
                $default = '(<strong>Default</strong>)';
            } else{
                $checked = '';
                $default = '';
            }
            $html .= '
            </div>    <div style="float:left;padding:10px;text-align:center;">
            <label class="radio-inline">
                <img src="'.$directory.$template.'/thumbnail.gif" width="165" height="90" style="opacity: 100%; border:5px solid #fff;" alt="'.$template.'"><br>
                <input id="orderformtemplate-'.$template.'" type="radio" name="orderformtemplate" value="'.$template.'"'.$checked.'> '.$templateName.$default.'
            </label>
        </div>';
        }
        $html .= '</div></td></tr>
        <tr>
        <td class="fieldlabel">Available Payment Gateways</td>
        <td class="fieldarea" style="padding:7px 10px;">
        ';
        foreach($gatewayArray as $item){
            // print_r($gateway->item);
            // die;
        $html .= '<label class="checkbox-inline">
        <input type="checkbox" name="gateways['.$item->gateway.'] pgateway_checkbox">
        '.$item->gateway.'
        </label>';
        }

        $html .= '</td>
        </tr>
        <tr>
            <td class="fieldlabel">Hidden</td>
            <td class="fieldarea">
                <label class="checkbox-inline">
                    <input type="checkbox" name="hidden">
                    Check if this is a hidden group        </label>
            </td>
        </tr>
        </tbody></table>

            <div class="btn-container">
                <input type="submit" value="Save Changes" class="btn btn-primary" id="SaveProductGroupbtn" name="SaveProductGroupbtn">
                <input type="submit" value="Cancel Changes" onclick="window.location=\'addonmodules.php?module=agency_dashboard_pro&action=productlist\'" class="btn btn-default">
            </div>
        </form>
                </div>
                <div class="clear"></div>
            </div>
        ';
    return $html;
   }



   public function getOrderformTemplate(){
    $directory = dirname(dirname(dirname(dirname(__DIR__))))."/templates/orderforms/";
    $orderFormFiles = [];
        if (is_dir($directory)) {
            $files = scandir($directory);
        $count = 0;
            foreach ($files as $file) {
                if (is_dir($directory . $file) && $file != '.' && $file != '..') {
                    $orderFormFiles[$count++] = $file;
                }
            }
        } 
        return $orderFormFiles;
   }



   public function getPaymentMethods(){
        $gatewayType = Capsule::table('tblpaymentgateways')
        ->select('gateway')
        ->distinct()
        ->get();
        return $gatewayType;
   }
public function checkSlugValidation($string){
    $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    $string = preg_replace('/[^\w\s-]/u', '', $string);
    $string = preg_replace('/\s+/', '-', $string);
    $string = trim($string, '-');
    $string = strtolower($string);
    $slugCheck = Capsule::table('tblproductgroups')->where('slug',$string)->count();
    $result['slugString'] = $string;
    if($slugCheck == 0){
        $result['status'] = 'Valid';
    } else{
        $result['status'] = 'Invalid';
        $result['invalidReason'] = 'This URL is already used.';
    }
    return $result;
}


public function serverModuleProductHtml($getProductGroup){
    $html .= '<div class="admin-tabs-v2 constrained-width">
    <form id="frmAddProduct" method="post" action="addonmodules.php?module=agency_dashboard_pro&action=productlist" class="form-horizontal">
<input type="hidden" name="token" value="e09cba946d035afbd73e3adcc2ece558540a532a">
        <div class="col-lg-9 col-lg-offset-3 col-md-8 col-sm-offset-4">
            <h2>Create a New Product</h2>
        </div>
        <div class="form-group">
        <label for="inputGroup" class="col-lg-3 col-sm-4 control-label">
            Product Group<br>
            <small>Defines how WHMCS manages the item.
            Don\'t see the type of product you\'re looking for? Choose Other</small>
        </label>
        <div class="col-lg-4 col-sm-4">
            <select name="gid" id="inputGroupType" class="form-control">
                <option value="hostingaccount">Shared Hosting</option>
                <option value="reselleraccount">Reseller Hosting</option>
                <option value="server">Server/VPS</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
        
        <div class="form-group">
        <label for="inputGroup" class="col-lg-3 col-sm-4 control-label">
            Product Group<br>
            <small><a href="">Click here to create a new product group</a></small>
        </label>
        <div class="col-lg-4 col-sm-4">
            <select name="gid" id="inputGroup" class="form-control">';
                // echo "<pre>";
                foreach($getProductGroup as $item){
                    // print_r($item);
                    $html .= '<option value="' . $item->id . '">' . $item->name . '</option> ';
                }
                // die;
       $html .= '</select></div>
    </div>
    <div class="form-group">
    <label for="inputProductName" class="col-lg-3 col-sm-4 control-label">
        Product Name<br>
        <small>The default display name for your new product</small>
    </label>
    <div class="col-lg-5 col-sm-6">
        <input type="text" class="form-control new" name="productname" id="inputProductName" required="">
    </div>
</div>

<div class="form-group">
<label for="inputProductName" class="col-lg-3 col-sm-4 control-label">
    URL<br>
    <small>A friendly URL to use to link to this product.</small>
</label>
<div class="col-lg-9 col-sm-8">
    <div class="inline-edit-wrapper">
        <span id="spanRoutePath">http://localhost/whmcs/index.php?rp=/store/web-hosting/</span>
        <input type="text" name="slug" value="" class="form-control input-inline inline-edit" id="inputSlug" style="width: 8px;" tabindex="-1" <span="">
            <button class="btn btn-sm" id="btnCopyToClipboard" type="button" disabled="disabled">
                <img src="../assets/img/clippy.svg" alt="Copy to clipboard" width="15">
            </button>
        
        <span id="slugLoader" class="hidden">
            <i class="fa fa-spinner fa-spin"></i>
            Validating...                    </span>
        <span id="slugOk" class="text-success hidden">
            <i class="fa fa-check"></i>
            OK                    </span>
        <span class="text-danger hidden" id="slugInvalidError"></span>
        <span class="text-info" id="slug-change-warning" style="display:none;">
            <i class="fad fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" title="" id="slug-change-tooltip" data-original-title="The product URL has changed. You can manage older product URLs in the Links tab."></i>
        </span>
    </div>
</div>
</div>
    <div class="form-group">
        <label for="inputProductModule" class="col-lg-3 col-sm-4 control-label">
        Module<br>
            <small>Choose a module for automation</small>
        </label>
        <div class="col-lg-5 col-sm-6">
            <input type="text" class="form-control new" name="module" id="inputProductModule" required="" readonly>
        </div>
    </div>

    <div class="form-group">
    <label for="inputHidden" class="col-lg-3 col-sm-4 control-label">
        Create as Hidden<br>
        <small>A hidden product is not visible to end users</small>
    </label>
    <div class="col-lg-5 col-sm-6">
        <div class="bootstrap-switch-on bootstrap-switch-id-inputHidden bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate" style="width: 100px;"><div class="bootstrap-switch-container" style="width: 147px; margin-left: 0px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 49px;">ON</span><span class="bootstrap-switch-label" style="width: 49px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 49px;">OFF</span><input type="checkbox" class="slide-toggle" name="createhidden" id="inputHidden" checked=""></div></div>
    </div>
</div>

<div class="btn-container">
    <input type="submit" value="Continue »" class="btn btn-primary" id="btnContinue">
</div>
</form>
</div>
';
        return $html;
}

public function getProductGroup(){
    $productGroup = Capsule::table('tblproductgroups')->select('id','name')->get();
    return $productGroup;
}

public function storeProductGroupInTable($productGroupFormFields){
    $gatewayArray = [];
    foreach($productGroupFormFields['gateways'] as $gateway => $value ){
        $gatewayArray[] =  $gateway;
    }
    $groupGateways = Capsule::table('tblpaymentgateways')->whereNotIn('gateway', $gatewayArray)->distinct()->pluck('gateway');
    foreach($groupGateways as $gateway){
        $StringGateway .= ','. $gateway;
    }
    $StringGateway .= ',';
    $hidden = 1;
    if($productGroupFormFields['hidden'] == 'on'){
    $hidden = 0;
    }
    $insertProductGroup = [
        'name' => $productGroupFormFields['name'],
        'slug' => $productGroupFormFields['slug'],
        'headline' => $productGroupFormFields['headline'],
        'tagline' => $productGroupFormFields['tagline'],
        'orderfrmtpl' => $productGroupFormFields['orderformtemplate'],
        'disabledgateways' => $StringGateway,
        'hidden' => $hidden,
        "created_at" => date("Y-m-d H:i:s", time()),
        "updated_at" => date("Y-m-d H:i:s", time()),
    ];
    $checkProductGroup = Capsule::table('tblproductgroups')->where('slug',$productGroupFormFields['slug'])->count();
    echo '<div class="box">';
    if($checkProductGroup == 0){
            Capsule::table('tblproductgroups')->insert($insertProductGroup);
            echo '<div class="alert alert-success"><b>Product Group Added Successfully!</b></div>';
    } else{
        echo '<div class="alert alert-danger"><mark>' . $productGroupFormFields['name'] . '</mark> group  already exists in the table!<br/></div>';
    }
    echo "</div>";
}

}


