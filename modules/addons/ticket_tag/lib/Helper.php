<?php
namespace WHMCS\Module\Addon\TicketTag;
use WHMCS\Database\Capsule;

class Helper
{
    public function addTicketTag($tag_manager, $tag_color) 
    {        
        global $whmcs;
        $error = '';

        if($whmcs->get_req_var('tag_manager')==='' ){
            $msg = ['status' => "error", 'message' => '* Please Enter Tag Name'];
            return $msg;
            
        } else {
            try {
                $data = [
                "tag_manager" => $tag_manager,
                "tag_color" => $tag_color
            ];
            if(Capsule::table('mod_tag_manager')->where("tag_manager", $data["tag_manager"])->count()){
                $msg = ['status' => "error", 'message' => 'Data already exists, you can edit'];
                return $msg;
            } else{
                $result =  Capsule::table('mod_tag_manager')->insert($data);
                $msg = ['status' => "success", 'message' => 'Data Inserted Successfully.'];
                return $msg;
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
      }   
    }
    
    public function showTicketTag()
    {
        try {
            $result=  Capsule::table('mod_tag_manager')->get();
            return $result;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteTicketTag($id)
    {
    global $whmcs;
    try {
        if ($whmcs->get_req_var('Check') == true) {
            $id = $whmcs->get_req_var('id');

            $result = Capsule::table('mod_tag_manager')->where('id', '=', $id)->delete();
            $status = ['status' => 'success'];
        } else {
            $status = ['status' => 'error', 'message' => 'Invalid request'];
        }
    } catch (\Exception $e) {
        $status = ['status' => 'error', 'message' => $e->getMessage()];
    }
    print_r(json_encode($status));
}

public function editTicketTagDetails($data)
{
    try {
        $UpdateData = [
            "tag_manager" => $data['tag_manager'],
            "tag_color" => $data['tag_color']
        ];
    
        $result = Capsule::table('mod_tag_manager')
        ->where('id', $data['id'])
        ->update($UpdateData);

         if (!empty($result)) {
            $data = ['status' => "success"];
        } else {
            $data = ['status'=>"error"];
        }
        } catch (\Exception $e) {
                $data = $e->getMessage();
        }
        print_r(json_encode($data));
        // exit();
}

public function addTagTicketValue($data)
{
    try {

        if(Capsule::table('mod_assign_tag_ticket')->where("ticket_id", $data["ticket_id"])->count()){
            $result =  Capsule::table('mod_assign_tag_ticket')->where("ticket_id", $data["ticket_id"])->update($data);
        }
        else{
            $result =  Capsule::table('mod_assign_tag_ticket')->insert($data);
        } 
        if (!empty($result)) {
            return 'inserted Successfully';
        } else {
            return 'error';
        }
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}



}