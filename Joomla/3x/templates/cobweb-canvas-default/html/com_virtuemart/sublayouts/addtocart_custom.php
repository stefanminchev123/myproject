<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$product = $viewData['product'];

if(isset($viewData['rowHeights'])){
    $rowHeights = $viewData['rowHeights'];
} else {
    $rowHeights['customfields'] = TRUE;
}

if(isset($viewData['position'])){
    $positions = $viewData['position'];
} else {
    $positions = 'addtocart';
}
if(!is_array($positions)) $positions = array($positions);

$addtoCartButton = '';
if(!VmConfig::get('use_as_catalog', 0)){
    if($product->addToCartButton){
        $addtoCartButton = $product->addToCartButton;
    } else {
        $addtoCartButton = shopFunctionsF::getAddToCartButton ($product->orderable);
    }

}


?>
    <div class="addtocart-area-custom">
        <form method="post" class="product js-recalculate" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart',false); ?>">
                <?php
                if (!VmConfig::get('use_as_catalog', 0)  ) {
                    echo shopFunctionsF::renderVmSubLayout('addtocartbar_custom',array('product'=>$product));
                } ?>
            <input type="hidden" name="option" value="com_virtuemart"/>
            <input type="hidden" name="view" value="cart"/>
            <input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
            <input type="hidden" name="pname" value="<?php echo $product->product_name ?>"/>
            <input type="hidden" name="pid" value="<?php echo $product->virtuemart_product_id ?>"/>
            <?php
            $itemId=vRequest::getInt('Itemid',false);
            if($itemId){
                echo '<input type="hidden" name="Itemid" value="'.$itemId.'"/>';
            } ?>
        </form>

    </div>

<?php // }
?>