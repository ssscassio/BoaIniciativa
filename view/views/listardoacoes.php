
<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/DoadorController.php");
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

      if(sizeof($doacoes) == 0){?>
        <div class="alert alert-danger row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
          ?>
          <div class="list-group-item row">
            <div class="col-xs-6 text-center">
           <div class="row panel panel-primary">
             <label class=""> Data:</label> <?php echo date("d/m/Y", strtotime($doacoes[$i]->getData())); ?>
           </div>
         </div>
         <div class="col-xs-6 col-md-6 text-center">
           <a href="campanha.php?id=<?php echo $doacoes[$i]->getIdCampanha(); ?>" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;"> Ver Campanha </a>
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
