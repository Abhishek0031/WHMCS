<?php
/* Smarty version 3.1.36, created on 2024-02-14 07:19:17
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_65cc5b6515f2b8_03807043',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1707891557,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cc5b6515f2b8_03807043 (Smarty_Internal_Template $_smarty_tpl) {
?>Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
, 

We have received your order and will be processing it shortly. The details of the order are below: 

Order Number: <?php if ((isset($_smarty_tpl->tpl_vars['order_number']->value))) {
echo $_smarty_tpl->tpl_vars['order_number']->value;
}?>



<?php if ((isset($_smarty_tpl->tpl_vars['order_details']->value))) {
echo $_smarty_tpl->tpl_vars['order_details']->value;
}?> 

You will receive an email from us shortly once your account has been setup. Please quote your order reference number if you wish to contact us about this order. 

<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}
