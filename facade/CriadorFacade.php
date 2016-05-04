<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/CriadorController.php");

  class CriadorFacade{

    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new CriadorFacade();
      return self::$instance;
    }


    public function listarCampanhasAtivas($cpf){
      return CriadorController::getInstance()->listarCampanhasAtivas($cpf);
    }

    public function verificaCampanhaCadastrada($nome){
      return CriadorController::getInstance()->verificaCampanhaCadastrada($nome);
    }
    public function editarCampanha($campanha){
      CriadorController::getInstance()->editarCampanha($campanha);
    }
    public function listarTags(){
      return CriadorController::getInstance()->listarTags();
    }
    public function buscarCampanha($id){
      return CriadorController::getInstance()->buscarCampanha($id);
    }
    public function buscarCriadorCampanha($cpf){
      return CriadorController::getInstance()->buscarCriadorCampanha($cpf);
    }
    public function listarMateriais(){
      return CriadorController::getInstance()->listarMateriais();
    }
    public function buscarMaterial($codigo){
      return CriadorController::getInstance()->buscarMaterial($codigo);
    }
    public function cadastrarMaterial($nome, $medida){
      return CriadorController::getInstance()->cadastrarMaterial($nome, $medida);
    }

    public function cadastrarMetaMaterial($idCampanha, $codMaterial, $qtd){
      CriadorController::getInstance()->cadastrarMetaMaterial($idCampanha, $codMaterial, $qtd);
    }
    public function criarCampanha($nome, $descricao, $dataInicio, $imagem, $cpf, $metaOuData, $dataFim, $agradecimento, $titulo, $valores, $categoria){
      return CriadorController::getInstance()->criarCampanha($nome, $descricao, $dataInicio, 'default', $cpf, $metaOuData, $dataFim, $agradecimento, $titulo, $valores, $categoria);
    }
    public function editarMetas($codMaterial, $qtd, $idCampanha){
      CriadorController::getInstance()->editarMetas($codMaterial, $qtd, $idCampanha);
    }
    public function adicionarAtendenteCampanha($idCampanha, $cpfAtendente){
      CriadorController::getInstance()->adicionarAtendenteCampanha($idCampanha, $cpfAtendente);
    }
    public function listarAtendentesCampanha($idCampanha){
      return CriadorController::getInstance()->listarAtendentesCampanha($idCampanha);
    }
    public function buscarMetasCampanha($idCampanha){
      return CriadorController::getInstance()->buscarMetasCampanha($idCampanha);
    }


  }
?>
