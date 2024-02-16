<?php
/* Smarty version 3.1.36, created on 2023-11-21 05:21:56
  from 'C:\xampp\htdocs\whmcs\modules\addons\myaddon\templates\clienthome2.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655c306450a011_17774056',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '600804bf538e2fd695be34bcbaf5b3f7c13ab544' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\myaddon\\templates\\clienthome2.tpl',
      1 => 1700540361,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655c306450a011_17774056 (Smarty_Internal_Template $_smarty_tpl) {
?><body>

    <div id= 'btns'>
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
 src ='modules\addons\myaddon\templates\js\clickEvent.js'><?php echo '</script'; ?>
>
    
</body><?php }
}
