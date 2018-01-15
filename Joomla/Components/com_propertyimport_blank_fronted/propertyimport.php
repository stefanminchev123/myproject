<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

// Require the base controller

require_once( JPATH_COMPONENT.'/controller.php' );

    $controller = JControllerLegacy::getInstance( 'Propertyimport' );
    $controller->execute(JFactory::getApplication()->input->get('task'));
    $controller->redirect();

?>
