<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez_20
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access.
defined('_JEXEC') or die;

/**
 * beezDivision chrome.
 *
 * @since	1.6
 */
function modChrome_Styleh4($module, &$params, &$attribs) {
    $headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
    if (!empty($module->content)) {
        ?>
        <div class="moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
            <?php if ($module->showtitle) { ?><h<?php echo $headerLevel; ?>><span
                        class="backh"><span class="backh2"><span class="backh3"><?php echo $module->title; ?></span></span></span></h<?php echo $headerLevel; ?>>
            <?php }; ?> <?php echo $module->content; ?></div>
        <?php
    };
}

function modChrome_StylehMainContent($module, &$params, &$attribs) {
    $headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
    if (!empty($module->content)) {
        ?>
        <div class="mainContent moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
            <?php if ($module->showtitle) { ?> <h<?php echo $headerLevel; ?> class="normalHead"><?php echo $module->title; ?></h<?php echo $headerLevel; ?>>
            <?php }; ?> <?php echo $module->content; ?></div>
        <?php
    };
}

function modChrome_FooterModules($module, &$params, &$attribs) {
    $headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
    if (!empty($module->content)) {
        ?>
        <div class="widget widget_links footerModules moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
            <?php if ($module->showtitle) { ?> <h4><?php echo $module->title; ?></h4>
            <?php }; ?> <?php echo $module->content; ?></div>
        <?php
    };
}

function modChrome_SidebarModules($module, &$params, &$attribs) {
    $headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
    if (!empty($module->content)) {
        ?>
        
        <div class="widget clearfix<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
            <?php if ($module->showtitle) { ?><h4><?php echo $module->title; ?></h4>
            <?php }; ?> <?php echo $module->content; ?></div>
        <?php
    };
}

function modChrome_Styleh4bottomMenus($module, &$params, &$attribs) {


    $headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
    if (!empty($module->content)) {
        ?>
        <div class="bottomMenus widget<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
            <?php if ($module->showtitle) { ?> <h<?php echo $headerLevel; ?>><span
                        class="backh"><?php echo $module->title; ?></span></h<?php echo $headerLevel; ?>>
            <?php }; ?> <?php echo $module->content; ?></div>
        <?php
    };
}

function modChrome_Styleh4bottomMethods($module, &$params, &$attribs) {

    $b = explode("#", $module->title);

    $title1 = $b[1];

    $title2 = $b[2];
    //echo $title1;
    if (isset($b[1])) {
        $hTitle = '<span>' . $title1 . '</span><span class="secondTitle">' . $title2 . '</span>';
    } else {
        $hTitle = $module->title;
    }

    $headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
    if (!empty($module->content)) {
        ?>
        <div class="bottomMethods widget<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
            <?php if ($module->showtitle) { ?> <h<?php echo $headerLevel; ?>><?php echo $hTitle; ?></h<?php echo $headerLevel; ?>>
            <?php }; ?> <?php echo $module->content; ?></div>
        <?php
    };
}

function modChrome_ArticleTitle($module, &$params, &$attribs) {
    $headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 1;
    if (!empty($module->content)) {
        ?>
        <div class="widget<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
            <?php if ($module->showtitle) { ?> <h<?php echo $headerLevel; ?>><?php echo $module->title; ?></h<?php echo $headerLevel; ?>>
            <?php }; ?> <?php echo $module->content; ?></div>
        <?php
    };
}
function modChrome_view($module, &$params, &$attribs) {


   }
        

/**
 * beezHide chrome.
 *
 * @since	1.6
 */

/**
 * beezTabs chrome.
 *
 * @since	1.6
 */
function modChrome_beezTabs($module, $params, $attribs) {
    $area = isset($attribs['id']) ? (int) $attribs['id'] : '1';
    $area = 'area-' . $area;

    static $modulecount;
    static $modules;

    if ($modulecount < 1) {
        $modulecount = count(JModuleHelper::getModules($module->position));
        $modules = array();
    }

    if ($modulecount == 1) {
        $temp = new stdClass();
        $temp->content = $module->content;
        $temp->title = $module->title;
        $temp->params = $module->params;
        $temp->id = $module->id;
        $modules[] = $temp;
        // list of moduletitles
        // list of moduletitles
        echo '<div id="' . $area . '" class="tabouter"><ul class="tabs">';

        foreach ($modules as $rendermodule) {
            echo '<li class="tab"><a href="#" id="link_' . $rendermodule->id . '" class="linkopen" onclick="tabshow(\'module_' . $rendermodule->id . '\');return false">' . $rendermodule->title . '</a></li>';
        }
        echo '</ul>';
        $counter = 0;
        // modulecontent
        foreach ($modules as $rendermodule) {
            $counter++;

            echo '<div tabindex="-1" class="tabcontent tabopen" id="module_' . $rendermodule->id . '">';
            echo $rendermodule->content;
            if ($counter != count($modules)) {
                echo '<a href="#" class="unseen" onclick="nexttab(\'module_' . $rendermodule->id . '\');return false;" id="next_' . $rendermodule->id . '">' . JText::_('TPL_BEEZ2_NEXTTAB') . '</a>';
            }
            echo '</div>';
        }
        $modulecount--;
        echo '</div>';
    } else {
        $temp = new stdClass();
        $temp->content = $module->content;
        $temp->params = $module->params;
        $temp->title = $module->title;
        $temp->id = $module->id;
        $modules[] = $temp;
        $modulecount--;
    }
}


