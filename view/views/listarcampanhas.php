
<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/CriadorController.php");
include("cabecalhologado.php");
?>
<br><br><br><br>
<div class="container">
<div class="row">


<?php
include("painelCriador.php");

  echo '<div class="col-md-9">';
  if(isset($_GET['tipo']) && isset($_GET['filtro'])){

    if ($_GET['tipo'] == 'criador') {
      $campanhas = CriadorController::getInstance()->listarCampanhas($_SESSION['cpf'], $_GET['filtro']);

      if(sizeof($campanhas) == 0){?>
        <div class="alert alert-danger row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Desculpe!</strong> Não conseguimos encontrar o que você está procurando.
        </div>


        <?php
      }else{

        switch ($_GET['filtro']) {
          case 'todas':
          echo '<h2 class="page-header">Listando Todas Campanhas</h2>';
          break;
          case 'finalizadas':
          echo '<h2 class="page-header">Listando campanhas Finalizadas</h2>';
          break;
          case 'ativas':
          echo '<h2 class="page-header">Listando campanhas Ativas</h2>';
          break;
        }

        echo '<div class="list-group">';
        for($i = 0; $i <sizeof($campanhas); $i++){
          ?>
          <div class="list-group-item row">
            <div class="col-xs-6">
              <?php if($campanhas[$i]->getImagem() == "" || $campanhas[$i] == "default.jpg"){
                echo '<img src="../img/logobi.png" class="img-responsive img-rounded" alt="" />';

              }else{
                echo '<img src="'.$campanhas[$i]->getImagem().'" class="img-responsive img-rounded" alt="" />';
              } ?>
              <div class="text-center">
                  <span class="label <?php if($campanhas[$i]->getStatus)
                                            {echo 'label-info"> Ativa';
                                            }else{
                                              echo 'label-danger"> Finalizada';
                                            }?>
                                          </span>
              </div>
            </div>
            <div class="col-xs-6 text-center">
           <div class="row panel panel-primary">
             <label class=""> Nome:</label> <?php echo $campanhas[$i]->getNome(); ?>
           </div>
           <div class="row panel panel-primary">
             <label class=""> Data Inicio:</label> <?php echo date("d/m/Y", strtotime($campanhas[$i]->getDataInicio())); ?>
           </div>
           <div class="row panel panel-primary">
             <label class=""> Data Fim:</label> <?php echo date("d/m/Y", strtotime($campanhas[$i]->getDataFim())); ?>
           </div>
         </div>
         <div class="col-xs-6 col-md-6 text-center">
           <a href="visualizarCampanha.php?id=<?php echo $campanhas[$i]->getIdCampanha(); ?>" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;"> Ver Campanha </a>
         </div>

          </div>

<?php
        }
        echo '</div>';

      }

    }

  }

  ?>

  </div>
</div>
  </div>
  <?php
  include("footer.php");
 ?>
