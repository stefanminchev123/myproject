<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Manufacturer
* @author Kohl Patrick, Eugen Stranz
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 2701 2011-02-11 15:16:49Z impleri $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/product.php');
require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/manufacturer.php');
require_once( JPATH_SITE.'/administrator/components/com_virtuemart/models/media.php');


$VirtueMartModelManufacturer = new VirtueMartModelManufacturer;

$model = VmModel::getModel('manufacturer');


// Category and Columns Counter
$iColumn = 1;
$iManufacturer = 1;
// Calculating Manufacturers Per Row
$manufacturerPerRow = VmConfig::get('manufacturer_per_row');
if ($manufacturerPerRow > 1) {
	$manufacturerCellWidth = ' width'.floor ( 100 / $manufacturerPerRow );
} else {
	$manufacturerCellWidth = '';
}

// Separator
$verticalSeparator = " vertical-separator";
$horizontalSeparator = '<div class="horizontal-separator"></div>';


// Lets output the categories, if there are some
if (!empty($this->manufacturers)) { ?>

<div class="manufacturer_header">
	<h1><?php echo vmText::_('COM_VIRTUEMART_SHOW_MANUFACTURER'); ?></h1>
</div>

<div class="manufacturer-view-default">
<div class="row">
	<?php // Start the Output
	foreach ( $this->manufacturers as $manufacturer ) {

	$m = $VirtueMartModelManufacturer->getManufacturer( $manufacturer->virtuemart_manufacturer_id[0] );
	$model->addImages($m,1);

	$_show_image = ( count( $manufacturer->virtuemart_manufacturer_id ) > 0 ) ? $_show_image = ' <div class="logo_image"> '. $m->images[0]->displayMediaThumb("",false) .'</div>' : '';

		// Show the horizontal seperator
		if ($iColumn == 1 && $iManufacturer > $manufacturerPerRow) {
			echo $horizontalSeparator;
		}

		// this is an indicator wether a row needs to be opened or not
		if ($iColumn == 1) { ?>

		<?php }

		// Show the vertical seperator
		if ($iManufacturer == $manufacturerPerRow or $iManufacturer % $manufacturerPerRow == 0) {
			$showVerticalSeparator = ' ';
		} else {
			$showVerticalSeparator = $verticalSeparator;
		}

		// Manufacturer Elements
		// <?php // Manufacturer Product Link
		$manufacturerProductsURL = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id, FALSE);
		$manufacturerIncludedProductsURL = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id, FALSE);
		$manufacturerImage = $manufacturer->images[0]->displayMediaThumb("",false);
		// Show Category ?>
		<div class="manufacturer floatleft<?php echo $manufacturerCellWidth . $showVerticalSeparator ?>">
			<div class="spacer">
				<li class="manufacturer_default">
					<a title="<?php echo $manufacturer->mf_name; ?>" href="<?php echo $manufacturerProductsURL; ?>"><span class="logo_image"><?= $manufacturerImage ?></span><?php echo $manufacturer->mf_name; ?></a>
				</li>
			</div>
		</div>


		<?php
		$iManufacturer ++;

		// Do we need to close the current row now?
		if ($iColumn == $manufacturerPerRow) {
			echo '<div class="clear"></div></div>';
			$iColumn = 1;
		} else {
			$iColumn ++;
		}
	}

	// Do we need a final closing row tag?
	if ($iColumn != 1) { ?>
		<div class="clear"></div>

	<?php } ?>
</div>
</div>
<?php
}
?>