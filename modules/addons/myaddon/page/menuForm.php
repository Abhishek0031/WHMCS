<link rel="stylesheet" href="<?php echo $csspath; ?>style.css"></link>
   <div class="container-fluid mt-3" id="login">
       <div class="row col-md-12 formdiv">
        <div class="col-md-3"></div>
            <form  class="col-md-5 m-auto" id="myForm" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="menu_name" class="form-label">Menu Name:</label>
                        <input type="text" class="form-control" id="menu_name" name="menu_name">
                    </div>
                    <div>
                        <label for="menu_url" class="form-label">Menu Url:</label>
                        <input type="text" class="form-control" id="menu_url" name="menu_url">
                    </div>
                    
                    <div>
                    <label for="menu_type" class="form-label">Menu Type:</label>
                        <select class="form-control" name="menu_type" id="menu_type">
                        <option value=''  readonly>---select Menu Type---</option>
                            <option value="parent_menu">Parent Menu</option>
                            <option value="sub_menu">Sub Menu</option>
                            <option value="child_menu">Child Menu</option>
                        </select>
                    </div>
                    <div class="parent_menu" style='display:none;'>
                    <label for="parent_menu" class="form-label">Parent Menu:</label>
                        <select class="form-control" name="parent_menu" id="parent_menu">
                            <option value="parent_menu"></option>
                        </select>
                    </div>

                    <div class="child_menu" style='display:none;'>
                    <label for="child_menu" class="form-label">Sub Parent Menu:</label>
                        <select class="form-control" name="child_menu" id="child_menu">
                            <option value="child_menu"></option>
                        </select>
                    </div>
                    <div>
                        <label for="icon" class="form-label">Menu Icon:</label>
                        <input type="text" class="form-control" id="icon" name="icon">
                    </div>
                    <div>
                        <label for="menu_class" class="form-label">Menu Class:</label>
                        <input type="text" class="form-control" id="menu_class" name="menu_class">
                    </div>
                    <div>
                    <label for="menu_status" class="form-label">Menu Status:</label>
                        <select class="form-control" name="menu_status" id="menu_status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                <br/> 
                <div>
                    <button type="submit" class="btn btn-primary mybtn" id="login_ad" name='submit'>Submit</button>
                </div>          
            </form>
        </div>
    </div>  

    <script>
        $(document).ready(function(){
            jQuery(document).on('change','#menu_type',function(){
                var menu_type=$(this).val();
                if(menu_type == 'sub_menu'||menu_type == 'child_menu'){
                    $('.child_menu').hide();
                    $.ajax({
                        url:'', 
                        method:'POST',
                        data:{ajaxMethdos:"true",type:menu_type},
                        dataType:'json', 
                        success:function(data){
                            $('.parent_menu').show();
                            // console.log(data);  
                            var msg2="<option value = '' disable readonly>---select Parent Menu---</option>";
                            for (x in data) {
                             msg2 =
                            msg2 +
                            "<option id=" +
                            data[x]["id"] +
                            " value=" +
                            data[x]["id"] +
                            ">" +
                            data[x]["menu_name"] +
                            "</option>";
                        }
                         $("#parent_menu").html(msg2);

/* for child drop down */

                 $(document).on('change','#parent_menu',function(){
                var selectedOptionId = $(this).find('option:selected').attr('id');
                if(menu_type == 'child_menu'){
                $('.child_menu').show();
                    if(selectedOptionId){
                        $.ajax({
                            url:'', 
                            method:'POST',
                            data:{ajaxMethdos:"true",type:menu_type,value:selectedOptionId},
                            dataType:'json',     
                            success:function(data){
                                console.log(data);  
                                $('.parent_menu').show();
                                var msg2="<option value='' disable>---select Sub Menu---</option>";  
                                for (x in data) {
                                msg2 =
                                msg2 +
                                "<option id=" +
                                data[x]["id"] +
                                " value=" +
                                data[x]["id"] +
                                ">" +
                                data[x]["menu_name"] +
                                "</option>";
                            }
                            $("#child_menu").html(msg2);
                            }
                        })
                    } else{
                        $('.parent_menu').hide();
                        $('.child_menu').hide();
                    }
                } else{
                    $('.child_menu').hide();
                }
            });
                        }
                    });
                } else{
                    $('.parent_menu').hide();
                    $('.child_menu').hide();
                }
            })


           
       
        })
    </script>   

<?php

    if(isset($_POST['submit'])){
        $data = $mymoduleObject->menuForm();
        if(isset($data)){
            echo "<pre>";
            print_r($data);
        } else{
            print_r($data);
        }
    }
    ?>