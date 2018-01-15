<?php
/*
# ------------------------------------------------------------------------
# Vina Product Carousel for VirtueMart for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum: http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.modal');
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$doc->addScript('modules/' . $module->module . '/assets/js/owl.carousel.js', 'text/javascript');
$doc->addStyleSheet('modules/' . $module->module . '/assets/css/owl.carousel.css');
$doc->addStyleSheet('modules/' . $module->module . '/assets/css/owl.theme.css');
$doc->addStyleSheet('modules/' . $module->module . '/assets/css/custom.css');

// Timthumb Class Path
$timthumb = 'modules/'.$module->module.'/libs/timthumb.php?a=c&amp;q=99&amp;z=0&amp;w='.$imageWidth.'&amp;h='.$imageHeight;
$timthumb = JURI::base() . $timthumb;

vmJsApi::jPrice();

require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/product.php');
require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/manufacturer.php');
require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/media.php');

$path = JPATH_BASE."/templates/". $app->getTemplate() ."/functions.php";
require_once ($path);

$customFields = new VirtueMartModelCustomfields;
$VirtueMartModelProduct = new VirtueMartModelProduct;
$VirtueMartModelManufacturer = new VirtueMartModelManufacturer;

$model = VmModel::getModel('manufacturer');


$col = 1;
$pwidth = ' width' . floor (100 / $products_per_row);
if ($products_per_row > 1) {
    $float = "floatleft";
} else {
    $float = "center";
}


?>

<!-- CSS Block -->
<style type="text/css">
#vina-carousel-virtuemart<?php echo $module->id; ?> {
    width: <?php echo $moduleWidth; ?>;
    height: <?php echo $moduleHeight; ?>;
    margin: <?php echo $moduleMargin; ?>;
    padding: <?php echo $modulePadding; ?>;
    <?php echo ($bgImage != '') ? "background: url({$bgImage}) repeat scroll 0 0;" : ''; ?>
    <?php echo ($isBgColor) ? "background-color: {$bgColor};" : '';?>
    overflow: hidden;
}
#vina-carousel-virtuemart<?php echo $module->id; ?> .item {
    <?php echo ($isItemBgColor) ? "background-color: {$itemBgColor};" : ""; ?>;
    color: <?php echo $itemTextColor; ?>;
    padding: <?php echo $itemPadding; ?>;
    margin: <?php echo $itemMargin; ?>;
}
#vina-carousel-virtuemart<?php echo $module->id; ?> .item a {
    color: <?php echo $itemLinkColor; ?>;
}
</style>

<!-- HTML Block -->
<div id="vina-carousel-virtuemart<?php echo $module->id; ?>" class="vina-carousel-virtuemart owl-carousel <?php echo $classSuffix; ?>">
    <?php
        $totalRow  = $itemInCol;
        $totalLoop = ceil(count($products)/$totalRow);
        $keyLoop   = 0;
        for($i = 0; $i < $totalLoop; $i ++) :
    ?>
        <?php
        for($m = 0; $m < $totalRow; $m ++) :
            $product = $products[$keyLoop];
            $keyLoop = $keyLoop + 1;
            if(!empty($product)) :
        ?>
        <?php
            $image  = $product->images[0];
            $pImage = (!empty($image)) ? JURI::base() . $image->file_url : '';
            $pImage = (!empty($pImage) && $resizeImage) ? $timthumb . '&amp;src=' . $pImage : $pImage;
            $pLink  = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id);
            $pName  = $product->product_name;
            $rating = shopFunctionsF::renderVmSubLayout('rating', array('showRating' => $productRating, 'product' => $product));
            $sDesc  = $product->product_s_desc;
            $pDesc  = (!empty($sDesc)) ? shopFunctionsF::limitStringByWord($sDesc, 60, ' ...') : '';
            $detail = JHTML::link($pLink, vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS'), array('title' => $pName, 'class' => 'product-details'));
            $stock  = $productModel->getStockIndicator($product);
            $sLevel = $stock->stock_level;
            $sTip   = $stock->stock_tip;
            $handle = shopFunctionsF::renderVmSubLayout('stockhandle', array('product' => $product));
            $pPrice = shopFunctionsF::renderVmSubLayout('prices', array('product' => $product, 'currency' => $currency));
            $sPrice = $currency->createPriceDiv('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
            $dPrice = $currency->createPriceDiv('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
        ?>

        <?php

                $m = $VirtueMartModelManufacturer->getManufacturer( $product->virtuemart_manufacturer_id[0] );
                $model->addImages($m,1);


                $_show_image = ( count( $product->virtuemart_manufacturer_id ) > 0 ) ? $_show_image = ' <div class="logo_image"> '. $m->images[0]->displayMediaThumb("",false) .'</div>' : '';

            ?>

        <div class="simpleBorder <?= $pwidth ?> <?= $float ?>">
                <div class="spacer">

                    <?php if(strlen($_show_image) > 0 || strlen(getWarranty( $product )) > 0 || strlen(getSource( $product )) > 0): ?>
                    <div class="custom_fields">
                        <?php if(strlen($_show_image) > 0): ?>
                            <?= $_show_image ?>
                        <?php endif; ?>

                        <?php if(strlen(getWarranty( $product )) > 0): ?>
                        <div class="product_warranty">
                            <?= getWarranty( $product ); ?>
                        </div>
                        <?php endif; ?>

                        <?php if(strlen(getSource( $product )) > 0): ?>
                        <div class="origin">
                            <?= getSource( $product ); ?>
                        </div>
                        <?php endif; ?>

                    </div>
                    <?php endif; ?>

                    <?php

                    if (!empty($product->images[0])) {
                        $image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0"', FALSE);
                    } else {
                        $image = '';
                    }
                    echo '<div class="simple_image">';
                    echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name));
                    echo '</div>';
                    echo '<div class="clear"></div>';
                    echo '<div class="product_title">';
                    echo '<h3>' . JHtml::link ($product->link.$ItemidStr, $product->product_name) .'</h3>';
                    echo '</div>';
//                  $url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .$product->virtuemart_category_id); ?>
<!--                    <a href="--><?php //echo $url ?><!--" class="product-name">--><?php //echo $product->product_name; ?><!--</a>        -->
                    <?php    echo '<div class="clear"></div>';
                    echo '<div class="productdetails">';

                    if($productPrice) : ?>
                    <?php
                        echo '<div class="product-price">';
                        echo shopFunctionsF::renderVmSubLayout('prices_listing',array('product'=>$product,'currency'=>$currency));
                        echo '</div>';
                    endif;

                    echo '<div class="clear"></div>';
                    echo '</div>';
                    ?>

                </div>
            </div>
        <?php endif; endfor; ?>
    <?php endfor; ?>
</div>

<!-- Javascript Block -->
<script type="text/javascript">
jQuery(document).ready(function($) {
    $("#vina-carousel-virtuemart<?php echo $module->id; ?>").owlCarousel({
        items :             <?php echo $itemsVisible; ?>,
        itemsDesktop :      <?php echo $itemsDesktop; ?>,
        itemsDesktopSmall : <?php echo $itemsDesktopSmall; ?>,
        itemsTablet :       <?php echo $itemsTablet; ?>,
        itemsTabletSmall :  <?php echo $itemsTabletSmall; ?>,
        itemsMobile :       <?php echo $itemsMobile; ?>,
        singleItem :        <?php echo ($singleItem) ? 'true' : 'false'; ?>,
        itemsScaleUp :      <?php echo ($itemsScaleUp) ? 'true' : 'false'; ?>,

        slideSpeed :        <?php echo $slideSpeed; ?>,
        paginationSpeed :   <?php echo $paginationSpeed; ?>,
        rewindSpeed :       <?php echo $rewindSpeed; ?>,

        autoPlay :      <?php echo $autoPlay; ?>,
        stopOnHover :   <?php echo ($stopOnHover) ? 'true' : 'false'; ?>,

        navigation :    <?php echo ($navigation) ? 'true' : 'false'; ?>,
        rewindNav :     <?php echo ($rewindNav) ? 'true' : 'false'; ?>,
        scrollPerPage : <?php echo ($scrollPerPage) ? 'true' : 'false'; ?>,

        pagination :        <?php echo ($pagination) ? 'true' : 'false'; ?>,
        paginationNumbers : <?php echo ($paginationNumbers) ? 'true' : 'false'; ?>,

        responsive :    <?php echo ($responsive) ? 'true' : 'false'; ?>,
        autoHeight :    <?php echo ($autoHeight) ? 'true' : 'false'; ?>,
        mouseDrag :     <?php echo ($mouseDrag) ? 'true' : 'false'; ?>,
        touchDrag :     <?php echo ($touchDrag) ? 'true' : 'false'; ?>,
        leftOffSet:     <?php echo $leftOffSet; ?>,
    });
});
</script>