<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AlterarFotoFacade.php");

// Nas versões do PHP anteriores a 4.1.0, $HTTP_POST_FILES deve ser utilizado ao invés
// de $_FILES.

$uploaddir = '../uploads/foto';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Arquivo válido e enviado com sucesso.\n".$uploadfile;
	AlterarFotoFacade::getInstance()->editarFoto($uploadfile,"654321"); // Colocar Sessão
	
} else {
    echo "Erro\n";
}

	header('location:perfil.php');


?>