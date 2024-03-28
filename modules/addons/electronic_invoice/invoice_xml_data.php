<?php

use WHMCS\Database\Capsule;


require(__DIR__ . "/../../../init.php");

global $whmcs;



use WHMCS\Module\Addon\ElectronicInvoice\Helper;



$helper = new Helper();






function getTransactionId($invoiceId)
{
    try {
        $transid = Capsule::table("tblaccounts")->where("invoiceid", $invoiceId)->value("transid");
        $transid = empty($transid) ? "Credit Applied" : $transid;
        return $transid;
    } catch (\Illuminate\Database\QueryException $e) {
        throw new \Exception('Error while getting transaction Id: ' . $e->getMessage());
    } catch (Exception $e) {
        throw new \Exception('Error while getting transaction Id: ' . $e->getMessage());
    }
}


function gstGetCountries($code = NULL)
{
    $countries = array(
        "AF" => "Afghanistan",
        "AX" => "Aland Islands",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AQ" => "Antarctica",
        "AG" => "Antigua And Barbuda",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "Bosnia And Herzegovina",
        "BW" => "Botswana",
        "BV" => "Bouvet Island",
        "BR" => "Brazil",
        "IO" => "British Indian Ocean Territory",
        "BN" => "Brunei Darussalam",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CA" => "Canada",
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CX" => "Christmas Island",
        "CC" => "Cocos (Keeling) Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
        "CD" => "Congo, Democratic Republic",
        "CK" => "Cook Islands",
        "CR" => "Costa Rica",
        "CI" => "Cote D'Ivoire",
        "HR" => "Croatia",
        "CU" => "Cuba",
        "CW" => "Curacao",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "EC" => "Ecuador",
        "EG" => "Egypt",
        "SV" => "El Salvador",
        "GQ" => "Equatorial Guinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "Falkland Islands (Malvinas)",
        "FO" => "Faroe Islands",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "French Guiana",
        "PF" => "French Polynesia",
        "TF" => "French Southern Territories",
        "GA" => "Gabon",
        "GM" => "Gambia",
        "GE" => "Georgia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GG" => "Guernsey",
        "GN" => "Guinea",
        "GW" => "Guinea-Bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HM" => "Heard Island & Mcdonald Islands",
        "VA" => "Holy See (Vatican City State)",
        "HN" => "Honduras",
        "HK" => "Hong Kong",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran, Islamic Republic Of",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IM" => "Isle Of Man",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JE" => "Jersey",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KR" => "Korea",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LA" => "Lao People's Democratic Republic",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LY" => "Libyan Arab Jamahiriya",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macao",
        "MK" => "Macedonia",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "Marshall Islands",
        "MQ" => "Martinique",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "YT" => "Mayotte",
        "MX" => "Mexico",
        "FM" => "Micronesia, Federated States Of",
        "MD" => "Moldova",
        "MC" => "Monaco",
        "MN" => "Mongolia",
        "ME" => "Montenegro",
        "MS" => "Montserrat",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "MM" => "Myanmar",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "AN" => "Netherlands Antilles",
        "NC" => "New Caledonia",
        "NZ" => "New Zealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "NU" => "Niue",
        "NF" => "Norfolk Island",
        "MP" => "Northern Mariana Islands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PS" => "Palestine, State of",
        "PA" => "Panama",
        "PG" => "Papua New Guinea",
        "PY" => "Paraguay",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "Puerto Rico",
        "QA" => "Qatar",
        "RE" => "Reunion",
        "RO" => "Romania",
        "RU" => "Russian Federation",
        "RW" => "Rwanda",
        "BL" => "Saint Barthelemy",
        "SH" => "Saint Helena",
        "KN" => "Saint Kitts And Nevis",
        "LC" => "Saint Lucia",
        "MF" => "Saint Martin",
        "PM" => "Saint Pierre And Miquelon",
        "VC" => "Saint Vincent And Grenadines",
        "WS" => "Samoa",
        "SM" => "San Marino",
        "ST" => "Sao Tome And Principe",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "RS" => "Serbia",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "GS" => "South Georgia And Sandwich Isl.",
        "ES" => "Spain",
        "LK" => "Sri Lanka",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SJ" => "Svalbard And Jan Mayen",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "Syrian Arab Republic",
        "TW" => "Taiwan",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania",
        "TH" => "Thailand",
        "TL" => "Timor-Leste",
        "TG" => "Togo",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TT" => "Trinidad And Tobago",
        "TN" => "Tunisia",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "Turks And Caicos Islands",
        "TV" => "Tuvalu",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "AE" => "United Arab Emirates",
        "GB" => "United Kingdom",
        "US" => "United States",
        "UM" => "United States Outlying Islands",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VE" => "Venezuela",
        "VN" => "Viet Nam",
        "VG" => "Virgin Islands, British",
        "VI" => "Virgin Islands, U.S.",
        "WF" => "Wallis And Futuna",
        "EH" => "Western Sahara",
        "YE" => "Yemen",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe"
    );
    if (isset($code))
        return $countries[$code];
    asort($countries);
    if (isset($countries))
        return $countries;
}

