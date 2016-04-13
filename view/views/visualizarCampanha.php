
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
    $id = $_GET['id'];
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
          echo '<img src="../img/logobi.png" class="img-responsive img-rounded" alt="" />';
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

          <div class="container-fluid panel panel-success col-md-6" style="padding:20px;">
            <h2 class="page-header">Ações</h2>
            <a href="">Ver criador</a><br/>
            <a href="">Convidar Amigo</a><br/>
            <a href="">Cancelar Participação</a><br/>
            <a href="">Denunciar</a><br/>
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
