<?php

defined('_JEXEC') or die;

require_once JPATH_SITE.'/components/com_monuments/helpers/requsts.php';

class MonumentsModelMonument extends JModelList
{

    public function getMonument(){


        $jinput = JFactory::getApplication()->input;

        $params['id'] = $jinput->get('id', '', 'filter');

        $RestApi = new RestApi();


    /**
    *
    * request( $url, $data )
    *
    * $url  - стринг с URL-то към сървъра, кой който искаме да изпратим заявка
    * $data - масив с GET/POST параметрите, които искаме да изпратим към сървъра
    *
    * Метод: getMonuments
    * Връща всички паметници
    * @param monument_type - незадължителен параметър. Ако се постави връща паметниците от определен вид.
    * @return string
    *
    * * Метод: getMonument
    * Връща цялата информация за даден паметник
    * @param monument_id - задължителен параметър. ID-то на конкретния паметник
    * @return string
    */


            $jinput = JFactory::getApplication()->input;
            $params = $jinput->get('formdata', '', 'filter');

        if( isset( $params['id']) )
            $data['formdata']['id']  = $params['id'];

        $data['method']          = 'Web.getMonument';

        $monumentDetails  = $RestApi->request( $data );

        if( !is_array( $monumentDetails ) ) $monumentDetails = array();


        return $monumentDetails;

    }



}
