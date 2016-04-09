<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


<div class="row">

  <?php include_once("painelAdministrativo.php"); ?>

  <div class="col-md-9 panel panel-default">
    <?php

      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."facade/CassioAdministradorFacade.php");
      CassioAdministradorFacade::getInstance()->verCampanha($_GET['id']);

    ?>


  </div>
</div>

</div>
<?php include_once("footer.php"); ?>
