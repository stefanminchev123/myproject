<?php
/**
 * @version    2.8.x
 * @package    K2
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2017 JoomlaWorks Ltd. All rights reserved.
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



	<ul class="tab-nav clearfix ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
										<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">Popular</a></li>
										
										<li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false"><a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3"><i class="icon-comments-alt norightmargin"></i></a></li>
									</ul>
						<div class="tab-container">
							<div class="tab-content clearfix ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-1" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
								<div id="popular-post-list-sidebar">
						<?php if(count($items)): ?>
					
					    <?php foreach ($items as $key=>$item):	?>
					    <div class="spost clearfix <?php echo ($key%2) ? "odd" : "even"; if(count($items)==$key+1) echo ' lastItem'; ?>">
                        
                           <?php if($params->get('itemImage')): ?>
					      <div class="entry-image">
						      <?php if($params->get('itemImage') && isset($item->image)): ?>
						      <a class="nobg" href="<?php echo $item->link; ?>"> 
						      	<img class="img-circle" src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" />
						      </a>
						      <?php endif; ?>

					      </div>
					      <?php endif; ?>

					      <?php if($params->get('itemTitle')): ?>
                          <div class="entry-title">
                          	<h4>
					      <a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
					        </h4>
					      </div>
					      <?php endif; ?>
                  
					  </div>
					    <?php endforeach; ?>
					
					  <?php endif; ?>
					</div>

</div>
</div>



