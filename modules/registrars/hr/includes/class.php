<?php

if (!defined("WHMCS")) {
  die("This file cannot be accessed directly");
}

use WHMCS\Database\Capsule;
class hrdomain
{
  public $apiusername;
  public $password;
  public $apiurl;

  public function __construct($params)
  {
    $this->apiurl = $params['Apiurl'];
    $this->apiusername = $params['Username'];
    $this->password = $params['hr_password'];
  }


  public function hrconnection($xml)
  {

    static $ch = null;
    if (!$ch) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->apiurl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_COOKIE, true);
      curl_setopt($ch, CURLOPT_COOKIEFILE, tmpfile());
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    }
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

    return curl_exec($ch);
  }

  public function hrclientlogin($params)
  {

    $xml = '<?xml version="1.0" encoding="utf-8"?>
    <epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
      <command>
        <login>
          <clID>' . $this->apiusername . '</clID>
          <pw>' . $this->password . '</pw>
          <options>
            <version>1.0</version>
            <lang>en</lang>
          </options>
          <svcs>
            <objURI>urn:ietf:params:xml:ns:domain-1.0</objURI>
            <objURI>urn:ietf:params:xml:ns:contact-1.0</objURI>
            <svcExtension>
              <extURI>http://www.dns.hr/epp/hr-1.0</extURI>
            </svcExtension>
          </svcs>
        </login>
        <clTRID>LOGIN' . rand(1000, 9999) . '</clTRID>
      </command>
    </epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr', 'login', $xml, $response);
    return $response;
  }


  public function checkhrdomainContact($params, $type = NULL, $var)
  {
    if ($type == 'Registrant')
      $contactId = $params['regcontactid'];

    if ($type == 'Technical')
      $contactId = $params['techcontactid'];
    if ($type == 'Admin')
      $contactId = $params['admincontactid'];

    $xml = ' <?xml version="1.0" encoding="utf-8"?>
    <epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
      <command>
        <check>
          <contact:check xmlns:contact="urn:ietf:params:xml:ns:contact-1.0">
            <contact:id>' . $contactId . '</contact:id>
          </contact:check>
        </check>
        <clTRID>CHECK-' . rand(1000, 9999) . '</clTRID>
      </command>
    </epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('HR Register', $var, $xml, $response);
    return $response;
  }
  # Create Domain Contacts

  public function createhrdomainContact($params, $type = NULL, $var, $contactId)
  {

   
    $taxNo = $notify = '';
    if ($type == 'Admin') {
      $firstname = $params['adminfirstname'] ? $params['adminfirstname'] : $params['firstname'];
      $lastname = $params['adminlastname'] ? $params['adminlastname'] : $params['lastname'];
      $companyname = $params['admincompanyname'] ? $params['admincompanyname'] : $params['companyname'];
      $address1 = $params['adminaddress1'] ? $params['adminaddress1'] : $params['address1'];
      $address2 = $params['adminaddress2'] ? $params['adminaddress2'] : $params['address2'];
      $city = $params['admincity'] ? $params['admincity'] : $params['city'];
      $state = $params['adminstate'] ? $params['adminstate'] : $params['state'];
      $postcode = $params['adminpostcode'] ? $params['adminpostcode'] : $params['postcode'];
      $country = $params['admincountry'] ? $params['admincountry'] : $params['country'];
      $state = ($country == 'MK' && empty($state)) ? 'state' : $state;
      $phonenumber = $params['adminfullphonenumber'] ? $params['adminfullphonenumber'] : $params['phonenumberformatted'];
      $email = $params['adminemail'] ? $params['adminemail'] : $params['email'];
      $fullname = $firstname ? $firstname . ' ' . $lastname : $params['fullname'];
      $notify = '<contact:notifyEmail>' . $email . '</contact:notifyEmail>';

      $password = $this->generateRandomString(10);
    } elseif ($type == 'Tech') {
      $firstname = $params['adminfirstname'] ? $params['adminfirstname'] : $params['firstname'];
      $lastname = $params['adminlastname'] ? $params['adminlastname'] : $params['lastname'];
      $companyname = $params['admincompanyname'] ? $params['admincompanyname'] : $params['companyname'];
      $address1 = $params['adminaddress1'] ? $params['adminaddress1'] : $params['address1'];
      $address2 = $params['adminaddress2'] ? $params['adminaddress2'] : $params['address2'];
      $city = $params['admincity'] ? $params['admincity'] : $params['city'];
      $state = $params['adminstate'] ? $params['adminstate'] : $params['state'];
      $postcode = $params['adminpostcode'] ? $params['adminpostcode'] : $params['postcode'];
      $country = $params['admincountry'] ? $params['admincountry'] : $params['country'];
      $state = ($country == 'MK' && empty($state)) ? 'state' : $state;
      $phonenumber = $params['adminfullphonenumber'] ? $params['adminfullphonenumber'] : $params['phonenumberformatted'];
      $email = $params['adminemail'] ? $params['adminemail'] : $params['email'];
      $fullname = $firstname ? $firstname . ' ' . $lastname : $params['fullname'];
      $notify = '<contact:notifyEmail>' . $email . '</contact:notifyEmail>';

      $password = $this->generateRandomString(10);
    } else {
      $firstname = $params['firstname'];
      $lastname = $params['lastname'];
      $companyname = $params['companyname'];
      $address1 = $params['address1'];
      $address2 = $params['address2'];
      $city = $params['city'];
      $state = ($params['country'] && empty($params['state'])) == 'MK' ? 'state' : $params['state'];
      $postcode = $params['postcode'];
      $country = $params['country'];
      $phonenumber = $params['phonenumberformatted'];
      $email = $params['email'];
      $fullname = $params['fullname'];
      $password = $this->generateRandomString(10);
      if ($params['additionalfields']['Domain For']) {
        if ($params['additionalfields']['Domain For'] == 'hr_1') {
          $fullname = $params['additionalfields']['Company Short Name'];
          $taxNo = '<contact:ident type="ico">' . $params['additionalfields']['Tax No'] . '</contact:ident>';
        } elseif ($params['additionalfields']['Domain For'] == 'hr_2') {
          $companyname = '';
        }
      }
      $notify = '<contact:notifyEmail>' . $email . '</contact:notifyEmail>';
    }

    $xml = '<?xml version="1.0" encoding="utf-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:contact="urn:ietf:params:xml:ns:contact-1.0" xmlns:hr="http://www.dns.hr/epp/hr-1.0">
  <command>
    <create>
      <contact:create>
        <contact:id>' . $contactId . '</contact:id>
        <contact:postalInfo type="int">
          <contact:name>' . $fullname . '</contact:name>
          <contact:addr>
            <contact:street>' . $address1 . '</contact:street>
            <contact:city>' . $city . '</contact:city>
            <contact:pc>' . $postcode . '</contact:pc>
            <contact:cc>' . $country . '</contact:cc>
          </contact:addr>
        </contact:postalInfo>
        <contact:voice>' . $phonenumber . '</contact:voice>
        <contact:fax>' . $phonenumber . '</contact:fax>
        <contact:email>' . $email . '</contact:email>
        <contact:authInfo>
          <contact:pw>' . $password . '</contact:pw>
        </contact:authInfo>
      </contact:create>
    </create>
    <extension>
      <hr:create>
        <hr:contact>
          <hr:type>'.$this->getCustomfieldValue('client','ownerType',$params['client_id']).'</hr:type>
          <hr:in>'.$this->getCustomfieldValue('client','oib',$params['client_id']).'</hr:in>
        </hr:contact>
      </hr:create>
    </extension>
    <clTRID>CHECK-' . rand(1000, 9999) . '</clTRID>
  </command>
</epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('HR Register', $var, $xml, $response);
    return $response;
  }

  public function checkHrDomain($params, $var)
  {
    
    $whmcsversion = $params['whmcsVersion'];
    $versionParts = explode('-', $whmcsversion);
    $majorMinorVersion = $versionParts[0];
   if ($majorMinorVersion < '8.0.0') {
      $domainName = '<domain:name>' . $params['sld'] . '.' . $params['tld'] . '</domain:name>';
} else {
      $domainName = '<domain:name>' . $params['domain_punycode'] . '</domain:name>';
  }
    $xml = '<?xml version="1.0" encoding="utf-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
  <command>
    <check>
      <domain:check>
        ' . $domainName . '
      </domain:check>
    </check>
    <clTRID>CHECK-' . rand(1000, 9999) . '</clTRID>
  </command>
</epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr Register', $var, $xml, $response);
    return $response;
  }

  public function gethrdomaininfo($params, $action)
  {
    $whmcsversion = $params['whmcsVersion'];
    $versionParts = explode('-', $whmcsversion);
    $majorMinorVersion = $versionParts[0];
   if ($majorMinorVersion < '8.0.0') {
      $domainName = '<domain:name>' . $params['sld'] . '.' . $params['tld'] . '</domain:name>';
} else {
      $domainName = '<domain:name>' . $params['domain_punycode'] . '</domain:name>';
  }
  $xml = '<?xml version="1.0" encoding="utf-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
  <command>
    <info>
      <domain:info>
        ' . $domainName . '
      </domain:info>
    </info>
    <clTRID>Domain-info' . rand(1000, 9999) . '</clTRID>
  </command>
</epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr Register', $action, $xml, $response);
    return $response;
  }
  public function gethrcontactdetails($params, $contactId, $action = NULL)
  {
    $xml = '<?xml version="1.0" encoding="utf-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:contact="urn:ietf:params:xml:ns:contact-1.0">
  <command>
    <info>
      <contact:info>
        <contact:id>' . $contactId . '</contact:id>
      </contact:info>
    </info>
    <clTRID>GETDETAILS' . rand(1000, 9999) . '</clTRID>
  </command>
</epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr Register', $action, $xml, $response);

    return $response;
  }
  public function updatehrdomaincontact($params, $contactId, $action = NULL)
  {
    $xml = '<?xml version="1.0" encoding="utf-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:contact="urn:ietf:params:xml:ns:contact-1.0" xmlns:hr="http://www.dns.hr/epp/hr-1.0">
  <command>
    <update>
      <contact:update>
        <contact:id>' . $contactId . '</contact:id>
        <contact:chg>
          <contact:postalInfo type="int">
            <contact:name>' . $params['contactdetails'][$action]['Contact Name'] . '</contact:name>
            <contact:addr>
              <contact:street>' . $params['contactdetails'][$action]['Address line 1'] . '</contact:street>
              <contact:city>' . $params['contactdetails'][$action]['TownCity'] . '</contact:city>
              <contact:pc>' . $params['contactdetails'][$action]['Zip code'] . '</contact:pc>
              <contact:cc>' . $params['contactdetails'][$action]['Country'] . '</contact:cc>
            </contact:addr>
          </contact:postalInfo>
          <contact:voice>' . $params['contactdetails'][$action]['Phone'] . '</contact:voice>
          <contact:email>' . $params['contactdetails'][$action]['Email'] . '</contact:email>
        </contact:chg>
      </contact:update>
    </update>
    <clTRID>CHECK-' . rand(1000, 9999) . '</clTRID>
  </command>
</epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr Register', $action, $xml, $response);
    return $response;
  }
  public function createhrdomain($params, $regId, $adminId, $techid,$regPeriod = NULL, $var)
  {
    $ns = '';
    if ($params['ns1']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns1'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
    if ($params['ns2']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns2'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
    if ($params['ns3']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns3'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
    if ($params['ns4']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns4'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
    if ($params['ns5']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns5'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }


    $password = $this->generateRandomString(10);

    if (!empty($regPeriod))
      $period = $regPeriod;
    else
      $period = $params['regperiod'] * 12;
      $whmcsversion = $params['whmcsVersion'];
      $versionParts = explode('-', $whmcsversion);
      $majorMinorVersion = $versionParts[0];
     if ($majorMinorVersion < '8.0.0') {
        $domainName = '<domain:name>' . $params['sld'] . '.' . $params['tld'] . '</domain:name>';
  } else {
        $domainName = '<domain:name>' . $params['domain_punycode'] . '</domain:name>';
    }
    $xml = '<?xml version="1.0" encoding="utf-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
  <command>
    <create>
      <domain:create>
        ' . $domainName . '
        <domain:period unit="y">1</domain:period>
        <domain:ns>
             ' . $ns . '
        </domain:ns>
        <domain:registrant>' . $regId . '</domain:registrant>
        <domain:contact type="admin">' . $adminId . '</domain:contact>
        <domain:contact type="tech">' . $techid . '</domain:contact>

        <domain:authInfo>
          <domain:pw>' . $password . '</domain:pw>
        </domain:authInfo>
      </domain:create>
    </create>
    <clTRID>Create-domain' . rand(1000, 9999) . '</clTRID>
  </command>
</epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr', $var, $xml, $response);
    return $response;
  }
  public function renewhrdomain($params, $currentExpDate, $period = NULL, $var)
  {
   $whmcsversion = $params['whmcsVersion'];
    $versionParts = explode('-', $whmcsversion);
    $majorMinorVersion = $versionParts[0];
   if ($majorMinorVersion < '8.0.0') {
      $domainName = '<domain:name>' . $params['sld'] . '.' . $params['tld'] . '</domain:name>';
} else {
      $domainName = '<domain:name>' . $params['domain_punycode'] . '</domain:name>';
  }
    $xml = '<?xml version="1.0" encoding="utf-8"?>
    <epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
      <command>
        <renew>
          <domain:renew>
            ' . $domainName . '
            <domain:curExpDate>' . $currentExpDate . '</domain:curExpDate>
            <domain:period unit="y">' . $period . '</domain:period>
          </domain:renew>
        </renew>
        <clTRID>Renew' . rand(1000, 9999) . '</clTRID>
      </command>
    </epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr Register', $var, $xml, $response);
    return $response;
  }

  public function logoutclient()
  {
    $xml = '<?xml version="1.0" encoding="utf-8"?>
    <epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
      <command>
        <logout/>
        <clTRID>LOGOUT' . rand(1000, 9999) . '</clTRID>
      </command>
    </epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr', 'logout', $xml, $response);
    return $response;
  }
  
  #random string
  function generateRandomString($length = 3)
  {
    $characters = '0123456789';

    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  function updatehrNamerserver($params, $adminId, $techId, $regId, $nsvalues)
  {
    $whmcsversion = $params['whmcsVersion'];
    $versionParts = explode('-', $whmcsversion);
    $majorMinorVersion = $versionParts[0];
   if ($majorMinorVersion < '8.0.0') {
      $domainName = '<domain:name>' . $params['sld'] . '.' . $params['tld'] . '</domain:name>';
} else {
      $domainName = '<domain:name>' . $params['domain_punycode'] . '</domain:name>';
  }
    $ns = '';
    if ($params['ns1']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns1'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
    if ($params['ns2']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns2'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
    if ($params['ns3']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns3'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
    if ($params['ns4']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns4'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
    if ($params['ns5']) {
      $ns .= '<domain:hostAttr>';
      $ns .= '<domain:hostName>' . $params['ns5'] . '</domain:hostName>';
      $ns .= '</domain:hostAttr>';
    }
 
    $xml = '
    <?xml version="1.0" encoding="utf-8"?>
    <epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
      <command>
        <update>
          <domain:update>
            ' . $domainName . '
            <domain:add>
              <domain:ns>
                ' . $ns . '
              </domain:ns>
              <domain:contact type="admin">' . $adminId . '</domain:contact>
              <domain:contact type="tech">' . $techId . '</domain:contact>
              <domain:status s="clientTransferProhibited" lang="en"></domain:status>
            </domain:add>
            <domain:rem>
              <domain:ns>';
    foreach ($nsvalues as $key => $hostName) {
      $xml .= '
                <domain:hostAttr>
                  <domain:hostName>' . $hostName . '</domain:hostName>
                </domain:hostAttr>';
    }
    $xml .= '
              </domain:ns>
              <domain:contact type="tech">' . $techId . '</domain:contact>
              <domain:contact type="admin">' . $adminId . '</domain:contact>
            </domain:rem>
            <domain:chg>
              <domain:authInfo>
                <domain:pw>not important</domain:pw>
              </domain:authInfo>
            </domain:chg>
          </domain:update>
        </update>
        <clTRID>' . rand(9999, 10000) . '</clTRID>
      </command>
    </epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr', 'updatenameserver', $xml, $response);
    return $response;
  }
  function updatehrdomainpw($params,$password)
  {
   $whmcsversion = $params['whmcsVersion'];
    $versionParts = explode('-', $whmcsversion);
    $majorMinorVersion = $versionParts[0];
   if ($majorMinorVersion < '8.0.0') {
      $domainName = '<domain:name>' . $params['sld'] . '.' . $params['tld'] . '</domain:name>';
} else {
      $domainName = '<domain:name>' . $params['domain_punycode'] . '</domain:name>';
  }
  $xml = '
<?xml version="1.0" encoding="utf-8"?>
  <epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
    <command>
      <update>
        <domain:update>
          ' . $domainName . '
          <domain:chg>
            <domain:authInfo>
              <domain:pw>' . $password . '</domain:pw>
            </domain:authInfo>
          </domain:chg>
        </domain:update>
      </update>
      <clTRID>' . rand(9999, 10000) . '</clTRID>
    </command>
  </epp>';
    $response = $this->hrconnection($xml);
    logModuleCall('Hr', 'updatepw', $xml, $response);
    return $response;
  }
  function generate_password($length = 12)
  {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
    $password = '';
    // Add at least one letter
    $password .= $characters[rand(0, 51)];
    // Add at least one digit
    $password .= $characters[rand(52, 61)];
    // Add at least one special character
    $password .= $characters[rand(62, 71)];
    // Add remaining characters
    for ($i = 0; $i < $length; $i++) {
      $password .= $characters[rand(0, 71)];
    }
    return $password;
  }

  function transferdomain($params)
  {
$xml='<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
  <command>
   <transfer op="request">
     <domain:transfer
      xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
       <domain:name>' . $params['domain_punycode'] . '</domain:name>
       <domain:authInfo>
         <domain:pw roid="JD1234-REP">' . $params['transfersecret'] . '</domain:pw>
       </domain:authInfo>
     </domain:transfer>
    </transfer>
    <clTRID>TRANSFERDOMAIN-' . rand(1000, 9999) . '</clTRID>
  </command>
</epp>
';
$response = $this->hrconnection($xml);
logModuleCall('Hr', 'transferdomain', $xml, $response);
return $response;
  }

  public function createCustomFields($client = 0)
  {
      $customfieldarray = [
          'oib' => [
              'type' => 'client',
              'fieldname' => 'oib|OIB',
              'relid' => $client,
              'fieldtype' => 'text',
              'description' => '',
              'sortorder' => '0',
              'showorder' => 'on'
          ],
          'ownerType' => [
              'type' => 'client',
              'fieldname' => 'ownerType|Owner Type',
              'relid' => $client,
              'fieldtype' => 'dropdown',
              'description' => '',
              'sortorder' => '1',
              'fieldoptions' => 'person,org',
              'showorder' => 'on'
          ],
      ];
      foreach ($customfieldarray as $key => $customfieldval) {
          $fieldname = explode('|', $customfieldval['fieldname']);
          if (Capsule::table('tblcustomfields')->where('type', $customfieldval['type'])->where('relid', $customfieldval['relid'])->where('fieldname', 'like', '%' . $fieldname[0] . '%')->count() == 0) {
              Capsule::table('tblcustomfields')->insert($customfieldval);
          }
      }
  }
  public function getCustomfieldValue($type,$customfieldname,$relid)
  {
      return Capsule::table("tblcustomfields")
      ->join('tblcustomfieldsvalues','tblcustomfieldsvalues.fieldid','tblcustomfields.id')
      ->where('tblcustomfields.type', $type)
      ->where('tblcustomfields.fieldname', 'like', '%' . $customfieldname . '%')
      ->where('tblcustomfieldsvalues.relid',$relid)
      ->value('tblcustomfieldsvalues.value');
  }

}

