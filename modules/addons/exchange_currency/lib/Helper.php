<?php

namespace WHMCS\Module\Addon\exchange_currency;

use WHMCS\Database\Capsule;


use WHMCS\Domains;

class Helper
{
    public function getTableData($postData)
    {
        try {
            if ($postData['table'] == 'tblproducts') {
                $tableName = $postData['table'];
                $tableData = Capsule::table($tableName)
                    ->join('tblproductgroups', 'tblproducts.gid', '=', 'tblproductgroups.id')
                    ->select('tblproductgroups.name as product_group_name', 'tblproducts.name as product_name', 'tblproducts.id')
                    ->get();

                echo json_encode($tableData);
                exit;
            } elseif ($postData['table'] == 'tbladdons') {
                $tableName = $postData['table'];
                $tableData = Capsule::table($tableName)->get();
                echo json_encode($tableData);
                exit;
            } elseif ($postData['table'] == 'tbldomainpricing') {
                $tableName = $postData['table'];
                $tableData = Capsule::table($tableName)->get();
                echo json_encode($tableData);
                exit;
            }
        } catch (\Exception $e) {
            logActivity('Error occurred in getTableData: ' . $e->getMessage());
        }
    }

    public function GetAllCurrency()
    {
        try {
            $currency = Capsule::table('tblcurrencies')->get();
            echo json_encode($currency);
            exit;
        } catch (\Exception $e) {
            logActivity('Error occurred in GetAllCurrency: ' . $e->getMessage());
        }
    }

    public function viewSelectedValue($array)
    {
        try {
            if ($array['tablename']  === 'tblproducts') {
                if ($array['addonids'] == []) {
                    return ['status' => 'fail', 'nameHeading' => 'Product Names'];
                }
                $addoncurrid = $array['addoncurrid'];
                $addoncurrid_name = Capsule::table('tblcurrencies')->where('id', $addoncurrid)->value('code');
                $addonids = $array['addonids'];
                $product_groups = Capsule::table('tblproducts')
                    ->whereIn('tblproducts.id', $addonids)
                    ->join('tblproductgroups', 'tblproducts.gid', '=', 'tblproductgroups.id')
                    ->select('tblproducts.name as product_name', 'tblproductgroups.name as product_group_name')
                    ->get();

                $product_names = [];
                foreach ($product_groups as $product_group) {
                    $product_names[] = $product_group->product_group_name  . '-' . $product_group->product_name;
                }

                $newArrayStep3['currency'] = $addoncurrid_name;
                $newArrayStep3['names'] = $product_names;
                $newArrayStep3['status'] = $array['addonstatus'];
                $newArrayStep3['nameHeading'] = 'Product Names';
            } elseif ($array['tablename']  === 'tbladdons') {
                if ($array['addonids'] == []) {
                    return ['status' => 'fail', 'nameHeading' => 'Addon Names'];
                }
                $addoncurrid = $array['addoncurrid'];
                $addoncurrid_name = Capsule::table('tblcurrencies')->where('id', $addoncurrid)->value('code');
                $addonids = $array['addonids'];
                $productAddons = Capsule::table('tbladdons')
                    ->whereIn('tbladdons.id', $addonids)
                    ->select('tbladdons.name as addonName')
                    ->get();
                $addonNames = [];
                foreach ($productAddons as $productAddon) {
                    $addonNames[] = $productAddon->addonName;
                }
                $newArrayStep3['currency'] = $addoncurrid_name;
                $newArrayStep3['names'] = $addonNames;
                $newArrayStep3['status'] = $array['addonstatus'];
                $newArrayStep3['nameHeading'] = 'Addon Names';
                $newArrayStep3['status'] = $array['addonstatus'];
            } elseif ($array['tablename']  === 'tbldomainpricing') {
                if ($array['domaintlds'] == []) {
                    return ['status' => 'fail', 'nameHeading' => 'Domain TLDs'];
                }

                $addoncurrid = $array['domaincurrid'];
                $domainCurrency = Capsule::table('tblcurrencies')->where('id', $addoncurrid)->value('code');
                $newArrayStep3['currency'] = $domainCurrency;
                $newArrayStep3['names'] = $array['domaintlds'];
                $newArrayStep3['status'] = $array['domainstatus'];
                $newArrayStep3['domainaddons'] = $array['domainaddons'];
                $newArrayStep3['regperiod'] = $array['regperiod'];
                $newArrayStep3['nameHeading'] = 'Domain TLDs';
            }
            return $newArrayStep3;
        } catch (\Exception $e) {
            logActivity('Error occurred in viewSelectedValue: ' . $e->getMessage());
        }
    }

