<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AtendenteCampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MaterialDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MetaDAO.php");


/**
 *
 */
class AtendenteController
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new AtendenteController();
    return self::$instance;
  }

  public function autenticarAtendente($cpf, $idCampanha){
    return AtendenteCampanhaDAO::getInstance()->autenticarAtendente($cpf,$idCampanha);

  }

public function cadastroRapido($cpf,$email,$senha){
    UsuarioDAO::getInstance()->adicionarCadastroRapidomd5($cpf,$email,$senha);

    $usuario =UsuarioDAO::buscarUsuario($cpf);

    return ($usuario->getCpf() != null);
}

  public function numCampanhasAtendente($cpf){
    $campanhas = AtendenteController::getInstance()->listarCampanhas($cpf);
    if($campanhas == null){
      return 0;
    }else{
      return sizeof($campanhas);
    }
  }

  public function buscarDoacoesPendentesNaCampanha($cpf,$idCampanha){
    $todasdoacoes = DoacaoDAO::getInstance()->buscarDoacaoNaCampanha($cpf,$idCampanha);
    $doacoespendentes = array();
    for($i = 0 ; $i < sizeof($todasdoacoes) ; $i++){
      if($todasdoacoes[$i]->getConfirmado()  == false){//se não foi confirmado
        $doacoespendentes[] = $todasdoacoes[$i];
      }
    }
    return $doacoespendentes;
  }

  public function numConvitesPendentes($cpf){
    $campanhas = AtendenteCampanhaDAO::getInstance()->listarConfirmacoesPendentes($cpf);
    if($campanhas == null){
      return 0;
    }else{
      return sizeof($campanhas);
    }
  }

  public function listarCampanhas($cpf){
    $campanhas = array();
    $todasCampanhas = AtendenteCampanhaDAO::getInstance()->listarCampanhasAtendente($cpf);

    for ($i=0; $i < sizeof($todasCampanhas) ; $i++) {
      if($todasCampanhas[$i]->getStatus() == true){
        $campanhas[] = $todasCampanhas[$i];
      }
    }
    return $campanhas;
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
  public function listarMateriais(){
    return MaterialDAO::getInstance()->listarMateriais();
  }
  public function listarConvitesPendentes($cpf){
    return AtendenteCampanhaDAO::getInstance()->listarConfirmacoesPendentes($cpf);
  }

  public function confirmarParticipacao($cpf, $idCampanha){
    return AtendenteCampanhaDAO::getInstance()->confirmarParticipacaoAtendente($cpf, $idCampanha);
  }

  public function cancelarParticipacao($cpf, $idCampanha){
    return AtendenteCampanhaDAO::getInstance()->cancelarParticipacaoAtendente($cpf, $idCampanha);
  }


}

 ?>
