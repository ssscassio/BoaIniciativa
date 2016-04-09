<!DOCTYPE html>
<html lang="en">
<head >
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1">
    <title>Boa Iniciativa</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<title>
	Boa Iniciativa - Visualizar Perfil
	</title>
</head>
<body>

  <?php
		require_once("../facade/BeatrizUsuarioFacade.php");
		require_once("../model/Usuario.php");
    require_once("../database/UsuarioDAO.php");

		$usuario = UsuarioDAO::getInstance()->buscarUsuario('63516160187');
	  $usuario = BeatrizUsuarioFacade::getInstance()->visualizarPerfil($usuario->getCpf(), $usuario->getEmail());

  ?>
<!-- FALTA MOSTRAR A FOTO-->

Nome: <?php $usuario->getNome(); ?><br>
CPF: <?php $usuario->getCpf(); ?><br>
Email: <?php $usuario->getEmail(); ?><br>
Sexo: <?php $usuario->getNome(); ?><br>
Data de nascimento: <?php $usuario->getDataNascimento(); ?>






</body>
</html>
