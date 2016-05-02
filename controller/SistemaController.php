<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MetaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MaterialDAO.php");

/**
 *
 */
class SistemaController
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new SistemaController();
    return self::$instance;
  }




  public function cadastrarUsuario($nome,$cpf,$email,$senha,$nascimento,$cep,$estado,$bairro,$cidade,$longradouro,$numero,$complemento,$sexo){
    $endereco = array('cep'=> $cep,
    'estado'=>$estado,
    'bairro'=>$bairro,
    'cidade'=>$cidade,
    'logradouro'=>$longradouro,
    'numero'=>$numero,
    'complemento'=>$complemento);
    $usuario = new Usuario($nome, $cpf, $email, $senha, 'DEFAULT', $sexo, $nascimento, $endereco, 0, false, null);

    $confirmacao = UsuarioDAO::getInstance()->adicionarNovoUsuario($usuario);
    //tenta encontrar o usuario
    $usuariobusca = UsuarioDAO::getInstance()->buscarUsuario($cpf);
    return ($usuariobusca->getCpf() != null);

  }

  public function buscarCampanha($idCampanha){
    return CampanhaDAO::getInstance()->buscarCampanha($idCampanha);
  }

  public function verificarCampanhaMonetaria($idCampanha){
    $materiais = SistemaController::getInstance()->listarMateriaisCampanha($idCampanha);
    $isMonetaria = false;
    for($i=0; $i < sizeof($materiais); $i++){
      if($materiais[$i]->getNome() =="Dinheiro"){
        $isMonetaria = true;
      }
    }
    return $isMonetaria;
  }

  public function listarMateriaisCampanha($idCampanha){
    $metas =array();
    $metas = MetaDAO::getInstance()->buscarMetasCampanha($idCampanha);
    $materiais = array();
    for ($i=0; $i < sizeof($metas); $i++) {
      $materiais[] = MaterialDAO::getInstance()->buscarMaterial($metas[$i]->getCodMaterial());
    }

    return $materiais;
  }


}

 ?>
