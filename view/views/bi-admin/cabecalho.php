<?php
//verifica se a sessao ja está criada (Impede de vir nesta pagina caso não esteja logado)


session_start();

if( (isset($_SESSION['cpfAdm'])) && (isset ($_SESSION['senhaAdm'])) ){
  header('location:home.php'); //caso não esteja, redireciona o usuário para a página de index
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/logobi.png">

    <title>BoaIniciativa Adiministrador Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/jquery-1.12.3.min.js" type="text/javascript"></script>
    <script src="../../js/modernizr.js"></script> <!-- Modernizr -->
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link href="../../css/modern-business.css" rel="stylesheet">
    <link href="../../css/bootstrap-lavish.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/owlcarousel/owl.carousel.css"> <!-- arrumacao e acho que animacao do slide -->


    <!-- Custom Fonts -->
    <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet"> <!-- IMPORTANTE ! SE TIRAR ISSO NAO FICA COMO BARRA LATERAL! -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>



<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Painel de Administrador - BoaIniciativa</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
