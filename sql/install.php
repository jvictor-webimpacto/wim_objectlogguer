<?php

$sql = array();

    $sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'objectlogguer` (
        `id_objectlogguer` int(11) NOT NULL AUTO_INCREMENT,
        `affected_object` int(11) NOT NULL,
        `action_type` VARCHAR(255) NOT NULL,
        `object_type` VARCHAR(255) NOT NULL,
        `message` text NOT NULL,
        `date_add` datetime NOT NULL,
        PRIMARY KEY (`id_objectlogguer`)
      ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';
    


foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}