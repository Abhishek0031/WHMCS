<?php
/* Smarty version 3.1.36, created on 2023-11-19 04:53:19
  from 'C:\xampp\htdocs\whmcs\modules\addons\myaddon\templates\publicpage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655986af839065_55304439',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c9799862c53fcac43979f863cdc6e4315c61fa1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\myaddon\\templates\\publicpage.tpl',
      1 => 1700365997,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655986af839065_55304439 (Smarty_Internal_Template $_smarty_tpl) {
?><h1>in publicpage</h1>  
<h2>Public Client Area Sample Page</h2>

<p>This is an example of a public client area page that does not require a login to view.</p>

<p>All the template variables you define along with some <a href="https://developers.whmcs.com/themes/variables/" target="_blank">additional standard template variables</a> are available within this template.<br>You can use the Smarty <em>{debug}</em> function call to see a full list.</p>

<hr>

<div class="row">
    <div class="col-sm-3">
        Module Link
    </div>
    <div class="col-sm-7">
        <?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>

    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        Config Text Field Value
    </div>
    <div class="col-sm-7">
        <?php echo $_smarty_tpl->tpl_vars['configTextField']->value;?>

    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        Custom Variable
    </div>
    <div class="col-sm-7">
        <?php echo $_smarty_tpl->tpl_vars['customVariable']->value;?>

    </div>
</div>

<hr>

<p>
    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=secret" class="btn btn-default">
        <i class="fa fa-lock"></i>
        Go to page that requires authentication
    </a>
</p>
<?php $_smarty_debug = new Smarty_Internal_Debug;
 $_smarty_debug->display_debug($_smarty_tpl);
unset($_smarty_debug);
}
}
