<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AdministradorDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DenunciaDAO.php");

/**
*Classe UsuarioController
* Classe responsável por controlar todas as solicitações referentes ao usuário.
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

  /** Método responsável pela edição do perfil de um usuário
  * @param $usuario informações do usuário que devem ser editadas
  * @return false caso o usuário que se deseja editar não esteja cadastrado no sistema
  */
  function editarPerfil($usuario){ //Função responsavel por editar o perfil do usuario
    if(UsuarioDAO::getInstance()->verificaUsuarioCadastrado($usuario->getCpf(), $usuario->getEmail())){
      UsuarioDAO::getInstance()->editarPerfil($usuario);
    }else{
      return false;
    }
  }

  /** Método responsável por pegar dados de uma campanha
  * @param $idcampanha id da campanha que se busca
  * @return informações da campanha encontrada
  */
  public function verCampanha ($idcampanha){
    return $campanha = CampanhaDAO::getInstance()->buscarCampanha($idcampanha);
  }

  /** Método responsável por guardar denúncias de uma campanha
  * @param $idcampanha id da campanha que se busca
  * @param $motivo motivo da denúncia
  * @param $descricao descricao da denúncia
  * @param $cpf cpf do usuário que realizou a denúncia
  * @return boolean se a denúncia foi realizada com sucesso ou não
  */
  public function enviarDenuncia($idCampanha, $motivo, $descricao, $cpf){
    $denuncia = new Denuncia(null, $idCampanha, $motivo, $descricao, $cpf);
    if(DenunciaDAO::getInstance()->adicionarDenuncia($denuncia) == null){
      return false;
    }else{
    return true;
    }


  }

  /** Método responsável por editar a senha de um usuário
  * @param $senha nova senha
  * @param $cpf cpf do usuário
  */
  public function editarSenha($senha,$cpf){
    UsuarioDAO::getInstance()->editarSenhamd5($senha, $cpf);
  }
}

 ?>
