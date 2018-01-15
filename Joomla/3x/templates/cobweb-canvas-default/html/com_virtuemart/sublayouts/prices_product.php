<?php

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
$product = $viewData['product'];
$currency = $viewData['currency'];

?>
<div class="product-price price-availability-block" id="productPrice<?php echo $product->virtuemart_product_id ?>">
    <?php
        if( $product->prices['salesPrice'] != $product->prices['priceWithoutTax'] ) {
            echo $currency->createPriceDiv ('basePrice', '', $product->prices );
        }
        echo $currency->createPriceDiv ('salesPrice', '', $product->prices);
    ?>

</div>