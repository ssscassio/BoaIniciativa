
<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/DoadorController.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
include("cabecalhologado.php");
?>
<br><br><br><br>
<div class="container">
<div class="row">


<?php
include("painelDoador.php");

  echo '<div class="col-md-9">';
  if(isset($_GET['tipo']) && isset($_GET['filtro'])){

    if ($_GET['tipo'] == 'doador') {
      $doacoes = DoadorController::getInstance()->listarDoacoes($_SESSION['cpf'], $_GET['filtro']);
    //  $codmaterial = array();
    //  $codmaterial = DoacaoMaterialDAO::getInstance()->listarMateriaisDaDoacao($doacao->getIdDoacao()); //codigo do materialCod


      if(sizeof($doacoes) == 0){?>
        <div class="alert alert-danger row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
          <strong>Desculpe!</strong> Não conseguimos encontrar o que você está procurando.
        </div>


        <?php
      }else{

        switch ($_GET['filtro']) {
          case 'todas':
          echo '<h2 class="page-header">Listando Todas Doações</h2>';
          break;
          case 'pendentes':
          echo '<h2 class="page-header">Listando Doações Pendentes</h2>';
          break;
          case 'confirmadas':
          echo '<h2 class="page-header">Listando Doações Confirmadas</h2>';
          break;
        }

        echo '<div class="list-group">';
        for($i = 0; $i <sizeof($doacoes); $i++){
          $campanha = CampanhaDAO::getInstance()->buscarCampanha($doacoes[$i]->getIdCampanha());
          ?>
          <div class="list-group-item row">
            <div class="col-xs-6">
              <?php if($campanha->getImagem() == "" || $campanha == "default.jpg"){
                echo '<img src="../img/campanha.png" class="img-responsive img-rounded" alt="" />';
              }else{
                echo '<img src="'.$campanha->getImagem().'" class="img-responsive img-rounded" alt="" />';
              } ?>
              <div class="text-center">
                  <span class="label <?php if($campanha->getStatus())
                                            {echo 'label-info"> Ativa';
                                            }else{
                                              echo 'label-danger"> Finalizada';
                                            }?>
                                          </span>
              </div>
            </div>
            <div class="col-xs-6 text-center">
           <div class="row panel panel-primary">
             <label class=""> Nome da campanha:</label> <?php echo $campanha->getNome(); ?>
           </div>
           <div class="row panel panel-primary">
             <label class=""> Data Inicio:</label> <?php echo date("d/m/Y", strtotime($campanha->getDataInicio())); ?>
           </div>
           <div class="row panel panel-primary">
             <label class=""> Data Fim:</label> <?php echo date("d/m/Y", strtotime($campanha->getDataFim())); ?>
           </div>
           <div class="row panel panel-primary">
             <label class=""> Data da doação:</label> <?php echo date("d/m/Y", strtotime($doacoes[$i]->getData())); ?>
           </div>
         </div>
         <div class="col-xs-6 col-md-6 text-center">
           <a href="campanha.php?campanha=<?php echo $campanha->getIdCampanha(); ?>" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;"> Ver Campanha </a>
         </div>
        <?php
        if(!$doacoes[$i]->getConfirmado()){ ?>
         <div class="col-xs-6 col-md-6 text-center">
           <form action="rotas.php" method="post">
             <input type="hidden" name="idDoacao" value="<?php echo $doacoes[$i]->getIdDoacao() ?>">
             <input type="submit" name="botaoCancelarDoacao" class="btn btn-primary btn-block" value="Cancelar Doação">
           </form>
         </div>
         <?php
        }
        ?>
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

<div class="container">
  <?php
  include("footer.php");
 ?>
</div>
