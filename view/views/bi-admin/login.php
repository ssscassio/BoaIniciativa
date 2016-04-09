<body>
    <div style="width: 400px; padding: 200px 0 0; margin: auto;">

      <div class="col-lg-12 panel panel-default">
        <div class="row">
              <img src="img/logobi.png" class="img-responsive" alt="" />
        </div>

        <form method="POST" action="rotas.php">
          <div class="form-group">
            <label >CPF: *</label>
            <input type="text" class="form-control" name="cpf" required data-validation-required-message="Por favor, digite seu CPF." placeholder="Ex.: 00000000000">
          </div>
          <div class="form-group">
            <label>Senha: *</label>
            <input type="password" class="form-control" name="senha" required placeholder="Password">
          </div>
          <button type="submit" name="botaoLogin" class="btn btn-primary">Entrar</button>
        </form>
          <div id ="mensagem">

          </div>
        <br>
      </div>

    </div>
    <?php include_once("footer.php"); ?>

</body>
