<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

$app = JFactory::getApplication();

require_once JPATH_SITE . '/components/com_users/helpers/route.php';

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');


jimport('joomla.language.helper');
$languages = JLanguageHelper::getLanguages('lang_code');
$lang_code = JFactory::getLanguage()->getTag();
$sef = $languages[$lang_code]->sef;

$document = JFactory::getDocument();
$css = JURI::root() . '/templates/'. $app->getTemplate() .'/html/mod_login/cwbLoginNew_logout.css';
$script = JURI::root() . '/templates/'. $app->getTemplate() .'/html/mod_login/login.js';
$document->addStyleSheet($css);
$document->addScript($script);


?>

<div class="cobweb-login">
    <div class="login-btn">
        <div class="login-links">
            <i class="fa fa-sign-in fa-2"></i>
            <span class="loginBnt"><?php echo JText::_('MOD_USER_GREET'); ?></span>
            <span class="registerBtn">
                <?php if ($params->get('name') == 0) : {
                    echo htmlspecialchars($user->get('name'));
                } else : {
                    echo htmlspecialchars($user->get('username'));
                } endif; ?>
            </span>
        </div>
    </div>
    <div class="clear"></div>


    <div class="login-form-box">
        <a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=user&layout=editaddress') ?>"><?php echo JText::_('MOD_USER_EDIT_PROFILE'); ?></a>
        <a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=orders&layout=list') ?>"><?php echo JText::_('MOD_USER_USER_ORDERS'); ?></a>
        <form action="<?php echo JRoute::_(htmlspecialchars(JUri::getInstance()->toString()), true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical">
            <span class="logout-button">
                <input type="submit" name="Submit" class="btn btn-danger" value="<?php echo JText::_('JLOGOUT'); ?>" />
                <input type="hidden" name="option" value="com_users" />
                <input type="hidden" name="task" value="user.logout" />
                <input type="hidden" name="return" value="<?php echo $return; ?>" />
                <?php echo JHtml::_('form.token'); ?>
            </span>
        </form>

    </div>
</div>