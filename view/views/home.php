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

</body>
<?php include ('footer.php'); ?>
