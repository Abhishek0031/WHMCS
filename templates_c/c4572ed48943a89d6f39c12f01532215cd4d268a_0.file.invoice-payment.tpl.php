<?php
/* Smarty version 3.1.36, created on 2023-11-22 06:25:51
  from 'C:\xampp\htdocs\whmcs\templates\twenty-one\invoice-payment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655d90df37acd6_69490441',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4572ed48943a89d6f39c12f01532215cd4d268a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\twenty-one\\invoice-payment.tpl',
      1 => 1698814880,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d90df37acd6_69490441 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['showRemoteInput']->value) {?>
    <div id="frmRemoteCardProcess" class="text-center">
        <?php echo $_smarty_tpl->tpl_vars['remoteInput']->value;?>

        <iframe name="ccframe" class="auth3d-area" width="90%" height="600" scrolling="auto" src="about:blank"></iframe>
    </div>

    <?php echo '<script'; ?>
>
        jQuery("#frmRemoteCardProcess").find("form:first").attr('target', 'ccframe');
        setTimeout("autoSubmitFormByContainer('frmRemoteCardProcess')", 1000);
    <?php echo '</script'; ?>
>
<?php } else { ?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/payment/".((string)$_smarty_tpl->tpl_vars['cardOrBank']->value)."/validate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <form id="frmPayment" method="post" action="<?php echo $_smarty_tpl->tpl_vars['submitLocation']->value;?>
" role="form">
        <input type="hidden" name="invoiceid" value="<?php echo $_smarty_tpl->tpl_vars['invoiceid']->value;?>
" />

        <div class="row cc-payment-form">
            <div class="col-md-7">

                <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
?>
                <?php }?>

                <div class="alert alert-danger text-center gateway-errors w-hidden"></div>

                <div class="card">
                    <div class="card-body">

                        <h3 class="card-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"makepayment"),$_smarty_tpl ) );?>
</h3>

                        <div class="form-group row">
                            <label class="col-sm-4 text-md-right control-label">
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'paymentmethod'),$_smarty_tpl ) );?>

                            </label>
                            <div class="col-sm-8">
                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/payment/".((string)$_smarty_tpl->tpl_vars['cardOrBank']->value)."/select.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                            </div>
                        </div>

                        <?php if (!$_smarty_tpl->tpl_vars['hasRemoteInput']->value) {?>
                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/payment/".((string)$_smarty_tpl->tpl_vars['cardOrBank']->value)."/inputs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                        <?php }?>
                        <div id="btnSubmitContainer" class="form-group submit-container">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'submitpayment'),$_smarty_tpl ) );?>
">
                                    <span class="pay-text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'submitpayment'),$_smarty_tpl ) );?>
</span>
                                    <span class="click-text w-hidden"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'pleasewait'),$_smarty_tpl ) );?>
</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-5">
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/payment/invoice-summary.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['servedOverSsl']->value) {?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-lock"></i> &nbsp; <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardsecuritynotice'),$_smarty_tpl ) );?>

            </div>
        <?php }?>

    </form>

    <?php echo '<script'; ?>
>
    jQuery(document).ready(function() {
        jQuery('#inputCardCvv, #inputCardNumber').filter(':visible').first().focus();
    });
    <?php echo '</script'; ?>
>
<?php }
}
}
