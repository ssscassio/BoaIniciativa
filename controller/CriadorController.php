<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");


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

  public function listarCampanhasAtivas($cpf){
    $todascampanhas = CampanhaDAO::getInstance()->buscarCampanhaPorCriador($cpf);
    $campanhasativas = array();
    for($i = 0 ; $i < count($todascampanhas) ; $i++){
      if($todascampanhas[$i]->getStatus()  == true){//se está ativa
        $campanhasativas[] = $todascampanhas[$i];
      }
    }
    return $campanhasativas;
  } //fecha o function

}

 ?>
