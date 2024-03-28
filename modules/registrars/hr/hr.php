<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
if (file_exists(__DIR__ . "/includes/xmlarray.php"))
    require_once __DIR__ . "/includes/xmlarray.php";

if (file_exists(__DIR__ . "/includes/class.php"))
    require_once __DIR__ . "/includes/class.php";

use WHMCS\Database\Capsule;

function hr_MetaData()
{
    return array(
        'DisplayName' => 'HR Domain',
        'APIVersion' => '1.1',
    );
}
function hr_getConfigArray($params)
{
 
    $configarray = array(
        "Apiurl" => array(
            "FriendlyName" => "Enter apiurl",
            "Type" => "text",
            "Size" => "25",
        ),
        "Username" => array(
            "FriendlyName" => "Enter Username",
            "Type" => "text",
            "Size" => "25",
        ),
        "hr_password" => array(
            "FriendlyName" => " Enter Password",
            "Type" => "password",
            "Size" => "25",
        ),
    );
    return $configarray;
}
# Get Nameservers

function hr_GetNameservers($params, $getNsId = null)
{

    try {
        $EPP = new hrdomain($params);    #Create object
        $EPP->createCustomFields();
        $clientLoginXml = $EPP->hrclientlogin($params);  #Client login
        XmlArray::loadXML($clientLoginXml);
        $clientLogin = simplexml_load_string($clientLoginXml);
        $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($loginCode == "1000") {
            $domainInfoRequestXml = $EPP->gethrdomaininfo($params, 'get nameservers');  # Domain info request
            XmlArray::loadXML($domainInfoRequestXml);
            $domainInfo = simplexml_load_string($domainInfoRequestXml);
            $domainInfoCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            if ($domainInfoCode == 1000) {
                $xml = new SimpleXMLElement($domainInfoRequestXml);
                $xml->registerXPathNamespace('domain', 'urn:ietf:params:xml:ns:domain-1.0');
                $hostNames = $xml->xpath('//domain:hostName');
                $keys = 1;
                foreach ($hostNames as $hostName) {
                    $values['ns' . $keys] = (string) $hostName;
                    $keys++;
                }
            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = "Error (domain info) failed, Errorcode: {$domainInfoCode} Errormsg: {$msg}, Reason: {$reason}";
                return $values;
            }
        } else {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $values['error'] = 'Error: Get nameserver failed, (client login) errorcode - ' . $loginCode . ', Error Message - ' . $msg;
        }
        $logoutXml = $EPP->logoutclient();
        XmlArray::loadXML($logoutXml);
        $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($logoutCode != 1500) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $reason = XmlArray::getArrayElement(null, 'reason', true);
            $values['error'] = 'Error: domain register failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
        }
    } catch (Exception $ex) {
        $values['error'] = 'Error: ' . $ex->getMessage();
    }

    return $values;
}

