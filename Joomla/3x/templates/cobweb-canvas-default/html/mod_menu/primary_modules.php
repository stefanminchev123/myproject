<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if (JModuleHelper::getModules('main_menu_bottom_' . $parent_linkColor)) : ?>

 <div class="row main-menu-bottom-module">
     <?php foreach (JModuleHelper::getModules('main_menu_bottom_' . $parent_linkColor) as $i => $module): ?>
         <?= JModuleHelper::renderModule($module, array('style' => 'none')); ?>
     <?php endforeach; ?>
 </div>

<?php endif; ?>