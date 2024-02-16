<?php
use WHMCS\Database\Capsule;
use AWSlightsailModule\Createoptions\AWSlightsail as AWSlightsailcall;
use Aws\Exception\AwsException;

if (file_exists(__DIR__ . '/class.createfields.php'))
    include_once __DIR__ . '/class.createfields.php';


if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('AdminAreaPage', 2, function($vars) {
     if ( isset($_POST['activity']) ) {
        if($_POST['activity'] == 'getplansadmin'){
            global $whmcs;
            $region =  strtolower($whmcs->get_req_var('awslocation'));
            $configid = $whmcs->get_req_var('planconfigid');
            $ostype = $whmcs->get_req_var('ostype');
            
            if($region == "sydney"){
                $findplan = "_2_2";
            }elseif($region == "mumbai"){
                $findplan = "_2_1";
            }else{
                $findplan = "_2_0";
            }
            if($ostype == 'windows'){
               
                $findplan = 'win'.$findplan;
                $where = [  
                    ['configid', '=', $configid],
                    ['optionname', 'LIKE', '%' .$findplan. '%']
                ];
            }else{
                
                $not_planos= 'win'.$findplan;
                $where = [
                    ['configid', '=', $configid],
                    ['optionname', 'LIKE', '%' .$findplan. '%'],
                    ['optionname', 'NOT LIKE', '%' .$not_planos. '%'],
                ];
            }
            
            $get_plans = Capsule::table('tblproductconfigoptionssub')->where($where)->get();
             foreach ($get_plans as $key => $bundle) {

                $options .= '<option value="'.$bundle->id.'">
                 '.substr($bundle->optionname, strpos($bundle->optionname, "|") + 1).'
                </option>';
             }
            echo $options;
            exit();         
        }  
     }
});

add_hook('AdminAreaPage', 1, function() {

    global $whmcs;
    try {
        if (isset($_POST['getbundles']) && !empty($_POST['getbundles'])) {

            $pid = $whmcs->get_req_var('id');

            $region = $whmcs->get_req_var('region');

            $get_data = Capsule::table('tblproducts')->select()->where('id', $pid)->first();



            $AWSlightsailcall = new AWSlightsailcall($get_data->configoption2, $get_data->configoption3);

            # Get Bundles

            $bundles = $AWSlightsailcall->getbundles($region);

            $bundlesArr = [];
            $osType =  $whmcs->get_req_var('platform');
            
            $options = '';
            
            foreach ($bundles['bundles'] as $key => $bundle) { {

                    $select = '';

                    if($osType == 'windows' && strtolower($bundle['supportedPlatforms'][0]) == 'windows'){
                        if ($get_data->configoption7 == $bundle['bundleId']){
                            $select = 'selected'; 
                        } 
                        $options .= '<option value="' . $bundle['bundleId'] . '" ' . $select . '>' . $bundle['name'] . '-' . $bundle['bundleId'] . ' ( CPU:' . $bundle['cpuCount'] . ', RAM:' . $bundle['ramSizeInGb'] . 'Gb, Disk:' . $bundle['diskSizeInGb'] . 'Gb, Disk:' . $bundle['diskSizeInGb'] . 'Gb) ' . $bundle['supportedPlatforms'][0] . '</option>';
                        
                    }elseif($osType == 'linux' && strtolower($bundle['supportedPlatforms'][0]) == 'linux_unix'){
                        if ($get_data->configoption7 == $bundle['bundleId']){
                            $select = 'selected'; 
                        } 
                        $options .= '<option value="' . $bundle['bundleId'] . '" ' . $select . '>' . $bundle['name'] . '-' . $bundle['bundleId'] . ' ( CPU:' . $bundle['cpuCount'] . ', RAM:' . $bundle['ramSizeInGb'] . 'Gb, Disk:' . $bundle['diskSizeInGb'] . 'Gb, Disk:' . $bundle['diskSizeInGb'] . 'Gb) ' . $bundle['supportedPlatforms'][0] . '</option>';
        
                    }
                }
            }

            echo $options;

            exit();

        }

        if (isset($_POST['getblueprints']) && !empty($_POST['getblueprints'])) {

            $pid = $whmcs->get_req_var('id');
    
            $get_data = Capsule::table('tblproducts')->select()->where('id', $pid)->first();
            $osType =  $whmcs->get_req_var('platform');
            $AWSlightsailcall = new AWSlightsailcall($get_data->configoption2, $get_data->configoption3);
            #Get blueprints
            $blueprints = $AWSlightsailcall->getblueprints();
            
            $blueprintArr = [];
            $options = '';
            foreach ($blueprints['blueprints'] as $key => $blueprint) {
                
                $select = '';
                if($osType == 'windows'){
                    # "window found"
                    if(strpos($blueprint['blueprintId'], 'windows') !== false){
                        if ($get_data->configoption6 == $bundle['bundleId']){
                            $select = 'selected'; 
                        }
                        
                        $options .= '<option value="'.$blueprint['blueprintId'].'" ' . $select . '>'.$blueprint['name'].' ( '.$blueprint['version'].' ) </option>';
                    }
                }else{
                    # "linux found"
                    if(strpos($blueprint['blueprintId'], 'windows') === false){
                        if ($get_data->configoption6 == $bundle['bundleId']){
                            $select = 'selected'; 
                        }
                    $options .= '<option value="'.$blueprint['blueprintId'].'">'.$blueprint['name'].' ( '.$blueprint['version'].' ) </option>';
                    
                    }
                } 
            }
            
            echo $options;

            exit();

        }
        if (isset($_POST['configurableoptions']) && $_POST['configurableoptions'] == 'true') {

            $pid = $whmcs->get_req_var('id');
            $clientoption = $whmcs->get_req_var('clientoption');
            
            
            $config_groupId = Capsule::table('tblproductconfiglinks')->where('pid', $pid)->value('gid');
            if($clientoption == "on"){
                $optionArr = [
                                'hidden' => '0'
                            ];
            }else{
                $optionArr = [
                                'hidden' => '1'
                            ];
            }
            try{
            Capsule::table('tblproductconfigoptions')->where('gid', $config_groupId)->update($optionArr);
                $status = "success";
            }catch(Exception $e) {
                $status =  'Message: ' .$e->getMessage();
            }

            exit();

        }
    } catch (AwsException $e) {
        // getAwsErrorMessage
        echo $error =  'Error AWS API:'.$e->getAwsErrorMessage();
        exit;
    }

});