# Save Nameservers
function hr_SaveNameservers($params)
{

    try {
        $EPP = new hrdomain($params);    #Create object
        $clientLoginXml = $EPP->hrclientlogin($params);  #Client login
        XmlArray::loadXML($clientLoginXml);
        $clientLogin = simplexml_load_string($clientLoginXml);
        $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($loginCode == "1000") {
            $domainInfoRequestXml = $EPP->gethrdomaininfo($params, 'get nameservers');
            # Domain info request
            XmlArray::loadXML($domainInfoRequestXml);
            $domainInfo = simplexml_load_string($domainInfoRequestXml);
            $domainInfoCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            if ($domainInfoCode == 1000) {

                $xml = new SimpleXMLElement($domainInfoRequestXml);
                $xml->registerXPathNamespace('domain', 'urn:ietf:params:xml:ns:domain-1.0');
                $adminIds = $xml->xpath('//domain:contact[@type="admin"]');
                $techIds = $xml->xpath('//domain:contact[@type="tech"]');

                $adminId = (string) $adminIds[0];
                $techId = (string) $techIds[0];
                $regId = XmlArray::getArrayElement('domain', 'registrant', true);

                $xml->registerXPathNamespace('domain', 'urn:ietf:params:xml:ns:domain-1.0');
                $hostNames = $xml->xpath('//domain:hostName');
                $keys = 1;

                foreach ($hostNames as $key => $hostName) {
                    $nsvalues['ns' . $keys] = (string) $hostName;
                    $keys++;
                }

            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = "Error (domain info) failed, Errorcode: {$domainInfoCode} Errormsg: {$msg}, Reason: {$reason}";
                return $values;
            }
            $UpdateNamerserverXml = $EPP->updatehrNamerserver($params, $adminId, $techId, $regId, $nsvalues); #update nameserver
            $UpdateNamerserver = simplexml_load_string($UpdateNamerserverXml);
            XmlArray::loadXML($clientLoginXml);
            $updateCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            if ($updateCode != 1000) {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = 'Error: Errorcode - ' . $updateCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
            }

        }
        $logoutXml = $EPP->logoutclient();
        XmlArray::loadXML($logoutXml);
        $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($logoutCode != 1500) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $reason = XmlArray::getArrayElement(null, 'reason', true);
            $values['error'] = 'Error: domain register failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
        }
    } catch (Exception $ex) {
        $values['error'] = 'Error: ' . $ex->getMessage();
    }

}
#register domain
function hr_RegisterDomain($params)
{
    try {

        $EPP = new hrdomain($params);
       
        $clientloginxml = $EPP->hrclientlogin($params);
        XmlArray::loadXML($clientloginxml);
        $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($loginCode == "1000") {

            #Check Registrant Contact
            $randomstringget = $EPP->generateRandomString(4);
            $params['regcontactid'] = $randomstringget . $params['domainid'] . '1';
            $params['techcontactid'] = $randomstringget . $params['domainid'] . '2';
            $params['admincontactid'] = $randomstringget . $params['domainid'] . '3';
            $checkRegContactXml = $EPP->checkhrdomainContact($params, 'Registrant', 'check registrant contact'); # Create contact

            XmlArray::loadXML($checkRegContactXml);
            $checkRegContact = simplexml_load_string($checkRegContactXml);
            $regContactCheckCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            $regId = XmlArray::getArrayElement('contact', 'id', true)['_value'];
            $regContactAvail = XmlArray::getArrayAttribute('contact', 'id', 'avail', true);
            if ($regContactCheckCode == 1000) {
                if ($regContactAvail != '0') {
                    $values['error'] = 'Error: (check registrant contact) failed, contact id: ' . $regId . ' not vailable';
                    return $values;
                }
            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = 'Error: (check registrant contact) failed, Errorcode - ' . $regContactCheckCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
                return $values;
            }

            #Create Registrant Contact
            $createRegContactXml = $EPP->createhrdomainContact($params, 'Registrant', 'create registrant contact', $regId); # Create contact
            XmlArray::loadXML($createRegContactXml);
            $createRegContact = simplexml_load_string($createRegContactXml);
            $regContactCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            $regIdCreate = XmlArray::getArrayElement('contact', 'id', true);
            if ($regContactCode != 1000) {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = 'Error: (create registrant contact) failed, Errorcode - ' . $regContactCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
                return $values;
            }

            #Check Technical Contact
            $checkTechContactXml = $EPP->checkhrdomainContact($params, 'Technical', 'check technical contact'); # Create contact
            XmlArray::loadXML($checkTechContactXml);
            $checkTechContact = simplexml_load_string($checkTechContactXml);
            $techContactCheckCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            $techId = XmlArray::getArrayElement('contact', 'id', true)['_value'];

            $techContactAvail = XmlArray::getArrayAttribute('contact', 'id', 'avail', true);
            if ($techContactCheckCode == 1000) {
                if ($techContactAvail != '0') {
                    $values['error'] = 'Error: (check technical contact) failed, contact id: ' . $techId . ' not vailable';
                    return $values;
                }
            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = 'Error: (check technical contact) failed, Errorcode - ' . $techContactCheckCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
                return $values;
            }
            #Create Technical Contact
            $createTechContactXml = $EPP->createhrdomainContact($params, 'Tech', 'create technical contact', $techId); # Create contact
            XmlArray::loadXML($createTechContactXml);
            $createTechContact = simplexml_load_string($createTechContactXml);
            $techContactCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            $techIdCreate = XmlArray::getArrayElement('contact', 'id', true);
            if ($techContactCode != 1000) {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = 'Error: (create technical contact) failed, Errorcode - ' . $techContactCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
                return $values;
            }

            #Check Admin Contact
            $checkAdminContactXml = $EPP->checkhrdomainContact($params, 'Admin', "check admin contact"); # Create contact
            XmlArray::loadXML($checkAdminContactXml);
            $checkAdminContact = simplexml_load_string($checkAdminContactXml);
            $adminContactCheckCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            $adminId = XmlArray::getArrayElement('contact', 'id', true)['_value'];
            $adminContactAvail = XmlArray::getArrayAttribute('contact', 'id', 'avail', true);
            if ($adminContactCheckCode == 1000) {
                if ($adminContactAvail != '0') {
                    $values['error'] = 'Error: (check admin contact) failed, contact id: ' . $adminId . ' not vailable';
                    return $values;
                }
            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = 'Error: (check admin contact) failed, Errorcode - ' . $adminContactCheckCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
                return $values;
            }

            #Create Admin Contact
            $createAdminContactXml = $EPP->createhrdomainContact($params, 'Admin', 'create admin contact', $adminId); # Create contact
            XmlArray::loadXML($createAdminContactXml);
            $createAdminContact = simplexml_load_string($createAdminContactXml);
            $adminContactCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            $adminIdCreate = XmlArray::getArrayElement('contact', 'id', true);
            if ($adminContactCode != 1000) {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = 'Error: (create admin contact) failed, Errorcode - ' . $adminContactCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
                return $values;
            }

            if ($regContactCode == 1000 && $techContactCode == 1000 && $adminContactCode == 1000) {

                #Check Domain
                $checkDomainXml = $EPP->checkHrDomain($params, "check domain");
                XmlArray::loadXML($checkDomainXml);
                $checkDomain_code = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                $domainAvail = XmlArray::getArrayAttribute('domain', 'name', 'avail', true);
                if ($checkDomain_code == 1000) {
                    if ($domainAvail != '1') {
                        $values['error'] = 'Error: (check domain) failed, domain: ' . $params['domain_punycode'] . ' not vailable';
                        return $values;
                    }
                } else {
                    $msg = XmlArray::getArrayElement(null, 'msg', true);
                    $reason = XmlArray::getArrayElement(null, 'reason', true);
                    $values['error'] = 'Error: (check domain) failed, Errorcode - ' . $checkDomain_code . ', Error Message - ' . $msg . ', Reason - ' . $reason;
                    return $values;
                }

                #Create Domain
                $domainCreateXml = $EPP->createhrdomain($params, $regIdCreate, $adminIdCreate, $techIdCreate, $params['regperiod'], "createhrdomain");

                # Domain create
                XmlArray::loadXML($domainCreateXml);
                $domainCreate = simplexml_load_string($domainCreateXml);
                $registerCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                if ($registerCode != 1000) {
                    $msg = XmlArray::getArrayElement(null, 'msg', true);
                    $reason = XmlArray::getArrayElement(null, 'reason', true);
                    $reason = XmlArray::getArrayElement(null, 'reason', true);
                    $values['error'] = 'Error: (create domain) failed, Errorcode - ' . $registerCode . ', Error Message - ' . $msg . ', Error reason: ' . $reason;
                }
            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = 'Error: (create domain - set ns) failed, Errorcode - ' . $regContactCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
            }
        }

        $logoutXml = $EPP->logoutclient();
        XmlArray::loadXML($logoutXml);
        $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($logoutCode != 1500) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $reason = XmlArray::getArrayElement(null, 'reason', true);
            $values['error'] = 'Error: domain register failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
        }
    } catch (\Exception $e) {
        return array(
            'error' => $e->getMessage(),
        );
    }
}
#get epp code
function hr_GetEPPCode($params)
{
    try {
        $EPP = new hrdomain($params);    #Create object
        $clientLoginXml = $EPP->hrclientlogin($params);  #Client login
        XmlArray::loadXML($clientLoginXml);
        $clientLogin = simplexml_load_string($clientLoginXml);
        $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($loginCode == "1000") {
            $password = $EPP->generate_password(12);
            $domainpwxml = $EPP->updatehrdomainpw($params, $password);
            XmlArray::loadXML($domainpwxml);
            $domainInfoCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            if ($domainInfoCode == 1000) {
                $values['eppcode'] = $password;
            }

        } else {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $values['error'] = 'Error: get epp code failed, (client login) errorcode - ' . $loginCode . ', Error Message - ' . $msg;
        }
        $logoutXml = $EPP->logoutclient();
        XmlArray::loadXML($logoutXml);
        $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($logoutCode != 1500) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $values['error'] = 'Error: get epp code failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg;
        }
    } catch (Exception $ex) {
        $values['error'] = 'Error: ' . $ex->getMessage();
    }
    return $values;
}
#renew domain
function hr_RenewDomain($params)
{
    try {
        $EPP = new hrdomain($params);    #Create object
        $clientLoginXml = $EPP->hrclientlogin($params);  #Client login
        XmlArray::loadXML($clientLoginXml);
        $clientLogin = simplexml_load_string($clientLoginXml);
        $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($loginCode == "1000") {
            $domaininfoxml = $EPP->gethrdomaininfo($params, "getnameserver");
            XmlArray::loadXML($domaininfoxml);
            $domaininfoCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);

            if ($domaininfoCode == 1000) {
                $domainExDate = XmlArray::getArrayElement('domain', 'exDate', true);
                $inputDate = new DateTime($domainExDate);
                $formattedDate = $inputDate->format('Y-m-d');
                $renewDomainXml = $EPP->renewhrdomain($params, $formattedDate, $params['regperiod'], 'Renew domain');
                $renewDomain = simplexml_load_string($renewDomainXml);
                XmlArray::loadXML($renewDomainXml);
                $renewStatusCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                if ($renewStatusCode != 1000) {
                    $msg = XmlArray::getArrayElement(null, 'msg', true);
                    $reason = XmlArray::getArrayElement(null, 'reason', true);
                    $values['error'] = 'Error: renew domain failed, Errorcode - ' . $renewStatusCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
                }
            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $values['error'] = 'Error: renew domain failed, (client login) errorcode - ' . $loginCode . ', Error Message - ' . $msg;
            }
        }
        $logoutXml = $EPP->logoutclient();
        XmlArray::loadXML($logoutXml);
        $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($logoutCode != 1500) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $values['error'] = 'Error: renew domain failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg;
        }
    } catch (Exception $ex) {
        $values['error'] = 'Error: ' . $ex->getMessage();
    }
    return $values;
}
# get contact details
function hr_GetContactDetails($params)
{
    try {
        $EPP = new hrdomain($params);    #Create object
        $clientLoginXml = $EPP->hrclientlogin($params);  #Client login
        XmlArray::loadXML($clientLoginXml);
        $clientLogin = simplexml_load_string($clientLoginXml);
        $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($loginCode == "1000") {
            $domainInfoRequestXml = $EPP->gethrdomaininfo($params, 'get nameservers');
            # Domain info request
            XmlArray::loadXML($domainInfoRequestXml);
            $domainInfo = simplexml_load_string($domainInfoRequestXml);
            $domainInfoCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            if ($domainInfoCode == 1000) {
                $xml = new SimpleXMLElement($domainInfoRequestXml);
                $xml->registerXPathNamespace('domain', 'urn:ietf:params:xml:ns:domain-1.0');
                $adminIds = $xml->xpath('//domain:contact[@type="admin"]');
                $techIds = $xml->xpath('//domain:contact[@type="tech"]');
                $adminId = (string) $adminIds[0];
                $techId = (string) $techIds[0];
                $regId = XmlArray::getArrayElement('domain', 'registrant', true);
                # Get Registrant contact detail

                $getRegContactDetailXml = $EPP->gethrcontactdetails($params, $regId, 'get registrant contact detail');
                XmlArray::loadXML($getRegContactDetailXml);
                $getRegContactDetail = simplexml_load_string($getRegContactDetailXml);
                $contactRegCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                if ($contactRegCode == 1000) {
                    $userid = $params['original']['userid'];
                    $vats = Capsule::table('tblclients')->where('id', $userid)->value('tax_id');
                    $values["Registrant"]["Contact Name"] = XmlArray::getArrayElement('contact', 'name', true);
                    $values["Registrant"]["Address line 1"] = XmlArray::getArrayElement('contact', 'street', true);
                    $values["Registrant"]["TownCity"] = XmlArray::getArrayElement('contact', 'city', true);
                    $values["Registrant"]["Zip code"] = XmlArray::getArrayElement('contact', 'pc', true);
                    $values["Registrant"]["Country"] = XmlArray::getArrayElement('contact', 'cc', true);
                    $values["Registrant"]["Phone"] = XmlArray::getArrayElement('contact', 'voice', true);
                    $values["Registrant"]["Email"] = XmlArray::getArrayElement('contact', 'email', true);
                    $values["Registrant"]["Vat"] = $vats;

                }
                # Get Admin contact detail
                $getAdminContactDetailXml = $EPP->gethrcontactdetails($params, $adminId, 'get admin contact detail');
                XmlArray::loadXML($getAdminContactDetailXml);
                $getAdminContactDetail = simplexml_load_string($getAdminContactDetailXml);
                $contactAdminCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                if ($contactAdminCode == 1000) {
                    $userid = $params['original']['userid'];
                    $vats = Capsule::table('tblclients')->where('id', $userid)->value('tax_id');
                    #*************************Show admin information in fields****************************#
                    $values["Admin"]["Contact Name"] = XmlArray::getArrayElement('contact', 'name', true);
                    $values["Admin"]["Address line 1"] = XmlArray::getArrayElement('contact', 'street', true);
                    $values["Admin"]["TownCity"] = XmlArray::getArrayElement('contact', 'city', true);
                    $values["Admin"]["Zip code"] = XmlArray::getArrayElement('contact', 'pc', true);
                    $values["Admin"]["Country"] = XmlArray::getArrayElement('contact', 'cc', true);
                    $values["Admin"]["Phone"] = XmlArray::getArrayElement('contact', 'voice', true);
                    $values["Admin"]["Email"] = XmlArray::getArrayElement('contact', 'email', true);
                    $values["Admin"]["Vat"] = $vats;

                }
                # Get Tech contact detail
                $getTechContactDetailXml = $EPP->gethrcontactdetails($params, $techId, 'get tech contact detail');
                XmlArray::loadXML($getTechContactDetailXml);
                $getAdminContactDetail = simplexml_load_string($getTechContactDetailXml);
                $contactTechCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                if ($contactTechCode == 1000) {
                    $userid = $params['original']['userid'];
                    $vats = Capsule::table('tblclients')->where('id', $userid)->value('tax_id');

                    #*************************Show tech information in fields****************************#
                    $values["Tech"]["Contact Name"] = XmlArray::getArrayElement('contact', 'name', true);
                    $values["Tech"]["Address line 1"] = XmlArray::getArrayElement('contact', 'street', true);
                    $values["Tech"]["TownCity"] = XmlArray::getArrayElement('contact', 'city', true);
                    $values["Tech"]["Zip code"] = XmlArray::getArrayElement('contact', 'pc', true);
                    $values["Tech"]["Country"] = XmlArray::getArrayElement('contact', 'cc', true);
                    $values["Tech"]["Phone"] = XmlArray::getArrayElement('contact', 'voice', true);
                    $values["Tech"]["Email"] = XmlArray::getArrayElement('contact', 'email', true);
                    $values["Tech"]["Vat"] = $vats;

                }
            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $reason = XmlArray::getArrayElement(null, 'reason', true);
                $values['error'] = "Error (domain info) failed, Errorcode: {$domainInfoCode} Errormsg: {$msg}, Reason: {$reason}";
                return $values;
            }
        }
        $logoutXml = $EPP->logoutclient();
        XmlArray::loadXML($logoutXml);
        $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($logoutCode != 1500) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $values['error'] = 'Error: renew domain failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg;
        }
    } catch (Exception $ex) {
        $values['error'] = 'Error: ' . $ex->getMessage();
    }
    return $values;
}
#update contact details 
function hr_SaveContactDetails($params)
{
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'domaincontacts')
        return ['error' => 'Sorry, you can\'t update contact information. Please contact with our support to update this information.'];
    try {
        $EPP = new hrdomain($params);    #Create object
        $clientLoginXml = $EPP->hrclientlogin($params);  #Client login
        XmlArray::loadXML($clientLoginXml);
        $clientLogin = simplexml_load_string($clientLoginXml);
        $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($loginCode == "1000") {
            $domainInfoRequestXml = $EPP->gethrdomaininfo($params, 'get nameservers');
            # Domain info request
            XmlArray::loadXML($domainInfoRequestXml);
            $domainInfo = simplexml_load_string($domainInfoRequestXml);
            $domainInfoCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            if ($domainInfoCode == 1000) {

                $xml = new SimpleXMLElement($domainInfoRequestXml);
                $xml->registerXPathNamespace('domain', 'urn:ietf:params:xml:ns:domain-1.0');
                $adminIds = $xml->xpath('//domain:contact[@type="admin"]');
                $techIds = $xml->xpath('//domain:contact[@type="tech"]');

                $adminId = (string) $adminIds[0];
                $techId = (string) $techIds[0];

                $regId = XmlArray::getArrayElement('domain', 'registrant', true);
                # Update Registrant contact detail

                $updateRegContactDetailXml = $EPP->updatehrdomaincontact($params, $regId, 'Registrant');    #Update Registrant contact detail
                XmlArray::loadXML($updateRegContactDetailXml);
                $updateRegCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                if ($updateRegCode != 1000) {
                    $msg = XmlArray::getArrayElement(null, 'msg', true);
                    $reason = XmlArray::getArrayElement(null, 'reason', true);
                    $values['error'] = 'Error: Save Registrant contact failed, Error code: ' . $updateRegCode . ', Error message: ' . $msg . ', Reason: ' . $reason;
                }
                # Update Admin contact detail

                $updateAdminContactDetailXml = $EPP->updatehrdomaincontact($params, $adminId, 'Admin');    #Update Admin contact detail
                XmlArray::loadXML($updateAdminContactDetailXml);
                $updateAdminCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                if ($updateAdminCode != 1000) {
                    $msg = XmlArray::getArrayElement(null, 'msg', true);
                    $reason = XmlArray::getArrayElement(null, 'reason', true);
                    $values['error'] = 'Error: Save Admin contact failed, Error code: ' . $updateAdminCode . ', Error message: ' . $msg . ', Reason: ' . $reason;
                }
                # Update Tech contact detail

                $updateTechContactDetailXml = $EPP->updatehrdomaincontact($params, $techId, 'Tech');    #Update Tech contact detail
                XmlArray::loadXML($updateTechContactDetailXml);
                $updateTechCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
                if ($updateTechCode != 1000) {
                    $msg = XmlArray::getArrayElement(null, 'msg', true);
                    $reason = XmlArray::getArrayElement(null, 'reason', true);
                    $values['error'] = 'Error: Save Tech contact failed, Error code: ' . $updateTechCode . ', Error message: ' . $msg . ', Reason: ' . $reason;
                }
            }
        } else {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $values['error'] = 'Error: save contact failed, (client login) errorcode - ' . $loginCode . ', Error Message - ' . $msg;
        }
        $logoutXml = $EPP->logoutclient();
        XmlArray::loadXML($logoutXml);
        $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($logoutCode != 1500) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $values['error'] = 'Error: save contact failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg;
        }
    } catch (Exception $ex) {
        $values['error'] = 'Error: ' . $ex->getMessage();
    }
    return $values;
}

