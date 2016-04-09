<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


  <div class="row">

    <?php include_once("painelAdministrativo.php"); ?>

    <div class="col-md-9 panel panel-default">

      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AdministradorFacade.php");

      if (isset($_GET['cpf'])) {
          AdministradorFacade::getInstance()->listarCampanhas(1, $_GET['cpf']);
      }else if(isset($_GET['filtro'])){
          AdministradorFacade::getInstance()->listarCampanhas(2,  $_GET['filtro']);
      }else{
          AdministradorFacade::getInstance()->listarCampanhas(0, 0);
      }
      ?>

    </div>
  </div>

</div>
<?php include_once("footer.php"); ?>
