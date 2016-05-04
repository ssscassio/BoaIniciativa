<?php
session_start();
if( isset($_SESSION['cpf']) && isset ($_SESSION['senha']) ){//Verifica se já está logado
  include("cabecalhologado.php");
}else {
  include("cabecalho.php");
}
?>

<link href="../css/bootstrap-social.css" rel="stylesheet">

<div class="container">
  <!--Sobre o boa Iniciativa-->
  <div class="row panel">
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
    <div class="row panel">
      <div class="col-xs-12">
        <h2 class="page-header"> Sobre a equipe</h2>
      </div>
      <div class="col-xs-12">
        <h4>O BoaIniciativa foi criado como parte do conteúdo da disciplina MI- Engenharia de Software da Universidade Estadual de Feira de Santana (UEFS) sob orientação de Rodrigo Tripodi.
      </h4>
    </div>
    </div>
    <!--Listagem dos membros-->
    <div class="container">

      <!--Primeiro membro-->
      <div class="row panel panel-default">
        <div class="col-md-12">
          <h3 class="page-header">Rodrigo Tripodi Calumby</h3>
        </div>
        <div class="col-md-4 col-sm-6">
          <img class="img-responsive center-block img-thumbnail" src="../img/membros/tripodi.gif" alt="" style="max-width:300px; max-height:300px;" width="300" height="300">
        </div>
        <div class="col-md-4 col-sm-6">
          Doutor em Ciência da Computação pela UNICAMP. Atualmente é professor da área de Bancos de Dados da Universidade Estadual de Feira de Santana. Seus principais interesses de pesquisa incluem: recuperação da informação por conteúdo, recuperação de dados multimídia, recuperação multimodal, fusão de dados, técnicas de aprendizado de máquina, recuperação interativa, realimentação de relevância e métodos e ferramentas para avaliação de sistemas de recuperação da informação. É membro associado à Sociedade Brasileira de Computação, ACM SIGIR (Special Interest Group on Information Retrieval) e IEEE.
        </div>
        <div class="col-md-4">
          <h3>Detalhes de contato</h3>
          <p><i class="fa fa-phone"></i>
            <abbr title="Telefone">P</abbr>:</p>
            <p><i class="fa fa-envelope-o"></i>
              <abbr title="Email">E</abbr>: <a href="#"></a>
            </p>
              <ul class="list-unstyled list-inline list-social-icons">
                <li>
                  <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--Fim primeiro membro-->
          <!--segundo membro-->

    <div class="row panel panel-default">
        <div class="col-md-12">
          <h3 class="page-header">Cássio Silva de Sá Santos</h3>
        </div>
        <div class="col-md-4 col-sm-6">
          <img class="img-responsive center-block img-thumbnail" src="../img/membros/cassio.gif" alt="" style="max-width:300px; max-height:300px;" width="300" height="300">
        </div>
        <div class="col-md-4 col-sm-6">
          Graduando em Engenharia de Computação pela Universidade Estadual de Feira de Santana com ingresso em 2014. Curso de Técnico em Mecatrônica em andamento com ingresso em 2014. Atualmente é Bolsista de Iniciação Científica trabalhando com elaboração de metodologia de medição de desempenho em GPU utilizando a plataforma de computação paralela CUDA.
        </div>
        <div class="col-md-4">
          <h3>Detalhes de contato</h3>
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
                  <a href="https://github.com/ssscassio"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--fim do segundo membro-->
          <!--terceiro membro-->
      <div class="row panel panel-default">
        <div class="col-md-12">
          <h3 class="page-header">Beatriz de Brito Santana</h3>
        </div>
        <div class="col-md-4 col-sm-6">
          <img class="img-responsive center-block img-thumbnail" src="../img/membros/beatriz.gif" alt="" style="max-width:300px; max-height:300px;" width="300" height="300">
        </div>
        <div class="col-md-4 col-sm-6">
          Graduando em Engenharia da Computação pela Universidade Estadual de Feira de Santana (2013.2-atual). Formada em Técnica em Informática pelo Instituto Federal de Educação Ciências e Tecnologia da Bahia, Campus de Santo Amaro (2009-2013). Conhecimentos em linguagens como Java, C e JSP, em plataformas como Eclipse e Notepad++ com banco de dados MySql e SQL Server.
        </div>
        <div class="col-md-4">
          <h3>Detalhes de contato</h3>
          <p><i class="fa fa-phone"></i>
            <abbr title="Telefone">P</abbr>:(71) 99278-4670</p>
            <p><i class="fa fa-envelope-o"></i>
              <abbr title="Email">E</abbr>: <a href="mailto:beatrizbritosantana@gmail.com">beatrizbritosantana@gmail.com</a>
            </p>
              <ul class="list-unstyled list-inline list-social-icons">
                <li>
                  <a href="https://www.facebook.com/biabsantana"><i class="fa fa-facebook-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://www.twitter.com/biabsantana"><i class="fa fa-twitter-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://github.com/biabsantana"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--Fim terceiro membro-->
          <!--Quarto membro-->
      <div class="row panel panel-default">
        <div class="col-md-12">
          <h3 class="page-header">Renato Santos Mascarenhas</h3>
        </div>
        <div class="col-md-4 col-sm-6">
          <img class="img-responsive center-block img-thumbnail" src="../img/membros/renato.jpg" alt="" style="max-width:300px; max-height:300px;" width="300" height="300">
        </div>
        <div class="col-md-4 col-sm-6">
          Aluno graduando do curso de Engenharia de Computação da Universidade Estadual de Feira de Santana (UEFS), Bahia, Brasil
        </div>
        <div class="col-md-4">
          <h3>Detalhes de contato</h3>
          <p><i class="fa fa-phone"></i>
            <abbr title="Telefone">P</abbr>: (75) 99187-7888</p>
            <p><i class="fa fa-envelope-o"></i>
              <abbr title="Email">E</abbr>: <a href="mailto:natofsa93@gmail.com">natofsa93@gmail.com</a>
            </p>
              <ul class="list-unstyled list-inline list-social-icons">
                <li>
                  <a href="https://www.facebook.com/natofsa"><i class="fa fa-facebook-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://github.com/natofsa"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--Fim Quarto membro-->
          <!--Quinto membro-->
      <div class="row panel panel-default">
        <div class="col-md-12">
          <h3 class="page-header">Jussara Gomes Machado</h3>
        </div>
        <div class="col-md-4 col-sm-6">
          <img class="img-responsive center-block img-thumbnail" src="../img/membros/jussara.gif" alt="" style="max-width:300px; max-height:300px;" width="300" height="300">
        </div>
        <div class="col-md-4 col-sm-6">
          Aluno graduando do curso de Engenharia de Computação da Universidade Estadual de Feira de Santana (UEFS), Bahia, Brasil
        </div>
        <div class="col-md-4">
          <h3>Detalhes de contato</h3>
          <p><i class="fa fa-phone"></i>
            <abbr title="Telefone">P</abbr>:</p>
            <p><i class="fa fa-envelope-o"></i>
              <abbr title="Email">E</abbr>: <a href="3"></a>
            </p>
              <ul class="list-unstyled list-inline list-social-icons">
                <li>
                  <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://github.com/JussaraGomes"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--Fim quinto membro-->
          <!--sexto membro-->
      <div class="row panel panel-default">
        <div class="col-md-12">
          <h3 class="page-header">Lucas Conceição Morais</h3>
        </div>
        <div class="col-md-4 col-sm-6">
          <img class="img-responsive center-block img-thumbnail" src="../img/membros/lucas.jpg" alt="" style="max-width:300px; max-height:300px;" width="300" height="300">
        </div>
        <div class="col-md-4 col-sm-6">
         Tem experiência na área de Engenharia de Computação, com ênfase em Engenharia de Computação
        </div>
        <div class="col-md-4">
          <h3>Detalhes de contato</h3>
          <p><i class="fa fa-phone"></i>
            <abbr title="Telefone">P</abbr>:</p>
            <p><i class="fa fa-envelope-o"></i>
              <abbr title="Email">E</abbr>: <a href="#"></a>
            </p>
              <ul class="list-unstyled list-inline list-social-icons">
                <li>
                  <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://github.com/gordinh"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--Fim sexto membro-->
          <!--setimo membro-->
      <div class="row panel panel-default">
        <div class="col-md-12">
          <h3 class="page-header">Sillas Senna Rios de Macedo</h3>
        </div>
        <div class="col-md-4 col-sm-6">
          <img class="img-responsive center-block img-thumbnail" src="../img/membros/sillas.gif" alt="" style="max-width:300px; max-height:300px;" width="300" height="300">
        </div>
        <div class="col-md-4 col-sm-6">
          Aluno graduando do curso de Engenharia de Computação da Universidade Estadual de Feira de Santana (UEFS), Bahia, Brasil
        </div>
        <div class="col-md-4">
          <h3>Detalhes de contato</h3>
          <p><i class="fa fa-phone"></i>
            <abbr title="Telefone">P</abbr>:</p>
            <p><i class="fa fa-envelope-o"></i>
              <abbr title="Email">E</abbr>: <a href="#"></a>
            </p>
              <ul class="list-unstyled list-inline list-social-icons">
                <li>
                  <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://github.com/ssenn4"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--Fim setimo membro-->
          <!--setimo membro-->
      <div class="row panel panel-default">
        <div class="col-md-12">
          <h3 class="page-header">Anderson Teixeira dos Santos</h3>
        </div>
        <div class="col-md-4 col-sm-6">
          <img class="img-responsive center-block img-thumbnail" src="../img/membros/anderson.jpg" alt="" style="max-width:300px; max-height:300px;" width="300" height="300">
        </div>
        <div class="col-md-4 col-sm-6">
          Aluno graduando do curso de Engenharia de Computação da Universidade Estadual de Feira de Santana (UEFS), Bahia, Brasil
        </div>
        <div class="col-md-4">
          <h3>Detalhes de contato</h3>
          <p><i class="fa fa-phone"></i>
            <abbr title="Telefone">P</abbr>:</p>
            <p><i class="fa fa-envelope-o"></i>
              <abbr title="Email">E</abbr>: <a href="#"></a>
            </p>
              <ul class="list-unstyled list-inline list-social-icons">
                <li>
                  <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                </li>
                <li>
                  <a href="https://github.com/atsantos12"><i class="fa fa-github-square fa-2x"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!--Fim setimo membro-->
        </div>
      </div>

    </div>

    <!--Footer-->
    <div class="container">
      <?php include("footer.php"); ?>
    </div>
