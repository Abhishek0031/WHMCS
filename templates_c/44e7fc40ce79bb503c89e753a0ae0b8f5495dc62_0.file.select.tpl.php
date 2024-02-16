<?php
/* Smarty version 3.1.36, created on 2023-11-22 06:25:51
  from 'C:\xampp\htdocs\whmcs\templates\twenty-one\payment\card\select.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655d90df42f280_61586403',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44e7fc40ce79bb503c89e753a0ae0b8f5495dc62' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\twenty-one\\payment\\card\\select.tpl',
      1 => 1698814887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d90df42f280_61586403 (Smarty_Internal_Template $_smarty_tpl) {
if (count($_smarty_tpl->tpl_vars['existingCards']->value) > 0) {?>
    <div class="three-column-grid">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['existingCards']->value, 'cardInfo');
$_smarty_tpl->tpl_vars['cardInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cardInfo']->value) {
$_smarty_tpl->tpl_vars['cardInfo']->do_else = false;
?>
            <?php $_smarty_tpl->_assignInScope('payMethodExpired', 0);?>
            <?php $_smarty_tpl->_assignInScope('expiryDate', '');?>
            <?php $_smarty_tpl->_assignInScope('payMethod', $_smarty_tpl->tpl_vars['cardInfo']->value['payMethod'] ,true);?>
            <?php if ($_smarty_tpl->tpl_vars['payMethod']->value->payment->isExpired()) {?>
                <?php $_smarty_tpl->_assignInScope('payMethodExpired', 1 ,true);?>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['payMethod']->value->payment->getExpiryDate()) {?>
                <?php $_smarty_tpl->_assignInScope('expiryDate', $_smarty_tpl->tpl_vars['payMethod']->value->payment->getExpiryDate()->format('m/Y') ,true);?>
            <?php }?>

            <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                <input
                        id="existingCard<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
"
                        type="radio"
                        name="ccinfo"
                        class="existing-card icheck-button"
                        data-billing-contact-id="<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['billingcontactid'];?>
"
                        <?php if ($_smarty_tpl->tpl_vars['cardOnFile']->value && !$_smarty_tpl->tpl_vars['payMethodExpired']->value && $_smarty_tpl->tpl_vars['payMethodId']->value == $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid']) {?>
                            <?php ob_start();
echo $_smarty_tpl->tpl_vars['cardInfo']->value['billingcontactid'];
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('preselectedBillingContactId', $_prefixVariable1 ,true);?>
                            checked="checked" data-loaded-paymethod="true"
                        <?php } elseif (($_smarty_tpl->tpl_vars['cardOnFile']->value && $_smarty_tpl->tpl_vars['payMethodExpired']->value) || !$_smarty_tpl->tpl_vars['cardOnFile']->value) {?>
                            disabled="disabled"
                        <?php }?>
                        <?php if (!$_smarty_tpl->tpl_vars['hasRemoteInput']->value) {?>onclick="hideNewCardInputFields();"<?php }?>
                        value="<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
"
                >
            </div>
            <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                <label for="existingCard<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                    <i class="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->getFontAwesomeIcon();?>
"></i>
                </label>
            </div>
            <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                <label for="existingCard<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['payMethod']->value->payment->getDisplayName();?>

                </label>
            </div>
            <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                <label for="existingCard<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['payMethod']->value->getDescription();?>

                </label>
            </div>
            <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                <label for="existingCard<?php echo $_smarty_tpl->tpl_vars['cardInfo']->value['paymethodid'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['expiryDate']->value;?>

                    <?php if ($_smarty_tpl->tpl_vars['payMethodExpired']->value) {?><br><small><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareaexpired'),$_smarty_tpl ) );?>
</small><?php }?>
                </label>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php }?>
<div class="paymethod-info">
    <label>
        <input id="newCCInfo" type="radio" class="icheck-button" name="ccinfo" value="new" <?php if ($_smarty_tpl->tpl_vars['payMethodId']->value == "new" || !$_smarty_tpl->tpl_vars['cardOnFile']->value) {?> checked<?php }?> /> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardenternewcard'),$_smarty_tpl ) );?>

    </label>
</div>
<?php }
}
