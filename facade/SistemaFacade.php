<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/SistemaController.php");

  class  SistemaFacade{

    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new  SistemaFacade();
      return self::$instance;
    }

    public function cadastrarNovoUsuario($nome,$cpf,$email,$senha,$nascimento,$cep,$estado,$bairro,$cidade,$longradouro,$numero,$complemento,$sexo){
      return  SistemaController::getInstance()->cadastrarUsuario($nome,$cpf,$email,$senha,$nascimento,$cep,$estado,$bairro,$cidade,$longradouro,$numero,$complemento,$sexo);
    }
 
  public function editarPerfil($nome, $email, $senha, $foto, $sexo, $nacimento, $classificacao, $cep, $estado, 
  $bairro, $cidade, $logadouro, $numero, $complemento, $cpf, $bloqueado, $dataBloqueio, $latitude, $longitude){ 
  
	return SistemaController::getInstance()->editarPerfil($nome, $email, $senha, $foto, $sexo, $nacimento, $classificacao,   
    $cep, $estado, $bairro, $cidade, $logadouro, $numero, $complemento, $cpf, $bloqueado, $dataBloqueio, $latitude, $longitude);
  }
  
  public function excluirPerfil($cpf){
	return SistemaController::getInstance()->excluirPerfil($cpf);
  }

}

 ?>
