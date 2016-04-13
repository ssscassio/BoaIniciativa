<?php

  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/DoadorFacade.php");
  //require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
  include("cabecalhologado.php");
?>

  <br><br><br><br>
  <div class="container">
    <div class="row">


      <?php
      include("painelDoador.php");

      echo '<div class="col-md-9">';
      if(isset($_GET['idCampanha']) && isset($_GET['doadorcpf'])){

      $int = DoadorFacade::getInstance()->doar($_GET['idCampanha'], $_GET['doadorcpf']);
      echo "DOAAAAAAAAAAAA";
      var_dump($int);


      }


      ?>

    </div>
  </div>
  </div>
