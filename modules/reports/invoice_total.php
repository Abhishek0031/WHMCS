<?php

use WHMCS\Carbon;
use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

$reportdata['title'] = "Annual Billable  Report for<u> " . $currentyear . "</u>";
$reportdata['description'] = "This report module shows the total of all customers that have billable items";
$reportdata['yearspagination'] = true;
$reportdata["currencyselections"] = true;

global $customadminpath;
$systemURL = $CONFIG['SystemURL'];
$path = $systemURL . '/' . $customadminpath;

$reportdata['tableheadings'] = array(
    'Id',
    "Client Name",
    "Description",
    'Hours',
    "Amount",
    'Invoice Action',
);

if (isset($_REQUEST['FindClient'])) {
    $userid = $_REQUEST['userid'];
    $description = $_REQUEST['description'];
    $status = $_REQUEST['status'];
    $amount = $_REQUEST['amount'];
    $QueryArray = [];
    if($_REQUEST['userid'] != '') {
        $QueryArray += ['tblbillableitems.userid' => $userid];
       }
   if($_REQUEST['description'] != '') {
    $QueryArray += ['tblbillableitems.description' => $description];
   }
   if($_REQUEST['status'] != '') {
    $QueryArray += ['tblbillableitems.invoiceaction' => $status];
   }
   if($_REQUEST['amount'] != '') {
    $QueryArray += ['tblbillableitems.amount' => $amount];
   }
        $results = Capsule::table('tblbillableitems')
            ->join('tblclients', 'tblbillableitems.userid', '=', 'tblclients.id')
            ->select(
            Capsule::raw("date_format(duedate,'%Y') as year"),
            'tblclients.firstname',
            'tblbillableitems.userid',
            'tblclients.lastname',
            'tblbillableitems.description',
            'tblbillableitems.id',
            'tblbillableitems.hours',
            'tblbillableitems.amount',
            'tblbillableitems.invoiceaction'
        )   
    ->orderBy('duedate', 'asc')
    ->where('tblclients.currency', '=', (int) $currencyid)
    ->where($QueryArray)
    ->get();
} else{
$reportvalues = array();
$results = Capsule::table('tblbillableitems')
    ->join('tblclients', 'tblbillableitems.userid', '=', 'tblclients.id')
    ->select(
        Capsule::raw("date_format(duedate,'%Y') as year"),
        Capsule::raw("date_format(duedate,'%m') as month"),
        'tblclients.firstname',
        'tblbillableitems.userid',
        'tblclients.lastname',
        'tblbillableitems.description',
        'tblbillableitems.id',
        'tblbillableitems.hours',
        'tblbillableitems.amount',
        'tblbillableitems.invoiceaction'
    )   
    ->orderBy('duedate', 'asc')
    ->where('tblclients.currency', '=', (int) $currencyid)
    ->get();
}

foreach ($results as $result) {
    if($result->invoiceaction === 0){
        $actionText = "Don't Invoice";
    } elseif($result->invoiceaction === 1){
        $actionText = " Next Cron Run";

    } elseif($result->invoiceaction === 2){
        $actionText = "User's Next Invoice";

    } elseif($result->invoiceaction === 3){
        $actionText = "Invoice for Due Date";

    } elseif($result->invoiceaction === 4){
        $actionText = "Recurring Cycle";
    }
    $month = (int) $result->month;
    $year = (int) $result->year;
    $firstname = $result->firstname;
    $lastname = $result->lastname;
    $description = $result->description;
    $amount = $result->amount;
    $id = $result->id;
    $hours = $result->hours;
    $invoiceaction = $actionText;
    $userid = $result->userid;
    
    if($year != $checkYear){
        $count = 0;   
    }
    $reportvalues[$year][$count] = [
        $id,
        $firstname,
        $lastname,
        $description,
        $amount,
        $hours,
        $invoiceaction,
        $userid,
    ];
    $checkYear = $year;
    $count++;
}

foreach ($reportvalues[$currentyear] as  $item) {
    static $k = 0;
    $id = $reportvalues[$currentyear][$k][0];
    $firstname = $reportvalues[$currentyear][$k][1];
    $lastname = $reportvalues[$currentyear][$k][2];
    $description = $reportvalues[$currentyear][$k][3];
    $amount = $reportvalues[$currentyear][$k][4];
    $hours = $reportvalues[$currentyear][$k][5];
    $invoiceaction = $reportvalues[$currentyear][$k][6];
    $userid = $reportvalues[$currentyear][$k][7];


    $reportdata['tablevalues'][] = array(
        '<a href="billableitems.php?action=manage&id='.$id.'">'.$id.'</a>',
        '<a href="'.$path.'/clientssummary.php?userid='.$userid.'">'. $firstname . ' ' . $lastname.'</a>',
        $description,
        $hours,
        formatCurrency($amount),
        $invoiceaction,
    );
$k++;
$TotalAmount += $amount;
}

$reportdata['footertext'] = '<p align="center"><strong>Balance: ' . formatCurrency($TotalAmount) . '</strong></p>';

$reportdata["headertext"] = <<<HTML
        <script type="text/javascript">
            $(document).ready(function(){
                $("#tab0").click(function(){
                    $("#tab_content").slideToggle();
                });
                $("#contentarea").find("table").eq(3).attr("id", "table");
            });
        </script>

<div id="tabs">
    <ul class="nav nav-tabs admin-tabs" role="tablist">
        <li class="tab tabselected" id="tab0"><a href="javascript:;">Search/Filter</a></li>
    </ul>
</div>
<div id="tab_content" style="display:none;">
    <div class="tab-content admin-tabs">
        <div class="tab-pane active" id="tab1">
            <form action="" method="post">
                <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="15%" class="fieldlabel">Client</td>
                            <td class="fieldarea">
                                <div class="form-group">
                                    {$aInt->clientsDropDown($userid)}
                                </div>
                            </td> 
                            <td width="15%" class="fieldlabel">Amount</td>
                            <td class="fieldarea">
                                <input type="text" name="amount" class="form-control input-100" value="">
                            </td>
                        </tr>
                        <tr>
                            <td class="fieldlabel">Description</td>
                            <td class="fieldarea">
                                <input type="text" name="description" class="form-control input-300" value="">
                            </td>
                            <td class="fieldlabel">Status</td>
                            <td class="fieldarea">
                                <select name="status" class="form-control select-inline">
                                    <option value="">Any</option>
                                    <option>Uninvoiced</option>
                                    <option>Invoiced</option>
                                    <option>Recurring</option>
                                    <option>Active Recurring</option>
                                    <option>Completed Recurring</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-container">
                    <input type="submit" value="Search/Filter" name="FindClient" class="btn btn-default">
                </div>
            </form>
        </div>
    </div>
</div>
HTML;