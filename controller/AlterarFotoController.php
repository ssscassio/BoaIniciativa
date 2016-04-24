<?php
// Jussara
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");

class AlterarFotoController{
  private static $instance;

  public function __construct(){
  }
		
  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new AlterarFotoController();
    return self::$instance;
  }

  function editarFoto($diretorio, $cpf){	
   $usuario = UsuarioDao::getInstance()->buscarUsuario($cpf);
   $usuario->setFoto($diretorio);
   return UsuarioDao::getInstance()->editarPerfil($usuario);
  }
	
}
 ?>
