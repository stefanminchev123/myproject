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
$document = JFactory::getDocument();
$app            = JFactory::getApplication();

$templateName  = $app->getTemplate('template')->template;

$css   = JUri::root() . 'templates/'.$templateName.'/html/com_k2/blogg/category_blog.css';
$document->addStyleSheet($css);
?>

<!-- Start K2 Item Layout -->
<span id="startOfPageId<?php echo JRequest::getInt('id'); ?>"></span>

<div  class="postcontent nobottommargin clearfix<?php echo ($this->item->featured) ? ' itemIsFeatured' : ''; ?><?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?>">

	<!-- Plugins: BeforeDisplay -->
	<?php echo $this->item->event->BeforeDisplay; ?>

	<!-- K2 Plugins: K2BeforeDisplay -->
	<?php echo $this->item->event->K2BeforeDisplay; ?>

       	<div class="entry clearfix">
         <div class="entry-title">
	<?php if($this->item->params->get('itemTitle')): ?>
	<!-- Item title -->
	    <h2 >
		<?php if(isset($this->item->editLink)): ?>
		<!-- Item edit link -->
		<span class="itemEditLink">
			<a data-k2-modal="edit" href="<?php echo $this->item->editLink; ?>"><?php echo JText::_('K2_EDIT_ITEM'); ?></a>
		</span>
		<?php endif; ?>

		<?php echo $this->item->title; ?>

		<?php if($this->item->params->get('itemFeaturedNotice') && $this->item->featured): ?>
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
                               	<li><i class="icon-calendar3"> <?php echo JHTML::_('date', $this->item->created, JText::_('d')); ?>
                               		 <?php echo JHTML::_('date', $this->item->created, JText::_('M')); ?>
                               		  <?php echo JHTML::_('date', $this->item->created, JText::_('Y')); ?>
                               	</i></li>
			<li><a href=""><i class="icon-user"></i><?php echo $this->item->author->username?> </a></li>
				<li><a href=""><i class="icon-comments"></i> 13 Comments</a></li>
			</ul>

	<!-- Plugins: AfterDisplayTitle -->
	<?php echo $this->item->event->AfterDisplayTitle; ?>

	<!-- K2 Plugins: K2AfterDisplayTitle -->
	<?php echo $this->item->event->K2AfterDisplayTitle; ?>


		

		<?php if($this->item->params->get('itemImage') && !empty($this->item->image)): ?>
			<div class="entry-image">
		<!-- Item Image -->
			
				<a>
					<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" />
				</a>
			

			
			<div class="clr"></div>
		</div>
		<?php endif; ?>
  <div class="entry-content">
		<?php if(!empty($this->item->fulltext)): ?>
           
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
			<?php echo $this->item->fulltext; ?>
		</p>

		<?php endif; ?>

        </div>
		

		<!-- Plugins: AfterDisplayContent -->
		<?php echo $this->item->event->AfterDisplayContent; ?>

		<!-- K2 Plugins: K2AfterDisplayContent -->
		<?php echo $this->item->event->K2AfterDisplayContent; ?>
	

	<?php if(
		$this->item->params->get('itemTwitterButton',1) ||
		$this->item->params->get('itemFacebookButton',1) ||
		$this->item->params->get('itemGooglePlusOneButton',1)
	): ?>
	<!-- Social sharing -->
	
     
	    <div class="si-share noborder clearfix">
     	<span>Share this Post:</span>
     	<div>
		<?php if($this->item->params->get('itemTwitterButton',1)): ?>
		<!-- Twitter Button -->
			<a href="https://www.twitter.com" class="social-icon si-borderless si-twitter" data-lang="<?php echo $this->item->langTagForTW; ?>" data-via="<?php if($this->item->params->get('twitterUsername')) echo $this->item->params->get('twitterUsername'); ?>"><?php echo JText::_(''); ?>
					<i class="icon-twitter"></i>
					<i class="icon-twitter"></i>
			</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

		<?php endif; ?>

		<?php if($this->item->params->get('itemFacebookButton',1)): ?>
		<!-- Facebook Button -->
		<a href="https://www.facebook.com" class="social-icon si-borderless si-facebook" data-lang="<?php echo $this->item->langTagForTW; ?>" data-via="<?php if($this->item->params->get('twitterUsername')) echo $this->item->params->get('twitterUsername'); ?>"><?php echo JText::_(''); ?>
					<i class="icon-facebook"></i>
					<i class="icon-facebook"></i>
			</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

			
	
		<?php endif; ?>

		<?php if($this->item->params->get('itemGooglePlusOneButton',1)): ?>
		<!-- Google +1 Button -->
		
			<a href="https://www.google.bg/" class="social-icon si-borderless si-gplus" data-lang="<?php echo $this->item->langTagForTW; ?>" data-via="<?php if($this->item->params->get('twitterUsername')) echo $this->item->params->get('twitterUsername'); ?>"><?php echo JText::_(''); ?>
					<i class="icon-gplus"></i>
					<i class="icon-gplus"></i>
			</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  		
			
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>

	<div class="clr"></div>

	<!-- Plugins: AfterDisplay -->
	<?php echo $this->item->event->AfterDisplay; ?>

	<!-- K2 Plugins: K2AfterDisplay -->
	<?php echo $this->item->event->K2AfterDisplay; ?>
	</div>
                        
				<table style="width:660px;" cellspacing="0" cellpadding="0" border="0" bgcolor="#EFEFEF">
                <tbody><tr>
                  <td width="265" valign="top" style="padding:10px">
                    <br><br>


                  <span style="font-size:14px; font-weight:bold;">Auto Wired</span><br><a  target="_blank" class="logoLink" style="margin-top:5px;margin-bottom:5px;"><img src="images/logo.png" border="0" alt="Auto S&amp;P"></a><br><br>
                  
                  Булевард Евлоги и Христо Георгиеви,гр.София/<br>
                  тел.: 0898 48 28 66; 0898 81 22 33<br>
                  
Регион: София, гр.София

<br>
                  </td>
                  
                </tr>
              </tbody></table>			
</div>
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


<!-- End K2 Item Layout -->
