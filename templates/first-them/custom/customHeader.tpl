<ul class="navigationMenu">     
<li class="parentMenue"><a style=  'color: #fff; margin-left: -50PX; ' href="#">WebSiteName</a></li>
  {foreach from=$menuNavBar item=navigationCustom}
  <li class="parentMenue"><a class="parentMenuAnchor"
          href="javascript:void(0)">{$navigationCustom['menu_name']}</a>
      {if $navigationCustom['sub_menu']}
      <ul class="sub_menu">
          {foreach from=$navigationCustom['sub_menu'] item=submenu}
          <li class="sub_menu_list"> 
            <a class="subMenuListMenuAnchor" href="{if isset({$submenu['child_menu']})}javascript:void(0){else}{$submenu['menu_url']}{/if} ">{$submenu['menu_name']}</a>
              {if $submenu['child_menu']}
              <ul class="child_menu">
                  {foreach from=$submenu['child_menu'] item=childmenu}
                  <li class="child_menu_list" ><a href="{$childmenu['menu_url']}">{$childmenu['menu_name']}</a></li>
                  {/foreach}
              </ul> 
              {/if}
              {/foreach}
          </li>
      </ul>
      {/if}
  </li>
  {/foreach}
</ul>

