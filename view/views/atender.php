<?php
include("cabecalhologado.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/AtendenteController.php");

if(isset($_GET['campanha'])){
  $idCampanha = $_GET['campanha'];
  $autenticacao = AtendenteController::getInstance()->autenticarAtendente($_SESSION['cpf'],$idCampanha);

  ?>
  <br><br><br><br>
  <div class="container">
    <div class="row">


      <?php
      include("painelAtendente.php");
      echo '<div class="col-md-9 panel">';
      if($autenticacao){//Usuario atende na campanha
        ?>
        <div class="panel row">
          <div class="col-md-6 panel panel-success">
            <h3 class="page-header"> Digite o CPF do usuário para confirmar a doação</h3>
            <form  action="atender.php" method="get">
              <input type="hidden" name="campanha" value="<?php echo $idCampanha; ?>">
              <div class="row">
                <div class="form-group col-md-6">
                  <label > CPF</label>
                  <input type="number" class="form-control" name="cpf" required  placeholder="CPF">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <input type="submit" name="verDoacoesPendentes" class="btn btn-block btn-primary" value="Ver Doações">
                </div>
              </div>
            </form>
          </div>
          <?php if(isset($_GET['cpf'])){//Se o cpf do usuário for setado ?>

          <?php } ?>
        </div>

        <?php
      }else{//Usuario Não atende na campanha
        ?>
        <div class="alert alert-warning row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Desculpe!</strong> Você não tem permissão de atender nesta campanha.
        </div>

        <?php

      }

    }

    ?>
  </div>
</div>
</div>

<?php include("footer.php"); ?>
