<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/CriadorController.php");

  class DoadorFacade{

    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new DoadorFacade();
      return self::$instance;
    }

  public function listarDoacoes($cpf, $filtro){
    return DoadorController::getInstance()->listarDoacoesAtivas($cpf, $filtro);
  }

  }
?>
