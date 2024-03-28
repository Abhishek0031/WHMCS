$(document).ready(function(){
    $('.slide-toggle').bootstrapSwitch();
    $('#inputHidden').on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            console.log('Switch is ON');
            // Your code for when switch is ON
        } else {
            console.log('Switch is OFF');
            // Your code for when switch is OFF
        }
    });
    $(document).on('click', '#Create-Group-link', function() {
        console.log('group');
        $.ajax({
            url: '../modules/addons/agency_dashboard_pro/lib/ajaxFunction.php',
            method: 'POST',
            data: {'AjaxCheck': 'createGroup'},
            beforeSend: function(){
                $('#productFormLoader').show(); 
                $('#Servercontentarea').hide();
              },
            success: function(data) {
             $('#createProductForm').html(data);
            },
            complete: function(){
                $('#productFormLoader').hide();
                $('#Servercontentarea').show();
            }
        });
    });

    $(document).on('click', '#Create-Product-link', function() {
        console.log('group');
        $.ajax({
            url: '../modules/addons/agency_dashboard_pro/lib/ajaxFunction.php',
            method: 'POST',
            data: {'AjaxCheck': 'createProduct'},
            beforeSend: function(){
                $('#productFormLoader').show();
                $('#Servercontentarea').hide();
              },
            success: function(data) {
             $('#createProductForm').html(data);
             moduleName = $(".active").attr("data-module-name").trim();
             console.log(moduleName);
             $('#inputProductModule').val(moduleName);
            },
            complete: function(){
                $('#productFormLoader').hide();
                $('#Servercontentarea').show();
            }
        });
    });
    $(document).on('keyup', '#inputGroupName', function() {
        $('#slugLoader').removeClass('hidden').show();
        $('#slugOk').addClass('hidden').show();
        $('#slugInvalidError').addClass('hidden').show();
        groupName = $('#inputGroupName').val();
            $.ajax({
                url: '../modules/addons/agency_dashboard_pro/lib/ajaxFunction.php',
                method: 'POST',
                data: {'AjaxCheck': 'slugCheck', 'fieldValue': groupName},
                dataType: 'json',
                success: function(data) {
                $('#slugLoader').hide();
                if (data.slugString) {
                    $('#inputSlug').val(data.slugString);
                    adjustSlugInputSize();
                }
                if (data.status == 'Invalid') {
                    $('#slugOk').addClass('hidden').show();
                    $('#slugInvalidError').text(data.invalidReason).removeClass('hidden').show();
                } else {
                    $('#slugOk').removeClass('hidden').show();
                    $('#slugInvalidError').hide();
                    $('#btnSaveProductGroup').removeProp('disabled');
                    $('#btnCopyToClipboard').removeProp('disabled');
                }
                validateSlugChange();
                }
            });
            });
          
    $(document).on('click', '#install_mod', function() {
        var link = $(this).attr('downloadlink');
       var moddata = $('#moduleData').val();
        // e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You want to install this module",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(resp) {
            if (resp) {
                objectData = {"AjaxCheck" : 'installModule','downloadlink' : link,'moddata': moddata};
                $.ajax({
                    url: '../modules/addons/agency_dashboard_pro/lib/ajaxFunction.php',
                    method: 'POST',
                    data: objectData,
                    dataType: 'json',
                    beforeSend: function(){
                      
                    },
                    success: function(response) {
                      
                        if(response['status'] == 'success'){
                            swal({
                                title: "Success",
                                text: "Installed Successfully!!",
                                type: "success",
                                confirmButtonColor: '#5cb85c',
                                confirmButtonText: 'OK',
                            }, function(confirm) {
                                if (confirm) {
                                location.reload();
                                }
                            })
                        } else{
                            swal("Fail", "You  Already Have Installed this Module", "error");
                            location.reload(3000);
                        }
                    },
                    complete: function(){
                    }
                });
            }
        });
    });

        
    $('.module-nav-item').click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var type = $(this).attr('data-type');
        var moduleName = $(this).attr('data-module-name');
        localStorage.setItem("loadModule", moduleName);
        var targetElement = "li.module-nav-item#" + id;    
        $(targetElement).addClass('active').siblings('li.module-nav-item').removeClass('active');
        objectData = {"AjaxCheck" : 'checkProductInstallation', "id": id,"moduletype":type,"moduleName": moduleName};
        checkProductinstall(objectData);
    });


 //click sidebar    


    var chLoadModule = localStorage.getItem("loadModule");
    if(chLoadModule === null || chLoadModule === undefined){
        $("ul.promenu li:first-child").click();
    } else{
    $('ul.promenu li[data-module-name="'+chLoadModule+'"]').click();
    localStorage.clear();
    }

    // Function triggered when the submit button is clicked
    $('#licenceKeyMSg').hide();
    $('#licsubmit').click(function(){
        
        
        var check=$('#licenceKey').val();
        console.log(check)
        if(check === '') 
        {
            $('#licenceKeyMSg').show();
            return false;
        }
        $('#licenceKeyMSg').html('');
        var licenceKeyVal = $('#licenceKey').val();
        dataObject = {"AjaxCheck" : 'licenceKeyCheck', "licenceKeyValue": licenceKeyVal};
        $(this).val('Loading....');        
        $.ajax({
            url: '../modules/addons/agency_dashboard_pro/lib/ajaxFunction.php',
            method: 'POST',
            data: dataObject,
            dataType: 'json',
            success: function(response) {
                $('#licsubmit').val('Check License');        
           
                if(response['status'] != 'Active'){
                    swal("Fail", "Your Licence Key is "+ response['status'] + "!", "error");
                    return false;
                }

                new_url = location.href + "&action=productlist" ; 
                console.log(new_url);
                window.location.href = new_url;
                return false; 
            }
        });
    })
    

});


function checkProductinstall(objectData){
    $.ajax({
        url: '../modules/addons/agency_dashboard_pro/lib/ajaxFunction.php',
        method: 'POST',
        data: objectData,
        // dataType: 'json',
        beforeSend: function(){
            $('.LoadWrapper').show(); // Hide the proloader   
            $('#sideBarContainer').hide(); 
            $('#installModuleContainer').hide(); // Hide the proloader        
            // Hide the proloader        

          },
        success: function(response) {
            // $('.module-nav-item').addClass("changeBody");
            // htmlText = response.name + ":" +  response.description
            // $('.module-heading-bx p').html(htmlText);
        // console.log(response);
        $('.appendProduct').html(response);
        },
        complete: function(){
            $('.LoadWrapper').hide(); // Hide the proloader
            $('#sideBarContainer').show();
            $('#installModuleContainer').show();

        }
    });
}


// validate the slug
    function validateSlugChange() {
        var validateSlugChange = false,
            currentSlug = '',
            inputSlug = $('#inputSlug').val();
    
        if (currentSlug) {
            validateSlugChange = true;
        }
    
        if (validateSlugChange && inputSlug !== currentSlug) {
            $('#slug-change-warning').show();
            $('#slug-change-tooltip').tooltip('show');
        } else if (validateSlugChange && inputSlug === currentSlug) {
            $('#slug-change-warning').hide();
            $('#slug-change-tooltip').tooltip('hide');
        }
    }
// adjust the size of Slug
    function adjustSlugInputSize() {
        var inputSlug = $('#inputSlug');
        $(inputSlug).css('width', (($(inputSlug).val().length * 7) + 20) + 'px');
    }

