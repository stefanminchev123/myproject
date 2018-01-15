<?php
     //get the array containing all the script declarations
     $document = JFactory::getDocument();
     $app = JFactory::getApplication();
     $headData = $document->getHeadData();
     $scripts = $headData['scripts'];
     //remove your script, i.e. mootools

     unset($scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
     unset($scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
     unset($scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
     $headData['scripts'] = $scripts;
     $document->setHeadData($headData);
?>