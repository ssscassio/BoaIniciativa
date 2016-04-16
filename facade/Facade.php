<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/SistemaController.php");

class Facade{
  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new Facade();
    return self::$instance;
  }

  public function printUrlImagemCampanha($campanha){
    if($campanha->getImagem()=="" || $campanha->getImagem()=="default.jpg"){
      echo "../img/logobi.png";
    }else{
      echo $campanha->getImagem();
    }
  }

  public function printStatusCampanha($campanha){

    if($campanha->getStatus()){
      echo '<span class="label label-info">Ativa</span>';
    }else{
      echo '<span class="label label-danger"> Finalizada</span>';
    }
  }
}
?>
