<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/CriadorController.php");
session_start();
if( isset($_SESSION['cpf']) && isset ($_SESSION['senha']) ){//Verifica se já está logado
  include("cabecalhologado.php");
}else {
  include("cabecalho.php");
}

?>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/UsuarioFacade.php");
    $id = $_GET['campanha'];
    $aux = UsuarioFacade::getInstance()->verCampanha($id);
    CriadorFacade::getInstance()->excluirCampanha($id);
    $campanha = UsuarioFacade::getInstance()->verCampanha($id);
    ?>

    <div class="col-md-9 panel panel-default">
      <h2 class="page-header"><?php echo $aux->getNome(); ?>
        <?php
        if($campanha->getIdCampanha() == null){
          echo "Campanha " . $aux->getNome(). " deletada com sucesso";
        }else{
          echo "Campanha " . $aux->getNome(). " não deletada";
        }?>


<!--Footer-->
    <div class="container">
      <?php include("footer.php"); ?>
    </div>