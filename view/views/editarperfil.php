<body>
<?php include("cabecalhoLogado.php");?>
  <?php 
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/PerfilFacade.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");
  $usuario = UsuarioController::buscarUsuario($_SESSION['cpf']);  
  $usuario = UsuarioDAO::getInstance()->buscarUsuario("654321");  
  $endereco = array();
  $endereco = $usuario->getEndereco();  
  $deletar = false;
  
  ?>


<br><br><br>

  <div class="container">
    <div class="row">
	<br>
    <div class="row">

      <div class="col-lg-6 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Editar Informações
            </h1>
          </div>
        </div>
        
        <form method="post" action="ed_Perfil.php" NAME="formedicao">

		<div class="panel panel-default col-lg-6">
        <h4 class="page-header">Informações do Usuário</h4>
		                                                                                      
          <div class="form-group">
            <label>Nome Completo</label>
            <input type="text" class="form-control" NAME="nome" required  placeholder="Nome Completo" value="<?php echo $usuario->getNome();?>">
          </div>
          <div class="form-group">
            <label> Nova senha</label>
            <input type="password" class="form-control" NAME="password" placeholder="Novo Password" value="<?php echo $usuario->getSenha();?>">
          </div>
          <div class="form-group">
            <label> Confirme a nova senha</label>
            <input type="password" class="form-control" NAME="repassword" placeholder="Confirmaçãoo de Password" value="<?php echo $usuario->getSenha();?>">
          </div>
          <div class="form-group">
            <label>Novo E-mail</label>
            <input type="email" class="form-control" NAME="email" placeholder="Email" value="<?php echo $usuario->getEmail();?>">
          </div>
          <div class="form-group">
            <label>Confirme o novo E-mail</label>
            <input type="email" class="form-control" NAME="email" placeholder="Confirmação de Email" value="<?php echo $usuario->getEmail();?>">
          </div>
          <div class="form-group">
            <label>Sexo</label>
            <input type="text" class="form-control" NAME="sexo" placeholder="Sexo" value="<?php echo $usuario->getSexo();?>">
          </div>
          <div class="form-group">
            <label>Data de Nascimento</label>
            <input type="date" class="form-control" NAME="nascimento" placeholder="Data de Nascimento" value = "<?php echo $usuario->getDataNascimento();?>">
          </div>		  
        </div>
			
			
				
        <div class="panel panel-default col-lg-6">
            <h4 class="page-header">Endereço</h4>
            <div class="form-group">
              <label>CEP</label>
              <input type="text" class="form-control" name="cep" required  value="<?php echo $endereco['cep']?>">
            </div>
            <div class="form-group">
              <label>Estado</label>
              <input type="text" class="form-control" name="estado" required  value="<?php echo $endereco['estado']?>">
            </div>
            <div class="form-group">
              <label>Bairro</label>
              <input type="text" class="form-control" name="bairro" required value="<?php echo $endereco['bairro']?>">
            </div>
            <div class="form-group">
              <label>Cidade</label>
              <input type="text" class="form-control" name="cidade" required value="<?php echo $endereco['cidade']?>">
            </div>
            <div class="form-group">
              <label>Longradouro</label>
              <input type="text" class="form-control" name="longradouro" required  value="<?php echo $endereco['logradouro']?>">
            </div>
            <div class="form-group">
              <label>Numero</label>
              <input type="number" class="form-control" name="numero" required value="<?php echo $endereco['numero']?>">
            </div>
            <div class="form-group">
              <label>Complemento</label>
              <input type="text" class="form-control" name="complemento" required  value="<?php echo $endereco['complemento']?>">
          </div>
		   
          </div>
		  
		 <h4></h4>                                                          
          		  
		  <button type="submit" name="botaoEditar"  class="btn btn-primary">Atualizar Informações</button>&nbsp;&nbsp;
		  <input type="button" onclick="funcao1()" class="btn btn-primary" value="Excluir Perfil " />
        </form>
		
        <br>
      </div>
	   
   </div>

  </div>
  </div>

<?php include("footer.php");?>
</body>
</html>
