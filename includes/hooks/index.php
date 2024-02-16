<?php
if ( !defined('WHMCS')) {
    header("Location: ../../index.php");
}




if ($autorecalc) {
        $domainparts = explode(".", $domain, 2);
        if ($domain_data["is_premium"]) {
            $recurringamount = (double) WHMCS\Domain\Extra::whereDomainId($domain_data["id"])->whereName("registrarRenewalCostPrice")->value("value");
            $recurringamount = convertCurrency($recurringamount["price"], $recurringamount["currency"], $currency["id"]);
            $hookReturns = run_hook("PremiumPriceRecalculationOverride", array("domainName" => $domain, "tld" => $domainparts[1], "sld" => $domainparts[0], "renew" => $recurringamount));
            $skipMarkup = false;
            foreach ($hookReturns as $hookReturn) {
                if (array_key_exists("renew", $hookReturn)) {
                    $recurringamount = $hookReturn["renew"];
                }
                if (array_key_exists("skipMarkup", $hookReturn) && $hookReturn["skipMarkup"] === true) {
                    $skipMarkup = true;
                }
            }
            if (!$skipMarkup) {
                $recurringamount *= 1 + WHMCS\Domains\Pricing\Premium::markupForCost($recurringamount) / 100;
            }
        } else {
            $temppricelist = getTLDPriceList("." . $domainparts[1], "", true, $userid);
            $recurringamount = $temppricelist[$regperiod]["renew"];
        }
        if ($dnsmanagement) {
            $recurringamount += $domaindnsmanagementprice;
        }
        if ($emailforwarding) {
            $recurringamount += $domainemailforwardingprice;
        }
        if ($idProtectionInRequest && $idprotection || !$idProtectionInRequest && $oldidprotection) {
            $recurringamount += $domainidprotectionprice;
        }
        if ($promoid) {
            $recurringamount -= recalcPromoAmount("D." . $domainparts[1], $userid, $id, $regperiod . "Years", $recurringamount, $promoid);
        }
    }