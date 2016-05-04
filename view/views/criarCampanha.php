<?php 
  include('cabecalhologado.php');
?>
  <script type="text/javascript" src="js/criarCampanha.js"></script>
  <?php

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
  <?php include("cabecalhoLogado.php");?>

  <br><br><br>


    <div class="container">
      <div class="col-md-9 panel panel-default">
        <div class="row">
          <div class="col-md-9 text-center">
            <h1 class="page-header">Criar Campanha</h1>
          </div>
        </div> 
        <div class="container">
          <div class="col-md-9 text-center">
            <div id="form">
              <!-- Formulário -->

              <form method="post" action="CriarCampanhaP2.php">
              <!-- PERGUNTA 1 -->
              <div class="text-center">
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>1 - Seleciona uma categoria para sua campanha</strong>                    
                  </div>
                </div>
                <!-- caixa de  texto -->
                <div class="container">
                  <div>
                    <!-- material -->
                    <div>
                      <select name="categoria" required>
                        <option value="None">- Selecione uma categoria</option>
                        <?php  echo $categoria;?>          
                      </select>                    
                    </div>
                  </div>
                </div>
              </div>
              <br><br><br><br>
              <!-- PERGUNTA 2 -->
                <div class="form-group text-center">
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>2- Qual o nome para sua campanha?</strong>                    
                    </div>
                  </div>
                  <!-- caixa de  texto -->
                  <div class="container">
                    <div class="row">
                      <input maxlength="30" size="60" name="nome" placeholder="Digite um nome para sua campanha" required>
                    </div>
                  </div>
                </div>
                <br><br><br><br>
                <!-- PERGUNTA 3-->
                <div class="form-group text-center">
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>3- Fale um pouco da sua campanha pra nós :)</strong>                    
                    </div>
                  </div>
                  <!-- caixa de  texto -->
                  <div class="container">
                    <div class="row">
                      <textarea name="descricao" maxlength="100" rows="3" cols="60" required></textarea>
                      <p style="font-size: 1em; color: #696969;"><span>Sua descrição deve conter no máximo 100 caracteres</span></p>
                    </div>
                  </div>
                </div>     
                <br><br><br><br>
                          <!-- PERGUNTA 4-->
                   <br><br><br><br><br>  
                <div class="form-group text-center">
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>4 - Qual tipo de arrecadação você quer para sua campanha? :)</strong>                    
                    </div>
                  </div>
                  <br><br><br><br>
                  <!-- caixa de  texto -->
                  <div class="container">
                    <div class="row">
                      <p style="font-size: 1em; color: #696969;"><span><strong>Campanha Monetária</strong> - Arrecadação financeira para uma campanha!<br>
                      <strong>Campanha Material</strong> - Arrecadação material para uma campanha!</span></p>
                    </div>
                    <div class="row">
                      <label class="radio-inline text-center"><input id="money" type="radio" name="materialMonetaria" value="monetaria" onclick="mostrarOpcoes()">Monetária </label>                
                      <label class="radio-inline text-center"><input id="mat" type="radio" name="materialMonetaria" value="material"  onclick="mostrarOpcoes()">Material </label>                    
                    </div>
                  </div>
                </div>
                <br><br><br><br><br>
                <!-- campanha monetaria// usuario vai colocar 3 valores padrões-->
                <div class="form-group text-center" id="monetaria" style="display: none;">
                  <div class="col-md-8 hard-form-label">
                    <!--cabeçalho -->
                    <div class="container">
                      <strong>4.5 - Adicione 3 valores padrões para serem doados</strong>                    
                    </div>
                  </div>
                  <br><br><br><br>
                  <!-- valores padrões de doação -->
                  <div class="container" style="float: center;">
                  <!-- primeiro valor -->
                    <div class="row">                  
                      <div class="input-group" style="width: 40%;">
                        <span class="input-group-addon">R$</span>
                        <input type="number" name="valor1" min="1" class="form-control" aria-label="Valor em reais a ser doado" placeholder="Primeiro valor em R$">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>
                  <!-- segundo valor -->
                    <div class="row">                  
                      <div class="input-group" style="width: 40%;">
                        <span class="input-group-addon">R$</span>
                        <input type="number" name="valor2" min="1" class="form-control" aria-label="Valor em reais a ser doado" placeholder="Segundo valor em R$">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>
                  <!-- Terceiro valor -->
                    <div class="row">                  
                      <div class="input-group" style="width: 40%;">
                        <span class="input-group-addon">R$</span>
                        <input type="number" name="valor3" min="1" class="form-control" aria-label="Valor em reais a ser doado" placeholder="Terceiro valor em R$">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br><br><br><br>


                <!--PERGUNTA 5 -->
               <div class="form-group text-center">
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>5 - Como você deseja encerrar sua campanha? :)</strong>                    
                  </div>
                </div>
                <br><br><br><br>
                <!-- caixa de  texto -->
                <div class="container">
                  <div class="row">
                    <p style="font-size: 1em; color: #696969;"><span><strong>Opção Data</strong> - Sua campanha se encerra apenas na data de término, independente de ter alcançado a meta ou não!<br>
                    <strong>Opção Meta</strong> - Sua campanha se encerra apenas quando a meta estipuladafor alcançada!</span></p>
                    <label class="radio-inline text-center"><input type="radio" id="idMeta" name="metaData" value="meta" onclick="mostrarOpcoes()" required>Meta </label>                
                    <label class="radio-inline text-center"><input type="radio" id="idData" name="metaData" value="data" onclick="mostrarOpcoes()">Data </label>
                  </div>
                </div>
              </div>   
              <br><br><br><br><br>
