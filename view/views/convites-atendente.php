<?php include_once("cabecalhologado.php"); ?>
<?php require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/AtendenteController.php"); ?>
<?php require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/Facade.php"); ?>

<br><br>

<div class="container">
  <div class="row">

    <!--Painel Atendente-->
    <div class="col-md-3 panel panel-default" style="padding:0px 10px 20px 10px;">
      <?php include_once("painelAtendente.php"); ?>
    </div>

    <div class="col-md-9 panel panel-default">

      <?php $campanhas = AtendenteController::getInstance()->listarConvitesPendentes($_SESSION['cpf']); ?>
      <?php if(sizeof($campanhas) == 0){ ?>
        <div class="alert alert-info row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
        Você não tem convites pendentes.
        </div>
      <?php }else{ ?>
        <h2 class="page-header">Listando convites Pendentes</h2>
        <!--Listagem dos convites-->
        <div class="list-group">
          <?php for ($i=sizeof($campanhas)-1; $i >=0 ; $i--) { ?>

          <div class="list-group-item row">
            <div class="col-xs-6 col-md-4">

              <img src="
              <?php Facade::getInstance()->printUrlImagemCampanha($campanhas[$i]);?>
              "class="img-responsive img-rounded" />

              <div class="text-center">
                <?php Facade::getInstance()->printStatusCampanha($campanhas[$i]);?>
              </div>
            </div>
            <div class="col-xs-6 col-md-4">
              <div class="row panel panel-primary">
                <label class=""> Nome:</label> <?php echo $campanhas[$i]->getNome()?>
              </div>
              <div class="row panel panel-primary">
                <label class=""> Data Inicio:</label> <?php echo date("d/m/Y", strtotime($campanhas[$i]->getDataInicio()))?>
              </div>
              <div class="row panel panel-primary">
                <label class=""> Data Fim:</label> <?php echo date("d/m/Y", strtotime($campanhas[$i]->getDataFim())) ?>
              </div>
            </div>
            <div class="col-xs-12 col-md-4 panel">
              <div class="col-xs-6 col-md-12">
                <a href="campanha.php?id=<?php echo $campanhas[$i]->getidCampanha() ?>" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;"> Ver Campanha <span class="badge">#<?php echo $campanhas[$i]->getidCampanha() ?></span></a>
              </div>
              <div class="col-xs-6 col-md-12">
                <a href="usuario.php?cpf=<?php echo $campanhas[$i]->getCriadorCpf() ?>" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;">Ver Criador</a>
              </div>
              <div class="col-xs-6 col-md-12">
                <form class="" action="rotas.php" method="post">
                  <input type="hidden" name="cpf" value="<?php echo $_SESSION['cpf'];?>">
                  <input type="hidden" name="idCampanha" value="<?php echo $campanhas[$i]->getidCampanha();?>">
                  <input type="submit" name="botaoConfirmarParticipacao"class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;" value="Confirmar Participação">

                </form>
              </div>

            </div>


            <?php
            echo '</div>';
          }
        }
        ?>
      </div>

    </div>
  </div>
</div>
<div class="container">
  <?php
  include("footer.php");
  ?>
</div>
