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
}

 ?>
