<?php

DEFINE('Product_Details_ItemID', 451);
DEFINE('Products_Listing_ItemID', 452);


function productsTemplate($products, $currency, $products_per_row) {
    require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/manufacturer.php');

    $VirtueMartModelManufacturer = new VirtueMartModelManufacturer;
    $model = VmModel::getModel('manufacturer');

    foreach ($products as $product) {
        $m = $VirtueMartModelManufacturer->getManufacturer($product->virtuemart_manufacturer_id[0] );
        $model->addImages($m,1);
        $_show_image = ( count( $product->virtuemart_manufacturer_id ) > 0 ) ? $_show_image = ' <div class="logo_image"> '. $m->images[0]->displayMediaThumb("",false) .'</div>' : ''; ?>

        <div class="product product-container col-md-<?= $products_per_row ?> col-sm-6 col-xs-12">
            <div class="product-item">

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

                <div class="vm-product-media-container category-product-image">

                    <a title="<?php echo $product->product_name ?>" href="<?php echo $product->link  . '&Itemid=' . Product_Details_ItemID; ?>">

                        <img src="<?=JUri::root() .$product->images[0]->file_url ?>" alt="<?= $product->product_name ?>" ?>
                    </a>

                    <?php echo shopFunctionsF::renderVmSubLayout('addtocart_custom',array('product'=>$product)); ?>
                </div>

                <div class="product_title">
                    <h3><?php echo JHtml::link ($product->link . '&Itemid=' . Product_Details_ItemID, $product->product_name); ?></h3>
                </div>

                <div class="vm3pr listing-prices">
                    <?php echo shopFunctionsF::renderVmSubLayout('prices_listing',array('product'=>$product,'currency'=>$currency)); ?>
                </div>


                <?php
                $now = date("Ymd");
                $av_int =  strtotime( $product->product_available_date );
                $av  = date( "Ymd", strtotime( "+7 day", $av_int ) );
                if( $av >= $now   ) echo '<div class="sticker sticker-new"></div>';
                ?>
                <div class="clear"></div>
            </div>
        </div>
    <?php }
}



function getCustomFiled( $product , $cf_desc= ''){


    $customfields = $product->customfieldsSorted;

    if(isset($customfields)){
        if( $cf_desc == '' ) return;

         foreach ($customfields as  $layouts) {
             foreach ($layouts as  $cfield) {


                if( $cfield->custom_desc == $cf_desc  )   {

                    $rezult = array( 'title' => $cfield->custom_title ,
                                     'value' => $cfield->display
                                    );

                    return $rezult;
               }
           } // layout
         }

       return;

    }else{
        $customfields = $product->customfields;

        if( $cf_desc == '' ) return;

         foreach ($customfields as  $cfield) {

                if( $cfield->custom_desc == $cf_desc  )   {

                    $rezult = array( 'title' => $cfield->custom_desc ,
                                     'value' => $cfield->customfield_value
                                    );

                    return $rezult;
               }
           }

       return;

    }


}


function getWarranty( $product ){

    $field = getCustomFiled( $product , 'warranty' ); //Гаранция

    if( !isset( $field['value'] ) ) return;

     ob_start();
?>
<div class="product-fields">
        <div class="warranty-field product-field product-field-type-<?php echo $field->field_type ?>">
            <span class="product-field-display">
                <?php
                    $warrantyImgUri     = jUri::root()     . 'images/warranty/' .$field['value'].'.png';
                    $warrantyImgPath     = JPATH_BASE     . '/images/warranty/' .$field['value'].'.png';

                    if( file_exists($warrantyImgPath) ) {
                        echo '<img src="' . $warrantyImgUri . '" /> ';
                    } else{
                        echo '<span>Гаранция: ' . $field['value'] . '<span>';
                    }
                ?>
            </span>
        </div>
</div>
<?php
        $output = ob_get_clean();

         return $output;
    }
 ?>


<?php


function getSource( $product ){

    $field = getCustomFiled( $product , 'origin'  ); // Произход

    if( !isset( $field['value'] ) ) return;

     ob_start();
?>
         <?php
                $originImgUri     = jUri::root()     . 'images/origin/' .$field['value'].'.png';
                $originImgPath     = JPATH_BASE     . '/images/origin/' .$field['value'].'.png';

                if( file_exists($originImgPath)) {
                    echo '<img src="' . $originImgUri . '" /> ';
                }
            ?>

<?php

        $output = ob_get_clean();

        return $output;

   }

?>

<?php

    function getProductDiscountTable( $product ){

        ob_start();

        if( count($product->allPrices) > 1): ?>
        <div class="listView-prices">
            <div class="price_box">
                <div class="price_range"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_UNIT_DEFAULT_UPPER'); ?> </div>
                <div class="price_value"><?php echo vmText::_('COM_VIRTUEMART_CART_PRICE_PER_UNIT_UPPER'); ?> </div>
            </div>
            <?php

            foreach( $product->allPrices as $price ): ?>
                <div class="price_box">
                    <div class="price_range"><?php echo $price['price_quantity_start'];  ?>+ </div>
                    <div class="price_value">
                        <?php
                            if($price['discountedPriceWithoutTax']) {
                                echo round($price['discountedPriceWithoutTax'],2);
                            } else{
                                echo round($price['product_price'],2);
                            }
                        ?>
                        лв.</div>
                </div>


            <?php endforeach; ?>
        </div>

    <?php endif; ?>

    <?php
        $output = ob_get_clean();

        return $output;
    }

?>

<?php
function getProductsByManufacturer($product){

    ob_start(); ?>

    <div class="manufacturer-details-view">
    <h1><?php echo $product->mf_name; ?></h1>

    <div class="spacer">
    <?php // Manufacturer Image
    if (!empty($product->manufacturerImage)) { ?>
        <div class="manufacturer-image">
        <?php echo $product->manufacturerImage; ?>
        </div>
    <?php } ?>

    <?php // Manufacturer Email
    if(!empty($product->mf_email)) { ?>
        <div class="manufacturer-email">
        <?php // TO DO Make The Email Visible Within The Lightbox
        echo JHtml::_('email.cloak', $product->mf_email,true,vmText::_('COM_VIRTUEMART_EMAIL'),false) ?>
        </div>
    <?php } ?>

    <?php // Manufacturer URL
    if(!empty($product->mf_url)) { ?>
        <div class="manufacturer-url">
            <a target="_blank" href="<?php echo $product->mf_url ?>"><?php echo vmText::_('COM_VIRTUEMART_MANUFACTURER_PAGE') ?></a>
        </div>
    <?php } ?>

    <?php // Manufacturer Description
    if(!empty($product->mf_desc)) { ?>
        <div class="manufacturer-description">
            <?php echo $product->mf_desc ?>
        </div>
    <?php } ?>
</div>

</div>

    <?php
        $output = ob_get_clean();

        return $output;
    }
?>