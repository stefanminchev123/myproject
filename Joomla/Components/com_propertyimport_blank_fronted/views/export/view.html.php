<?php
/**
 * Created by IntelliJ IDEA.
 * User: dev
 * Date: 1/12/16
 * Time: 11:56 AM
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
JModelLegacy::addIncludePath(JPATH_SITE . '/administrator/components/com_mapview/models');

class MapviewViewExport extends JViewLegacy
{
    function display($tpl = null)
    {
//        $model = $this->getModel();
//
//        $jinput = JFactory::getApplication()->input;
//        $catId =  $jinput->get('catId', '', 'filter');

//        $this->list = $model->getItems( $catId );

        parent::display($tpl);
    }


}