<?php

namespace AWSlightsailModule\Createoptions;

use WHMCS\Database\Capsule;
use Aws\Lightsail\LightsailClient as LightsailClient;
use Aws\Exception\AwsException;
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
global $CONFIG;
$version = substr($CONFIG['Version'], 0, 5);

class AWSlightsail {
    private $apiKey;
    private $secretKey;

    public Function __construct($apiKey = null, $secretKey = null) {
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
    }

    public Function CreateCustomFields($pid) {

        $customfieldarray = [
            'serverid' => [
                'type' => 'product',
                'fieldname' => 'server_id|Server ID',
                'relid' => $pid,
                'fieldtype' => 'text',
                'description' => 'Only for admin',
                'adminonly' => 'on',
                'sortorder' => '0'
            ],
            'instancename' => [
                'type' => 'product',
                'fieldname' => 'instancename|Instance Name',
                'relid' => $pid,
                'fieldtype' => 'text',
                'description' => 'Only for admin',
                'adminonly' => 'on',
                'sortorder' => '0'
            ],
             'additionaldisk' => [
                'type' => 'product',
                'fieldname' => 'additionaldisk|Additional Disk',
                'relid' => $pid,
                'fieldtype' => 'text',
                'description' => 'Only for admin',
                'adminonly' => 'on',
                'sortorder' => '0'
            ],
             'sshkeypair' => [
                'type' => 'product',
                'fieldname' => 'sshkeypair|SSH Keypair',
                'relid' => $pid,
                'fieldtype' => 'text',
                'description' => 'Only for admin',
                'adminonly' => 'on',
                'sortorder' => '0'
            ],
             'staticip' => [
                'type' => 'product',
                'fieldname' => 'staticip|Static IP',
                'relid' => $pid,
                'fieldtype' => 'text',
                'description' => 'Only for admin',
                'adminonly' => 'on',
                'sortorder' => '0'
            ],
              'publicKey' => [
                'type' => 'product',
                'fieldname' => 'publicKey|Public key',
                'relid' => $pid,
                'fieldtype' => 'textarea',
                'description' => 'Only for admin',
                'adminonly' => 'on',
                'sortorder' => '0'
            ],
              'privateKey' => [
                'type' => 'product',
                'fieldname' => 'privateKey|Private key',
                'relid' => $pid,
                'fieldtype' => 'textarea',
                'description' => 'Only for admin',
                'adminonly' => 'on',
                'sortorder' => '0'
            ]

        ];

        foreach ($customfieldarray as $key => $customfieldval) {

            $fieldname = explode('|', $customfieldval['fieldname']);

            if (Capsule::table('tblcustomfields')->where('type', $customfieldval['type'])->where('relid', $customfieldval['relid'])->where('fieldname', 'like', '%' . $fieldname[0] . '%')->count() == 0) {
                Capsule::table('tblcustomfields')->insert($customfieldarray);
            }
        }
    }

    public function apiCall($region = 'us-east-1') {
        $client = new LightsailClient([
            //'profile' => 'default',
            'version' => '2016-11-28',
            'region' => $region,
            'credentials' => array(
                'key' => $this->apiKey,
                'secret' => $this->secretKey
            )
        ]);
        return $client;
    }

    public function getregions($params = null) {
        $client = $this->apiCall();
        $result = $client->getRegions([
            'includeAvailabilityZones' => false,
            'includeRelationalDatabaseAvailabilityZones' => false,
        ]);
        return $result->toArray();
    }

    public function getkeypairs() {
        $client = $this->apiCall();
        $result = $client->getKeyPairs([ 
        ]);
        return $result->toArray();
    }

    public function getbundles($region = null) {
    
        if(empty($region)){
             $client = $this->apiCall();
        }else{
            $client = $this->apiCall($region);
        }
    
        $result = $client->getBundles([
            'includeInactive' => false,
        ]);
       // logModuleCall('AwsLightsail', 'get bundles', $region, $result);
        return $result->toArray();
    }

    public function getblueprints() {

        $client = $this->apiCall();
        $result = $client->getBlueprints([
            'includeInactive' => false,
        ]);
        return $result->toArray();
    }

