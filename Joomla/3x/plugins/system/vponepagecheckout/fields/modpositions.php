<?php
/*--------------------------------------------------------------------------------------------------------
# VP One Page Checkout - Joomla! System Plugin for VirtueMart 3
----------------------------------------------------------------------------------------------------------
# Copyright:     Copyright (C) 2012 - 2015 VirtuePlanet Services LLP. All Rights Reserved.
# License:       GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
# Author:        Abhishek Das
# Email:         info@virtueplanet.com
# Websites:      http://www.virtueplanet.com
----------------------------------------------------------------------------------------------------------
$Revision: 19 $
$LastChangedDate: 2015-01-24 19:28:10 +0530 (Sat, 24 Jan 2015) $
$Id: modpositions.php 19 2015-01-24 13:58:10Z abhishekdas $
----------------------------------------------------------------------------------------------------------*/
defined('_JEXEC') or die;

class JFormFieldModPositions extends JFormField
{
	protected $type = 'ModPositions';

	function getInput()
	{
		if(version_compare(JVERSION, '3.0.0', 'ge'))
		{
			require_once JPATH_ADMINISTRATOR . '/components/com_templates/helpers/templates.php';
			
			if(!class_exists('ModulesHelper'))
			{
				require_once JPATH_ADMINISTRATOR . '/components/com_modules/helpers/modules.php';
			}

			// Load language files
			$language = JFactory::getLanguage();
			// Loads the current language-tag
			$language_tag = $language->getTag(); 
			$language->load('com_modules', JPATH_ADMINISTRATOR, $language_tag, true);

			JHtml::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_modules/helpers/html');
			
			$clientId          = 0;
			$state             = 1;
			$selectedPosition  = $this->value;
			$positions         = JHtml::_('modules.positions', $clientId, $state, $selectedPosition);

			// Add custom position to options
			$customGroupText = JText::_('COM_MODULES_CUSTOM_POSITION');

			// Build field
			$attr = array(
				'id'             => $this->id,
				'list.select'    => $this->value,
				'list.attr'      => 'class="chzn-custom-value" '
				                    . 'data-custom_group_text="' . $customGroupText . '" '
				                    . 'data-no_results_text="' . JText::_('COM_MODULES_ADD_CUSTOM_POSITION') . '" '
				                    . 'data-placeholder="' . JText::_('COM_MODULES_TYPE_OR_SELECT_POSITION') . '" '
			);
			
			return JHtml::_('select.groupedlist', $positions, $this->name, $attr);
		}
		
		// For Joomla! 2.5
		return '<input type="text" name="' . $this->name . '" id="' . $this->id . '" class="readonly" value="' . $this->value . '" readonly="readonly"/>';
	}
}