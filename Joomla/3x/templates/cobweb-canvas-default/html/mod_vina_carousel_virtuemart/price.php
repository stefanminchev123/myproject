<?php

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
$product = $viewData['product'];
$currency = $viewData['currency'];

// print_r( $product->prices );

?>
<div class="product-price price-availability-block" id="productPrice<?php echo $product->virtuemart_product_id ?>">
    <?php
    if (!empty($product->prices['costPrice'])) {
        echo $currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $product->prices);
    }

    if( $product->prices['salesPrice'] != $product->prices['priceWithoutTax'] ) {
        echo $currency->createPriceDiv ('basePrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $product->prices );
    }
    ?>

    <?php
           if( $product->prices['discountAmount'] < 0 ):

           $discountPersant =  "-". round( 100 -( $product->prices['salesPrice'] * 100 ) /  $product->prices['basePrice'] ,0);

        ?>
            <div class="sticker sticker-sale"></div>
            <div class="sticker sticker-discount"><?php echo $discountPersant; ?> <sup style="font-size: 60%;">%</sup></div>
        <?php

        endif;



     ?>


</div>