<?php
	defined('_JEXEC') or die('Restricted access');

	jimport('joomla.application.component.view');

	class MapviewViewMapview extends JViewLegacy
	{
		function display($tpl = null)
		{
	    	$model      	= 	$this->getModel();

        	parent::display($tpl);
		}


	}
?>
