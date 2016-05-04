<?php
  // Jussara
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/EditarPerfilController.php");

  class EditarPerfilFacade{
  
    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new EditarPerfilFacade();
      return self::$instance;
    }
 
 
  public function editarPerfil($nome, $email, $senha, $foto, $sexo, $nacimento, 
  $classificacao, $cep,$estado, $bairro, $cidade, $logadouro, $numero, $complemento, $cpf, $bloqueado, $dataBloqueio){ 
  
	return EditarPerfilController::getInstance()->editarPerfil($nome, $email, $senha, $foto, $sexo, $nacimento, 
    $classificacao, $cep,$estado, $bairro, $cidade, $logadouro, $numero, $complemento, $cpf, $bloqueado, $dataBloqueio);
  }
  
  public function excluirPerfil($cpf){
	return EditarPerfilController::getInstance()->excluirPerfil($cpf);
  }
  
  }
?>
