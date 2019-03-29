<?php

class ObjectLogger extends ObjectModel{

   public static $definition = array(
       'table' => 'objectlogguer',
       'primary' => 'id_objectlogguer',
       'fields' => array(
           'affected_object' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'copy_post' => false),
           'action_type' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 255),
           'object_type' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'size' => 255),
           'message' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName'),
           'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
           
        ),
    );


}

