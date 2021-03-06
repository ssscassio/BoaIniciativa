
  <?php
    session_start();
    if(isset($_SESSION['cpf']) && isset($_SESSION['senha'])){
      include("cabecalhologado.php");
    }
    else{
      include("cabecalho.php");
    }
  ?>
  <body>

  <?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");
  $usuario = UsuarioController::buscarUsuario($_GET['cpf']);
  $endereco = $usuario->getEndereco();?>

  <script type="text/javascrip" src="../js/mapa.js"></script>
  <br><br>

  <div class="container panel">

    <div class="row"><!-- parte Inicial do perfil-->
      <h2 class="page-header"><?php echo $usuario->getNome(); ?></h2>
    </div>
    <div class="row ">
      <div class="col-xs-12 col-md-5" >
        <img class="img-responsive img-rounded center-block" style="margin:15px;" src="
        <?php if($usuario->getFoto()=="" || $usuario->getFoto()=="default.jpg"){
          echo "../img/usuario.png";
        }else{
          echo $usuario->getFoto();
        } ?>
        ">
      </div>
    </div>
    <br/>





  <div class="row">
    <div class="panel panel-success col-md-6" style="padding:20px;"><!-- parte Inicial do perfil-->
      <h3 class="page-header">Campanhas Criadas</h3>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Link</th>
          </tr>
        </thead>
        <?php

        require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");

        $campanhascriadas = CampanhaDAO::getInstance()->buscarCampanhaPorCriador($usuario->getCpf());
        for($i = 0 ; $i <sizeof($campanhascriadas); $i++){
          $criadas = $campanhascriadas[$i];

          ?>
          <tbody>
            <tr>
              <td><?php echo $criadas->getNome(); ?></td>
              <td><a href="campanha.php?campanha=<?php echo $criadas->getIdCampanha(); ?>"> Ver Campanha </a></td>
            </tr>
          </tbody>
          <?php } //fim do for ?>
        </table>

      </div>
      <div class="panel panel-success col-md-6" style="padding:20px;">
        <h3 class="page-header">Campanhas Participadas:</h3>


        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Criador</th>
              <th>Link</th>
            </tr>
          </thead>
          <?php

          require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");

          $campanhasparticipa = DoacaoDAO::getInstance()->buscarDoacoesDoDoador($usuario->getCpf());
          if(!($campanhasparticipa)){
            echo "Este usuário ainda não participa de nenhuma campanha.";
          }else{

            for($i = 0 ; $i <sizeof($campanhasparticipa); $i++){
              $participa = $campanhasparticipa[$i];
              $nomecampanha = CampanhaDAO::getInstance()->buscarCampanha($participa->getIdCampanha());
              $criador = UsuarioDAO::getInstance()->buscarUsuario( $nomecampanha->getCriadorCpf());

              ?>
              <tbody>
                <tr>
                  <td><?php echo $nomecampanha->getNome(); ?></td>
                  <td> <a href="usuario.php?cpf=<?php echo $nomecampanha->getCriadorCpf(); ?>"><?php echo $criador->getNome(); ?> </a></td>
                  <td><a href="campanha.php?campanha=<?php echo $nomecampanha->getIdCampanha(); ?>"> Ver Campanha </a></td>
                </tr>
              </tbody>
              <?php } //fim do for ?>
            </table>
            <?php } //fim do if ?>
          </div>
  </div>
        </div>
      </div>

    </div>

  </body>
<div class="container">
  <?php include ('footer.php'); ?>
</div>
