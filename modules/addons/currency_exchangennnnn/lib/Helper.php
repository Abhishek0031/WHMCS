<?php
namespace WHMCS\Module\Addon\currency_exchange;
use WHMCS\Database\Capsule;

class Helper
{
    public function currencyDropDown() 
    {        
        try{
        $currencyData = Capsule::table('tblcurrencies')->get();
        return $currencyData;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function insertCode($formData) 
    {        
        global $whmcs;
        $error = '';
        if(!isset($formData['select_currency']) &&  !isset($formData['select_country'])){
            $msg = ['status' => "error", 'message' => '* Please Select Country and Currency.'];
            return $msg;
        } elseif(!isset($formData['select_currency'])){
            $msg = ['status' => "error", 'message' => '* Please Select Currency.'];
            return $msg;
        } elseif(!isset($formData['select_country'])){
            $msg = ['status' => "error", 'message' => '* Please Select Country.'];
            return $msg;
        } else{
            try {
                $insertData = [
                "currencyId" => $formData['select_currency'],
                "cuntryId" => $formData['select_country'],
                "created_at" => date("Y-m-d H:i:s", time()),
                "updated_at" => date("Y-m-d H:i:s", time())
            ];

            $exchangeId = (Capsule::table('currency_exchange')->select('id')->first())->id;
            if((Capsule::table('currency_exchange')->count()) !== 0){
                $result = Capsule::table('currency_exchange')->where('id', $exchangeId)->update($insertData);
                $msg = ['status' => "success", 'message' => 'Data Update Successfully.'];
                return $msg;
            } else{
                $result =  Capsule::table('currency_exchange')->insert($insertData);
                $msg = ['status' => "success", 'message' => 'Data Inserted Successfully.'];
                return $msg;
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
        }
    }


    public function createCustomField()
    {
        $custumfeildArray = [  
            [
                'fieldname' => 'exchangeCurrency|Agree Exchange Currency',
                'fieldtype' => 'tickbox',
                'description' => 'I am aware about this price exchange.',
                'regexpr' => '',
                'type' => 'client',
                'relid' => '',
                'showinvoice' => '',
                'showorder' => 'on',
                'required' => 'on',
                'adminonly' => ''
            ],
        ];

        foreach ($custumfeildArray as $element) {
            $CheckFieldName = explode('|', $element['fieldname'])[0] . '%';
            $checkCount = count(
                Capsule::table('tblcustomfields')
                    ->where([
                        ['fieldname', 'like', $CheckFieldName],
                        ['relid', $element['relid']],
                        ['type', $element['type']]
                    ])->get()
            );

            if ($checkCount == 0) {
                Capsule::table("tblcustomfields")->insert($element);
            }
        }
    }


    public function checkCustumFeildValue($fieldName,$type,$clientId)
    {
        try{
        $CheckFieldName = explode('|', $fieldName)[0] . '%';
        $custumFeildData = Capsule::table('tblcustomfields')
        ->join('tblcustomfieldsvalues', 'tblcustomfieldsvalues.fieldid', '=', 'tblcustomfields.id' )
        ->where([
            ['tblcustomfields.fieldname', 'like', $CheckFieldName],
            ['tblcustomfields.type', $type],
            ['tblcustomfieldsvalues.relid', $clientId]
        ])
        ->value(
            'tblcustomfieldsvalues.value',
        );
        if($custumFeildData == ''){
            $custumFeildData = 'off';
        }
        return $custumFeildData;

    } catch (\Exception $e) {
        logActivity("Error Exchange Currency Custumfeild Values" . $e->getMessage());
    }
    }
}