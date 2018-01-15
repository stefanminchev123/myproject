<?php
	defined('_JEXEC') or die('Restricted access');

	jimport('joomla.application.component.view');

	class MonumentsViewMonument extends JViewLegacy
	{
		function display($tpl = null)
		{
	    	$model      	= 	$this->getModel();
			$this->monument = $model->getMonument();

	    	$this->monumentDetails =  $model->getMonument();

        	parent::display($tpl);
		}


	}
?>
