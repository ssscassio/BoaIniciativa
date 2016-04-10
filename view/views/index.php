
<body>

  <?php
  if(isset($_SESSION['cpf']) && isset($_SESSION['senha'])){
    header("location:home.php");
  }else{
    include('cabecalho.php');
  }
  ?>


  <!-- Header Carousel -->
  <header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <div class="fill" style="background-image:url('http://lorempixel.com/1900/1080/people/1');"></div>
        <div class="carousel-caption">
          <a  href="login.php" class="btn btn-primary btn-lg">Começar a doar</a>
        </div>
      </div>
      <div class="item">
        <div class="fill" style="background-image:url('http://lorempixel.com/1900/1080/people/2');"></div>
        <div class="carousel-caption">
          <a  href="listarcampanhas.php" class="btn btn-primary btn-lg">Ver Campanhas</a>
        </div>
      </div>
      <div class="item">
        <div class="fill" style="background-image:url('http://lorempixel.com/1900/1080/people/3');"></div>
        <div class="carousel-caption">
          <a  href="login.php" class="btn btn-primary btn-lg">Iniciar uma campanha</a>
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
        <h1 class="page-header">Sobre o Boa Iniciativa</h2>
        </div>
        <div class="col-md-6">
          <p><h4>Este é um site dedicado a permitir doações entre pessoas que precisam e pessoas que queiram ajudar. Se você é um deles, junte-se a nós. Aqui você poderá criar suas próprias campanhas, realizar doações e até mesmo participar como atendente em um posto de doação de uma campanha existente. Infinitas possibilidades, infinitas maneiras de ajudar melhorar a vida de alguém. <br>Boa Iniciativa, muito mais que um gesto! </h4></p>
        </div>
        <div class="col-md-6">
          <img class="img-responsive" src="../img/logobi.png" alt="">
        </div>
      </div>
      <!-- /.row -->
      <!-- Marketing Icons Section -->
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
                echo "../img/logobi.png";
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

      <!-- Call to Action Section -->



      <hr>

      <?php
      include('footer.php');

      ?>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
      interval: 5000 //changes the speed
    })
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Scripts -->
    <a href="#0" class="cd-top">Top</a>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/main.js"></script> <!-- Gem jQuery -->

    <script type="text/javascript">
    $(document).ready(function () {
      var trigger = $('.hamburger'),
      overlay = $('.overlay'),
      isClosed = false;

      trigger.click(function () {
        hamburger_cross();
      });

      function hamburger_cross() {

        if (isClosed == true) {
          overlay.hide();
          trigger.removeClass('is-open');
          trigger.addClass('is-closed');
          isClosed = false;
        } else {
          overlay.show();
          trigger.removeClass('is-closed');
          trigger.addClass('is-open');
          isClosed = true;
        }
      }

      $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
      });
    });
    </script>
  </body>
