<?php

namespace WHMCS\Module\servers\provisioningmodule;

use WHMCS\Database\Capsule;

class provisioningmoduleClass
{
    public function createCustomField()
    {
        $relid = $_REQUEST['id'];
        $emailRegex = "/^\S+@\S+\.\S+$/";
        $nameRegex = "";

        $array = [  
            [
                'fieldname' => 'email|enter your email',
                'fieldtype' => 'text',
                'description' => 'field to store data',
                'regexpr' => $emailRegex,
                'type' => 'product',
                'relid' => $relid,
                'showinvoice' => '',
                'showorder' => 'on',
                'required' => 'on',
                'adminonly' => ''
            ],
            [
                'fieldname' => 'id|Enter your ID',
                'fieldtype' => 'text',
                'description' => 'field to store data',
                'regexpr' => $nameRegex,
                'type' => 'product',
                'relid' => $relid,
                'showinvoice' => '',
                'showorder' => '',
                'required' => 'on',
                'adminonly' => 'on'
            ],
        ];

        $check = '';
        foreach ($array as $element) {
            $CheckFieldName = explode('|', $element['fieldname'])[0] . '%';
            $check = count(
                Capsule::table('tblcustomfields')
                    ->where([
                        ['fieldname', 'like', $CheckFieldName],
                        ['relid', $element['relid']],
                        ['type', $element['type']]
                    ])->get()
            );

            if ($check == 0) {
                Capsule::table("tblcustomfields")->insert($element);
            }
        }
    }


    public function getClientIDByEmail($email) {
        try{
            $data = Capsule::table('tblclients')
            ->select('id')
            ->where('email', $email)
            ->get();
            if($data[0]->id){
                return $data[0]->id;
            }else {
                return 'email not found';
            }
        } catch(Exception $e) {
            return 'fail to connect';
        }
    }
    


    public function CustomFieldValues($results,$params) {
        if ($results['result'] == 'success') {
            $fieldId = Capsule::table('tblcustomfields')
                ->select('id')
                ->where('fieldname', 'like', 'id%')->where('relid',$params['pid'])
                ->first();
            $serviceId = $params['serviceid'];
            $insertData = array(
                'fieldid' => $fieldId->id,
                'relid' => $serviceId,
                'value' => $results['clientid'],
            );
    
            Capsule::table("tblcustomfieldsvalues")->insert($insertData);
            // print_r($insertData);
            // die;
        }
    }

    public function deleteCustomFieldValue($params,$results){
    if($results['result'] == 'success')
    {
        $relid=$params['serviceid'];
        $fieldid=(Capsule::table('tblcustomfields')
                ->select('id')
                ->where('fieldname', 'like', 'id%')
                ->where('relid',$params['pid'])
                ->first())->id;
        Capsule::table('tblcustomfieldsvalues')->where('fieldid', $fieldid )->where('relid',$relid)->delete();
        return 'success';
    } else{
        print_r('clients are not exists');
        logActivity('Unable to fetch client ID');
        // die;
        return 'error';
    }
    }
    
}
