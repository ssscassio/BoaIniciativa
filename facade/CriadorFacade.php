<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/CriadorController.php");

  class CriadorFacade{

    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new CriadorFacade();
      return self::$instance;
    }


    public function listarCampanhasAtivas($cpf){
      return CriadorController::getInstance()->listarCampanhasAtivas($cpf);
    }

  }
?>
