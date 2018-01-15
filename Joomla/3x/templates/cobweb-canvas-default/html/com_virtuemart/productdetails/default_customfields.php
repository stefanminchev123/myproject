<?php

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );
?>

<?php

$this->position = 'spec';

?>

<div class="product-fields">
	<table class="table table-striped">

	    <?php

	    $custom_title = null;
	    foreach ($this->product->customfieldsSorted[$this->position] as $field) {
	    	if ( $field->is_hidden ) //OSP http://forum.virtuemart.net/index.php?topic=99320.0
	    		continue;
			if ($field->display) {
	    ?>
	    <tr>

		    <?php if ($field->custom_title != $custom_title && $field->show_title) { ?>
			    <td><span class="product-fields-title" ><?php echo JText::_($field->custom_title); ?>: </span></td>
			    <?php
			    if ($field->custom_tip)
				echo JHTML::tooltip($field->custom_tip, JText::_($field->custom_title), 'tooltip.png');
			}
			?>
	    	    <td> <span class="product-field-display"><?php echo $field->display ?></span></td>
	    	    <td><span class="product-field-desc"><?php echo jText::_($field->custom_field_desc) ?></span></td>
	    	</tr>
		    <?php
		    $custom_title = $field->custom_title;
			}
	    }
	    ?>
	</table>
</div>
