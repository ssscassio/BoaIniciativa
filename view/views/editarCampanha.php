<?php 
  include('cabecalhologado.php');
?>
  <script type="text/javascript" src="js/criarCampanha.js"></script>
  <?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/CriadorFacade.php");


  $id = $_POST['campanha'];

  $campanha = CriadorFacade::getInstance()->buscarCampanha($id);


  if( !(isset($_SESSION['cpf'])) && !(isset ($_SESSION['senha'])) ){
    header('location:login.php'); //caso não esteja, redireciona o usuário para a página de index
  }
  else if($_SESSION['cpf'] != $campanha->getCriadorCpf(){
    header('location:campanha.php?campanha=$id');
  }
  

  $itensMedidas = CriadorFacade::getInstance()->listarMateriais();
  $opcoes = "";
  for ($i = 0; $i < sizeof($itensMedidas); $i++) {
    $opcoes .= '<option value="'.$itensMedidas[$i]->getCodigo().'">';
    $opcoes .= $itensMedidas[$i]->getNome().'/'.$itensMedidas[$i]->getMedida();
    $opcoes .= '</option>';
  }

?>


</head>
  <body>

  <br><br><br>


    <div class="container">
      <div class="col-md-9 panel panel-default">
        <div class="row">
          <div class="col-md-9 text-center">
            <h1 class="page-header">Editar Campanha</h1>
          </div>
        </div> 
        <div class="container">
          <div class="col-md-9 text-center">
            <div id="form">
              <!-- Formulário -->

              <form id="formulario" method="post">
              <!-- Editar descrição -->
                <div class="form-group text-center">
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>Editar imagem: </strong>                    
                    </div>
                  </div>
                  <!-- caixa de  texto -->
                  <div class="container">
                    <div class="row">
                      <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                      <input name="campfile" type="file" /><br>  
                    </div>
                  </div>
                </div>     
                <br><br><br><br>

                <div class="form-group text-center">
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>Editar descrição: </strong>                    
                    </div>
                  </div>
                  <!-- caixa de  texto -->
                  <div class="container">
                    <div class="row">
                      <textarea name="descricao" maxlength="100" rows="3" cols="60" value="<?php echo $campanha->getDescricao();?>"></textarea>
                      <p style="font-size: 1em; color: #696969;"><span>Sua descrição deve conter no máximo 100 caracteres</span></p>
                    </div>
                  </div>
                </div>     
                <br><br><br><br>

              <?php 

                $codMaterial = CriadorFacade::getInstance()->buscarMetasCampanha();
                if ($codMaterial[0]->getCodMaterial() == 0 && !$campanha->getFinalizaPorData()) {
                  #monetaria por meta
                  $meta = $codMaterial[0]->getQuantidade();
              ?>  
              <!-- meta monetaria -->
              <div class="form-group text-center" id="metaMonetaria" style="display: none;">
                <!-- cabeçalho -->
                <div id="metas">
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>Editar a meta</strong>
                    </div>
                  </div> <!-- fim cabeçalho -->
                  <!-- corpo da meta -->
                  <div class="container">
                    <div class="row">
                      <div class="input-group" style="width: 40%; float: center;">
                        <span class="input-group-addon">R$</span>
                        <input type="number" name="metaMonetaria" min="1" class="form-control" aria-label="Meta em reais a ser alcançada" value="<?php echo $meta;?>">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>
                  </div><!-- fim do corpo da meta -->
                </div>
              </div>
              <br><br><br><br> <!-- FIM META MONETARIA -->
              <?php
                } #meta monetaria
                elseif ($codMaterial[0]->getCodMaterial() != 0 && !$campanha->getFinalizaPorData()) {
                  
              ?>
              <!-- meta material -->
              <div class="form-group text-center" id="metaMaterial" style="display: none;">
                <!-- cabeçalho -->
                  <div class="col-md-8 hard-form-label">
                    <div class="container">
                      <strong>Editar materiais e quantidade:</strong>
                    </div>
                  </div> <!-- fim cabeçalho -->
                  <?php
                  for ($i = 0; $i < count($codMaterial); $i++) { 
                    $material = CriadorFacade::getInstance()->buscarMaterial($codMaterial[$i]);
                  ?>
                  <!-- corpo da meta material -->
                  <div class="col-md-8" id="pai">              
                    <div class="container" id="filho">
                      <div>  
                        <div class="row"> 

                          <!-- material -->
                          <div style="float: left;" class="col-xs-3" id="selecionador">
                            <select id="itensMedidas" name="materialDoacao[]">
                              <option value="<?php echo $codMaterial[$i]->getCodMaterial()?>">- <?php echo $material->getNome()."/"$material->getMedida()?></option>
                              <?php echo $opcoes;?>          
                            </select>                    
                          </div>
                          <!-- quantidade -->
                          <div class="col-md-4" style="float: center;" id="quantidade">
                            <input type="number" min="1" size="60" name="quantidadeMaterial[]]" value="<?php echo $codMaterial[$i]->getQuantidade();?>">
                          </div>
                          <div class="col-md-1" style="float: left;">
                            <button type="button" class="btn btn-link" id="removeCadastroData" onclick="removeMaterial(this)"><i class="fa fa-minus"></i></button>
                          </div> 
                        </div>    <!--fim da linha -->
                        
                      <br><br>
                      </div>                  
                    </div>    <!-- FIM DE FILHO -->  
                  </div>  <!-- FIM DE PAI -->
                  <?php
                    }#fim do for  
                  ?>
                  <div class="col-md-8" id="dad">
                    <div class="container" id="son">
                      <div>
                        <div class="row">
                          <div class="col-md-4" style="float: left;" id="botaopai">
                            <button type="button" class="btn btn-link" id="adicionarMaisMaterial" onclick="butaoMaisMaterial()">Adicionar um material <strong>cadastrado</strong></button>
                          </div>
                          <div class="col-md-4" style="float: left;">
                            <button class="btn btn-info" type="button" onclick="cadastrarMaterial()">Adicionar um material <strong>não</strong> cadastrado</button>
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
               <?php
                }#fim material meta
                elseif ($codMaterial[0]->getCodMaterial() != 0 && $campanha->getFinalizaPorData()) {
                  # code...
                }
               ?>

              <!-- data material -->
              <div class="form-group text-center" id="dataMaterial" style="display: none;">
                <!-- cabeçalho -->
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>Editar materiais</strong>
                  </div>
                </div> <!-- fim cabeçalho -->

                <?php 
                for ($i = 0; $i < count($codMaterial); $i++) { 
                  $material = CriadorFacade::getInstance()->buscarMaterial($codMaterial[$i]);
                ?>
                <!-- corpo da meta material -->
                <div class="col-md-8" id="pai1">              
                  <div class="container" id="filho1">
                    <div>  
                      <div class="row"> 

                        <!-- material -->
                        <div style="float: left;" class="col-md-4" id="selecionador">
                          <select id="itensMedidas" name="materialDoacao[]">
                            <option value="<?php echo $codMaterial[$i]->getCodMaterial()?>">- <?php echo $material->getNome()."/"$material->getMedida()?></option>
                            <?php echo $opcoes;?>          
                          </select>                    
                        </div>
                        <div class="col-md-1" style="float: left;">
                          <button type="button" class="btn btn-link" id="removeCadastroData" onclick="removeMaterial1(this)"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>    <!--fim da linha -->                      
                    <br><br>
                    </div>                  
                  </div>                  
                </div>
                <?php 
                  }#fim do for
                ?>
                <div class="col-md-8" id="dad">
                  <div class="container" id="son">
                    <div>
                      <div class="row">
                        <div class="col-md-2" style="float: left;" id="botaopai1">
                          <button type="button" class="btn btn-link" id="adicionarMaisMaterial" onclick="butaoMaisDataMaterial()">Adicionar um material <strong>cadastrado</strong></button>
                        </div>
                        <div class="col-md-2" style="float: left;">                      
                          <button class="btn btn-info" type="button" onclick="cadastrarMaterialData()">Adicionar um material <strong>não</strong> cadastrado</button>
                          <br><br>
                        </div>  
                        <div id="cadastroData">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- fim data material -->
              <br><br><br><br>  
              <?php 
                }#fim data material
              ?>

              
              <!-- PERGUNTA 6 -->
              <div class="text-center">
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>Editar título do seu agradecimento</strong>                    
                  </div>
                </div>
                <!-- caixa de  texto -->
                <div class="container">
                    <div class="row">
                      <input maxlength="30" size="60" name="titulo" value="<?php $campanha->getTituloAgradecimento();?>" required>
                      <p><span>Vamos começar com um título pro seu agradecimento (Utilize apenas 30 caracteres)</span></p>
                    </div>
                  </div>
              </div>
              <br><br><br><br>


              <!-- PERGUNTA 6.5 -->
              <div class="text-center">
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>Editar agradecimento</strong>                    
                  </div>
                </div>
                <!-- caixa de  texto -->
                <div class="container">
                  <div class="row">
                    <textarea name="agradecimento" value="<?php echo $campanha->getAgradecimento();?>" maxlength="100" rows="3" cols="60" required></textarea>
                    <p style="font-size: 1em; color: #696969;"><span>Seu agradecimento deve conter no máximo 100 caracteres</span></p>
                  </div>
                </div>
              </div>
              <br><br><br><br>



              <script type="text/javascript">
                function atualizaCancela(v){
                  if (v == 1){
                    document.getElementById('formulario').action = "atualizarCampanha.php";                  
                  }
                  else if(v == 2){
                    document.getElementById('formulario').action = "campanha.php";
                  }
                }
              </script>

              <?php
                $listaAtendentes = CriadorFacade::getInstance()->listarAtendentesCampanha($id);
                $listaNomesAtendentes = array();
                for ($i = 0; $i < count($listaAtendentes); $i++) { 
                  $listaNomesAtendentes = CriadorFacade::getInstance()->buscarUsuario($listaAtendentes[$i]);
                }
                
              ?>


              <!-- Adicionar/Remover Atendentes-->
              <div class="text-center" >
                <div class="col-md-8 hard-form-label">
                  <div class="container">
                    <strong>Adicionar/Remover atendentes </strong>                    
                  </div>
                </div>
                <!-- caixa de  texto -->
                <?php
                  for ($i = 0; $i < count($listaAtendentes); $i++) { 
                   
                ?>
                <div class="container" id="cadastramentoAtendente">
                  <div class="row" id="cadastroAtendente">
                    <div class="col-md-4">
                      <input maxlength="11" size="60" name="cpfAtendente[]" value="<?php echo $listaAtendentes[$i].'-'.$listaNomesAtendentes[$i]?>" required>
                        <p><span>Os atendentes são pessoas cadastradas no sistema que podem se disponibilizar para receber os materiais para sua campanha. Atendentes são apenas possíveis em campanhas <strong>materiais</strong></span></p>
                    </div>
                    <div class="col-md-2">
                      <div class="col-md-1" style="float: left;">
                        <button type="button" class="btn btn-link" id="removerAtendente" onclick="removerAtendente(this)"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                  </div>
                  <?php
                }#fim do for
                ?>
                <div class="col-md-4" style="float: left;">
                  <button type="button" class="btn btn-link" id="adicionarAtendente" onclick="adicionarAtendente()">Adicionar atendente</button>
                </div>
                </div>
              </div>
              <br><br><br><br>

                      <div class="col-md-1" style="float: left;">
                        <button type="button" class="btn btn-link" id="adicionarAtendente" onclick="adicionarAtendente()"><i class="fa fa-plus"></i></button>
                      </div>    
              <!-- botao para atualizar campanha -->
              <button onclick="atualizaCancela(1)" class="btn btn-success" type="submit" style="margin-bottom: 0.5em; padding-bottom: 0.5em;">Atualizar campanha</button>
              <button onclick="atualizaCancela(2)" class="btn btn-success" type="submit" style="margin-bottom: 0.5em; padding-bottom: 0.5em;">Cancelar</button>
              <br><br>


            </form>
          </div>    <!-- div id form -->
        </div>  <!-- div class lg 12 -->
      </div> <!-- div class container -->
    </div>  <!-- div class lg 12 panel -->
  </div> <!-- div class container -->

  <?php include("footer.php");?>


<!-- armengues -->

                    <div class="col-md-10" id="cadastroEscondido" style="display: none;">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-3">
                            <label>Nome: <input type="text" name="nomeMaterial[]" placeholder="Nome"></label>                          
                          </div>
                          <div class="col-md-3">
                            <label>Medida: <input type="text" name="medidaMaterial[]" placeholder="Escala"></label>
                          </div>
                          <div class="col-md-4">
                            <label>Quantidade: <input type="text" name="quantidadeMaterialCadastrado[]" placeholder="Quantidade"></label>
                          </div>
                          <div class="col-md-1" style="float: left;">
                            <button type="button" class="btn btn-link" id="removeCadastro" onclick="removerCadastro(this)"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>

<!-- armengue data material cadastro -->

                    <div class="col-md-8" id="cadastroEscondidoData" style="display: none;">
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
