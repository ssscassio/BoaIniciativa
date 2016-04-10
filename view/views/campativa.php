<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


  <div class="row">

    <?php include_once("painelCriador.php"); ?>

    <div class="col-md-9 panel panel-default">
      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/CriadorFacade.php");

      $campanhas = CriadorFacade::getInstance()->listarCampanhasAtivas($_SESSION['cpf']);
      var_dump($campanhas);
      ?>
      <h2 class="page-header">Listando Campanhas Ativas</h2>
      <div class="list-group">
        <div class="list-group-item row">
          <div class="col-xs-6 col-md-4">

            <img src="../img/logobi.png"  class="img-responsive img-rounded" />
            <div class="text-center">
              <span class="label label-info"> Ativa</span>
            </div>
          </div>
          <div class="col-xs-6 col-md-4 text-center">
            <div class="row panel panel-primary">
              <label class=""> Nome:</label> Doe Agasalhos
            </div>
            <div class="row panel panel-primary">
              <label class=""> Data Inicio:</label> 13/03/2016
            </div>
            <div class="row panel panel-primary">
              <label class=""> Data Fim:</label> 20/06/2016
            </div>
          </div>
          <div class="col-xs-6 col-md-6 text-center">
            <a href="campanha.php?id=24" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;"> Ver Campanha </a>
          </div>

        </div>

        <div class="list-group">


        </div>
      </div>
    </div>

  </div>
  <?php include_once("footer.php"); ?>
