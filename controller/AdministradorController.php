<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AdministradorDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DenunciaDAO.php");

/**
*Classe AdministradorController
* Classe responsável por controlar todas as solicitações referentes ao administrador.
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

  /** Método responsável por autenticar um administrador
  * @param $cpfAdm cpf do administrador
  * @param $senhaAdm senha do administrador
  * @return retorna confirmação se ele foi autenticado ou não
  */
  public function autenticarAdm($cpfAdm, $senhaAdm){
    return AdministradorDAO::getInstance()->autenticarAdministrador($cpfAdm,$senhaAdm);

  }

  /** Método responsável por cadastrar um administrador
  * @param $nome nome do administrador  que será cadastrado
  * @param $cpf cpf do administrador que será cadastrado
  * @param $email email do administrador que será cadastrado
  * @param $senha senha do administrador que será cadastrado
  * @param $nascimento nascimento do administrador que será cadastrado
  * @param $sexo sexo do administrador que será cadastrado
  * @return retorna confirmação se ele foi autenticado ou não
  */
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

  /** Método responsável por listar denúncias
  * @param $tipo se a listagem é por campanhas, por denúnica ou por criador
  * @param $id id usado para buscar denúncias
  * @return retorna uma lista de denúncias
  */
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

  /** Método responsável por lista usuários
  * @param $tipo define se serão listados usuários bloqueados ou todos
  * @return retorna uma lista de usuários
  */
  public function listarUsuarios($tipo){
    if($tipo == "todos"){//listarTodas Usuarios
      return UsuarioDAO::getInstance()->listarUsuarios();
    }else if($tipo == "bloqueados"){//listar Usuarios Bloqueados
      return UsuarioDAO::getInstance()->listarUsuariosBloqueados();
    }
  }

  /** Método responsável por verificar quantas denúnicas possui uma campanha
  * @param $idcampanha id da campanha que se deseja buscar a quantidade de denúncias
  * @return a quantidade de denúncias de uma campanha
  */
  public function numDenunciasCampanha($idCampanha){
    $denuncias = DenunciaDAO::getInstance()->buscarDenunciasPorIdCampanha($idCampanha);
    if($denuncias == null){
      return 0;
    }else{
      return sizeof($denuncias);
    }
  }

  /** Método responsável por lista a quantidade de denúncias de um usuário
  * @param $cpfDenunciador cpf do usuário que realizou as denúncias
  * @return retorna a quantidade de denúncias
  */
  public function numDenunciasDenunciador($cpfDenunciador){
    $denuncias = DenunciaDAO::getInstance()->buscarDenunciasEfetuadas($cpfDenunciador);
    if($denuncias == null){
      return 0;
    }else{
      return sizeof($denuncias);
    }
  }

  /** Método responsável por lista a quantidade de denúncias de um criador
  * @param $cpfCriador cpf do criador
  * @return retorna a quantidade de denúncias
  */
  public function numDenunciasCriador($cpfCriador){
    $denuncias =  AdministradorController::getInstance()->listarDenuncias(3, $cpfCriador);
    if($denuncias == null){
      return 0;
    }else{
      return sizeof($denuncias);
    }
  }

  /** Método responsável por lista a quantidade de campanhas criadas por um usuário
  * @param $cpfCriador cpf do criador
  * @return retorna a quantidade de campanhas
  */
  public function numCampanhasCriador($cpfCriador){
    $campanhas = CampanhaDAO::getInstance()->buscarCampanhaPorCriador($cpfCriador);
    if($campanhas == null){
      return 0;
    }else{
      return sizeof($campanhas);
    }
  }

  /** Método responsável por buscar um usuário
  * @param $cpfUsuario cpf do usuário
  * @return retorna as informações do usuário buscado
  */
  public function buscarUsuario($cpfUsuario){
    return UsuarioDAO::getInstance()->buscarUsuario($cpfUsuario);
  }

  /** Método responsável por buscar campanhas criadas por um determinado usuário
  * @param $cpfUsuario cpf do usuário
  * @return retorna uma lista de campanhas
  */
  public function buscarCampanhaPorCriador($cpfUsuario){
    return CampanhaDAO::getInstance()->buscarCampanhaPorCriador($cpfUsuario);
  }

  /** Método responsável por bloquear um usuário
  * @param $cpfUsuario cpf do usuário que deve ser bloqueado
  */
  public function bloquearUsuario($cpfUsuario){

    $date = new DateTime();
    $result = $date->format('d/m/Y');
    UsuarioDAO::getInstance()->bloquearUsuario($cpfUsuario,$result);

  }

  /** Método responsável listar campanhas
  * @param $id id do usuário
  * @param $tipo verifica se a listagem é por criador, por campanhas finalizadas ou de todos os usuários
  * @return retorna uma lista de campanhas
  */
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

  /** Método responsável desbloquear um usuário
  * @param $cpfUsuario cpf do usuário que deverá ser desbloqueado
  */
  public function desbloquearUsuario($cpfUsuario){
    UsuarioDAO::getInstance()->desbloquearUsuario($cpfUsuario);
  }

  /** Método responsável excluir um usuário
  * @param $cpfUsuario cpf do usuário que deverá ser excluido
  * @return retorna uma confirmação se o usuário ainda existe ou não
  */
  public function excluirUsuario($cpfUsuario){
    UsuarioDAO::getInstance()->deletarUsuario($cpfUsuario);
    $usuario = UsuarioDAO::getInstance()->buscarUsuario($cpfUsuario);
    return ($usuario->getCpf() == null);

  }

  /** Método responsável encerrar uma campanha
  * @param $idCampanha id da campanha que deverá ser encerrada
  */
  public function encerrarCampanha($idCampanha){
    CampanhaDAO::getInstance()->encerrarCampanha($idCampanha, date('d/m/Y'));
  }


}

 ?>
