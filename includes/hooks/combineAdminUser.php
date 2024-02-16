<?php

// use WHMCS\Database\Capsule;

// if (!defined("WHMCS")) {
//     die("This file cannot be accessed directly");
// }

// add_hook('AdminAreaFooterOutput', 1, function($vars) {
//     try {
//         global $whmcs;
//         if ($vars['filename'] == "clientsnotes") {
//             $results = Capsule::table('tbladmins')
//                 ->select('id', 'firstname', 'lastname','email')
//                 ->get();

//             foreach ($results as $result) {
//                 $options .= '<option value="' . $result->id . '">' . $result->firstname . ' ' . $result->lastname . '</option>';
//             }
//             if(!empty($whmcs->get_req_var('note'))){
//                 $id = (int)$whmcs->get_req_var('select');
//                 AdminUserMessage();
//                 $mergeArray = [
//                     'message' => $whmcs->get_req_var('note'),
//                 ];
//             $result = sendAdminMessage("Admin User Message", $mergeArray, "", 0, [$id]);
//             if($result == '1')
//             {
//                 logActivity('Email Send Successfully!');
//             }
//             print_r($result);
//             exit();
//             }







//         }
//     } catch (\Exception $e) {
//         logActivity("Error Support Hook" . $e->getMessage());
//     }
// });

// function AdminUserMessage()
//     {
//         try {
//             if (!Capsule::table('tblemailtemplates')->where('type', 'admin')->where('name', 'Admin User Message')->count()) {
//                 Capsule::table('tblemailtemplates')->insert([
//                     'type' => 'admin',
//                     'name' => 'Admin User Message',
//                     'subject' => 'Welcome Email',
//                     'message' => '<p>Hi,</p><p>{$message}</p>',
//                     'custom' => 1
//                 ]);
//             }
//         } catch (\Exception $e) {
//             logActivity("Error Welcome Email" . $e->getMessage());
//         }
//     }