<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$app = JFactory::getApplication();

require_once(JPATH_ADMINISTRATOR . '/components/com_virtuemart/models/media.php');
$categoryMedia = new VirtueMartModelMedia;

$path = JPATH_BASE."/templates/". $app->getTemplate() ."/functions.php";
require_once ($path);

$document = JFactory::getDocument();
$css = JURI::root() . "/templates/". $app->getTemplate() ."/html/mod_virtuemart_category/megaMenu.css";
$script = JURI::root() . "/templates/". $app->getTemplate() ."/html/mod_virtuemart_category/megaMenu.js";
$document->addStyleSheet($css);
$document->addScript($script);

?>
<div id="main-menu-drop-top">

    <ul class="VMmenu<?php echo $class_sfx ?>" >
    <?php foreach ($categories as $category) {
            $active_menu = '';
            $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$category->virtuemart_category_id . '&Itemid=' . Products_Listing_ItemID);
            $cattext = $category->category_name;
            //if ($active_category_id == $category->virtuemart_category_id) $active_menu = 'class="active"';
            if (in_array( $category->virtuemart_category_id, $parentCategories)) $active_menu = 'class="item-' . $category->virtuemart_category_id . ' active"';

            ?>

    <li <?php echo $active_menu ?> class="item-<?php echo $category->virtuemart_category_id; ?>">
        <div class="menu-icon">
        <?php if($category->childs): ?>
            <?php echo JHTML::link($caturl, $cattext); ?>
        <?php else: ?>
            <?php echo JHTML::link($caturl, $cattext); ?>
        <?php endif; ?>
        </div>
    <?php if ($category->childs ) {


    ?>
    <div id="submenu-block-top">
        <ul class="menu<?php echo $class_sfx; ?>-top">
        <?php
            $categoryImage = $categoryMedia->getFiles(false, false, null, $category->virtuemart_category_id)[0]->file_url;
            if($categoryImage == null){
                $categoryImage = JURI::root() . 'images/logo.jpg';
            }
            foreach ($category->childs as $child) {
                $childImages = $categoryMedia->getFiles(false, false, null, $child->virtuemart_category_id);
                $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$child->virtuemart_category_id . '&Itemid=' . Products_Listing_ItemID);
                $cattext = vmText::_($child->category_name); ?>
                <li>
                    <div ><?php echo JHTML::link($caturl, $cattext); ?></div>

                    <?php foreach ($childImages as $image): ?>
                        <div class="category-image"><img class="image-to-show" src="<?php echo $image->file_url; ?>"></div>
                    <?php endforeach; ?>

                    <?php if(!empty($child->childs)): ?>
                        <ul class="submenu-level-3-top">
                        <?php foreach ($child->childs as $subChild):
                            $childImages = $categoryMedia->getFiles(false, false, null, $subChild->virtuemart_category_id);
                            $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$subChild->virtuemart_category_id . '&Itemid=' . Products_Listing_ItemID);
                            $cattext = vmText::_($subChild->category_name); ?>
                            <li>
                            <div><?php echo JHTML::link($caturl, $cattext); ?></div>
                                <?php foreach ($childImages as $image) : ?>
                                    <div class="category-image"><img class="image-to-show-sub" src="<?php echo $image->file_url; ?>"></div>
                                <?php endforeach; ?>
                            </li>
                        <?php endforeach; ?>

                        </ul>
                    <?php endif; ?>
                <?php } ?>
            </li>
        </ul>
        <div class="category-image image-show-hide"><img src="<?php echo $categoryImage; ?>"></div>
    </div>
    <?php   } ?>
    </li>
    <?php

        } ?>
    </ul>
    </div>