
<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/CriadorController.php");
include("cabecalhologado.php");
?>
<br><br><br><br>
<div class="container">
<div class="row">


<?php
include("painelCriador.php");

  echo '<div class="col-md-9">';
?>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <h1 class="page-header">Criar Campanha
              </h1>
            </div>
          </div>

          <form method="post" action="rotas.php" id="formcadastro" name="formcadastro">
            <div class="panel panel-default col-md-12">
              <h4 class="page-header">Informações da campanha</h4>
              <div class="form-group">
                <label>Nome da campanha <font color="red">*</font></label>
                <input type="text" class="form-control" name="nome" required  placeholder="Nome da campanha">
              </div>
              <div class="form-group">
                <label> Descrição <font color="red">*</font></label>
                <input type="text" rows="4" class="form-control" name="descricao" required placeholder="Descrição da Campanha">
              </div>
              <div class="form-group">
                <label> Item de arrecadação <font color="red">*</font> </label>
                <input type="text" class="form-control" name="possiveisArrecadacoes" required placeholder="Arrecadação">
              </div>
              <div class="form-group">
                <label>Data Final da campanha <font color="red">*</font></label>
                <input type="date" class="form-control" name="dataFim" required placeholder="Formato: dd/mm/aaaa">
              </div>
              <div class="form-group">
                <label>Data esperada para atingir a meta <font color="red">*</font></label>
                <input type="date" class="form-control" name="dataMeta" placeholder="Formato: dd/mm/aaaa">
              </div>
              <div class="form-group">
                <label>TITULO: Agradecimento padrão<font color="red">*</font></label>
                <input type="text" class="form-control" name="agradecimentotitulo" required placeholder="título do agradecimento">
              </div>
              <div class="form-group">
                <label>MENSAGEM: Agradecimento padrão<font color="red">*</font></label>
                <input type="text" class="form-control" name="agradecimentomensagem" required placeholder="mensagem do agradecimento">
              </div>
              <div class="form-group">
                <label>Imagem da campanha</label>
                <input type="file" name="imagem">
              </div>
            </div>
            <input type="submit" name="botaoCadastrarCampanha" class="btn btn-primary" value="Criar campanha!">
          </form>
          <br>
        </div>
</div>
</div>
</div>

<?php include("footer.php"); ?>
