
<?php
$usuario = UsuarioController::buscarUsuario($_SESSION['cpf']);
$endereco = $usuario->getEndereco();

 ?>
  <div class="container">
    <div class="row">
	<br>
    <div class="row">

      <div class="col-lg-12 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Editar Informações
            </h1>
          </div>
        </div>

        <form method="post" action="rotas.php" name="formedicao">

		<div class="panel panel-default col-lg-6">
        <h4 class="page-header">Informações do Usuário</h4>
          <input type="hidden" class="form-control" NAME="cpf" value="<?php echo $usuario->getCpf();?>">

          <div class="form-group">
            <label>Nome Completo</label>
            <input type="text" class="form-control" NAME="nome" required  placeholder="Nome Completo" value="<?php echo $usuario->getNome();?>">
          </div>
          <div class="form-group">
            <label>E-mail</label>
            <input type="email" class="form-control" NAME="email" placeholder="Email" value="<?php echo $usuario->getEmail();?>">
          </div>
          <div class="form-group">
            <label>Sexo: *</label><br>
            <input type="radio" name="sexo" value="male" <?php if($usuario->getSexo()=="M")  echo "checked";?>> Homem<br>
            <input type="radio" name="sexo" value="female"<?php if($usuario->getSexo()=="F")  echo "checked";?>> Mulher<br>
          </div>
          <div class="form-group">
            <label>Data de Nascimento</label>
            <input type="date" class="form-control" NAME="nascimento" placeholder="Data de Nascimento" value = "<?php echo date("d/m/Y", strtotime($usuario->getDataNascimento()));?>">
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
              <label>Logradouro</label>
              <input type="text" class="form-control" name="logradouro" required  value="<?php echo $endereco['logradouro']?>">
            </div>
            <div class="form-group">
              <label>Numero</label>
              <input type="number" class="form-control" name="numero" required value="<?php echo $endereco['numero']?>">
            </div>
            <div class="form-group">
              <label>Complemento</label>
              <input type="text" class="form-control" name="complemento" value="<?php echo $endereco['complemento']?>">
          </div>

<?php
  $l = $endereco['logradouro'];
  $n = $endereco['numero'];
  $b = $endereco['bairro'];
  $c = $endereco['cidade'];
  $enderecoJunto = "$l, $n, $b, $c";
   ?>
          <script type='text/javascript'>
            var

            var endereco = "<?php echo $enderecoJunto;?>";
            var postos = new Array(endereco);
            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({ 'address': postos[0]}, function(results, status){
              //se status ok
              if (status = google.maps.GeocoderStatus.OK){
                //pega o retorno que ehlat e long
                var lat = results[0].geometry.location.lat();
                var lng = results[0].geometry.location.lng();
              }
            });

              document.getElementById('latitude').value = lat;
              document.getElementById('longitude').value = lng;

          </script>

          </div>

		 <h4></h4>
          <button type="submit" name="botaoEditar"  class="btn btn-primary">Alterar Informações</button>
        </form>
        <br>
      </div>

   </div>

  </div>
  </div>
