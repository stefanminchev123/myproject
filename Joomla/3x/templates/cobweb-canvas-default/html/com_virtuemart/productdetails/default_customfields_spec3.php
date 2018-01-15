<?php

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );
?>

<?php

$this->position = 'spec3';

?>


<div class="product-fields">
	<?php
	$start_image = VmConfig::get('add_img_main', 1) ? 0 : 1;
	for ($i = $start_image; $i < count($this->product->images); $i++) {
		$image = $this->product->images[$i];
		?>
		<div class="floatleft">
			<?php
			if(VmConfig::get('add_img_main', 1)) {
				$prod_image = $image->displayMediaThumb('class="" ',false,$image->file_description);
				if (strpos($prod_image, 'spec3') !== false){
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
