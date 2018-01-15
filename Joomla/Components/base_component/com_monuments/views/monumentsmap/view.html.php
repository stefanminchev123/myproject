<?php
	defined('_JEXEC') or die('Restricted access');

	jimport('joomla.application.component.view');

	class monumentsViewmonumentsmap extends JViewLegacy
	{
		function display($tpl = null)
		{
	    	$model      	= 	$this->getModel();

			$this->monuments = $model->getMonumentsMarkers();

			parent::display($tpl);
		}


	}
?>
