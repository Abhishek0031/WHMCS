<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('AdminAreaFooterOutput', 1, function ($vars) {
    try {
        if ($vars['pagetitle'] === "Payment Gateways") {
        $html = "<style>
            .ChangeColor {
                color: rgb(89, 194, 122);
            }
        </style>
        <script type='text/javascript'>
            $(document).ready(function(){
                console.log('hiii');
                htmlContent = 'Many more payment gateways, while not included in <span class=\"ChangeColor\"> GreenClick </span> by default, have modules for <span class=\"ChangeColor\"> GreenClick </span>. You can find them in the<a href=\"https://marketplace.whmcs.com/?utm_source=inproduct&amp;utm_medium=configgateways\" target=\"_blank\"><span class=\"ChangeColor\"> GreenClick </span> Marketplace</a>';
                $('.text-center.text-muted small').html(htmlContent); 
            });
        </script>";
        }
        return $html;

    } catch (\Exception $e) {
        logActivity("Error GreenClick Text Hook" . $e->getMessage());
    }
});
