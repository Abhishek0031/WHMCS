
{include file=$tplVar.header}
<div class="innerContent licenseconfig">
  <div class="addon_inner">
    <h2 class="ad_title">About</h2>
    <div class="ad_content_sec">
      <div class="add_version_sec" id="hometabalediv">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ad_on_table">
        <tbody>
        
        <tr bgcolor="f3f8fd">
            <td>Licence</td>
            <td align="right">{$tplVar['license_key']}</td>
          </tr>
        <tr>
            <td>Status</td>
            <td align="right"><span class="license valid">{$tplVar['license_info']['status']}</span></td>
          </tr>
        <tr bgcolor="f3f8fd">
          <td class="td-color">Registered Email</td>
          <td align="right" class="td-color">{$tplVar['license_info']['email']}</td>
        </tr>
      
        <tr bgcolor="f3f8fd">
          <td>Author</td>
          <td align="right">Whmcs Global Services</td>
        </tr>
        <tr>
          <td>Product Name</td>
          <td align="right">{$tplVar['license_info']['productname']}</td>
        </tr>
        <tr>
          <td>Registration Due Date:</td>
          <td align="right">{$tplVar['license_info']['regdate']}</td>
        </tr>
        <tr>
          <td>Next Due Date:</td>
          <td align="right">{$tplVar['license_info']['nextduedate']}
          </td>
        </tr>
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
















