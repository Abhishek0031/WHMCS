<?php
/* Smarty version 3.1.36, created on 2023-11-21 12:52:34
  from 'C:\xampp\htdocs\whmcs\templates\orderforms\universal_slider\products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_655c9a02bbc285_76020636',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '227d0b300c5de446280744939b9b1a303a8deb11' => 
    array (
      0 => 'C:\\xampp\\htdocs\\whmcs\\templates\\orderforms\\universal_slider\\products.tpl',
      1 => 1698814863,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/standard_cart/sidebar-categories.tpl' => 1,
    'file:orderforms/universal_slider/recommendations-modal.tpl' => 1,
  ),
),false)) {
function content_655c9a02bbc285_76020636 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Product Recommendations CSS -->
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_CSS']->value;?>
/recommendations.min.css" property="stylesheet" />
<!-- Core CSS -->
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_CSS']->value;?>
/normalize.css" property="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['assetPath'][0], array( array('file'=>"ion.rangeSlider.css"),$_smarty_tpl ) );?>
" property="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['assetPath'][0], array( array('file'=>"ion.rangeSlider.skinHTML5.css"),$_smarty_tpl ) );?>
" property="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['assetPath'][0], array( array('file'=>"style.css"),$_smarty_tpl ) );?>
" property="stylesheet">
<?php if ($_smarty_tpl->tpl_vars['showSidebarToggle']->value) {?>
    <button type="button" class="btn btn-default btn-sm" id="btnShowSidebar">
        <i class="fas fa-arrow-circle-right"></i>
        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['showMenu'];?>

    </button>
<?php }?>

<div class="row row-product-selection">
    <div class="col-md-3 sidebar product-selection-sidebar" id="universalSliderSidebar">
        <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/sidebar-categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
    <div class="col-md-12">

        <div id="order-universal_slider">
            <div class="group-headlines">
                <h2 id="headline">
                    <?php if ($_smarty_tpl->tpl_vars['productGroup']->value['headline']) {?>
                        <?php echo $_smarty_tpl->tpl_vars['productGroup']->value['headline'];?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['productGroup']->value['name'];?>

                    <?php }?>
                </h2>
                <?php if ($_smarty_tpl->tpl_vars['productGroup']->value['tagline']) {?>
                    <h5 id="tagline">
                        <?php echo $_smarty_tpl->tpl_vars['productGroup']->value['tagline'];?>

                    </h5>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
                    <div class="alert alert-danger">
                        <?php echo $_smarty_tpl->tpl_vars['errormessage']->value;?>

                    </div>
                <?php } elseif (!$_smarty_tpl->tpl_vars['productGroup']->value) {?>
                    <div class="alert alert-info">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'orderForm.selectCategory'),$_smarty_tpl ) );?>

                    </div>
                <?php }?>
            </div>

            <div class="striped-container clearfix py-1">

                <div class="main-container">

                    <?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
                        <div class="product-selector">
                            <input type="text" id="product-selector" name="product-selector" value=""  title="product-selector"/>
                        </div>
                    <?php }?>

                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product', false, 'key');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                        <?php $_smarty_tpl->_assignInScope('idPrefix', $_smarty_tpl->tpl_vars['product']->value['bid'] ? (("bundle").($_smarty_tpl->tpl_vars['product']->value['bid'])) : (("product").($_smarty_tpl->tpl_vars['product']->value['pid'])));?>
                        <div id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-container" class="product-container">
                            <div id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-feature-container" class="feature-container">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['features'], 'value', false, 'feature');
$_smarty_tpl->tpl_vars['value']->iteration = 0;
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
$_smarty_tpl->tpl_vars['value']->iteration++;
$__foreach_value_1_saved = $_smarty_tpl->tpl_vars['value'];
?>
                                                <?php $_smarty_tpl->_assignInScope('currentPercentages', $_smarty_tpl->tpl_vars['featurePercentages']->value[$_smarty_tpl->tpl_vars['feature']->value]);?>
                                                <div id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-feature<?php echo $_smarty_tpl->tpl_vars['value']->iteration;?>
" class="col-sm-3 container-with-progress-bar text-center">
                                                    <?php echo $_smarty_tpl->tpl_vars['feature']->value;?>

                                                    <span><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</span>
                                                    <div class="progress small-progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $_smarty_tpl->tpl_vars['currentPercentages']->value[$_smarty_tpl->tpl_vars['key']->value];?>
" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $_smarty_tpl->tpl_vars['currentPercentages']->value[$_smarty_tpl->tpl_vars['key']->value];?>
%;">
                                                            <span class="sr-only"><?php echo $_smarty_tpl->tpl_vars['currentPercentages']->value[$_smarty_tpl->tpl_vars['key']->value];?>
% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </div>
                                    </div>
                                    <div id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-price" class="col-md-3 hidden-sm d-none d-md-block">
                                        <div class="price-container container-with-progress-bar text-center">
                                            <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderprice'];?>

                                            <span class="price-cont">
                                                <?php if ($_smarty_tpl->tpl_vars['product']->value['bid']) {?>
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['bundledeal'];?>

                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['displayprice']) {?>
                                                        <br /><br /><span><?php echo $_smarty_tpl->tpl_vars['product']->value['displayPriceSimple'];?>
</span>
                                                    <?php }?>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['paytype'] == "free") {?>
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderfree'];?>

                                                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['paytype'] == "onetime") {?>
                                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['onetime'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermonetime'];?>

                                                <?php } else { ?>
                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['hasconfigoptions']) {?>
                                                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['from'];?>

                                                    <?php }?>
                                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycleText'];?>

                                                    <br>
                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['setupFee']) {?>
                                                        <small><?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['setupFee']->toPrefixed();?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersetupfee'];?>
</small>
                                                    <?php }?>
                                                <?php }?>
                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['qty'] == "0") {?>
                                                <span id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-unavailable" class="order-button unavailable">
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['outofstock'];?>

                                                </span>
                                            <?php } else { ?>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['productUrl'];?>
" class="order-button" id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-order-button"<?php if ($_smarty_tpl->tpl_vars['product']->value['hasRecommendations']) {?> data-has-recommendations="1"<?php }?>>
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordernowbutton'];?>

                                                </a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-description" class="product-description">
                                <div class="row">
                                    <div class="col-sm-9 col-md-12">
                                        <?php if (count($_smarty_tpl->tpl_vars['product']->value['features']) > 0) {?>
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['featuresdesc']) {?>
                                                <?php echo $_smarty_tpl->tpl_vars['product']->value['featuresdesc'];?>

                                            <?php }?>
                                        <?php } else { ?>
                                            <?php echo $_smarty_tpl->tpl_vars['product']->value['description'];?>

                                        <?php }?>
                                    </div>
                                    <div class="col-sm-3 visible-sm d-block d-md-none">
                                        <div id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-price-small" class="price-container container-with-progress-bar text-center">
                                            <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderprice'];?>

                                            <span class="price-cont">
                                                <?php if ($_smarty_tpl->tpl_vars['product']->value['bid']) {?>
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['bundledeal'];?>

                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['displayprice']) {?>
                                                        <br /><br /><span><?php echo $_smarty_tpl->tpl_vars['product']->value['displayPriceSimple'];?>
</span>
                                                    <?php }?>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['paytype'] == "free") {?>
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderfree'];?>

                                                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['paytype'] == "onetime") {?>
                                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['onetime'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermonetime'];?>

                                                <?php } else { ?>
                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['hasconfigoptions']) {?>
                                                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['from'];?>

                                                    <?php }?>
                                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycleText'];?>

                                                    <br>
                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['setupFee']) {?>
                                                        <small><?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['setupFee'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersetupfee'];?>
</small>
                                                    <?php }?>
                                                <?php }?>
                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['qty'] == "0") {?>
                                                <span id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-unavailable" class="order-button unavailable">
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['outofstock'];?>

                                            </span>
                                            <?php } else { ?>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['productUrl'];?>
" class="order-button" id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-order-button"<?php if ($_smarty_tpl->tpl_vars['product']->value['hasRecommendations']) {?> data-has-recommendations="1"<?php }?>>
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordernowbutton'];?>

                                                </a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>

            <?php if (count($_smarty_tpl->tpl_vars['productGroup']->value['features']) > 0) {?>
                <div class="group-features">
                    <div class="title">
                        <span class="primary-bg-color">
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['includedWithPlans'];?>

                        </span>
                    </div>
                    <ul class="list-features">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productGroup']->value['features'], 'features');
$_smarty_tpl->tpl_vars['features']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['features']->value) {
$_smarty_tpl->tpl_vars['features']->do_else = false;
?>
                            <li><?php echo $_smarty_tpl->tpl_vars['features']->value['feature'];?>
</li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                </div>
            <?php }?>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:orderforms/universal_slider/recommendations-modal.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['assetPath'][0], array( array('file'=>"ion.rangeSlider.js"),$_smarty_tpl ) );?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready(function(){
        var products = [],
            productList = [],
            startFrom = 0,
            startValue = null;
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            products['<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
'] = '<?php echo $_smarty_tpl->tpl_vars['product']->value['bid'] ? (("bundle").($_smarty_tpl->tpl_vars['product']->value['bid'])) : (("product").($_smarty_tpl->tpl_vars['product']->value['pid']));?>
';
            productList.push('<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
');
            <?php if ($_smarty_tpl->tpl_vars['pid']->value) {?>
                <?php if (($_smarty_tpl->tpl_vars['pid']->value == $_smarty_tpl->tpl_vars['product']->value['pid'])) {?>
                    startValue = '<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
';
                    startFrom = productList.indexOf('<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
');
                <?php }?>
            <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['isFeatured'] && !(isset($_smarty_tpl->tpl_vars['featuredProduct']->value))) {?>
                    <?php $_smarty_tpl->_assignInScope('featuredProduct', true);?>
                    startValue = '<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
';
                    startFrom = productList.indexOf('<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
');
                <?php }?>
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        jQuery("#product-selector").ionRangeSlider({
            type: "single",
            min: 1,
            max: <?php echo count($_smarty_tpl->tpl_vars['products']->value);?>
,
            step: 1,
            grid: true,
            grid_snap: true,
            keyboard: true,
            from: startFrom,
            <?php if (count($_smarty_tpl->tpl_vars['products']->value) == 1) {?>
                disable: true,
            <?php } else { ?>
                onStart: function(data)
                {
                    if (startValue !== null) {
                        changeProduct(startValue);
                    } else {
                        changeProduct(data.from_value);
                    }

                },
                onChange: function (data)
                {
                    changeProduct(data.from_value);
                },
            <?php }?>
            values: productList
        });

        function changeProduct(productName) {
            var identifier = products[productName];
            jQuery(".product-container").hide();
            jQuery("#" + identifier + "-container").show();
        }

        <?php if (count($_smarty_tpl->tpl_vars['products']->value) == 1) {?>
            jQuery(".irs-single").text(productList[0]);
            jQuery(".irs-grid-text").text('');
        <?php }?>

        jQuery('#btnShowSidebar').click(function() {
            var productSidebar = jQuery(".product-selection-sidebar");
            if (productSidebar.is(":visible")) {
                jQuery('.row-product-selection').css('left','0');
                productSidebar.fadeOut();
                jQuery('#btnShowSidebar').html('<i class="fas fa-arrow-circle-right"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['showMenu'];?>
');
            } else {
                productSidebar.fadeIn();
                jQuery('.row-product-selection').css('left','300px');
                jQuery('#btnShowSidebar').html('<i class="fas fa-arrow-circle-left"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['hideMenu'];?>
');
            }
        });
    });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/whmcs/recommendations.min.js"><?php echo '</script'; ?>
>
<?php }
}
