<?php
	require_once("../controller/RenatoUsuarioController.php");

	$nome = $_POST['nome'];

	$campanha = RenatoUsuarioController::getInstance()->buscarCampanha($nome);
	echo "ID:".$campanha->getIdCampanha(). "<br>";
	echo "Nome:".$campanha->getNome(). "<br>";
	echo "Descrição:".$campanha->getdescricao(). "<br>";
	echo "Data Inicio:".$campanha->getDataInicio(). "<br>";
	echo "Data Final:".$campanha->getDataFim(). "<br>";
	echo "Valores: <br>";
	print "<pre>===============\n";
    var_dump($campanha->getValores());
  	print "===================</pre>";







?>