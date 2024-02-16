<?php
/* Smarty version 3.1.36, created on 2023-11-01 08:01:38
  from '1b943456af4116981c670d5e08290997a8c210bc' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_6541f7d2e0d657_77639896',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6541f7d2e0d657_77639896 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="text-center top-margin-10 bottom-margin-10">
    <img width="400" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
/marketconnect/logo.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'wizard.marketConnect'),$_smarty_tpl ) );?>
">
</div>
<div class="text-center" style="margin: 20px 50px 0;">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'wizard.marketConnectDescription'),$_smarty_tpl ) );?>

</div>
<div class="text-center">
    <a class="autoLinked" href="<?php echo $_smarty_tpl->tpl_vars['WEB_PATH']->value;?>
/marketconnect.php">
        <img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
/wizard/marketconnect.png">
    </a>
</div>
<div class="text-center">
    <a class="btn btn-primary autoLinked" href="<?php echo $_smarty_tpl->tpl_vars['WEB_PATH']->value;?>
/marketconnect.php">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'global.learnMore'),$_smarty_tpl ) );?>

    </a>
</div><?php }
}
