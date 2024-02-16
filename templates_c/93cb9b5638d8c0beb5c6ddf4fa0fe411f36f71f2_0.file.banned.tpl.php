<?php
/* Smarty version 3.1.36, created on 2023-12-19 11:41:48
  from 'C:\xampp\htdocs\whmcs\templates\twenty-one\banned.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_6581736ce40cf9_97149475',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93cb9b5638d8c0beb5c6ddf4fa0fe411f36f71f2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\twenty-one\\banned.tpl',
      1 => 1698814877,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6581736ce40cf9_97149475 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="alert alert-danger">
    <strong>
        <i class="fas fa-gavel"></i>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'bannedyourip'),$_smarty_tpl ) );?>

        <?php echo $_smarty_tpl->tpl_vars['ip']->value;?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'bannedhasbeenbanned'),$_smarty_tpl ) );?>

    </strong>
    <ul>
        <li>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'bannedbanreason'),$_smarty_tpl ) );?>
:
            <strong><?php echo $_smarty_tpl->tpl_vars['reason']->value;?>
</strong>
        </li>
        <li>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'bannedbanexpires'),$_smarty_tpl ) );?>
:
            <?php echo $_smarty_tpl->tpl_vars['expires']->value;?>

        </li>
    </ul>
</div>
<?php }
}
