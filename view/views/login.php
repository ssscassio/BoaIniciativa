<?php include("cabecalho.php"); ?>
<body>

  <br><br>
  <script type="text/javascript" src="../js/login.js"></script>
  <script type="text/javascript" src="../js/cadastro.js"></script>
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
          <div class="col-md-12">

        <form id="formlogin" method="POST" >
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Seu CPF: <font color="FF0000">*</font> </label>
                <input id="cpflogin" type="text" class="form-control" name="cpf" placeholder="Ex.: 00000000000">
              </div>
            </div>
            <div class="col-md-6" id="cpfloginerror" ></div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Senha: <font color="FF0000">*</font></label>
                <input id="senhalogin" type="password" class="form-control" name="senha" placeholder="Password">
              </div>
            </div>
            <div class="col-md-6" id="senhaloginerror"></div>
          </div>

            <input type="submit" name="botaoLogar" class="btn btn-primary" value="Entrar">
        </form>

        <div><a href="recuperarSenha.php">Esqueci minha senha</a></div>

        <br>
        <div id="loginerror"></div>
      </div>
  </div>


      <div class="col-lg-6 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Novo cadastro
            </h1>
          </div>
        </div>

        <form method="post" id="formcadastro" name="formcadastro">
          <div class="panel panel-default col-lg-6">
            <h4 class="page-header">Informações da conta</h4>
          <div class="form-group">
            <label>Nome Completo: <font color="FF0000">*</font> </label>
            <input id="nomecadastro"type="text" class="form-control" name="nome" require placeholder="Nome Sobrenome">
            <div id="nomecadastroerror"></div>
          </div>
          <div class="form-group">
            <label >CPF: <font color="FF0000">*</font> </label>
            <input id="cpfcadastro" type="number" class="form-control" name="cpf" require placeholder="99988877711">
            <div id="cpfcadastroerror"></div>
          </div>
          <div class="form-group">
            <label> Senha : <font color="FF0000">*</font> </label>
            <input id="senhacadastro"type="password" class="form-control" name="password" require placeholder="Digite sua senha">
            <div id="senhaforca"></div>
            <div id="senhacadastroerror"></div>
          </div>
          <div class="form-group">
            <label> Repetir Senha: <font color="FF0000">*</font> </label>
            <input id="repetirsenhacadastro" type="password" class="form-control" name="repetirpassword" require placeholder="Repetir sua senha">
            <div id="repetirsenhacadastroerror"></div>
          </div>
          <div class="form-group">
            <label>E-mail: <font color="FF0000">*</font> </label>
            <input id="emailcadastro" type="email" class="form-control" name="email" require placeholder="email@email.com">
            <div id="emailcadastroerror"></div>
          </div>
          <div class="form-group">
            <label>Data de Nascimento: <font color="FF0000">*</font> </label>
            <input id="nascimentocadastro" type="date" class="form-control" name="nascimento" require placeholder="dd/mm/aaaa">
            <div id="nascimentocadastroerror"></div>
          </div>
          <div class="form-group">
          <label>Sexo: <font color="FF0000">*</font> </label><br>
            <input type="radio" name="gender" value="male" checked> Homem<br>
            <input type="radio" name="gender" value="female"> Mulher<br>
          </div>
        </div>

          <div class="panel panel-default col-lg-6">
            <h4 class="page-header">Endereço</h4>
            <div class="form-group">
              <label>CEP: <font color="FF0000">*</font> </label>
              <input id="cepcadastro" type="text" class="form-control" name="cep"  placeholder="Informe seu CEP" >
              <div id="cepcadastroerror"></div>
            </div>
            <div class="form-group">
              <label>Estado: <font color="FF0000">*</font> </label>
              <input id="estadocadastro" type="text" class="form-control" name="estado" required  placeholder="Informe seu Estado" >
              <div id="estadocadastroerror"></div>
            </div>
            <div class="form-group">
              <label>Bairro: <font color="FF0000">*</font> </label>
              <input id="bairrocadastro" type="text" class="form-control" name="bairro" required placeholder="Informe seu Bairro">
              <div id="bairrocadastroerror"></div>
            </div>
            <div class="form-group">
              <label>Cidade: <font color="FF0000">*</font> </label>
              <input id="cidadecadastro" type="text" class="form-control" name="cidade" required placeholder="Informe sua Cidade">
              <div id="cidadecadastroerror"></div>
            </div>
            <div class="form-group">
              <label>Logradouro: <font color="FF0000">*</font> </label>
              <input id="logradourocadastro" type="text" class="form-control" name="logradouro" required  placeholder="Informe sua Rua">
              <div id="logradourocadastroerror"></div>
            </div>
            <div class="form-group">
              <label>Numero: <font color="FF0000">*</font> </label>
              <input id="numerocadastro" type="number" class="form-control" name="numero" required placeholder="Número de sua Casa">
              <div id="numerocadastroerror"></div>
            </div>
            <div class="form-group">
              <label>Complemento: <font color="FF0000">*</font> </label>
              <input id="complementocadastro" type="text" class="form-control" name="complemento" placeholder=" ex.: Casa/ Apt ..." >
              <div id="complementocadastroerror"></div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <input id="cadastrar" type="submit" name="botaoCadastrar" class="btn btn-primary" value="Criar nova conta!">
            </div>
          </div>
        </form>
        <br>
        <div id="cadastroerror"></div>
      </div>
    </div>

  </div>
</div>

<div class="container">
  <?php include("footer.php"); ?>
</div>




</body>
</html>
