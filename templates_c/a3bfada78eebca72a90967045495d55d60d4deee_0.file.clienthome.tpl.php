<?php
/* Smarty version 3.1.36, created on 2023-11-20 09:49:39
  from 'C:\xampp\htdocs\whmcs\modules\addons\myaddon\templates\viewDetails\clienthome.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655b1da3436903_19887224',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3bfada78eebca72a90967045495d55d60d4deee' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\myaddon\\templates\\viewDetails\\clienthome.tpl',
      1 => 1700469727,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655b1da3436903_19887224 (Smarty_Internal_Template $_smarty_tpl) {
?><body>
  <div>
      <center><h1>client</h1></center> 
      <pre>

        <?php echo $_smarty_tpl->tpl_vars['abhi']->value;?>
        
      </pre>
      <table class="table table-hover table-striped">
          <thead>
              <tr class='info'>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Company Name</th>
                  <th>Address</th>
                  <th>Status</th>
              </tr>
          </thead>
          <tbody>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientData']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
                  <tr>
                      <td><?php echo $_smarty_tpl->tpl_vars['element']->value->firstname;?>
</td>
                      <td><?php echo $_smarty_tpl->tpl_vars['element']->value->lastname;?>
</td>
                      <td><?php echo $_smarty_tpl->tpl_vars['element']->value->email;?>
</td>
                      <td><?php echo $_smarty_tpl->tpl_vars['element']->value->companyname;?>
</td>
                      <td><?php echo $_smarty_tpl->tpl_vars['element']->value->address1;?>
</td>
                      <td><?php echo $_smarty_tpl->tpl_vars['element']->value->status;?>
</td>
                  </tr>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </tbody>
      </table>
  </div>
  <!-- <?php echo $_SERVER['PHP_SELF'];?>

  <?php echo $_SERVER['HTTP_HOST'];
echo $_SERVER['REQUEST_URI'];?>
 -->
  <?php echo $_SERVER['REQUEST_URI'];?>

</body>
<?php }
}
