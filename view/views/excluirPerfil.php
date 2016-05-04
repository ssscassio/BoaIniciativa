<script>

function excluirTrue() {
	var answer = confirm ("Seu perfil foi excluido")
	window.location="logout.php"
}

function excluirFalse() {
	var answer = confirm ("Houve um erro ao excluir seu perfil, tente novamente mais tarde")
	window.location="perfil.php"
}
</script>

<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/SistemaFacade.php");
	
	if(!isset($_SESSION)){
		session_start();
	}
	
	$usuario = UsuarioController::buscarUsuario($_SESSION['cpf']);
	
	$fotoUsuario = $usuario->getFoto();
	
	$confirmacaoExcluir = SistemaFacade::getInstance()->excluirPerfil($usuario->getCpf()); 
	
	if($confirmacaoExcluir){
		echo '<script>';
		echo "excluirTrue();";  
		echo '</script>';
		
		unlink($fotoUsuario); 
	}else{
	    echo '<script>';
		echo "excluirFalse();";  
		echo '</script>';
	}
?>
