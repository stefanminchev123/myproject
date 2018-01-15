<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<!--BEGIN Search Box -->
<?php

    $document = &JFactory::getDocument();

    if( !empty(  $_GET['keyword'] ) ) {
	$text = $_GET['keyword'];
	$close_open_class = ' opensearchbox ';
     } else {
       $text = '';
	$close_open_class = ' ';
    }
?>

<form action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=category&search=true&limitstart=0&virtuemart_category_id='.$category_id ); ?>" method="GET">

<div class="search">

<?php $output = '<input name="keyword"  id="mod_virtuemart_search" maxlength="'.$maxlength.'"
		alt="'.$button_text.'"class="inputbox '.$moduleclass_sfx.'  '. $close_open_class .'" type="text" size="'.$width.'"
		value="'.$text.'" placeholder="Търси"
		 />';

 $image = JURI::base().'components/com_virtuemart/assets/images/vmgeneral/search.png' ;

			if ($button) :
			    if ($imagebutton) :
			        $button = '<input style="vertical-align :middle;height:16px;border: 1px solid #CCC;" type="image" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" src="'.$image.'" onclick="this.form.keyword.focus();"/>';
			    else :
			        $button = '<input type="submit" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" onclick="this.form.keyword.focus();"/>';
			    endif;


			switch ($button_pos) :
			    case 'top' :
				    $button = $button.'<br />';
				    $output = $button.$output;
				    break;

			    case 'bottom' :
				    $button = '<br />'.$button;
				    $output = $output.$button;
				    break;

			    case 'right' :
				    $output = $output.$button;
				    break;

			    case 'left' :
			    default :
				    $output = $button.$output;
				    break;
			endswitch;
			endif;

			echo $output;
?>
<div id="searchBtn" class="searchbutton">
<button id="searchfocus" onclick="this.form.searchword.focus();">
<i  class="fa fa-search"></i>
</button>
</div>
</div>


		<input type="hidden" name="limitstart" value="0" />
		<input type="hidden" name="option" value="com_virtuemart" />
		<input type="hidden" name="view" value="category" />
		<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
		<input type="hidden" name="Itemid" value="<?php echo Products_Listing_ItemID; ?>">
<?php if(!empty($set_Itemid)){
	echo '<input type="hidden" name="Itemid" value="'.$set_Itemid.'" />';
} ?>

	  </form>

<!-- End Search Box -->
