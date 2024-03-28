$(document).ready(function(){
    //perform Update button in 3rd step
    $('#performUpdate').click(function(){
        swal("Are you sure you want to Update Currency?", {
            buttons: ["Cancel", "Yes"],
          })
          .then((confirm) => {
            // console.log(confirm)
            if (confirm) {
                serializedData = $("#frmUpdate").serialize()
                checkTable = $('#editCriteria').attr('checkTable');
                var dataArray = decodeURIComponent(serializedData).split('&').map(function(item) {
                    return item.split('=');
                });
                
                var serializedObject = {};
                $.each(dataArray, function(index, item) {
                    var key = decodeURIComponent(item[0]);
                    var value = decodeURIComponent(item[1]);
                    if (serializedObject[key]) {
                        if (Array.isArray(serializedObject[key])) {
                            serializedObject[key].push(value);
                        } else {
                            serializedObject[key] = [serializedObject[key], value];
                        }
                    } else {
                        serializedObject[key] = value;
                    }
                });
                $.extend(serializedObject, { "tablename" : checkTable ,"AjaxCheck" : 'performUpdate' });
                // console.log(serializedObject);
                $.ajax({
                    url: '../modules/addons/exchange_currency/lib/ajaxFunction.php',
                    method: 'POST',
                    data: serializedObject,
                    dataType: 'json',
                    success: function(response) {
                        // console.log('response');
                        // console.log(response['status']);
                        if(response['status'] == 'success')
                        {
                            swal("Currency Update Successfully!", {
                                icon: "success",
                              })
                              .then((checkbtn) => {
                                window.location.reload(true);
                                // console.log(checkbtn)
                              });
                        }
                       
                    }
                });

            } else {
                swal("Fail", "Fail to Update Currency!", "error");
            //   swal("Fail to Update Currency!");
            }
          });

    });

    //« Choose a Different Type Button in 2nd step
    $('#goBack').click(function(){
        $('.container').show(300,'swing');
        $('#criteria-addons').hide(300,'swing');
        $('#showFooter').hide(300,'swing');
        $('#criteria-domains').hide(300,'swing');
        $('#step1').addClass('active-step');
        $('#step2').removeClass('active-step');
    })
    //Continue » button in 2nd step
    $('#Continue').click(function(){
        serializedData = $("#frmUpdate").serialize()
        var dataArray = decodeURIComponent(serializedData).split('&').map(function(item) {
            return item.split('=');
        });

        var serializedObject = {};
        $.each(dataArray, function(index, item) {
            var key = decodeURIComponent(item[0]);
            var value = decodeURIComponent(item[1]);
            if (serializedObject[key]) {
                if (Array.isArray(serializedObject[key])) {
                    serializedObject[key].push(value);
                } else {
                    serializedObject[key] = [serializedObject[key], value];
                }
            } else {
                serializedObject[key] = value;
            }
        });

        checkTableName = $('#Continue').attr('tableName');
        $.extend(serializedObject, { "tablename" : checkTableName ,"AjaxCheck" : 'step3Ajax' });
        $.ajax({
            url: '../modules/addons/exchange_currency/lib/ajaxFunction.php',
            method: 'POST',
            data: serializedObject,
            dataType: 'json',
            success: function(response) {
                if(response['status'] == 'fail'){
                    alertMessage = 'Select '+ response['nameHeading']+'!!';
                    if(response['checkDomainAddons'] == 'no'){
                        alertMessage = 'Select Domain Addons!!';
                    }
                    swal('Please',alertMessage, "error");
                    return;
                } else{
                    var step3Html;
                    for (var key in response) {
                        if (response.hasOwnProperty(key)) {
                            if(response['names'] == undefined){
                                response['names']='none';
                            }
                            for (var i = 0; i < response['status'].length; i++) {
                                response['status'][i] = response['status'][i].replace(/\+/g, ' ');

                              }
                            step3Html = `<h2>Criteria</h2>
                            <p><strong>` + response['nameHeading'] +`</strong><br>
                                <strong>` + response['names'] +`<br>
                                    Statuses: <strong>` +response['status'] +`</strong><br></p>
                                    <p>Currency: <strong>` + response['currency'] +`</strong></p>`;
                        }
                    }
                    if(checkTableName == 'tbldomainpricing'){
                        if(response['domainaddons'] == undefined){
                            response['domainaddons']='none';
                        }
                        if(response['regperiod'] == undefined){
                            response['regperiod']='none';
                        }
                        for (var i = 0; i < response['domainaddons'].length; i++) {
                            response['domainaddons'][i] = response['domainaddons'][i].replace(/\+/g, ' ');

                          }
                        step3Html += `<strong>Registration Period: ` +response['regperiod'] +` Year</strong><br/>
                        <strong>Addons: ` +response['domainaddons'] +`</strong><br/>`;             
                    }
                    $('#bulkpricingupdater-review').html(step3Html);
                    $('#criteria-addons').hide(300,'swing');
                    $('#criteria-domains').hide(300,'swing');
                    $('#showFooter').hide(300,'swing');
                    $('#step-3').show(300, 'swing');
                    $('#step3').addClass('active-step');
                    $('#step2').removeClass('active-step');
                    $('#editCriteria').attr('checkTable',checkTableName);
                }
            }
        });
    })


    //edit criteria button in 3rd step
    $('#editCriteria').click(function(){
        checkTable = $('#editCriteria').attr('checkTable');
        if(checkTable == 'tbldomainpricing'){
            $('#criteria-domains').show(300,'swing');
        } else{
            $('#criteria-addons').show(300,'swing');
        }
        $('#step2').addClass('active-step');
        $('#step3').removeClass('active-step');
        $('#step-3').hide(300, 'swing');
        $('#showFooter').show();

    })  
    $.ajax({
        url: '../modules/addons/exchange_currency/lib/ajaxFunction.php',
        method: 'POST',
        data: {
            ajaxMethdos: 'GetCurrency' 
        },
        dataType: 'json',
        success: function(response) {
            var bodyHtml = '';
            for (x in response){
                bodyHtml = bodyHtml + '<option value='+ response[x]["id"] + ">" + response[x]['code'] + "</option>";
            }
            $('#addoncurrid').append(bodyHtml);
            $('#domaincurrid').append(bodyHtml);

        }
    });

});

