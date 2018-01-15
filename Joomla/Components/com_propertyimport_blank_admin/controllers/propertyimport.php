<?php

defined('_JEXEC') or die;

jimport( 'joomla.application.component.controller' );

/**
 * Newsfeed controller class.
 *
 * @since  1.6
 */
class PropertyimportControllerPropertyimport extends JControllerLegacy
{

    public function __construct(){
        parent::__construct();
    }

    public function save()
    {

        // Get the input
        $input               = JFactory::getApplication()->input;
        $options['hostname'] = $input->get('hostname', '');
        $options['port']     = $input->get('port', '');
        $options['folder']   = $input->get('folder', '');
        $options['username'] = $input->get('username', '');
        $options['ftppass']  = $input->get('ftppass', '');

//      Get the model
        $model = $this->getModel('Propertyimport');

        $return = $model->saveOptions($options);

    }

}
