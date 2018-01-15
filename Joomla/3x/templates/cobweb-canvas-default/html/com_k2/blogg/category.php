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

	
	<div class="postcontent nobottommargin col_last clearfix">

		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
		<div id="posts" class="post-timeline clearfix">
				<div class="timeline-border"></div>
			<?php foreach($this->leading as $key=>$item): ?>

			<?php
			// Define a CSS class for the last container on each row
			if((($key+1)%($this->params->get('num_leading_columns'))==0) || count($this->leading)<$this->params->get('num_leading_columns'))
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
				<div class="entry clearfix">
				<?php
					// Load category_item.php by default
					$this->item = $item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_leading_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

	</div>

    <!-- Pagination -->
    <?php if (count($this->pagination->getPagesLinks())): ?>
        <div class="k2Pagination">
            <?php if ($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
            <div class="clr"></div>
        </div>
    <?php endif; ?>

  

