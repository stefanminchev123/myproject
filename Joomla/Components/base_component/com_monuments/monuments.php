<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

// Require the base controller

$controllerName = JFactory::getApplication()->input->get('view')


require_once( JPATH_COMPONENT.'/controller.php' );

    $controller = JControllerLegacy::getInstance( 'Monuments' );
    $controller->execute(JFactory::getApplication()->input->get('task'));




    $controller->redirect();


?>
