<?php
/* Smarty version 3.1.36, created on 2023-11-22 06:25:51
  from 'C:\xampp\htdocs\whmcs\templates\twenty-one\payment\billing-address.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655d90df4912f2_67398146',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6089521c37c40e0e7e9c0e457ee88557168bfcd8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\twenty-one\\payment\\billing-address.tpl',
      1 => 1698814887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d90df4912f2_67398146 (Smarty_Internal_Template $_smarty_tpl) {
?><div<?php if (!$_smarty_tpl->tpl_vars['addingNew']->value) {?> class="w-hidden"<?php }?>>
    <div class="form-group row" id="billingAddressChoice">
        <label class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'billingAddress'),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-8">
            <label class="billing-contact-0">
                <input
                        type="radio"
                        class="icheck-button"
                        name="billingcontact"
                        value="0"
                        <?php if (!$_smarty_tpl->tpl_vars['billingContact']->value) {?> checked<?php }?>
                >

                <strong class="name"><?php echo $_smarty_tpl->tpl_vars['client']->value->fullName;?>
</strong>
                <span class="address1"><?php echo $_smarty_tpl->tpl_vars['client']->value->address1;?>
</span>,
                <?php if ($_smarty_tpl->tpl_vars['client']->value->address2) {?><span class="address2"><?php echo $_smarty_tpl->tpl_vars['client']->value->address2;?>
</span>,<?php }?>
                <span class="city"><?php echo $_smarty_tpl->tpl_vars['client']->value->city;?>
</span>,
                <span class="state"><?php echo $_smarty_tpl->tpl_vars['client']->value->state;?>
</span>,
                <span class="postcode"><?php echo $_smarty_tpl->tpl_vars['client']->value->postcode;?>
</span>,
                <span class="country"><?php echo $_smarty_tpl->tpl_vars['client']->value->country;?>
</span>
            </label>
            <br>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['client']->value->contacts()->orderBy('firstname','asc')->orderBy('lastname','asc')->get(), 'contact');
$_smarty_tpl->tpl_vars['contact']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['contact']->value) {
$_smarty_tpl->tpl_vars['contact']->do_else = false;
?>
                <label class="billing-contact-<?php echo $_smarty_tpl->tpl_vars['contact']->value->id;?>
">
                    <input
                            type="radio"
                            class="icheck-button"
                            name="billingcontact"
                            value="<?php echo $_smarty_tpl->tpl_vars['contact']->value->id;?>
"
                            <?php if ($_smarty_tpl->tpl_vars['billingContact']->value == $_smarty_tpl->tpl_vars['contact']->value->id) {?> checked<?php }?>
                    >

                    <strong class="name"><?php echo $_smarty_tpl->tpl_vars['contact']->value->fullName;?>
</strong>
                    <span class="text-truncate">
                        <span class="address1"><?php echo $_smarty_tpl->tpl_vars['contact']->value->address1;?>
</span>,
                        <?php if ($_smarty_tpl->tpl_vars['contact']->value->address2) {?><span class="address2"><?php echo $_smarty_tpl->tpl_vars['contact']->value->address2;?>
</span>,<?php }?>
                        <span class="city"><?php echo $_smarty_tpl->tpl_vars['contact']->value->city;?>
</span>,
                        <span class="state"><?php echo $_smarty_tpl->tpl_vars['contact']->value->state;?>
</span>,
                        <span class="postcode"><?php echo $_smarty_tpl->tpl_vars['contact']->value->postcode;?>
</span>,
                        <span class="country"><?php echo $_smarty_tpl->tpl_vars['contact']->value->country;?>
</span>
                    </span>
                </label>
                <br>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <label>
                <input
                        type="radio"
                        class="icheck-button"
                        name="billingcontact"
                        value="new"
                        <?php if ($_smarty_tpl->tpl_vars['billingContact']->value === 'new') {?> checked<?php }?>
                >
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'paymentMethodsManage.addNewBillingAddress'),$_smarty_tpl ) );?>

            </label>
        </div>
    </div>
</div>
<div<?php if (!$_smarty_tpl->tpl_vars['userDetailsValidationError']->value && $_smarty_tpl->tpl_vars['billingcontact']->value !== 'new') {?> class="w-hidden"<?php }?>>
    <div id="newBillingAddress">
        <div class="form-group row cc-billing-address">
            <label for="inputFirstName" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareafirstname'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <input type="text" name="firstname" id="inputFirstName" value="<?php echo $_smarty_tpl->tpl_vars['firstname']->value;?>
" class="form-control" />
            </div>
        </div>
        <div class="form-group row cc-billing-address">
            <label for="inputLastName" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientarealastname'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <input type="text" name="lastname" id="inputLastName" value="<?php echo $_smarty_tpl->tpl_vars['lastname']->value;?>
" class="form-control" />
            </div>
        </div>
        <div class="form-group row cc-billing-address">
            <label for="inputAddress1" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareaaddress1'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <input type="text" name="address1" id="inputAddress1" value="<?php echo $_smarty_tpl->tpl_vars['address1']->value;?>
" class="form-control" />
            </div>
        </div>
        <div class="form-group row cc-billing-address">
            <label for="inputAddress2" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareaaddress2'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <input type="text" name="address2" id="inputAddress2" value="<?php echo $_smarty_tpl->tpl_vars['address2']->value;?>
" class="form-control" />
            </div>
        </div>
        <div class="form-group row cc-billing-address">
            <label for="inputCity" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareacity'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <input type="text" name="city" id="inputCity" value="<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
" class="form-control" />
            </div>
        </div>
        <div class="form-group row cc-billing-address">
            <label for="inputState" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareastate'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <input type="text" name="state" id="inputState" value="<?php echo $_smarty_tpl->tpl_vars['state']->value;?>
" class="form-control" data-custom-select/>
            </div>
        </div>
        <div class="form-group row cc-billing-address">
            <label for="inputPostcode" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareapostcode'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <input type="text" name="postcode" id="inputPostcode" value="<?php echo $_smarty_tpl->tpl_vars['postcode']->value;?>
" class="form-control" />
            </div>
        </div>
        <div class="form-group row cc-billing-address">
            <label for="inputCountry" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareacountry'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <select id="country" name="country" class="custom-select">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countries']->value, 'countryName', false, 'countryCode');
$_smarty_tpl->tpl_vars['countryName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['countryCode']->value => $_smarty_tpl->tpl_vars['countryName']->value) {
$_smarty_tpl->tpl_vars['countryName']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['countryCode']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['countryCode']->value == $_smarty_tpl->tpl_vars['country']->value) {?> selected="selected"<?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['countryName']->value;?>

                        </option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
        </div>
        <div class="form-group row cc-billing-address">
            <label for="inputPhone" class="col-sm-4 text-md-right col-form-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientareaphonenumber'),$_smarty_tpl ) );?>
</label>
            <div class="col-sm-6">
                <input type="text" name="phonenumber" id="inputPhone" value="<?php echo $_smarty_tpl->tpl_vars['phonenumber']->value;?>
" class="form-control" />
            </div>
        </div>
    </div>
</div>
<?php }
}
