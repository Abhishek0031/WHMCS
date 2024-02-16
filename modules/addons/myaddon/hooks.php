<?php
 
 use WHMCS\Module\Addon\MyAddon\Class\mymodule as classIntialHook;

add_hook('ClientAreaPage', 1, function($vars) {
 
    global $smarty;
    $testvariable = "alpha23";
        require_once(__DIR__.'/class/class.php');
    $intitalizeClass = new classIntialHook();
    $menuData = $intitalizeClass->dynamicNavMenue();
        // echo '<pre>';
        // print_r($menuData);
        // echo '</pre>';

    $smarty->assign("menuNavBar",$menuData);
    $smarty->assign("testedsprash",$testvariable);
});
 