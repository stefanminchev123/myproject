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
 // echo '<pre>'.print_r($item,1).'</pre>';
    return $item;

}


    function getExtraField( $item , $extraFieldAlias  ){ 
        foreach ($item->extraFields as $key=>$extraField){
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


    function extraFieldTranslator( $extraField ) {
        $lang = JFactory::getLanguage();
        $langTag = $lang->getTag();
        $languages = JLanguageHelper::getLanguages('lang_code');
        $lng = $languages[$langTag];       
        
        if($lng->sef == 'de'){

            switch ($extraField) {
                case 'Region': $extraFieldTr = 'Region'; break;
                case 'Location': $extraFieldTr = 'Location'; break;
                case 'City': $extraFieldTr = 'Stadt'; break;
                case 'Floor': $extraFieldTr = 'Etagen'; break;
                case 'Land': $extraFieldTr = 'Grund'; break;
                case 'Rooms': $extraFieldTr = 'Zimmer'; break;
                case 'Bedrooms': $extraFieldTr = 'Schlafzimmer'; break;
                case 'Bathrooms': $extraFieldTr = 'Bäder'; break;
                case 'Price': $extraFieldTr = 'Preis'; break;
                case 'Agency fee +Vat': $extraFieldTr = 'Agency fee +Vat'; break;
                case 'Type': $extraFieldTr = 'Objektart'; break;
                case 'Group': $extraFieldTr = 'Group'; break;
                case 'Distance to Sea': $extraFieldTr = 'Distance to Sea'; break;
                case 'ATM\'s': $extraFieldTr = 'ATM\'s'; break;
                default: $extraFieldTr = $extraField; break;
            }
        } elseif ($lng->sef == 'it') {
            switch ($extraField) {
                case 'Region': $extraFieldTr = 'Regione'; break;
                case 'Location': $extraFieldTr = 'Location'; break;
                case 'City': $extraFieldTr = 'Città'; break;
                case 'Floor': $extraFieldTr = 'Superficie'; break;
                case 'Land': $extraFieldTr = 'Terreno'; break;
                case 'Rooms': $extraFieldTr = 'Vani'; break;
                case 'Bedrooms': $extraFieldTr = 'Camera letto'; break;
                case 'Bathrooms': $extraFieldTr = 'Bagni'; break;
                case 'Price': $extraFieldTr = 'Prezzo'; break;
                case 'Agency fee +Vat': $extraFieldTr = 'Agency fee +Vat'; break;
                case 'Type': $extraFieldTr = 'Tipo di immobile'; break;
                case 'Group': $extraFieldTr = 'Group'; break;
                case 'Distance to Sea': $extraFieldTr = 'Distance to Sea'; break;
                case 'ATM\'s': $extraFieldTr = 'ATM\'s'; break;
                default: $extraFieldTr = $extraField; break;
            }
        } elseif ($lng->sef == 'ru') {
            switch ($extraField) {
                case 'Region': $extraFieldTr = 'Область'; break;
                case 'Location': $extraFieldTr = 'Location'; break;
                case 'City': $extraFieldTr = 'Город'; break;
                case 'Floor': $extraFieldTr = 'Этажи'; break;
                case 'Land': $extraFieldTr = 'Участок'; break;
                case 'Rooms': $extraFieldTr = 'Комнаты'; break;
                case 'Bedrooms': $extraFieldTr = 'Спальная комната'; break;
                case 'Bathrooms': $extraFieldTr = 'Ванные комнаты'; break;
                case 'Price': $extraFieldTr = 'Цена'; break;
                case 'Agency fee +Vat': $extraFieldTr = 'Agency fee +Vat'; break;
                case 'Type': $extraFieldTr = 'Тип собственности'; break;
                case 'Group': $extraFieldTr = 'Group'; break;
                case 'Distance to Sea': $extraFieldTr = 'Distance to Sea'; break;
                case 'ATM\'s': $extraFieldTr = 'ATM\'s'; break;
                default: $extraFieldTr = $extraField; break;
            }
        } elseif ($lng->sef == 'cs') {
            switch ($extraField) {
                case 'Region': $extraFieldTr = 'Region'; break;
                case 'Location': $extraFieldTr = 'Location'; break;
                case 'City': $extraFieldTr = 'Město'; break;
                case 'Floor': $extraFieldTr = 'Podlaží'; break;
                case 'Land': $extraFieldTr = 'Pozemek'; break;
                case 'Rooms': $extraFieldTr = 'Místností'; break;
                case 'Bedrooms': $extraFieldTr = 'Bedrooms'; break;
                case 'Bathrooms': $extraFieldTr = 'Koupelny'; break;
                case 'Price': $extraFieldTr = 'Cena'; break;
                case 'Agency fee +Vat': $extraFieldTr = 'Agency fee +Vat'; break;
                case 'Type': $extraFieldTr = 'Property Type'; break;
                case 'Group': $extraFieldTr = 'Group'; break;
                case 'Distance to Sea': $extraFieldTr = 'Distance to Sea'; break;
                case 'ATM\'s': $extraFieldTr = 'ATM\'s'; break;
                default: $extraFieldTr = $extraField; break;
            }
        }
        else {
            $extraFieldTr = $extraField;
        }

        return $extraFieldTr;
    }
    
    function limitText($string, $limitWords){
        $textArr = explode(" ", $string);
        $output = '';
        for ($i=0; $i < $limitWords; $i++) { 
            $output .= $textArr[$i] . ' ';
        }
        if(count($textArr) > $limitWords) {
            $output .= "...";
        }

        return $output;
    }
