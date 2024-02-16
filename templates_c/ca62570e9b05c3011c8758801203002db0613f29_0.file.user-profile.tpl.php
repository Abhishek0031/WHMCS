<?php
/* Smarty version 3.1.36, created on 2023-12-01 05:48:50
  from 'C:\xampp\htdocs\whmcs\templates\twenty-one\user-profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_656965b2744994_54186346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca62570e9b05c3011c8758801203002db0613f29' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\twenty-one\\user-profile.tpl',
      1 => 1698814882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_656965b2744994_54186346 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/flashmessage.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<div class="card">
    <div class="card-body">
        <h3 class="card-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'userProfile.profile'),$_smarty_tpl ) );?>
</h3>

        <form method="post" action="<?php echo routePath('user-profile-save');?>
">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputFirstName" class="col-form-label">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareafirstname'),$_smarty_tpl ) );?>

                        </label>
                        <input
                            type="text"
                            name="firstname"
                            id="inputFirstName"
                            value="<?php echo $_smarty_tpl->tpl_vars['user']->value->firstName;?>
"
                            class="form-control"
                            <?php if (in_array('firstname',$_smarty_tpl->tpl_vars['uneditableFields']->value)) {?>disabled="disabled"<?php }?>
                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputLastName" class="col-form-label">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientarealastname'),$_smarty_tpl ) );?>

                        </label>
                        <input
                            type="text"
                            name="lastname"
                            id="inputLastName"
                            value="<?php echo $_smarty_tpl->tpl_vars['user']->value->lastName;?>
"
                            class="form-control"
                            <?php if (in_array('lastname',$_smarty_tpl->tpl_vars['uneditableFields']->value)) {?>disabled="disabled"<?php }?>
                        >
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" name="save" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareasavechanges'),$_smarty_tpl ) );?>
" />
            <input class="btn btn-default" type="reset" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'cancel'),$_smarty_tpl ) );?>
" />
        </form>

    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3 class="card-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'userProfile.changeEmail'),$_smarty_tpl ) );?>
</h3>

        <p>
            <?php if ($_smarty_tpl->tpl_vars['user']->value->needsToCompleteEmailVerification()) {?>
                <span class="label label-default"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'userProfile.notVerified'),$_smarty_tpl ) );?>
</span>
            <?php } elseif ($_smarty_tpl->tpl_vars['user']->value->emailVerified()) {?>
                <span class="label label-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'userProfile.verified'),$_smarty_tpl ) );?>
</span>
            <?php }?>
        </p>

        <form method="post" action="<?php echo routePath('user-profile-email-save');?>
">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail" class="col-form-label">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareaemail'),$_smarty_tpl ) );?>

                        </label>
                        <input
                            type="email"
                            name="email"
                            id="inputEmail"
                            value="<?php echo $_smarty_tpl->tpl_vars['user']->value->email;?>
"
                            class="form-control"
                            <?php if (in_array('email',$_smarty_tpl->tpl_vars['uneditableFields']->value)) {?>disabled="disabled"<?php }?>
                        >
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" name="save" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareasavechanges'),$_smarty_tpl ) );?>
" />
            <input class="btn btn-default" type="reset" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'cancel'),$_smarty_tpl ) );?>
" />
        </form>

    </div>
</div>
<?php }
}
