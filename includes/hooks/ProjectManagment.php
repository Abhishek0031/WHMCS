<?php

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('AdminAreaFooterOutput', 1, function($vars) {
    try {
        global $whmcs;
        if ($vars['filename'] == "addonmodules" && $vars['pagetitle'] == "Project Management") {
            $results = Capsule::table('tbladmins')
                ->select('id', 'firstname', 'lastname','email')
                ->get();

            foreach ($results as $result) {
                $options .= '<option value="' . $result->id . '">' . $result->firstname . ' ' . $result->lastname . '</option>';
            }
            if(!empty($whmcs->get_req_var('note'))){
                $id = (int)$whmcs->get_req_var('select');
                $mergeArray = [
                    'message' => $whmcs->get_req_var('note')
                ];
            $result = sendAdminMessage("Admin User Message", $mergeArray, "", 0, [$id]);
            if($result == '1')
            {
                logActivity('Email Send Successfully!');
            }
            print_r($result);
            exit();
            }
            $html = "
                <style>
                #dropdownBtn {
                    margin-bottom: 4px;
                }
                .modal-title{
                    color:#ccc;
                }
                .modal-header{
                    background-color: #1a4d80;
                }
                .close{
                    color:#ffffff;
                    text-shadow: 0 1px 0 #ffffff;
                }
                </style>
                <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js\"></script>
                <link href=\"https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css\" rel=\"stylesheet\"> 
                <div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\" role=\"document\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                            <h5 class=\"modal-title\" id=\"exampleModalLabel\">Assign Product Message To Admin User</h5>
                            </div>
                            <div class=\"modal-body\">
                                <form action=\"\" method=\"post\" id=\"myForm\">
                                    <select class=\"form-control\" name=\"adminValue\" id=\"selectData\">
                                        " . $options . "
                                    </select> 
                                </div>
                                <div class=\"modal-footer\">
                                    <button id=\"adminSubmit\" type=\"submit\" class=\"btn btn-primary\">
                                    <span id=\"send\">
                                    <i class=\"far fa-envelope\"></i>
                                    Send Email
                                    </span>
                                    <span id=\"Loading\" style='display:none';>
                                    <i class=\"fas fa-spinner fa-spin\"></i> Loading...
                                    </span>
                                    </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script type=\"text/javascript\">
                    $(document).ready(function(){
                        var btn = '<button type=\"button\" class=\"btn btn-primary\" id=\"dropdownBtn\" data-toggle=\"modal\" data-target=\"#exampleModal\">Email To Admin</button>';
                        $(\".col-sm-4.text-right.padding-top-10\").prepend(btn);
                        $(\"#adminSubmit\").click(function(e){
                            e.preventDefault();
                            $('#adminSubmit').prop(\"disabled\", true);
                            $('#send').hide();
                            $('#Loading').show();
                            noteData = $(\"#inputAddMessage\").val();
                            selectData = $(\"#selectData\").val();
                            console.log(noteData);
                            console.log(selectData);
                            obj = {
                                select:selectData,
                                   note:noteData,
                            }
                            $.ajax({
                                url: '',
                                type: \"POST\",
                                data: {
                                        \"select\": selectData, 
                                        \"note\":noteData,
                                      },
                                success: function(response) {
                                    console.log(response);
                                    if(response != '1'){
                                        Swal.fire({   
                                            icon: \"error\",   
                                            title: \"Oops...\",   
                                            text: \"Something went wrong!\",   
                                            footer: '<a href=\"#\">Why do I have this issue?</a>'});
                                            $('#send').show();
                                            $('#Loading').hide();
                                            $('#adminSubmit').prop(\"disabled\", false);

                                    } else{
                                        $('.col-sm-4.text-right.padding-top-10').find('.btn.btn-primary').click();
                                        Swal.fire({   
                                            title: \"Success!\",   
                                            text: \"Message Send Successfully!\",   
                                            icon: \"success\"});
                                            $('#send').show();
                                            $('#Loading').hide();
                                            $('#adminSubmit').prop(\"disabled\", false);
                                    }
                                }     
                              });
                        });
                    });
                </script>";

            return $html;
        }
    } catch (\Exception $e) {
        logActivity("Error Support Hook" . $e->getMessage());
    }
});

