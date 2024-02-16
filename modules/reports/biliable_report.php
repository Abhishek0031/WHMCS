<?php

use WHMCS\Carbon;
use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

$reportdata['title'] = "Billable Report";
$reportdata['description'] = "This report module shows the total of all customers that have billable items";
$reportdata["currencyselections"] = true;

global $whmcs;
global $customadminpath;
$systemURL = $CONFIG['SystemURL'];
$path = $systemURL . '/' . $customadminpath;

if(isset($_POST['ajaxcheck'])){
    $group = Capsule::table('tblclientgroups')
    ->select('id', 'groupname')
    ->get();
    echo(json_encode($group));
    exit();
}

if (isset($_REQUEST['FindClient'])) {
    $BettweenQuery = [];
    $QueryArray = [];
    $dueDate = App::getFromRequest('dueDate');
    $paidD = App::getFromRequest('paidD');
    $userid = (int)$whmcs->get_req_var('userid');
    $groupId = (int)$whmcs->get_req_var('groupclient');
    $status = $whmcs->get_req_var('status');
    if($userid != '' && $userid != 0) {
        $QueryArray += ['tblinvoices.userid' => $userid];
    }
    if ($status != '') {
        $QueryArray += ['tblinvoices.status' => $status];
    }
    if ($groupId != '' && $groupId != 0) {
        $QueryArray += ['tblclients.groupid' => $groupId];
    }

    if ($dueDate) {
        $dateRange = Carbon::parseDateRangeValue($dueDate);
        $dateFrom = $dateRange['from']->toDateTimeString();
        $dateTo = $dateRange['to']->toDateTimeString();
        $BettweenQuery[] = ['tblinvoices.duedate', [$dateFrom, $dateTo]];
    } else if ($paidD) {
        $dateRangePaid = Carbon::parseDateRangeValue($paidD); // Fixed variable name
        $dateFromPaid = $dateRangePaid['from']->toDateTimeString();
        $dateToPaid = $dateRangePaid['to']->toDateTimeString();
        $BettweenQuery[] = ['tblinvoices.datepaid', [$dateFromPaid, $dateToPaid]];
    }

    $results = Capsule::table('tblinvoices')
        ->join('tblclients', 'tblinvoices.userid', '=', 'tblclients.id')
        ->select(
            'tblclients.firstname',
            'tblclients.lastname',
            'tblclients.companyname',
            'tblinvoices.userid',
            'tblinvoices.duedate',
            'tblinvoices.id',
            'tblinvoices.datepaid',
            'tblinvoices.date',
            'tblinvoices.total',
            'tblinvoices.paymentmethod'
        )
        ->where('tblclients.currency', '=', (int) $currencyid)
        ->where($QueryArray);
    if(count($BettweenQuery) != 0){
        foreach ($BettweenQuery as $element) {
            $results->whereBetween($element[0], $element[1]);
        }
    }
    $results = $results->get();
    if($_GET['test'] == '1'){
        echo "<pre>";
        print_r($results);
        die;
    }
    $reportdata['tableheadings'] = array(
        '<a href="/shop/admin/clientsinvoices.php?userid=23&amp;orderby=id">Invoice #</a>',
        "Client Name",
        "Invoice Date",
        "Due Date",
        'Date Paid',
        "Total",
        'Payment Method',
        "Company Name",
    );
}
foreach ($results as $result) {

    static  $count = 0;
    $invoiceId = $result->id;
    $userid = $result->userid;
    $firstname = $result->firstname;
    $lastname = $result->lastname;
    $date = $result->date;
    $duedate = $result->duedate;
    $datepaid = $result->datepaid;
    $companyname = $result->companyname;
    $total =  $result->total;
    $paymentmethod =  $result->paymentmethod;

    $reportvalues[$count] = [
        $userid,
        $invoiceId,
        $firstname,
        $lastname,
        $date,
        $duedate,
        $datepaid,
        $companyname,
        $total,
        $paymentmethod
    ];
    $count++;
}
foreach ($reportvalues as $items) {
    for ($i = 0; $i < count($items); $i++) {
        if ($items[$i] == '') {
            $items[$i] = '--';
        }
    }
        $userid = $items[0];
        $invoiceId = $items[1];
        $firstname = $items[2];
        $lastname = $items[3];
        $date = $items[4];
        $duedate = $items[5];
        $datepaid = $items[6];
        $companyname = $items[7];
        $total = $items[8];
        $paymentmethod = $items[9];

    $reportdata['tablevalues'][] = array(
        '<a href="invoices.php?action=edit&amp;id='.$invoiceId.'">'.$invoiceId.'</a>',
        '<a href="'.$path.'/clientssummary.php?userid='.$userid.'">'. $firstname . ' ' . $lastname.'</a>',
        $date,
        $duedate,
        $datepaid,
        formatCurrency($total),
        $paymentmethod,
        $companyname,
    );
    $TotalAmount += $total;
}
if (isset($_REQUEST['FindClient'])) {
$reportdata['footertext'] = '<p align="center"><strong>Balance: ' . formatCurrency($TotalAmount) . '</strong></p>';
}
$selectedVerified = ($whmcs->get_req_var('status') == "Paid") ? 'selected' : '';
$selectedVerifieds = ($whmcs->get_req_var('status') == "Unpaid") ? 'selected' : '';

