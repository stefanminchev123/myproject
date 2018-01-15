<?php

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );

$product = $viewData['product'];
$position = $viewData['position'];

?>

<style>
    .chzn-search {
        position: absolute;
        left: -9999px;
    }
</style>

<div class="damasks">
    <?php foreach ($product->customfieldsSorted[$position] as $field) {

        $options = explode(',', $field->custom_value);
        ?>
        <div class="product-field-display">
            <label class="product-fields-title"><?= $field->custom_title; ?></label>
            <select  id="customProductData_<?= $field->virtuemart_product_id; ?>_<?= $field->virtuemart_customfield_id; ?>" name="customProductData[<?= $field->virtuemart_product_id; ?>][<?= $field->virtuemart_custom_id; ?>][<?= $field->virtuemart_customfield_id; ?>]" class="vm-chzn-select">
                <option value=""><?= JText::sprintf('COM_VIRTUEMART_DAMASK_DEFAULT_OPTION'); ?></option>
                <?php foreach ($options as $option) {
                    $option = explode(':', $option);

                    ?>

                    <option value="<?= $option[0]; ?>"><?= $option[1]; ?></option>

                <?php } ?>
            </select>
        </div>
    <?php } ?>
</div>

<script>
    jQuery(document).ready(function () {
        jQuery(document).on('change', 'select[id^="customProductData_"]', function () {
            var imageTitle = jQuery(this).find(':selected').val();
            var currentSelect = jQuery(this).attr('id');

            if (imageTitle) {
                jQuery('#damask-images').find('.' + currentSelect).remove();
                jQuery('#damask-images').append('<img src="images/damaska/'+ imageTitle +'.jpg" class="'+ currentSelect +'">');
                jQuery('#custom-damask').val(imageTitle);
            } else {
                jQuery('#damask-images').find('.' + currentSelect).remove();
            }
        })
    })
</script>
