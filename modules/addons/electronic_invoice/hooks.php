<?php

if (!defined('WHMCS')) {
    die('You cannot access this file directly.');
}

use WHMCS\Database\Capsule;


use WHMCS\Module\Addon\ElectronicInvoice\Helper;


global $whmcs;




function getTransactionIds($invoiceId)
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

function getitemlists($invoiceid)
{
    $command = 'GetInvoice';
    $postData = array(
        'invoiceid' => $invoiceid,
    );
    $results = localAPI($command, $postData);
    return $results;
}




if (isset($_POST['xmlmassbulk']) && $_POST['xmlmassbulk'] == "Xml Invoice Bulk") {
    $helper = new Helper();
    if ($whmcs->get_req_var("selectedinvoices")) {
        $zip = new ZipArchive();
        $zipFilename = 'invoices.zip';
        if ($zip->open($zipFilename, ZipArchive::CREATE) === true) {
            foreach ($whmcs->get_req_var("selectedinvoices") as $key => $invoiceIds) {

                $xml_data = '';
                $supplier_configoption = Capsule::table("tbladdonmodules")->where("module", "electronic_invoice")->get();
                $invoice_Details = Capsule::table("tblinvoices")
                    ->join("tblclients", "tblclients.id", "tblinvoices.userid")
                    ->select("tblinvoices.*", "tblclients.id as clientId", "tblclients.firstname as clientfirstname", "tblclients.lastname as clientlastname", "tblclients.address1 as clientaddress1", "tblclients.address2 as clientaddress2", "tblclients.city as clientcity", "tblclients.postcode as clientpostcode", "tblclients.country as clientcountry", "tblclients.currency as clientcurrency", "tblclients.phonenumber as clientmobile", "tblclients.companyname", "tblclients.email", "tblclients.tax_id", "tblclients.state")
                    ->where('tblinvoices.id', $invoiceIds)->first();
                if ($invoice_Details->status == "Refunded") {
                    $InvoiceTypeCode = "381";
                } else if ($invoice_Details->status == "Paid") {
                    $InvoiceTypeCode = "380";
                }


                if ($invoice_Details->status == "Refunded" || $invoice_Details->status == "Paid") {

                    //get transaction id
                    $transaction_id = Capsule::table("tblaccounts")->where("invoiceid", $invoiceIds)->where("userid", $invoice_Details->clientId)->value('transid');

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
                    $items_details = getitemlists($invoiceIds);
                    $itemCount = count($items_details['items']['item']);


                    $xml_data .= '
                    <Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" 
                             xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" 
                             xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" 
                             xmlns:ns4="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" 
                             xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                             xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd">
                        <cbc:CustomizationID>urn:cen.eu:en16931:2017#compliant#urn:efactura.mfinante.ro:CIUS-RO:1.0.1</cbc:CustomizationID>
                        <cbc:ID>' . $invoiceId . '</cbc:ID>
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
                                    <cbc:CountrySubentity>' . $helper->getStateRominaCode($config_fields['city_name']) . '</cbc:CountrySubentity>
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
                                    <cbc:CountrySubentity>' . $helper->getStateRominaCode($invoice_Details->state) . '</cbc:CountrySubentity>
                                    <cac:Country>
                                        <cbc:IdentificationCode>RO</cbc:IdentificationCode>
                                    </cac:Country>
                                </cac:PostalAddress>
                                <cac:PartyLegalEntity>
                                    <cbc:RegistrationName> ' . $invoice_Details->companyname . '</cbc:RegistrationName>
                                    <cbc:CompanyID>' . $invoice_Details->tax_id . '</cbc:CompanyID>
                                </cac:PartyLegalEntity>
                                <cac:Contact>
                                    <cbc:Name>' . $invoice_Details->clientfirstname . " " . $invoice_Details->clientlastname . '</cbc:Name>
                                    <cbc:Telephone>' . $invoice_Details->clientmobile . '</cbc:Telephone>
                                    <cbc:ElectronicMail>' . $invoice_Details->email . '</cbc:ElectronicMail>
                                </cac:Contact>
                            </cac:Party>
                        </cac:AccountingCustomerParty>';
                    if ($items_details['paymentmethod'] == 'mailin') {
                        $xml_data .= '
                        <cac:PaymentMeans>
                            <cbc:PaymentMeansCode name="Bank card">31</cbc:PaymentMeansCode>
                            <cbc:PaymentID>' . $transaction_id . '</cbc:PaymentID>
                            <cac:PayeeFinancialAccount>
                            <cbc:ID>' . getTransactionIds($invoice_Details->id) . '</cbc:ID>
                            </cac:PayeeFinancialAccount>
                        </cac:PaymentMeans>';
                    } else {
                        $xml_data .= '
                        <cac:PaymentMeans>
                            <cbc:PaymentMeansCode name="Debit transfer">48</cbc:PaymentMeansCode>
                            <cbc:PaymentID>' . getTransactionIds($invoice_Details->id) . '</cbc:PaymentID>
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

                    // Add XML content to the zip archive with a unique filename
                    $zip->addFromString('filename' . $invoiceId . '.xml', $xml_data);
                }
            }


            // Close the zip archive
            $zip->close();

            // Set headers for downloading the zip file
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
            header('Content-Length: ' . filesize($zipFilename));

            // Output the zip file
            readfile($zipFilename);

            // Delete the zip file after download (optional)
            unlink($zipFilename);
            exit();
        }
    }
}

add_hook('AdminAreaHeadOutput', 1, function ($vars) {
    try {
        global $CONFIG;
        global $whmcs;
        $systemURL = $CONFIG['SystemURL'];
        if ($vars['filename'] == "invoices") {
            $invoiceId = $whmcs->get_req_var('id');

            $invoiceDetails = Capsule::table("tblinvoices")->where('id', $invoiceId)->first();

            if ($invoiceDetails->status == "Paid" || $invoiceDetails->status == "Refunded") {
                $htmlreturn =
                    "<script>
                $(document).ready(function(){
                    $('#btnMarkUnpaid').after(`<a href='$systemURL/modules/addons/electronic_invoice/invoice_xml_data.php?invoice=$invoiceDetails->id' ><button type='button' id='downloadElectronicInvoice' class='btn btn-primary'>
                        Export As XML</button></a>`);
                    });
                </script>";
                $htmlreturn .=
                    "<style>
                button#downloadElectronicInvoice {
                    margin-left: 4px;
                }
            </style>";
                return $htmlreturn;
            }
        }
        $pageArr = explode('/', $_SERVER['PHP_SELF']);
        $count = count($pageArr) - 1;
        $page = $pageArr[$count];

        if ($page == "invoices.php") {
            $htmlreturn =
                "<script>
                    $(document).ready(function(){
                        $('input[name=massdelete]').after(`<input type='submit' value='Xml Invoice Bulk' class='btn btn-primary xmlmassbulk' name='xmlmassbulk'>`);
                    });
                </script>";
            $htmlreturn .=
                "<style>
                        input.btn.btn-primary.xmlmassbulk {
                            margin-left: 10px;
                        }
                 </style>";
            return $htmlreturn;
        }
    } catch (Exception $e) {
        logActivity('Electronic Invoice Error:' . $e->getMessage());
    }
});




add_hook('EmailPreSend', 1, function ($vars) {
    $merge_fields = [];
    if ($vars['messagename'] == 'Invoice Payment Confirmation' && (Capsule::table('tbladdonmodules')->where('module', 'electronic_invoice')->count() > 0)) {
        if(empty($vars['mergefields']['is_attachment'])){
            $merge_fields['abortsend'] = true;
        }
    }
    return $merge_fields;
});

add_hook('InvoicePaid', 199, function ($vars) {
    $invoiceID = $vars['invoiceid'];
    $helper = new Helper();
    $helper->DownloadXml($invoiceID);
});
