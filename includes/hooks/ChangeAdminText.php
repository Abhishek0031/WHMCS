<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('AdminAreaFooterOutput', 1, function ($vars) {
    // echo '<pre>';
    // print_r($vars);
    // die;
    $changeText = '<span class=\"ChangeColor\"> <b>GreenClick </b></span>';
    try {
        $filename = basename($_SERVER['SCRIPT_NAME']);
        if ($vars['pagetitle'] === "Apps & Integrations" && $vars['filename'] === "index") {
            $htmlStyle = ".powered-by {
                display: inline;
                font-size: 18px;
            }";
            $htmlJquery = "
                var htmlText = '<div class=\"powered-by\">Powered by " . $changeText . " MARKETPLACE.</div>';
                $('.hidden-xs.hidden-sm').html(htmlText);
                $('#active .app-category-title p').html('The following apps are active in your " . $changeText . " installation.');
                ";
        } elseif ($vars['pagetitle'] === "System Settings") {
            $htmlStyle = "";
            $htmlJquery = "                
                var htmlText = 'Set up & configure your " . $changeText . " MarketPlace.';
                $('.lead').html(htmlText);";
        } elseif ($filename === "update.php") {
            $htmlJquery = "   
                $('#contentarea div h1').html('Update " . $changeText . " Platform'); 
            ";
        }
        $html = "<style>
            #wizardStep0 .wizard-transition-step .title {
                font-size: 40px;
            }
            .ChangeColor {
                color: rgb(89, 194, 122);
            }" . $htmlStyle . "
            </style>
            <script type='text/javascript'>
            $(document).ready(function(){
                $('#Menu-Addons-Marketplace-Link').html('Visit " . $changeText . " Marketplace');
                $('#Menu-Utilities-Update').html('Update " . $changeText . "');
                $('#Menu-Utilities-WHMCS_Connect').html('" . $changeText . " Connect');
                    $('#Menu-Config-SetupWizard').click(function() {
                        var myInterval = setInterval(function() {
                            var textdata = $('#wizardStep0 .wizard-transition-step .title').text();
                            if (textdata !== 'Welcome to  GreenClick! ') {
                                // console.log(textdata.replace(/ /g, '_'));
                                var text = 'Welcome to <span class=\"ChangeColor\"><b> GreenClick! </b></span>';
                                $('#wizardStep0 .wizard-transition-step .title').html(text); 
                            } else {
                                clearInterval(myInterval);
                            }
                        }, 100);
                    });
                " . $htmlJquery . "
            });
            </script>";
        return $html;
    } catch (\Exception $e) {
        logActivity("Error GreenClick Text Hook" . $e->getMessage());
    }
});
