<?php
namespace WHMCS\Module\Addon\wgsmoduletlist\Admin;
use WHMCS\Database\Capsule;
class Controller
{

    public function getProductName($pid)
    {

        $productName = Capsule::table('tblproducts')
        // ->whereIn('id', $explode(",",$id))
        ->where('id', $pid)
        ->select('name')
        ->first();
        if(isset($productName))
            return $productName->name;
        else
            return '-';
    }

    public function getModuleName($mid)
    {

        $productList = Capsule::table('tblproducts')
            ->whereIn('id', explode(",", $mid))
            ->pluck('name')
            ->toArray();

        return implode(',',$productList);
    }

    public function pro_dashboard_setting($vars)
    {
        $productList = Capsule::table('tblproducts')
        ->whereNotIn('id', [1, 2])
        ->select('name','id')
        ->get();
        $moduleList = Capsule::table('tblproducts')
        ->whereIn('id',[1,2])
        ->select('name','id')
        ->get();


        $selectOption = '';
        foreach($productList as $item ){
            $selectOption .= "<option value=".$item->id.">$item->name</option>";
        }

        $selectModOption = '<option value="">Select Product</option>';
        foreach($moduleList as $item ){
            $selectModOption .= "<option value=".$item->id.">$item->name</option>";
        }

        /** Listing  */
        $proDashboardList = Capsule::table('mod_prodashboard_modules')->get();
        $tableProductList = '';
        foreach($proDashboardList as $item ){

            $countProducts = count(explode(",",$item->m_id));
            $tableProductList .= "<tr>
                            <td class='text-center'>".$this->getProductName($item->p_id)."</td>
                            <td style='display:none;' class='text-center'>".$this->getModuleName($item->m_id)."</td>
                            <td class='text-center'>".$countProducts."</td>
                            <td class='text-center'><div> <i class='fas fa-edit editmod' style='cursor:pointer' data-sel='".$item->m_id."' mod='".$item->id."' ></i> 
                            <i class='fas fa-regular fa-trash deleteprd' style='color:#d9534f;margin-left:5px;cursor:pointer' mod='".$item->id."'></i></div></td>
                        </tr>";
        }
        /* end*/

        if(isset($_POST['addmoduleprd']) && $_POST['addmoduleprd'] == 'addmoduleprd'){

            $productIds = implode(",",$_POST['productName']);
            $insertData =[
                'm_id' => $productIds,
                'p_id' => $_POST['selectmodule'],
                "created_at" => date("Y-m-d H:i:s", time()),
                "updated_at" => date("Y-m-d H:i:s", time()),
            ];
            if((Capsule::table('mod_prodashboard_modules')->where('p_id',$_POST['selectmodule'])->count()) === 0){
                $result = Capsule::table('mod_prodashboard_modules')->insert($insertData);
                echo '<script type="text/javascript">
                swal({
                    title: "Success",
                    text: "Data inserted successfully",
                    type: "success"
                  },
                    function(){
                        location.reload();
                    }
                );
                </script>';
            } else{
                echo '<script type="text/javascript">
                    swal("Fail!", "This product is already added, please add the other one", "error");
                </script>';
            }
            
        }

        if(isset($_POST['request']) && $_POST['request'] == 'deletemodprd') {

            Capsule::table('mod_prodashboard_modules')->where('id',$_POST['mid'])->delete();
            echo json_encode("success");
            die;
        }
        if(isset($_POST['addmoduleprd']) && $_POST['addmoduleprd'] == 'editmoduleprd') {

            $productIds = implode(",",$_POST['productName']);
            $insertData =[
                'm_id' => $productIds,
                'p_id' => $_POST['selectmodule'],
                "updated_at" => date("Y-m-d H:i:s", time()),
            ];
 
            $result = Capsule::table('mod_prodashboard_modules')->where('id', $_POST['midprd'])->update($insertData);
            echo '<script type="text/javascript">
            swal({
                title: "Success",
                text: "Data Updated successfully",
                type: "success"
              },
                function(){
                    location.reload();
                }
            );
            </script>';

        }
        if (file_exists(dirname(dirname(__DIR__)) . '/templates/header.tpl'))
            require_once dirname(dirname(__DIR__)) . '/templates/header.tpl';

        return <<<EOF
        <div class='main_body container-fluid'>
            
            <div class="list_div prd_mapping_list">
                <a href="javascript:void();" class="addmoduleproduct">+ Add Product</a>
                <table width="100%" class="table datatable mt-5">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th style="display:none;">Modules Name</th>
                            <th>Total Modules</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        $tableProductList
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal" id="myModalProduct">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Product</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="module_form_prd" method="post" onSubmit="document.getElementById('submit_mod_prd').disabled=true;">
                        <input type="hidden" name="addmoduleprd" value="addmoduleprd">    
                        <div class="form-group">
                            <label for="email">Select Product:</label>
                            <select class="form-control" name="selectmodule" id="selectmodule" required>    
                                $selectModOption
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email">Select Modules:</label>
                            <select name="productName[]" class="form-control" select-inline input-600" multiple="true" id="selectproducts" required>
                                $selectOption                            
                            </select>
                        </div>
                        <input type="hidden" class="form-control" name="midprd">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="module_form_prd" id="submit_mod_prd">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
        </div>

        <div class="modal" id="moduledeleteprd">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Module</h4>
                </div>
                <div class="modal-body">
                    Are you Sure delete this?
                    <input type="hidden" id='modval'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deletemodprd" >Delete</button>
                    <button type="button" class="btn btn-primery" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
        </div>

        <script>

        $(document).on('click','.add_button_div',function(){
            $('#selectmodule').css({'pointer-events':'', 'opacity':''});
        });
            $(document).on('click','.addmoduleproduct',function(){
                $('#module_form_prd')[0].reset();
                $("input[name=addmoduleprd]").val('addmoduleprd')
                $('#myModalProduct').modal('show');
            });

            $(document).on('click','.deleteprd', function(){
                var mprid = $(this).attr('mod');
                $('#modval').val(mprid);
                $('#moduledeleteprd').modal('show');
                
            });
            $(document).on('click','#deletemodprd', function(){
                $(this).text('Loading...');
                var mprid = $('#modval').val();
                jQuery.ajax({
                    type: 'POST',
                    url: "{$modulelink}",
                    data: {'request':'deletemodprd','mid':mprid},
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
                        if(response == 'success'){
                            location.reload(true);
                        }
                    }
                });
            })
            $(document).on('click','.editmod', function(){
                $('#selectmodule').css({'pointer-events':'none','opacity':'0.6'});
                var mid = $(this).attr('mod');
                var text1 = $(this).closest('tr').find('td:nth-child(1)').text();
                $("#selectmodule option").filter(function() {
                    return this.text == text1;
                }).attr('selected', true).siblings().removeAttr('selected');
 
                $("#selectproducts option:selected").removeAttr('selected');
                var text2 = $(this).closest('tr').find('td:nth-child(2)').text();
                console.log(text2,'dsd');
                var selectedOptions = text2.split(',');
               
                for(var i in selectedOptions){
                    console.log(selectedOptions[i],'herere');

                    $("#selectproducts option").filter(function() {
                        return this.text == selectedOptions[i];
                    }).prop('selected', "selected");

                    // $("select").find("option:contains('"+selectedOptions[i]+"')").prop("selected", "selected");
                }
 
                $("input[name=addmoduleprd]").val('editmoduleprd')
                $("input[name=midprd]").val(mid)
               
                $('#myModalProduct').modal('show');
               
            });
        </script>
        <script> if ( window.history.replaceState ) {         window.history.replaceState( null, null, window.location.href );     } </script>    
        
      
  EOF;
    }
