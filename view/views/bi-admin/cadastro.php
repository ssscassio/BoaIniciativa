<?php include_once("cabecalhologado.php"); ?>

<br><br><br><br>
<div class="container">


<div class="row">

  <?php include_once("painelAdministrativo.php"); ?>

  <div class="col-md-9 panel panel-default">


    <body>
      <div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <h1 class="page-header">Cadastrar Novo Administrador
              </h1>
            </div>
          </div>

          <form method="post" action="rotas.php" id="formcadastro" name="formcadastro">
            <div class="panel panel-default col-md-12">
              <h4 class="page-header">Informações da conta</h4>
              <div class="form-group">
                <label>Nome Completo: *</label>
                <input type="text" class="form-control" name="nome" required  placeholder="Nome Completo">
              </div>
              <div class="form-group">
                <label >CPF: *</label>
                <input type="number" class="form-control" name="cpf" required  placeholder="CPF">
              </div>
              <div class="form-group">
                <label> Senha: *</label>
                <input type="password" class="form-control" name="password" require placeholder="Password">
              </div>
              <div class="form-group">
                <label>E-mail: *</label>
                <input type="email" class="form-control" name="email" require placeholder="Email">
              </div>
              <div class="form-group">
                <label>Data de Nascimento: *</label>
                <input type="date" class="form-control" name="nascimento" require placeholder="Data de Nascimento">
              </div>
              <div class="form-group">
                <label>Sexo: *</label><br>
                <input type="radio" name="gender" value="male" checked> Homem<br>
                <input type="radio" name="gender" value="female"> Mulher<br>
              </div>
            </div>
            <input type="submit" name="botaoCadastrarAdm" class="btn btn-primary" value="Criar novo administrador!">
          </form>
          <br>
        </div>

      </div>
  </div>
</div>

</div>
<?php include_once("footer.php"); ?>

  <?php include_once("footer.php"); ?>

</body>
