<?php
  session_start();
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/DoadorFacade.php");
  //require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
  include("cabecalhologado.php");
?>

  <br><br><br><br>
  <div class="container">
    <div class="row">


      <?php
      include("painelDoador.php");

      echo '<div class="col-md-9">';
      if(isset($_GET['idCampanha']) && isset($_GET['doadorcpf'])){

      $idInsercao = DoadorFacade::getInstance()->doar($_GET['idCampanha'], $_GET['doadorcpf']);
      ?>
      <div class="col-lg-6">
          <h2 class="page-header">
      <?php
      if($idInsercao!=0){
        echo " Doação realizada com sucesso.";
      }else{
        echo "Erro ao realizar doação.";
      }?>
      </h2>
  </div>

<?php
      }


      ?>

    </div>
  </div>
  </div>
