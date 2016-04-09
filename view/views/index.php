<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/logobi.png">

    <title>BoaIniciativa</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/bootstrap-lavish.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/owlcarousel/owl.carousel.css"> <!-- arrumacao e acho que animacao do slide -->

    <script src="js/modernizr.js"></script> <!-- Modernizr -->

    <!-- Custom Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet"> <!-- IMPORTANTE ! SE TIRAR ISSO NAO FICA COMO BARRA LATERAL! -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php
      include("cabecalho.php");
     ?>


<br><br>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('http://lorempixel.com/1900/1080/people/1');"></div>
                <div class="carousel-caption">
                    <button type="button" class="btn btn-primary btn-lg"name="button">Começar a Doar</button>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://lorempixel.com/1900/1080/people/2');"></div>
                <div class="carousel-caption">
                  <a href="filtro.php" class="btn btn-lg btn-primary">Ver Campanhas</a>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://lorempixel.com/1900/1080/people/3');"></div>
                <div class="carousel-caption">
                  <button type="button" class="btn btn-primary btn-lg"name="button">Iniciar uma Campanha</button>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>


    <!-- Page Content -->
    <div class="container">
      <!-- Features Section -->
      <div class="row">
          <div class="col-lg-12">
              <h2 class="page-header">Sobre o Boa Iniciativa</h2>
          </div>
          <div class="col-md-6">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
          </div>
          <div class="col-md-6">
              <img class="img-responsive" src="img/logobi.png" alt="">
          </div>
      </div>
      <!-- /.row -->
        <!-- Marketing Icons Section -->
        <div class="row">
            <form method="get" action="visualizarCampanha.php">
                <div class="col-lg-12">
                    <h2 class="page-header">
                      Campanhas em Destaque
                    </h2>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Boa Iniciativa</h4>
                        </div>
                        <div class="panel-body">
                            <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/700/450/people/" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                            <a href="visualizarCampanha.php?campanha=Boa Iniciativa " class="btn btn-primary">Ver Campanha</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4>Campanha para Mariana</h4>
                        </div>
                        <div class="panel-body">
                            <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/700/450/people/5" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                            <a href="visualizarCampanha.php?campanha=Campanha para Mariana" class="btn btn-primary">Ver Campanha</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4>Campanha contra Corrupção</h4>
                        </div>
                        <div class="panel-body">
                            <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/700/450/people/6" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                            <a href="visualizarCampanha.php?campanha=Campanha contra Corrupção" class="btn btn-primary">Ver Campanha</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->

        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Outras Campanhas</h2>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/500/300/food/1" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/500/300/animals/2" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/500/300/food/3" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/500/300/animals/" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/500/300/animals/5" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-hover" src="http://lorempixel.com/500/300/food/4" alt="">
                </a>
            </div>
        </div>
        <!-- /.row -->







    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include("footer.php"); ?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
