<?php
/**
 * @version    2.7.x
 * @package    K2
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2016 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
$document = JFactory::getDocument();
$app            = JFactory::getApplication();

$templateName  = $app->getTemplate('template')->template;

$css   = JUri::root() . 'templates/'.$templateName.'/html/com_k2/blogg/category_blog.css';
$document->addStyleSheet($css);

?>

				<div class="entry-timeline">
		 <?php if ($this->item->params->get('catItemDateCreated')): ?>
            <!-- Date created -->
                <span >
                    <?php echo JHTML::_('date', $this->item->created, JText::_('d')); ?>
                </span>
                <span >
                    <?php echo JHTML::_('date', $this->item->created, JText::_('M')); ?>
                </span>
        <?php endif; ?>
		<div class="timeline-divider"></div>
                 </div>
		
					  <!-- Plugins: AfterDisplayTitle -->
					  <?php echo $this->item->event->AfterDisplayTitle; ?>

					  <!-- K2 Plugins: K2AfterDisplayTitle -->
					  <?php echo $this->item->event->K2AfterDisplayTitle; ?>

	
 	 <div class="entry-image">
           
	  <?php if($this->item->params->get('catItemImage') && !empty($this->item->image)): ?>
	  <!-- Item Image -->
 				
		    <a href="<?php echo $this->item->link; ?>" title="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>">
		    	<img class="image_fade" src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>"/>
		    </a>
		  
		
		     		<?php endif; ?>
		     	

	  </div>

	   <!-- Plugins: AfterDisplayTitle -->
  <?php echo $this->item->event->AfterDisplayTitle; ?>

  <!-- K2 Plugins: K2AfterDisplayTitle -->
  <?php echo $this->item->event->K2AfterDisplayTitle; ?>

<div class="entry-title">
 <?php if($this->item->params->get('catItemTitle')): ?>
	  <!-- Item title -->
	  <h2>
			<?php if(isset($this->item->editLink)): ?>
			<!-- Item edit link -->
			<span class="catItemEditLink">
				<a data-k2-modal="edit" href="<?php echo $this->item->editLink; ?>">
					<?php echo JText::_('K2_EDIT_ITEM'); ?>
				</a>
			</span>
			<?php endif; ?>

	  	<?php if ($this->item->params->get('catItemTitleLinked')): ?>
			<a href="<?php echo $this->item->link; ?>">
	  		<?php echo $this->item->title; ?>
	  	</a>
	  	<?php else: ?>
	  	<?php echo $this->item->title; ?>
	  	<?php endif; ?>

	  	<?php if($this->item->params->get('catItemFeaturedNotice') && $this->item->featured): ?>
	  	<!-- Featured flag -->
	  	<span>
		  	<sup>
		  		<?php echo JText::_('K2_FEATURED'); ?>
		  	</sup>
	  	</span>
	  	<?php endif; ?>
	  </h2>
	  <?php endif; ?>
	</div>


		<ul class="entry-meta clearfix">
			<li><a href=""><i class="icon-user"></i><?php echo $this->item->author->username?> </a></li>
				<li><a href="http://localhost/project/Joomla/3x/index.php/blog/itemlist/category/3-category"><i class="icon-folder-open"></i><?php echo $this->item->categoryname?></a></li>
				<li><a href=""><i class="icon-comments"></i> 13 Comments</a></li>
			</ul>
				
	  <!-- Plugins: AfterDisplayContent -->
	  <?php echo $this->item->event->AfterDisplayContent; ?>

	  <!-- K2 Plugins: K2AfterDisplayContent -->
	  <?php echo $this->item->event->K2AfterDisplayContent; ?>

	  <div class="clr"></div>
 

<div class = "entry-content">
	            
  <?php if(empty($this->item->fulltext)): ?>

		<?php if($this->item->params->get('itemIntroText')): ?>
		<!-- Item introtext -->
		<p>
			<?php echo $this->item->introtext; ?>
		</p>
		<?php endif; ?>

		<?php if($this->item->params->get('itemFullText')): ?>
		<!-- Item fulltext -->
		<p>
			<?php echo $this->item->fulltext; ?>
		</p>
		<?php endif; ?>

		<?php else: ?>

		<!-- Item text -->
		<p>
			<?php echo $this->item->introtext; ?>
		</p>

		<?php endif; ?>
        
		

		<div class="clr"></div>

	<?php if ($this->item->params->get('catItemReadMore')): ?>
	<!-- Item "read more..." link -->

		<a class="more-link" href="<?php echo $this->item->link; ?>">
			<?php echo JText::_('Read More'); ?>
		</a>
	
	<?php endif; ?>
</div>

	


	<?php if($this->item->params->get('catItemDateModified')): ?>
	<!-- Item date modified -->
	<?php if($this->item->modified != $this->nullDate && $this->item->modified != $this->item->created ): ?>
	<span class="catItemDateModified">
		<?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
	</span>
	<?php endif; ?>
	<?php endif; ?>

<div class="clr"></div>
	
<button onclick="topFunction()" id="gotoTop" class="icon-angle-up"></button>

<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>