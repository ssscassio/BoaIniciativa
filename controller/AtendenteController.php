<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AtendenteCampanhaDAO.php");


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