$supplier_configoption = Capsule::table("tbladdonmodules")->where("module", "electronic_invoice")->get();
$invoice_Details = Capsule::table("tblinvoices")
    ->join("tblclients", "tblclients.id", "tblinvoices.userid")
    ->select("tblinvoices.*", "tblclients.id as clientId", "tblclients.firstname as clientfirstname", "tblclients.lastname as clientlastname", "tblclients.address1 as clientaddress1", "tblclients.address2 as clientaddress2", "tblclients.city as clientcity", "tblclients.postcode as clientpostcode", "tblclients.country as clientcountry", "tblclients.currency as clientcurrency", "tblclients.phonenumber as clientmobile", "tblclients.companyname", "tblclients.email", "tblclients.tax_id", "tblclients.state")
    ->where('tblinvoices.id', $whmcs->get_req_var('invoice'))->first();
if ($invoice_Details->status == "Refunded") {
    $InvoiceTypeCode = "381";
} else if ($invoice_Details->status == "Paid") {
    $InvoiceTypeCode = "380";
}








//get transaction id
$transaction_id = Capsule::table("tblaccounts")->where("invoiceid", $whmcs->get_req_var('invoice'))->where("userid", $invoice_Details->clientId)->value('transid');

//get currency code
$currreny_code = Capsule::table("tblcurrencies")->where("tblcurrencies.id", $invoice_Details->clientcurrency)->value('code');

if (($currreny_code == "RON") || ($currreny_code == "EUR") || ($currreny_code == "GBP") || ($currreny_code == "USD")) {
    $currencyCode = $currreny_code;
} else {
    $currencyCode = "RON";
}


$invoiceId = !empty($invoice_Details->invoicenum) ? $invoice_Details->invoicenum : $invoice_Details->id;


$config_fields = [];
foreach ($supplier_configoption as $setting) {
    $config_fields[$setting->setting] = $setting->value;
}
if ($invoice_Details->taxrate === $invoice_Details->taxrate2) {
    $taxrate = intval($invoice_Details->taxrate2);
} else {
    $taxrate = intval($invoice_Details->taxrate);
}
//get itemlist 
$items_details = getitemlist($whmcs->get_req_var('invoice'));
$itemCount = count($items_details['items']['item']);

function getitemlist($invoiceid)
{
    $command = 'GetInvoice';
    $postData = array(
        'invoiceid' => $invoiceid,
    );
    $results = localAPI($command, $postData);
    return $results;
}
// Set the content type to XML
header('Content-Type: application/xml');
// Set the filename for the download
header('Content-Disposition: attachment; filename="' . $invoiceId . '.xml"');

