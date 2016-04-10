<?php include("cabecalhoLogado.php");?>

<br><br><br>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 panel panel-default">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Criar Campanha</h1>
          </div>
        </div>
        <form method="post" action="confirmarCampanhaCriada.php" id="formcriar" name="formcriar">
          <div class="form-group">
            <label>Nome da campanha</label>
            <input type="text" class="form-control" name="nome" required  placeholder="Nome da campanha">
          </div>
          <div class="form-group">
            <label> Descrição</label>
            <input type="text" class="form-control" name="descricao" required placeholder="Descrição da Campanha">
          </div>
          <div class="form-group">
            <label> Item de arrecadação</label>
            <input type="text" class="form-control" name="possiveisArrecadacoes" required placeholder="Arrecadação">
          </div>
          <div class="form-group">
            <label>Data de Início da Campanha</label>
            <input type="date" class="form-control" name="dataInicio" required placeholder="Data Inicial da Campanha">
          </div>
          <div class="form-group">
            <label>Data Final da campanha</label>
            <input type="date" class="form-control" name="dataFim" required placeholder="Data Final da Campanha">
          </div>
          <div class="form-group">
            <label>Data esperada para atingir a meta</label>
            <input type="date" class="form-control" name="dataMeta" placeholder="Data da meta da Campanha">
          </div>
          <div class="form-group">
            <label>Agradecimento</label>
            <input type="text" class="form-control" name="agradecimento" required placeholder="Agradecimento da campanha">
          </div>
          <div class="form-group">
            <label>Imagem da campanha</label>
            <input type="file" name="imagem" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="criarCampanha">Criar Campanha</button>
          </div>
          <br>
        </form>
      </div>
        <br>
      </div>
    </div>

  </div>
  </div>

<?php include("footer.php");?>
</body>
</html>
