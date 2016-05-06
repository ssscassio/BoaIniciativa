<body>

  <?php
  include('cabecalhologado.php');
  ?>

  <?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");
  $usuario = UsuarioController::buscarUsuario($_SESSION['cpf']);
  $endereco = $usuario->getEndereco();?>

  <script type="text/javascrip" src="../js/mapa.js"></script>
  <br><br>

      <div class="container panel">

        <div class="row"><!-- parte Inicial do perfil-->
          <h2 class="page-header"><?php echo $usuario->getNome(); ?></h2>
        </div>
        <div class="row col-xs-12">
          <div class="col-md-9 panel-primary panel container">
            <h3 class="page-header"> Informações Pessoais</h3>
            <div class="col-xs-12">
              <label class=""> Sexo: </label> <?php if ($usuario->getSexo() =="M") {
                echo "Masculino";
              }else{
                echo "Feminino";
              } ?>
            </div>
            <div class="col-xs-12">
              <label class=""> Data de Nascimento:</label> <?php echo date("d/m/Y", strtotime($usuario->getDataNascimento())); ?>
            </div>
          </div>

      </div>

<br><br>


      </div>
      <div class="panel container ">

        <div class="row">
          <div class="col-lg-12">
            <h2 class="page-header">
              Campanhas em Destaque
            </h2>
          </div>

          <?php

          require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");

          $arraybusca = CampanhaDAO::getInstance()->buscarCampanhasDestaque(4);
          for($i = 0 ; $i < 3 ; $i++){
            $campanha = $arraybusca[$i];

            ?>

            <div class="col-sm-4 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4><?php echo $campanha->getNome();?></h4>
                </div>
                <div class="panel-body">
                  <img class="img-responsive img-portfolio" src="
                  <?php if($campanha->getImagem()=="" || $campanha->getImagem()=="default.jpg"){
                    echo "../img/campanha.png";
                  }else{
                    echo $campanha->getImagem();
                  } ?>
                  ">
                  <p><?php echo $campanha->getDescricao(); ?></p>
                  <a href="campanha.php?campanha=<?php echo $campanha->getIdCampanha(); ?>" class="btn btn-primary">Ver Campanha</a>
                </div>
              </div>
            </div>

            <!-- /.row -->
            <?php } //final do loop for
            ?>
          </div>

        </div>
      </body>
<div class="container">
      <?php include ('footer.php'); ?>
</div>
