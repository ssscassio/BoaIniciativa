<body>

  <?php
    include('cabecalhoLogado.php');
    include('painelUsuario.php');
  ?>

  <?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");
  $usuario = UsuarioController::buscarUsuario($_SESSION['cpf']);?>


  <div class="container col-md-9">
    <div class="row">
      <div class="col-md-12 panel panel-primary">

        <div class="row"><!-- parte Inicial do perfil-->
          <h2 class="page-header">Cássio Silva de Sá</h2>
        </div>
        <div class="row">
          <div class="col-md-5" >
            <img src="../img/logobi.png" class="img-responsive img-circle" alt="" />
          </div>
          <div class="col-md-7 panel-primary panel container">
            <h3 class="page-header"> Informações Pessoais</h3>
            <div class="row">
              <label class=""> CPF:</label> 05727933595
            </div>
            <div class="row">
              <label class=""> Email:</label> sss.cassio@gmail.com
            </div>
            <div class="row">
              <label class=""> Sexo:</label> Masculino
            </div>
            <div class="row">
              <label class=""> Data de Nascimento:</label> 13/01/1997
            </div>

            sexo 	datanascimento 	classificacao 	cep 	estado 	bairro 	cidade 	logradouro
             	numero 	complemento 	bloqueado 	databloqueio 	latitude 	longitude
          </div>
        </div>


      </div>
    </div>

  </div>
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

    <div class="col-md-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4><?php echo $campanha->getNome();?></h4>
        </div>
        <div class="panel-body">
          <img class="img-responsive img-portfolio" src="
          <?php if($campanha->getImagem()=="" || $campanha->getImagem()=="default.jpg"){
              echo "../img/logobi.png";
          }else{
            echo $campanha->getImagem();
          } ?>
          ">
          <p><?php echo $campanha->getDescricao(); ?></p>
          <a href="visualizarCampanha.php?campanha=<?php echo $campanha->getIdCampanha(); ?>" class="btn btn-primary">Ver Campanha</a>
        </div>
      </div>
    </div>



  <!-- /.row -->
<?php } //final do loop for
?>
  </div>
</body>
<?php include ('footer.php'); ?>
