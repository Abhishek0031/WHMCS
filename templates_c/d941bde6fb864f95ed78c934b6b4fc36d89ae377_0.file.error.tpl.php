<?php
/* Smarty version 3.1.36, created on 2023-11-21 10:19:06
  from 'C:\xampp\htdocs\whmcs\templates\orderforms\standard_cart\error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655c760a56a3c0_60661749',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd941bde6fb864f95ed78c934b6b4fc36d89ae377' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\orderforms\\standard_cart\\error.tpl',
      1 => 1698814861,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/standard_cart/common.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories-collapsed.tpl' => 1,
  ),
),false)) {
function content_655c760a56a3c0_60661749 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/common.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div id="order-standard_cart">

    <div class="row">
        <div class="cart-sidebar">
            <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/sidebar-categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <div class="cart-body">
            <div class="header-lined">
                <h1 class="font-size-36">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['thereisaproblem'];?>

                </h1>
            </div>
            <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/sidebar-categories-collapsed.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            <div class="alert alert-danger error-heading">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo $_smarty_tpl->tpl_vars['errortitle']->value;?>

            </div>

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 offset-sm-2">

                    <p class="margin-bottom"><?php echo $_smarty_tpl->tpl_vars['errormsg']->value;?>
</p>

                    <div class="text-center">
                        <a href="javascript:history.go(-1)" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i>&nbsp;
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['problemgoback'];?>

                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php }
}
