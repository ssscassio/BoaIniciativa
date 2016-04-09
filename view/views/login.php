<?php include("cabecalho.php"); ?>
<body>


  <?php
  session_start();

  if( (isset($_SESSION['cpf'])) && (isset ($_SESSION['senha'])) ){//Verifica se já está logado
    header('location:home.php');
  }

  ?>

  <br><br><br>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 panel panel-default">
    </div>
    <div class="row">
      <div class="col-lg-6 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Entrar
            </h1>
          </div>
        </div>

        <form method="POST" action="rotas.php">
          <div class="form-group">
            <label >Seu CPF</label>
            <input type="text" class="form-control" name="cpf" required data-validation-required-message="Por favor, digite seu CPF." placeholder="Ex.: 00000000000" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input type="password" class="form-control" name="senha" placeholder="Password" required>
          </div>
          <button type="submit" name="botaoLogar" class="btn btn-primary">Entrar</button>
        </form>

        <br>
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
            <input type="password" class="form-control" name="password" require placeholder="Password">
          </div>
          <div class="form-group">
            <label>E-mail</label>
            <input type="email" class="form-control" name="email" require placeholder="Email">
          </div>
          <div class="form-group">
            <label>Data de Nascimento</label>
            <input type="date" class="form-control" name="nascimento" require placeholder="Data de Nascimento">
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

  <?php include("footer.php"); ?>



</body>
</html>
