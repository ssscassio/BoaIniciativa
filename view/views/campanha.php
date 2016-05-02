
<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/CriadorController.php");
include("cabecalhologado.php");
?>
<br><br><br><br>
<div class="container">
  <div class="row">


    <?php
    include("painelDoador.php");

    ?>

    <?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/UsuarioFacade.php");
    $id = $_GET['campanha'];
    $campanha = UsuarioFacade::getInstance()->verCampanha($id);
    ?>
    <div class="col-md-9 panel panel-default">
      <h2 class="page-header"><?php echo $campanha->getNome(); ?>
        <?php
        if($campanha->getStatus()){
          echo '<span class="label label-info">Ativa</span>';
        }else{
          echo '<span class="label label-danger">Finalizada</span>';
        }?>
      </span> </h2>

      <div class="col-xs-6">
        <?php if($campanha->getImagem() == "" || $campanha == "default.jpg"){
          echo '<img src="../img/campanha.png" class="img-responsive img-rounded" alt="" />';
        }else{
          echo '<img src="'.$campanha->getImagem().'" class="img-responsive img-rounded" alt="" />';
        } ?>
      </div>


      <div class="row">
        <div class="col-xs-6">
          <h3>Data de inicio: <?php echo date("d/m/Y", strtotime($campanha->getDataInicio()));  ?></h3>
        </div>
        <div class="col-xs-6">
          <h3>Data de Fim: <?php echo date("d/m/Y", strtotime($campanha->getDataFim()));?></h3>
        </div>
        <div class="col-xs-6">
          <h3>Meta:</h3><div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
              70%
            </div>
          </div>
        </div></div><div class="row">
          <img src="img/logobi.png" class="img-rounded img-responsive center-block" alt="" />
        </div>
        <div class="row">
          <div class="container-fluid panel panel-success col-md-6" style=" padding:20px;">
            <h2 class="page-header">Descrição</h2>
            <?php echo $campanha->getDescricao(); ?>
            <br/>
            <br/>
            <br/>
          </div>

          <script type="text/javascript" src="../js/campanha.js"></script>

          <div class="container-fluid panel panel-success col-md-6" style="padding:20px;">
            <h2 class="page-header">Ações</h2>
            <a href="usuario.php?cpf=<?php echo $campanha->getCriadorCpf();?>">Ver criador</a><br/>
            <a href="">Convidar Amigo</a><br/>
            <a id="botaoDenunciar">Denunciar</a>
            <div class="panel panel-primary" id="formDenuncia" >
              <form action="rotas.php" method="post">
                <input type="hidden" name="idCampanha" value="<?php echo $campanha->getIdCampanha(); ?>">
                <input type="hidden" name="cpf" value="<?php echo $_SESSION['cpf']; ?>">
                <div class="form-group col-md-12">
                  <label>Motivo</label><br>
                  <input type="radio" name="motivo" value="nomeMotivo1" checked> Motivo 1 <br>
                  <input type="radio" name="motivo" value="nomeMotivo2"> Motivo 2 <br>
                </div>
                <div class="form-group col-md-12">
                  <label>Descrição</label>
                  <input type="text-area" class="form-control" name="descricao" required placeholder="Descricao">
                </div>
                <div class="row text-center">
                  <div class="col-md-6">
                    <input type="submit" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;" name="botaoEnviarDenuncia" value="Denunciar">
                  </div>
                </div>
              </form>

            </div>

          </div>
        </div>


        <div class="panel" style="padding:0px 10px 70px 10px;">
          <center>
            <a href="doar.php?idCampanha=<?php echo $campanha->getIdCampanha();?>&doadorcpf=<?php echo $_SESSION['cpf'];?>" class="btn btn-primary col-xs-12 col-md-12 disable">Efetuar Doação</a>
          </center>
        </div>



      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>
