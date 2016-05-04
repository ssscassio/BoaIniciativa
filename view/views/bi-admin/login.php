<body>
    <script type="text/javascript" src="js/login.js"></script>
    <div  style="max-width: 400px; padding: 120px 0 0; margin: auto;">

      <div class="col-xs-12 panel panel-default">
        <div class="row">
              <img src="img/logobi.png" class="img-responsive" alt="" />
        </div>

        <form id="formlogin" method="POST" action="rotas.php">
          <div class="form-group">
            <label >CPF: <font color="FF0000">*</font> </label>
          <div class="row">
            <div class="col-md-6">
              <input id="cpfAdm" type="text" class="form-control" name="cpf" required data-validation-required-message="Por favor, digite seu CPF." placeholder="Ex.: 00000000000">
            </div>
            <div id="cpfAdmerror" class="col-md-6">

            </div>
          </div>
          </div>
          <div class="form-group">
            <label>Senha: <font color="FF0000">*</font> </label>
            <div class="row">
                <div class="col-md-6">
                  <input id="senhaAdm" type="password" class="form-control" name="senha" required placeholder="Password">
                </div>
                <div id="senhaAdmerror"class="col-md-6">
                </div>
            </div>
          </div>
          <button type="submit" name="botaoLoginAdm" class="btn btn-primary">Entrar</button>
        </form>
          <div id ="loginerror">

          </div>
        <br>
      </div>

    </div>

</body>
