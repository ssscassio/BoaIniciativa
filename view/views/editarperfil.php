<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BoaIniciativa</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/modern-business.css" rel="stylesheet">
  <link href="css/bootstrap-lavish.css" rel="stylesheet">


  <!-- Custom Fonts -->
  <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php
  //verifica se a sessao ja est� criada
  /**session_start();

  if( !(isset($_SESSION['cpf'])) && !(isset ($_SESSION['senha'])) ){
    header('location:index.php'); //caso n�o esteja, redireciona o usu�rio para a p�gina de index
  }
  */
  ?>

</head>
<body>
<?php include("cabecalhoLogado.php");?>
  <?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."/database/UsuarioDAO.php");

  var_dump ($_POST['usuario']);

  $usuario = UsuarioDAO::getInstance()->buscarUsuario("71472525191");
  $endereco = array();
  $endereco = $usuario->getEndereco();
  ?>


<br><br><br>

  <div class="container">
    <div class="row">
	<br>
    <div class="row">

      <div class="col-lg-12 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Editar Informações
            </h1>
          </div>
        </div>

        <form method="post" action="rotas.php" name="formedicao">

		<div class="panel panel-default col-lg-6">
        <h4 class="page-header">Informações do Usuário</h4>

          <div class="form-group">
            <label>Nome Completo</label>
            <input type="text" class="form-control" NAME="nome" required  placeholder="Nome Completo" value="<?php echo $usuario->getNome();?>">
          </div>
          <div class="form-group">
            <label>E-mail</label>
            <input type="email" class="form-control" NAME="email" placeholder="Email" value="<?php echo $usuario->getEmail();?>">
          </div>
          <div class="form-group">
            <label>Sexo</label>
            <input type="text" class="form-control" NAME="sexo" placeholder="Sexo" value="<?php echo $usuario->getSexo();?>">
          </div>
          <div class="form-group">
            <label>Data de Nascimento</label>
            <input type="date" class="form-control" NAME="nascimento" placeholder="Data de Nascimento" value = "<?php echo $usuario->getDataNascimento();?>">
          </div>
        </div>



        <div class="panel panel-default col-lg-6">
            <h4 class="page-header">Endereço</h4>
            <div class="form-group">
              <label>CEP</label>
              <input type="text" class="form-control" name="cep" required  value="<?php echo $endereco['cep']?>">
            </div>
            <div class="form-group">
              <label>Estado</label>
              <input type="text" class="form-control" name="estado" required  value="<?php echo $endereco['estado']?>">
            </div>
            <div class="form-group">
              <label>Bairro</label>
              <input type="text" class="form-control" name="bairro" required value="<?php echo $endereco['bairro']?>">
            </div>
            <div class="form-group">
              <label>Cidade</label>
              <input type="text" class="form-control" name="cidade" required value="<?php echo $endereco['cidade']?>">
            </div>
            <div class="form-group">
              <label>Logradouro</label>
              <input type="text" class="form-control" name="logradouro" required  value="<?php echo $endereco['logradouro']?>">
            </div>
            <div class="form-group">
              <label>Numero</label>
              <input type="number" class="form-control" name="numero" required value="<?php echo $endereco['numero']?>">
            </div>
            <div class="form-group">
              <label>Complemento</label>
              <input type="text" class="form-control" name="complemento" required  value="<?php echo $endereco['complemento']?>">
          </div>

          </div>

		 <h4></h4>
          <button type="submit" name="botaoEditar"  class="btn btn-primary">Alterar Informações</button>
        </form>
        <br>
      </div>

   </div>

  </div>
  </div>

<?php include("footer.php");?>
</body>
</html>
