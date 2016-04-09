<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


  <div class="row">

    <?php include_once("painelAdministrativo.php"); ?>

    <div class="col-md-9 panel panel-default">
      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."facade/CassioAdministradorFacade.php");

      if (isset($_GET['filtro']) && $_GET['filtro'] =="bloqueados") {
      CassioAdministradorFacade::getInstance()->listarUsuarios("bloqueados");
    }else{
    CassioAdministradorFacade::getInstance()->listarUsuarios("todos");
  }

  ?>

  <div class="list-group">


  </div>
</div>
</div>

</div>
<?php include_once("footer.php"); ?>
