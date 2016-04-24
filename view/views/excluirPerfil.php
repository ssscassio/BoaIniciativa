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
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/EditarPerfilFacade.php");
   
	$confirmacaoExcluir = EditarPerfilFacade::getInstance()->excluirPerfil($_SESSION['cpf']); // PEGAR SESSd
	
	if($confirmacaoExcluir){
		echo '<script>';
		echo "excluirTrue();";  
		echo '</script>';
	}else{
	    echo '<script>';
		echo "excluirFalse();";  
		echo '</script>';
	}
?>
