<body>

  <?php
  include('cabecalhoLogado.php');
  ?>
<script>
function funcao1(){

	decisao = confirm("Você deseja realmente excluir seu perfil? Pense bem, você não poderá recupera-lo se continuar.");
		
	if (decisao){
		window.location="excluirPerfil.php"
	} 
}
</script>
  <?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");
  $usuario = UsuarioController::buscarUsuario($_SESSION['cpf']);
  
  $usuario->getNome();
  $endereco = $usuario->getEndereco();?>

  <script type="text/javascrip" src="../js/mapa.js"></script>
  <link href="../css/bootstrap-fileupload.min.css" rel="stylesheet" />

  <br><br>

      <div class="container panel">

        <div class="row"><!-- parte Inicial do perfil-->
          <h2 class="page-header"><?php echo $usuario->getNome(); ?></h2>
        </div>
        <div class="row col-xs-12">
          <div class="col-md-5" >
		  <center>
            <img height="320" width="320"src="<?php echo $usuario->getFoto();?>" alt="" />
          </center>
		  
		</div>
          <div class="col-md-7 panel-primary panel container">
            <h3 class="page-header"> Informações Pessoais</h3>
			<font size="3" face="Arial">
            <div class="col-xs-12">
              <label class=""> CPF:</label> <?php echo $usuario->getCpf(); ?>
            </div>
            <div class="col-xs-12">
              <label class=""> Email:</label> <?php echo $usuario->getEmail(); ?>
            </div>
            <div class="col-xs-12">
              <label class=""> Sexo: </label> <?php if ($usuario->getSexo() =="M") {
                echo "Masculino";
              }else{
                echo "Feminino";
              } ?>
            </div>
            <div class="col-xs-12">
              <label class=""> Data de Nascimento:</label> <?php echo date("d/m/Y", strtotime($usuario->getDataNascimento())); ?>
            </div>
			</font>
			
            <div class="col-xs-12">
			    <br>
				<img src="../img\camera.jpg" width="30" height="30"> <font size="2" face="Arial Black">Editar Foto</font>
				<form enctype="multipart/form-data" action="editarFoto.php" method="POST">
					<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
					<input name="userfile" type="file" /><br>
					<input type="submit" value="Alterar Foto" />
				</form> 
			</div>
          </div>
          <script src="../js/jquery.js"></script>
          <script type"text/script" src="../js/script.js"></script>
          <div class="row">
            <!--
          <form method="POST" action="editarperfil.php">
              <div class="col-xs-6 col-md-4">
                <input type="hidden" name="usuario" value="<?php// echo $usuario ?>"
                <button type="submit" name="botaoEditarPerfil" class="btn btn-info btn-block">Editar Perfil</button>
                <hr>
              </div>
            </form>
            <div class="col-xs-6 col-md-4">
              <a name="editarperfil" class="btn btn-info btn-block" href="editarperfil.php">Editar Perfil</a>
              <hr>
            </div>
            <div class="col-xs-6 col-md-4">
              <a name="editarperfil" class="btn btn-info btn-block" href="editarsenha.php">Editar Senha</a>
              <hr>
            </div>
            <div class="col-xs-6 col-md-4">
              <a name="editarperfil" class="btn btn-danger btn-block" href="excluirconta.php">Excluir Conta</a>
              <hr>
            </div>-->
            <div class="col-xs-6 col-md-4">
              <button type="button" id="botaoEditarPerfil" class="btn btn-info btn-block" name="botaoEditarPerfil">Editar Perfil</button>

            </div>
            <div class="col-xs-6 col-md-4">
              <button type="button" id="botaoEditarSenha" class="btn btn-info btn-block" name="botaoEditarSenha">Editar Senha</button>
            </div>
            <div class="col-xs-6 col-md-4">
                <button type="button" onclick="funcao1()" id="botaoExcluirConta" class="btn btn-danger btn-block" name="botaoExcluirConta" value="Excluir Perfil "> Excluir Conta</button>
				
			</div>
          </div>
          <div class="row">
            <div class="panel" id="editarPerfil">
              <?php include('editarperfil.php'); ?>
            </div>

              <div class="panel" id="editarSenha">
                <?php include('editarsenha.php'); ?>
              </div>

                <div class="panel" id="excluirConta">
                  <?php include('excluirconta.php'); ?>
                </div>

          </div>
          <div class="row">
            <h4 class="page-header">Endereço</h4>
            <div class="col-md-12">
              <label class=""> Cep:</label>  <?php echo $endereco['cep']; ?>
            </div>
            <div class="col-md-4">
              <label class=""> Estado:</label> <?php echo $endereco['estado']; ?>
            </div>
            <div class="col-md-4">
              <label class=""> Cidade:</label> <?php echo $endereco['cidade']; ?>
            </div>
            <div class="col-md-4">
              <label class=""> Bairro:</label>  <?php echo $endereco['bairro']; ?>
            </div>
            <?php
            $l = $endereco['logradouro'];
            $n = $endereco['numero'];
            $b = $endereco['bairro'];
            $c = $endereco['cidade'];
            $enderecoJunto = "$l, $n, $b, $c";
            ?>


            <script type="text/javascript">
            function initialize(){
              var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);

              var options = {
                zoom: 5,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
              };

              map = new google.maps.Map(document.getElementById("map"), options);
              var endereco = "<?php echo $enderecoJunto;?>";
              var postos = new Array(endereco);

              marcacaoEndereco(postos);
            }

            function marcacaoEndereco(postos){
              var geocoder = new google.maps.Geocoder();
              map.setZoom(17);

              geocoder.geocode({ 'address': postos[0]}, function(results, status){
                //se status ok
                if (status = google.maps.GeocoderStatus.OK){
                  //pega o retorno que ehlat e long
                  var lat = results[0].geometry.location.lat();
                  var lng = results[0].geometry.location.lng();
                  var latlng = new google.maps.LatLng(lat, lng);
                  //faz marcacao
                  var maker = new google.maps.Marker({position: latlng, map: map});
                  map.setCenter(latlng);//coloca na posicao da marcacao
                }
              });
            }
            </script>
            <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBtrcCnCC71lEBRbj-hM5KwlHcSppnenBI&callback=initialize" async defer></script>
<hr>
<div class="row ">
  <div class="container" style="width: 650px; height: 300px;">
    <div id="map" style=" height: 100%; width: 100%;"></div>
  </div>

</div>
<br><br>
<hr>
          </div>
        </div>

      </div>

      </body>
      <?php include ('footer.php'); ?>