$xml_data .= '
<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" 
         xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" 
         xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" 
         xmlns:ns4="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" 
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
         xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd">
    <cbc:CustomizationID>urn:cen.eu:en16931:2017#compliant#urn:efactura.mfinante.ro:CIUS-RO:1.0.1</cbc:CustomizationID>
    <cbc:ID>' . $invoiceId. '</cbc:ID>
    <cbc:IssueDate>' . $invoice_Details->date . '</cbc:IssueDate>
    <cbc:DueDate>' . $invoice_Details->duedate . '</cbc:DueDate>
    <cbc:InvoiceTypeCode>' . $InvoiceTypeCode . '</cbc:InvoiceTypeCode>
    <cbc:DocumentCurrencyCode>' . $currencyCode . '</cbc:DocumentCurrencyCode>

    <cac:AccountingSupplierParty>
        <cac:Party>
            <cac:PostalAddress>
                <cbc:StreetName>' . $config_fields['street_name'] . '</cbc:StreetName>
                <cbc:CityName>' . $config_fields['city_name'] . '</cbc:CityName>
                <cbc:PostalZone>' . $config_fields['postal_zone'] . '</cbc:PostalZone>
                <cbc:CountrySubentity>' . $helper->getStateRominaCode(($config_fields['city_name'])) . '</cbc:CountrySubentity>
                <cac:Country>
                    <cbc:IdentificationCode>' . $config_fields['identification_code'] . '</cbc:IdentificationCode>
                </cac:Country>
            </cac:PostalAddress>
            <cac:PartyTaxScheme>
                <cbc:CompanyID>' . $config_fields['tax_company_id'] . '</cbc:CompanyID>
                <cac:TaxScheme>
                    <cbc:ID>VAT</cbc:ID>
                </cac:TaxScheme>
            </cac:PartyTaxScheme>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName>' . $config_fields['registration_name'] . '</cbc:RegistrationName>
                <cbc:CompanyID>' . $config_fields['legalentity_company_id'] . '</cbc:CompanyID>
            </cac:PartyLegalEntity>
            <cac:Contact>
                <cbc:Name>' . $config_fields['registration_name'] . '</cbc:Name>
                <cbc:Telephone>' . $config_fields['telephone'] . '</cbc:Telephone>
                <cbc:ElectronicMail>' . $config_fields['registration_email'] . '</cbc:ElectronicMail>
            </cac:Contact>
        </cac:Party>
    </cac:AccountingSupplierParty>

    <cac:AccountingCustomerParty>
        <cac:Party>
            <cac:PostalAddress>
                <cbc:StreetName>' . $invoice_Details->clientaddress1 . '. ' . $invoice_Details->clientaddress2 . '</cbc:StreetName>
                <cbc:CityName>' . $invoice_Details->state . '</cbc:CityName>
                <cbc:PostalZone>' . $invoice_Details->clientpostcode . '</cbc:PostalZone>
                <cbc:CountrySubentity>' . $helper->getStateRominaCode(ucfirst(strtolower($invoice_Details->state))) . '</cbc:CountrySubentity>
                <cac:Country>
                    <cbc:IdentificationCode>RO</cbc:IdentificationCode>
                </cac:Country>
            </cac:PostalAddress>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName> ' . $invoice_Details->companyname  . '</cbc:RegistrationName>
                <cbc:CompanyID>' . $invoice_Details->tax_id . '</cbc:CompanyID>
            </cac:PartyLegalEntity>
            <cac:Contact>
                <cbc:Name>' . $invoice_Details->clientfirstname . " " . $invoice_Details->clientlastname . '</cbc:Name>
                <cbc:Telephone>' . $invoice_Details->clientmobile  . '</cbc:Telephone>
                <cbc:ElectronicMail>' . $invoice_Details->email  . '</cbc:ElectronicMail>
            </cac:Contact>
        </cac:Party>
    </cac:AccountingCustomerParty>';
