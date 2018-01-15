<?php
$document = JFactory::getDocument();
$app            = JFactory::getApplication();

$templateName  = $app->getTemplate('template')->template;

$css   = JUri::root() . 'templates/'.$templateName.'/html/com_k2/default/category_blog.css';
$document->addStyleSheet($css);

?>

<?php if(strlen($this->item->imageSmall) > 0): ?>
 
    <div class="blog-image">
     <?php if ($this->item->params->get('catItemDateCreated')): ?>
            <!-- Date created -->
            <span class="catItemDateCreated">
                <span class="monthDate">
                    <?php echo JHTML::_('date', $this->item->created, JText::_('M')); ?>
                </span>
                <span class="dayDate">
                    <?php echo JHTML::_('date', $this->item->created, JText::_('d')); ?>
                </span>
            </span>
        <?php endif; ?>
        <a href="<?php echo $this->item->link; ?>"><img src="<?php echo $this->item->imageXLarge; ?>"></a>
      </div>

    <div class="clr"></div>

<?php endif; ?>
<?php if($this->item->params->get('catItemTitle')): ?>
<!-- Item title -->
<h3 class="catItemTitle">
<?php if ($this->item->params->get('catItemTitleLinked')): ?>
    <a href="<?php echo $this->item->link; ?>">
        <?php echo $this->item->title; ?>
    </a>
<?php else: ?>

<?php echo $this->item->title; ?>

<?php endif; ?>
</h3>
<?php endif; ?>

<?php if ($this->item->params->get('catItemDateCreated')): ?>
    <!-- Date created -->
    <span class="createDate">
        <em>
            <i class="fa fa-calendar"></i>
            <?php echo JHTML::_('date', $this->item->created, JText::_('D')); ?>,
            <?php echo JHTML::_('date', $this->item->created, JText::_('d')); ?>
            <?php echo JHTML::_('date', $this->item->created, JText::_('M')); ?>
            <?php echo JHTML::_('date', $this->item->created, JText::_('Y')); ?>
        </em>
    </span>
<?php endif; ?>


<?php if ($this->item->params->get('catItemIntroText')): ?>
    <!-- Item introtext -->
    <div class="catItemIntroText">
        <?php echo $this->item->introtext; ?>
    </div>
<?php endif; ?>

<?php if ($this->item->params->get('catItemReadMore')): ?>
    <!-- Item "read more..." link -->
    <div class="catItemReadMore">
        <a class="k2ReadMore" href="<?php echo $this->item->link; ?>">
            <i class="fa fa-search"></i>
            <?php echo JText::_('K2_READ_MORE'); ?>
        </a>
    </div>
<?php endif; ?>
