<body>

  <?php
  include('cabecalhoLogado.php');
  ?>

  <?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");
  $usuario = UsuarioController::buscarUsuario($_GET['cpfcriador']);
  $endereco = $usuario->getEndereco();?>

  <script type="text/javascrip" src="../js/mapa.js"></script>
  <br><br>

  <div class="container panel">

    <div class="row"><!-- parte Inicial do perfil-->
      <h2 class="page-header"><?php echo $usuario->getNome(); ?></h2>
    </div>
    <div class="row col-xs-12">
      <div class="col-md-5" >
        <img src="../img/logobi.png" class="img-responsive img-circle" alt="" />
      </div>
    </div>
    <br/>

    <div class="row"><!-- parte Inicial do perfil-->
      <h3 class="page-header">Campanhas Criadas</h3>
    </div>
    <table class="table">
      <tr>
        <td>
          <?php

          require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");

          $campanhascriadas = CampanhaDAO::getInstance()->buscarCampanhaPorCriador($usuario->getCpf());
          for($i = 0 ; $i <sizeof($campanhascriadas); $i++){
            $criadas = $campanhascriadas[$i];

            ?>


            <h4><?php echo $criadas->getNome(); ?></h4><br/>


            <?php } //final do loop for
            ?>
          </td>
        </tr>
      </table>
      <br><br>
      <hr>
      <div class="row"><!-- parte Inicial do perfil-->
        <h3 class="page-header">Participando:</h3>
      </div>
      <table class="table">
        <tr>
          <td>
            <?php

            require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");

            $campanhasparticipa = DoacaoDAO::getInstance()->buscarDoacoesDoDoador($usuario->getCpf());
            if(!($campanhasparticipa)){
              echo "Este usuário ainda não participa de nenhuma campanha.";
            }
            for($i = 0 ; $i <sizeof($campanhasparticipa); $i++){
              $participa = $campanhasparticipa[$i];
              $nomecampanha = CampanhaDAO::getInstance()->buscarCampanha($participa->getIdCampanha());


              ?>


              <h4><?php echo $nomecampanha->getNome(); ?></h4><br/>


              <?php } //final do loop for
              ?>
            </td>
          </tr>
        </table>
        <br><br>
        <hr>
      </div>
    </div>

  </div>

</body>
<?php include ('footer.php'); ?>