<script type="text/javascript">
    function mostrarOpcoes(){
      if(document.getElementById('money').checked){
        document.getElementById('monetaria').style.display = "block";
        document.getElementById("cadastramentoAtendente").style.display = "none";
      }
      else if(document.getElementById('mat').checked){
        document.getElementById('monetaria').style.display = "none";
        document.getElementById("cadastramentoAtendente").style.display = "block";

      }
      if(document.getElementById('money').checked && document.getElementById('idMeta').checked){
        document.getElementById("metaMonetaria").style.display = "block";
        document.getElementById("dataMonetaria").style.display = "none";
        document.getElementById("ddataMaterial").style.display = "none";
        document.getElementById("cadastramentoAtendente").style.display = "none";
        document.getElementById("metaMaterial").style.display = "none"; 
        document.getElementById("dataMaterial").style.display = "none"; 
      }
      else if(document.getElementById('mat').checked && document.getElementById('idMeta').checked){
        document.getElementById("metaMaterial").style.display = "block"; 
        document.getElementById("cadastramentoAtendente").style.display = "block";
        document.getElementById("dataMaterial").style.display = "none";
        document.getElementById("ddataMaterial").style.display = "none";
        document.getElementById("metaMonetaria").style.display = "none";
        document.getElementById("dataMonetaria").style.display = "none";
      }         
      else if(document.getElementById('money').checked && document.getElementById('idData').checked){
        document.getElementById("dataMonetaria").style.display = "block";
        document.getElementById("cadastramentoAtendente").style.display = "none";
        document.getElementById("metaMonetaria").style.display = "none";
        document.getElementById("ddataMaterial").style.display = "none";
        document.getElementById("metaMaterial").style.display = "none"; 
        document.getElementById("dataMaterial").style.display = "none";
      }
      else if(document.getElementById('mat').checked && document.getElementById('idData').checked){
        document.getElementById("dataMaterial").style.display = "block"; 
        document.getElementById("ddataMaterial").style.display = "block";
        document.getElementById("cadastramentoAtendente").style.display = "block";
        document.getElementById("metaMaterial").style.display = "none";  
        document.getElementById("metaMonetaria").style.display = "none";
        document.getElementById("dataMonetaria").style.display = "none";
      } 
    }

