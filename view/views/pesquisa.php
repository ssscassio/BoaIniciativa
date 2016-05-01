<?php
if( (isset($_SESSION['cpf'])) && (isset ($_SESSION['senha'])) ){//Verifica se já está logado
  include("cabecalhologado.php");
}else {
  include("cabecalho.php");
}
?>

<br><br><br>

<div class="container">
  <!-- Marketing Icons Section -->
  <div class="row">
      <form method="get" action="visualizarCampanha.php">
          <div class="col-lg-12">
              <h2 class="page-header">
                Resultado da Pesquisa
              </h2>
          </div>

<?php
// nome, imagem e link da campanha
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");

if(empty($_GET['busca'])){
echo "<h4>Por favor, digite o que deseja pesquisar.</h4>";
$i=0;
}else{
  $arraybusca = CampanhaDAO::getInstance()->procurarCampanhaNome($_GET['busca']);
  if(empty($arraybusca)){
    echo "<h4>     Sinto muito. Não foram encontrados resultados.</h4>";
    $i=0;
  }else{
  for($i = 0 ; $i < count($arraybusca) ; $i++){
    $campanha = $arraybusca[$i];

    if($i%3==0) echo '<div class="row">';
?>


<!-- Page Content -->
          <div class="col-md-4">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h4><?php  echo $campanha->getNome();; ?></h4>
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
                      <a href="visualizarCampanha.php?campanha=<?php echo $campanha->getIdCampanha();; ?>" class="btn btn-primary">Ver Campanha</a>
                  </div>
              </div>
          </div>




<?php
if($i%3==2) echo '</div>';
  }//fecha o for
}//fecha o if
}//fecha o segundo if
  if($i%3 != 2) echo '</div>';?>
    </form>
  </div>
<!-- /.row -->
</div>


</body>




<br>
<br><br><br><br>
<br><br><br><br>
<p>
<p>
<p>
</p> </p> </p>
   <br/>
   <br/>
<?php include("footer.php"); ?>
</html>
