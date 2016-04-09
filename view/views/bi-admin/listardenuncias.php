<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


  <div class="row">

    <?php include_once("painelAdministrativo.php"); ?>

    <div class="col-md-9 panel panel-default">
      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AdministradorFacade.php");

      if (isset($_GET['idCampanha'])) {
          AdministradorFacade::getInstance()->listarDenuncias(1, $_GET['idCampanha']);
      }else if(isset($_GET['cpfDenunciante'])){
          AdministradorFacade::getInstance()->listarDenuncias(2,  $_GET['cpfDenunciante']);
      }else if(isset($_GET['cpfCriador'])){
          AdministradorFacade::getInstance()->listarDenuncias(3,  $_GET['cpfCriador']);
      }else{
          AdministradorFacade::getInstance()->listarDenuncias(0, 0);
      }

      ?>
    </div>
  </div>

</div>
<?php include_once("footer.php"); ?>
