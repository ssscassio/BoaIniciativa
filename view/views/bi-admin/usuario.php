<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


<div class="row">

  <?php include_once("painelAdministrativo.php"); ?>

  <div class="col-md-9 panel panel-default">
    <?php

      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AdministradorFacade.php");
      AdministradorFacade::getInstance()->verUsuario($_GET['cpf']);

    ?>


  </div>
</div>

</div>
<?php include_once("footer.php"); ?>
