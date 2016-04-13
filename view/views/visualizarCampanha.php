<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


<div class="row">

  <?php include_once("painelDoador.php"); ?>

  <div class="col-md-9 panel panel-default">
    <?php

      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/UsuarioFacade.php");
      $id = $_GET['campanha'];
      var_dump($id);
      $campanha = UsuarioFacade::getInstance()->verCampanha($id);

      var_dump($campanha);
    ?>


  </div>
</div>

</div>
<?php include_once("footer.php"); ?>
