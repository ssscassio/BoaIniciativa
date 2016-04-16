<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/AtendenteController.php");
 ?>
  <h2 class="page-header">Painel de Atendente
  </h2>
      <div class="row">
        <div class="col-xs-6 col-md-12">
          <a name="convites" class="btn btn-primary btn-block" href="convites-atendente.php">Convites <span class="badge"><?php echo AtendenteController::getInstance()->numConvitesPendentes($_SESSION['cpf']); ?></span></a>
          <hr>
        </div>
        <div class="col-xs-6 col-md-12">
          <a name="minhascampanhas" class="btn btn-primary btn-block" href="campanhasAtendente.php">Campanhas que atendo <span class="badge"><?php echo AtendenteController::getInstance()->numCampanhasAtendente($_SESSION['cpf']); ?></a>
          <hr>
        </div>
        <div class="col-xs-6 col-md-12">
          <a name="cadastrorapido" class="btn btn-primary btn-block" href="cadastrorapido.php">Cadastro Rápido</a>
          <hr>
        </div>
      </div>