$reportdata["headertext"] = <<<HTML
<div class="box" id="tab_content" style="border:1px solid #ddd; padding:20px; border-radius:10px;">
    <div class="container">
        <div class="row">
            <form method="post" class="form">
                <div class="col-sm-4 col-md-4 col-lg-6">
                <div class="form-group fieldarea">
                    <label for="client">Client</label>
                    <select id="selectUserid" name="userid" class="form-control selectize selectize-client-search selectized" data-value-field="id" data-active-label="Active" data-inactive-label="Inactive" placeholder="Start Typing to Search Clients" tabindex="-1" style="display: none;">
                    <option value="" selected="selected"></option></select>
                    </div>
                    <div class="form-group fieldlabel">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                        <option value="">Any</option>
                            <option value="Paid" $selectedVerified>Paid</option>
                            <option value="Unpaid" selectedVerifieds>Unpaid</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="groupclient">Client Group</label>
                    <select  class="form-control" id='groupDropDown' name="groupclient">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dueDate">Due Date</label>
                        <div class="form-group date-picker-prepend-icon">
                            <label for="dueDate" class="field-icon">
                                <i class="fal fa-calendar-alt"></i>
                            </label>
                            <input id="dueDate" type="text" name="dueDate" value="{$dueDate}" class="form-control date-picker-search date-picker-search-100pc" placeholder="{$langRequired}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="paidD">Date Paid</label>
                        <div class="form-group date-picker-prepend-icon">
                            <label for="paidD" class="field-icon">
                                <i class="fal fa-calendar-alt"></i>
                            </label>
                            <input id="paidD" type="text" name="paidD" value="{$paidD}" class="form-control date-picker-search date-picker-search-100pc" placeholder="{$langRequired}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-container">
                <button name="FindClient" class="btn btn-default">Search/Filter</button>
            </div>
        </form>
    </div>
</div>
<li id="li-with-id">List item with an ID.</li>
<script>
    $(document).ready(function(){
        $('#li-with-id').on('click',function(){
            $("#li-with-id").replaceWith("<p id = 'li-with-id'>Socks</p>");
        });
            $.ajax({
                url: '',
                method: 'post',
                data: {'ajaxcheck':'true'},
                dataType: 'json',
                success: function(response) {
                    var bodyHtml = "<option value=''>Any</option>";
                    for (x in response) {
                        bodyHtml += "<option value='" + response[x]["id"] + "'>" + response[x]["groupname"] + "</option>";
                    }
                    $('#groupDropDown').html(bodyHtml);
                }
            });
        });
</script>
HTML;