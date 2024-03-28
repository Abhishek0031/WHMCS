<?php

namespace WHMCS\Module\Addon\ElectronicInvoice;

use WHMCS\Database\Capsule;


class Helper
{

    public function getStateRominaCode($state)
    {
        $code = [
            "RO-AB" => "Alba",
            "RO-AR" => "Arad",
            "RO-AG" => "Arges",
            "RO-BC" => "Bacău",
            "RO-BH" => "Bihor",
            "RO-BN" => "Bistrița-Năsăud",
            "RO-BT" => "Botoșani",
            "RO-BV" => "Brașov",
            "RO-BR" => "Brăila",
            "RO-B" => "București",
            "RO-BZ" => "Buzău",
            "RO-CS" => "Caraș-Severin",
            "RO-CL" => "Călărași",
            "RO-CJ" => "Cluj",
            "RO-CT" => "Constanța",
            "RO-CV" => "Covasna",
            "RO-DB" => "Dâmbovița",
            "RO-DJ" => "Dolj",
            "RO-GL" => "Galați",
            "RO-GR" => "Giurgiu",
            "RO-GJ" => "Gorj",
            "RO-HR" => "Harghita",
            "RO-HD" => "Hunedoara",
            "RO-IL" => "Ialomița",
            "RO-IS" => "Iași",
            "RO-IF" => "Ilfov",
            "RO-MM" => "Maramureș",
            "RO-MH" => "Mehedinți",
            "RO-MS" => "Mureș",
            "RO-NT" => "Neamț",
            "RO-OT" => "Olt",
            "RO-PH" => "Prahova",
            "RO-SM" => "Satu Mare",
            "RO-SJ" => "Sălaj",
            "RO-SB" => "Sibiu",
            "RO-SV" => "Suceava",
            "RO-TR" => "Teleorman",
            "RO-TM" => "Timiș",
            "RO-TL" => "Tulcea",
            "RO-VS" => "Vaslui",
            "RO-VL" => "Vâlcea",
            "RO-VN" => "Vrancea",
        ];

        $results = array_search($state, $code);

        return $results;
    }

    public function DownloadXml($invoiceId)
    {
        $supplier_configoption = Capsule::table("tbladdonmodules")->where("module", "electronic_invoice")->get();
        $invoice_Details = Capsule::table("tblinvoices")
            ->join("tblclients", "tblclients.id", "tblinvoices.userid")
            ->select("tblinvoices.*", "tblclients.id as clientId", "tblclients.firstname as clientfirstname", "tblclients.lastname as clientlastname", "tblclients.address1 as clientaddress1", "tblclients.address2 as clientaddress2", "tblclients.city as clientcity", "tblclients.postcode as clientpostcode", "tblclients.country as clientcountry", "tblclients.currency as clientcurrency", "tblclients.phonenumber as clientmobile", "tblclients.companyname", "tblclients.email", "tblclients.tax_id", "tblclients.state")
            ->where('tblinvoices.id', $invoiceId)->first();
        if ($invoice_Details->status == "Refunded") {
            $InvoiceTypeCode = "381";
        } else if ($invoice_Details->status == "Paid") {
            $InvoiceTypeCode = "380";
        }

        //get transaction id
        $transaction_id = Capsule::table("tblaccounts")->where("invoiceid", $invoiceId)->where("userid", $invoice_Details->clientId)->value('transid');

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
        $items_details = $this->getitemlist($invoiceId);
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
                <cbc:CountrySubentity>' . $this->getStateRominaCode(($config_fields['city_name'])) . '</cbc:CountrySubentity>
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
                <cbc:CountrySubentity>' . $this->getStateRominaCode(ucfirst(strtolower($invoice_Details->state))) . '</cbc:CountrySubentity>
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
        <cbc:ID>' . $this->getTransaction($invoice_Details->id) . '</cbc:ID>
        </cac:PayeeFinancialAccount>
    </cac:PaymentMeans>';
        } else {
            $xml_data .= '
    <cac:PaymentMeans>
        <cbc:PaymentMeansCode name="Debit transfer">48</cbc:PaymentMeansCode>
        <cbc:PaymentID>' . $this->getTransaction($invoice_Details->id) . '</cbc:PaymentID>
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
        }
        $xml_data .= '
</Invoice>';