    private function getCurrencyArray($currency)
    {
        $clientCurrency = Capsule::table('tblclients')
            ->where('currency', $currency)
            ->select('id')
            ->get();
        $clientArray = [];
        foreach ($clientCurrency as $item) {
            $clientArray[] = $item->id;
        }
        return $clientArray;
    }
    public function updatePrice($postData)
    {
        try {

            if ($postData['tablename'] == 'tblproducts') {
                $addonids = $postData['addonids'];
                $addonstatus = $postData['addonstatus'];
                $currency = $postData['addoncurrid'];
                $currencyMatchClient = $this->getCurrencyArray($currency);

                $hostingValues = Capsule::table('tblhosting')
                    ->whereIn('packageid', $addonids)
                    ->whereIn('userid', $currencyMatchClient)
                    ->whereIn('domainstatus', $addonstatus)
                    ->get();

                foreach ($hostingValues as $hostingData) {
                    $id = $hostingData->id;
                    $userid = $hostingData->userid;
                    $billingcycle = $hostingData->billingcycle;
                    $configoptionsrecurring = 'empty';
                    $promoid = $hostingData->promoid;
                    $newamount = recalcRecurringProductPrice($id, $userid, $hostingData->packageid, $billingcycle, $configoptionsrecurring, $promoid);

                    if ($newamount) {
                        $data =  Capsule::table('tblhosting')->where('id', $hostingData->id)->update([
                            "amount" =>  $newamount
                        ]);
                    }
                }
            } elseif ($postData['tablename'] == 'tbladdons') {
                $addonids = $postData['addonids'];
                $addonstatus = $postData['addonstatus'];
                $currency = $postData['addoncurrid'];
                $currencyMatchClient = $this->getCurrencyArray($currency);
                $addonHostingData = Capsule::table('tblhostingaddons')->whereIn('addonid', $addonids)->whereIn('status', $addonstatus)->whereIn('userid', $currencyMatchClient)->get();

                foreach ($addonHostingData as $addonHostingDatas) {
                    $currencyId = Capsule::table("tblcurrencies")->where('default', 1)->value('id');
                    if ($currencyId) {
                        $amount = $this->recalcRecurringAddonProductPrices($addonHostingDatas->userid, $addonHostingDatas->addonid, $addonHostingDatas->billingcycle);
                        if ($amount>=0) {
                            Capsule::table('tblhostingaddons')->where('id', $addonHostingDatas->id)->update([
                                "recurring" => $amount
                            ]);
                        }
                    }
                }
            } elseif ($postData['tablename'] == 'tbldomainpricing') {
                $currency = $postData['domaincurrid'];
                $domains = $postData['domaintlds'];
                $currencyMatchClient = $this->getCurrencyArray($currency);
                $domainDetails = Capsule::table('tbldomains')
                    ->whereIn('userid', $currencyMatchClient)
                    ->where(function ($query) use ($domains) {
                        foreach ($domains as $domain) {
                            $query->orWhere('domain', 'LIKE', '%' . $domain . '%');
                        }
                    })
                    ->get();
                foreach ($domainDetails as $domain_data) {
                    $domainparts = explode(".", $domain_data->domain, 2);
                    $temppricelist = getTLDPriceList("." . $domainparts[1], "", true, $domain_data->userid);
                    $recuringAmount = $temppricelist[$domain_data->registrationperiod]['renew'];

                    if ($recuringAmount) {
                        $currency = getCurrency($domain_data->userid);
                        $addonsPricing = \WHMCS\Database\Capsule::table("tblpricing")->where("type", "domainaddons")->where("currency", $currency["id"])->where("relid", 0)->first(array("msetupfee", "qsetupfee", "ssetupfee"));
                        $domaindnsmanagementprice = $addonsPricing->msetupfee * $domain_data->registrationperiod;
                        $domainemailforwardingprice = $addonsPricing->qsetupfee * $domain_data->registrationperiod;
                        $domainidprotectionprice = $addonsPricing->ssetupfee * $domain_data->registrationperiod;
                        if ($domain_data->dnsmanagement) {
                            $recuringAmount += $domaindnsmanagementprice;
                        }
                        if ($domain_data->emailforwarding) {
                            $recuringAmount += $domainemailforwardingprice;
                        }
                        if ($domain_data->idprotection) {
                            $recuringAmount += $domainidprotectionprice;
                        }
                        if ($recuringAmount) {
                            Capsule::table('tbldomains')->where('id', $domain_data->id)->update([
                                "recurringamount" => $recuringAmount
                            ]);
                        }
                    }
                }
            }
            return ['status' => 'success'];
        } catch (\Exception $e) {
            logActivity('Error occurred in updateCurrency: ' . $e->getMessage());
        }
    }


    public function recalcRecurringAddonProductPrices($userid = "", $addonid = "", $billingcycle = "", $configoptionsrecurring = "empty", $promoid = 0, $includesetup = false)
    {

        global $currency;
        $currency = getCurrency($userid);
        $result = select_query("tblpricing", "", array("type" => "addon", "currency" => $currency["id"], "relid" => $addonid));
        $data = mysql_fetch_array($result);
        if ($billingcycle == "Monthly") {
            $amount = $data["monthly"];
        } else {
            if ($billingcycle == "Quarterly") {
                $amount = $data["quarterly"];
            } else {
                if ($billingcycle == "Semi-Annually") {
                    $amount = $data["semiannually"];
                } else {
                    if ($billingcycle == "Annually") {
                        $amount = $data["annually"];
                    } else {
                        if ($billingcycle == "Biennially") {
                            $amount = $data["biennially"];
                        } else {
                            if ($billingcycle == "Triennially") {
                                $amount = $data["triennially"];
                            } else {
                                $amount = 0;
                            }
                        }
                    }
                }
            }
        }
        if ($amount <= 0) {
            $amount = 0;
        }
        if ($includesetup === true) {
            $setupvar = substr(strtolower($billingcycle), 0, 1);
            if (0 < $data[$setupvar . "setupfee"]) {
                $amount += $data[$setupvar . "setupfee"];
            }
        }
        if ($configoptionsrecurring == "empty") {
            if (!function_exists("getCartConfigOptions")) {
                require ROOTDIR . "/includes/configoptionsfunctions.php";
            }
            $configoptions = getCartConfigOptions($pid, "", $billingcycle, $serviceid);
            foreach ($configoptions as $configoption) {
                $amount += $configoption["selectedrecurring"];
                if ($includesetup === true) {
                    $amount += $configoption["selectedsetup"];
                }
            }
        } else {
            $amount += $configoptionsrecurring;
        }
        return $amount;
    }
}
