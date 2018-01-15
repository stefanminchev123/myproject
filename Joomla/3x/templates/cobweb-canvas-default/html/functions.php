<?php


function K2ItemDetails($details) {

    $db = JFactory::getDbo();

    $item = array();
 //echo "<pre>" . print_r( $details , true) . "</pre>";
    $h1 = str_replace("amp;", "", $details->href);
    $href = explode("&", $h1);

     $k2_id = explode(":",  $details->slug  );

    $com_k2 = 0;
     if( isset( $details->extra_fields ) ) $com_k2 = 1;

    if ($com_k2 == 1) {

        $sql = "SELECT id, name, value, type FROM #__k2_extra_fields";
        $db->setQuery($sql);
        $data_array = $db->loadAssocList();

        foreach ($data_array as $k => $val){

            $_value = json_decode($val["value"], true);

            foreach( $_value as $m => $value_data ){

        	   $value[ $value_data["value"] ] = $value_data;
        	}

            if( $value[0]["alias"] != "" ) $extra_fields_list[ $val["id"] ]["alias"]  = $value[0]["alias"];
             else $extra_fields_list[ $val["id"] ]["alias"]  = $val["name"];


            $extra_fields_list[ $val["id"] ]["field_name"] = $val["name"];
            $extra_fields_list[ $val["id"] ]["value"]      = $value;
            $extra_fields_list[ $val["id"] ]["type"]       = $val["type"];
           // $extra_fields_list[ $val["id"] ]["alias"]      = $val["alias"];


        }

    //   echo '<pre>'.print_r( $extra_fields_list ,1).'</pre>';

        $sql = "SELECT * FROM #__k2_items WHERE id = " . $k2_id[0];
        $db->setQuery($sql);
        $item = $db->loadAssoc();
        $item["params"] = json_decode($item["params"], true);
        $_item_extra_fields = json_decode($item["extra_fields"], true);
        foreach( $_item_extra_fields as $m => $efdata ){

        	 $item_extra_fields[ $efdata["id"] ] = $efdata;
        }

        $item["extra_fields"] = array();
       //echo '<pre>'.print_r( $item_extra_fields ,1).'</pre>';
        foreach ($item_extra_fields as $__extra_id => $extra_value) {

            $extra_id = $extra_value["id"];

            $extra_value["value"] = is_array($extra_value["value"]) ? $extra_value["value"][0] : $extra_value["value"];
            $extra_key            = $extra_fields_list[ $extra_value['id'] ]['alias'];
            $value_data 		  = $extra_fields_list[ $extra_value['id'] ]["value"][ $extra_value["value"] ];

            //TODO: не се обаработват multi select полета
                 $item["extra_fields"][ $extra_key ]["alias"]       = $extra_fields_list[ $extra_value['id'] ]["alias"]; ;
                 $item["extra_fields"][ $extra_key ]["id"]          = $extra_value["id"]; // extra_fields_list
                 $item["extra_fields"][ $extra_key ]["field_name"]  = $extra_fields_list[ $extra_value['id'] ]["field_name"];
                 $item["extra_fields"][ $extra_key ]["value"]       = $extra_fields_list[ $extra_value['id'] ]["value"][  $extra_value["value"] ]["name"];



//           echo $extra_id. ' == '.$item["extra_fields"][ $extra_key ]["field_name"] .'   ----'. $extra_key .'---> '.
//           		$extra_fields_list[ $extra_value['id'] ]["value"][  $extra_value["value"] ]["name"] .' === '. $extra_fields_list[ $extra_value['id'] ]["field_name"] ." <=== end <BR>";

 //echo '<pre>'.$item["extra_fields"][ $extra_key ]["value"].'   -------    '.$item["extra_fields"][ $extra_key ]["field_name"].'</pre>';

        } // foreach

        $fulltext = explode("\n", $item["fulltext"]);


        if( file_exists( JPATH_BASE.'/media/k2/items/cache/'.md5("Image". $k2_id[0] ).'_M.jpg' ) )
          $item["image"] = JURI::base() . 'media/k2/items/cache/'.md5("Image". $k2_id[0] ).'_M.jpg';
        else $item["image"] = "";
    }
    return $item;

}

    function getExtraField( $item , $extraFieldAlias  ){
        $extraField = '';
        foreach ($item->extraFields as $key => $extraField){
            if($extraField->alias == $extraFieldAlias ) {
                return  $extraField;
            }
        }

       return '';
    }

    function getExtra_Field( $item , $extraFieldAlias  ){
        $fieldValue = '';
        $fields = json_decode( $item->extra_fields );
        $fieldsArr = array();
        foreach ($fields as $key => $value) {
            $fieldsArr[$key] = $value->value;
        }

        $db    = JFactory::getDBO();
        $query = "SELECT id, name, alias FROM `#__k2_extra_fields` WHERE `state` = 1";
        $db->setQuery($query);
        $extra_fields = $db->loadAssocList();

        foreach ($extra_fields as $key => $field) {
            if($field['alias'] == $extraFieldAlias) {
                $fieldValue = $fieldsArr[$field['id']];
            }
        }

       return $fieldValue;
    }


      function FillExtraField( $IDExtraField ) {
        $db    = JFactory::getDBO();
        $query = "SELECT extra_fields FROM `#__k2_items` WHERE `published` = 1";
        $db->setQuery($query);
        $extra_fields = $db->loadAssocList();


        $_extraFields = array();
        $__extraFields = array();
        if (count($extra_fields)>0) {
            foreach ( $extra_fields as $_key => $_values ) {

                $_extra_fields = json_decode( $_values['extra_fields'],1 );

                if (count($_extra_fields)>0) { foreach ($_extra_fields as $kk => $vv ) { $_extraFields[$vv['id']] = $vv['value']; }
                    $__extraFields[$_extraFields[$IDExtraField]] = $_extraFields[$IDExtraField];
                }

            }
            return $__extraFields;
        }
    }

