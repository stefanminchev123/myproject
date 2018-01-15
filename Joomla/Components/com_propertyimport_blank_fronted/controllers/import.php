<?php
/**
 * Created by IntelliJ IDEA.
 * User: dev
 * Date: 1/12/16
 * Time: 11:58 AM
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class PropertyimportControllerImport extends JControllerLegacy
{
    public function __construct()
    {

        parent::__construct();

    }

    public function run()
    {
        $this->addModelPath(JPATH_ADMINISTRATOR . '/components/com_propertyimport/models');
        $model       = $this->getModel('import');
        $res = $model->run();
    }

}
