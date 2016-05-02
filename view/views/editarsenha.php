
<?php
$usuario = UsuarioController::buscarUsuario($_SESSION['cpf']);
$endereco = $usuario->getEndereco();

 ?>
 <script type="text/javascript" src="../js/cadastro.js"></script>
  <div class="container">
    <div class="row">
	<br>
    <div class="row">
      <div class="panel panel-default col-lg-6">
          <h4 class="page-header">Editar Senha</h4>
          <form method="post" action="rotas.php" name="formmudarsenha">
            <input type="hidden" class="form-control" NAME="cpf" value="<?php echo $usuario->getCpf();?>">

            <div class="row">
              <div class="form-group col-md-6">
                <label>Senha anterior: </label>
                <input type="password" class="form-control" NAME="senha" required  placeholder="Senha anterior">
              </div>
              <div class="col-md-6" id="senhaAnteriorMensagem">

              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Nova senha: </label>
               <input id="senhacadastro"type="password" class="form-control" name="novasenha" required placeholder="Digite sua senha">
            <div id="senhaforca"></div>
            <div id="senhacadastroerror"></div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>Confirmar senha:</label>
                <input id="repetirsenhacadastro" type="password" class="form-control" name="repetirpassword" required placeholder="Repetir sua senha">
            <div id="repetirsenhacadastroerror"></div>

              </div>
            </div>

            <div class="form-group">
              <button type="submit" name="botaoSenha"  class="btn btn-primary">Atualizar Senha</button>
            </div>
          </form>
          <br>
      </div>
      <!--<script type="text/javascript">
          function validaSenha (input){ 
            if (input.value != document.getElementById('novasenha').value) {
            input.setCustomValidity('Repita a senha corretamente');
            } else {
              input.setCustomValidity('');
            }
          }
      </script>-->
      <script type="text/javascript">

        $(document).ready(function(){

          $('#formmudarsenha').validate({
            rules:{confsenha: {

							equalTo: "#novasenha"
						}},
            messages:{confsenha:{
              equalTo: "A senha digitada não confere."
            }}
          })
        
        })
      </script>


   </div>

  </div>
  </div>
