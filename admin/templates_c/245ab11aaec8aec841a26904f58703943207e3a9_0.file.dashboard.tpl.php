<?php
/* Smarty version 3.1.36, created on 2024-02-23 12:25:27
  from 'C:\xampp\htdocs\whmcs\modules\addons\exchange_currency\templates\admin\dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_65d880a75f0e52_90225306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '245ab11aaec8aec841a26904f58703943207e3a9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\modules\\addons\\exchange_currency\\templates\\admin\\dashboard.tpl',
      1 => 1708587045,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65d880a75f0e52_90225306 (Smarty_Internal_Template $_smarty_tpl) {
?><div style="float: left; width: 100%">
  <link
    href="../modules/addons/exchange_currency/assets/css/style.css"
    rel="stylesheet"
    type="text/css"
  />
  <?php echo '<script'; ?>
 src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"><?php echo '</script'; ?>
>
  <div class="bulkpricingupdater-steps">
    <div id="step1" class="active-step">Step 1<span>Choose Type</span></div>
    <div id="step2" class="">Step 2<span>Set Criteria</span></div>
    <div id="step3">Step 3<span>Review</span></div>
    <div id="step4">Step 4<span>Peform Update</span></div>
  </div>
</div>

<!-- <div class="container boxCont"> -->
<form method="post" id="frmUpdate">
  <div class="container">
    <div id="chooseType">
      <h2>Choose Type</h2>
      <p>Choose which type of product/service you would like to update pricing for.</p>
      <div class="text-center">
        <input type="button" value="Products/Services" onclick="loadStep('tblproducts')" class="btn btn-primary" id="tblproducts">
        <input type="button" value="Product Addons" onclick="loadStep('tbladdons')" class="btn btn-primary" id="tbladdons">
        <input type="button" value="Domains" onclick="loadStep('tbldomainpricing')" class="btn btn-primary" id="tbldomainpricing">
      </div>
    </div>
  </div>
<!-- </div> -->



<div id="bodyElements">
<div id="criteria-addons" style="display: none">
  <h2 id="heading"></h2>
  <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
    <tr>
      <td width="20%" class="fieldlabel">Addon Name(s)</td>
      <td class="fieldarea">
        <select
          name="addonids[]"
          class="form-control select-inline input-600"
          multiple="true"
          id="productAddon"
        >
        </select>
      </td>
    </tr>
    <tr>
      <td class="fieldlabel">Status</td>
      <td class="fieldarea">
        <select
          name="addonstatus[]"
          class="form-control select-inline"
          multiple="true"
        >
          <option selected>Pending</option>
          <option selected>Active</option>
          <option selected>Completed</option>
          <option selected>Suspended</option>
          <option>Terminated</option>
          <option>Cancelled</option>
          <option>Fraud</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="fieldlabel">Currency</td>
      <td class="fieldarea">
        <select
          name="addoncurrid"
          class="form-control select-inline"
          id="addoncurrid"
        >
        </select>
      </td>
    </tr>
  </table>
</div>


<div id="criteria-domains" style="display: block; display: none">
  <h2>Domains Criteria</h2>

  <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
    <tbody>
      <tr>
        <td width="20%" class="fieldlabel">TLD(s)</td>
        <td class="fieldarea" id="domaincheck">
        </td>
      </tr>
      <tr>
        <td class="fieldlabel">Registration Period</td>
        <td class="fieldarea">
          <select name="regperiod" class="form-control select-inline">
            <option value="1">1 Year</option>
            <option value="2">2 Years</option>
            <option value="3">3 Years</option>
            <option value="4">4 Years</option>
            <option value="5">5 Years</option>
            <option value="6">6 Years</option>
            <option value="7">7 Years</option>
            <option value="8">8 Years</option>
            <option value="9">9 Years</option>
            <option value="10">10 Years</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="fieldlabel">Status</td>
        <td class="fieldarea">
          <select
            name="domainstatus[]"
            class="form-control select-inline"
            multiple="multiple"
          >
            <option value="Pending" selected="selected">Pending</option>
            <option value="Pending Registration" selected="selected">
              Pending Registration
            </option>
            <option value="Pending Transfer" selected="selected">
              Pending Transfer
            </option>
            <option value="Active" selected="selected">Active</option>
            <option value="Grace">Grace Period (Expired)</option>
            <option value="Redemption">Redemption Period (Expired)</option>
            <option value="Expired">Expired</option>
            <option value="Transferred Away">Transferred Away</option>
            <option value="Cancelled">Cancelled</option>
            <option value="Fraud">Fraud</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="fieldlabel">Domain Addons</td>
        <td class="fieldarea">
          <label class="checkbox-inline"
            ><input
              type="checkbox"
              name="domainaddons[]"
              value="DNS Management"
            />
            DNS Management</label
          >
          <label class="checkbox-inline"
            ><input
              type="checkbox"
              name="domainaddons[]"
              value="Email Forwarding"
            />
            Email Forwarding</label
          >
          <label class="checkbox-inline"
            ><input
              type="checkbox"
              name="domainaddons[]"
              value="ID Protection"
            />
            ID Protection</label
          >
        </td>
      </tr>

      <tr>
        <td class="fieldlabel">Currency</td>
        <td class="fieldarea">
          <select name="domaincurrid" id="domaincurrid" class="form-control select-inline">
          </select>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</form>

<div id="showFooter" style="display: none">
    <p align="center">
        <input
          type="button"
          value="« Choose a Different Type"
          id="goBack"
          class="btn btn-default"
        />
        <input type="button" value="Continue »"  id="Continue" class="btn btn-success" />
      </p>
</div>
</div>
</div>







<div id="step-3" style="display: block;display: none;">
    <h2>Review</h2>
    <div id="bulkpricingupdater-review">

    </div>
    <p align="center"><input type="button" value="« Edit Criteria" class="btn" id="editCriteria"> <input type="button" value="Perform Update »" class="btn btn-danger" id="performUpdate"><br/>Warning: This action cannot be undone.</p>
</div>





<?php echo '<script'; ?>
 src="..\modules\addons\exchange_currency\templates\admin\js\ajax.js"><?php echo '</script'; ?>
>

<?php }
}
