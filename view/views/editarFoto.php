<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AlterarFotoFacade.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");

	if(!isset($_SESSION)){
	  session_start();
	}
	
// Nas versões do PHP anteriores a 4.1.0, $HTTP_POST_FILES deve ser utilizado ao invés
// de $_FILES.

	$usuario = UsuarioController::buscarUsuario($_SESSION['cpf']);

	$uploaddir = "../uploads/".$usuario->getCpf();
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

	$fotoUsuario = $usuario->getFoto();
	
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		AlterarFotoFacade::getInstance()->editarFoto($uploadfile,$usuario->getCpf()); 
		unlink($fotoUsuario); 
	}

	header('location:perfil.php');
?>