function getExtraFieldNames() {
    $db    = JFactory::getDBO();
    $query = "SELECT * FROM `#__k2_extra_fields` WHERE `published` = 1";
    $db->setQuery($query);
    $_extra_fields = $db->loadAssocList();

    foreach($_extra_fields as $extraField){
        $extra_fields[$extraField['id']]  =   $extraField['name'];
    }
    return $extra_fields;
}

    function GetTypeExtraField( $getName = '') {
        $db    = JFactory::getDBO();
            $query = "SELECT `id`, `value`  FROM `#__k2_extra_fields` WHERE `value` LIKE '%{$getName}%'";


        $db->setQuery($query);
        $data = $db->loadAssocList();

        $Typefields = json_decode( $data[0]['value'],1 );
        $_Typefields = array();
        if(count($Typefields)>0)
            foreach( $Typefields as $key => $value) {
                $_Typefields[$value['name']] = $value['value'];
                $_Typefields['id'] = $data[0]['id'];
            }

         return $_Typefields;

//        $Typefields
    }

    function GroupExtraField ( $ExtraFieldID ) {
        $db    = JFactory::getDBO();
        $query = "SELECT `group`  FROM `#__k2_extra_fields` WHERE `id` = {$ExtraFieldID}";
        $db->setQuery($query);
        $data = $db->loadAssocList();
        return $data[0];
    }

    function getExtraFieldGroupName ( $groupId ) {
        $db    = JFactory::getDBO();
        $query = "SELECT `name`  FROM `#__k2_extra_fields_groups` WHERE `id` = {$groupId}";
        $db->setQuery($query);
        $data = $db->loadResult();
        return $data;
    }


    function getK2itemsIdByCatId( $catId ) {
        $db    = JFactory::getDBO();
        $query = "SELECT `id`  FROM `#__k2_items` WHERE `catid` = {$catId} and published = 1";
        $db->setQuery($query);
        $data = $db->loadColumn();
        return $data;
    }

    function translator( $text ) {
        $lang = JFactory::getLanguage();
        $langTag = $lang->getTag();
        $languages = JLanguageHelper::getLanguages('lang_code');
        $lng = $languages[$langTag];

        $langFileName = 'lang_'.$lng->sef;

        include JPATH_THEMES . '/livingart/languages/' . $langFileName . '.php';

        foreach ($translates as $key => $value) {
            $removeOpenTag = '';
            $removeCloseTag = '';
            $clearValue = '';

            $removeOpenTag = str_replace('<div>', '', $text);
            $removeCloseTag = str_replace('</div>', '', $removeOpenTag);
            $clearValue = trim($removeCloseTag);

            if(strtolower( trim($key) ) == strtolower( $clearValue )) {
                $translatedTxt = $value;
            }
        }

        if( empty($translatedTxt) ) {
            $translatedTxt = $text;
        }

        return $translatedTxt;
    }

?>