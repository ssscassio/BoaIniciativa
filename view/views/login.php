<?php include("cabecalho.php"); ?>
<body>

  <br><br>
  <script type="text/javascript" src="../js/login.js"></script>
  <script src="../js/jquery.maskedinput.js" type="text/javascript"></script>

<div class="container">
    <div class="row">

    <div class="row">
      <div class="col-lg-6 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Entrar
            </h1>
          </div>
        </div>

        <form id="formlogin" method="POST" >
          <div class="form-group">
            <label>Seu CPF: <font color="FF0000">*</font> </label>
              <input id="cpflogin" type="text" class="form-control" name="cpf" placeholder="Ex.: 00000000000">
            <div id="cpfloginerror" ></div>
          </div>
          <div class="form-group">
            <label>Senha: <font color="FF0000">*</font></label>
            <input id="senhalogin" type="password" class="form-control" name="senha" placeholder="Password">
            <div id="senhaloginerror"></div>
          </div>
            <input type="submit" name="botaoLogar" class="btn btn-primary" value="Entrar">
        </form>

        <div><a href="recuperarSenha.php">Esqueci minha senha</a></div>

        <br>
        <div id="loginerror"></div>
      </div>


      <div class="col-lg-6 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Novo cadastro
            </h1>
          </div>
        </div>

        <form method="post" action="rotas.php" id="formcadastro" name="formcadastro">
          <div class="panel panel-default col-lg-6">
            <h4 class="page-header">Informações da conta</h4>
          <div class="form-group">
            <label>Nome Completo</label>
            <input type="text" class="form-control" name="nome" required  placeholder="Nome Completo">
          </div>
          <div class="form-group">
            <label >Seu CPF</label>
            <input type="number" class="form-control" name="cpf" required  placeholder="CPF">
          </div>
          <div class="form-group">
            <label> Senha</label>
            <input id="senhacadastro"type="password" class="form-control" name="password" require placeholder="Password">
            <div id="senhacadastroerror"></div>
          </div>
          <div class="form-group">
            <label>E-mail</label>
            <input type="email" class="form-control" name="email" require placeholder="Email">
          </div>
          <div class="form-group">
            <label>Data de Nascimento</label>
            <input type="date" class="form-control" name="nascimento" require placeholder="dd/mm/yyyy">
          </div>
          <div class="form-group">
          <label>Sexo</label><br>
            <input type="radio" name="gender" value="male" checked> Homem<br>
            <input type="radio" name="gender" value="female"> Mulher<br>
          </div>
        </div>

          <div class="panel panel-default col-lg-6">
            <h4 class="page-header">Endereço</h4>
            <div class="form-group">
              <label>CEP</label>
              <input type="text" class="form-control" name="cep" required  >
            </div>
            <div class="form-group">
              <label>Estado</label>
              <input type="text" class="form-control" name="estado" required  >
            </div>
            <div class="form-group">
              <label>Bairro</label>
              <input type="text" class="form-control" name="bairro" required >
            </div>
            <div class="form-group">
              <label>Cidade</label>
              <input type="text" class="form-control" name="cidade" required >
            </div>
            <div class="form-group">
              <label>Logradouro</label>
              <input type="text" class="form-control" name="longradouro" required  >
            </div>
            <div class="form-group">
              <label>Numero</label>
              <input type="number" class="form-control" name="numero" required >
            </div>
            <div class="form-group">
              <label>Complemento</label>
              <input type="text" class="form-control" name="complemento" required  >
          </div>
          </div>
          <input type="submit" name="botaoCadastrar" class="btn btn-primary" value="Criar nova conta!">
        </form>
        <br>
      </div>
    </div>

  </div>
</div>

<div class="container">
  <?php include("footer.php"); ?>
</div>




</body>
</html>
