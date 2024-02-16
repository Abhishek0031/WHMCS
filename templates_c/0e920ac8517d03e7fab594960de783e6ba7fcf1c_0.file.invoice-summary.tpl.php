<?php
/* Smarty version 3.1.36, created on 2023-11-22 06:25:51
  from 'C:\xampp\htdocs\whmcs\templates\twenty-one\payment\invoice-summary.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655d90df4b67d0_57047820',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e920ac8517d03e7fab594960de783e6ba7fcf1c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\twenty-one\\payment\\invoice-summary.tpl',
      1 => 1698814887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d90df4b67d0_57047820 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="invoiceIdSummary" class="card">
    <div class="card-body invoice-summary">
        <h2 class="text-center">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"invoicenumber"),$_smarty_tpl ) );
if ($_smarty_tpl->tpl_vars['invoicenum']->value) {
echo $_smarty_tpl->tpl_vars['invoicenum']->value;
} else {
echo $_smarty_tpl->tpl_vars['invoiceid']->value;
}?>
        </h2>
        <div class="invoice-summary-table">
            <table class="table table-condensed">
                <tr>
                    <td class="text-center"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"invoicesdescription"),$_smarty_tpl ) );?>
</strong></td>
                    <td width="150" class="text-center"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"invoicesamount"),$_smarty_tpl ) );?>
</strong></td>
                </tr>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoiceitems']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>
</td>
                        <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['item']->value['amount'];?>
</td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <tr>
                    <td class="total-row text-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"invoicessubtotal"),$_smarty_tpl ) );?>
</td>
                    <td class="total-row text-center"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['subtotal'];?>
</td>
                </tr>
                <?php if ($_smarty_tpl->tpl_vars['invoice']->value['taxrate']) {?>
                    <tr>
                        <td class="total-row text-right"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['taxrate'];?>
% <?php echo $_smarty_tpl->tpl_vars['invoice']->value['taxname'];?>
</td>
                        <td class="total-row text-center"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['tax'];?>
</td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['invoice']->value['taxrate2']) {?>
                    <tr>
                        <td class="total-row text-right"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['taxrate2'];?>
% <?php echo $_smarty_tpl->tpl_vars['invoice']->value['taxname2'];?>
</td>
                        <td class="total-row text-center"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['tax2'];?>
</td>
                    </tr>
                <?php }?>
                <tr>
                    <td class="total-row text-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"invoicescredit"),$_smarty_tpl ) );?>
</td>
                    <td class="total-row text-center"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['credit'];?>
</td>
                </tr>
                <tr>
                    <td class="total-row text-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"invoicestotaldue"),$_smarty_tpl ) );?>
</td>
                    <td class="total-row text-center"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['total'];?>
</td>
                </tr>
            </table>
        </div>
        <div class="mb-2 text-center">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"paymentstodate"),$_smarty_tpl ) );?>
: <strong><?php echo $_smarty_tpl->tpl_vars['invoice']->value['amountpaid'];?>
</strong>
        </div>
        <div class="alert alert-success text-center m-0">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"balancedue"),$_smarty_tpl ) );?>
: <strong><?php echo $_smarty_tpl->tpl_vars['balance']->value;?>
</strong>
        </div>
    </div>
</div>
<?php }
}
