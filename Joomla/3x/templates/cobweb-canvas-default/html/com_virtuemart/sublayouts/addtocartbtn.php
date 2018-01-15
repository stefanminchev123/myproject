<?php

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');

if($viewData['orderable']) {
	echo '<input type="submit" name="addtocart" class="btn btn-primary addtocart-button" value="'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'" title="'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'" />';
} else {
	echo '<span name="addtocart" class="addtocart-button-disabled" title="'.vmText::_( 'COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT' ).'" >'.vmText::_( 'COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT' ).'</span>';
}