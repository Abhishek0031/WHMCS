<?php
/* Smarty version 3.1.36, created on 2024-01-08 08:01:14
  from 'C:\xampp\htdocs\whmcs\templates\twenty-one\includes\panel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_659b9dba5e3496_49537834',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8eda469dbc5a2849576b6d311632f543bfadd5f6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\twenty-one\\includes\\panel.tpl',
      1 => 1698814885,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659b9dba5e3496_49537834 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row w-100 mx-auto mb-3">
    <div class="card w-100">
        <?php if ((isset($_smarty_tpl->tpl_vars['headerTitle']->value))) {?>
            <div class="card-title py-1 px-2 text-white font-weight-bold bg-<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <?php echo $_smarty_tpl->tpl_vars['headerTitle']->value;?>

            </div>
        <?php }?>
        <?php if ((isset($_smarty_tpl->tpl_vars['bodyContent']->value))) {?>
            <div class="card-text<?php if ((isset($_smarty_tpl->tpl_vars['bodyTextCenter']->value))) {?> text-center<?php }?> mx-2 mb-3">
                <?php echo $_smarty_tpl->tpl_vars['bodyContent']->value;?>

            </div>
        <?php }?>
        <?php if ((isset($_smarty_tpl->tpl_vars['footerContent']->value))) {?>
            <div class="card-footer<?php if ((isset($_smarty_tpl->tpl_vars['footerTextCenter']->value))) {?> text-center<?php }?> mx-2 mb-3">
                <?php echo $_smarty_tpl->tpl_vars['footerContent']->value;?>

            </div>
        <?php }?>
    </div>
</div>
<?php }
}
