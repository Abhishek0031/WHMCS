<?php

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('AdminAreaFooterOutput', 1, function($vars) {
    try {
        global $whmcs;
        if ($vars['filename'] == "addonmodules" && $vars['pagetitle'] == "Project Management") {
            // echo 'pre';
            // die;
            // return $html;
        } elseif ($vars['filename'] == "clientsnotes") {
            $html = "<script type=\"text/javascript\">
            $(document).ready(function(){
            var targetForm = $(\"form[method='post'][action='/whmcs/admin/clientsnotes.php?userid=65&sub=add'][data-no-clear='false']\");
            targetForm.addClass('myCustumClass');
            targetForm.attr('id','myCustumClass');

                $('#adminSubmit').click(function(){
                    $('#myCustumClass').submit();

                })
            });
            </script>";
            return $html;
            // echo 'clientsnotes';
            // die;
        }
    } catch (\Exception $e) {
        logActivity("Error Support Hook" . $e->getMessage());
    }
});