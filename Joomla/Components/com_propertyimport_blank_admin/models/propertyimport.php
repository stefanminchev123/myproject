<?php
/**
 * Created from Cobweb Software.
 * Date: 15/2/2016
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.model');
jimport('joomla.application.component.helper');

require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/propertyimport_options_helper.php';

class PropertyImportModelPropertyImport extends JModelLegacy
{
    function saveOptions( $options ){
        $res = "Model" . "<pre>DEBUG Model >>>" . print_r($options, 1) . "<<<DEBUG</pre>";

        $propertyImportHelperOptions = new propertyImportHelperOptions;

        $save = $propertyImportHelperOptions->save('test');

        echo "<pre>DEBUG>>>" . print_r($save, 1) . "<<<DEBUG</pre>";
        exit;
    }

}