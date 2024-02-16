<?php
/* Smarty version 3.1.36, created on 2023-11-22 06:25:51
  from 'C:\xampp\htdocs\whmcs\templates\twenty-one\payment\card\inputs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655d90df44a8b2_24858118',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '236767eefaeaf0f51808738ca593726dc388e66f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\twenty-one\\payment\\card\\inputs.tpl',
      1 => 1698814887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d90df44a8b2_24858118 (Smarty_Internal_Template $_smarty_tpl) {
?><div<?php if (!$_smarty_tpl->tpl_vars['addingNewCard']->value) {?> class="w-hidden"<?php }?>>
    <div class="form-group cc-details row">
        <label for="inputCardNumber" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardcardnumber'),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-7">
            <input type="tel" name="ccnumber" id="inputCardNumber" size="30" value="<?php if ($_smarty_tpl->tpl_vars['ccnumber']->value) {
echo $_smarty_tpl->tpl_vars['ccnumber']->value;
}?>" autocomplete="off" class="form-control newccinfo cc-number-field" data-message-unsupported="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'paymentMethodsManage.unsupportedCardType'),$_smarty_tpl ) );?>
" data-message-invalid="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'paymentMethodsManage.cardNumberNotValid'),$_smarty_tpl ) );?>
" data-supported-cards="<?php echo $_smarty_tpl->tpl_vars['supportedCardTypes']->value;?>
"/>
            <span class="field-error-msg"></span>
        </div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['showccissuestart']->value) {?>
        <div class="form-group cc-details row">
            <label for="inputCardStart" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardcardstart'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-8">
                <input type="tel" name="ccstartdate" id="inputCardStart" value="<?php echo $_smarty_tpl->tpl_vars['ccstartdate']->value;?>
" class="form-control field input-inline input-inline-100" placeholder="MM / YY (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardcardstart'),$_smarty_tpl ) );?>
)">
            </div>
        </div>
    <?php }?>
    <div class="form-group cc-details row">
        <label for="inputCardExpiry" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardcardexpires'),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-8">
            <input type="tel" name="ccexpirydate" id="inputCardExpiry" value="<?php echo $_smarty_tpl->tpl_vars['ccexpirydate']->value;?>
" class="form-control field input-inline input-inline-100" placeholder="MM / YY<?php if ($_smarty_tpl->tpl_vars['showccissuestart']->value) {?> (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardcardexpires'),$_smarty_tpl ) );?>
)<?php }?>" autocomplete="cc-exp">
            <span class="field-error-msg"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"paymentMethodsManage.expiryDateNotValid"),$_smarty_tpl ) );?>
</span>
        </div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['showccissuestart']->value) {?>
        <div class="form-group row cc-details">
            <label for="inputIssueNum" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardcardissuenum'),$_smarty_tpl ) );?>
</label>
            <div class="col-2">
                <input type="number" name="ccissuenum" id="inputIssueNum" value="<?php echo $_smarty_tpl->tpl_vars['ccissuenum']->value;?>
" class="form-control  input-inline input-inline-100" />
            </div>
        </div>
    <?php }?>
</div>
<div class="form-group row">
    <label for="inputCardCvv" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardcvvnumber'),$_smarty_tpl ) );?>
</label>
    <div class="col-sm-7">
        <input type="tel" name="cccvv" id="inputCardCvv" value="<?php echo $_smarty_tpl->tpl_vars['cccvv']->value;?>
" autocomplete="off" class="form-control input-inline input-inline-100" />
        <button id="cvvWhereLink" type="button" class="btn btn-link btn-sm" data-toggle="popover" data-content="<img src='<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/ccv.gif' width='210'>">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardcvvwhere'),$_smarty_tpl ) );?>

        </button>
        <br>
        <span class="field-error-msg"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"paymentMethodsManage.cvcNumberNotValid"),$_smarty_tpl ) );?>
</span>
    </div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/payment/billing-address.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
if ($_smarty_tpl->tpl_vars['allowClientsToRemoveCards']->value) {?>
    <div<?php if (!$_smarty_tpl->tpl_vars['addingNewCard']->value) {?> class="w-hidden"<?php }?>>
        <div class="form-group cc-details row">
            <div class="offset-sm-4 col-sm-8 text-md-right">
                <input type="hidden" name="nostore" value="1">
                <input type="checkbox" class="toggle-switch-success" data-size="mini" checked="checked" name="nostore" id="inputNoStore" value="0" data-on-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'yes'),$_smarty_tpl ) );?>
" data-off-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'no'),$_smarty_tpl ) );?>
">
                <label class="form-check form-check-inline no-padding" for="inputNoStore">
                    &nbsp;&nbsp;
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditCardStore'),$_smarty_tpl ) );?>

                </label>

            </div>
        </div>
    </div>
<?php }?>
<div<?php if (!$_smarty_tpl->tpl_vars['addingNewCard']->value) {?> class="w-hidden"<?php }?>>
    <div id="inputDescriptionContainer" class="form-group cc-details row">
        <label for="inputDescription" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'paymentMethods.cardDescription'),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputDescription" name="ccdescription" autocomplete="off" value="" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'paymentMethods.descriptionInput'),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'paymentMethodsManage.optional'),$_smarty_tpl ) );?>
" />
        </div>
    </div>
</div>

<?php }
}
