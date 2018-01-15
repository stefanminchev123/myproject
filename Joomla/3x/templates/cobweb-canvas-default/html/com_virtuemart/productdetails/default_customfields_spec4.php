<?php

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );
?>

<?php

$this->position = 'spec4';

?>
<div class="product-fields">
	    <?php

	    $custom_title = null;
	    foreach ($this->product->customfieldsSorted[$this->position] as $field) {
	    	if ( $field->is_hidden ) //OSP http://forum.virtuemart.net/index.php?topic=99320.0
	    		continue;
			if ($field->display) {
	    ?><div class="warranty-field product-field product-field-type-<?php echo $field->field_type ?>">
		    <?php if ($field->custom_title != $custom_title && $field->show_title) { ?>
			    <?php
			    if ($field->custom_tip)
				echo JHTML::tooltip($field->custom_tip, JText::_($field->custom_title), 'tooltip.png');
			}
			?>

	    	    <span class="product-field-display">
					<?php
							$warrantyImgUri 	= jUri::root() 	. 'images/warranty/' .$field->display.'.png';
							$warrantyImgPath 	= JPATH_BASE 	. '/images/warranty/' .$field->display.'.png';

							if( file_exists($warrantyImgPath) ) {
								echo '<img src="' . $warrantyImgUri . '" /> ';
							} else{
								echo '<span>Гаранция: ' . $field->display . '<span>';
							}
					?>
				</span>

	    	</div>
		    <?php
		    $custom_title = $field->custom_title;
			}
	    }

	    ?>


</div>
