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

$document = JFactory::getDocument();
$css = JURI::root() . '/templates/'. $app->getTemplate() .'/html/mod_login/login.css';
$script = JURI::root() . '/templates/'. $app->getTemplate() .'/html/mod_login/login.js';
$document->addStyleSheet($css);
$document->addScript($script);

jimport('joomla.language.helper');
$languages = JLanguageHelper::getLanguages('lang_code');
$lang_code = JFactory::getLanguage()->getTag();
$sef = $languages[$lang_code]->sef;

?>

<div class="cobweb-login">
    <div class="login-btn">
    <div class="login-links">
        <i class="fa fa-sign-in"></i>
        <span class="loginBnt">Вход</span>
    </div>
    </div>


    <div class="login-form-box">
        <form
            action="<?php echo JRoute::_(htmlspecialchars(JUri::getInstance()->toString()), true, $params->get('usesecure')); ?>"
            method="post" id="login-form" class="form-inline">
            <?php if ($params->get('pretext')) : ?>
                <div class="pretext">
                    <p><?php echo $params->get('pretext'); ?></p>
                </div>
            <?php endif; ?>
            <div class="userdata">
                <div id="form-login-username" class="control-group">
                    <div class="controls">
                        <?php if (!$params->get('usetext')) : ?>
                            <div class="input-prepend">
                                <input id="modlgn-username" type="text" name="username" class="input-small" tabindex="0"
                                           size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>"/>
                                <span class="add-on">
                                <span class="icon-user"
                                      title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>">
                                </span>
                            </span>
                            </div>
                        <?php else: ?>
                            <label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
                            <input id="modlgn-username" type="text" name="username" class="input-small" tabindex="0"
                                   size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>"/>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="form-login-password" class="control-group">
                    <div class="controls">
                        <?php if (!$params->get('usetext')) : ?>
                            <div class="input-prepend">
                                <input id="modlgn-passwd" type="password" name="password" class="input-small"
                                           tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"/>
                                <span class="add-on">
                                    <span class="icon-lock" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"></span>
                                </span>
                            </div>
                        <?php else: ?>
                            <label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
                            <input id="modlgn-passwd" type="password" name="password" class="input-small" tabindex="0"
                                   size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"/>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (count($twofactormethods) > 1): ?>
                    <div id="form-login-secretkey" class="control-group">
                        <div class="controls">
                            <?php if (!$params->get('usetext')) : ?>
                                <div class="input-prepend input-append">
                        <span class="add-on">
                            <span class="icon-star hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>">
                            </span>
                                <label for="modlgn-secretkey"
                                       class="element-invisible"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?>
                                </label>
                        </span>
                                    <input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey"
                                           class="input-small" tabindex="0" size="18"
                                           placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>"/>
                        <span class="btn width-auto hasTooltip"
                              title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
                            <span class="icon-help"></span>
                        </span>
                                </div>
                            <?php else: ?>
                                <label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY') ?></label>
                                <input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey"
                                       class="input-small" tabindex="0" size="18"
                                       placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>"/>
                                <span class="btn width-auto hasTooltip"
                                      title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
                        <span class="icon-help"></span>
                    </span>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div id="form-login-remember" class="control-group checkbox">
                        <label for="modlgn-remember"
                               class="control-label"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label> <input
                            id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
                    </div>
                <?php endif; ?>
                <div id="form-login-submit" class="control-group">
                    <div class="controls">
                        <button type="submit" tabindex="0" name="Submit"
                                class="btn-primary button button-3d"><?php echo JText::_('JLOGIN') ?></button>
                    </div>
                </div>
                <?php
                $usersConfig = JComponentHelper::getParams('com_users'); ?>
                <ul class="unstyled">
                    <li>
                        <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset&Itemid=' . UsersHelperRoute::getResetRoute()); ?>">
                            <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
                    </li>
                </ul>
                <hr>
                <?php if ($usersConfig->get('allowUserRegistration')) : ?>
                    <div class="registrationBtn">
                        <button class="btn-primary button button-3d">
                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=' . UsersHelperRoute::getRegistrationRoute()); ?>">
                                <?php echo JText::_('MOD_LOGIN_REGISTER'); ?>
                            </a>
                        </button>
                    </div>
                <?php endif; ?>
                <input type="hidden" name="option" value="com_users"/>
                <input type="hidden" name="task" value="user.login"/>
                <input type="hidden" name="return" value="<?php echo $return; ?>"/>
                <?php echo JHtml::_('form.token'); ?>
            </div>
            <?php if ($params->get('posttext')) : ?>
                <div class="posttext">
                    <p><?php echo $params->get('posttext'); ?></p>
                </div>
            <?php endif; ?>
        </form>

    </div>
</div>