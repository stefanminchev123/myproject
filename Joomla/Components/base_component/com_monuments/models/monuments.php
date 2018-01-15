<?php

 /**
    *
    * request( $url, $data )
    *
    * $url  - стринг с URL-то към сървъра, кой който искаме да изпратим заявка
    * $data['formdata'] - масив с GET/POST параметрите, които искаме да изпратим към сървъра
    *
    * Метод: Web.getMonuments
    * Връща всички паметници
    * @param monument_type - незадължителен параметър. Ако се постави връща паметниците от определен вид.
    * @return string
    *
    * * Метод: Web.getMonument
    * Връща цялата информация за даден паметник
    * @param monument_id - задължителен параметър. ID-то на конкретния паметник
    * @return string
    *
    *    * * Метод: Web.getMonumentFields
    * Връща цялата информация за даден паметник
    * @param $field - Име на полето, на което искаме да върнем стоиностите
    * @return string
    * 
    */

defined('_JEXEC') or die;

require_once JPATH_SITE.'/components/com_monuments/helpers/requsts.php';

class MonumentsModelMonuments extends JModelList
{

    public function getMonuments(){


    	$jinput = JFactory::getApplication()->input;

        $params = $jinput->get('formdata', '', 'filter');

    	$RestApi = new RestApi();

        $data['method']         = 'Web.getMonuments';// web.Monuments
    	// $data['formdata']['fields'] 		= 'd12';// web.Monuments
    	// $data['formdata']['monument_id'] 	= 7;

        if( isset( $params['field_d12']) )
            $data['formdata']['monument_type']  = $params['field_d12'];

        if( isset( $params['field_t6']) )
            $data['formdata']['field_t6'] 	= $params['field_t6'];
		
        if( isset( $params['title'] ) )
            $data['formdata']['title'] = $params['title'];

        if( isset( $params['field_d30'] ) )
            $data['formdata']['field_d30'] = $params['field_d30'];

        if( isset( $params['field_d24_y'] ) )
            $data['formdata']['field_d24_y'] = $params['field_d24_y'];

    	$res = $RestApi->request( $data );

        $this->createFileWithFieldsData('d12');
        $this->createFileWithFieldsData('t6');

        return $res;
    }

    public function createFileWithFieldsData($field){
        $RestApi = new RestApi();

        // Взимане на Видовете паметници и записването им във файл
        $types['method']         = 'Web.getMonumentFields';
        $types['formdata']['fields'] 		= $field;

        $monmentTypes = $RestApi->request( $types );

        if( !file_exists(JPATH_BASE.'/tmp/com_monuments/') ){
            mkdir(JPATH_BASE.'/tmp/com_monuments/', 0755);
        }

        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $before_one_hour = strtotime('-1 hour', $timestamp);

        if( !file_exists(JPATH_BASE.'/tmp/com_monuments/field_' . $field . '.txt') ){
            $typesFile = fopen(JPATH_BASE . '/tmp/com_monuments/field_'.$field.'.txt', "w") or die("Unable to open file!");
            $txt = json_encode( $monmentTypes, JSON_UNESCAPED_UNICODE );
            fwrite($typesFile, $txt);
        } elseif( filectime(JPATH_BASE . '/tmp/com_monuments/field_'.$field.'.txt') < $before_one_hour ){
            $typesFile = fopen(JPATH_BASE . '/tmp/com_monuments/field_'.$field.'.txt', "w") or die("Unable to open file!");
            $txt = json_encode( $monmentTypes, JSON_UNESCAPED_UNICODE );
            fwrite($typesFile, $txt);
        }

    }


}
