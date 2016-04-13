<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/DoadorController.php");

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
    return DoadorController::getInstance()->listarDoacoes($cpf, $filtro);
  }

  public function doar($idcampanha, $doadorcpf){
    return DoadorController::getInstance()->adicionarDoacao($idcampanha, $doadorcpf);
  }

  }
?>