public function setting($vars)
{
    if (isset($_POST['addsetting']) && !empty($_POST['settingtext'])) {
        $description = $_POST['settingtext'];
        $existingRecord = Capsule::table('mod_wgsmodulelist_modules_description')->first();

        if ($existingRecord) {
            Capsule::table('mod_wgsmodulelist_modules_description')
                ->where('id', $existingRecord->id)
                ->update(['description' => $description]);
        } else {
            $data = ['description' => $description];
            Capsule::table('mod_wgsmodulelist_modules_description')->insert($data);
        }
    }

    if (file_exists(dirname(dirname(__DIR__)) . '/templates/header.tpl'))
            require_once dirname(dirname(__DIR__)) . '/templates/header.tpl';

      return <<<EOF
      <form method="POST">
        <div class="container">
            <div class="row">
                <div class="setting_button">
                    <div class="col-md-8">
                        <div class="setting">
                            <h2>Banner Description</h2>
                            <textarea class="form-control" name="settingtext" rows="4" cols="50"
                                placeholder="">$description</textarea>
            <input type="submit" name="addsetting" class="btn btn-primary" value="Save Changes">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
EOF;
}
    public function index($vars)
    {
        Capsule::Schema()->table('mod_wgsmodulelist_modules', function ($table) {
            if (!Capsule::Schema()->hasColumn('mod_wgsmodulelist_modules', 'viewlink'))
                $table->string('viewlink');
            if (!Capsule::Schema()->hasColumn('mod_wgsmodulelist_modules', 'category_type'))
                $table->string('category_type');
            if (!Capsule::Schema()->hasColumn('mod_wgsmodulelist_modules', 'buylink'))
                $table->string('buylink');
                
        // new column add  'documentation_link'
            if (!Capsule::Schema()->hasColumn('mod_wgsmodulelist_modules', 'documentation_link'))
                $table->string('documentation_link');
        });
        
        $modulelink = $vars['modulelink']; // eg. addonmodules.php?module=addonmodule
        $version = $vars['version']; // eg. 1.0
        $LANG = $vars['_lang']; // an array of the currently loaded language variables

        // Get module configuration parameters
        $configTextField = $vars['Text Field Name'];
        $configPasswordField = $vars['Password Field Name'];
        
        if(isset($_POST['addmodule']) && $_POST['addmodule'] == 'addmodule'){
          
            if($_POST['newlaunch']){
                $update = [
                    'newlaunch' => '0'
                ];
                Capsule::table('mod_wgsmodulelist_modules')->where('newlaunch','1')->update($update);
            }
            $data = [
                'module_name' => $_POST['modulename'],
                'friendly_name' => $_POST['friendlyname'],
                'type' => $_POST['type'],
                'description' => $_POST['desc'],
                'download_links' => $_POST['dnldlinkphp7']. '***' . $_POST['dnldlinkphp8'],
                'Version' => $_POST['version'],
                'logo' => $_POST['logourl'],
                'newlaunch' => $_POST['newlaunch']?'1':'0',
                'viewlink' => $_POST['viewlink'],
                'buylink' => $_POST['buylink'],
                'category_type' => $_POST['category_type'],
                'documentation_link'=>$_POST['documentation_link'],
            ];
            
            Capsule::table('mod_wgsmodulelist_modules')->insert($data);
            
        }
        
        if(isset($_POST['addmodule']) && $_POST['addmodule'] == 'editmodule'){
            
            if($_POST['newlaunch']){
                $update = [
                    'newlaunch' => '0'
                ];
                Capsule::table('mod_wgsmodulelist_modules')->where('newlaunch','1')->update($update);
                
            }
            $data = [
                'module_name' => $_POST['modulename'],
                'friendly_name' => $_POST['friendlyname'],
                'type' => $_POST['type'],
                'description' => $_POST['desc'],
                'download_links' => $_POST['dnldlinkphp7']. '***' . $_POST['dnldlinkphp8'],
                'Version' => $_POST['version'],
                'logo' => $_POST['logourl'],
                'newlaunch' => $_POST['newlaunch']?'1':'0',
                'viewlink' => $_POST['viewlink'],
                'buylink' => $_POST['buylink'],
                'category_type' => $_POST['category_type'],
                'documentation_link'=>$_POST['documentation_link'],
            ];
           
            
            // echo "<pre>";
            // print_r($_POST['newlaunch']);
            //die;
            Capsule::table('mod_wgsmodulelist_modules')->where('id',$_POST['mid'])->update($data);
            
        }
        // echo "<pre>";
        //     print_r($_POST);
        if(isset($_POST['request']) && $_POST['request'] == 'deletemod') {
            Capsule::table('mod_wgsmodulelist_modules')->where('id',$_POST['mid'])->delete();
            echo json_encode("success");
            die;
        }
        $module_list = Capsule::table('mod_wgsmodulelist_modules')->orderBy('id', 'desc')->get();
        //$module_list = (array)$module_list;
        $moduledata = '';
        if(!empty($module_list)) {
            foreach($module_list as $key => $val){
                $newlaunch = '<input class="form-check-input"   type="checkbox">';
                if($val->newlaunch){
                    $newlaunch = '<input class="form-check-input"  type="checkbox" checked>';
                }
                $moduledata .= '<tr><td class="text-center">'.$val->module_name.'</td><td class="text-center">'.$val->friendly_name.'</td><td class="text-center">'.$val->type.'</td><td class="text-center">'.$val->Version.'</td><td class="text-center">'.$val->download_links.'</td><td>'.$val->viewlink.'</td><td>'.$val->buylink.'</td><td class="text-center">'.$val->logo.'</td><td class="text-center">'.$val->category_type.'</td><td class="text-center" check="'.$val->newlaunch.'">'.$newlaunch.'</td><td class="text-center"><div style="display: flex;"> <i class="fas fa-edit edit" style="cursor:pointer" mid="'.$val->id.'" desc="'.$val->description.'" documentation_link="'.$val->documentation_link.'"></i> <i class="fas fa-regular fa-trash delete" style="color:#d9534f;margin-left:5px;cursor:pointer" mid="'.$val->id.'"></i></div></td></tr>';
            }
        }

       if (file_exists(dirname(dirname(__DIR__)) . '/templates/header.tpl'))
            require_once dirname(dirname(__DIR__)) . '/templates/header.tpl';

        return <<<EOF
        
    <div class='main_body container-fluid'>

    <div class="list_div prd_mapping_list">

        <a href="javascript:void();" class="addproduct">+ Add Module</a>
        <table width="100%" class="table datatable mt-5">
            <thead>
                <tr>
                    <th>Module Name</th>
                    <th>Friendly Name</th>
                    <th>Type</th>
                    <th>Version</th>
                    <th width="300px">Download links</th>
                    <th width="300px">View links</th>
                    <th width="300px">Buy links</th>
                    <th width="300px">Logo</th>
                    <th width="300px">Category</th>
                    <th>New Features</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {$moduledata}
            </tbody>
        </table>
    </div>
</div>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Module</h4>
      </div>
      <div class="modal-body">
        <form action="" id="module_form" method="post" onSubmit="document.getElementById('submit_mod').disabled=true;">
            <input type="hidden" name="addmodule" value="addmodule">
            <div class="form-group">
                <label for="email">Module Name:</label>
                <input type="text" name="modulename" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Friendly Name:</label>
                <input type="text" name="friendlyname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Select Type:</label>
                <select class="form-control" name="type" id="selecttype">
                    <option value="addons">Addons</option>
                    <option value="gateways">Gateways</option>
                   
                    <option value="registrars">Registrars</option>

                    <option value="servers">Servers</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pwd">Description:</label>
                <textarea class="form-control" name="desc" required id="desc"></textarea>
            </div>
            <div class="form-group">
                <label for="pwd">Version:</label>
                <input type="text" class="form-control" name="version" required>
            </div>
            <div class="form-group">
                <label for="pwd">Download Link PHP7:</label>
                <input type="text" class="form-control" name="dnldlinkphp7" required>
            </div>
            <div class="form-group">
                <label for="pwd">Download Link PHP8 :</label>
                <input type="text" class="form-control" name="dnldlinkphp8" required>
            </div>
            <div class="form-group">
                <label for="pwd">View Link :</label>
                <input type="text" class="form-control" name="viewlink" required>
            </div>
            <div class="form-group">
                <label for="pwd">Buy Link :</label>
                <input type="text" class="form-control" name="buylink" required>
            </div>
            <div class="form-group">
                <label for="pwd">Logo URL :</label>
                <input type="text" class="form-control" name="logourl">
            </div>
            <div class="form-group">
                <label for="category">Category: </label>
                <select class="form-control" name="category_type" id="categoryselecttype">
                    <option value="select">--Select--</option>
                    <option value="Core Modules">Core Modules</option>
                    <option value="Operational Utilities">Operational Utilities</option>
                    <option value="Premium Modules">Premium Modules</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="pwd">Documentation Link:</label>
                <input type="text" class="form-control" name="documentation_link" required>
            </div>
            
            <input type="hidden" class="form-control" name="mid">
            <div class="form-group form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="newlaunch"> New Features
                </label>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="module_form" id="submit_mod">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="moduledelete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Module</h4>
      </div>
      <div class="modal-body">
        Are you Sure delete this?
        <input type="hidden" id='midval'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="deletemod" >Delete</button>
        <button type="button" class="btn btn-primery" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<script>
    $(document).on('click','.addproduct',function(){
        $('#module_form')[0].reset();
        $("input[name=addmodule]").val('addmodule')
        $('#myModal').modal('show');
    });
    $(document).on('click','.delete', function(){
        var mid = $(this).attr('mid');
        $('#midval').val(mid);
        $('#moduledelete').modal('show');
        
    });
    $(document).on('click','#deletemod', function(){
        $(this).text('Loading...');
        var mid = $('#midval').val();
        jQuery.ajax({
            type: 'POST',
            url: "{$modulelink}",
            data: {'request':'deletemod','mid':mid},
            dataType: 'json',
            success: function(response) {
                console.log(response)
                if(response == 'success'){
                    location.reload(true);
                }

            }
        });
    })
    $(document).on('click','.edit', function(){
        var mid = $(this).attr('mid');
        $('#midval').val(mid);
        $("input[name=modulename]").val($(this).closest('tr').find('td:nth-child(1)').text())
        $("input[name=friendlyname]").val($(this).closest('tr').find('td:nth-child(2)').text())
        $("#selecttype").val($(this).closest('tr').find('td:nth-child(3)').text()).change();
        $("#desc").val($(this).attr('desc'));
        $("input[name=version]").val($(this).closest('tr').find('td:nth-child(4)').text())
        $("input[name=logourl]").val($(this).closest('tr').find('td:nth-child(8)').text())
        $("input[name=viewlink]").val($(this).closest('tr').find('td:nth-child(6)').text())
        $("input[name=buylink]").val($(this).closest('tr').find('td:nth-child(7)').text())
        $("input[name=documentation_link]").val($(this).attr('documentation_link'))
        $("#categoryselecttype").val($(this).closest('tr').find('td:nth-child(9)').text()).change();
        var downloadlinks = $(this).closest('tr').find('td:nth-child(5)').text();
        const downloadlinksArr = downloadlinks.split("***");
        $("input[name=dnldlinkphp7]").val(downloadlinksArr[0])
        $("input[name=dnldlinkphp8]").val(downloadlinksArr[1])
        const newlaunch = $(this).closest('tr').find('td:nth-child(9)').attr('check')
        $("input[name=newlaunch]").prop('checked', false).change()
        console.log(newlaunch);
        if(newlaunch == '1') {
            $("input[name=newlaunch]").prop('checked', true).change()
        }
        $("input[name=addmodule]").val('editmodule')
        $("input[name=mid]").val(mid)
        
        $('#myModal').modal('show');
        
    });
    
</script>
<script> if ( window.history.replaceState ) {         window.history.replaceState( null, null, window.location.href );     } </script>
EOF;
    }

    public function show($vars)
    {
        // Get common module parameters
        $modulelink = $vars['modulelink']; // eg. addonmodules.php?module=addonmodule
        $version = $vars['version']; // eg. 1.0
        $LANG = $vars['_lang']; // an array of the currently loaded language variables

        // Get module configuration parameters
        $configTextField = $vars['Text Field Name'];
        $configPasswordField = $vars['Password Field Name'];
        $configCheckboxField = $vars['Checkbox Field Name'];
        $configDropdownField = $vars['Dropdown Field Name'];
        $configRadioField = $vars['Radio Field Name'];
        $configTextareaField = $vars['Textarea Field Name'];

        return <<<EOF

<h2>Show</h2>

<p>This is the <em>show</em> action output of the sample addon module.</p>

<p>The currently installed version is: <strong>{$version}</strong></p>

<p>
    <a href="{$modulelink}" class="btn btn-info">
        <i class="fa fa-arrow-left"></i>
        Back to home
    </a>
</p>

EOF;
    }
}
