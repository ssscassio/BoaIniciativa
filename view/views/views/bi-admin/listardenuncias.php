<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


  <div class="row">

    <?php include_once("painelAdministrativo.php"); ?>

    <div class="col-md-9 panel panel-default">
      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."facade/CassioAdministradorFacade.php");

      if (isset($_GET['idCampanha'])) {
        CassioAdministradorFacade::getInstance()->listarDenuncias(1, $_GET['idCampanha']);
      }else if(isset($_GET['cpfDenunciante'])){
        CassioAdministradorFacade::getInstance()->listarDenuncias(2,  $_GET['cpfDenunciante']);
      }else if(isset($_GET['cpfCriador'])){
        CassioAdministradorFacade::getInstance()->listarDenuncias(3,  $_GET['cpfCriador']);
      }else{
        CassioAdministradorFacade::getInstance()->listarDenuncias(0, 0);
      }

      ?>
    </div>
  </div>

</div>
<?php include_once("footer.php"); ?>
