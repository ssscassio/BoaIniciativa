<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


  <div class="row">

    <?php include_once("painelAdministrativo.php"); ?>

    <div class="col-md-9 panel panel-default">

      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."facade/CassioAdministradorFacade.php");

      if (isset($_GET['cpf'])) {
        CassioAdministradorFacade::getInstance()->listarCampanhas(1, $_GET['cpf']);
      }else if(isset($_GET['filtro'])){
        CassioAdministradorFacade::getInstance()->listarCampanhas(2,  $_GET['filtro']);
      }else{
        CassioAdministradorFacade::getInstance()->listarCampanhas(0, 0);
      }
      ?>

    </div>
  </div>

</div>
<?php include_once("footer.php"); ?>