</script>

              <!-- meta monetaria -->
              <div class="form-group text-center" id="metaMonetaria" style="display: none;">
                <!-- cabeçalho -->
                <div id="metas">
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>5.5 - Defina a meta a ser alcançada</strong>
                    </div>
                  </div> <!-- fim cabeçalho -->
                  <!-- corpo da meta -->
                  <div class="container">
                    <div class="row">
                      <div class="input-group" style="width: 40%; float: center;">
                        <span class="input-group-addon">R$</span>
                        <input type="number" name="metaMonetaria" min="1" class="form-control" aria-label="Meta em reais a ser alcançada" placeholder="Meta em reais a ser alcançada">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>
                  </div><!-- fim do corpo da meta -->
                </div>
              </div>
              <br><br><br><br> <!-- FIM META MONETARIA -->

               <!-- data monetaria -->
              <div class="form-group text-center" id="dataMonetaria" style="display: none;">
                <!-- cabeçalho -->
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>5.5 - Defina a data de término de sua campanha </strong>
                    </div>
                  </div> <!-- fim do cabeçalho -->
                  <br><br><br><br>
                  <!-- corpo data -->
                  <div class="container">
                    <!-- campos de data -->
                    <div class="row">
                        <p><strong><span>Data de término: </span></strong><br><br></p>
                        <label>Dia (Exemplo: <?php echo date("d")?>) : </label> <input type="text" id="dia" name="diaF" placeholder="Exemplo: 12" maxlength="2" ><br><br>
                        <label>Mês (Exemplo: <?php echo date("m")?>) : </label> <input type="text" id="mes" name="mesF" placeholder="Exemplo: 06" maxlength="2"><br><br>
                        <label>Ano (Exemplo: <?php echo date("Y")?>)  : </label> <input type="text" id="ano" name="anoF" placeholder="Exemplo: 1900" maxlength="4"><br><br>
               
                    </div><!-- fim do campos de data -->
                  </div> <!-- fim corpo data -->
              </div>
              <br><br><br> <!-- FIM DATA MONETARIA -->


              <!-- data material -->
              <div class="form-group text-center" id="ddataMaterial" style="display: none;">
                <!-- cabeçalho -->
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>5.5 - Defina a data de término de sua campanha </strong>
                    </div>
                  </div> <!-- fim do cabeçalho -->
                  <br><br><br><br>
                  <!-- corpo data -->
                  <div class="container">
                    <!-- campos de data -->
                    <div class="row">
                        <p><strong><span>Data de término: </span></strong><br><br></p>
                        <label>Dia (Exemplo: <?php echo date("d")?>) : </label> <input type="text" id="dia" name="diaF" placeholder="Exemplo: 12" maxlength="2" ><br><br>
                        <label>Mês (Exemplo: <?php echo date("m")?>) : </label> <input type="text" id="mes" name="mesF" placeholder="Exemplo: 06" maxlength="2"><br><br>
                        <label>Ano (Exemplo: <?php echo date("Y")?>)  : </label> <input type="text" id="ano" name="anoF" placeholder="Exemplo: 1900" maxlength="4"><br><br>
               
                    </div><!-- fim do campos de data -->
                  </div> <!-- fim corpo data -->
              </div>
              <br><br><br> <!-- FIM DATA MATERIAL -->

              <!-- meta material -->
              <div class="form-group text-center" id="metaMaterial" style="display: none;">
                <!-- cabeçalho -->
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>5.5 - Escolha os itens e quantidade a serem arrecados</strong>
                    </div>
                  </div> <!-- fim cabeçalho -->
                  <!-- corpo da meta material -->
                  <div class="col-md-8" id="pai">              
                    <div class="container" id="filho">
                      <div>  
                        <div class="row"> 

                          <!-- material -->
                          <div style="float: left;" class="col-md-3" id="selecionador">
                            <select id="itensMedidas" name="materialDoacao[]">
                              <option value="None">- Selecione uma material para ser doado</option>
                              <?php echo $opcoes;?>          
                            </select>                    
                          </div>
                          <!-- quantidade -->
                          <div class="col-md-4" style="float: center;" id="quantidade">
                            <input type="number" min="1" size="60" name="quantidadeMaterial[]]" placeholder="quantidade">
                          </div>                   
                          <div class="col-md-2" style="float: left;" id="botaopai">
                            <button type="button" class="btn btn-link" id="adicionarMaisMaterial" onclick="butaoMaisMaterial()"><i class="fa fa-plus"></i></button>
                            
                          </div>
                        </div>    <!--fim da linha -->
                        
                      <br><br>
                      </div>                  
                    </div>    <!-- FIM DE FILHO -->  
                  </div>  <!-- FIM DE PAI -->
                  <div class="col-md-8" id="dad">
                    <div class="container" id="son">
                      <div>
                        <div class="row">
                          <div>                      
                            <button class="btn btn-info" type="button" onclick="cadastrarMaterial()">Adicionar um material não cadastrado</button>
                            <br><br>
                          </div>  
                          <div id="cadastro">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div> <!-- fim meta material -->
               <br><br><br> <!-- FIM META MONETARIA -->

              <!-- data material -->
              <div class="form-group text-center" id="dataMaterial" style="display: none;">
                <!-- cabeçalho -->
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>5.5 - Escolha os itens a serem arrecados</strong>
                  </div>
                </div> <!-- fim cabeçalho -->
                <!-- corpo da meta material -->
                <div class="col-md-8" id="pai1">              
                  <div class="container" id="filho1">
                    <div>  
                      <div class="row"> 

                        <!-- material -->
                        <div style="float: left;" class="col-md-3" id="selecionador">
                          <select id="itensMedidas" name="materialDoacao[]">
                            <option value="None">- Selecione uma uma material para ser doado</option>
                            <?php echo $opcoes;?>          
                          </select>                    
                        </div>                 
                        <div class="col-md-2" style="float: left;" id="botaopai1">
                          <button type="button" class="btn btn-link" id="adicionarMaisMaterial" onclick="butaoMaisDataMaterial()"><i class="fa fa-plus"></i></button>
                        </div>
                      </div>    <!--fim da linha -->                      
                    <br><br>
                    </div>                  
                  </div>                  
                </div>
                <div class="col-md-8" id="dad">
                  <div class="container" id="son">
                    <div>
                      <div class="row">
                        <div>                      
                          <button class="btn btn-info" type="button" onclick="cadastrarMaterialData()">Adicionar um material não cadastrado</button>
                          <br><br>
                        </div>  
                        <div id="cadastroData">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- fim meta material -->
              <br><br><br><br>  


              
              <!-- PERGUNTA 6 -->
              <div class="text-center">
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>6 - Vamos agradecer aos seus doadores</strong>                    
                  </div>
                </div>
                <!-- caixa de  texto -->
                <div class="container">
                    <div class="row">
                      <input maxlength="30" size="60" name="titulo" placeholder="Digite um titulo para seu agradecimento" required>
                      <p><span>Vamos começar com um título pro seu agradecimento (Utilize apenas 30 caracteres)</span></p>
                    </div>
                  </div>
              </div>
              <br><br><br><br>


              <!-- PERGUNTA 6.5 -->
              <div class="text-center">
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>6.5 - Agora escreva sua mensagem</strong>                    
                  </div>
                </div>
                <!-- caixa de  texto -->
                <div class="container">
                  <div class="row">
                    <textarea name="agradecimento" placeholder="Escreva seu agradecimento aqui" maxlength="100" rows="3" cols="60" required></textarea>
                    <p style="font-size: 1em; color: #696969;"><span>Seu agradecimento deve conter no máximo 100 caracteres</span></p>
                  </div>
                </div>
              </div>
              <br><br><br><br>

              <!-- PERGUNTA 7 -->
              <div class="text-center" >
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>7 - Adicione atendentes para sua campanha</strong>                    
                  </div>
                </div>
                <!-- caixa de  texto -->
                <div class="container" id="cadastramentoAtendente" style="display: none;">
                  <div class="row" id="cadastroAtendente">
                    <div class="col-md-4">
                      <input maxlength="11" size="60" name="cpfAtendente" placeholder="Digite o CPF do atendente" required>
                        <p><span>Os atendentes são pessoas cadastradas no sistema que podem se disponibilizar para receber os materiais para sua campanha. Atendentes são apenas possíveis em campanhas <strong>materiais</strong></span></p>
                    </div>
                    <div class="col-md-2">
                      <div class="col-md-1" style="float: left;">
                        <button type="button" class="btn btn-link" id="removerAtendente" onclick="removerAtendente(this)"><i class="fa fa-minus"></i></button>
                      </div>
                      <div class="col-md-1" style="float: left;">
                        <button type="button" class="btn btn-link" id="adicionarAtendente" onclick="adicionarAtendente()"><i class="fa fa-minus"></i></button>
                      </div>    
                    </div>
                  </div>
                </div>
              </div>
              <br><br><br><br>






              <!-- botao para criar campanha -->
              <button class="btn btn-success" type="submit" style="margin-bottom: 0.5em; padding-bottom: 0.5em;">Criar Campanha</button>
              <br><br>


            </form>
          </div>    <!-- div id form -->
        </div>  <!-- div class lg 12 -->
      </div> <!-- div class container -->
    </div>  <!-- div class lg 12 panel -->
  </div> <!-- div class container -->

  <?php include("footer.php");?>


