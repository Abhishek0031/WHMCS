<?php
/* Smarty version 3.1.36, created on 2023-11-09 09:49:28
  from 'C:\xampp\htdocs\whmcs\templates\six\includes\pageheader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_654c9d180a2d87_84164811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fd94b22cd6b48197d569b2c8e8602af79c75652' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\six\\includes\\pageheader.tpl',
      1 => 1698814871,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_654c9d180a2d87_84164811 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="header-lined">
    <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;
if ($_smarty_tpl->tpl_vars['desc']->value) {?> <small><?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
</small><?php }?></h1>
    <?php if ($_smarty_tpl->tpl_vars['showbreadcrumb']->value) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
</div>
<?php }
}
