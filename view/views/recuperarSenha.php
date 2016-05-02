<?php
include("cabecalho.php");
if(isset($_POST['cpf']) && isset($_POST['senha'])){
	header('location:home.php');
}
?>
<script type="text/javascript" src="../js/login.js"></script>
<script src="../js/jquery.maskedinput.js" type="text/javascript"></script>
<br><br>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 panel panel-default">
    </div>
    <div class="row">
      <div class="col-lg-6 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Recuperação de Senha
            </h1>
          </div>
        </div>
          <form method="POST" action="rotas.php">
          <div class="form-group">
            <label >Seu CPF<font color="FF0000">*</font></label>
            <input id="cpflogin" type="text" class="form-control" name="cpf" required data-validation-required-message="Por favor, digite seu CPF." placeholder="Ex.: 00000000000" required>
          </div>
          <div class="col-md-6" id="cpfloginerror" ></div>
          <div class="row">
          <button type="submit" name="botaoRecuperarSenha" class="btn btn-primary">Recuperar</button>
          </div>
          <br><br>
        </form>
        </div>
        </div>
     </div>
    </div>
    <div class="container">
      <?php include("footer.php"); ?>
    </div>    