add_hook('ClientAreaHeadOutput', 1, function($vars) {
 
  if($vars['productinfo']['module'] == 'awslightsail'){
    global $whmcs;
    $pid = $vars['productinfo']['pid'];
    $get_os = Capsule::table('tblproducts')->where('id', $pid)->first();
    
    $plan_os =  $get_os->configoption5; 
    
    if (isset($_POST['activity'])){
        if($_POST['activity'] == "getplans"){
            
            $region =  strtolower($whmcs->get_req_var('location'));
            $configid = $whmcs->get_req_var('configid');
            if($region == "sydney"){
                $findplan = "_2_2";
            }elseif($region == "mumbai"){
                $findplan = "_2_1";
            }else{
                $findplan = "_2_0";
            }
         
            if($plan_os == 'windows'){
               
                $findplan = 'win'.$findplan;
                $where = [  
                    ['configid', '=', $configid],
                    ['optionname', 'LIKE', '%' .$findplan. '%']
                ];
            }else{
                
                $not_planos= 'win'.$findplan;
                $where = [
                    ['configid', '=', $configid],
                    ['optionname', 'LIKE', '%' .$findplan. '%'],
                    ['optionname', 'NOT LIKE', '%' .$not_planos. '%'],
                ];
            }
            

            $get_plans = Capsule::table('tblproductconfigoptionssub')->where($where)->get();
           
             foreach ($get_plans as $key => $bundle) {

                $options .= '<option value="'.$bundle->id.'">
                 '.substr($bundle->optionname, strpos($bundle->optionname, "|") + 1).'
                </option>';
             }
            print $options;
            exit();
        }
    }
    return <<<HTML
  
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery("#productConfigurableOptions").find('.row:eq(0) select:eq(0)').attr("onchange","changeregion(this)");
    var os = '$plan_os';
   // if(os == 'windows'){
       jQuery("#productConfigurableOptions").find('.row:eq(0) select:eq(1)').attr("onchange","changeblueprint(this)");
  //  }
    
  //  jQuery("#productConfigurableOptions").find('.row:eq(0) select:eq(1)').attr("onchange","changeblueprint(this)");
    jQuery("#productConfigurableOptions").find('.row:eq(0) select:eq(0)').trigger("change");
});

function changeregion(that){
    jQuery("#productConfigurableOptions").find('.row:eq(1) select').html('<option>Loading...</option');
    var region = jQuery(that).find('option:selected').text().trim();
    var configsubid = jQuery("#productConfigurableOptions").find('.row:eq(1) select').attr("id").match(/\d+/);
    jQuery.ajax({
        url: "",
        type: "POST",
        data: "activity=getplans&configid="+configsubid+"&location="+region,
        success: function(response)
        {
      
        jQuery("#productConfigurableOptions").find('.row:eq(1) select').html(response);

        }});
 
}
function changeblueprint(that){
   
    var blueprint = jQuery(that).find('option:selected').text().trim();
     
     if(blueprint == 'SQL Server 2016 Express (2020.08.12)'){
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(3)').prop("selected", true);
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(1)').hide();
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(2)').hide();
     }else if(blueprint == 'cPanel & WHM for Linux (11.90.0.10)' || blueprint == 'Plesk Hosting Stack on Ubuntu (18.0.28)'){
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(2)').prop("selected", true);
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(1)').hide();
     }else{
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(1)').show();
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(2)').show();
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(3)').prop("selected", false);
        jQuery("#productConfigurableOptions").find('.row:eq(1) select option:nth-child(1)').prop("selected", true);
     }
}
</script>
HTML;
  }
    

});

?>

