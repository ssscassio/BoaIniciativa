<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


  <div class="row">

    <?php
    if(isset($_GET['filtro']) && $_GET['filtro'] =='Atendende'){
      include_once("painelAtendente.php");
    }
    ?>

    <div class="col-md-9 panel panel-default">

      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."facade/CassioAtendenteFacade.php");

      if(isset($_GET['filtro']) && $_GET['filtro'] =='Atendende'){
        CassioAtendenteFacade::getInstance()->listarCampanhas(1,  $_SESSION['cpf']);//1 código para listar Campanhas que atende
      }
      ?>

    </div>
  </div>

</div>
<?php include_once("footer.php"); ?>