if ($items_details['paymentmethod'] == 'mailin') {
    $xml_data .= '
    <cac:PaymentMeans>
        <cbc:PaymentMeansCode name="Bank card">31</cbc:PaymentMeansCode>
        <cbc:PaymentID>' . $transaction_id . '</cbc:PaymentID>
        <cac:PayeeFinancialAccount>
        <cbc:ID>' . getTransactionId($invoice_Details->id) . '</cbc:ID>
        </cac:PayeeFinancialAccount>
    </cac:PaymentMeans>';
} else {
    $xml_data .= '
    <cac:PaymentMeans>
        <cbc:PaymentMeansCode name="Debit transfer">48</cbc:PaymentMeansCode>
        <cbc:PaymentID>' . getTransactionId($invoice_Details->id) . '</cbc:PaymentID>
    </cac:PaymentMeans>';
}
if ($InvoiceTypeCode == '380') {
    $xml_data .= ' 
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="' . $currencyCode . '">' . $invoice_Details->tax + $invoice_Details->tax2 . '</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="' . $currencyCode . '">' . $invoice_Details->subtotal . '</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="' . $currencyCode . '">' . $invoice_Details->tax + $invoice_Details->tax2 . '</cbc:TaxAmount>
            <cac:TaxCategory>
                <cbc:ID>S</cbc:ID>
                <cbc:Percent>' . $taxrate . '</cbc:Percent>
                <cac:TaxScheme>
                    <cbc:ID>VAT</cbc:ID>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>

    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID="' . $currencyCode . '">' . $invoice_Details->subtotal . '</cbc:LineExtensionAmount>
        <cbc:TaxExclusiveAmount currencyID="' . $currencyCode . '">' . $invoice_Details->subtotal . '</cbc:TaxExclusiveAmount>
        <cbc:TaxInclusiveAmount currencyID="' . $currencyCode . '">' . $invoice_Details->tax + $invoice_Details->subtotal . '</cbc:TaxInclusiveAmount>
        <cbc:PrepaidAmount currencyID="' . $currencyCode . '">' . $invoice_Details->tax + $invoice_Details->subtotal . '</cbc:PrepaidAmount>
        <cbc:PayableAmount currencyID="' . $currencyCode . '">0.00</cbc:PayableAmount>
    </cac:LegalMonetaryTotal>';

    foreach ($items_details['items']['item'] as $items) {
        $xml_data .= '
    <cac:InvoiceLine>
        <cbc:ID>' . $items['id'] . '</cbc:ID>
        <cbc:InvoicedQuantity unitCode="H87">1.00</cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID="' . $currencyCode . '">' . $items['amount'] . '</cbc:LineExtensionAmount>
        <cac:Item>
            <cbc:Name>' . $items['description'] . '</cbc:Name>
            <cac:ClassifiedTaxCategory>
                <cbc:ID>S</cbc:ID>
                <cbc:Percent>' . $taxrate . '</cbc:Percent>
                <cac:TaxScheme>
                <cbc:ID>VAT</cbc:ID>
                </cac:TaxScheme>
            </cac:ClassifiedTaxCategory>
        </cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID="' . $currencyCode . '">' . $items['amount'] . '</cbc:PriceAmount>
        </cac:Price>
    </cac:InvoiceLine>';
    }
} else {
    $xml_data .= ' 
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="' . $currencyCode . '">-' . $invoice_Details->tax + $invoice_Details->tax2 . '</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="' . $currencyCode . '">-' . $items['amount'] . '</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="' . $currencyCode . '">-' . $invoice_Details->tax + $invoice_Details->tax2 . '</cbc:TaxAmount>
            <cac:TaxCategory>
                <cbc:ID>S</cbc:ID>
                <cbc:Percent>' . $taxrate . '</cbc:Percent>
                <cac:TaxScheme>
                    <cbc:ID>VAT</cbc:ID>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>

    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID="' . $currencyCode . '">-' . $invoice_Details->subtotal . '</cbc:LineExtensionAmount>
        <cbc:TaxExclusiveAmount currencyID="' . $currencyCode . '">-' . $invoice_Details->subtotal . '</cbc:TaxExclusiveAmount>
        <cbc:TaxInclusiveAmount currencyID="' . $currencyCode . '">-' . $invoice_Details->tax + $invoice_Details->subtotal . '</cbc:TaxInclusiveAmount>
        <cbc:PrepaidAmount currencyID="' . $currencyCode . '">-' . $invoice_Details->tax + $invoice_Details->subtotal . '</cbc:PrepaidAmount>
    </cac:LegalMonetaryTotal>';


    foreach ($items_details['items']['item'] as $items) {
        $xml_data .= '
    <cac:InvoiceLine>
        <cbc:ID>1</cbc:ID>
        <cbc:InvoicedQuantity unitCode="H87">1.00</cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID="' . $currencyCode . '">-' . $items['amount'] . '</cbc:LineExtensionAmount>
        <cac:Item>
            <cbc:Name>' . $items['description'] . '</cbc:Name>
            <cac:ClassifiedTaxCategory>
                <cbc:ID>S</cbc:ID>
                <cbc:Percent>' . $taxrate . '</cbc:Percent>
                <cac:TaxScheme>
                <cbc:ID>VAT</cbc:ID>
                </cac:TaxScheme>
            </cac:ClassifiedTaxCategory>
        </cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID="' . $currencyCode . '">' . $items['amount'] . '</cbc:PriceAmount>
        </cac:Price>
    </cac:InvoiceLine>';
    }
}
$xml_data .= '
</Invoice>';
echo $xml_data;
