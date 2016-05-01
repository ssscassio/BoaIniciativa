

<!DOCTYPE html>
<html lang="pt">
 <head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="shortcut icon" href="../img/Header.png">

   <title>BoaIniciativa</title>

   <!-- Bootstrap Core CSS -->
   <link href="../css/bootstrap.min.css" rel="stylesheet">
   <link href="../css/bootstrap.css" rel="stylesheet">

   <!-- Custom CSS -->
   <link href="../css/modern-business.css" rel="stylesheet">
   <link href="../css/bootstrap-lavish.css" rel="stylesheet">
   <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <script src="../js/jquery-1.12.3.min.js" type="text/javascript"></script>
   <script src="../js/modernizr.js"></script> <!-- Modernizr -->

   <!-- Custom Fonts -->
   <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <![endif]-->

 </head>


 <?php
 session_start();
 if (!isset($_SESSION['cpf']) && !isset($_SESSION['senha'])) {
   header("location:index.php");
 }

  ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php"><img src="../img/logobi.png" style="width: 180px;" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <ul class="nav navbar-nav navbar-left">
            <form class="navbar-form" method="GET" action="pesquisa.php">
              <div class="input-group">
                <input class="form-control" type="text" name="busca"  placeholder="Buscar...">
                <div class="input-group-btn">
                  <button class="btn btn-default" name="" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
            </form>
          </ul>
<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
  $usuario = UsuarioDAO::getInstance()->buscarUsuario($_SESSION['cpf']);
  if($usuario->getNome() != null){
    $nome = $usuario->getNome();
    $nome = explode(" ", $nome, -1);
    $primeiroNome = $nome[0];
  }
 ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="criador.php">Criação</a></li>
                <li><a href="doador.php">Doação</a></li>
                <li><a href="atendente.php">Atendimento</a></li>
                <li><a href="perfil.php"><?php if(isset($primeiroNome)){echo $primeiroNome;}else{echo "Sem Nome";} ?></a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->

    </div>



    <!-- /.container -->
</nav>