    public function awslightsail_configurableOption($pid, $platform) {

        $groupname = 'awsgroup' . $pid;
        $result = Capsule::table('tblproductconfiggroups')->where('name', $groupname)->first();
        $groupid = $result->id;

        if (!$groupid) {
            $groupid = Capsule::table('tblproductconfiggroups')
                    ->insertGetId(
                    [
                        "name" => $groupname,
                    ]
            );
        }

        if (Capsule::table('tblproductconfiglinks')->where('gid', $groupid)->where('pid', $pid)->count() == 0) {
            $groupconfiglink = capsule::table('tblproductconfiglinks')->insert(
                    [
                        "gid" => $groupid,
                        "pid" => $pid
                    ]
            );
        }

        $configoptionsarray = [
            'regions' => [
                'configoption' => [
                    'gid' => $groupid,
                    'optionname' => 'regions|Regions',
                    'optiontype' => '1',
                    'qtyminimum' => '',
                    'qtymaximum' => '',
                    'order' => '0',
                    'hidden' => '1'
                ],
            ],
            'blueprint' => [
                'configoption' => [
                    'gid' => $groupid,
                    'optionname' => 'blueprint|Blueprint',
                    'optiontype' => '1',
                    'qtyminimum' => '',
                    'qtymaximum' => '',
                    'order' => '1',
                    'hidden' => '1'
                ],
            ],
            'instance_plans' => [
                'configoption' => [
                    'gid' => $groupid,
                    'optionname' => 'instance_plans|Instance Plan',
                    'optiontype' => '1',
                    'qtyminimum' => '',
                    'qtymaximum' => '',
                    'order' => '2',
                    'hidden' => '1'
                ],
            ],
            'snapshot' => [
                'configoption' => [
                    'gid' => $groupid,
                    'optionname' => 'snapshot|Snapshot',
                    'optiontype' => '4',
                    'qtyminimum' => '1',
                    'qtymaximum' => '5',
                    'order' => '3',
                    'hidden' => '1'
                ],
                "suboptions" => ["snapshot|Snapshot"],
            ],
            'additional_disk' => [
                'configoption' => [
                    'gid' => $groupid,
                    'optionname' => 'additional_disk|Add additional disk',
                    'optiontype' => '4',
                    'qtyminimum' => '0',
                    'qtymaximum' => '256',
                    'order' => '4',
                    'hidden' => '1'
                ],
                "suboptions" => ["additional_disk|Add additional disk"],
            ]
        ];

        foreach ($configoptionsarray as $key => $configoptionvalue) {

            $checkOptionId = capsule::table('tblproductconfigoptions')->where('gid', $groupid)->where('optionname', 'like', '%' . $key . '%')->first();
            $configId = $checkOptionId->id;

            if (empty($checkOptionId)) {
                $configId = Capsule::table('tblproductconfigoptions')->insertGetId($configoptionvalue['configoption']);
            }
            try{
                if ($key == 'regions') {

                    # Get Regions
                    $regions = $this->getregions();
                    foreach ($regions['regions'] as $key => $region) {
                        if (Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' .$region['name']. '%')->count() == 0) {
                                $optionArr = [
                                    'configid' => $configId,
                                    'optionname' => $region['name'] . '|' . $region['displayName'],
                                    'hidden' => '0'
                                ];

                                $subOptionId = Capsule::table('tblproductconfigoptionssub')->insertGetId($optionArr);
                                $this->insertPriceForOptions($subOptionId);
                    
                        } else {
                                $optionArr = [
                                    'hidden' => '0'
                                ];

                                $subOptionId = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $region['name'] . '%')->update($optionArr);
                        }
                    }
                }

                if ($key == 'instance_plans') {
                    $arrregion = ['us-east-2','ap-south-1','ap-southeast-2'];

                    foreach($arrregion as $key=>$val) {
                        $bundles = $this->getbundles($val);
                        foreach ($bundles['bundles'] as $key => $bundle) {
                            $OS_Platform = ($bundle['supportedPlatforms'][0] == 'LINUX_UNIX') ? 'linux' : 'windows';
                        
                            if (Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' .$bundle['bundleId']. '%')->count() == 0) {

                            if ($OS_Platform == $platform) {
                            $optionArr = [
                            'configid' => $configId,
                            'optionname' => $bundle['bundleId'] . '|' . $bundle['name'] . "-{$bundle['bundleId']}" . " (CPU: {$bundle['cpuCount']}, RAM: {$bundle['ramSizeInGb']} Gb, Disk: {$bundle['diskSizeInGb']} Gb) " . $bundle['supportedPlatforms'][0],
                            'hidden' => '0'
                            ];

                            $subOptionId = Capsule::table('tblproductconfigoptionssub')->insertGetId($optionArr);
                            $this->insertPriceForOptions($subOptionId);
                            }else{
                            $optionArr = [
                            'configid' => $configId,
                            'optionname' => $bundle['bundleId'] . '|' . $bundle['name'] . "-{$bundle['bundleId']}" . " (CPU: {$bundle['cpuCount']}, RAM: {$bundle['ramSizeInGb']} Gb, Disk: {$bundle['diskSizeInGb']} Gb) " . $bundle['supportedPlatforms'][0],
                            'hidden' => '1'
                            ];

                            $subOptionId = Capsule::table('tblproductconfigoptionssub')->insertGetId($optionArr);
                            $this->insertPriceForOptions($subOptionId);
                            }  

                            } else {
                            if ($OS_Platform == $platform) {

                            $optionArr = [
                            'hidden' => '0'
                            ];

                            $subOptionId = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $bundle['bundleId'] . '%')->update($optionArr);
                            }else{

                            $optionArr = [
                            'hidden' => '1'
                            ];

                            $subOptionId = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $bundle['bundleId'] . '%')->update($optionArr);
                            }

                        }
                        }
                    }
                }

                if ($key == 'snapshot') {
                    $optsub = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%snapshot%')->count();

                    $insertdata = [
                        "configid" => $configId,
                        "optionname" => "snapshot|Snapshot",
                    ];
                    
                    if ($optsub == 0) {
                        try {
                            $relid = Capsule::table('tblproductconfigoptionssub')->insertGetId($insertdata);
                            $this->insertPriceForOptions($relid);
                        } catch (Exception $ex) {
                            logActivity("Unable to insert data in tblproductconfigoptions: {$ex->getMessage()}");
                        }
                    }
                    // foreach ($configoptionvalue['suboptions'] as $key => $configsubval) {
                    //     $optsub = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $configsubval . '%')->count();
                    //     $insertdata = [
                    //         "configid" => $configId,
                    //         "optionname" => $configsubval,
                    //     ];

                    //     if ($optsub == 0) {
                    //         try {
                    //             $relid = Capsule::table('tblproductconfigoptionssub')->insertGetId($insertdata);
                    //             $this->insertPriceForOptions($relid);
                    //         } catch (Exception $ex) {
                    //             logActivity("Unable to insert data in tblproductconfigoptions: {$ex->getMessage()}");
                    //         }
                    //     } else {
                    //         $relid = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $configsubval . '%')->update($insertdata);
                    //     }
                    // }
                }
                if ($key == 'additional_disk') {

                    $optsub = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%additional_disk%')->count();

                    $insertdata = [
                        "configid" => $configId,
                        "optionname" => "additional_disk|Add additional disk",
                    ];

                    if ($optsub == 0) {
                        try {
                            $relid = Capsule::table('tblproductconfigoptionssub')->insertGetId($insertdata);
                            $this->insertPriceForOptions($relid);
                        } catch (Exception $ex) {
                            logActivity("Unable to insert data in tblproductconfigoptions: {$ex->getMessage()}");
                        }
                    }

                    // foreach ($configoptionvalue['suboptions'] as $key => $configsubval) {
                    //     $optsub = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $configsubval . '%')->count();
                    //     $insertdata = [
                    //         "configid" => $configId,
                    //         "optionname" => $configsubval,
                    //     ];

                    //     if ($optsub == 0) {

                    //         try {
                    //             $relid = Capsule::table('tblproductconfigoptionssub')->insertGetId($insertdata);
                    //             $this->insertPriceForOptions($relid);
                    //         } catch (Exception $ex) {
                    //             logActivity("Unable to insert data in tblproductconfigoptions: {$ex->getMessage()}");
                    //         }
                    //     } else {
                    //        // $relid = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $configsubval . '%')->update($insertdata);
                    //     }
                    // }
                }


