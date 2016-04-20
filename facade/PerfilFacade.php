<?php
  // Jussara
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/PerfilController.php");

  class PerfilFacade{
    
	private static $instance;

    public function __construct(){
    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new PerfilFacade();
      return self::$instance;
    }
 
  function buscarUsuario($cpf){ 
	return PerfilController::getInstance()->buscarUsuario($cpf);
  }
  
  function campanhasSugeridas(){
	return PerfilController::getInstance()->campanhas();
  }
  
  }
?>
