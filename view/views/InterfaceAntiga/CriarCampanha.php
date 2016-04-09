<?php
require_once("../controller/RenatoUsuarioController.php");

if ( isset( $_POST['criarCampanha'] )) {//Apertou o botão de doar para Campanha no formulário
    	$nome = $_POST['nome'];
    	$descricao = $_POST['descricao'];
    	$possiveisArrecadacoes = $_POST['possiveisArrecadacoes'];
    	$dataDeInicio = $_POST['dataDeInicio'];
    	$dataFim = $_POST['dataFim'];
    	$metaData = $_POST['metaData'];
    	$agradecimento = $_POST['agradecimento'];
    	$imagem = $_POST['imagem'];
    	RenatoUsuarioController::getInstance()->criarCampanha($nome,$descricao,$possiveisArrecadacoes,$dataDeInicio,$dataFim,$metaData,$agradecimento,$imagem);

}

?>