<?php
	defined('_JEXEC') or die('Restricted access');

	jimport('joomla.application.component.view');

	class MonumentsViewMonuments extends JViewLegacy
	{
		function display($tpl = null)
		{
	    	$model      	= 	$this->getModel();

			$this->monuments = $model->getMonuments();

			parent::display($tpl);
		}


	}
?>
