<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/TagDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MaterialDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/TagCampanhaDAO.php");


class  CriadorController
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new CriadorController();
    return self::$instance;
  }

  public function listarCampanhas($cpf, $filtro){
    $todascampanhas = CampanhaDAO::getInstance()->buscarCampanhaPorCriador($cpf);
      if($filtro == "ativas"){
          $campanhasativas = array();
          for($i = 0 ; $i < sizeof($todascampanhas) ; $i++){
            if($todascampanhas[$i]->getStatus()  == true){//se está ativa
              $campanhasativas[] = $todascampanhas[$i];
            }
          }
          return $campanhasativas;
      }else if ($filtro == "finalizadas"){
        $campanhasfinalizadas = array();
        for($i = 0 ; $i < sizeof($todascampanhas) ; $i++){
          if($todascampanhas[$i]->getStatus()  == false){//se está finalizada
            $campanhasfinalizadas[] = $todascampanhas[$i];
          }
        }
        return $campanhasfinalizadas;
      }else {// se não for nem ativa nem finalizada ou o filtro for errado
        return $todascampanhas;
      }
    }//fecha a funcao





  function verificaCampanhaCadastrada($nome){
    return CampanhaDAO::getInstance()->verificaCampanhaCadastrada($nome);
  }
  function criarCampanha($campanha){
    return CampanhaDAO::getInstance()->adicionarCampanha($campanha);
  }
  function editarCampanha($campanha){
    CampanhaDAO::getInstance()->editarCampanha($campanha);
  }
  function listarTags(){
    return TagDAO::getInstance()->listarTags();
  }
  function buscarCampanha($id){
    return CampanhaDAO::getInstance()->buscarCampanha($id);
  }
  function buscarCriadorCampanha($cpf){
    return UsuarioDAO::getInstance()->buscarUsuario($cpf);
  }
  function listarMateriais(){
    return MaterialDAO::getInstance()->listarMateriais();
  }
  function cadastrarMaterial($nome, $medida){
    $material = new Material($nome, $medida, null);
    return MaterialDAO::getInstance()->adicionarMaterial($material);
  }
  function cadastrarMetaMaterial($idCampanha, $codMaterial, $qtd){
    MetaDAO::getInstance()->adicionarMeta($idCampanha, $codMaterial, $qtd);
  }
  function criarCampanha($nome, $descricao, $dataInicio, 'default', $cpf, $metaOuData, $dataFim, $agradecimento, $titulo, $valores, $categoria){
    $campanha = new Campanha(null, $nome, $descricao, $dataInicio, 'default', $cpf, $metaOuData, $dataFim);
    $campanha->setAgradecimento($agradecimento);
    $campanha->setTituloAgradecimento($titulo);
    $campanha->setValores($valores)

    $id = CampanhaDAO::getInstance()->adicionarCampanha($campanha);
    TagCampanhaDAO::getInstance()->associarCampanhaTag($categoria, $id);
    return $id;
  }

}

 ?>
