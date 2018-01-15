<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$product = $viewData['product'];

if(isset($viewData['rowHeights'])){
    $rowHeights = $viewData['rowHeights'];
} else {
    $rowHeights['customfields'] = TRUE;
}

$init = 1;
if(isset($viewData['init'])){
    $init = $viewData['init'];
}

if(!empty($product->min_order_level) and $init<$product->min_order_level){
    $init = $product->min_order_level;
}

$step=1;
if (!empty($product->step_order_level)){
    $step=$product->step_order_level;
    if(!empty($init)){
        if($init<$step){
            $init = $step;
        } else {
            $init = ceil($init/$step) * $step;

        }
    }
    if(empty($product->min_order_level) and !isset($viewData['init'])){
        $init = $step;
    }
}

$maxOrder= '';
if (!empty($product->max_order_level)){
    $maxOrder = ' max="'.$product->max_order_level.'" ';
}

$addtoCartButton = '';
if(!VmConfig::get('use_as_catalog', 0)){
    if(!$product->addToCartButton and $product->addToCartButton!==''){
        $addtoCartButton = shopFunctionsF::getAddToCartButton ($product->orderable);
    } else {
        $addtoCartButton = $product->addToCartButton;
    }

}
$position = 'addtocart';

if (!VmConfig::get('use_as_catalog', 0)  ) { ?>

    <div class="addtocart-bar">
    <?php
    // Display the quantity box
    $stockhandle = VmConfig::get ('stockhandle', 'none');
    if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($product->product_in_stock - $product->product_ordered) < 1) { ?>
        <a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>" class="notify"><?php echo vmText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a><?php
    } else {
        $tmpPrice = (float) $product->prices['costPrice'];
        if (!( VmConfig::get('askprice', true) and empty($tmpPrice) ) ) { ?>

            <input type="hidden" class="quantity-input js-recalculate product-quantity form-control input-sm"
                                    name="quantity[]"
                                    data-errStr="<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED')?>"
                                    value="<?php echo $init; ?>" init="<?php echo $init; ?>" step="<?php echo $step; ?>" <?php echo $maxOrder; ?> />

            <?php if(!empty($addtoCartButton)){ ?>
                <span class="addtocart-button order-button">
                    <?php echo $addtoCartButton ?>
                </span>
            <?php } ?>

            <a href="<?php echo $product->link  . '&Itemid=' . Product_Details_ItemID; ?>" class="item-quick-view"><i class="icon-zoom-in2"></i><span style="text-transform: uppercase"><?= JText::_('COM_VIRTUEMART_PRODUCTS_LISTINGS_DETAILS'); ?></span></a>
            <input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
            <div class="clr"></div>
            <noscript><input type="hidden" name="task" value="add"/></noscript> <?php
        }
    } ?>

    </div><?php
} ?>
