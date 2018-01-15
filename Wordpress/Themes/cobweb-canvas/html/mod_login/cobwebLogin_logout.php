<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_users/helpers/route.php';

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');


jimport('joomla.language.helper');
$languages = JLanguageHelper::getLanguages('lang_code');
$lang_code = JFactory::getLanguage()->getTag();
$sef = $languages[$lang_code]->sef;
?>


<div class="cobweb-login">
	<div class="login-btn"><div class="login-icon"><i class="fa fa-sign-in"></i></div><div class="login-links"><span class="loginBnt"><?php echo JText::_('MOD_USER_GREET'); ?></span><br><span class="registerBtn">
				<?php if ($params->get('name') == 0) : {
					echo htmlspecialchars($user->get('name'));
				} else : {
					echo htmlspecialchars($user->get('username'));
				} endif; ?></span></div></div>


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
	}

	.login-btn {
		border: 1px solid #ccc;
		padding: 12px 20px 12px 20px;
		z-index: 9996;
		position: relative;
		background: #fff;
		text-align: center;
		cursor: pointer;
	}

	.login-form-box {
		display: none;
	}

	.cobweb-login .login-form-box {
		position: absolute;
		top: 54px;
		overflow: auto;
		border: 1px solid #ccc;
		padding: 20px;
		z-index: 9996;
	}

	.registerBtn {
		font-size: 12px;
	}

	.cobweb-login #login-form {
		width: 200px;
	}
	.cobweb-login ul {
		list-style: none;
	}

	.cobweb-login .input-prepend {
		margin-bottom: 10px;
	}

	.logout-button {
		display: block;
		margin-top: 20px;
	}

</style>

<script>
	jQuery( document).ready(function(){
		var div = '<div id="login-form-bg" style="display:block;position:absolute; background: rgba(0,0,0,0.25); width:100%; height: 100%; z-index:9995"></div>';
		jQuery( document).on('click', '.login-btn', function(){
			jQuery('.login-form-box').slideToggle(200);

			if( jQuery('.wrapper').find('#login-form-bg').length > 0 ){
				jQuery('#login-form-bg').fadeOut(100, function(){
					jQuery('#login-form-bg').remove();
				});
			} else {
				jQuery(div).hide().prependTo('.wrapper').fadeIn(100);
			}
		});

		jQuery( document).on('click', '#login-form-bg', function(){
			jQuery('.login-form-box').slideToggle(100);
			jQuery('#login-form-bg').fadeOut(100, function(){
				jQuery('#login-form-bg').remove();
			});
		});


	});
</script>