<!-- armengues -->

                    <div class="col-md-8" id="cadastroEscondido" style="display: none;">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-2">
                            <label>Nome: <input type="text" name="nomeMaterial[]" placeholder="Nome"></label>                          
                          </div>
                          <div class="col-md-3">
                            <label>Medida: <input type="text" name="medidaMaterial[]" placeholder="Escala"></label>
                          </div>
                          <div class="col-md-2">
                            <label>Qtd: <input type="text" name="quantidadeMaterialCadastrado[]" placeholder="Quantidade"></label>
                          </div>
                          <div class="col-md-1" style="float: left;">
                            <button type="button" class="btn btn-link" id="removeCadastro" onclick="removerCadastro(this)"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>

<!-- armengue data material cadastro -->

                    <div class="col-md-10" id="cadastroEscondidoData" style="display: none;">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-3">
                            <label>Nome: <input type="text" name="nomeMaterial[]" placeholder="Nome"></label>                          
                          </div>
                          <div class="col-md-3">
                            <label>Medida: <input type="text" name="medidaMaterial[]" placeholder="Escala"></label>
                          </div>
                          <div class="col-md-1" style="float: left;">
                            <button type="button" class="btn btn-link" id="removeCadastroData" onclick="removerCadastroData(this)"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>

 </body>
</html>
