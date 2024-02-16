<?php
/* Smarty version 3.1.36, created on 2024-02-05 13:35:01
  from 'C:\xampp\htdocs\whmcs\modules\addons\myaddon\templates\clienthome.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_65c0d5f55d0be2_40034194',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ef8cf98adc57ed6b2e64d7519a3ba7f4c2fef6a5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\myaddon\\templates\\clienthome.tpl',
      1 => 1700655262,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65c0d5f55d0be2_40034194 (Smarty_Internal_Template $_smarty_tpl) {
?>     <div id= 'btns'>
       <button class ="btn btn-primary" id ="tblclients">client</button>
       <button class ="btn btn-success" id ="tbldomainpricing_premium">invoice</button>
       <button class ="btn btn-info" id ="tblproducts">order</button>
    </div>
    <div id ="show" style=" text-align: center;">
        
    </div>
    <div style=" text-align: center;" id = 'content'>
        <h1>Yor Data Shows Here!!!</h1>
    </div>
  <div>
      <table class="table table-hover table-striped">
          <thead>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>
<?php echo '<script'; ?>
 src ='<?php echo $_smarty_tpl->tpl_vars['jspath']->value;?>
clickEvent.js'><?php echo '</script'; ?>
>
<?php }
}
