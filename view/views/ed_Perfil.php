<script>
function edicaoTrue() {
var answer = confirm ("Perfil editado com sucesso")

window.location="perfil.php"

}

function edicaoFalse() {
var answer = confirm ("Houve um erro ao editar seu perfil, tente novamente mais tarde")

window.location="perfil.php"

}

</script>

<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/EditarPerfilFacade.php");

 
                                                                                          
 if(isset($_POST['botaoEditar'])){
	
        if(isset($_POST['nome'])       && isset($_POST['sexo'])       && isset($_POST['password']) 
		&& isset($_POST['email'])      && isset($_POST['nascimento']) && isset($_POST['cep'])
        && isset($_POST['estado'])     && isset($_POST['bairro'])     && isset($_POST['cidade']) 
		&& isset($_POST['longradouro']) && isset($_POST['numero'])     && isset($_POST['complemento'])){
				
		
			   $sexo = $_POST['sexo'];
			   $nome = $_POST['nome'];
			   $email = $_POST['email'];
			   $senha = $_POST['password'];
			   $nascimento = $_POST['nascimento'];
			   $cep = $_POST['cep'];
			   $estado = $_POST['estado'];
			   $bairro = $_POST['bairro'];
			   $cidade = $_POST['cidade'];
			   $longradouro = $_POST['longradouro'];
			   $numero = $_POST['numero'];
			   $complemento = $_POST['complemento'];
               
			   $usuario = UsuarioDao::getInstance()->buscarUsuario($_SESSION['cpf']); 
			       
			//	($nome, $email, $senha, $usuario->getFoto(), $sexo, $nascimento, $usuario->getClassificacao(), $cep, $estado, $bairro, $cidade, $longradouro,$numero, $complemento, $cpf,  $usuario->getBloqueado(),$usuario->getDataBloqueio())
						   
			   $confirmacaoEditar = EditarPerfilFacade::getInstance()->editarPerfil($nome, $email, $senha, $usuario->getFoto(), $sexo, $nascimento, $usuario->getClassificacao(), $cep, $estado, $bairro, $cidade, $longradouro,$numero, $complemento, $usuario->getCpf(),  $usuario->getBloqueado(),$usuario->getDataBloqueio());
		       
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
			 
         }else{
           echo "Preencha todos os campos";
         }
      
    }
   
?>