        $attachmentPaths = $this->getAttachmentpath();
        $attchmentMove = file_put_contents($attachmentPaths . "Invoice" . $invoiceId . '.xml', $xml_data);
        $downloadPaths  = $this->getDownloadpath();
        $downloadattachments = file_put_contents($downloadPaths . "Invoice" . $invoiceId . '.xml', $xml_data);
        if ($attchmentMove !== false && $downloadattachments !== false) {
            $results = $this->updateAttachments("Invoice" . $invoiceId . '.xml');
            if (!$results) {
                $command = 'SendEmail';
                $postData = array(
                    'messagename' => 'Invoice Payment Confirmation',
                    'id' => $invoice_Details->id,
                    'customvars' => base64_encode(serialize(array("is_attachment" => "true"))),
                );

                $results = localAPI($command, $postData);

                if ($results['result'] == "success") {

                    $this->remove_attachments_downloads("Invoice" . $invoiceId . '.xml');
                }
            }
        }
    }
    function getTransaction($invoiceId)
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
    function getitemlist($invoiceid)
    {
        $command = 'GetInvoice';
        $postData = array(
            'invoiceid' => $invoiceid,
        );
        $results = localAPI($command, $postData);
        return $results;
    }
    public function updateAttachments($attachments)
    {
        $template = 'Invoice Payment Confirmation';
        return Capsule::table("tblemailtemplates")->where('name', $template)->where('type', 'invoice')->update(array('attachments' => $attachments));
    }

    public function remove_attachments_downloads($pdfname)
    {


        $template = 'Invoice Payment Confirmation';
        Capsule::table("tblemailtemplates")->where('name', $template)->where('type', 'invoice')->update(array('attachments' => ''));

        global $downloads_dir;
        $basepath = realpath(__DIR__ . '/../../../..');

        $attachmentPath = [];


        $downloadPaths  = $this->getDownloadpath();

        $file = $downloadPaths . $pdfname;

        if (is_file($file)) {
            if (unlink($file)) {
                $attachmentPaths = $this->getAttachmentpath();
                $file = $attachmentPaths . $pdfname;
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
    }

    public function getAttachmentpath()
    {
        $basepath = realpath(__DIR__ . '/../../..');
        if (Capsule::Schema()->hasTable('tblfileassetsettings')) {
            $configtableAttachmentPath = Capsule::table("tblfileassetsettings")->join('tblstorageconfigurations', 'tblfileassetsettings.storageconfiguration_id', '=', 'tblstorageconfigurations.id')->select('tblstorageconfigurations.settings')->where('tblfileassetsettings.asset_type', 'email_attachments')->first();
            $attachmentPath = json_decode($configtableAttachmentPath->settings);
        }
        if (!empty($attachmentPath->local_path)) {
            $upOne = $attachmentPath->local_path . '/';
        } else {
            if (isset($attachments_dir)) {
                $upOne = $attachments_dir . '/';
            } else {
                $upOne = $basepath . "/attachments/";
            }
        }

        return $upOne;
    }
    public function getDownloadpath()
    {
        global $downloads_dir;
        $basepath = realpath(__DIR__ . '/../../..');
        if (Capsule::Schema()->hasTable('tblfileassetsettings')) {
            $configtableDownloadPath = Capsule::table("tblfileassetsettings")->join('tblstorageconfigurations', 'tblfileassetsettings.storageconfiguration_id', '=', 'tblstorageconfigurations.id')->select('tblstorageconfigurations.settings')->where('tblfileassetsettings.asset_type', 'downloads')->first();
            $downloadPath = json_decode($configtableDownloadPath->settings);
        }
        if (!empty($downloadPath->local_path)) {
            $copyformDir = $downloadPath->local_path . '/';
        } else {
            if (isset($downloads_dir)) {
                $copyformDir = $downloads_dir . '/';
            } else {
                $copyformDir = $basepath . "/downloads/";
            }
        }
        return $copyformDir;
    }
}
