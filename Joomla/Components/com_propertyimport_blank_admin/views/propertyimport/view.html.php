<?php
	defined('_JEXEC') or die('Restricted access');

	jimport('joomla.application.component.view');

	class PropertyimportViewPropertyimport extends JViewLegacy
	{
		function display($tpl = null)
		{
			$this->addToolbar();
        	parent::display($tpl);
		}

		protected function addToolBar()
		{
			JToolBarHelper::title( 'Dashboard of property import component');
			JToolbarHelper::save('save', 'Save');
		}

	}

