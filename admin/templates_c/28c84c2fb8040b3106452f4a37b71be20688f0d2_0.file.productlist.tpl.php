<?php
/* Smarty version 3.1.36, created on 2024-03-07 05:47:45
  from 'C:\xampp\htdocs\whmcs\modules\addons\agency_dashboard_pro\templates\admin\productlist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_65e946f1d932e0_20155161',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28c84c2fb8040b3106452f4a37b71be20688f0d2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\agency_dashboard_pro\\templates\\admin\\productlist.tpl',
      1 => 1709785454,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65e946f1d932e0_20155161 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tplVar']->value['header'], $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<div class="lisence-verify-wrapper">
        
    <div class="modulte-tabs-wrapper">
            <div class="module-tab-box">
                <div class="module-nav-tab">
                    <ul class="promenu">
                        
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tplVar']->value['tplProductList'], 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                            <li class="module-nav-item" id ='<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
' data-type='<?php echo $_smarty_tpl->tpl_vars['item']->value->type;?>
' data-module-name='<?php echo $_smarty_tpl->tpl_vars['item']->value->module_name;?>
'>
                                <a href="">
                                    <span>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_154_3085)">
                                        <rect width="16" height="16" fill="#F8F9FA"></rect>
                                        <path d="M14.7069 0H9.9672C9.25302 0 8.67407 0.578952 8.67407 1.29313V6.03281C8.67407 6.74699 9.25302 7.32594 9.9672 7.32594H14.7069C15.4211 7.32594 16 6.74699 16 6.03281V1.29313C16 0.578952 15.4211 0 14.7069 0Z" fill="CurrentColor"></path>
                                        <path d="M6.03281 0H1.29313C0.578952 0 0 0.578952 0 1.29313V6.03281C0 6.74699 0.578952 7.32594 1.29313 7.32594H6.03281C6.74699 7.32594 7.32594 6.74699 7.32594 6.03281V1.29313C7.32594 0.578952 6.74699 0 6.03281 0Z" fill="CurrentColor"></path>
                                        <path d="M14.7069 8.67406H9.9672C9.25302 8.67406 8.67407 9.25302 8.67407 9.96719V14.7069C8.67407 15.4211 9.25302 16 9.9672 16H14.7069C15.4211 16 16 15.4211 16 14.7069V9.96719C16 9.25302 15.4211 8.67406 14.7069 8.67406Z" fill="CurrentColor"></path>
                                        <path d="M6.03281 8.67406H1.29313C0.578952 8.67406 0 9.25302 0 9.96719V14.7069C0 15.4211 0.578952 16 1.29313 16H6.03281C6.74699 16 7.32594 15.4211 7.32594 14.7069V9.96719C7.32594 9.25302 6.74699 8.67406 6.03281 8.67406Z" fill="CurrentColor"></path>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_154_3085">
                                        <rect width="16" height="16" fill="white"></rect>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                <?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>

                                </a>
                            </li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                       
                    </ul>
                </div>
                <div class="appendProduct module-nav-Content">
                    
                </div>
                <!-- <div class="module-nav-Content">
                    <div class="proloader-wrapper">
                        <div class="proloader"></div>
                    </div>
                    <div class="module-tab-pane">
                        <div class="module-heading-bx">
                            <h3>Configuration</h3>
                            <p>A&nbsp;dashboard&nbsp;is a web page that contains&nbsp;modules&nbsp;at various positions.</p>
                        </div>
                        <form class="module-form">
                            <div class="module-form-bx">
                                <div class="module-form-field">
                                    <label>Product Name</label>
                                    <input type="text" placeholder="Enter Product Name" class="lisence-input">
                                </div>
                                <div class="module-form-field">
                                    <label>Product Name</label>
                                    <input type="text" placeholder="Enter Product Name" class="lisence-input">
                                </div>
                                <div class="module-form-field">
                                    <label>Select Product</label>
                                    <select name="Select Product" id="Select Product" class="lisence-input">
                                        <option value="Product1">Product1</option>
                                    </select>
                                    
                                </div>
                                <div class="module-form-field">
                                    <label>Select Product</label>
                                    <select name="Select Product" id="Select Product" class="lisence-input">
                                        <option value="Product1">Product1</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="module-checkbox">
                            <input type="checkbox" id="verify-product"><label for="verify-product">Verify Product</label>
                            </div>
                            <div class="module-radio-wrapper">
                                <div class="radio-box">
                                    <input id="product-enable&quot;" name="radio" type="radio" checked="">
                                    <label for="product-enable&quot;" class="radio-label">Product Enable</label>
                                </div>
                                
                                <div class="radio-box">
                                    <input id="product-disable" name="radio" type="radio">
                                    <label for="product-disable" class="radio-label">Product Disable</label>
                                </div>
                                </div>
                                <button class="lisence-button">save</button>
                        </form>
                    </div>
                </div> -->
        </div>
    </div>
</div><?php }
}