                if ($key == 'blueprint') {

                    $blueprints = $this->getblueprints();

                    foreach ($blueprints['blueprints'] as $key => $blueprint) {
    
                        $blueprintPlatform = ($blueprint['platform'] == 'LINUX_UNIX') ? 'linux' : 'windows';
                        if (Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $blueprint['blueprintId'] . '%')->count() == 0) {
                            if ($blueprintPlatform == $platform) {
                                $optionArr = [
                                    'configid' => $configId,
                                    'optionname' => $blueprint['blueprintId'] . '|' . $blueprint['name'] . ' (' . $blueprint['version'] . ')',
                                    'hidden' => '0'
                                ];

                                $subOptionId = Capsule::table('tblproductconfigoptionssub')->insertGetId($optionArr);

                                $this->insertPriceForOptions($subOptionId);
                            } else {
                                $optionArr = [
                                    'configid' => $configId,
                                    'optionname' => $blueprint['blueprintId'] . '|' . $blueprint['name'] . ' (' . $blueprint['version'] . ')',
                                    'hidden' => '1'
                                ];

                                $subOptionId = Capsule::table('tblproductconfigoptionssub')->insertGetId($optionArr);

                                $this->insertPriceForOptions($subOptionId);
                            }
                        } else {

                            if ($blueprintPlatform == $platform) {
                                $optionArr = [
                                    'hidden' => '0'
                                ];
                                $subOptionId = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $blueprint['blueprintId'] . '%')->update($optionArr);
                            } else {
                                $optionArr = [
                                    'hidden' => '1'
                                ];
                                $subOptionId = Capsule::table('tblproductconfigoptionssub')->where('configid', $configId)->where('optionname', 'like', '%' . $blueprint['blueprintId'] . '%')->update($optionArr);
                            }
                        }
                    }
                }
            } catch (AwsException $e) {
                logActivity("Error AWS API: {$e->getAwsErrorMessage()}");
            }
             
        }
    }

    private function insertPriceForOptions($subOptionId) {

        $price_data = Capsule::table('tblcurrencies')->get();
        foreach ($price_data as $priceval) {
            $curr_id = $priceval->id;
            if (Capsule::table('tblpricing')->where('type', 'configoptions')->where('currency', $curr_id)->where('relid', $subOptionId)->count() == 0) {

                Capsule::table('tblpricing')->insert(
                        [
                            'type' => 'configoptions',
                            'currency' => $curr_id,
                            'relid' => $subOptionId,
                            'msetupfee' => '',
                            'qsetupfee' => '',
                            'annually' => '',
                            'biennially' => '',
                            'triennially' => ''
                        ]
                );
            }
        }
    }

    public function getCustomFieldID($fieldname, $relid) {

        $data = Capsule::table('tblcustomfields')->where('type', 'product')->where('relid', $relid)->where('fieldname', 'like', '%' . $fieldname . '%')->first();

        return $data->id;
    }

    public function saveCustomFieldVal($fieldID, $relID, $value = null) {

        if ($value == '')
            $value = '';
        try {

            if (Capsule::table('tblcustomfieldsvalues')->where('fieldid', $fieldID)->where('relid', $relID)->count() == 0)
                Capsule::table('tblcustomfieldsvalues')->insert(['fieldid' => $fieldID, 'relid' => $relID, 'value' => $value]);
            else
                Capsule::table('tblcustomfieldsvalues')->where('fieldid', $fieldID)->where('relid', $relID)->update(['value' => $value]);
        } catch (Exception $e) {

            $status = $e->getMessage();
            logActivity('Unable to update the data ' . $status);
        }
    }

    public function Createinstance($params) {
        $clientChoosePlan = $params['configoption9'];

        if($clientChoosePlan == 'on'){
            $zone = $params['configoptions']['regions'];
            $bundleid =  $params['configoptions']['instance_plans'];
            $blueprintid  = $params['configoptions']['blueprint'];
        }else{
            $zone = $params['configoption4'];
            $bundleid = $params['configoption7'];
            $blueprintid  = $params['configoption6'];
        }
           
        $firstname    = $params['clientsdetails']['firstname'];
        $serviceid    = $params['serviceid'];
        $instancename = $params['customfields']['instancename'];
        $keyPairName  = $params['keyPairData']['keyPair']['name'];
        
        if ($instancename == '')
            if ($params['configoption10'] == "") {
                $instancename = "whmcs";
            } else {
                $instancename = $params['configoption10'];
            }
            $instancename = $instancename . "-" . $serviceid;

        $data = [
            'availabilityZone'  =>  $zone . 'a',
            'blueprintId'       => $blueprintid,
            'bundleId'          => $bundleid,
            'instanceNames'     => [$instancename],
            'keyPairName'       => $keyPairName,
            'tags'              => []
        ];
        
        // echo"<pre>";
        // print_r($params);
        // print_r($data);die;
        $getscrt = preg_replace('/\v+|\\\r\\\n/Ui',PHP_EOL,$params['launchScript']); 

        $data['userData'] = $getscrt;
        $client = $this->apiCall($zone);

        $result = $client->createInstances($data);
        logModuleCall('AwsLightsail', 'Create Instance', $data, $result);
        return $result->toArray();
    }

    public function Deleteinstance($params,$instancename) {
        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
       
        $data = [
            'instanceName' => $instancename,
        ];

        $client = $this->apiCall($zone);

        $result = $client->deleteInstance($data);
        logModuleCall('AwsLightsail', 'Delete Instance', $data, $result);
        return $result->toArray();
    }

    public function getInstanceAcessDetail($params) {
         
        $instancename = $params['resourceName'];
        if($instancename == ''){
            $instancename = $params['customfields']['instancename'];
        }

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
        
        $OS = $params['configoption5'];
		
        if (strtolower($OS) == "linux") {
            $protocol = 'ssh';
        } elseif (strtolower($OS) == "windows") {
            $protocol = 'rdp';
           sleep(50); 
        }

        $data = [
            'instanceName'  => $instancename,
            'protocol'      => $protocol,
        ];
        
        $client = $this->apiCall($zone);
        $result = $client->getInstanceAccessDetails($data);
		
        logModuleCall('AwsLightsail', 'Get Instance Access Detail', $data, $result);
        return $result->toArray();
    }

    public function Getinstance($params, $instancename = null) {
        if(empty($instancename)){
             $instancename = $params['customfields']['instancename'];
        }
       
        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
        
        $data = [
            'instanceName' => $instancename,
        ];

        $client = $this->apiCall($zone);

        try {
            $result = $client->getInstance($data);
        } catch (AwsException $e) {
             // getAwsErrorMessage
            $result = [
                'instance' => [
                    'name'  =>  ''
                ],
                'errorMessage' => $e->getAwsErrorMessage()
            ];
            return $result;
        }
      
        logModuleCall('AwsLightsail', 'Get Instance', $data, $result);
        return $result->toArray();
    }

    public function GetInstancePortStates($params) {

        $instancename = $params['customfields']['instancename'];

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $data = [
            'instanceName' => $instancename,
        ];

        $client = $this->apiCall($zone);

        $result = $client->GetInstancePortStates($data);

        logModuleCall('AwsLightsail', 'Get Instance PortStates', $data, $result);

        return $result->toArray();
    }

    public function Stopinstance($params, $action = null) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $data = [
            'force' => false,
            'instanceName' => $instancename,
        ];

        $client = $this->apiCall($zone);

        $result = $client->stopInstance($data);

        logModuleCall('AwsLightsail', $action, $data, $result);

        return $result->toArray();
    }

    public function Rebootinstance($params, $action = null) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $data = [
            'instanceName' => $instancename,
        ];

        $client = $this->apiCall($zone);
        $result = $client->rebootInstance($data);

        logModuleCall('AwsLightsail', $action, $data, $result);
        return $result->toArray();
    }

    public function Startinstance($params, $action = null) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $data = [
            'instanceName' => $instancename,
        ];

        $client = $this->apiCall($zone);

        $result = $client->startInstance($data);

        logModuleCall('AwsLightsail', $action, $data, $result);
        return $result->toArray();
    }

    public function createSnapshot($params, $snapshot_name, $action = null) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $data = [
            'instanceName' => $instancename,
            'instanceSnapshotName' => $snapshot_name,
        ];

        $client = $this->apiCall($zone);

        $result = $client->CreateInstanceSnapshot($data);
		
        logModuleCall('AwsLightsail', $action, $data, $result);
        return $result->toArray();
    }

    public function getSnapshots($params, $action = null) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $data = [
            'instanceName' => $instancename,
        ];

        $client = $this->apiCall($zone);
        $result = $client->GetInstanceSnapshots($data);
        logModuleCall('AwsLightsail', $action, $data, $result);
        return $result->toArray();
    }

    public function deleteSnapshot($params, $snapshot_name, $action = null) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $data = [
            'instanceSnapshotName' => $snapshot_name,
        ];

        $client = $this->apiCall($zone);
        $result = $client->DeleteInstanceSnapshot($data);

        logModuleCall('AwsLightsail', $action, $data, $result);
        return $result->toArray();
    }

    public function createInstanceFrmSshot($params, $snapshot_name, $action = null) {

        $keypairname = $params['customfields']['sshkeypair'];
        $oldinstancename = $params['customfields']['instancename'];
        $staticip = $params['customfields']['staticip'];
        $oldadditionaldisk = $params['customfields']['additionaldisk'];

        $this->detachstaticIp($staticip, $params);
        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
        //$firstname = $params['clientsdetails']['firstname'];

        $serviceid = $params['serviceid'];
        if ($params['configoption10'] == "") {
            $instancename = "whmcs";
        } else {
            $instancename = $params['configoption10'];
        }

        $instancename = $instancename . "-" . $serviceid . "-" . $snapshot_name;

        $bundleid =  $params['configoptions']['instance_plans'];
        // $bundleid =  $params['configoption5'],
        $data = [
           /* 'addOns' => [
                [
                    'addOnType' => 'AutoSnapshot',
                ],
            ],*/
            'availabilityZone'      => $zone . 'a',
            'bundleId'              => $bundleid,
            'instanceNames'         => [$instancename],
            'instanceSnapshotName'  => $snapshot_name,
            'keyPairName'           =>  $keypairname,
        ];
     
        $client = $this->apiCall($zone);
        $result = $client->createInstancesFromSnapshot($data);

        logModuleCall('AwsLightsail', "create instance from snapshot", $data, $result);
        $createInstanceResult = $result->toArray();
        if($createInstanceResult['operations']['0']['id'] != ''){
            sleep(50);
            $attachip = $this->attachstaticIp($instancename, $params);
               
            $getServerFieldID           = $this->getCustomFieldID('server_id', $params['pid']);
            $getInstanceFieldID         = $this->getCustomFieldID('instancename', $params['pid']);
            $getadditionaldiskFieldID   = $this->getCustomFieldID('additionaldisk', $params['pid']);

            $this->saveCustomFieldVal($getServerFieldID, $params['serviceid'], $createInstanceResult['operations']['0']['id']);
            $this->saveCustomFieldVal($getInstanceFieldID, $params['serviceid'], $createInstanceResult['operations']['0']['resourceName']);
            
            $getInstance =  $this->Getinstance($params,$createInstanceResult['operations']['0']['resourceName']); 
            $additional_disk_name = array_column($getInstance['instance']['hardware']['disks'], 'name' )[0];
          //  print_r($getInstance);
            $this->saveCustomFieldVal($getadditionaldiskFieldID, $params['serviceid'],  $additional_disk_name);
            $deleteinstance = $this->Deleteinstance($params,$oldinstancename);
            sleep(50);
            if(isset($oldadditionaldisk) && $oldadditionaldisk !=""){
                $deletedisk = $this->deletedisk($params,$oldadditionaldisk);
            }
            
            if(isset($snapshot_name) && $snapshot_name !=""){
                $this->deleteSnapshot($params, $snapshot_name,'Delete Old Instance Snapshot');
            }
                return  $attachip;
        }else{
            $this->attachstaticIp($oldinstancename, $params);
          return $createInstanceResult->toArray();
        }
      
    }

    public function connectByRdp($params, $action = null) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $data = [
            'instanceName'  => $instancename,
            'portInfo'      => [
                                'cidrListAliases' => ['lightsail-connect'],
                                'cidrs' => [],
                                'fromPort' => 6,
                                'protocol' => 'tcp',
                                'toPort' => 8,
                            ],
        ];

        $client = $this->apiCall($zone);
        $result = $client->OpenInstancePublicPorts($data);

        logModuleCall('AwsLightsail', $action, $data, $result);
      
        return $result->toArray();
    }

    /*     * * GB to MB *** */

    public function filesize_format($RamsizeinGB) {

        if ($RamsizeinGB < 1) {

            $RamsizeinMB = 1024 * $RamsizeinGB . " MB";

            return $RamsizeinMB;
        } else {

            $RamsizeinGB = $RamsizeinGB . " GB";

            return $RamsizeinGB . "GB";
        }
    }

    public function GetOperations($params) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $data = [
            'instanceName' => $instancename,
        ];

        $client = $this->apiCall($zone);
        $result = $client->getOperations();

        logModuleCall('AwsLightsail', 'Get Operations', $data, $result);
        return $result->toArray();
    }

    public function GetMetric($params = [], $time_period = '1h', $metricName = null, $unit = null, $statistics = null) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $getTime = $this->timerange($time_period);

        $end = $getTime['endtime'];

        $start = $getTime['starttime'];

        $period = $getTime['period'];

        $data = [
            'endTime'      => $end,
            'instanceName' => $instancename,
            'metricName'   => $metricName,
            'period'       => $period,
            'startTime'    => $start,
            'statistics'   => [$statistics],
            'unit'         => $unit,
        ];

        $client = $this->apiCall($zone);
        $result = $client->getInstanceMetricData($data);

        logModuleCall('AwsLightsail', 'Get Metric Data', $data, $result);
        return $result->toArray();
    }

    public function GetMetric_network($params, $time_period = '1h') {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $getTime = $this->timerange($time_period);

        $end = $getTime['endtime'];

        $start = $getTime['starttime'];

        $period = $getTime['period'];

        $data = [
            'endTime'      => $end,
            'instanceName' => $instancename,
            'metricName'   => 'NetworkIn',
            'period'       => $period,
            'startTime'    => $start,
            'statistics'   => ['Average'],
            'unit'         => 'Bytes',
        ];

        $client = $this->apiCall($zone);
        $result = $client->getInstanceMetricData($data);

        logModuleCall('AwsLightsail', 'Get Metric network Data', $data, $result);
        return $result->toArray();
    }

    function timerange($time_period) {

        $datetime = date('Y-m-d H:i:s');

        if ($time_period == '1h') {
            $newtime = date('Y-m-d H:i:s', strtotime($datetime . '-1 hour'));
            $period = 60;
        } elseif ($time_period == '6h') {
            $newtime = date('Y-m-d H:i:s', strtotime($datetime . '-6 hours'));
            $period = 60;
        } elseif ($time_period == '1d') {
            $newtime = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($datetime)));
            $period = 60;
        } elseif ($time_period == '1w') {
            $newtime = date('Y-m-d H:i:s', strtotime('-7 days', strtotime($datetime)));
            $period = 3600;
        } elseif ($time_period == '2w') {
            $newtime = date('Y-m-d H:i:s', strtotime('-14 days', strtotime($datetime)));
            $period = 3600;
        }

        $end = strtotime($datetime);

        $start = strtotime($newtime);

        return ['endtime' => $end, 'starttime' => $start, 'period' => $period];
    }

    public function GetMetric_NetworkOut($params, $time_period = '1h') {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $instancename = $params['customfields']['instancename'];

        $getTime = $this->timerange($time_period);

        $end = $getTime['endtime'];
        $start = $getTime['starttime'];
        $period = $getTime['period'];

        $data = [
            'endTime'      => $end,
            'instanceName' => $instancename,
            'metricName'   => 'NetworkOut',
            'period'       => $period,
            'startTime'    => $start,
            'statistics'   => ['Average'],
            'unit'         => 'Bytes',
        ];

        $client = $this->apiCall($zone);
        $result = $client->getInstanceMetricData($data);

        logModuleCall('AwsLightsail', 'Get Metric network Data', $data, $result);
        return $result->toArray();
    }

    public function CreateEmailtemplate() {

        $emailarray = array(
            'emailarr' => array(
                'name' => 'AWS Server Information',
                'subject' => 'AWS Server Information',
                'type' => 'product',
                'message' => '<p><b>Dear {$client_name},</b></p><p>Your Server has been Created Successfully. Your Server details are given below.<p><b>Server Name:</b> {$server_name}</p><p><b>Public IP:</b> {$server_pub_ip}</p><p><b>User Name:</b> {$server_user_name}</p><br><p><b>Protocol:</b> {$server_protocol}</p><pre>{$aws_server_info}</pre><br /><p>Thank you</p>'
            )
        );

        foreach ($emailarray as $emailval) {
            $name = $emailval['name'];

            $email_temp_id = Capsule::table('tblemailtemplates')->where('type', 'product')->where('name', $name)->first();

            if (!$email_temp_id) {
                Capsule::table('tblemailtemplates')->insert($emailval);
            }
        }
    }

    public function Createinstanceaccesstable() {

        try {

            if (!Capsule::Schema()->hasTable('mod_lightsail_access_detail')) {
                Capsule::schema()->create(
                        'mod_lightsail_access_detail', function ($table) {

                    $table->increments('id');
                    $table->string('instancename', '150');
                    $table->integer('instance_id');
                    $table->integer('service_id');
                    $table->integer('pid');
                    $table->integer('status');
                    $table->string('protocol', '150');
                }
                );
            }
             if (!Capsule::Schema()->hasTable('mod_lightsail_cron_services')) {
                Capsule::schema()->create(
                        'mod_lightsail_cron_services', function ($table) {

                    $table->increments('id');
                    $table->integer('serviceid');
                    $table->string('status');
                }
                );
            }
        } catch (\Exception $e) {
            logActivity("Unable to create mod_lightsail_access_detail: {$e->getMessage()}");
        }
    }

    public function insertinstanceaccesstable($params, $instance) {

        $instancename = $instance['operations'][0]['resourceName'];
        $instanceid = $instance['operations'][0]['id'];
        $pid = $params['pid'];
        $serviceid = $params['serviceid'];
        $OS = $params['configoption5'];

        if (strtolower($OS) == "linux") {
            $protocol = 'ssh';
        } elseif (strtolower($OS) == "windows") {
            $protocol = 'rdp';
        }

        if (Capsule::table('mod_lightsail_access_detail')->where('instancename', $instancename)->count() == 0) {

            $getdata = capsule::table('mod_lightsail_access_detail')->insert(
                    [
                        "instancename" => $instancename,
                        "instance_id"  => $instanceid,
                        "pid"          => $pid,
                        "service_id"   => $serviceid,
                        "status"       => "0",
                        "protocol"     => $protocol
                    ]
            );
        }
    }

    public function allocatestaticIp($params) {

        if($params['configoption9']== "on"){
            $zone = $params['configoptions']['regions'];
        }
        else{
            $zone = $params['configoption4'];
        }

        $serviceid = $params['serviceid'];

        $data = [
            'staticIpName' => 'static-ip-' . $serviceid,
        ];

        $client = $this->apiCall($zone);
        $result = $client->allocateStaticIp($data);

        logModuleCall('AwsLightsail', 'Allocate Static Ip', $data, $result);
        return $result->toArray();
    }

    public function attachstaticIp($instancename, $params) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
        $serviceid = $params['serviceid'];

        $data = [
            'instanceName' => $instancename, // REQUIRED
            'staticIpName' => 'static-ip-' . $serviceid,
        ];

        $client = $this->apiCall($zone);
        $result = $client->attachStaticIp($data);
        logModuleCall('AwsLightsail', 'attach Static Ip', $data, $result);

        return $result->toArray();
    }

    public function detachstaticIp($staticipName, $params) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
        

        $data = [
            'staticIpName' => $staticipName,
        ];

        $client = $this->apiCall($zone);
        $result = $client->DetachStaticIp($data);
        logModuleCall('AwsLightsail', 'Detach Static Ip', $data, $result);

        return $result->toArray();
    }

    public function createkeypair($params) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
       
        $client  = $this->apiCall($zone);

        if ($params['configoption10'] == "") {
            $keyPairPrefix = "whmcs";
        } else {
            $keyPairPrefix = $params['configoption10'];
        }
        $keyname = $keyPairPrefix . $params['serviceid'];
        $data    = [
                    'keyPairName' => $keyname,
                   ];
        
        $result = $client->CreateKeyPair($data);
        logModuleCall('AwsLightsail', 'Create SSH', $data, $result);
        return $result->toArray();
    }

    public function additionaldisk($params, $diskname) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        if ($params['configoption10'] == "") {
            $instancename = "whmcs";
        } else {
            $instancename = $params['configoption10'];
        }
       
        $instancename = $instancename . '-' . $params['serviceid'];

        $data = [
            "diskName"     => $diskname,
            "diskPath"     => "/dev/xvdf",
            "instanceName" => $instancename
        ];

        $client = $this->apiCall($zone);
        $result = $client->AttachDisk($data);
        logModuleCall('AwsLightsail ', 'attached disk', $data, $result);
        return $result->toArray();
    }

    public function createdisk($params) {

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
       
        if ($params['configoption10'] == "") {
            $machinename = "whmcs";
        } else {
            $machinename = $params['configoption10'];
        }
        //$machinename = $params['clientsdetails']['firstname'];
        $machinename = $machinename .'-'.$params['serviceid'].'-1';
        $status      = '';
        $disksize    = $params['configoptions']['additional_disk'];
        $availabilityZones = $zone . 'a';

        $data = [
            "availabilityZone" => $availabilityZones,
            "diskName" => $machinename,
            "sizeInGb" => $disksize,
            "tags"     => []
        ];

        $client = $this->apiCall($zone);

        $result = $client->CreateDisk($data);
        logModuleCall('AwsLightsail ', 'create disk', $data, $result);
        $arrresult = $result->toArray();
        if ($arrresult['operations']['0']['id'] != '') {

            $diskname = $arrresult['operations'][0]['resourceName'];
            sleep(30);
            $attacheddisk = $this->additionaldisk($params, $diskname);
             return $attacheddisk;
        } else {
            return $status = "Error: errorCode: " . $arrresult['operations']['0']['errorCode'] . " errorDetails: " . $arrresult['operations']['0']['errorDetails'];
        }

    }

    public function deletefirewallrule($params,$data) {
         
        $delprotocol = $data['protocol'];
        $del_fromport = $data['fromport'];
        $del_toport = $data['toport'];
        $protinfoarr = array();
        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
        $alreadyportget = $this->GetInstancePortStates($params);
        // print_r($alreadyportget['portStates']); die;
        foreach ($alreadyportget['portStates'] as $key => $value) {
            if($value['toPort'] == $del_toport && $value['fromPort']  == $del_fromport && $value['protocol'] == $delprotocol){
               
            }else{
                $protinfoarr[] = [
                    'cidrListAliases' => [],
                    'cidrs'           => $value['cidrs'],
                    'fromPort'        => $value['fromPort'],
                    'protocol'        => $value['protocol'],
                    'toPort'          => $value['toPort']
                ];
            }
        }

        $instancename = $params['customfields']['instancename'];

        $data = [
            'instanceName'  => $instancename,
            'portInfos'     => $protinfoarr
        ];

        $client = $this->apiCall($zone);
        $result = $client->PutInstancePublicPorts($data);
        $result =  $result->toArray();
	   
        if ($result['operation']['id'] != '' ) {
            return $result;
        }else{
            return $status = "Error: errorCode: " . $result['operations']['0']['errorCode'] . " errorDetails: " . $result['operations']['0']['errorDetails'];
        }
    }

    public function addfirewalrule($params, $data) {
         
        $protinfoarr = array();
        $newrule = array();
        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $alreadyportget = $this->GetInstancePortStates($params);
		if (count($alreadyportget['portStates']) > 0){

            foreach ($alreadyportget['portStates'] as $key => $value) {
                if($value['protocol'] == -1){
                    $value['protocol'] = 'all';
                }
              
                $protinfoarr[] = [
                   // 'cidrListAliases' => ["lightsail-connect"],
                    'cidrs'    => $value['cidrs'],
                    'fromPort' => $value['fromPort'],
                    'protocol' => $value['protocol'],
                    'toPort'   => $value['toPort']
                ];
            } 
        }
              	   
        $instancename = $params['customfields']['instancename'];
        $protocol = strtolower($data['protocol']);
       
        $fromport = $data['port'];
        $toport = $data['port'];
        
        if($fromport == "0 - 65535"){
            $fromport= 0;
            $toport = 65535;
        }

        if($fromport == 8){
            $toport = -1;
        }
       
        if($protocol == 'icmp' && isset($data['type']) && isset($data['code'])){
            $fromport = $data['type'];
            $toport   = $data['code'];  
            //$restrict_ips = $data['ip'];  
        }
        if(!empty($data['ip'])){
            $getips = implode("/32,",$data['ip']);
            $ips = explode(",",$getips);
            $index = count(  $ips ) - 1;
            $ips[$index] = $ips[$index].'/32';
        }else{
            $ips[0] = "0.0.0.0/0";
        }
       
        // new rule add
        $newrule[] = [
           // 'cidrListAliases' => [],
            'cidrs'    => $ips,
            'fromPort' => intval($fromport),
            'protocol' => $protocol,
            'toPort'   => intval($toport),
        ];
      
        $finalarr = array_merge($protinfoarr, $newrule);
		
        $data = [
            'instanceName' => $instancename,
            'portInfos'    => $finalarr
        ];

        $client = $this->apiCall($zone);
        $result = $client->PutInstancePublicPorts($data);
		logModuleCall('AwsLightsail ', 'add firewall rule (clientarea)', $data, $result);
        $result = $result->toArray();
		
        if ($result['operation']['id'] != '') {
            return $result;
        }else{
            return $status = "Error: errorCode: " . $result['operation']['errorCode'] . " errorDetails: " . $result['operation']['errorDetails'];
        }
    } 

    public function updatefirewalrule($params,$data) {
        $protinfoarr  = array();
        $newrule      = array();
        $newprotocol  = strtolower($data['protocol']);
        $nnewport     = $data['port'];
	
        $delprotocol  = strtolower($data['delprotocol']);
        $del_toport   = $data['deltoport'];
        $del_fromport = $data['delfromport'];
        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }

        $alreadyportget = $this->GetInstancePortStates($params);
		
        foreach ($alreadyportget['portStates'] as $key => $value) {
            if($value['toPort'] == $del_toport && $value['fromPort'] == $del_fromport && $value['protocol'] == $delprotocol){
               
            }else{
                $protinfoarr[] = [
                    //  'cidrListAliases' => [],
                    'cidrs'    => $value['cidrs'],
                    'fromPort' => $value['fromPort'],
                    'protocol' => $value['protocol'],
                    'toPort'   => $value['toPort']
                ];
            }
        }
        $instancename = $params['customfields']['instancename'];		
        $protocol = strtolower($data['protocol']);
        $port = intval($data['port']);

        if(!empty($data['ip'])){
            $getips = implode("/32,",$data['ip']);
            $ips = explode(",",$getips);
            $index = count(  $ips ) - 1;
            $ips[$index] = $ips[$index].'/32';
        }else{
            $ips[0] = "0.0.0.0/0";
        }
       
        $newrule[] = [
           // 'cidrListAliases' => [],
            'cidrs'    => $ips,
            'fromPort' => $port,
            'protocol' => $protocol,
            'toPort'   => $port,
        ];

        $finalportarry = array_merge($protinfoarr, $newrule);		
		 
        $data = [
            'instanceName' => $instancename,
            'portInfos'    => $finalportarry
        ];
        
        $client = $this->apiCall($zone);
        $result = $client->PutInstancePublicPorts($data);
        $result = $result->toArray();			
        if ($result['operation']['id'] != '') {
            return $result;
        }else{
            return $status = "Error: errorCode: " . $result['operation']['errorCode'] . " errorDetails: " . $result['operation']['errorDetails'];
        }
    }

    public function deletedisk($params,$diskname){

        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
      
        $data = [
            "diskName" => $diskname,
        ];

        $client = $this->apiCall($zone);
        
        $result = $client->DeleteDisk($data);
        logModuleCall('AwsLightsail ', 'Delete disk', $data, $result);
        return $result->toArray();
    } 

    public  function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function deletekeypair($params) {
        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
        $client  = $this->apiCall($zone);
        $keyname =  $params['customfields']['sshkeypair'];

        $data = [
            'keyPairName' => $keyname,
        ];

        $result = $client->DeleteKeyPair($data);
        logModuleCall('AwsLightsail', 'Delete SSH key', $data, $result);
        return $result->toArray();
    }
    public function deletestaticip($params) {
        if($params['configoption9'] == "on"){
            $zone = $params['configoptions']['regions'];
        }else{
            $zone = $params['configoption4'];
        }
        $client = $this->apiCall($zone);
        $staticip =  $params['customfields']['staticip'];
        
        $data = [
            'staticIpName' => $staticip,
        ];

        $result = $client->ReleaseStaticIp($data);
        logModuleCall('AwsLightsail', 'Delete Static IP', $data, $result);
        return $result->toArray();
    }

    /*     * ************Access detail email section ************* */

    public function accessdetailsendmail($AcessDetail, $privatekey, $certkey, $params) {
   
        $serviceid = $params['serviceid'];
        $protocol = $AcessDetail['accessDetails']['protocol'];
        $public_ip_address = $AcessDetail['accessDetails']['ipAddress'];
        $server_name = $AcessDetail['accessDetails']['instanceName'];
        $username = $AcessDetail['accessDetails']['username'];
        if($params['awsuser'] != '' ||   $params['awspwd'] !=''){
            $wp_user = $params['awsuser'];
            $wp_password = $params['awspwd'];
        }
        $server_login_pw = $AcessDetail['accessDetails']['password'];
        $ciphertext = $AcessDetail['accessDetails']['passwordData']['ciphertext'];
       
        $aws_server_info = '';

        if ($protocol == "rdp" && $server_login_pw == "") {
            logActivity('Password is empty for serviceid: ' . $serviceid);
        } elseif ($protocol == "rdp" && $server_login_pw != '') {
            $aws_server_info .= '<p><b>Password: </b>' . $server_login_pw . '</p><p><b>ciphertext: </b>' . $ciphertext . '</p>';
        } elseif ($protocol == "ssh") {
            if ($server_login_pw != '') {
                $aws_server_info .= '<p><b>Password: </b>' . $server_login_pw . '</p>';
            } else {
                $aws_server_info .= '<p><b>CERT KEY : </b>' . $certkey . '</p><br><hr><p><b>PRIVATE KEY : </b>' . $privatekey . '</p>';
            }
        }

        if($AcessDetail['accessDetails']['username'] == 'bitnami' && $wp_user !='' && $wp_password !=''){
            $aws_server_info .= '<p><b>Panel Details: </b></p>';
            $aws_server_info .= '<p><b>Admin: </b>' . $wp_user . '</p>';
            $aws_server_info .= '<p><b>Password: </b>' . $wp_password . '</p>';
        }

        if ($aws_server_info == '') {
            logActivity('No server information for serviceid: ' . $serviceid);
        } else {
            $command = 'SendEmail';
            $postData = array(
                'messagename' => 'AWS Server Information',
                'id' => $serviceid,
                'customvars' => base64_encode(serialize(array("server_name" => $server_name, "server_pub_ip" => $public_ip_address, "server_user_name" => $username, "aws_server_info" => $aws_server_info, "server_protocol" => strtoupper($protocol)))),
            );
            $adminUsername = '';
            logModuleCall('AwsLightsail', 'accessdetailsendmail', ['instanceName' => $server_name, 'protocol' => $protocol], $AcessDetail);
            $sendmailresult = localAPI($command, $postData, $adminUsername);
            if ($sendmailresult['result'] == 'success') {
                $qry = Capsule::table('mod_lightsail_access_detail')->where('id', $getvalue->id)->update(['status' => '1']);
            } else {
                logActivity('Email send failed for serviceid: ' . $serviceid . ' Error: ' . $sendmailresult['message']);
            }
        }
    }

	function getapplicationname($protocol,$fromPort,$toport){

    	if($protocol =='tcp' && $toport == 22 ){
    		$application = "SSH";
    	}if($protocol =='tcp' && $toport == 80){
    		$application = "HTTP";
    	}if($protocol =='tcp' && $toport == 443){
    		$application = "HTTPs";
    	}if($protocol =='tcp' && $toport == 65535){
    	    $application = "All TCP";
    	}if($protocol =='udp' && $toport == 65535){
    		$application ="All UDP";
    	}if($protocol =='-1' && $toport == 65535){
    		$application = "All protocols";
    	}if($protocol =='tcp' && $toport == 3389){
    		$application ="RDP";
    	}if($protocol =='tcp' && $toport == 3306){
    		$application = "MySQL/Aurora";
    	}if($protocol =='tcp' && $toport == 1521){
    		$application = "Oracle-RDS";
    	}if($protocol =='tcp' && $toport == 5432){
    	    $application = "PostgreSQL";
    	}if($protocol =='tcp' && $toport == 53){
    		$application = "DNS (TCP)";
    	}if($protocol =='udp' && $toport == 53){
    		$application = "DNS (UDP)";
    	}if($protocol =='icmp' && $fromPort == 8){
    		$application = "Ping (ICMP)";
    	}if($protocol =='icmp' && $toport == 0 && $fromPort != 8){
    		$application = "Custom ICMP";
    	}if($protocol =='icmp' &&  $toport == -1 && $fromPort != 8){
    		$application = "All ICMP";
    	} 
    	return $application;
    }

}

?>