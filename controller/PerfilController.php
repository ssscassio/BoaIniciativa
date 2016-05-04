<?php
// Jussara
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");

class PerfilController{
  private static $instance;

  public function __construct(){
  }

  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new PerfilController();
    return self::$instance;
  }

  public function buscarUsuario($cpf){ 
	return UsuarioDao::getInstance()->buscarUsuario($cpf);
  }
  
  public function campanhas(){
	return CampanhaDao::getInstance()->listarCampanhas();
  }
	
}
 ?>
