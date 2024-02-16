<?php
/* Smarty version 3.1.36, created on 2023-11-16 13:53:16
  from 'C:\xampp\htdocs\whmcs\templates\first-them\custom\customHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655610bc47f8a1_38791525',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e1b45fa94295999a2f4a4af4d5857e1bc210766' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\first-them\\custom\\customHeader.tpl',
      1 => 1700139193,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655610bc47f8a1_38791525 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="navigationMenu">     
<li class="parentMenue"><a style=  'color: #fff; margin-left: -50PX; ' href="#">WebSiteName</a></li>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuNavBar']->value, 'navigationCustom');
$_smarty_tpl->tpl_vars['navigationCustom']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['navigationCustom']->value) {
$_smarty_tpl->tpl_vars['navigationCustom']->do_else = false;
?>
  <li class="parentMenue"><a class="parentMenuAnchor"
          href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['navigationCustom']->value['menu_name'];?>
</a>
      <?php if ($_smarty_tpl->tpl_vars['navigationCustom']->value['sub_menu']) {?>
      <ul class="sub_menu">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['navigationCustom']->value['sub_menu'], 'submenu');
$_smarty_tpl->tpl_vars['submenu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['submenu']->value) {
$_smarty_tpl->tpl_vars['submenu']->do_else = false;
?>
          <li class="sub_menu_list"> 
            <a class="subMenuListMenuAnchor" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['submenu']->value['child_menu'];
$_prefixVariable1 = ob_get_clean();
if ((isset($_prefixVariable1))) {?>javascript:void(0)<?php } else {
echo $_smarty_tpl->tpl_vars['submenu']->value['menu_url'];
}?> "><?php echo $_smarty_tpl->tpl_vars['submenu']->value['menu_name'];?>
</a>
              <?php if ($_smarty_tpl->tpl_vars['submenu']->value['child_menu']) {?>
              <ul class="child_menu">
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['submenu']->value['child_menu'], 'childmenu');
$_smarty_tpl->tpl_vars['childmenu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['childmenu']->value) {
$_smarty_tpl->tpl_vars['childmenu']->do_else = false;
?>
                  <li class="child_menu_list" ><a href="<?php echo $_smarty_tpl->tpl_vars['childmenu']->value['menu_url'];?>
"><?php echo $_smarty_tpl->tpl_vars['childmenu']->value['menu_name'];?>
</a></li>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </ul> 
              <?php }?>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </li>
      </ul>
      <?php }?>
  </li>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>

<?php }
}
