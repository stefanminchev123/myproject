<?php // no direct access
defined( '_JEXEC' ) or die('Restricted access');
vmJsApi::jPrice();

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

// calculate grid
if($products_per_row < 4){
    $products_per_row = 12 / $products_per_row;
}else{
    $products_per_row = 6;
}
?>

<div id="col-grid" class="fade in active">

    <div class="vmgroup<?php echo $params->get( 'moduleclass_sfx' ) ?>">

        <?php if($headerText) { ?>
            <div class="vmheader"><?php echo $headerText ?></div>
        <?php } ?>

        <div class="vmproduct<?php echo $params->get( 'moduleclass_sfx' ); ?>">

            <?php productsTemplate($products, $currency, $products_per_row); ?>
            <?php if($footerText) { ?>
                <div class="vmheader"><?php echo $footerText ?></div>
            <?php } ?>
        </div>
    </div>
</div>