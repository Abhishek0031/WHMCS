<?php

namespace WHMCS\Module\Addon\agency_dashboard_pro;

use WHMCS\Database\Capsule;


use WHMCS\Domains;

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

    public function productListing(){
        for ($i = 1; $i <= 10; $i++) {
            $array["product$i"] = [
                "name" => "Product$i",
                "description" => "Add description here for product $i"
            ];
        }
        return $array;
    }

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
        // print_r(json_encode((int)$_POST['id']));
        // echo '<pre>'; print_r($_POST); die;
        
        $moduleList = $this->getsinglemoduleList($_POST['moduleName']);
        $checkModule = $this->checkModuleInstall($moduleList);

        $html = '';
        if($checkModule['status'] = 'not installed'){

            $html .= '
            <style>
    /* Add your custom styles here */
    .wgs-product-vmware-card {
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .wgs-product-vmware-card-upper {
        text-align: center;
    }

    .wgs-product-vmware-card-upper img {
        border-radius: 50%;
    }

    .wgs-product-vmware-card-para {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    .wgs-product-vmware-version {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    .wgs-product-vmware-version img {
        margin-right: 5px;
    }

    .wgs-product-vmware-para {
        font-size: 14px;
        color: #666;
    }

    .wgs-product-vmware-card-lower {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .wgs-product-vmware-install-box,
    .wgs-product-vmware-update-box {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .wgs-product-vmware-install-box:hover,
    .wgs-product-vmware-update-box:hover {
        background-color: #3B82F6;
    }

    .agencyseoslocalviking {
        margin-left: 10px;
        font-size: 14px;
    }

    .wgs-product-installed,
    .agencyseoslocalviking-update p {
        color: #4caf50;
    }
</style>    
           <div class="module-tab-pane">
                <div class="col-md-4 col-sm-6">
                    <div class="wgs-product-vmware-card">
                        <div class="wgs-product-vmware-card-upper">
                            <div class="mod_logo">
                                <a href="demo.agency-portal.io/../configaddonmods.php" target="_blank"><img src="'.$checkModule['logo'].'" alt="" style="height: 165px;margin-bottom: 10px;"></a>
                            </div>
                            <a href="demo.agency-portal.io/../configaddonmods.php" target="_blank">
                                <p class="wgs-product-vmware-card-para">'.$checkModule['name'].'</p>
                            </a>
                            <div class="wgs-product-vmware-version">
                                <img src="../modules/addons/dashboardaddonmodule/img/dot.svg" alt="">
                                    <p class="wgs-product-vmware-para">VERSION <span>'.$checkModule['version'].'</span></p>
                            </div>
                        </div>
                        <div class="wgs-product-vmware-card-lower">
                            <a class="wgs-product-vmware-install-box" mod="agencyseoslocalviking" prod_name="'.$checkModule['name'].'" buylink="https://my.agency-portal.io/order/whmcs-addon-modules/6" style="cursor: auto;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                    <path opacity="0.3" d="M18 12.8V14.4C18 15.2836 17.1046 16 16 16H2C0.8954 16 0 15.2836 0 14.4V12.8C0 11.9163 0.8954 11.2 2 11.2H4.2792C4.7096 11.2 5.0918 11.4203 5.2279 11.747L5.5441 12.506C5.8163 13.1593 6.5806 13.6 7.4415 13.6H10.5584C11.4193 13.6 12.1836 13.1593 12.4558 12.506L12.772 11.747C12.9081 11.4204 13.2902 11.2 13.7207 11.2H15.9999C17.1045 11.2 18 11.9163 18 12.8Z" fill="#3B82F6"></path>
                                    <path d="M7.99995 1.6V7.63144L5.68646 5.78065C5.68645 5.78064 5.68643 5.78063 5.68642 5.78062C5.30216 5.47313 4.69784 5.47332 4.31361 5.7806C4.11407 5.94017 4 6.16284 4 6.40001C4 6.63717 4.11406 6.85985 4.31358 7.01946L8.31358 10.2195C8.5107 10.3772 8.76001 10.45 9.00005 10.45C9.24009 10.45 9.4894 10.3772 9.68652 10.2195L13.6865 7.01948C13.886 6.85989 14.0001 6.63721 14.0001 6.40005C14 6.16291 13.886 5.94026 13.6866 5.78065C13.3023 5.47316 12.698 5.47319 12.3137 5.78062L10.0001 7.63144V1.6C10.0001 1.0814 9.49709 0.75 8.99995 0.75C8.50272 0.75 7.99995 1.08147 7.99995 1.6Z" fill="#3B82F6" stroke="#5492F7" stroke-width="0.5"></path>
                                </svg>
                                <span class="agencyseoslocalviking"><span class="wgs-product-installed">'.$checkModule['status'].'</span></span>
                            </a>
                            <a class="wgs-product-vmware-update-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                    <path d="M13.6575 9.20445L13.6581 9.20436C13.7991 9.18 13.9449 9.21283 14.0618 9.29641M13.6575 9.20445L14.5659 9.84082V9.65649M13.6575 9.20445C13.5165 9.22933 13.3908 9.30936 13.309 9.42744L13.3089 9.42753L12.5478 10.5273V8.32577L14.5659 7.31667M13.6575 9.20445L14.5659 7.31667M14.0618 9.29641L13.9745 9.41843L14.0617 9.29636L14.0618 9.29641ZM14.0618 9.29641L14.5659 9.65649M14.5659 9.65649V7.31667M14.5659 9.65649L14.7159 9.76362L14.5659 7.31667M13.8814 10.4859L12.4525 12.5497L12.4524 12.5499C12.3502 12.6971 12.184 12.7807 12.0114 12.7807C11.9582 12.7807 11.9044 12.7729 11.8512 12.7562M13.8814 10.4859L11.8961 12.6131M13.8814 10.4859L14.7909 11.1354L14.7909 11.1355C14.9543 11.2519 15.1693 11.268 15.348 11.1756C15.5265 11.0838 15.6387 10.8996 15.6387 10.6988V6.78031L17.0773 6.06099V12.9751L10.0364 16.4958V9.58145M13.8814 10.4859L10.0364 9.58145M11.8512 12.7562L11.8961 12.6131M11.8512 12.7562C11.8513 12.7562 11.8513 12.7562 11.8513 12.7563L11.8961 12.6131M11.8512 12.7562C11.6273 12.6862 11.475 12.4789 11.475 12.2443V8.86213M11.8961 12.6131C11.7348 12.5627 11.625 12.4133 11.625 12.2443V8.78713L11.475 8.86213M11.475 8.86213L10.0364 9.58145M11.475 8.86213V8.69443L10.0364 9.58145M17.8537 4.71342L17.8537 4.71338L9.74001 0.656549L9.73991 0.656501C9.58901 0.581185 9.41107 0.581132 9.26024 0.656549L9.32732 0.790713L9.26024 0.656549L1.14658 4.71338C0.964823 4.80426 0.85 4.98985 0.85 5.19315V13.3068C0.85 13.5101 0.964788 13.6956 1.14631 13.7865L1.14638 13.7866L9.26004 17.8434C9.33571 17.8812 9.41784 17.9 9.50002 17.9C9.58221 17.9 9.66434 17.8812 9.74001 17.8434L17.8537 13.7866L17.8537 13.7865C18.0353 13.6956 18.15 13.5101 18.15 13.3068V5.19315C18.15 4.98988 18.0353 4.80431 17.8537 4.71342ZM15.1989 5.80087L8.28474 2.3437L9.50003 1.73598L16.4144 5.19315L15.1989 5.80087ZM12.108 7.34633L5.19365 3.88917L7.08525 2.94337L13.9996 6.40054L12.108 7.34633ZM2.58569 5.19315L3.99433 4.48883L10.9085 7.946L9.50002 8.65031L2.58569 5.19315ZM1.92273 12.9751V6.06099L8.96366 9.58145V16.4956L1.92273 12.9751Z" fill="#3B82F6" stroke="#3B82F6" stroke-width="0.3"></path>
                                </svg>
                                <span class="agencyseoslocalviking-update"><p>Latest Module</p></span>
                            </a>
                        </div>
                    </div>
                </div>
           </div>';
        } else{
            $html ="gmm";
        }
        echo $html;
        exit;
       
        // return $data;

    }

    public function checkModuleInstall($moduleList)
    {
        switch ($moduleList->type) 
        {

            case 'addons':

                $module_list = Capsule::table('tbladdonmodules')->where('module', $key)->count();
               
                $res = 'not installed';
                $returnVal['status'] = $res;
                if ($module_list > 0) {
                    $res = 'installed';
                    $returnVal['status'] = $res;
                   

                    // $veron = $this->checkinstalled_tbl($key, $type, $val['version'], $vars);
                    // $returnVal['status'] = $res;
                    // $returnVal['version'] = $veron;
                    // $returnVal['updat_version'] = 'latest';
                    // if ($val['version'] > $veron) {
                    //     $returnVal['updat_version'] = 'available';
                    // }
                }
                $returnVal['moduleName'] = $key;
                $returnVal['version'] = $moduleList->Version;
                $returnVal['logo'] = $moduleList->logo;
                $returnVal['name'] = $moduleList->friendly_name;
                $moduleList = $returnVal;
                // print_r($moduleList); die;
                break;
            case 'servers':
                $module_list = Capsule::table('tblservers')->where('type', $key)->count();
                $res = 'not installed';
                $returnVal['status'] = $res;
                if ($module_list > 0) {
                    $res = 'installed';
                    $returnVal['status'] = $res;
                  
                }
                $returnVal['moduleName'] = $key;
                $returnVal['version'] = $moduleList->Version;
                $returnVal['logo'] = $moduleList->logo;
                $returnVal['name'] = $moduleList->friendly_name;
                $moduleList = $returnVal;
                // print_r($moduleList); die;
                break;
            case 'registrars':
                $module_list = Capsule::table('tblregistrars')->where('registrar', $key)->count();
                $res = 'not installed';
                $returnVal['status'] = $res;
                if ($module_list > 0) {
                    $res = 'installed';
                    $returnVal['status'] = $res;
                   

                }
                $returnVal['moduleName'] = $key;
                $returnVal['version'] = $moduleList->Version;
                $returnVal['logo'] = $moduleList->logo;
                $returnVal['name'] = $moduleList->friendly_name;
                $moduleList = $returnVal;
                // print_r($moduleList); die;
                break;
            case 'gateways':
                $module_list = Capsule::table('tblpaymentgateways')->where('gateway', $key)->count();
                $res = 'not installed';
                $returnVal['status'] = $res;
                if ($module_list > 0) {
                    $res = 'installed';
                    $returnVal['status'] = $res;
                   
                }
                $returnVal['moduleName'] = $key;
                $returnVal['version'] = $moduleList->Version;
                $returnVal['logo'] = $moduleList->logo;
                $returnVal['name'] = $moduleList->friendly_name;
                $moduleList = $returnVal;
                // print_r($moduleList); die;
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


        // switch ($response->type) 
        // {

        //     case 'addons':

        //         $module_list = Capsule::table('tbladdonmodules')->where('module', $key)->count();
               
        //         $res = 'not installed';
        //         $returnVal['status'] = $res;
        //         if ($module_list > 0) {
        //             $res = 'installed';
        //             $returnVal['status'] = $res;
                   

        //             // $veron = $this->checkinstalled_tbl($key, $type, $val['version'], $vars);
        //             // $returnVal['status'] = $res;
        //             // $returnVal['version'] = $veron;
        //             // $returnVal['updat_version'] = 'latest';
        //             // if ($val['version'] > $veron) {
        //             //     $returnVal['updat_version'] = 'available';
        //             // }
        //         }
        //         $returnVal['moduleName'] = $key;
        //         $returnVal['version'] = $response->Version;
        //         $returnVal['logo'] = $response->logo;
        //         $returnVal['name'] = $response->friendly_name;
        //         $response = $returnVal;
        //         // print_r($response); die;
        //         break;
        //     case 'servers':
        //         $module_list = Capsule::table('tblservers')->where('type', $key)->count();
        //         $res = 'not installed';
        //         $returnVal['status'] = $res;
        //         if ($module_list > 0) {
        //             $res = 'installed';
        //             // $veron = $this->checkinstalled_tbl($key, $type, $val['version'], $vars);
        //             $returnVal['status'] = $res;
        //             // $returnVal['version'] = $veron;
        //             // $returnVal['updat_version'] = 'latest';
        //             // if ($val['version'] > $veron) {
        //             //     $returnVal['updat_version'] = 'available';
        //             // }
        //         }
        //         $response[$key] = $returnVal;
        //         break;
        //     case 'registrars':
        //         $module_list = Capsule::table('tblregistrars')->where('registrar', $key)->count();
        //         $res = 'not installed';
        //         $returnVal['status'] = $res;
        //         if ($module_list > 0) {
        //             $res = 'installed';
        //             $veron = $this->checkinstalled_tbl($key, $type, $val['version'], $vars);
        //             $returnVal['status'] = $res;
        //             $returnVal['version'] = $veron;
        //             $returnVal['updat_version'] = 'latest';
        //             if ($val['version'] > $veron) {
        //                 $returnVal['updat_version'] = 'available';
        //             }
        //         }
        //         $response[$key] = $returnVal;
        //         break;
        //     case 'gateways':
        //         $module_list = Capsule::table('tblpaymentgateways')->where('gateway', $key)->count();
        //         $res = 'not installed';
        //         $returnVal['status'] = $res;
        //         if ($module_list > 0) {
        //             $res = 'installed';
        //             $veron = $this->checkinstalled_tbl($key, $type, $val['version'], $vars);
        //             $returnVal['status'] = $res;
        //             $returnVal['version'] = $veron;
        //             $returnVal['updat_version'] = 'latest';
        //             if ($val['version'] > $veron) {
        //                 $returnVal['updat_version'] = 'available';
        //             }
        //         }
        //         $response[$key] = $returnVal;
        //         break;
        //     default:
        // }
        
        // return json_encode($response);
        // echo json_encode($response);
        // die;
    }
}
