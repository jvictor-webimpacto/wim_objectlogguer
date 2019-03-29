<?php

  require_once('classes/ObjectLogger.php');
  if (!defined('_PS_VERSION_'))
    exit;
   
  class Wim_objectlogguer extends Module
  {

    public function __construct()
  {
    $this->name = 'wim_objectlogguer';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Javier';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('wim_objectlogguer');
    $this->description = $this->l('Description of my module.');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 

}

  //REGISTRAMOS LOS HOOK NECESARIOS PARA AÑADIR,BORRAR Y ACTUALIZAR. CUANDO INSTALAMOS EL MÓDULO SE CREA LA TABLA 
  
    public function install()
    {    
       include(dirname(__FILE__).'\sql\install.php');


       return parent::install() &&
       $this->registerHook('actionObjectAddAfter') &&
       $this->registerHook('actionObjectDeleteAfter') &&
       $this->registerHook('actionObjectUpdateAfter');
    }

     //HOOK DE ACTUALIZADO, CREAMOS LA INSTANCIA DE OBJECTLOGGER Y ASIGNAMOS A CADA COLUMNA SU VALOR
     public function hookActionObjectUpdateAfter($params)
    {

      $anadir = new ObjectLogger();
      $anadir->affected_object = $params['object']->id;
      $anadir->action_type = 'Update';
      $anadir->object_type = get_class($params['object']);
      $anadir->message = "Object ". get_class($params['object']) . " with id " . $params['object']->id;
      $anadir->date_add = date("Y-m-d H:i:s");

       //SI SE CUMPLE ESTA CONDICIÓN ACTUALIZA
      if (get_class($params['object']) != 'ObjectLogger'){
        $anadir->add();}

    }

     //HOOK DE AÑADIR, CREAMOS LA INSTANCIA DE OBJECTLOGGER Y ASIGNAMOS A CADA COLUMNA SU VALOR
    public function hookActionObjectAddAfter($params)
    {

      $after = new ObjectLogger();
      $after->affected_object = $params['object']->id;
      $after->action_type = 'Add';
      $after->object_type = get_class($params['object']);
      $after->message = "Object ". get_class($params['object']) . " with id " . $params['object']->id;
      $after->date_add = date("Y-m-d H:i:s");
      
       //SI SE CUMPLE ESTA CONDICIÓN AÑADE
      if (get_class($params['object']) != 'ObjectLogger') {
        $after->add();}

    }

    //HOOK DE BORRADO, CREAMOS LA INSTANCIA DE OBJECTLOGGER Y ASIGNAMOS A CADA COLUMNA SU VALOR
    public function hookActionObjectDeleteAfter($params)
    {

      $del = new ObjectLogger();
      $del->affected_object = $params['object']->id;
      $del->action_type = 'Delete';
      $del->object_type = get_class($params['object']);
      $del->message = "Object ". get_class($params['object']) . " with id " . $params['object']->id;
      $del->date_add = date("Y-m-d H:i:s");
      

      //SI SE CUMPLE ESTA CONDICIÓN ELIMINA
      if (get_class($params['object']) != 'ObjectLogger') {
        $del->add();}

    }

  }