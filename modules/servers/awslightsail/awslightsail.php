<?php
use WHMCS\Database\Capsule;
use AWSlightsailModule\Createoptions\AWSlightsail as AWSlightsailcall;
use Aws\Exception\AwsException;

if (file_exists(__DIR__ . '/class.createfields.php'))
    include_once __DIR__ . '/class.createfields.php';

if (file_exists(__DIR__ . '/license.php'))
    include_once __DIR__ . '/license.php';

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function awslightsail_MetaData() {
    return array(
        'DisplayName' => 'AWS LightSail Module',
    );
}

/********* awslightsail version : 2.0.4 *********/
/********* Modify date : 12-12-2023*********/
function awslightsail_ConfigOptions() {

    global $whmcs;
    $configarray = array();
    $pid = $whmcs->get_req_var('id');
    $get_data = Capsule::table('tblproducts')->select()->where('id', $pid)->first();
    $platform = $get_data->configoption5;
    $region = $get_data->configoption4;
     // echo 'hii';
// die;
    $status_tab = <<<  tabdata
    <script>

    $(document).ready(function(){
        var region = '$region';
        var platform = '$platform';
        
        getbundles(region,platform);
        getblueprints(platform);

        $('select[name="packageconfigoption[4]"]').on("change", function(){
           var region =$(this).val();
          
           var platform  =$('select[name="packageconfigoption[5]"]').val();
           
           getbundles(region,platform);
           getblueprints(platform);
        })
        $('select[name="packageconfigoption[5]"]').on("change", function(){
            var platform  = $(this).val();
            var region = $('select[name="packageconfigoption[4]"]').val();
            getblueprints(platform);
            getbundles(region,platform);
        })

        $('input[name="packageconfigoption[9]"]').click(function() {
            $('#frmProductEdit .btn-primary').prop('disabled', true);
            if ($(this).is(':checked')) {
                var clientoption = 'on'; 
            }else{
                var clientoption = 'off';
            }
            $.ajax({
            url: '',
            type: 'post',
            data: {
                configurableoptions: true,
                clientoption:clientoption,
                },
                dataType: 'html',
                success:function(response)
                {
                    $('#frmProductEdit .btn-primary').prop('disabled', false);
                    if(response == 'success'){
                        
                    }
                   // $('select[name="packageconfigoption[7]"]').html(response);           
                }

            });
        });
    })
    
    function getbundles(region,platform){
         
        $('select[name="packageconfigoption[7]"]').html('<option value="">Loading...</option>');
        $.ajax({
        url: '',
        type: 'post',
        data: {
            getbundles: true,
            region:region,
            platform:platform
            },
            dataType: 'html',
            success:function(response)
            {
                $('select[name="packageconfigoption[7]"]').html(response);           
            }

        });
    }

    function getblueprints(platform){
        $('select[name="packageconfigoption[6]"]').html('<option value="">Loading...</option>');
        $.ajax({
        url: '',
        type: 'post',
        data: {
            getblueprints: true,
            platform:platform
            },
            dataType: 'html',
            success:function(response)
            {
                $('select[name="packageconfigoption[6]"]').html(response);           
            }

        });
    }        
    </script>
tabdata;

    $error = '';
    $configarray = array(
        'license key' => array(
            'FriendlyName' => 'License Key',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '1024',
            'Description' => 'Enter the License key',
        ),
        'api_key' => array(
            'FriendlyName' => 'API Key',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter API Key here' . $status_tab,
        ),
        'api_secret_key' => array(
            'FriendlyName' => 'API Secret Key',
            'Type' => 'password',
            'Size' => '25',
            'Default' => '',
            'Placeholder' => 'Enter secret Key here',
        ),
    );

    $regionsArr = [];
    $blueprintArr = [];
    $bundlesArr = [];
    if ($get_data->configoption2 != '' && $get_data->configoption3 != '') {

        try {
            $AWSlightsailcall = new AWSlightsailcall($get_data->configoption2, $get_data->configoption3);
            
            
            $AWSlightsailcall->CreateCustomFields($pid);
            
            $AWSlightsailcall->CreateEmailtemplate();
          
            $AWSlightsailcall->Createinstanceaccesstable();
            
            $configurableoptions = $AWSlightsailcall->awslightsail_configurableOption($pid, $get_data->configoption5);
         
            # Get Regions
            $regions = $AWSlightsailcall->getregions();
            
           
            foreach ($regions['regions'] as $key => $region) {
                $regionsArr[$region['name']] = $region['displayName'];
            }

            #Get blueprints
            $blueprints = $AWSlightsailcall->getblueprints();
            
           
            
            foreach ($blueprints['blueprints'] as $key => $blueprint) {
                $blueprintArr[$blueprint['blueprintId']] = $blueprint['name'] . ' (' . $blueprint['version'] . ')';
            }
            
            # Get Bundles
            $get_data->configoption4 = $get_data->configoption4 != ''  ? $get_data->configoption4 : 'us-east-1';

            $bundles = $AWSlightsailcall->getbundles($get_data->configoption4);

            
            foreach ($bundles['bundles'] as $key => $bundle) {
                $bundlesArr[$bundle['bundleId']] = $bundle['name'] . "-{$bundle['bundleId']}" . " (CPU: {$bundle['cpuCount']}, RAM: {$bundle['ramSizeInGb']} Gb, Disk: {$bundle['diskSizeInGb']} Gb) " . $bundle['supportedPlatforms'][0];
            }
        } catch (AwsException $e) {
            // getAwsErrorMessage
            $error =  'Error AWS API:'.$e->getAwsErrorMessage();
        }
    }

 
    $script = '';

    if ($error != '') {
        $script = '<script>
                    $(document).ready(function(){
                      jQuery("#serverReturnedError").removeClass("hidden");
                      jQuery("#serverReturnedErrorText").html(\'' . $error . '\');
                      });
                      </script>';
    }

    $optionArr = ['linux' => 'Linux', 'windows' => 'Windows'];

    $array = [
        'regions' => array(
            'FriendlyName' => 'Regions',
            'Type' => 'dropdown',
            'Options' => $regionsArr,
            'Description' => 'Regions' . $script,
        ),
         'platform' => array(
            'FriendlyName' => 'Platform',
            'Type' => 'dropdown',
            'Options' => $optionArr,
            'Description' => 'Platform',
        ),
        'blueprints' => array(
            'FriendlyName' => 'Blueprints',
            'Type' => 'dropdown',
            'Options' => $blueprintArr,
            'Description' => 'Blueprints',
        ),
        'bundles' => array(
            'FriendlyName' => 'Bundles',
            'Type' => 'dropdown',
            'Options' => $bundlesArr,
            'Description' => 'Instance Plans',
        ),
        'snapshot_limit' => array(
            'FriendlyName' => 'Snapshot Limit',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter Number of Snapshot Limit',
        ),
        "enable_client_choose" => array(
            "FriendlyName" => "Enable client choose Instance Plan",
            "Type" => "yesno", 
            "Size" => "25",
            "Description" => "Tick to enable client choose Regions/Blueprint/Instance Plan",
        ),
        "instance_prefix" => array(
            "FriendlyName" => "Instance Prefix",
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            "Description" => "Enter instance Prefix",
        )
    ];

    $configarray = array_merge($configarray, $array);
    return $configarray;
}

function awslightsail_getLang($params) {
    global $CONFIG;
    if ($_SESSION['Language'] != '')
        $language = strtolower($_SESSION['Language']);
    else if (strtolower($params['clientsdetails']['language']) != '')
        $language = strtolower($params['clientsdetails']['language']);
    else
        $language = $CONFIG['Language'];

    $langfilename = dirname(__FILE__) . '/lang/' . $language . '.php';

    if (file_exists($langfilename))
        include($langfilename);
    else
        include(dirname(__FILE__) . '/lang/english.php');

    if ($lang != '')
        return $lang;
}

function awslightsail_CreateAccount($params) {

    $firstname = $params['clientsdetails']['firstname'];
    $serviceid = $params['serviceid'];
    
    $OS = $params['configoption5'];
    $clientChoosePlan = $params['configoption9'];
   
    $license = awslightsail_checkLicense($params['configoption1']);
             
    if ($license['status'] != 'Active')
        return "Error: License Status is " . $license['status'];
        
    if ($params['customfields']['server_id'] != '')
        return "Error: Server ID already exist";    
    
    $checkservice = Capsule::table('mod_lightsail_cron_services')->where('serviceid',$serviceid)->where('status','inactive')->count();
    
    if($checkservice == 0){
        $cronData = [
            "serviceid" => $serviceid,
            "status"  => "inactive"
            ];
        try {   
            Capsule::table('mod_lightsail_cron_services')->insert($cronData);
            $status = "success";
        }catch(Exception $e) {
            $status =  'Message: ' .$e->getMessage();
        }  
        return $status;
    }else{
        
        $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
    
        if($clientChoosePlan  == "on"){
            $selectedBlueprint = $params['configoption6'];
        }else{
            $selectedBlueprint = $params['configoptions']['blueprint'];
        }
    
        $fetchBPScript = Capsule::table('awslsScriptLaunch')->where('blueprintID', $selectedBlueprint)->first();
        if ($fetchBPScript) {
            $params['launchScript'] = $fetchBPScript->scriptcontent;
             
            $randpwd = $AWSlightsailcall->randomPassword();
            $params['launchScript'] =  str_replace('{$userpassword}',  $randpwd, $params['launchScript']);
            if($selectedBlueprint == 'wordpress' || $selectedBlueprint == 'wordpress_multisite' ){
                $username = "admin";
            }else{
                $username = $firstname . $serviceid;
            }
            $params['launchScript'] =  str_replace('{$username}', $username, $params['launchScript']);
    
            if(!empty($params['launchScript'])){
                $params['awsuser'] = $username;
                $params['awspwd'] = $randpwd;
            }
        }
    
        try {
    
            if (strtolower($OS) == "linux") {
                $keyPairData = $AWSlightsailcall->createkeypair($params);
                $params['keyPairData'] = $keyPairData;
            }  
            
            $instance = $AWSlightsailcall->Createinstance($params);
            $instancename = $instance['operations'][0]['resourceName'];
            sleep(25);
            if(isset($params['configoptions']['additional_disk']) && $params['configoptions']['additional_disk'] !== 0){
               $createdisk = $AWSlightsailcall->createdisk($params); 
            }
            
            $AWSlightsailcall->insertinstanceaccesstable($params, $instance);
            $getstaticip = $AWSlightsailcall->allocatestaticIp($params);
    
            sleep(60);
            $AWSlightsailcall->attachstaticIp($instancename, $params);
    
            if ($instance['operations']['0']['id'] != '') {
    
                if($keyPairData){
                    $getpublicFieldID = $AWSlightsailcall->getCustomFieldID('publicKey', $params['pid']);
                    $getprivateFieldID = $AWSlightsailcall->getCustomFieldID('privateKey', $params['pid']);
                    $AWSlightsailcall->saveCustomFieldVal($getpublicFieldID, $params['serviceid'], $keyPairData['publicKeyBase64']);
                    $AWSlightsailcall->saveCustomFieldVal($getprivateFieldID, $params['serviceid'], $keyPairData['privateKeyBase64']);
                }
    
                $getServerFieldID           = $AWSlightsailcall->getCustomFieldID('server_id', $params['pid']);
                $getInstanceFieldID         = $AWSlightsailcall->getCustomFieldID('instancename', $params['pid']);
                $getadditionaldiskFieldID   = $AWSlightsailcall->getCustomFieldID('additionaldisk', $params['pid']);
                $getkeypairFieldID          = $AWSlightsailcall->getCustomFieldID('sshkeypair', $params['pid']);
                $getstaticipFieldID         = $AWSlightsailcall->getCustomFieldID('staticip', $params['pid']);
                $AWSlightsailcall->saveCustomFieldVal($getServerFieldID, $params['serviceid'], $instance['operations']['0']['id']);
                $AWSlightsailcall->saveCustomFieldVal($getInstanceFieldID, $params['serviceid'], $instance['operations']['0']['resourceName']);
                $AWSlightsailcall->saveCustomFieldVal($getadditionaldiskFieldID, $params['serviceid'], $createdisk['operations']['0']['resourceName']);
                $AWSlightsailcall->saveCustomFieldVal($getkeypairFieldID, $params['serviceid'], $keyPairData['keyPair']['name']);
                $AWSlightsailcall->saveCustomFieldVal($getstaticipFieldID, $params['serviceid'], $getstaticip['operations']['0']['resourceName']);
                $params['resourceName'] = $instance['operations'][0]['resourceName'];
    
                $getAccessdetails = $AWSlightsailcall->getInstanceAcessDetail($params);
                sleep(20);
                $AWSlightsailcall->accessdetailsendmail($getAccessdetails,$keyPairData['privateKeyBase64'], $keyPairData['publicKeyBase64'], $params);
                
                // Capsule::table('mod_lightsail_cron_services')->where('serviceid',$serviceid)->update(["status" => "active"]);
    
                $status = 'success';
                logActivity("Lightsail cron create instance (serviceId-".$serviceid.") :" . $status);
            } else {
                $status = "Error: errorCode: " . $instance['operations']['0']['errorCode'] . " errorDetails: " . $instance['operations']['0']['errorDetails'];
                logActivity("Lightsail cron create instance (serviceId-".$serviceid.") error " . $status);
            }
        } catch (Exception $e) {
            $status = $e->getMessage();
            logActivity("Lightsail cron create instance (serviceId-".$serviceid.") error " . $status);
        }
    }
    

    return $status;
}

function awslightsail_TerminateAccount(array $params) {

    try {						
        $OS = $params['configoption5'];

        if ($params['customfields']['instancename'] == '')
            return "Error: Instance Name is empty";

        $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
        $instancename = $params['customfields']['instancename'];
        $additionaldisk = $params['customfields']['additionaldisk'];
        $getSnapshots = $AWSlightsailcall->getSnapshots($params, $action = null);
      
        foreach ($getSnapshots['instanceSnapshots'] as $snapShot){
            $AWSlightsailcall->deleteSnapshot($params,$snapShot['name'],'Delete Instance Snapshot');
        }
        sleep(10);
        $deleteinstance = $AWSlightsailcall->Deleteinstance($params,$instancename);
        sleep(30);
        
        if(isset($additionaldisk) && $additionaldisk !=''){
            $deletedisk = $AWSlightsailcall->deletedisk($params, $additionaldisk);
        }
        
        if (strtolower($OS) == "linux") {
            $deletekeypair = $AWSlightsailcall->deletekeypair($params);
        }
        $deletestaticip = $AWSlightsailcall->deletestaticip($params);
        
        if ($deleteinstance['operations']['0']['id'] != '') {

            $getServerFieldID           = $AWSlightsailcall->getCustomFieldID('server_id', $params['pid']);
            $getInstanceFieldID         = $AWSlightsailcall->getCustomFieldID('instancename', $params['pid']);
            $getadditionaldiskFieldID   = $AWSlightsailcall->getCustomFieldID('additionaldisk', $params['pid']);
            $getkeypairFieldID          = $AWSlightsailcall->getCustomFieldID('sshkeypair', $params['pid']);
            $getstaticipFieldID         = $AWSlightsailcall->getCustomFieldID('staticip', $params['pid']);
            $getpublicKeyFieldID        = $AWSlightsailcall->getCustomFieldID('publicKey', $params['pid']);
            $getprivateKeyFieldID       = $AWSlightsailcall->getCustomFieldID('privateKey', $params['pid']);

            $AWSlightsailcall->saveCustomFieldVal($getServerFieldID, $params['serviceid'], '');
            $AWSlightsailcall->saveCustomFieldVal($getInstanceFieldID, $params['serviceid'], '');
            $AWSlightsailcall->saveCustomFieldVal($getadditionaldiskFieldID, $params['serviceid'], '');
            $AWSlightsailcall->saveCustomFieldVal($getkeypairFieldID, $params['serviceid'], '');
            $AWSlightsailcall->saveCustomFieldVal($getstaticipFieldID, $params['serviceid'], '');
            $AWSlightsailcall->saveCustomFieldVal($getpublicKeyFieldID, $params['serviceid'], '');
            $AWSlightsailcall->saveCustomFieldVal($getprivateKeyFieldID, $params['serviceid'], '');

            Capsule::table('mod_lightsail_access_detail')->where('instancename', $params['customfields']['instancename'])->where('service_id', $params['serviceid'])->delete();
            
             Capsule::table('mod_lightsail_cron_services')->where('serviceid',$params['serviceid'])->delete();
            $status = 'success';
        } else {
            $status = "Error: errorCode: " . $instance['operations']['0']['errorCode'] . " errorDetails: " . $instance['operations']['0']['errorDetails'];
        }
    } catch (Exception $e) {
        $status = $e->getMessage();
    }

    return $status;
}

function awslightsail_SuspendAccount(array $params) {

    try {

        if ($params['customfields']['instancename'] != '')
            return "Error: Instance Name is empty";

        $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
        $Suspendinstance = $AWSlightsailcall->Stopinstance($params, 'Suspend Instance');

        if ($Suspendinstance['operations']['0']['id'] != '') {
            $status = 'success';
        } else {
            $status = "Error: errorCode: " . $instance['operations']['0']['errorCode'] . " errorDetails: " . $instance['operations']['0']['errorDetails'];
        }
    } catch (Exception $e) {
        $status = $e->getMessage();
    }
    return $status;
}

function awslightsail_UnsuspendAccount(array $params) {

    try {
        if ($params['customfields']['instancename'] == '')
            return "Error: Instance Name is empty";

        $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
        $Unsuspendinstance = $AWSlightsailcall->Startinstance($params, 'Unsuspend Instance');

        if ($Unsuspendinstance['operations']['0']['id'] != '') {
            $status = 'success';
        } else {
            $status = "Error: errorCode: " . $instance['operations']['0']['errorCode'] . " errorDetails: " . $instance['operations']['0']['errorDetails'];
        }
    } catch (Exception $e) {
        $status = $e->getMessage();
    }

    return $status;
}

function awslightsail_AdminCustomButtonArray() {

    return array(
        "Reboot" => "Reboot",
        "Stop" => "Stop",
        "Start" => "Start"
    );
}

function awslightsail_AdminServicesTabFields($params){
    global $whmcs;
    $ostype = $params['configoption5'];
     
    $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
  

    $getregionid = Capsule::table('tblproductconfigoptions')->where('optionname', 'like', '%regions%')->first();
    $getinstanceplanid = Capsule::table('tblproductconfigoptions')->where('optionname', 'like', '%instance_plans%')->first();
   
    $getregionid = $getregionid->id;
    $getinstanceplanid = $getinstanceplanid->id;
    $config_region = "'configoption[".$getregionid."]'";
    $config_instanceplan = "'configoption[".$getinstanceplanid."]'";
    $scriptadmintb = '<script type="text/javascript">
    jQuery(document).ready(function() {
        
        var selectedconfigid = jQuery("select[name='.$config_instanceplan.']").find("option:selected").val();
        jQuery("select[name='.$config_region.']").attr("onchange","changeregionadmin(this)");
        jQuery("select[name='.$config_region.']").trigger("change");

        setTimeout(function () {
            jQuery("select[name='.$config_instanceplan.']").val(selectedconfigid);
        }, 1300);

    });
    function changeregionadmin(that){

        jQuery("select[name='.$config_instanceplan.']").html("<option>Loading...</option");
        var configsubid = jQuery("select[name='.$config_instanceplan.']").attr("name").match(/\d+/);
        var location = jQuery(that).find("option:selected").text();
       
        jQuery.ajax({
            url: "",
            method: "POST",
            data: "ajax=true&activity=getplansadmin&planconfigid="+configsubid+"&awslocation="+location+"&ostype='.$ostype.'",
            success: function(response)
            {
                jQuery("select[name='.$config_instanceplan.']").html(response);
            }
     });
 
    }
    </script>';
if ($params['status'] == 'Active' && $params['customfields']['instancename'] != '') {
    $getinstance = $AWSlightsailcall->Getinstance($params);  
   
    if($getinstance['instance']['name'] != ''){
     
        $status = ($getinstance['instance']['state']['name'] == 'running') ? '<i class="far fa-check-circle" style="color: #3bc13b;"></i> '. $getinstance['instance']['state']['name'] : '<i class="far fa-stop-circle" style="color: #e00808;"></i> '. $getinstance['instance']['state']['name'];
        $instancedetails = "<div class='service-action'> 
                                <div class='instance-details'>
                                    <div class='title-name'>Instance Details</div>
                                    <table width='100%' class='instance-detail-tbl table table-striped'>
                                        <tbody>
                                            <tr>
                                            <td class='td-changecolr'>Instance Name</td> 
                                            <td>".$getinstance['instance']['name']."</td>
                                            </tr>
                                            <tr ><tr>
                                            <td class='td-changecolr'>SSH Key Name</td> 
                                            <td>".$getinstance['instance']['sshKeyName']."</td>
                                            </tr>
                                            <tr >
                                            <td class='td-changecolr'>Status</td> 
                                            <td class='text-capitalize'>
                                             ".$status ." 
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Image ID</td> 
                                            <td>".$getinstance['instance']['blueprintId']."</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Bundle ID</td>
                                            <td>".$getinstance['instance']['bundleId']."</td>
                                            </tr>
                                            <tr > 
                                            <td class='td-changecolr'>Region</td> 
                                            <td>".$getinstance['instance']['location']['regionName']."</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Availability Zone</td> 
                                            <td>".$getinstance['instance']['location']['availabilityZone']."</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Image Name</td> <td>".$getinstance['instance']['blueprintName']."</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Core Count</td> 
                                            <td>".$getinstance['instance']['hardware']['cpuCount']."</td>
                                            </tr><tr >
                                            <td class='td-changecolr'>RAM Size</td> 
                                            <td>".$getinstance['instance']['hardware']['ramSizeInGb']."GB</td></tr>
                                            <tr>
                                            <td class='td-changecolr'>Disks Size</td>
                                            <td>".$getinstance['instance']['hardware']['disks'][0]['sizeInGb']."GB</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Disks Path</td>
                                            <td>".$getinstance['instance']['hardware']['disks'][0]['path']."</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Additional Disks Size</td>
                                            <td>".$getinstance['instance']['hardware']['disks'][1]['sizeInGb']."GB</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Additional Disks Path</td>
                                            <td>".$getinstance['instance']['hardware']['disks'][1]['path']."</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Public IP Address</td> 
                                            <td>".$getinstance['instance']['publicIpAddress']."</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Private IP Address</td> 
                                            <td>".$getinstance['instance']['privateIpAddress']."</td>
                                            </tr>
                                            <tr>
                                            <td class='td-changecolr'>Number of Firewall Rule</td> 
                                            <td>".count($getinstance['instance']['networking']['ports'])."</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                            <style>  
                            .instance-details {
                                    padding: 15px;
                                    background: #ffff;
                                }
                                table.instance-detail-tbl.table.table-striped {
                                    margin-top: 15px;
                                }
                                td.td-changecolr {
                                    background-color: #1a4d80;
                                    color: #fff;
                                    padding-right: -49px;
                                    width: 25%;
                                }
                                table.instance-detail-tbl.table.table-striped tr td {
                                    padding-left: 22px;
                                }
                                .instance-details .title-name {
                                    font-weight: 600;
                                    font-size: 15px;
                                }
                            </style>";
    }else{
         $error = "<h3 style='color:red;margin: 6px;'>".$getinstance['errorMessage']."</h3>" ;  
    }                
}

    return array(
        "" => $scriptadmintb.$instancedetails.$error,
    );
}
 
function awslightsail_Reboot(array $params) {

    try {
        if ($params['customfields']['instancename'] == '')
            return "Error: Instance Name is empty";

        $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
        $Unsuspendinstance = $AWSlightsailcall->Rebootinstance($params, 'Reboot Instance');

        if ($Unsuspendinstance['operations']['0']['id'] != '') {
            $status = 'success';
        } else {
            $status = "Error: errorCode: " . $instance['operations']['0']['errorCode'] . " errorDetails: " . $instance['operations']['0']['errorDetails'];
        }
    } catch (Exception $e) {
        $status = $e->getMessage();
    }
    return $status;
}

function awslightsail_Stop(array $params) {

    try {
        if ($params['customfields']['instancename'] == '')
            return "Error: Instance Name is empty";

        $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
        $Suspendinstance = $AWSlightsailcall->Stopinstance($params, 'Stop Instance');

        if ($Suspendinstance['operations']['0']['id'] != '') {
            $status = 'success';
        } else {
            $status = "Error: errorCode: " . $instance['operations']['0']['errorCode'] . " errorDetails: " . $instance['operations']['0']['errorDetails'];
        }
    } catch (Exception $e) {
        $status = $e->getMessage();
    }

    return $status;
}

function awslightsail_Start(array $params) {

    try {
        if ($params['customfields']['instancename'] == '')
            return "Error: Instance Name is empty";

        $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
        $Startinstance = $AWSlightsailcall->Startinstance($params, 'Start Instance');

        if ($Startinstance['operations']['0']['id'] != '') {
            $status = 'success';
        } else {
            $status = "Error: errorCode: " . $instance['operations']['0']['errorCode'] . " errorDetails: " . $instance['operations']['0']['errorDetails'];
        }
    } catch (Exception $e) {
        $status = $e->getMessage();
    }
    return $status;
}

function awslightsail_ClientArea(array $params) {
    try {
		
        $license = awslightsail_checkLicense($params['configoption1']);
        
        if ($license['status'] != 'Active')
            return "Error: License Status is " . $license['status'];

        $AWSlightsailcall = new AWSlightsailcall($params['configoption2'], $params['configoption3']);
        $getSnapshot = $AWSlightsailcall->getSnapshots($params, 'Get Snapshots');
 
        $snapshotdetail = $getSnapshot['instanceSnapshots'];
      
        if (isset($_POST['ajaxcall']) && $_POST['ajaxcall'] != '') {
            include_once __DIR__ . '/ajax.php';
            exit();
        }
        $getinstance = $AWSlightsailcall->Getinstance($params);		
    
        $osImageName = '';
       
     
        if (strchr(strtolower($getinstance['instance']['blueprintName']), "windows"))
            $osImageName = 'windows.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "fedora"))
            $osImageName = 'fedora.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "amazon linux"))
            $osImageName = 'amazonlinux.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "debian"))
            $osImageName = 'debian.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "ubuntu"))
            $osImageName = 'ubuntu.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "opensuse"))
            $osImageName = 'opensuse.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "centos"))
            $osImageName = 'centos.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "wordpress" ))
            $osImageName = 'wordpress.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "wordpress_multisite" ))
            $osImageName = 'wordpress.png';   
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "node.js" ))
            $osImageName = 'nodejs.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "lamp (php 7)" ))
            $osImageName = 'lamp.png'; 
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "joomla" ))
            $osImageName = 'joomla.png'; 
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "magento" ))
            $osImageName = 'magento.png'; 
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "mean" ))
            $osImageName = 'mean.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "drupal" ))
            $osImageName = 'drupal.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "gitlab ce" ))
            $osImageName = 'gitlab.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "redmine" ))
            $osImageName = 'redmine.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "neginx" ))
            $osImageName = 'nginx.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "ghost" ))
            $osImageName = 'ghost.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintName']), "django" ))
            $osImageName = 'django.png';
        elseif (strchr(strtolower($getinstance['instance']['blueprintId']), "plesk_ubuntu_18_0_28" ))
            $osImageName = 'plesk.png'; 
        elseif (strchr(strtolower($getinstance['instance']['blueprintId']), "freebsd_12" ))
            $osImageName = 'freebsd.png'; 
        elseif (strchr(strtolower($getinstance['instance']['blueprintId']), "cpanel_whm_linux" ))
            $osImageName = 'cpanel.png';

        $ramsize = $AWSlightsailcall->filesize_format($getinstance['instance']['hardware']['ramSizeInGb']);
		
        $getregionname = $getinstance['instance']['location']['regionName'];
        $getregion = $AWSlightsailcall->getregions($params);
	
        $blueprintname = "";
        $regionname = '';
        foreach ($getregion['regions'] as $key => $regionvalue) {
            if ($regionvalue['name'] == $getregionname) {
                $regionname = $regionvalue['displayName'];
            }
        }
		
        $status = ucfirst($getinstance['instance']['state']['name']);

        if( $status == 'Running'){
            $getaccessdetail = $AWSlightsailcall->getInstanceAcessDetail($params);
            
            // echo"<pre>";
            // print_r($getaccessdetail);die;
            $instanceaccessdetail = $getaccessdetail['accessDetails'];
            $win_password = $getaccessdetail['accessDetails']['password'];    
        }
       
        $name = $getinstance['instance']['name'];
		
        $availablezone = $getinstance['instance']['location']['availabilityZone'];
        $blueprintname = $getinstance['instance']['blueprintName'];
        $status = ucfirst($getinstance['instance']['state']['name']);
        $privateIp = $getinstance['instance']['privateIpAddress'];
        $publicIp = $getinstance['instance']['publicIpAddress'];
        $storagedisk = $getinstance['instance']['hardware']['disks'];
        $SystemDisk = $getinstance['instance']['hardware']['disks'][0]['isSystemDisk'];
        $vCpu = $getinstance['instance']['hardware']['cpuCount'];
        $transfer = $getinstance['instance']['networking']['monthlyTransfer']['gbPerMonthAllocated'];
        $time = time();
        $diskpath = $getinstance['instance']['hardware']['disks'][0]['path'];
	    
        $instance_keys = [
            'instance_publickey' => $params['customfields']['publicKey'],
            'instance_privatekey' => $params['customfields']['privateKey']
        ];

        return array(
            'operationtype' => $instanceoperationtype,
            'operationdate' => $instanceoperationdate,
            'templatefile' => '/template/clientarea',
            'vars' => array(
                'regionname' => $regionname,
                'ramsize' => $ramsize,
                'name' => $name,
                'availablezone' => $availablezone,
                'blueprintname' => $blueprintname,
                'status' => $status,
                'privateIp' => $privateIp,
                'publicIp' => $publicIp,
                'storagedisk' => $storagedisk,
                'time' => $time,
                'vCPU' => $vCpu,
                'transfer' => $transfer,
                'diskPath' => $diskpath,
                'storage' => $getinstance['instance']['hardware']['disks'],
                'osImageName' => $osImageName,
                'snapshotdetail' => $snapshotdetail,
                'instaceaccessdetail' => $instanceaccessdetail,
                'instacekeysdetail' => $instance_keys,
                'windowaccesspassword' => $win_password,
            ),
        );
    } catch (Exception $e) {
        return array(
            'tabOverviewReplacementTemplate' => 'error.tpl',
            'templateVariables' => array(
                'usefulErrorHelper' => $e->getMessage(),
            ),
        );
    }
}

?>