//load function use in 1st step buttons(Products/Services, Product Addons, Domains)
function loadStep(tableName) {
    $('#Continue').attr('tableName',tableName);
    $.ajax({
        url: '../modules/addons/exchange_currency/lib/ajaxFunction.php',
        method: 'POST',
        data: {
            table: tableName,
            ajaxMethdos: 'getTable' 
        },
        dataType: 'json',
        success: function(response) {
            var newHtml = '';
            var bodyHtml = '';
            $('#productAddon').append(newHtml);
            if(tableName == 'tblproducts'){
                $('.container').hide(300,'swing');
                $('#showFooter').show(300,'swing');
                $('#criteria-addons').show(300,'swing');
                $('#heading').html('Products/Services Criteria')
                for (x in response){
                    bodyHtml = bodyHtml + '<option value='+ response[x]["id"] + ">" + response[x]['product_group_name'] + '-' + response[x]['product_name'] + "</option>";
                }
            } else if(tableName == 'tbladdons'){
                $('.container').hide(300,'linear');
                $('#showFooter').show(300,'linear');
                $('#criteria-addons').show(300,'linear');
                for (x in response){
                    bodyHtml = bodyHtml + '<option value='+ response[x]["id"] + ">" + response[x]['name'] + "</option>";
                    $('#heading').html('Addons Criteria')
                }
            } else if(tableName == 'tbldomainpricing'){
                for (x in response){
                    bodyHtml = bodyHtml + '<label class="checkbox-inline"><input type="checkbox" name="domaintlds[]" value='+ response[x]['extension'] +'>'+ response[x]['extension'] +'</label>';
                    $('#domaincheck').html(bodyHtml);
                    $('.container').hide(300,'linear');
                    $('#criteria-addons').hide(300,'linear');
                    $('#showFooter').show(300,'linear');
                    $('#criteria-domains').show(300,'swing');
                }
            }
            $('#productAddon').html(bodyHtml);
        }
    });
    $('#step2').addClass('active-step');
    $('#step1').removeClass('active-step');
}
