<?php
/**
 * sublayout products
 *
 * @package VirtueMart
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
 * @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
 */

defined('_JEXEC') or die('Restricted access');
echo shopFunctionsF::renderVmSubLayout('askrecomjs');
$currency = $viewData['currency'];
$products_per_row = $viewData['products_per_row'];

$app = JFactory::getApplication();

require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/product.php');
require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/manufacturer.php');
require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/media.php');

$path = JPATH_BASE."/templates/". $app->getTemplate() ."/functions.php";
require_once ($path);

$customFields = new VirtueMartModelCustomfields;
$VirtueMartModelProduct = new VirtueMartModelProduct;
$VirtueMartModelManufacturer = new VirtueMartModelManufacturer;
$model = VmModel::getModel('manufacturer');


$ItemidStr = '';
$Itemid = shopFunctionsF::getLastVisitedItemId();
if(!empty($Itemid)){
  $ItemidStr = '&Itemid='.$Itemid;
}

?>

<div id="col-grid" class="fade in active">
  <?php
    // The functionality for choosing products per row is removed
    if(!empty($type) && count($viewData['products'])>0){
        $productTitle = vmText::_('COM_VIRTUEMART_'.strtoupper($type).'_PRODUCT'); ?>
        <h4><?php echo $productTitle ?></h4>
    <?php } ?>

    <div class="row">
        <?php
        foreach ($viewData['products'] as $type => $allProducts ) {

            foreach ( $allProducts as $products ) {
                productsTemplate($products, $currency, $products_per_row);
            }
        }?>

    </div>

</div>