<?php

use WHMCS\Module\Addon\TicketTag\Helper;
use WHMCS\Database\Capsule;

require_once '../../../../init.php';

if (!defined('WHMCS')) {
    die('This file cannot be accessed directly');
}

$ticketTag = new Helper();
//deletion
if ($whmcs->get_req_var('ajaxcheck') == 'true') {
    if ($whmcs->get_req_var('delete') == 'deleteId') {
        $id = $whmcs->get_req_var('id');
        $ticketTag->deleteTicketTag($id);
    }
}
//updation
if ($whmcs->get_req_var('option') == 'updateData' && $whmcs->get_req_var('tag_manager') != '') {
    $id = $whmcs->get_req_var('id');
    $tag_manager = $whmcs->get_req_var('tag_manager');
    $tag_color = $whmcs->get_req_var('tag_color');
      if (isset($id, $tag_manager, $tag_color)) {
        $data = [
            'id' => $id,
            'tag_manager' => $tag_manager,
            'tag_color' => $tag_color,
        ];
        $ticketTag->editTicketTagDetails($data);
    }
}

if($whmcs->get_req_var('addTag') == 'tagAdd') {
    $tag_id = $whmcs->get_req_var('tag_id');
    if (isset($tag_id)) {
        $data = [
            'tag_id' => $tag_id,
            'ticket_id' => $ticket_id,
        ];
       echo $ticketTag->addTagTicketValue($data);

    }
}





?>