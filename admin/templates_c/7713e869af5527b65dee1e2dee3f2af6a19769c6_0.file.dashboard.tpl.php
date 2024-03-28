<?php
/* Smarty version 3.1.36, created on 2024-03-14 10:03:59
  from 'C:\xampp\htdocs\whmcs\modules\addons\agency_dashboard_pro\templates\admin\dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_65f2bd7f1f22a4_91312344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7713e869af5527b65dee1e2dee3f2af6a19769c6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\agency_dashboard_pro\\templates\\admin\\dashboard.tpl',
      1 => 1710398936,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f2bd7f1f22a4_91312344 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tplVar']->value['header'], $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
<div class="innerContent licenseconfig">
  <div class="addon_inner">
    <h2 class="ad_title">About</h2>
    <div class="ad_content_sec">
      <div class="add_version_sec" id="hometabalediv">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ad_on_table">
        <tbody>
        
        <tr bgcolor="f3f8fd">
            <td>Licence</td>
            <td align="right"><?php echo $_smarty_tpl->tpl_vars['tplVar']->value['license_key'];?>
</td>
          </tr>
        <tr>
            <td>Status</td>
            <td align="right"><span class="license valid"><?php echo $_smarty_tpl->tpl_vars['tplVar']->value['license_info']['status'];?>
</span></td>
          </tr>
        <tr bgcolor="f3f8fd">
          <td class="td-color">Registered Email</td>
          <td align="right" class="td-color"><?php echo $_smarty_tpl->tpl_vars['tplVar']->value['license_info']['email'];?>
</td>
        </tr>
      
        <tr bgcolor="f3f8fd">
          <td>Author</td>
          <td align="right">Whmcs Global Services</td>
        </tr>
        <tr>
          <td>Product Name</td>
          <td align="right"><?php echo $_smarty_tpl->tpl_vars['tplVar']->value['license_info']['productname'];?>
</td>
        </tr>
        <tr>
          <td>Registration Due Date:</td>
          <td align="right"><?php echo $_smarty_tpl->tpl_vars['tplVar']->value['license_info']['regdate'];?>
</td>
        </tr>
        <tr>
          <td>Next Due Date:</td>
          <td align="right"><?php echo $_smarty_tpl->tpl_vars['tplVar']->value['license_info']['nextduedate'];?>

          </td>
        </tr>
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
















<?php }
}
