<?php

use Illuminate\Database\Capsule\Manager as Capsule;
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
function awslightsail_checkLicense($licensekey, $localkey = "") {
    $whmcsurl = "http://members.whmcsglobalservices.com/"; #enter your own whmcs url here
    $licensing_secret_key = 'AWSLightsail@952019!@~'; #you can enter your own secret key here
    $check_token = time() . md5(mt_rand(1000000000, 1e+010) . $licensekey);
    $checkdate = date("Ymd");
    $usersip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
    $localkeydays = 8;
    $allowcheckfaildays = 5;
    $localkeyvalid = false;

    // for local key start
    $lkey = Capsule::table('tblconfiguration')->where('setting', 'awslightsail_localkey')->get(); //add for local key
    if ($lkey) {
        $localkey = $lkey[0]->value;
    }
    // for local key end

    if ($localkey) {
        $localkey = str_replace("\n", "", $localkey);
        $localdata = substr($localkey, 0, strlen($localkey) - 32);
        $md5hash = substr($localkey, strlen($localkey) - 32);
        if ($md5hash == md5($localdata . $licensing_secret_key)) {
            $localdata = strrev($localdata);
            $md5hash = substr($localdata, 0, 32);
            $localdata = substr($localdata, 32);
            $localdata = base64_decode($localdata);
            $localkeyresults = unserialize($localdata);
            $originalcheckdate = $localkeyresults['checkdate'];
            if ($md5hash == md5($originalcheckdate . $licensing_secret_key)) {
                $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - $localkeydays, date("Y")));
                if ($localexpiry < $originalcheckdate) {
                    $localkeyvalid = true;
                    $results = $localkeyresults;
                    $validdomains = explode(",", $results['validdomain']);
                    if (!in_array($_SERVER['SERVER_NAME'], $validdomains)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }

                    $validips = explode(",", $results['validip']);
                    if (!in_array($usersip, $validips)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }

                    if ($results['validdirectory'] != dirname(__FILE__)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }
                }
            }
        }
    }

    if (!$localkeyvalid) {
        $postfields['licensekey'] = $licensekey;
        $postfields['domain'] = $_SERVER['SERVER_NAME'];
        $postfields['ip'] = $usersip;
        $postfields['dir'] = dirname(__FILE__);
        if ($check_token) {
            $postfields['check_token'] = $check_token;
        }

        if (function_exists("curl_exec")) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $whmcsurl . "modules/servers/licensing/verify.php");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            curl_close($ch);
        } else {
            $fp = fsockopen($whmcsurl, 80, $errno, $errstr, 5);
            if ($fp) {
                $querystring = "";
                foreach ($postfields as $k => $v) {
                    $querystring .= "{$k}=" . urlencode($v) . "&";
                }
                $header = "POST " . $whmcsurl . "modules/servers/licensing/verify.php HTTP/1.0\r\n";
                $header .= "Host: " . $whmcsurl . "\r\n";
                $header .= "Content-type: application/x-www-form-urlencoded\r\n";
                $header .= "Content-length: " . @strlen(@$querystring) . "\r\n";
                $header .= "Connection: close\r\n\r\n";
                $header .= $querystring;
                $data = "";
                @stream_set_timeout(@$fp, 20);
                @fputs(@$fp, @$header);
                $status = @socket_get_status(@$fp);

                while (!feof(@$fp) && $status) {
                    $data .= @fgets(@$fp, 1024);
                    $status = @socket_get_status(@$fp);
                }
                @fclose(@$fp);
            }
        }

        if (!$data) {
            $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - ( $localkeydays + $allowcheckfaildays ), date("Y")));
            if ($localexpiry < $originalcheckdate) {
                $results = $localkeyresults;
            } else {
                $results['status'] = "Invalid";
                $results['description'] = "Remote Check Failed";
                return $results;
            }
        }

        preg_match_all("/<(.*?)>([^<]+)<\\/\\1>/i", $data, $matches);
        $results = array();
        foreach ($matches[1] as $k => $v) {
            $results[$v] = $matches[2][$k];
        }

        if ($results['md5hash'] && $results['md5hash'] != md5($licensing_secret_key . $check_token)) {
            $results['status'] = "Invalid";
            $results['description'] = "MD5 Checksum Verification Failed";
            return $results;
        }

        if ($results['status'] == "Active") {
            $results['checkdate'] = $checkdate;
            $data_encoded = serialize($results);
            $data_encoded = base64_encode($data_encoded);
            $data_encoded = md5($checkdate . $licensing_secret_key) . $data_encoded;
            $data_encoded = strrev($data_encoded);
            $data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
            $data_encoded = wordwrap($data_encoded, 80, "\n", true);
            $results['localkey'] = $data_encoded;
            // for local key start
            if (!Capsule::table('tblconfiguration')->where('setting', 'awslightsail_localkey')->get()) {
                Capsule::table('tblconfiguration')->insert(
                        [
                            'setting' => 'awslightsail_localkey',
                            'value' => $results['localkey']
                        ]
                );
            } else {
                Capsule::table('tblconfiguration')
                        ->where('setting', 'awslightsail_localkey')
                        ->update(
                                [
                                    'value' => $results['localkey']
                                ]
                );
            }
            // for local key end
        }
        $results['remotecheck'] = true;
    } 

    unset($postfields);
    unset($data);
    unset($matches);
    unset($whmcsurl);
    unset($licensing_secret_key);
    unset($checkdate);
    unset($usersip);
    unset($localkeydays);
    unset($allowcheckfaildays);
    unset($md5hash);
    return $results;
}

?>