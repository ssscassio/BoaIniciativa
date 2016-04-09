<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AdministradorDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DenunciaDAO.php");

/**
 *
 */
class  AdministradorController
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new AdministradorController();
    return self::$instance;
  }

  public function autenticarAdm($cpfAdm, $senhaAdm){
    return AdministradorDAO::getInstance()->autenticarAdministradorCpf($cpfAdm,$senhaAdm);

  }

  public function cadastrarAdministrador($nome,$cpf,$email,$senha,$nascimento,$sexo){

    $adm = new Administrador($cpf,$nome,$senha,$email,$sexo,$nascimento);

    if(!AdministradorDAO::getInstance()->verificaAdministradorCadastrado($adm->getCpf(), $adm->getEmail())){
      AdministradorDAO::getInstance()->adicionarNovoAdministradormd5($adm);
      //tenta encontrar o usuario
      $admbusca = AdministradorDAO::getInstance()->buscarAdministrador($cpf);
      return ($admbusca->getCpf() != null);
    } else{
      return false;
    }

  }

  public function listarDenuncias($tipo, $id){
    if($tipo == 0){//listarTodasDenuncias
      return DenunciaDAO::getInstance()->listarDenuncias();
    }else if($tipo == 1){//listarCampanhas por campanha
      return DenunciaDAO::getInstance()->buscarDenunciasPorIdCampanha($id);
    }else if($tipo == 2){//listarCampanhas por Denunciador
      return DenunciaDAO::getInstance()->buscarDenunciasEfetuadas($id);
    }else if($tipo == 3){//listarCampanhas por Criador
      $campanhas = CampanhaDAO::getInstance()->buscarCampanhaPorCriador($id);
      $denuncias = array();
      for($i = 0; $i <sizeof($campanhas);$i++){
        $denunciasCampanha = DenunciaDAO::getInstance()->buscarDenunciasPorIdCampanha($campanhas[$i]->getIdCampanha());
        for ($j=0; $j < sizeof($denunciasCampanha) ; $j++) {
          $denuncias[] = $denunciasCampanha[$j];
        }
      }
      return $denuncias;
    }

  }

  public function listarUsuarios($tipo){
    if($tipo == "todos"){//listarTodas Usuarios
      return UsuarioDAO::getInstance()->listarUsuarios();
    }else if($tipo == "bloqueados"){//listar Usuarios Bloqueados
      return UsuarioDAO::getInstance()->listarUsuariosBloqueados();
    }
  }

  public function numDenunciasCampanha($idCampanha){
    $denuncias = DenunciaDAO::getInstance()->buscarDenunciasPorIdCampanha($idCampanha);
    if($denuncias == null){
      return 0;
    }else{
      return sizeof($denuncias);
    }
  }

  public function numDenunciasDenunciador($cpfDenunciador){
    $denuncias = DenunciaDAO::getInstance()->buscarDenunciasEfetuadas($cpfDenunciador);
    if($denuncias == null){
      return 0;
    }else{
      return sizeof($denuncias);
    }
  }

  public function numDenunciasCriador($cpfCriador){
    $denuncias =  AdministradorController::getInstance()->listarDenuncias(3, $cpfCriador);
    if($denuncias == null){
      return 0;
    }else{
      return sizeof($denuncias);
    }
  }

  public function numCampanhasCriador($cpfCriador){
    $campanhas = CampanhaDAO::getInstance()->buscarCampanhaPorCriador($cpfCriador);
    if($campanhas == null){
      return 0;
    }else{
      return sizeof($campanhas);
    }
  }

  public function buscarUsuario($cpfUsuario){
    return UsuarioDAO::getInstance()->buscarUsuario($cpfUsuario);
  }

  public function buscarCampanhaPorCriador($cpfUsuario){
    return CampanhaDAO::getInstance()->buscarCampanhaPorCriador($cpfUsuario);
  }

  public function bloquearUsuario($cpfUsuario){

    $date = new DateTime();
    $result = $date->format('d/m/Y');
    UsuarioDAO::getInstance()->bloquearUsuario($cpfUsuario,$result);

  }

  public function listarCampanhas($tipo, $id){
    $campanhas = array();
    if($tipo == 0){//listarTodosUsuarios
      return CampanhaDAO::getInstance()->listarCampanhas();
    }else if($tipo == 1){//listarCampanhas por campanha
      return CampanhaDAO::getInstance()->buscarCampanhaPorCriador($id);
    }else if($tipo == 2 && $id =="finalizadas"){//listarCampanhas Finalizadas
      $todasCampanhas = CampanhaDAO::getInstance()->listarCampanhas();
      $hoje = date('d/m/Y');
      for($i = 0; $i <sizeof($todasCampanhas);$i++){
        if(strtotime($hoje) > strtotime($todasCampanhas[$i]->getDataFim())){//finalizada
          $campanhas[] = $todasCampanhas[$i];
        }
      }
    }else if($tipo == 2 && $id =="ativas"){
      $todasCampanhas = CampanhaDAO::getInstance()->listarCampanhas();
      for($i = 0; $i <sizeof($todasCampanhas);$i++){
        if($todasCampanhas[$i]->getStatus() == true){
          $campanhas[] = $todasCampanhas[$i];
        }
      }
    }
    return $campanhas;
  }

  public function desbloquearUsuario($cpfUsuario){
    UsuarioDAO::getInstance()->desbloquearUsuario($cpfUsuario);
  }

  public function excluirUsuario($cpfUsuario){
    UsuarioDAO::getInstance()->deletarUsuario($cpfUsuario);
    $usuario = UsuarioDAO::getInstance()->buscarUsuario($cpfUsuario);
    return ($usuario->getCpf() == null);

  }

  public function encerrarCampanha($idCampanha){
    CampanhaDAO::getInstance()->encerrarCampanha($idCampanha, date('d/m/Y'));
  }


}

 ?>