#transfer doamin
function hr_TransferDomain($params)
{
    $EPP = new hrdomain($params);    #Create object
    $clientLoginXml = $EPP->hrclientlogin($params);  #Client login
    XmlArray::loadXML($clientLoginXml);
    $clientLogin = simplexml_load_string($clientLoginXml);
    $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
    if ($loginCode == "1000") {
        $transferDomainXml = $EPP->transferdomain($params);   # Transfer Domain
        $transferDomain = simplexml_load_string($transferDomainXml);
        XmlArray::loadXML($transferDomainXml);
        $transeferCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($transeferCode != 1000) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $reason = XmlArray::getArrayElement(null, 'reason', true);
            $values['error'] = 'Error: transfer domain failed, Errorcode - ' . $transeferCode . ', Error Message - ' . $msg . ', Reason: ' . $reason;
        }
    } else {
        $msg = XmlArray::getArrayElement(null, 'msg', true);
        $values['error'] = 'Error: transfer failed, (client login) errorcode - ' . $loginCode . ', Error Message - ' . $msg;
    }
    $logoutXml = $EPP->logoutclient();
    XmlArray::loadXML($logoutXml);
    $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
    if ($logoutCode != 1500) {
        $msg = XmlArray::getArrayElement(null, 'msg', true);
        $reason = XmlArray::getArrayElement(null, 'reason', true);
        $values['error'] = 'Error: domain register failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
    }
}
#domain sync
function hr_Sync($params)
{
    try {

        $EPP = new hrdomain($params);    #Create object
        $domain = $params['domain_punycode'];
        $clientLoginXml = $EPP->hrclientlogin($params);  #Client login
        XmlArray::loadXML($clientLoginXml);
        $clientLogin = simplexml_load_string($clientLoginXml);
        $loginCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($loginCode == "1000") {
            $domaininfoxml = $EPP->gethrdomaininfo($params, "getnameserver");

            XmlArray::loadXML($domaininfoxml);
            $domaininfoCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
            if ($domaininfoCode == 1000) {
                $domaincrDate = XmlArray::getArrayElement('domain', 'crDate', true);
                $inputDate = new DateTime($domaincrDate);
                $formattedcrDate = $inputDate->format('Y-m-d');

                $domainExDate = XmlArray::getArrayElement('domain', 'exDate', true);
                $inputDate = new DateTime($domainExDate);
                $formattedDate = $inputDate->format('Y-m-d');

                $status = XmlArray::getArrayElement('domain', 'status', 's', true);
                $domainMsg = Xml2Array::getArrayElement(null, 'msg', true);

            } else {
                $msg = XmlArray::getArrayElement(null, 'msg', true);
                $values['error'] = 'Error: renew domain failed, (client login) errorcode - ' . $loginCode . ', Error Message - ' . $msg;
            }
            if (!empty($status)) {
                $statusres = $status;
                $createdate = $formattedcrDate;
                $nextduedate = $formattedDate;
            } else {
                $values['error'] = "Error: Sync/domain-info($domain): Domain not found";
                return $values;
            }
            $values['status'] = $domainMsg;
            # Check status and update
            if ($statusres == "ok") {
                $values['active'] = true;
            } elseif ($statusres == "serverHold") {
            } elseif ($statusres == "expired" || $statusres == "serverDeleteProhibited" || $statusres == "outzone" || $statusres == 'notValidated') {
                $values['expired'] = true;
            } else {
                $values['error'] = "Error: Sync/domain-info($domain): Unknown status code '$statusres'";
            }
            $values['expirydate'] = $nextduedate;
        } else {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $values['error'] = 'Error: transfer failed, (client login) errorcode - ' . $loginCode . ', Error Message - ' . $msg;
        }
        $logoutXml = $EPP->logoutclient();
        XmlArray::loadXML($logoutXml);
        $logoutCode = XmlArray::getArrayAttribute(null, 'result', 'code', true);
        if ($logoutCode != 1500) {
            $msg = XmlArray::getArrayElement(null, 'msg', true);
            $reason = XmlArray::getArrayElement(null, 'reason', true);
            $values['error'] = 'Error: domain register failed, (client logout) errorcode - ' . $logoutCode . ', Error Message - ' . $msg . ', Reason - ' . $reason;
        }
    } catch (Exception $ex) {
        $values['error'] = 'Error: Sync/domain-info(' . $domain . ') - Error Message' . $ex->getMessage();
    }
    return $values;
}

