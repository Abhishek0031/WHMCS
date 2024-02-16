<?php

use WHMCS\Database\Capsule;
use AWSlightsailModule\Createoptions\AWSlightsail as AWSlightsailcall;

 if(file_exists(__DIR__ . '/class.createfields.php'))
   include_once __DIR__ . '/class.createfields.php';

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

if(isset($_POST['activity']) && $_POST['activity'] != '')
{
	$act = $_POST['activity'];
  switch ($act)   
  {
   	case 'reboot':   
      try
      {
       if($params['customfields']['instancename'] == '')
        echo "Error: Instance Name is empty";

        $reboot = $AWSlightsailcall->Rebootinstance($params, 'Reboot Instance');
        $getinstance = $AWSlightsailcall->Getinstance($params); 
        $serverstatus = ucfirst($getinstance['instance']['state']['name']);

        if($reboot['operations']['0']['id'] != '')
        {
          $status = ['status'=>'success', 'serverstatus'=> $serverstatus, 'msg'=>'Rebooted Successfully'];
        }
        else
        {
          $status = "Error: errorCode: ".$instance['operations']['0']['errorCode']." errorDetails: ". $instance['operations']['0']['errorDetails']; 
          $status = ['status'=>'error', 'msg'=> $status ];
        }
      }
      catch(Exception $e)
        {
          $status = ['status'=>'error', 'msg'=>'You cannot Reboot an instance while it is Stopped'];
        }
        echo json_encode($status); 
      		break;
    case 'stop': 
      try
      {
        if($params['customfields']['instancename'] == '')
        echo "Error: Instance Name is empty";
        $Stop = $AWSlightsailcall->Stopinstance($params, 'Suspend Instance'); 
        $getinstance = $AWSlightsailcall->Getinstance($params); 
        $serverstatus = ucfirst($getinstance['instance']['state']['name']);
        if($Stop['operations']['0']['id'] != '')
        {
          $status = ['status'=>'success', 'serverstatus'=> $serverstatus, 'msg'=>'Stopped Successfully'];
        }
        else
        {
          $status = ['status'=>'error', 'msg'=> "Error: errorCode: ".$instance['operations']['0']['errorCode']." errorDetails: ". $instance['operations']['0']['errorDetails']];           
        }

      }
      catch(Exception $e)
      {
          $status = ['status'=>'error', 'msg'=>'You cannot Stop an instance while it is in transition'];
      }   
      echo json_encode($status); 

    break;
    case 'Start': 
      try
      {
        if($params['customfields']['instancename'] == '')
          echo "Error: Instance Name is empty";
        $Start = $AWSlightsailcall->Startinstance($params, 'Unsuspend Instance'); 
        $getinstance = $AWSlightsailcall->Getinstance($params); 
        $serverstatus = ucfirst($getinstance['instance']['state']['name']);
        if($Start['operations']['0']['id'] != '')
        {
          $status = ['status'=>'success', 'serverstatus'=> $serverstatus, 'msg'=>'Started Successfully'];
        }
        else
        {
          $status = "Error: errorCode: ".$instance['operations']['0']['errorCode']." errorDetails: ". $instance['operations']['0']['errorDetails']; 
        }
      }
      catch(Exception $e)
      {
        $status = ['status'=>'error', 'msg'=>'You cannot Start an instance while it is in transition'];
      }
       echo json_encode($status); 
        break;
     case 'Serverstatus':          
      try
      {
        $getinstance = $AWSlightsailcall->Getinstance($params); 
        $serverstatus = ucfirst($getinstance['instance']['state']['name']);        
        if($serverstatus != '')
         {
          $Serstatus = ['status'=>'success', 'serverstatus'=> $serverstatus];
         }
        else
         {
          $Serstatus = ['status'=>'error', 'msg'=>'No Server Status Found'];; 
         }
      }
      catch(Exception $e)
      {
        $Serstatus = ['status'=>'error', 'msg'=>'error'];
      }           
        echo json_encode($Serstatus); 
        break;
        case 'history':          
          $getinstance = $AWSlightsailcall->Getinstance($params); 
          $instancename = $getinstance['instance']['name'];
          $Operations = $AWSlightsailcall->GetOperations($params);
          $html = '';
            if($Operations['operations']['0']['id'] != '')
              {
                 foreach($Operations['operations']  as $operationval)
                  { 				 
                      if($operationval['resourceName'] == $instancename){   
                        $actionName = preg_replace('/(?<!\ )[A-Z]/', ' $0', $operationval['operationType']);
                        
                        $html .= '<tr><td>'.$actionName.'</td><td>'.$operationval['createdAt']->format('Y-m-d H:i:A').'</td><td>'.$operationval['status'].'</td></tr>';                   
                      }
                  }
              }           
            echo $html; 

        break;       
        case 'cpuoverview':
          try
          {           
            $getMetric = $AWSlightsailcall->GetMetric($params,$_POST['time_period'],"CPUUtilization","Percent","Average");
          
            $dataPoints = array();
            $cpuArray = [];

            foreach($getMetric['metricData'] as $metricsdata)

            {  
              $metricdata_r = $metricsdata['average']; 
              $metricdata = round($metricdata_r,2);   
              $matricDateTime = date('Y-m-d H:i:s', strtotime($metricsdata['timestamp']->date)); 
              
              $matric_newtime = date('Y,m,d,H,i,s', strtotime($matricDateTime . ' -1 months'));
              $uTCdateTime = 'Date.UTC(' . $matric_newtime . ')';
              $cpuArray[] = "[" . $uTCdateTime . ", ".$metricdata."]"; 
               
            }
            //Cpu Burst Capacity percentage
              $cpuBurstCapacity = $AWSlightsailcall->GetMetric($params,$_POST['time_period'],"BurstCapacityPercentage","Percent","Average");
              $cpuBurstCapcityArray = [];

            foreach($cpuBurstCapacity['metricData'] as $cpuMetricsdata)
            {  
              $cpuBurstAvg = $cpuMetricsdata['average']; 

              $cpuBurstAvgR = round($cpuBurstAvg,2);   
              $cpuMetricDateTime = date('Y-m-d H:i:s', strtotime($cpuMetricsdata['timestamp'])); 
              $cpuMetric_newtime = date('Y,m,d,H,i,s', strtotime($cpuMetricDateTime . ' -1 months'));
              $metricCpuUTCdateTime = 'Date.UTC(' . $cpuMetric_newtime . ')';
              $cpuBurstCapcityArray[] = "[" . $metricCpuUTCdateTime . ", ".$cpuBurstAvgR."]"; 
               
            }

          $script = '<div id="chartContainer" style="height: 350px; width: 100%;">
            </div><hr><div id="cupBurstContainer" style="height: 350px; width: 100%;">
            </div><script>
          Highcharts.chart("chartContainer", {
                            title: {
                            text: "CPU UTILIZATION"
                            },
                              xAxis: {
                                type: "datetime",
                  
                                dateTimeLabelFormats: {
                                  day: "%e %b %Y",
                                },
                                title: {
                                  text: ""
                                }
                              },

                              yAxis: {

                                min: 0,
                                  title: {
                                    text: "Percentage"
                                  },
                                labels: {
                                  format: "{value}",
                                } 

                              },
                              tooltip: {

                                crosshairs: [true, true],
                                headerFormat: "",
                                pointFormat: "<b>{point.y}%</b><br/> {point.x:%H:%M:%p} <br/> <b>{point.x:%b %e,%Y}</b>",

                              },
                             
                              colors: ["#6CF", "#39F", "#06C", "#036", "#000"],

                              series: [{
                                type: "areaspline",
                                name: "CPUUtilization",
                                data:  ['.implode(",", $cpuArray).'],
                                color: "#78c6de",
                              }]
                          });


                          Highcharts.chart("cupBurstContainer", {
                            title: {
                            text: "CPU BURST CAPACITY"
                            },
                              xAxis: {
                                type: "datetime",
                  
                                dateTimeLabelFormats: {
                                  day: "%e %b %Y",
                                },
                                title: {
                                  text: ""
                                }
                              },

                              yAxis: {

                                min: 0,
                                  title: {
                                    text: "Percentage"
                                  },
                                labels: {
                                  format: "{value}",
                                } 

                              },
                              tooltip: {

                                crosshairs: [true, true],
                                headerFormat: "",
                                pointFormat: "<b>{point.y}%</b><br/> {point.x:%H:%M:%p} <br/> <b>{point.x:%b %e,%Y}</b>",

                              },
                             
                              colors: ["#6CF", "#39F", "#06C", "#036", "#000"],

                              series: [{
                                type: "area",
                                name: "CPU Burst Capacity",
                                data:  ['.implode(",", $cpuBurstCapcityArray).'],
                                color: "#78c6de",
                              }]
                          });
        
        </script>';  
        echo $script;
        die(); 
          }
          catch(Exception $e)
          {
            $script = ['status'=>'error', 'msg'=>$e->getMessage()];
          }
          echo json_encode($script);       
          break;
          case 'cpuurstcapacity':
          try
          {           
           //Cpu Burst Capacity percentage
            if($_POST['metricType'] == "cpuBurstCapacityPer"){
              $cpuBurstCapacity = $AWSlightsailcall->GetMetric($params,$_POST['time_period'],"BurstCapacityPercentage","Percent","Average");
              $metric_Type = 'Percentage';
              $metricPoint = '%';            
            }else{
              $cpuBurstCapacity = $AWSlightsailcall->GetMetric($params,$_POST['time_period'],"BurstCapacityTime","Seconds","Average");
              $metric_Type = 'Minutes';
              $metricPoint = 'Min'; 
            }
            $cpuBurstCapcityArray = [];
            foreach($cpuBurstCapacity['metricData'] as $cpuMetricsdata)
            {  
              if($_POST['metricType'] == "cpuBurstCapacityMin"){
                $cpuBurstAvg = $cpuMetricsdata['average'] / 60;
              }else{
                $cpuBurstAvg = $cpuMetricsdata['average']; 
              }
              $cpuBurstAvgR = round($cpuBurstAvg,2);   
              $cpuMetricDateTime = date('Y-m-d H:i:s', strtotime($cpuMetricsdata['timestamp'])); 
              $cpuMetric_newtime = date('Y,m,d,H,i,s', strtotime($cpuMetricDateTime . ' -1 months'));
              $metricCpuUTCdateTime = 'Date.UTC(' . $cpuMetric_newtime . ')';
              $cpuBurstCapcityArray[] = "[" . $metricCpuUTCdateTime . ", ".$cpuBurstAvgR."]";                
            }
          $script = '<div id="cupBurstContainer" style="height: 350px; width: 100%;">
            </div><script>          
                     Highcharts.chart("cupBurstContainer", {
                            title: {
                            text: "CPU BURST CAPACITY"
                            },
                              xAxis: {
                                type: "datetime",                  
                                dateTimeLabelFormats: {
                                  day: "%e %b %Y",
                                },
                                title: {
                                  text: ""
                                }
                              },
                              yAxis: {
                                min: 0,
                                  title: {
                                    text: "'.$metric_Type.'"
                                  },
                                labels: {
                                  format: "{value}",
                                } 
                              },
                              tooltip: {

                                crosshairs: [true, true],
                                headerFormat: "",
                                pointFormat: "<b>{point.y}'.$metricPoint.'</b><br/> {point.x:%H:%M:%p} <br/> <b>{point.x:%b %e,%Y}</b>",
                              },                            
                              colors: ["#6CF", "#39F", "#06C", "#036", "#000"],
                              series: [{
                                type: "area",
                                name: "CPU Burst Capacity",
                                data:  ['.implode(",", $cpuBurstCapcityArray).'],
                                color: "#78c6de",
                              }]
                          });
        
        </script>';
   
        echo $script;

        die(); 
          }
          catch(Exception $e)
          {
           $script = ['status'=>'error', 'msg'=>$e->getMessage()];
          }
          echo json_encode($script);       
          break;
          case 'statusCheck':
          try
          {           
           //Status Check Failed Status  
            $systemResult = $AWSlightsailcall->GetMetric($params, $_POST['time_period'], $_POST['metricType'], "Count", "Sum");
                if($_POST['metricType'] == 'StatusCheckFailed') {
                  $chartName="SUM OF FAILED STATUS CHECK";
                }elseif ($_POST['metricType'] == 'StatusCheckFailed_Instance ') {
                  $chartName = "SUM OF FAILED INSTANCE STATUS CHECK";
                } else{
                  $chartName = "SUM OF FAILED SYSTEM STATUS CHECK";
                }
            $systemStatusArray = [];
            foreach($systemResult['metricData'] as $systemStatus)
            {  
              $systemStatusSum = $systemStatus['sum'];               
              // $cpuBurstAvgR = round($cpuBurstAvg,2);   
              $systemDateTime = date('Y-m-d H:i:s', strtotime($systemStatus['timestamp'])); 
              $system_newtime = date('Y,m,d,H,i,s', strtotime($systemDateTime . ' -1 months'));
              $systemUTCdateTime = 'Date.UTC(' . $system_newtime . ')';
              $systemStatusArray[] = "[" . $systemUTCdateTime . ", ".$systemStatusSum."]";                
            }
          $script = '<div id="systemStatusContainer" style="height: 350px; width: 100%;">
            </div><script>         
                     Highcharts.chart("systemStatusContainer", {
                            title: {
                            text: "'.$chartName.'"
                            },
                              xAxis: {
                                type: "datetime",
                  
                                dateTimeLabelFormats: {
                                  day: "%e %b %Y",
                                },
                                title: {
                                  text: ""
                                }
                              },

                              yAxis: {

                                min: 0,
                                  title: {
                                    text: "Count"
                                  },
                                labels: {
                                  format: "{value}",
                                } 
                              },
                              tooltip: {

                                crosshairs: [true, true],
                                headerFormat: "",
                                pointFormat: "<b>{point.y}</b><br/> {point.x:%H:%M:%p} <br/> <b>{point.x:%b %e,%Y}</b>",

                              },
                             
                              colors: ["#6CF", "#39F", "#06C", "#036", "#000"],

                              series: [{
                                type: "area",
                                name: "Status Checks",
                                data:  ['.implode(",", $systemStatusArray).'],
                                color: "#78c6de",
                              }]
                          });
        
        </script>';
   
        echo $script;

        die(); 

          }
          catch(Exception $e)
          {
            $script = ['status'=>'error', 'msg'=>$e->getMessage()];
          }
          echo json_encode($script);       
          break;
        case 'NetworkIn':

          try
          {
            $getnetworkMetric = $AWSlightsailcall->GetMetric_network($params,$_POST['time_period']);
            $dataPoints = array();
            $networkArray = [];
            foreach($getnetworkMetric['metricData'] as $val)
            {
              $networkindata = $val['average'];
              $datainkilobytes =  $networkindata/1024;
              $datainkilobyte = round($networkindata/1024, 2);
              $networkDateTime = date('Y-m-d H:i:s', strtotime($val['timestamp'])); 
              $network_newtime = date('Y,m,d,H,i,s', strtotime($networkDateTime . ' -1 months'));
              $uTCdateTime = 'Date.UTC(' . $network_newtime . ')';
              $networkArray[] = "[" . $uTCdateTime . ", ".$datainkilobyte."]"; 
            }
            $networkscript = '<div id="networkInContainer" style="height: 350px; width: 100%;">
            </div><script>
            Highcharts.chart("networkInContainer", {
                            title: {
                            text: "NetworkIn"
                            },
                              xAxis: {
                                type: "datetime",
                  
                                dateTimeLabelFormats: {
                                    day: "%e %b %Y",
                                },
                                title: {
                                  text: ""
                                }
                              },
                              yAxis: {

                                min: 0,
                                  title: {
                                    text: "KB"
                                  },
                                labels: {
                                  format: "{value}",
                                } 
                                
                              },
                              tooltip: {

                                crosshairs: [true, true],
                                headerFormat: "",
                                pointFormat: "<b>{point.y} KB</b><br/> {point.x:%H:%M:%p} <br/> <b>{point.x:%b %e,%Y}</b>",

                              },
                             
                              colors: ["#6CF", "#39F", "#06C", "#036", "#000"],

                              series: [{
                                type: "area",
                                name: "NetworkIn",
                                data:  ['.implode(",", $networkArray).'],
                                color: "#78c6de",
                              }]
                          });            
                          </script>';
        echo $networkscript;
          die(); 
          }
          catch(Exception $e)
          {
            $networkscript = ['status'=>'error', 'msg'=>$e->getMessage()];
          }
          echo json_encode( $networkscript); 
          break;
        case 'NetworkOut':
          try
          {
            $getnetworkout = $AWSlightsailcall->GetMetric_NetworkOut($params,$_POST['time_period']);
            $dataPoints = array();
            $networkOutArray = [];
            foreach($getnetworkout['metricData'] as $val)

            {
              $networkdata = $val['average'];
              $datainkilobyte = round($networkdata/1024,2);

              $networkOutDateTime = date('Y-m-d H:i:s', strtotime($val['timestamp'])); 
              $networkOut_newtime = date('Y,m,d,H,i,s', strtotime($networkOutDateTime . ' -1 months'));

              $uTCdateTime = 'Date.UTC(' . $networkOut_newtime . ')';
              $networkOutArray[] = "[" . $uTCdateTime . ", ".$datainkilobyte."]";
            }
            $networkscript = '<div id="networkOutContainer" style="height: 350px; width: 100%;">
            </div><script>
        Highcharts.chart("networkOutContainer", {
                            title: {
                            text: "NetworkOut"
                            },
                              xAxis: {
                                type: "datetime",
                  
                                dateTimeLabelFormats: {
                                    day: "%e %b %Y",
                                },
                                title: {
                                  text: ""
                                }
                              },
                              yAxis: {

                                min: 0,
                                  title: {
                                    text: "KB"
                                  },
                                labels: {
                                  format: "{value}",
                                } 
                                
                              },
                              tooltip: {

                                crosshairs: [true, true],
                                headerFormat: "",
                                pointFormat: "<b>{point.y} KB</b><br/> {point.x:%H:%M:%p} <br/> <b>{point.x:%b %e,%Y}</b>",

                              },
                             
                              colors: ["#6CF", "#39F", "#06C", "#036", "#000"],

                              series: [{
                                type: "area",
                                name: "NetworkOut",
                                data:  ['.implode(",", $networkOutArray).'],
                                color: "#78c6de",
                              }]
                          });         
            </script>';
        echo $networkscript;
        die(); 
          }
          catch(Exception $e)
          {
            $networkscript = ['status'=>'error', 'msg'=>$e->getMessage()];
          }
          echo json_encode( $networkscript); 
          break;
			case 'deletesnapshot':
            try {
                $deleteSnapshotResult = $AWSlightsailcall->deleteSnapshot($params, $_POST['snapshotName'],'Delete Instance Snapshot'); 
				if($deleteSnapshotResult['operations']['0']['id'] != ''){
                    $status = ['status'=>'success', 'msg'=>'Snapshot deleted Successfully'];
                }
                else{
                    $status = "Error: errorCode: ".$deleteSnapshotResult['operations']['0']['errorCode']." errorDetails: ". $deleteSnapshotResult['operations']['0']['errorDetails']; 
                    $status = ['status'=>'error', 'msg'=> $status ];               
                }
            }
            catch(Exception $e){
				$status = ['status'=>'error', 'msg'=>'error'];
            }
            echo json_encode($status); 
            break;
            case 'createInstanceFrmSshot':
            try{				  
                $createInstanceResult = $AWSlightsailcall->createInstanceFrmSshot($params, $_POST['snapshotName'],'Create Snapshot from Instance');                 
					if($createInstanceResult['operations']['0']['id'] != ''){
						$status = ['status'=>'success', 'msg'=>'Instance restored Successfully'];
					}
					else{
						$status = "Error: errorCode: ".$createInstanceResult['operations']['0']['errorCode']." errorDetails: ". $createInstanceResult['operations']['0']['errorDetails']; 
						$status = ['status'=>'error', 'msg'=> $status ];               
					}
            }
            catch(Exception $e){
                $status = ['status'=>'error', 'msg'=> $e->getMessage()];
            }
            echo json_encode($status); 
            break;
            case 'connectRdp':
            try{
                $connectResult = $AWSlightsailcall->connectByRdp($params,'Connect By RDP');                 
					if($connectResult['operations']['0']['id'] != ''){
						$status = ['status'=>'success', 'msg'=>'Instance created Successfully'];
					}	
					else{
						$status = "Error: errorCode: ".$connectResult['operations']['0']['errorCode']." errorDetails: ". $connectResult['operations']['0']['errorDetails']; 
						$status = ['status'=>'error', 'msg'=> $status ];               
					}
            }
            catch(Exception $e)
				{
					$status = ['status'=>'error', 'msg'=> $e->getMessage()];
				}
            echo json_encode($status); 
            break;
            case 'snapshot_name':
                try {
					if($params['customfields']['instancename'] =='')
						echo "Error: Instance Name is empty";
					
							$i = 0;
					        foreach ($snapshotdetail as $snapShot){
							    if($snapShot['fromInstanceName'] == $params['customfields']['instancename'])
								    $i++;
						    }					    					
						if($params['configoptions']['snapshot'] == $i){                    
							$status = ['status'=>'error', 'msg'=>"You can create max ".$params['configoptions']['snapshot'] . " snapshots"];                        
						}else{
							if (!preg_match ("/^[A-Za-z0-9_-]+$/",$_POST['snapshot_name'])) {                    
								$status = ['status'=>'error', 'msg'=>"Name can contain letters and numbers; hyphen (-) and underscore (_) characters may separate words."];                            
							}else{
								$createSnapshot = $AWSlightsailcall->createSnapshot($params,$_POST['snapshot_name'],'Create Snapshot');                  
									if($createSnapshot['operations']['0']['id'] != '') {
										$status = ['status'=>'success', 'msg'=>'Snapshot created Successfully'];
									}else{
										$status = "Error: errorCode: ".$instance['operations']['0']['errorCode']." errorDetails: ". $instance['operations']['0']['errorDetails']; 
										$status = ['status'=>'error', 'msg'=> $status ];
									}
							}
						}                   
                } catch (Exception $e) {
                    $status = ['status'=>'error', 'msg'=>$e->getMessage()];                   
                }
		    echo json_encode($status);
        break;
        case 'getfirewall':  
          $getportdetail =  $AWSlightsailcall->GetInstancePortStates($params);     
           
					if (count($getportdetail['portStates']) > 0){
				    $html  = "";
				    $ports = "";
						foreach ($getportdetail['portStates'] as $firewallport){
              $protocol = $firewallport['protocol'];
              $toports = $firewallport['toPort']; 
              $fromPort = $firewallport['fromPort']; 
              $cidrs = $firewallport['cidrs']; 

              $restrictips ='';
             
              foreach ($firewallport['cidrs'] as $key => $getcidrs) {
               
                if($getcidrs == '0.0.0.0/0'){
                  $restrictips .= null;
                }else{
                  $restrictips .=  $getcidrs.",";
                }
              }

              $appname = $AWSlightsailcall->getapplicationname($protocol,$fromPort,$toports);			

							if($firewallport['toPort'] == 65535){
								$displayports = $firewallport['fromPort'].' - '.$firewallport['toPort'];
							}else{
								$displayports = $firewallport['toPort'];
                if($displayports == -1){
                  $displayports = '';
                }
							}
              if($protocol == -1){
                  $protocol = 'all';
              }
               
              if($appname == ''){
                $appname = "Custom";
              }
					     if(empty($restrictips)){
                  $restrictipsdisplay = "Any IPv4 address"; 
               }else{
                 $restrictipsdisplay =  str_replace("/32", "", str_replace(",", "<br/>", $restrictips));
               } 
							$html .= '<tr>
								  <td>'. $appname .'</td>
								  <td>'. strtoupper(($appname == 'Custom ICMP') ? $protocol.' '.$fromPort : $protocol) .'</td>
                  <td>'. $displayports .'</td>
								  <td>'. $restrictipsdisplay .'</td>
								  </td><td><i style="cursor: pointer;" class="fas fa-edit" id="edit-rule" fromport="'.$fromPort.'" toport="'.$toports.'"  protocol="'.$protocol.'" appname="'.$appname.'" resticips="'.substr_replace($restrictips,"",-1).'"></i> <i style="cursor: pointer;" class="fa fa-trash" aria-hidden="true" id="del-rule" fromport="'.$fromPort.'" toport="'.$toports.'"  protocol="'.$protocol.'"></i></td>							 
								</tr>';
						} 
             
					}
        echo $html;		           
        break;   
        case 'firewalrule':
            try {
    					$data = $_POST;                
    					$addrule = $AWSlightsailcall->addfirewalrule($params,$data); 				 
    						if($addrule['operation']['id'] != ''){
    							$status = ['status'=>'success', 'msg'=>'Rule Added Successfully'];
    						}                     
            } catch (Exception $e) {
				        $status = ['status'=>'error', 'msg'=>$e->getMessage()];
            }  

        echo json_encode($status);
        break;   
        case 'firewalruleupdate':
            try {
    					$data = $_POST;                 
    					$addrule = $AWSlightsailcall->updatefirewalrule($params,$data); 

    					if($addrule['operation']['id'] != ''){
    						$status = ['status'=>'success', 'msg'=>'Rule Updated Successfully'];
    					}                     
          } catch (Exception $e) {
					     $status = ['status'=>'error', 'msg'=>$e->getMessage()];
          }               
		    echo json_encode($status);
        break; 
        case 'getaccessdetailserver':
            try {                  
    					$getdeatil = $AWSlightsailcall->getInstanceAcessDetail($params);             
    						if($addrule['operations']['0']['id'] != ''){
    							$status = ['status'=>'success', 'msg'=>'Rule Added Successfully'];
    						}                     
            } catch (Exception $e) {
                $status = ['status'=>'error', 'msg'=>$e->getMessage()];
            }               
		    echo json_encode($status);
        break; 
        case 'delfirewalrule':
            try {
	            $data = $_POST;
			        $delResult = $AWSlightsailcall->deletefirewallrule($params,$data); 			 
  				    if($delResult['operation']['id'] != ''){
  						$status = ['status'=>'success', 'msg'=>'Rule deleted Successfully'];
  				    }    
            } catch (Exception $e) {
				        $status = ['status'=>'error', 'msg'=>$e->getMessage()];
            }                
        echo json_encode($status);
        break;
        case 'get_snapshot':    
           
		    if (count($snapshotdetail) > 0){
				  $html ="";
              foreach ($snapshotdetail as $snapShot){
      					if($snapShot['fromInstanceName'] == $params['customfields']['instancename'])
      					$html .= '<tr>
                            <td>'.$snapShot['name'].'</td>
                            <td>'. $snapShot['createdAt']->format('Y-m-d H:i:A') .'</td>
                            <td>' . $snapShot['sizeInGb'] . 'GB </td>
                            <td>' . $snapShot['state'] . ' </td>
                            <td>
                              <a href="javascript:;" onclick="deleteSnapshot(\''.$snapShot['name'].'\');">
                                <i class="fa fa-trash" aria-hidden="true" style="color:red;">
                                </i>
                                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                              <a href="javascript:;" onclick="creatInstanceFrmSshot(\''.$snapShot['name'].'\');">
                                <i class="fa fa-undo" aria-hidden="true">
                                </i>
                              </a>
                            </td>
                          </tr>';
                } 
		    }
      echo $html;
      break;
 
      default:
 		  break;

   }

}
 