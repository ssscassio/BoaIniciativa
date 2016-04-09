<!DOCTYPE html>
<html lang="pt">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/logobi.png">

    <title>Boa Iniciativa</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../css/bootstrap-lavish.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/owlcarousel/owl.carousel.css"> <!-- arrumacao e acho que animacao do slide -->


    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/style.css" rel="stylesheet"> <!-- IMPORTANTE ! SE TIRAR ISSO NAO FICA COMO BARRA LATERAL! -->

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
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="index.php">BoaIniciativa</a>
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

            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php">Login/Cadastro</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->

    </div>



    <!-- /.container -->
</nav>
