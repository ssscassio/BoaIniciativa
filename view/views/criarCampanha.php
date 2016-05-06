<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BoaIniciativa</title>

  <!-- Bootstrap Core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../css/modern-business.css" rel="stylesheet">
  <link href="../css/bootstrap-lavish.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


  <script type="text/javascript" src="../js/jquery-1.12.3.min.js"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->


  <!-- script para funcoes de metamaterial -->

  <script type="text/javascript" src="../js/criarCampanha.js"></script>
  <?php
  //verifica se a sessao ja está criada
  session_start();

  if( !(isset($_SESSION['cpf'])) && !(isset ($_SESSION['senha'])) ){
    header('location:login.php'); //caso não esteja, redireciona o usuário para a página de index
  }
  // vou agora setar todas as informações da campanha

  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/CriadorFacade.php");

  $itensMedidas = CriadorFacade::getInstance()->listarMateriais();
  $opcoes = "";
  for ($i = 0; $i < sizeof($itensMedidas); $i++) {
    $opcoes .= '<option value="'.$itensMedidas[$i]->getCodigo().'">';
    $opcoes .= $itensMedidas[$i]->getNome().'/'.$itensMedidas[$i]->getMedida();
    $opcoes .= '</option>';
  }

  $totalCategoria = CriadorFacade::getInstance()->listarTags();
  $categoria = '';
  for ($i = 0; $i < sizeof($totalCategoria); $i++) {
    $categoria .= '<option value="'.$totalCategoria[$i]->getIdTag().'">';
    $categoria .= $totalCategoria[$i]->getNome();
    $categoria .= '</option>';
  }
  ?>

</head>

