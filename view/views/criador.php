<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">

<script type="text/javascript" src="../js/criador.js"></script>
<div class="row">

  <?php include_once("painelCriador.php"); ?>

  <div class="col-md-9 panel panel-default" id="criador">
    <img src="../img/logobi.png" class="center-block img-responsive" alt="" />
    <h3 style="text-align:right;">A solidariedade estimula a gentileza e gera mais saúde.
        - Anônimo.</h3>
  </div>
  <div class="col-md-9 panel panel-default" id="criarcampanha">
    <?php include("criarcampanha.php"); ?>
  </div>
  <div class="col-md-9 panel panel-default" id="campativa">
    <?php include("campativa.php"); ?>
  </div>
  <div class="col-md-9 panel panel-default" id="campfinalizada">
    <?php include("campfinalizada.php"); ?>
  </div>
  <div class="col-md-9 panel panel-default" id="todascamp">
    <?php include("todascamp.php"); ?>
  </div>

</div>

</div>
<?php include_once("footer.php"); ?>
