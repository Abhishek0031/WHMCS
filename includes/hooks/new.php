<?php
use WHMCS\Database\Capsule;
 
define("Pid", 4);
add_hook('InvoicePaid', 1, function($vars) {
    try {
    $data = Capsule::table('tblinvoices')
        ->join('tblhosting', 'tblinvoices.userid', '=', 'tblhosting.userid')
        ->where('tblinvoices.id', $vars['invoiceid'])
        // ->where('tblhosting.packageid', Pid)
        ->select('tblhosting.*')
        ->first();
 
    echo '<pre>';
    print_r($data);
 
    die();
   if(!empty($data)){
        $command = 'AddOrder';
        $postData = array(
            'clientid' => $data->userid,
            'paymentmethod' => $data->paymentmethod,
        );
        $results = localAPI($command, $postData);
        echo '<pre>';
        echo "hiii";
        print_r($results);
        die();
    }
    }catch (Exception $e) {
        logActivity('Error occur invoicepaid hook :' . $e->getMessage());
    }
        });
   
 
?>
 