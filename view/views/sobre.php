<?php
if( (isset($_SESSION['cpf'])) && (isset ($_SESSION['senha'])) ){//Verifica se já está logado
  include("cabecalhoLogado.php");
}else {
  include("cabecalho.php");
}
?>

<div class="container">
  <!-- Marketing Icons Section -->
  <div class="row">
      <form method="get" action="visualizarCampanha.php">
          <div class="col-lg-12">
              <h2 class="page-header">
                Sobre o Boa Iniciativa
              </h2>
          </div>

          <p>Este é um site dedicado a permitir doações entre pessoas que precisam e pessoas que queiram ajudar. Se você é um deles, junte-se a nós. Aqui você poderá criar suas próprias campanhas, realizar doações e até mesmo participar como atendente em um posto de doação de uma campanha existente. Infinitas possibilidades, infinitas maneiras de ajudar a melhorar a vida de alguém. </p>

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
