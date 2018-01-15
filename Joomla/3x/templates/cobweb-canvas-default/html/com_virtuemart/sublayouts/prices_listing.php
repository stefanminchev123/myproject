<?php

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
$product = $viewData['product'];
$currency = $viewData['currency'];

?>
<?php if(strlen($product->prices['costPrice']) > 0): ?>
<div class="product-price price-availability-block" id="productPrice<?php echo $product->virtuemart_product_id ?>">
	<?php

	if( $product->prices['salesPrice'] != $product->prices['priceWithoutTax'] ) {
        echo $currency->createPriceDiv ('basePrice', 'COM_VIRTUEMART_PRODUCT_BASEPRICE', $product->prices);
	}

	if (!empty($product->prices['costPrice'])) {
		echo $currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $product->prices);
	}
	?>

	<?php
		   if( $product->prices['discountAmount'] < 0 ):

		   $discountPersant =  "-". round( 100 -( $product->prices['salesPrice'] * 100 ) /  $product->prices['basePrice'] ,0);

		?>
			<!--<div class="sticker sticker-sale"></div>-->
			<div class="sticker sticker-discount"><?php echo $discountPersant; ?>%</div>
		<?php

		endif;



	 ?>


</div>

<?php endif; ?>