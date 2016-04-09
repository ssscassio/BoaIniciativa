    <div id="wrapper">
        <div class="overlay"></div>
            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                <ul class="nav sidebar-nav">
                    <h4>Filtros</h4>
                    <li>
                      <a href="CampanhasSangue.php" class="dropdown-toggle" data-toggle="dropdown">Sangue</a></li>
                    <li>
                      <a href="CampanhasMonetaria.php" class="dropdown-toggle" data-toggle="dropdown">Monetária</a>  </li>
                    <li>
                      <a href="CampanhasRoupas.php" class="dropdown-toggle" data-toggle="dropdown">Roupas</a></li>
                    <li>
                      <a href="CampanhasBrinquedos.php" class="dropdown-toggle" data-toggle="dropdown">Brinquedos</a></li>
                    <li class="dropdown">
                      <a href="CampanhasAlimentos.php" class="dropdown-toggle" data-toggle="dropdown">Alimentos</a></li>
                    <li>
                      <a href="CampanhasOutros.php" class="dropdown-toggle" data-toggle="dropdown">Outros</a></li>
                </ul>
            </nav>
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
              <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
                </button>
            </div>
            <!-- /#page-content-wrapper -->

        </div>

<!-- service end -->






<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>

<!-- Scripts -->
    <a href="#0" class="cd-top">Top</a>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/main.js"></script> <!-- Gem jQuery -->

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
