<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


  <div class="row">

    <?php include_once("painelAdministrativo.php"); ?>

    <div class="col-md-9 panel panel-default">
      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AdministradorFacade.php");

      if (isset($_GET['filtro']) && $_GET['filtro'] =="bloqueados") {
        AdministradorFacade::getInstance()->listarUsuarios("bloqueados");
    }else{
      AdministradorFacade::getInstance()->listarUsuarios("todos");
  }

  ?>

  <div class="list-group">


  </div>
</div>
</div>

</div>
<?php include_once("footer.php"); ?>
