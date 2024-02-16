<?php
/* Smarty version 3.1.36, created on 2024-01-25 07:10:31
  from 'C:\xampp\htdocs\whmcs\modules\addons\currency_Exchange\templates\admin\dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_65b1fb575ea8a0_41298792',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49d4e1458fe1e15bee24686bf4d39b333e168aed' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\currency_Exchange\\templates\\admin\\dashboard.tpl',
      1 => 1706163028,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65b1fb575ea8a0_41298792 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplVar']->value['rootURL'];?>
/modules/addons/ticket_tag/assets/css/style.css">  
<div class="container-fluid">
  <a href="">
  <div class="menu_bar ticket-tag-menu">
    <img src="https://whmcs81.shinedezign.pro/modules/addons/affiliate/images/wgs-logo.svg">      
    <ul>
      <li class="active"><a href="">
        <span class="glyphicon glyphicon-cog"></span>
      Setting</li>
    </ul>
  </div>
  </div>
</a>
  
<br/>
<div class="container">
  <div class="col-sm-12 auto-m d-block">
    <div class="box ticket-tag-box">
     <?php if ($_smarty_tpl->tpl_vars['tplVar']->value['Validation']['status'] == 'error') {?>
           <div class="alert alert-danger" role="alert">
            <?php echo $_smarty_tpl->tpl_vars['tplVar']->value['Validation']['message'];?>

            </div>
          
           <?php } elseif ($_smarty_tpl->tpl_vars['tplVar']->value['Validation']['status'] == 'success') {?>
           <div class="alert alert-success" role="alert">
            <?php echo $_smarty_tpl->tpl_vars['tplVar']->value['Validation']['message'];?>

            </div>
           <?php }?>
      <form action="" method="post">
        <div class="form-group">
          <label for="select_currency">Select Currency</label>
          <select name="select_currency" id="select_currency" class="form-control">
            <option selected="true" disabled="disabled">ANY</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tplVar']->value['currencyCode'], 'foo');
$_smarty_tpl->tpl_vars['foo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$_smarty_tpl->tpl_vars['foo']->do_else = false;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value->suffix;?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </select>
        </div>
        <div class="form-group">
          <label for="select_country">Select Country</label>
          <select name="select_country" id="select_country" class="form-control">
            <option selected="true" disabled="disabled">ANY</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tplVar']->value['countryCode'], 'countryInfo', false, 'countryCode');
$_smarty_tpl->tpl_vars['countryInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['countryCode']->value => $_smarty_tpl->tpl_vars['countryInfo']->value) {
$_smarty_tpl->tpl_vars['countryInfo']->do_else = false;
?>

            <option value="<?php echo $_smarty_tpl->tpl_vars['countryCode']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['countryInfo']->value['name'];?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </select>
        </div>
        <input type="submit" class="btn btn-success" name="Save" value="Save">
      </form> 
    </div>
  </div>
</div>
</div>
<?php }
}
