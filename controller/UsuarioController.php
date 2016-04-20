<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AdministradorDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DenunciaDAO.php");

/**
 *
 */
class  UsuarioController
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new UsuarioController();
    return self::$instance;
  }

  public function buscarUsuario($cpf){
    return UsuarioDAO::getInstance()->buscarUsuario($cpf);
  }

  function editarPerfil($usuario){ //Função responsavel por editar o perfil do usuario
    if(UsuarioDAO::getInstance()->verificaUsuarioCadastrado($usuario->getCpf(), $usuario->getEmail())){
      UsuarioDAO::getInstance()->editarPerfil($usuario);
    }else{
      return false; //SUBSTITUIR POR UMA EXCEPTION
    }
  }

  public function verCampanha ($idcampanha){
    return $campanha = CampanhaDAO::getInstance()->buscarCampanha($idcampanha);
  }

  public function enviarDenuncia($idCampanha, $motivo, $descricao, $cpf){
    $denuncia = new Denuncia(null, $idCampanha, $motivo, $descricao, $cpf);
    if(DenunciaDAO::getInstance()->adicionarDenuncia($denuncia) == null){
      return false;
    }else{
    return true;      
    }


  }

  public function editarSenha($senha,$cpf){
    UsuarioDAO::getInstance()->editarSenhamd5($senha, $cpf);
  }
}

 ?>
