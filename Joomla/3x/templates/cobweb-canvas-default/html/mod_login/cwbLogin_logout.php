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
$script = JURI::root() . '/templates/'. $app->getTemplate() .'/html/mod_login/login.js';
$document->addScript($script);

?>

<div class="cobweb-login">
    <div class="login-btn">
        <div class="login-links">
            <i class="fa fa-sign-in"></i>
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
        <a href="index.php?option=com_virtuemart&view=user&layout=editaddress"><?php echo JText::_('MOD_USER_EDIT_PROFILE'); ?></a>
        <a href="index.php?option=com_virtuemart&view=orders&layout=list"><?php echo JText::_('MOD_USER_USER_ORDERS'); ?></a>
        <form action="<?php echo JRoute::_(htmlspecialchars(JUri::getInstance()->toString()), true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical">
            <span class="logout-button">
                <input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
                <input type="hidden" name="option" value="com_users" />
                <input type="hidden" name="task" value="user.logout" />
                <input type="hidden" name="return" value="<?php echo $return; ?>" />
                <?php echo JHtml::_('form.token'); ?>
            </span>
        </form>

    </div>
</div>

<style>

.cobweb-login {
    position: relative;
    line-height: 14px;
}

.login-links i{
    padding: 0 2px;
}

.login-icon{
    margin-right: 2px;
}

.login-form-box {
    display: none;
}

.cobweb-login .login-form-box {
    position: absolute;
    top: 44px;
    background: #fcfcfc;
    border-left: 1px solid #DDD;
    border-right: 1px solid #DDD;
    border-bottom: 1px solid #DDD;
    border-top: 1px solid #154b95;
    padding: 20px;
    z-index: 9996;
    left: auto;
    right: 0;
    min-width: 320px;
}

.cobweb-login .login-form-box:after{
    top: -10px;
    width: 0;
    height: 0;
    right: 30px;
    z-index: 2;
    content: " ";
    display: block;
    position: absolute;
    border-bottom: 8px solid #154b95;
    border-right: 8px solid transparent;
    border-left: 8px solid transparent;
}

    .cobweb-login .login-form-box a{
        display: block;
        padding: 10px 0;
        border-bottom: 1px solid #DDD;
    }

    .cobweb-login #login-form {
        width: 200px;
        margin-bottom: 0;
    }
    .cobweb-login ul {
        list-style: none;
    }

    .cobweb-login .input-prepend {
        margin-bottom: 10px;
    }

    .logout-button {
        display: block;
        margin-top: 15px;
    }

</style>