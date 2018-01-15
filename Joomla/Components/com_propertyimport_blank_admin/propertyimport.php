<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

// Require the base controller

require_once( JPATH_COMPONENT.'/controller.php' );

$doc = JFactory::getDocument();

if($controller = JRequest::getWord('view')) {

     $path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';

    if (file_exists($path)) { require_once $path;}
     else { $controller = ''; }
}


$classname    = 'PropertyImportController'.$controller;;
$controller   = new $classname( );

$controller->execute( JRequest::getVar( 'task' ) );
$controller->redirect();

?>
