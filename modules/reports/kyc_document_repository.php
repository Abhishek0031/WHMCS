<?php

use WHMCS\Carbon;
use WHMCS\Database\Capsule;

if ( !defined( 'WHMCS' ) ) {
    die( 'This file cannot be accessed directly' );
}

$reportdata[ 'title' ] = 'KYC Document Repository.';
$reportdata[ 'description' ] = 'This report module shows the KYC Status of Client';
global $whmcs;
global $customadminpath;
$systemURL = $CONFIG['SystemURL'];
$path = $systemURL . '/' . $customadminpath;

$reportdata[ 'tableheadings' ] = array(
    'Client Id',
    'Client Name',
    'email',
    'Company Name',
    'Address1',
    'Address2',
    'KYC Status',
);

$results = Capsule::table('tblclients')
    ->select(
        'id',
        'firstname',
        'lastname',
        'companyname',
        'email',
        'address1',
        'address2'
    );

if ($whmcs->get_req_var('FindClient') == 'Search/Filter') {
    $betweenQuery = [];
    $Rdate = App::getFromRequest('Rdate');
    
    if ($Rdate) {
        $dateRange = Carbon::parseDateRangeValue($Rdate);
        $dateFrom = $dateRange['from']->toDateTimeString();
        $dateTo = $dateRange['to']->toDateTimeString();
        
        $betweenQuery[] = ['created_at', [$dateFrom, $dateTo]];
    }
    
    foreach ($betweenQuery as $element) {
        $results = $results->whereBetween($element[0], $element[1]);
    }
} 
$results = $results->get();

function getCustumFeildsValues( $Fieldtype, $type, $ClientId, $fieldName ) {
    $field = Capsule::table( 'tblcustomfields' )
    ->join( 'tblcustomfieldsvalues', 'tblcustomfieldsvalues.fieldid', '=', 'tblcustomfields.id' )
    ->where( 'tblcustomfields.fieldtype', $Fieldtype )
    ->where( 'tblcustomfields.fieldname', 'like', $fieldName )
    ->where( 'tblcustomfields.type', $type )
    ->where( 'tblcustomfieldsvalues.relid', $ClientId )
    ->value(
        'tblcustomfieldsvalues.value',
    );
    return $field;
}

$type = 'client';
$Fieldtype = 'tickbox';
$fieldName = '%kyc_verification%';

foreach ( $results as $result ) {
    static  $count = 0;
    $userid = $result->id;
    $firstname = $result->firstname;
    $lastname = $result->lastname;
    $companyname = $result->companyname;
    $email =  $result->email;
    $address1 =  $result->address1;
    $address2 =  $result->address2;
    $data = empty(getCustumFeildsValues( $Fieldtype, $type, $userid, $fieldName ) )?'Not verfied Kyc':'Verfied';
        $reportvalues[$count] = [
            $userid,
            $firstname,
            $lastname,
            $email,
            $companyname,
            $address1,
            $address2,
            $data
        ];
        $count++;
}

foreach ($reportvalues as $items) {
    $status = $whmcs->get_req_var('status');
    for ($i = 0; $i < count($items); $i++) {
        if ($items[$i] == '') {
            $items[$i] = '--';
        }
    }
    $userid = $items[0];
    $firstname = $items[1];
    $lastname = $items[2];
    $email = $items[3];
    $companyname = $items[4];
    $address1 = $items[5];
    $address2 = $items[6];
    $CheckStatus = $items[7];

    if (($status == 'Verfied' && $CheckStatus == 'Verfied') || ($status == 'Not verfied Kyc' && $CheckStatus == 'Not verfied Kyc')) {
        $reportdata['tablevalues'][] = array(
            '<a href="' . $path . '/clientssummary.php?userid=' . $userid . '">' . $userid . '</a>',
            '<a href="' . $path . '/clientssummary.php?userid=' . $userid . '">' . $firstname . ' ' . $lastname . '</a>',
            '<a href="mailto:' . $email . '">' . $email . '</a>',

            $companyname,
            $address1,
            $address2,
            $CheckStatus,
        );
    } else if ($status == '') {
        $reportdata['tablevalues'][] = array(
            '<a href="' . $path . '/clientssummary.php?userid=' . $userid . '">' . $userid . '</a>',
            '<a href="' . $path . '/clientssummary.php?userid=' . $userid . '">' . $firstname . ' ' . $lastname . '</a>',
            '<a href="mailto:' . $email . '">' . $email . '</a>',
            $companyname,
            $address1,
            $address2,
            $CheckStatus,
        );
    }
}

$selectedVerified = ($whmcs->get_req_var('status') == "Verfied") ? 'selected' : '';
$selectedVerifieds = ($whmcs->get_req_var('status') == "Not verfied Kyc") ? 'selected' : '';

$reportdata['headertext'] = <<<HTML
<div class='box' id='tab_content' style='border:1px solid #ddd; padding:20px; border-radius:10px;'>
    <div class='container'>
        <div class='row'>
            <form method='post' class='form'>
                <div class='col-sm-4 col-md-4 col-lg-6'>
                    <div class='form-group'>
                        <label for='groupclient'>KYC Status</label>
                        <select id='KYCstatus' name='status' class='form-control'>
                            <option value=''>Any</option>
                            <option value='Verfied' $selectedVerified>Verfied</option>
                            <option value='Not verfied Kyc' $selectedVerifieds>Not verfied KYC</option>
                        </select>
                    </div>
                </div>
                <div class='col-sm-4 col-md-4 col-lg-4'>
                    <div class='form-group'>
                        <label for='Rdate'>Register Date</label>
                        <div class='date-picker-prepend-icon'>
                            <label for='Rdate' class='field-icon'>
                                <i class='fal fa-calendar-alt'></i>
                            </label>
                            <input id='Rdate' type='text' name='Rdate' value='{$Rdate}' class='form-control date-picker-search date-picker-search-100pc' placeholder=''>
                        </div>
                    </div>
                </div>
            </div>
            <div class='btn-container'>
                <input id='FindClient' type='submit' name='FindClient' value='Search/Filter' class='btn btn-default'>
            </div>
            </form>
        </div>
    </div>
</div>
HTML;