<body>
  <?php include("cabecalhologado.php");?>

  <br><br><br>


  <div class="container">

    <?php include_once("painelCriador.php"); ?>
    <div class="col-md-9 panel panel-default">
      <div class="col-md-12">
        <h1 class="page-header">Criar Campanha</h1>
      </div>

      <div class="col-md-12">
        <div id="form">
          <!-- Formulário -->
          <form method="post" action="criarCampanhaP2.php">
            <!-- PERGUNTA 1 -->
            <div>
              <div class="row">
                <div class="col-md-12">
                  <h4><strong>1 - Categoria da Campanha</strong></h4>
                </div>
              </div>
              <!-- caixa de  texto -->
              <div>
                <!-- material -->
                <div class="form-group">
                  <select class="form-control" name="categoria" required>
                    <option value="None"> 1 - Selecione uma categoria</option>
                    <?php  echo $categoria;?>
                  </select>
                </div>
              </div>
            </div>
            <!-- PERGUNTA 2 -->
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <h4><strong>2 - Nome da Campanha</strong></h4>
                </div>
              </div>
              <!-- caixa de  texto -->
              <div class="row">
                <div class="col-md-12">
                  <input maxlength="30" class="form-control" name="nome" placeholder="Digite um nome para sua campanha" required>
                </div>
              </div>
            </div>
            <!-- PERGUNTA 3-->
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <h4><strong>3 - Descrição da Campanha </strong></h4>
                </div>
              </div>

              <!-- caixa de  texto -->
              <div class="row">
                <div class="col-md-12">
                  <textarea name="descricao" class="form-control" maxlength="100" rows="3"  placeholder="Descreva brevemente sobre o que se trata sua Campanha" required></textarea>
                  <p style="font-size: 1em; color: #696969;"><span>Sua descrição deve conter no máximo 100 caracteres</span></p>
                </div>
              </div>
            </div>
            <!-- PERGUNTA 4-->
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <h4><strong>4-Escolha um tipo de arrecadação</strong></h4>
                </div>
              </div>
              <!-- caixa de  texto -->
                <div class="row">
                  <div class="col-md-12">
                    <p style="font-size: 1em; color: #696969;"><span><strong>Campanha Monetária</strong> - Arrecadação financeira para uma campanha!<br>
                      <strong>Campanha Material</strong> - Arrecadação material para uma campanha!</span></p>
                  </div>
                    <div class="col-md-12">
                      <div class="radio">
                        <label class="radio-inline text-center"><input name="tipo" id="money" type="radio" onclick="mostrarOpcoes()">Monetária </label>
                      </div>
                      <div class="radio">
                        <label class="radio-inline text-center"><input name="tipo" id="mat" type="radio" onclick="mostrarOpcoes()">Material </label>
                      </div>
                    </div>
                  </div>
              </div>

              <!-- campanha monetaria// usuario vai colocar 3 valores padrões-->
              <div class="form-group" id="monetaria" style="display: none;">
                <!--cabeçalho -->
                <div class="row">
                  <div class="col-md-12">
                    <h4><strong>4.5 - Adicione 3 valores padrões para serem doados</strong></h4>
                  </div>
                </div>
                <!-- valores padrões de doação -->
                <div class="row">
                  <div class="col-md-12">

                  <!-- primeiro valor -->
                  <div class="row">
                    <div class="input-group" class="col-md-6 col-xs-12">
                      <span class="input-group-addon"><font color="FFFFFF">R$</font></span>
                      <input type="number" name="valor1" min="1" class="form-control" aria-label="Valor em reais a ser doado" placeholder="Primeiro valor em R$">
                      <span class="input-group-addon"><font color="FFFFFF">.00</font></span>
                    </div>
                  </div>
                  <!-- segundo valor -->
                  <div class="row">
                    <div class="input-group" class="col-md-6 col-xs-12">
                      <span class="input-group-addon"><font color="FFFFFF">R$</font></span>
                      <input type="number" name="valor2" min="1" class="form-control" aria-label="Valor em reais a ser doado" placeholder="Segundo valor em R$">
                      <span class="input-group-addon"><font color="FFFFFF">.00</font></span>
                    </div>
                  </div>
                  <!-- Terceiro valor -->
                  <div class="row">
                    <div class="input-group" class="col-md-6 col-xs-12">
                      <span class="input-group-addon"><font color="FFFFFF">R$</font></span>
                      <input type="number" name="valor3" min="1" class="form-control" aria-label="Valor em reais a ser doado" placeholder="Terceiro valor em R$">
                      <span class="input-group-addon"><font color="FFFFFF">.00</font></span>
                    </div>
                  </div>
                </div>
              </div>
              </div>

              <!--PERGUNTA 5 -->
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <h4><strong>5-Como você deseja encerrar sua campanha? </strong></h4>
                  </div>
                </div>
                <!-- caixa de  texto -->
                <div>
                  <div class="row">
                    <div class="col-md-12">
                      <p style="font-size: 1em; color: #696969;"><span><strong>Opção Data</strong> - Sua campanha se encerra apenas na data de término, independente de ter alcançado a meta ou não!<br>
                        <strong>Opção Meta</strong> - Sua campanha se encerra apenas quando a meta estipuladafor alcançada!</span></p>
                    </div>
                    <div class="col-md-12">
                      <div class="radio">
                        <label class="radio-inline text-center"><input name="tipoencerramento" type="radio" id="idMeta" onclick="mostrarOpcoes()">Meta </label>
                      </div>
                      <div class="radio">
                        <label class="radio-inline text-center"><input name="tipoencerramento" type="radio" id="idData" onclick="mostrarOpcoes()">Data </label>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>

                <input style="display: none;" id="materialMonetaria" name="mm" >
                <input style="display: none;" id="metaData" name="md">
                <script type="text/javascript">
                function mostrarOpcoes(){
                  if(document.getElementById('money').checked){
                    document.getElementById('materialMonetaria').value = "monetaria";
                    document.getElementById('monetaria').style.display = "block";
                    document.getElementById("adicionarAtendente").style.display = "none";
                    document.getElementById("adicionarPonto").style.display = "none";
                  }
                  else if(document.getElementById('mat').checked){
                    document.getElementById('monetaria').style.display = "none";
                    document.getElementById('materialMonetaria').value = "material";
                    document.getElementById("adicionarAtendente").style.display = "block";
                    document.getElementById("adicionarPonto").style.display = "block";

                  }
                  if(document.getElementById('money').checked && document.getElementById('idMeta').checked){
                    document.getElementById('metaData').value = "meta";
                    document.getElementById("metaMonetaria").style.display = "block";
                    document.getElementById("dataMonetaria").style.display = "none";
                    document.getElementById("ddataMaterial").style.display = "none";
                    document.getElementById("adicionarPonto").style.display = "none";
                    document.getElementById("adicionarAtendente").style.display = "none";
                    document.getElementById("metaMaterial").style.display = "none";
                    document.getElementById("dataMaterial").style.display = "none";
                  }
                  else if(document.getElementById('mat').checked && document.getElementById('idMeta').checked){
                    document.getElementById('metaData').value = "meta";
                    document.getElementById("metaMaterial").style.display = "block";
                    document.getElementById("adicionarAtendente").style.display = "block";
                    document.getElementById("adicionarPonto").style.display = "block";
                    document.getElementById("dataMaterial").style.display = "none";
                    document.getElementById("ddataMaterial").style.display = "none";
                    document.getElementById("metaMonetaria").style.display = "none";
                    document.getElementById("dataMonetaria").style.display = "none";

                  }
                  else if(document.getElementById('money').checked && document.getElementById('idData').checked){
                    document.getElementById("metaData").value = "data";
                    document.getElementById("dataMonetaria").style.display = "block";
                    document.getElementById("adicionarAtendente").style.display = "none";
                    document.getElementById("metaMonetaria").style.display = "none";
                    document.getElementById("adicionarPonto").style.display = "none";
                    document.getElementById("ddataMaterial").style.display = "none";
                    document.getElementById("metaMaterial").style.display = "none";
                    document.getElementById("dataMaterial").style.display = "none";
                  }
                  else if(document.getElementById('mat').checked && document.getElementById('idData').checked){
                    document.getElementById("metaData").value = "data";
                    document.getElementById("dataMaterial").style.display = "block";
                    document.getElementById("ddataMaterial").style.display = "block";
                    document.getElementById("adicionarAtendente").style.display = "block";
                    document.getElementById("adicionarPonto").style.display = "block";
                    document.getElementById("metaMaterial").style.display = "none";
                    document.getElementById("metaMonetaria").style.display = "none";
                    document.getElementById("dataMonetaria").style.display = "none";
                  }
                }

                </script>

                <!-- meta monetaria -->
                <div class="form-group" id="metaMonetaria" style="display: none;">
                  <!-- cabeçalho -->
                  <div id="metas">
                    <div class="row">
                      <div class="col-md-12">
                        <h4><strong>5.5 - Defina a meta a ser alcançada</strong></h4>
                      </div>
                    </div><!-- fim cabeçalho -->
                    <!-- corpo da meta -->
                      <div class="row">
                        <div class="input-group col-md-6">
                          <span class="input-group-addon"><font color="FFFFFF">R$</font></span>
                          <input type="number" name="metaMonetaria" min="1" class="form-control" aria-label="Meta em reais a ser alcançada" placeholder="Meta em reais a ser alcançada">
                          <span class="input-group-addon"><font color="FFFFFF">.00</font></span>
                        </div>
                      </div><!-- fim do corpo da meta -->
                  </div>
                </div><!-- FIM META MONETARIA -->

                <!-- data monetaria -->
                <div class="form-group" id="dataMonetaria" style="display: none;">
                  <!-- cabeçalho -->
                  <div class="row">
                    <div class="col-md-12">
                      <h4><strong>5.5 - Defina a data de término de sua campanha </strong></h4>
                    </div>
                  </div> <!-- fim do cabeçalho -->
                  <!-- corpo data -->

                    <!-- campos de data -->
                    <div class="row">
                      <div class="col-md-12">
                        <p><strong><span>Data de término: </span></strong><br><br></p>
                      </div>
                      <div class="row">
                        <div class="col-xs-4">
                          <label>Dia: </label> <input class="form-control" type="text" id="dia" name="diaF" placeholder="Exemplo: 12" maxlength="2" ><br><br>
                        </div>
                        <div class="col-xs-4">
                          <label>Mês: </label> <input class="form-control" type="text" id="mes" name="mesF" placeholder="Exemplo: 06" maxlength="2"><br><br>
                        </div>
                        <div class="col-xs-4">
                          <label>Ano: </label> <input class="form-control" type="text" id="ano" name="anoF" placeholder="Exemplo: 1900" maxlength="4"><br><br>
                        </div>
                      </div>
                    </div><!-- fim do campos de data -->
                </div><!-- FIM DATA MONETARIA -->


                <!-- data material -->
                <div class="form-group" id="ddataMaterial" style="display: none;">
                  <div class="row">
                    <div class="col-md-12">
                      <h4><strong>5.5 - Defina a data de término de sua campanha </strong></h4>
                    </div>
                  </div> <!-- fim do cabeçalho -->
                  <!-- corpo data -->

                    <!-- campos de data -->
                    <div class="row">
                      <div class="col-md-12">
                        <p><strong><span>Data de término: </span></strong><br><br></p>
                      </div>
                      <div class="row">
                        <div class="col-xs-4">
                          <label>Dia: </label> <input class="form-control" type="text" id="dia" name="diaF" placeholder="Exemplo: 12" maxlength="2" ><br><br>
                        </div>
                        <div class="col-xs-4">
                          <label>Mês: </label> <input class="form-control" type="text" id="mes" name="mesF" placeholder="Exemplo: 06" maxlength="2"><br><br>
                        </div>
                        <div class="col-xs-4">
                          <label>Ano: </label> <input class="form-control" type="text" id="ano" name="anoF" placeholder="Exemplo: 1900" maxlength="4"><br><br>
                        </div>
                      </div>
                    </div>
                </div><!-- FIM DATA MATERIAL -->

                <!-- meta material -->
                <div class="form-group" id="metaMaterial" style="display: none;">
                  <!-- cabeçalho -->
                  <div class="row">
                    <div class="col-md-12">
                      <h4><strong>5.5 - Escolha os itens e quantidade a serem arrecados</strong></h4>
                    </div>
                  </div><!-- fim cabeçalho -->
                  <!-- corpo da meta material -->
                  <div class="col-md-8" id="pai">
                    <div  id="filho">
                        <div class="row">
                          <!-- material -->
                          <div class="col-xs-6" id="selecionador">
                            <select class="form-control" id="itensMedidas" name="materialDoacao[]">
                              <option value="-1">- Selecione uma material para ser doado</option>
                              <?php echo $opcoes;?>
                            </select>
                          </div>
                          <!-- quantidade -->
                          <div class="col-xs-4" id="quantidade">
                            <input type="text" min="1" class="form-control" name="quantidadeMaterial[]]" placeholder="quantidade">
                          </div>
                          <div class="col-xs-1" id="botaopai">
                            <button type="button" class="btn btn-link" id="adicionarMaisMaterial" onclick="butaoMaisMaterial()"><i class="fa fa-plus"></i></button>
                          </div>
                        </div>    <!--fim da linha -->
                    </div>    <!-- FIM DE FILHO -->
                  </div>  <!-- FIM DE PAI -->

                  <div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <button class="btn btn-info" type="button" onclick="cadastrarMaterial()">Adicionar um material não cadastrado</button>
                        <br>
                      </div>
                      <div id="cadastro"></div>
                    </div>
                  </div>
                </div> <!-- fim meta material -->

                <!-- data material -->
                <div class="form-group" id="dataMaterial" style="display: none;">
                  <!-- cabeçalho -->
                  <div class="row">
                    <div class="col-md-12">
                      <h4><strong>5.5 - Escolha os itens a serem arrecados</strong></h4>
                    </div>
                  </div><!-- fim cabeçalho -->

                  <!-- corpo da meta material -->
                  <div id="pai1">
                    <div id="filho1">
                      <div>
                        <div class="row">
                          <!-- material -->
                          <div class="col-xs-6" id="selecionador">
                            <select class="form-control" id="itensMedidas" name="materialDoacao[]">
                              <option value="-1">- Selecione uma uma material para ser doado</option>
                              <?php echo $opcoes;?>
                            </select>
                          </div>
                          <div class="col-xs-2" style="float: right;" id="botaopai1">
                            <button type="button" class="btn btn-link" id="adicionarMaisMaterial" onclick="butaoMaisDataMaterial()"><i class="fa fa-plus"></i></button>
                          </div>
                        </div>    <!--fim da linha -->
                        <br>
                      </div>
                    </div>
                  </div>
                  <br><br><br>
                  <div id="dad">
                    <div id="son">
                        <div class="row">
                          <div class="col-md-6">
                            <button class="btn btn-info" type="button" onclick="cadastrarMaterialData()">Adicionar um material não cadastrado</button>
                          </div>
                            <br>
                          </div>
                          <div class="row">
                            <div class="col-xs-12" id="cadastroData">
                            </div>
                          </div>
                        </div>
                  </div>
                </div> <!-- fim data material -->


                <!-- PERGUNTA 6 -->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <h4><strong>6-Título do agradecimento</strong></h4>
                    </div>
                  </div>
                  <!-- caixa de  texto -->
                    <div class="row">
                      <div class="col-md-12">
                        <input maxlength="30" class="form-control" name="titulo" placeholder="Digite um titulo para seu agradecimento" required>
                        <p><span>Vamos começar com um título pro seu agradecimento (Utilize apenas 30 caracteres)</span></p>
                      </div>
                    </div>
                </div>


                <!-- PERGUNTA 6.5 -->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <h4><strong>6.5-Agora escreva sua mensagem</strong></h4>
                    </div>
                  </div>
                  <!-- caixa de  texto -->
                  <div class="row">
                    <div class="col-md-12">
                      <textarea name="agradecimento" class="form-control" placeholder="Escreva seu agradecimento aqui" maxlength="100" rows="3" required></textarea>
                      <p style="font-size: 1em; color: #696969;"><span>Seu agradecimento deve conter no máximo 100 caracteres</span></p>
                    </div>
                  </div>
                </div>

                <!-- PERGUNTA 7 -->
                <div class="form-group" id="adicionarAtendente" style="display: none;">

                  <div class="row">
                    <div class="col-md-12">
                      <h4><strong>7 - Adicione atendentes para sua campanha</strong></h4>
                    </div>
                    <div class="col-md-12">
                      <p><span>Atendentes são pessoas cadastradas no sistema que são indicadas, por você, para receber as doações materiais da sua campanha.</span></p>
                    </div>
                    <div class="col-md-12">
                      <p><span>Atendentes são disponíveis, apenas, em campanhas <strong>materiais</strong>.</span></p>
                    </div>
                  </div>
                  <!-- caixa de  texto -->
                  <div id="cadastramentoAtendente">
                    <div class="row" id="cadastroAtendente" >
                      <div class="col-xs-10 col-md-5">
                        <input maxlength="11" class="form-control" name="cpfAtendente" placeholder="Digite o CPF">
                      </div>
                      <div class="col-xs-1 col-md-1">
                        <button type="button" class="btn btn-link" id="removeatendente" onclick="removerAtendente(this)"><i class="fa fa-minus"></i></button>
                      </div>
                      <div class="col-xs-1 col-md-1">
                        <button type="button" class="btn btn-link" id="cadastreiatendente" onclick="addAtendente()"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
               <!-- PERGUNTA 8 -->
              <div class="form-group" id="adicionarPonto" style="display: none;">
                
                <div class="container">
                  <h2><strong>8-Informe o endereço do ponto de coleta</strong><font color="FF0000">*</font></h2>
                  <p><span>Pontos de coleta são endereços que irão aparecer no mapa da campanha</span></p>
                
                </div>
                <!-- caixa de  texto -->
                <div class="container" id="cadastramentoPonto">
                  <div class="row" id="cadastroPonto">
                    <div class="form-group">
                      <label>CEP: <font color="FF0000">*</font> </label>
                      <input id="cepcadastro" type="text" class="form-control" name="cep[]"  placeholder="Informe seu CEP"  style="width: 40%;">
                      <div id="cepcadastroerror"></div>
                    </div>
                    <div class="form-group">
                      <label>Estado: <font color="FF0000">*</font> </label>
                      <input id="estadocadastro" type="text" class="form-control" name="estado[]"  placeholder="Informe seu Estado"  style="width: 40%;">
                      <div id="estadocadastroerror"></div>
                    </div>
                    <div class="form-group">
                      <label>Bairro: <font color="FF0000">*</font> </label>
                      <input id="bairrocadastro" type="text" class="form-control" name="bairro[]" placeholder="Informe seu Bairro" style="width: 40%;">
                      <div id="bairrocadastroerror"></div>
                    </div>
                    <div class="form-group">
                      <label>Cidade: <font color="FF0000">*</font> </label>
                      <input id="cidadecadastro" type="text" class="form-control" name="cidade[]" placeholder="Informe sua Cidade" style="width: 40%;">
                      <div id="cidadecadastroerror"></div>
                    </div>
                    <div class="form-group">
                      <label>Logradouro: <font color="FF0000">*</font> </label>
                      <input id="logradourocadastro" type="text" class="form-control" name="logradouro[]"  placeholder="Informe sua Rua" style="width: 40%;">
                    <div id="logradourocadastroerror"></div>
                    </div>
                    <div class="form-group">
                      <label>Numero: <font color="FF0000">*</font> </label>
                      <input id="numerocadastro" type="number" class="form-control" name="numero[]" placeholder="Número de sua Casa" style="width: 40%;">
                    <div id="numerocadastroerror"></div>
                    </div>
                    <div class="form-group">
                      <label>Complemento: <font color="FF0000">*</font> </label>
                      <input id="complementocadastro" type="text" class="form-control" name="complemento[]" placeholder=" ex.: Casa/ Apt ..."  style="width: 40%;">
                    <div id="complementocadastroerror"></div>
                      </div>
                    </div>
                  </div>
                </div>


                <input style="display:none;" value='<?php echo $_SESSION['cpf']?>' name="cpf">

                <!-- botao para criar campanha -->
                <button class="btn btn-primary" type="submit" style="margin-bottom: 0.5em; padding-bottom: 0.5em;">Criar Campanha</button>
                <br><br>


              </form>
            </div>    <!-- div id form -->
          </div>  <!-- div class lg 12 -->
        </div>  <!-- div class lg 12 panel -->
      </div> <!-- div class container -->

      <div class="container">
        <?php include("footer.php");?>
      </div>



      <!-- armengues -->

      <div class="col-xs-10" id="cadastroEscondido" style="display: none;">
        <div class="container">
          <div class="row">
            <div class="col-xs-3">
              <label>Nome: <input type="text" name="nomeMaterial[]" placeholder="Nome"></label>
            </div>
            <div class="col-xs-3">
              <label>Medida: <input type="text" name="medidaMaterial[]" placeholder="Escala"></label>
            </div>
            <div class="col-xs-4">
              <label>Qtd: <input type="text" name="quantidadeMaterialCadastrado[]" placeholder="Quantidade"></label>
            </div>
            <div class="col-xs-1" style="float: left;">
              <button type="button" class="btn btn-link" id="removeCadastro" onclick="removerCadastro(this)"><i class="fa fa-minus"></i></button>
            </div>
          </div>
        </div>
      </div>

      <!-- armengue data material cadastro -->

      <div class="col-xs-10" id="cadastroEscondidoData" style="display: none;">
        <div class="container">
          <div class="row">
            <div class="col-xs-3">
              <label>Nome: <input type="text" name="nomeMaterial[]" placeholder="Nome"></label>
            </div>
            <div class="col-xs-3">
              <label>Medida: <input type="text" name="medidaMaterial[]" placeholder="Escala"></label>
            </div>
            <div class="col-xs-1" style="float: left;">
              <button type="button" class="btn btn-link" id="removeCadastroData" onclick="removerCadastroData(this)"><i class="fa fa-minus"></i></button>
            </div>
          </div>
        </div>
      </div>

    </body>
    </html>
