<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AlterarFotoFacade.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");

// Nas vers�es do PHP anteriores a 4.1.0, $HTTP_POST_FILES deve ser utilizado ao inv�s
// de $_FILES.

$usuario = UsuarioDao::getInstance()->buscarUsuario($_SESSION['cpf']); 

$uploaddir = "../uploads/".$usuario->getCpf();
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	AlterarFotoFacade::getInstance()->editarFoto($uploadfile,$usuario->getCpf()); 
	//AlterarFotoFacade::getInstance()->editarFoto($uploadfile,$_SESSION['cpf']);	
}

	header('location:perfil.php');


?>