
<?php include('cabecalho.php'); //Adição do cabeçalho?>

<body>

  <header id="myCarousel" class="carousel slide">

    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="item active">
        <div class="fill" style="background-image:url('../img/comece_doar.png');"></div>
        <div class="carousel-caption">
          <a  href="login.php" class="btn btn-primary btn-lg">Começar a doar</a>
        </div>
      </div>
      <div class="item">
        <div class="fill" style="background-image:url('../img/ver_campanhas');"></div>
        <div class="carousel-caption">
          <a  href="listarcampanhas.php" class="btn btn-primary btn-lg">Ver Campanhas</a>
        </div>
      </div>
      <div class="item">
        <div class="fill" style="background-image:url('../img/iniciar_campanha.png');"></div>
        <div class="carousel-caption">
          <a  href="login.php" class="btn btn-primary btn-lg">Iniciar uma campanha</a>
        </div>
      </div>
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="icon-next"></span>
    </a>
  </header>

  <div class="container">

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
                echo "../img/campanha.png";
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
      <!-- Portfolio Section -->
      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-header">Outras Campanhas</h2>
        </div>

        <?php
        require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
        $arraybusca = CampanhaDAO::getInstance()->buscarCampanhasAleatorias(6);
        for($i = 0 ; $i < 6 ; $i++){
          $campanha = $arraybusca[$i];

          ?>
          <div class="col-xs-4">
            <a href="campanha?campanha=<?php echo $campanha->getIdCampanha(); ?>">
              <img class="img-responsive img-portfolio img-hover" src="<?php if($campanha->getImagem()=="" || $campanha->getImagem()=="default.jpg"){
                echo "../img/campanha.png";
              }else{
                echo $campanha->getImagem();
              } ?>
              " alt="<?php echo $campanha->getNome();?>">
            </a>
          </div>
          <?php } ?>
        </div>
        <!-- /.row -->
        <hr>




      </div>


      <!-- jQuery -->
      <script src="../js/jquery.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="../js/bootstrap.min.js"></script>
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')</script>
      <script src="../dist/js/bootstrap.min.js"></script>
      <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
      <script src="../assets/js/vendor/holder.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>

      <!-- Scripts -->

      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="../js/main.js"></script> <!-- Gem jQuery -->

      <script type="text/javascript" src="../js/index.js"> </script>

    </body>

    <div class="container">
      <?php include('footer.php');?>
    </div>
