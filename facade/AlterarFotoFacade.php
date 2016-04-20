<?php
  // Jussara
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/AlterarFotoController.php");

  class AlterarFotoFacade{
  
    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new AlterarFotoFacade();
      return self::$instance;
    }
 
 
  public function editarFoto($diretorio, $cpf){   
	return AlterarFotoController::getInstance()->editarFoto($diretorio, $cpf);
  }
  
  }
?>
