<link rel="stylesheet" href="{$tplVar['rootURL']}/modules/addons/ticket_tag/assets/css/style.css">  
<div class="container-fluid">
  <a href="">
  <div class="menu_bar ticket-tag-menu">
    <img src="{$tplVar['rootURL']}/modules/addons/pay_to_address/assets/image/wgs-logo.svg">      
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
     {if $tplVar['Validation']['status'] == 'error'}
           <div class="alert alert-danger" role="alert">
            {$tplVar['Validation']['message']}
            </div>
           {elseif $tplVar['Validation']['status'] == 'success'}
           <div class="alert alert-success" role="alert">
            {$tplVar['Validation']['message']}
            </div>
           {/if}
      <form action="" method="post">
        <div class="form-group">
          <label for="select_currency">Select Currency</label>
          <select name="select_currency" id="select_currency" class="form-control">
            <option selected="true" disabled="disabled">ANY</option>
            {foreach from=$tplVar['currencyCode'] item=foo}
            {if $foo->id == $tplVar['exchangeCurrency']}
            <option value="{$foo->id}" selected>{$foo->code}</option>
            {else}
            <option value="{$foo->id}">{$foo->code}</option>
            {/if}
            {/foreach}
          </select>
        </div>
        <div class="form-group">
          <label for="select_country">Select Country</label>
          <select name="select_country" id="select_country" class="form-control">
            <option selected="true" disabled="disabled">ANY</option>
            {foreach $tplVar['countryCode'] as $countryCode => $countryInfo}
            {if $countryCode == $tplVar['exchangeCountry']}
            <option value="{$countryCode}" selected>{$countryInfo.name}</option>
            {else}
            <option value="{$countryCode}">{$countryInfo.name}</option>
            {/if}
            {/foreach}
          </select>
        </div>
        <input type="submit" class="btn btn-success" name="Save" value="Save">
      </form> 
    </div>
  </div>
</div>
</div>
