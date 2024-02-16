<?php
use WHMCS\Database\Capsule;

add_hook('ShoppingCartValidateProductUpdate', 1, function($vars) {
    global $whmcs;
	$i = $whmcs->get_req_var("i");
    $pid = $_SESSION['cart']['products'][$i]['pid'];
    $fieldId = Capsule::table('tblcustomfields')
    ->select('id')
    ->where('fieldname', 'like', 'email%')
    ->where('relid',$pid)
    ->first();
    $emailCount = (Capsule::table('tblclients')
    ->where('email',$vars['customfield'][$fieldId->id])
    ->count());
    if($emailCount != 0){
        return '<b>Email Already  Exist</b>';
    }
});
