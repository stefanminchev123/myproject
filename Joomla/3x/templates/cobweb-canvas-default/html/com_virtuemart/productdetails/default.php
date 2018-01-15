<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$app = JFactory::getApplication();

$menu     = $app->getMenu();
$menuname = $menu->getActive()->title;
require_once JPATH_SITE . '/administrator/components/com_virtuemart/models/product.php';
require_once JPATH_SITE . '/administrator/components/com_virtuemart/models/manufacturer.php';
require_once JPATH_SITE . '/administrator/components/com_virtuemart/models/media.php';
$app = JFactory::getApplication();

$path = JPATH_BASE . "/templates/" . $app->getTemplate() . "/functions.php";
require_once $path;

$VirtueMartModelProduct      = new VirtueMartModelProduct;
$VirtueMartModelManufacturer = new VirtueMartModelManufacturer;
$model                       = VmModel::getModel('manufacturer');

/* Let's see if we found the product */
if (empty($this->product)) {
    echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
    echo '<br /><br />  ' . $this->continue_link_html;
    return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs');

if (vRequest::getInt('print', false)) {?>
<body onload="javascript:print();">
<?php }?>

<?php // Product Title   ?>
<h2 class="product-title-top" itemprop="name"><?php echo $menuname; ?></h2>
<?php // Product Title END   ?>

<div class="productdetails-view productdetails" >
	<?php // Back To Category Button
if ($this->product->virtuemart_category_id) {
    $catURL       = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $this->product->virtuemart_category_id, false);
    $categoryName = vmText::_($this->product->category_name);
} else {
    $catURL       = JRoute::_('index.php?option=com_virtuemart');
    $categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME');
}

if (isset($this->product->neighbours['previous'][0]['virtuemart_product_id'])) {
    $linkPrevioustProduct = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours['previous'][0]['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&Itemid=' . Product_Details_ItemID);
} else {
    $linkPrevioustProduct = '';
}

if (isset($this->product->neighbours['next'][0]['virtuemart_product_id'])) {
    $linkNextProduct = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours['next'][0]['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&Itemid=' . Product_Details_ItemID);
} else {
    $linkNextProduct = '';
}

?>
	<div class="back-to-category">
    	<a href="<?php echo $catURL ?>" class="product-details" title="<?php echo $categoryName ?>"><?php echo vmText::sprintf('<i class="fa fa-arrow-circle-left"></i> %s', $categoryName) ?></a>
        <div class="pull-right">
            <?php if ($linkPrevioustProduct): ?>
            <a href="<?php echo $linkPrevioustProduct; ?>" class="previous-product">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <?php endif;?>
            <?php if ($linkNextProduct): ?>
            <a href="<?php echo $linkNextProduct; ?>" class="next-product">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
            <?php endif;?>
        </div>
	</div>

    <?php
$m = $VirtueMartModelManufacturer->getManufacturer($this->product->virtuemart_manufacturer_id[0]);
$model->addImages($m, 1);

$_show_image = (count($this->product->virtuemart_manufacturer_id) > 0) ? $_show_image = ' <div class="logo_image"> ' . $m->images[0]->displayMediaThumb("", false) . '</div>' : '';
?>
    <div class="row vm-product-container">
    	<div class="col-md-6 col-sm-6 col-xs-12 ">
            <div class="custom_fields">
                    <div class="logo_image">
                        <?=$_show_image?>
                    </div>
                    <div class="warranty">
                        <?=getWarranty($this->product)?>
                    </div>
                    <div class="origin">
                        <?=getSource($this->product);?>
                    </div>
            </div>
            <?php
echo $this->loadTemplate('images');

$count_images = count($this->product->images);
if ($count_images > 1) {
    echo $this->loadTemplate('images_additional');
}
?>


    	</div>

    	<div class="col-md-6 col-sm-6 col-xs-12 vm-product-details-container">
            <div id="products-details-container" class="products-details-container">
    	    <div class="spacer-buy-area">
        		<div class="product-name product-name-details">
                    <h1><?php echo $this->product->product_name; ?></h1>
                </div>

                <div class="add-to-cart-container">
                    <div class="product-availability">
                        <?php
//In case you are not happy using everywhere the same price display fromat, just create your own layout
//in override /html/fields and use as first parameter the name of your file

echo shopFunctionsF::renderVmSubLayout('prices_product', array('product' => $this->product, 'currency' => $this->currency)); ?>

                    </div>
                    <div class="clearfix"></div>
                    <?php
if (strlen($this->product->allPrices[0]['costPrice']) > 0) {
    echo shopFunctionsF::renderVmSubLayout('addtocart', array('product' => $this->product, 'this' => $this));

    echo shopFunctionsF::renderVmSubLayout('stockhandle', array('product' => $this->product));
}
?>
                </div>

    			<?php
// Product Short Description
if (!empty($this->product->product_s_desc)) {
    ?>
    				<div class="product-short-description">
    					<?php

    echo nl2br($this->product->product_s_desc);
    ?>
    				</div>
    				<?php
} // Product Short Description END
?>

                <?php

// Ask a question about this product
if (VmConfig::get('ask_question', 0) == 1) {
    $askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component', false);
    ?>
    			<div class="ask-a-question">
    				<a class="ask-a-question" href="<?php echo $askquestion_url ?>" rel="nofollow" ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?></a>
    			</div>
    		<?php
}
?>

    	    </div>
    	</div>
	   <div class="clear"></div>
    </div>
    </div>

    <div class="row product-details-tabs">
        <div class="col-lg-6 col-sm-6 col-xs-12" id="set_right_content"></div>
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <?php if (strlen($this->product->product_desc) > 0): ?>
            <div id="tab1" class="tab-pane   active">
                <div class="product-description" >
                        <?php echo $this->product->product_desc; ?>
                </div>
            </div>
            <?php endif;?>

            <?php if (count($this->product->customfieldsSorted['spec']) > 0): ?>
             <div id="tab2" class="tab-pane ">
                <?php  echo $this->loadTemplate('customfields'); ?>
            </div>
            <?php endif;?>

            <?php if (count($this->product->customfieldsSorted['spec2']) > 0): ?>
            <div id="tab3" class="tab-pane ">
                 <?php echo $this->loadTemplate('customfields_spec2'); ?>
            </div>
            <?php endif;?>

            <?php if (count($this->product->customfieldsSorted['spec3']) > 0): ?>
            <div id="tab4" class="tab-pane ">
                <?php echo $this->loadTemplate('customfields_spec3'); ?>
            </div>
            <?php endif;?>
        </div>
    </div>

    <?=getProductDiscountTable($this->product)?>

	<?php

// Show child categories
if (VmConfig::get('showCategory', 1)) {
    echo $this->loadTemplate('showcategory');
}

?>
</div>


