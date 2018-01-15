<?php
/**
 * Created by IntelliJ IDEA.
 * User: dev
 * Date: 1/12/16
 * Time: 11:56 AM
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
require_once( JPATH_COMPONENT.'/controller.php' );

class PropertyimportViewImport extends JViewLegacy
{
    function display($tpl = null)
    {
        $controller = JControllerLegacy::getInstance( 'import' );
        $controller->execute(JFactory::getApplication()->input->get('task'));
        $controller->redirect();

        parent::display($tpl);
    }


}