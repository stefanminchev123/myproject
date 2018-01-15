<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @todo handle child products
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_addtocart.php 7833 2014-04-09 15:04:59Z Milbo $
 */
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
    <div class="addtocart-area">
        <form method="post" class="product js-recalculate" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart',false); ?>">
            <div class="vm-customfields-wrap">
                <div id="damask-images"></div>
                <?php
                if(!empty($rowHeights['customfields'])) {
                    foreach($positions as $pos){
                        echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$product,'position'=>$pos));
                    }
                } ?>
            </div>
            <?php
            if (!VmConfig::get('use_as_catalog', 0)  ) {
                echo shopFunctionsF::renderVmSubLayout('addtocartbar',array('product'=>$product));
            } ?>
            <div class="clearfix"></div>
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

<script>
    jQuery(document).ready(function () {



        jQuery('select[id^="customProductData_"] option:first-child').val("");
        jQuery(document).on('change', 'select[id^="customProductData_"]', function () {
            var imageTitle = jQuery(this).find(':selected').val();
            var currentSelect = jQuery(this).attr('id');
            if (imageTitle) {

                     var hash = md5( imageTitle , "01433efd5f16327ea4b31144572c67f6", false);
                     console.log(imageTitle +" == "+ hash );

                jQuery('#damask-images').find('.' + currentSelect).remove();
                jQuery('#damask-images').append('<img src="'+ jQuery('#SERVERURI').val() +'images/damaska/'+ hash +'.jpg" class="'+ currentSelect +'">');
                jQuery('#custom-damask').val(imageTitle);
            } else {
                jQuery('#damask-images').find('.' + currentSelect).remove();
            }
        })

    })
</script>
