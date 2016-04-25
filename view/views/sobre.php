<?php
if( (isset($_SESSION['cpf'])) && (isset ($_SESSION['senha'])) ){//Verifica se já está logado
  include("cabecalhologado.php");
}else {
  include("cabecalho.php");
}
?>

<link href="../css/bootstrap-social.css" rel="stylesheet">

<div class="container">
  <!--Sobre o boa Iniciativa-->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">Sobre o Boa Iniciativa</h2>
    </div>
    <div class=" container">
      <div class="col-md-6">
        <h4>      Este é um site dedicado a permitir doações entre pessoas que precisam e pessoas que queiram ajudar. Se você é um deles, junte-se a nós. Aqui você poderá criar suas próprias campanhas, realizar doações e até mesmo participar como atendente em um posto de doação de uma campanha existente. Infinitas possibilidades, infinitas maneiras de ajudar a melhorar a vida de alguém. </h4>
      </div>
      <div class="col-md-6">
        <img class="img-responsive" style="margin:20px;" src="../img/logobi.png" alt="">
      </div>
    </div>
  </div>
  <!--Sobre a equipe-->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header"> Sobre a equipe</h2>
    </div>
    <div class="col-xs-12">
      Falar aqui sobre o pbl e dizer o motivo de ter criado o sistema(Como problema da disciplina)Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>
    <!--Listagem dos membros-->
    <div class="container">

      <!--Primeiro membro-->
      <div class="row">
        <div class="col-md-12">
          <h3 class="page-header">Cássio Silva de Sá Santos</h3>
        </div>
        <div class="col-md-4">
          <img class="img-responsive" src="http://placehold.it/300x300" alt="">
        </div>
        <div class="col-md-4">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="col-md-4">
          <h2>Detalhes de contato</h2>
          <p><i class="fa fa-phone"></i>
            <abbr title="Telefone">P</abbr>: (75) 99125-4306</p>
            <p><i class="fa fa-envelope-o"></i>
              <abbr title="Email">E</abbr>: <a href="mailto:ssscassio@gmail.com">ssscassio@gmail.com</a>
            </p>
              <ul class="list-unstyled list-inline list-social-icons">
                <li>
                  <a href="https://www.facebook.com/ssscassio"><i class="fa fa-facebook-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://br.linkedin.com/in/cássio-silva-de-sá-santos-6a7199104
"><i class="fa fa-linkedin-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://github.com/ssscassio"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="http://steamcommunity.com/id/ssscassio/"><i class="fa fa-steam-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--Fim primeiro membro-->
        </div>
      </div>

    </div>

    <!--Footer-->
    <div class="container">
      <?php include("footer.php"); ?>
    </div>
