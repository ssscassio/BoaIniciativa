<?php
// Jussara
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");

class EditarPerfilController{
  private static $instance;

  public function __construct(){
  }
		
  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new EditarPerfilController();
    return self::$instance;
  }

  function editarPerfil($nome, $email, $senha, $foto, $sexo, $nascimento, 
   $classificacao, $cep,$estado, $bairro, $cidade, $logadouro, $numero, $complemento, $cpf, $bloqueado, $dataBloqueio){
	
   $endereco = array($cep, $estado, $bairro, $cidade, $logadouro, $numero, $complemento);
   $usuario = new Usuario($nome, $cpf, $email, $senha, $foto, $sexo, $nascimento, $endereco, $classificacao, $bloqueado, $dataBloqueio);
   return UsuarioDao::getInstance()->editarPerfil($usuario);
  }
	
  function excluirPerfil($cpf){	
	return UsuarioDao::getInstance()->deletarUsuario($cpf);
  }
}
 ?>
