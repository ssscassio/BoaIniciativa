<?php
include("cabecalhologado.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/AtendenteController.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");


if(isset($_GET['campanha'])){
  $idCampanha = $_GET['campanha'];
  $autenticacao = AtendenteController::getInstance()->autenticarAtendente($_SESSION['cpf'],$idCampanha);

  ?>
  <br><br><br><br>
  <div class="container">
    <div class="row">


      <?php
      include("painelAtendente.php");
      echo '<div class="col-md-9 panel panel-default">';
      if($autenticacao){//Usuario atende na campanha
        ?>
        <h2 class="page-header">Atendimento na campanha <?php echo CampanhaDAO::getInstance()->buscarCampanha($idCampanha)->getNome(); ?></h2>
        <div class="row">
          <div class="col-md-6 panel panel-success">
            <h3 class="page-header"> Digite o CPF do usuário para confirmar a doação</h3>
            <script type="text/javascript">
              $(document).ready(function (){
                $('#botaoVerDoacoes').click(function(){
                  document.formVerDoacoes.submit();
                });
              });
            </script>
            <form  name="formVerDoacoes" id="formVerDoacoesCPF" action="atender.php">
              <input type="hidden" id="idCampanha" name="campanha" value="<?php echo $idCampanha; ?>">
              <div class="row">
                <div class="form-group col-md-6">
                  <label > CPF</label>
                  <input type="number" id="cpfUsuario" class="form-control" name="cpf" required  placeholder="CPF">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <a id="botaoVerDoacoes" class="btn btn-block btn-primary" > Ver Doações</a>
                </div>
              </div>
            </form>

          </div>
            <?php if(isset($_GET['cpf'])){//Se o cpf do usuário for setado
              echo '<div class="col-md-6 panel panel-success">';
              $usuario = UsuarioController::getInstance()->buscarUsuario($_GET['cpf']);
              if($usuario->getCpf() != null){
              echo '<h2 class="page-header">Doações de ';
              if($usuario->getNome() == ""){
                echo $usuario->getCpf();
              }else{
                echo $usuario->getNome();
              }
              echo'</h2>';
              $doacoes = AtendenteController::getInstance()->buscarDoacoesPendentesNaCampanha($_GET['cpf'],$_GET['campanha']);
              if(sizeof($doacoes) == 0){
                echo '<div class="alert alert-warning row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
                   Usuario não tem processo de doação iniciado nessa campanha, iniciar um agora clicando no botão abaixo.
                </div>';
                 //Parte de criar nova doação aqui em baixo?>


                 <?php
              }else{//Listar as doacoes não confirmadas do usuario
              ?>
              Usuario tem doações

              <?php }
            }else{
                echo '<div class="alert alert-warning row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
                  <strong>Desculpe!</strong> Usuario não encontrado. Tente efetuar um cadastro rápido no painel ao lado.
                </div>';
              }
              echo '</div>';
            } ?>

        </div>

        <?php
      }else{//Usuario Não atende na campanha
        ?>
        <div class="alert alert-warning row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Desculpe!</strong> Você não tem permissão de atender nesta campanha.
        </div>

        <?php

      }

    }else{
      header('location:atendente.php');
    }

    ?>
  </div>
</div>
</div>

<?php include("footer.php"); ?>
