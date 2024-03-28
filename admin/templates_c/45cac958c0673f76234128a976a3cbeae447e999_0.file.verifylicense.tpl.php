<?php
/* Smarty version 3.1.36, created on 2024-02-29 11:08:52
  from 'C:\xampp\htdocs\whmcs\modules\addons\agency_dashboard_pro\templates\admin\verifylicense.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_65e057b4224c79_40313536',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45cac958c0673f76234128a976a3cbeae447e999' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\agency_dashboard_pro\\templates\\admin\\verifylicense.tpl',
      1 => 1709201301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65e057b4224c79_40313536 (Smarty_Internal_Template $_smarty_tpl) {
?>  <link href="../modules/addons/agency_dashboard_pro/assets/css/style.css" rel="stylesheet" type="text/css" />
  <?php echo '<script'; ?>
 src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="..\modules\addons\agency_dashboard_pro\templates\admin\js\ajax.js"><?php echo '</script'; ?>
>
  <div>

    <div id="productListing">
      
    </div>
    <div class="contentMain">
     
    </div>
  </div>


<div class="lisence-verify-wrapper">
  <div class="lisence-verify-header">
      <a href="" class="lisence-verify-logo"><img src="../modules/addons/agency_dashboard_pro/assets/images/ovh-logo.png" alt=""><span>Agency Dashboard Pro</span></a>
      <div class="right-lisence-verify">
          <a href="" class="border-right-lis">Contact Us</a>
          <a href=""><img src="../modules/addons/agency_dashboard_pro/assets/images/logo-agency-portal.svg" alt=""></a>
      </div>
  </div>
  <div class="lisence-verify-box-content">
      <div class="lisence-verify-content">
          <img src="../modules/addons/agency_dashboard_pro/assets/images/lisence.png" alt="">
          <div class="lisence-verify-box">
              <div class="lisence-verify-content-right">
                  <h6>License Verification</h6>
                  <input type="text" placeholder="Enter License Key" id="licenceKey" class="lisence-input">
                  <span id="licenceKeyMSg">Please enter the license key</span>
                  <input type="submit" class="lisence-button" value="Check License" id="licsubmit">
                  
              </div>
          </div>
      </div>
  </div>
</div>














<?php }
}
