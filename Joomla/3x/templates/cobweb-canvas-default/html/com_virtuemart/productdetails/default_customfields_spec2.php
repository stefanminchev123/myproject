<?php

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );
?>

<?php

$this->position = 'spec2';

?>

<div class="product-fields">
	    <?php

	    $custom_title = null;
	    foreach ($this->product->customfieldsSorted[$this->position] as $field) {
	    	if ( $field->is_hidden ) //OSP http://forum.virtuemart.net/index.php?topic=99320.0
	    		continue;
			if ($field->display) {
	    ?><div class="product-field product-field-type-<?php echo $field->field_type ?>">
		    <?php if ($field->custom_title != $custom_title && $field->show_title) { ?>
			    <span class="product-fields-title" ><?php echo JText::_($field->custom_title); ?>: </span>
			    <?php
			    if ($field->custom_tip)
				echo JHTML::tooltip($field->custom_tip, JText::_($field->custom_title), 'tooltip.png');
			}
			?>

	    	    <span class="product-field-display">
					<?php

						if($field->custom_desc == 'broshuri' ){
							$broshuriArr = explode(PHP_EOL, $field->display);

							foreach($broshuriArr as $broshura){
								$broshuraArr = explode(';', $broshura);

								$custom_field_link = trim($broshuraArr[1]);
								$custom_field_title = trim($broshuraArr[0]);

								echo '<div><a href="'.$custom_field_link.'" target="_blank" title="' . $custom_field_title . '" alt="'.$custom_field_title.'">'.$custom_field_title.'</a></div>';

							}
//
						}else{
							echo $field->display;
						}
					?>
				</span>
	    	    <span class="product-field-desc"><?php echo jText::_($field->custom_field_desc) ?></span>
	    	</div>
		    <?php
		    $custom_title = $field->custom_title;
			}
	    }

	    ?>

	<div class="spec2-images">
		<?php
		$start_image = VmConfig::get('add_img_main', 1) ? 0 : 1;
		for ($i = $start_image; $i < count($this->product->images); $i++) {
			$image = $this->product->images[$i];
			?>
			<div class="floatleft">
				<?php
				if(VmConfig::get('add_img_main', 1)) {
					$prod_image = $image->displayMediaThumb('class="" style="cursor: pointer"',false,$image->file_description);
					if (strpos($prod_image, 'spec2') !== false){
						echo '<a rel="vm-additional-images" href="'.$image->file_url.'">';
						echo $prod_image;
						echo "</a>";
					}
				} else {
					//echo $image->displayMediaThumb("",true,"rel='vm-additional-images'",true,$image->file_description);
				}
				?>
			</div>
			<?php
		}
		?>
		<div class="clear"></div>
	</div>
</div>
