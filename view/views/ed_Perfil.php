<script>
	function edicaoTrue() {
		var answer = confirm ("Perfil editado com sucesso!")
		window.location="logout.php"
	}

	function edicaoFalse() {
		var answer = confirm ("Houve um erro ao editar seu perfil, tente novamente mais tarde.")
		window.location="perfil.php"
	}
</script>

<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AlterarFotoFacade.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/SistemaFacade.php");
 
    if(isset($_POST['botaoEditar'])){
	
        if(isset($_POST['nome'])       && isset($_POST['email'])      && isset($_POST['nascimento'])
		&& isset($_POST['email'])      && isset($_POST['nascimento']) && isset($_POST['cep'])
		&& isset($_POST['estado'])     && isset($_POST['bairro'])     && isset($_POST['cidade'])
		&& isset($_POST['logradouro']) && isset($_POST['numero'])     && isset($_POST['complemento'])   
		&& isset($_POST['sexo'])){
				
		
			   $sexo = $_POST['sexo'];
			   $nome = $_POST['nome'];
			   $email = $_POST['email'];
			   $nascimento = $_POST['nascimento'];
			   $cep = $_POST['cep'];
			   $estado = $_POST['estado'];
			   $bairro = $_POST['bairro'];
			   $cidade = $_POST['cidade'];
			   $longradouro = $_POST['logradouro'];
			   $numero = $_POST['numero'];
			   $complemento = $_POST['complemento'];
               
			   $usuario = UsuarioDao::getInstance()->buscarUsuario($_SESSION['cpf']); 
			       
			//	($nome, $email, $senha, $usuario->getFoto(), $sexo, $nascimento, $usuario->getClassificacao(), $cep, $estado, $bairro, $cidade, $longradouro,$numero, $complemento, $cpf,  $usuario->getBloqueado(),$usuario->getDataBloqueio())
						   
			   $confirmacaoEditar = SistemaFacade::getInstance()->editarPerfil($nome, $email, $usuario->getSenha(), 
			   $usuario->getFoto(), $sexo, $nascimento, $usuario->getClassificacao(), $cep, $estado, $bairro, $cidade, 
			   $longradouro,$numero, $complemento, $usuario->getCpf(),  $usuario->getBloqueado(),$usuario->getDataBloqueio(),
			   $usuario->getLatitude(), $usuario->getLongitude());
		       
			   if($confirmacaoEditar){
				echo '<script>';
				echo "edicaoTrue();";  
				echo '</script>';
				
				echo "Perfil editado";
			   }else{
				echo '<script>';
				echo "edicaoFalse();";  
				echo '</script>';
				echo "Erro ao editar";
			   }
			   
			    $uploaddir = "../uploads/".$usuario->getCpf();
			    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
			    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
					AlterarFotoFacade::getInstance()->editarFoto($uploadfile,$usuario->getCpf());	
				}
         }      
    }
   
?>
