<?php
/* Smarty version 3.1.36, created on 2024-01-24 11:30:31
  from 'C:\xampp\htdocs\whmcs\modules\addons\ticket_tag\templates\admin\dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_65b0e6c7ce6bf2_61086488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '344ddccd394ed8ebdc76899f9b6d9ebc2adc8bf2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\ticket_tag\\templates\\admin\\dashboard.tpl',
      1 => 1706088890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65b0e6c7ce6bf2_61086488 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tplVar']->value['rootURL'];?>
/modules/addons/ticket_tag/assets/js/ticketjs.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplVar']->value['rootURL'];?>
/modules/addons/ticket_tag/assets/css/style.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<?php echo '<script'; ?>
 src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>

<div class="container-fluid">
  
  <div class="menu_bar ticket-tag-menu">
    <img src="https://whmcs81.shinedezign.pro/modules/addons/affiliate/images/wgs-logo.svg">      
    <ul>
      <li class="active"><a href="#">
        <span class="glyphicon glyphicon-cog"></span>
      </a>Setting</li>
    </ul>
  </div>
  <br/>
<div class="container">
    <div class="col-sm-12 auto-m d-block">
        <div class="box ticket-tag-box">
          <!-- <pre> -->
           <!-- <?php echo print_r($_smarty_tpl->tpl_vars['tplVar']->value);?>
 -->
           <!-- </pre> -->

            <?php if ($_smarty_tpl->tpl_vars['tplVar']->value['insertMsg']['status'] == 'error') {?>
           <div class="alert alert-danger" role="alert">
            <?php echo $_smarty_tpl->tpl_vars['tplVar']->value['insertMsg']['message'];?>

            </div>
          
           <?php } elseif ($_smarty_tpl->tpl_vars['tplVar']->value['insertMsg']['status'] == 'success') {?>
           <div class="alert alert-success" role="alert">
            <?php echo $_smarty_tpl->tpl_vars['tplVar']->value['insertMsg']['message'];?>

            </div>
           <?php }?>
          
           <form action="" method="post">
            <div class="form-group">
                <label for="enter tag">Enter Tag</label>
                <input type="text" name="tag_manager" id="tag" class="form-control" placeholder="Enter Tag Name *">
            </div>
            <div class="form-group">
            <label for="tag background color">Tag Background Color</label>
            <input type="color" name="tag_color" class="form-control">
        </div>
        <input type="submit" class="btn btn-success" name="insert" value="submit">
      </form> 
    </div>
    </div>
</div>
<br/>

<div class="container">
  <table id="delete_inactive_client" class="datatable" style="width:100%">
<thead>
    <tr class="info" >
        <th>Id</th>
        <th>Tag Manager</th>
        <th>Tag Color</th>
        <th><center>Action</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tplVar']->value['tag_manager_details'], 'foo');
$_smarty_tpl->tpl_vars['foo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$_smarty_tpl->tpl_vars['foo']->do_else = false;
?>
      <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['foo']->value->id;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['foo']->value->tag_manager;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['foo']->value->tag_color;?>
</td>
        <td><center><button type="button" class="btnClick btn btn-default btn-sm" 
            data-toggle="modal" data-target="#myModal" 
            data-id="<?php echo $_smarty_tpl->tpl_vars['foo']->value->id;?>
" data-tag="<?php echo $_smarty_tpl->tpl_vars['foo']->value->tag_manager;?>
" 
            data-color="<?php echo $_smarty_tpl->tpl_vars['foo']->value->tag_color;?>
"><span class="glyphicon glyphicon-pencil"></span></button>
        <button class="btn btn-default deleteBtn" id="<?php echo $_smarty_tpl->tpl_vars['foo']->value->id;?>
" name="delete"><span class="glyphicon glyphicon-trash"></span></button></center></td>
    </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </tbody>
</table> 

</div>
    <!-- Modal -->
    <div class="modal fade edit-popup" id="myModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-success"><center>Edit Details Here</center></h4>
          </div>
          <div class="modal-body">
            <form action="" method="post">
                <div class="form-group">
                  <b><p class="text-success" id="msg"></p></b>
                    <label for="enter tag">Enter Tag</label>
                    <input type="text" name="tag_manager" id="editTagManager" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tag background color">Tag Background Color</label>
                    <input type="color" name="tag_color" id="editTagColor" class="form-control">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit"  id="updateBtn" class="btn btn-success UpdateSub" name="update">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php }
}
