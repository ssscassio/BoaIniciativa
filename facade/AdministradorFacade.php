<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/AdministradorController.php");

  class AdministradorFacade{

    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new AdministradorFacade();
      return self::$instance;
    }

  public function autenticarAdm($cpfAdm, $senhaAdm){
      return   AdministradorController::getInstance()->autenticarAdm($cpfAdm,$senhaAdm);

  }

  public function cadastrarNovoAdministrador($nome,$cpf,$email,$senha,$nascimento,$sexo){
    return  AdministradorController::getInstance()->cadastrarAdministrador($nome,$cpf,$email,$senha,$nascimento,$sexo);
  }

  public function listarDenuncias($tipo,$id){

      $denuncias =  AdministradorController::getInstance()->listarDenuncias($tipo,$id);

      switch ($tipo) {
        case 0:
        echo '<h2 class="page-header">Listando Todas Denuncias</h2>';
        break;
        case 1:
        echo '<h2 class="page-header">Listando Denuncias da campanha de id: #: '.$id.'</h2>';
        break;
        case 2:
        echo '<h2 class="page-header">Listando Denuncias feitas pelo usuário de Cpf: '.$id.'</h2>';
        case 3:
        echo '<h2 class="page-header">Listando Denuncias sofridas nas campanhas do usuário de Cpf: '.$id.'</h2>';
        break;
      }

      if(sizeof($denuncias)==0){
        echo '<div class="alert alert-danger row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Desculpe!</strong> Não conseguimos encontrar o que você está procurando.
          </div>';
      }
    echo '<div class="list-group">';

    for ($i=sizeof($denuncias)-1; $i >= 0 ; $i--) {
      echo '
      <div class="row list-group-item">

        <div class="col-xs-6 col-md-2">
          <label class=""> Motivo:</label><br>
          '.$denuncias[$i]->getMotivo().'
        </div>
        <div class="col-xs-6 col-md-4">
          <label class=""> Descrição:</label><br>'.$denuncias[$i]->getDescricao().'</div>
        <div class="col-xs-12 col-md-6">
          <div class="row panel panel-primary">
            <label class="col-xs-6"> Criador: '.CampanhaDAO::getInstance()->buscarCampanha($denuncias[$i]->getIdCampanha())->getCriadorCpf().'</label>
            <a href="usuario.php?cpf='.CampanhaDAO::getInstance()->buscarCampanha($denuncias[$i]->getIdCampanha())->getCriadorCpf().'" class=" col-xs-6 btn btn-primary">Ver Usuario</a>
          </div>
          <div class="row panel panel-primary">
            <label class="col-xs-6"> Id da campanha: '.$denuncias[$i]->getIdCampanha().'</label>
            <a href="campanha.php?id='.$denuncias[$i]->getIdCampanha().'" class=" col-xs-6 btn btn-primary">Ver Campanha</a>
          </div>
          <div class="row panel panel-primary">
            <label class="col-xs-6"> Denunciante: '.$denuncias[$i]->getCpfUsuario().'</label>
            <a href="usuario.php?cpf='.$denuncias[$i]->getCpfUsuario().'" class=" col-xs-6 btn btn-primary">Ver Usuario</a>
          </div>
        </div>
      </div>
      ';
    }
    echo "</div>";

  }

  public function verCampanha($idCampanha){

    $campanha = CampanhaDAO::getInstance()->buscarCampanha($idCampanha);
    $numDenuncias =  AdministradorController::getInstance()->numDenunciasCampanha($idCampanha);
if($campanha->getIdCampanha() != null){
echo ' <h2 class="page-header">'.$campanha->getNome().' <span class="label ';
if($campanha->getStatus()){
  echo 'label-info">Ativa';
}else{
    echo 'label-danger">Finalizada';
}
  echo '</span></h2>';

echo '<div class="row">';
if($numDenuncias == 0){
  echo '<div class="alert alert-success alert-dismissible" style="margin: 0px 10px 0px 10px;" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Campanha sem Denuncias</div>';
}else if($numDenuncias <10){
  echo '<div class="alert alert-warning alert-dismissible" style="margin: 0px 10px 0px 10px;" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Campanha com menos de 10 Denuncias</div>';
}else{
  echo '<div class="alert alert-danger alert-dismissible" style="margin: 0px 10px 0px 10px;" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Campanha com mais de 10 Denuncias</div>';
}
echo '</div>';

echo '<div class="row">
        <div class="col-xs-6">
          <h3>Data de inicio: '.date("d/m/Y", strtotime($campanha->getDataInicio())).'</h3>
        </div>';
if($campanha->getDataFim() != null){
  echo '
      <div class="col-xs-6">
        <h3>Data de Fim: '.date("d/m/Y", strtotime($campanha->getDataFim())).'</h3>
      </div>';
}
echo '</div>';


echo'<div class="row">
      <img src="';
      if($campanha->getImagem()=="default" || $campanha->getImagem()==""){
        echo 'img/logobi.png';
      }else{
        echo $campanha->getImagem();
      }
      echo'" class="img-rounded img-responsive center-block" alt="" />
    </div>
    <div class="row">
        <div class="container-fluid panel panel-success col-md-6" style=" padding:20px;">
          <h2 class="page-header">Descrição</h2>'.$campanha->getDescricao().'
        </div>

        <div class="container-fluid panel panel-success col-md-6" style="padding:20px;">
          <h2 class="page-header">'.$campanha->getTituloAgradecimento().'</h2>
              '.$campanha->getAgradecimento().'
        </div>
    </div>
    <div class="panel" style="padding:0px 10px 70px 10px;">
    <a href="listardenuncias.php?idCampanha='.$campanha->getIdCampanha().'" class="btn btn-primary col-xs-6 col-md-3 ';
    if($numDenuncias ==0){ echo "disable";}
    echo'">Ver Denuncias <span class="badge">'.$numDenuncias.'</span></a>
    <a href="usuario.php?cpf='.$campanha->getCriadorCpf().'" class="btn btn-primary col-xs-6 col-md-3">Ver Criador</a>
    <a href="#" class="btn btn-primary disabled col-xs-6 col-md-3">Ver Doações</a>
    <div class="col-md-3 col-xs-6">
      <form method="post" action="rotas.php">';
      echo ' <input type="hidden" name="idCampanha" value="'.$campanha->getIdCampanha().'" />';
      echo '<input type="submit" class="btn btn-danger btn-block ';
      if($campanha->getStatus()== false){
        echo 'disabled';
      }
      echo'"  name="botaoEncerrarCampanha" value=" Encerrar Campanha">';

      echo'</form>
    </div>
    </div>
';
}else{
  echo '<div class="alert alert-danger row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Desculpe!</strong> Não conseguimos encontrar o que você está procurando.
    </div>';
}
  }

  public function listarCampanhas($tipo, $id){

  $campanhas =  AdministradorController::getInstance()->listarCampanhas($tipo,$id);


  if(sizeof($campanhas) == 0){
    echo '<div class="alert alert-danger row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Desculpe!</strong> Não conseguimos encontrar o que você está procurando.
      </div>';
  return;
  }else{

    switch ($tipo) {
      case 0:
      echo '<h2 class="page-header">Listando Todas Campanhas</h2>';
      break;
      case 1:
      echo '<h2 class="page-header">Listando campanhas do Usuario de CPF: '.$id.'</h2>';
      break;
      case 2:
      if($id=='finalizadas'){
      echo '<h2 class="page-header">Listando campanhas Finalizadas</h2>';
    }else if($id == 'ativas'){
      echo '<h2 class="page-header">Listando campanhas Ativas</h2>';
    }
      break;
    }

    echo '<div class="list-group">';
    for ($i=sizeof($campanhas)-1; $i >=0 ; $i--) {
      $numDenunciasCampanha =  AdministradorController::getInstance()->numDenunciasCampanha($campanhas[$i]->getIdCampanha());
      echo '<div class="list-group-item row">
        <div class="col-xs-6 col-md-4">
          <img src="';
          if($campanhas[$i]->getImagem() =="default" || $campanhas[$i]->getImagem() ==""){
            echo 'img/logobi.png';
          }else{
            echo $campanhas[$i]->getImagem();
          }
          echo'"  class="img-responsive img-rounded" />
          <div class="text-center">
          <span class="label ';
          if($campanhas[$i]->getStatus()){
            echo 'label-info">Ativa';
          }else{
              echo 'label-danger"> Finalizada';
          }
            echo '</span>
          </div>
        </div>
        <div class="col-xs-6 col-md-4">
          <div class="row panel panel-primary">
            <label class=""> Nome:</label> '.$campanhas[$i]->getNome().'
          </div>
          <div class="row panel panel-primary">
            <label class=""> Data Inicio:</label> '.date("d/m/Y", strtotime($campanhas[$i]->getDataInicio())).'
          </div>
          <div class="row panel panel-primary">
            <label class=""> Data Fim:</label> '.date("d/m/Y", strtotime($campanhas[$i]->getDataFim())).'
          </div>
        </div>
        <div class="col-xs-12 col-md-4 panel" >
          <div class="col-xs-6 col-md-12">
            <a href="campanha.php?id='.$campanhas[$i]->getidCampanha().'" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;"> Ver Campanha <span class="badge">#'.$campanhas[$i]->getidCampanha().'</span></a>
          </div>
          <div class="col-xs-6 col-md-12">
            <a href="usuario.php?cpf='.$campanhas[$i]->getCriadorCpf().'" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;">Ver Criador</a>
          </div>

          <div class="col-xs-6 col-md-12">
            <a href="listardenuncias.php?idCampanha='.$campanhas[$i]->getIdCampanha().'" class="btn ';
              if($numDenunciasCampanha == 0 ){echo 'btn-primary disabled';}
              else if($numDenunciasCampanha <10){echo 'btn-warning';}
              else{echo 'btn-danger';}
              echo ' btn-block" style="margin:5px 0px 5px 0px;">Ver Denuncias <span class="badge"> '.$numDenunciasCampanha.' </span></a>
            </div>
          </div>

        </div>
        ';
      }
      echo '</div>';
    }
  }

  public function listarUsuarios($filtro){

      $usuarios =  AdministradorController::getInstance()->listarUsuarios($filtro);

      switch ($filtro) {
        case 'bloqueados':
        echo '<h2 class="page-header">Listando usuários bloqueados</h2>';
        break;
        case 'todos':
        echo '<h2 class="page-header">Listando todos usuários</h2>';
        break;
      }

    if(sizeof($usuarios)==0){
      echo '<div class="alert alert-danger row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Desculpe!</strong> Não conseguimos encontrar o que você está procurando.
        </div>';
    }else{
      echo '<div class="list-group">';

      for ($i=sizeof($usuarios)-1; $i >= 0 ; $i--) {
        $numDenunciasCriador =  AdministradorController::getInstance()->numDenunciasCriador($usuarios[$i]->getCpf());
        $numDenunciasDenunciador =  AdministradorController::getInstance()->numDenunciasDenunciador($usuarios[$i]->getCpf());
        $numCampanhasCriador =  AdministradorController::getInstance()->numCampanhasCriador($usuarios[$i]->getCpf());
        echo '  <div class="row list-group-item">
            <div class="col-md-8">
              <div class="row">
                <div class="col-xs-5">
                  <img src="';
                  if($usuarios[$i]->getFoto() == "default.jpg"){
                    echo 'img/logobi.png';
                  }else{
                    echo $usuarios[$i]->getFoto();
                  }

                  echo '" alt="" class="img-responsive img-circle">
                  <div class="text-center">
                  <span class="label ';
                  if($usuarios[$i]->getBloqueado()){
                    echo 'label-danger"> Bloqueado em '.date("d/m/Y", strtotime($usuarios[$i]->getDataBloqueio()));
                  }else{
                    echo 'label-info"> Ativo';
                  }
                  echo '</span>
                  </div>

                  <div class="row">
                    <div class="radio disabled">
                      <label>
                        <input type="radio" disabled ';
                        if($usuarios[$i]->getSexo() == "M") {echo 'checked';}
                        echo '>
                        Homem
                      </label>
                    </div>
                    <div class="radio disabled">
                      <label>
                        <input type="radio" disabled ';
                        if($usuarios[$i]->getSexo() == "F") {echo 'checked';}
                        echo '>
                        Mulher
                      </label>
                    </div>

                  </div>
                </div>
                <div class="col-xs-7">
                  <div class="row panel panel-primary">
                    <label class=""> Nome:</label> '.$usuarios[$i]->getNome().'
                  </div>
                  <div class="row panel panel-primary">
                    <label class=""> CPF:</label> '.$usuarios[$i]->getCpf().'
                  </div>
                  <div class="row panel panel-primary">
                    <label class=""> Email:</label> '.$usuarios[$i]->getEmail().'
                  </div>
                  <div class="row panel panel-primary">
                    <label class=""> Nascimento:</label> '.date("d/m/Y", strtotime($usuarios[$i]->getDataNascimento())).'
                  </div>

                </div>
              </div>

            </div>
            <div class="row col-md-4" >
              <div class="col-xs-6 col-md-12">
                <a href="usuario.php?cpf='.$usuarios[$i]->getCpf().'" class="btn btn-primary btn-block" style="margin:5px 0px 5px 0px;">Ver Usuario</a>
              </div>
              <div class="col-xs-6 col-md-12">
                <a href="listarcampanhas.php?cpf='.$usuarios[$i]->getCpf().'" class="btn btn-primary btn-block ';
                if($numCampanhasCriador == 0){
                  echo 'disabled';
                }
                echo '" style="margin:5px 0px 5px 0px;">Campanhas criadas <span class="badge"> '.$numCampanhasCriador.' </span></a>
              </div>
              <div class="col-xs-6 col-md-12">
                <a href="listardenuncias.php?cpfCriador='.$usuarios[$i]->getCpf().'" class="btn ';
                if($numDenunciasCriador == 0 ){echo 'btn-primary disabled';}
                else if($numDenunciasCriador <10){echo 'btn-warning';}
                else{echo 'btn-danger';}
                 echo ' btn-block" style="margin:5px 0px 5px 0px;">Denuncias sofridas <span class="badge"> '.$numDenunciasCriador.' </span></a>
              </div>
              <div class="col-xs-6 col-md-12">
                <a href="listardenuncias.php?cpfDenunciante='.$usuarios[$i]->getCpf().'" class="btn btn-primary btn-block ';if($numDenunciasDenunciador ==0){echo 'disabled';}
                  echo'" style="margin:5px 0px 5px 0px;">Denuncias feitas <span class="badge"> '.$numDenunciasDenunciador.' </span></a>
              </div>
            </div>

          </div>';
      }
      echo "</div>";
    }
  }

  public function verUsuario($cpfUsuario){

    $usuario =  AdministradorController::getInstance()->buscarUsuario($cpfUsuario);
    $campanhas =  AdministradorController::getInstance()->buscarCampanhaPorCriador($cpfUsuario);
    $endereco = $usuario->getEndereco();
    $numDenunciasCriador =  AdministradorController::getInstance()->numDenunciasCriador($usuario->getCpf());
if($usuario->getCpf() ==null){
  echo '<div class="alert alert-danger row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Desculpe!</strong> Não conseguimos encontrar o que você está procurando.
    </div>';
    return;
}
    echo'
      <h2 class="page-header">'.$usuario->getNome().'</h2>

    <div class="row">
      <div class="col-md-6">
        <img src="';
        if($usuario->getFoto() == "default.jpg"){
          echo 'img/logobi.png';
        }else{
          echo $usuario->getFoto();
        }
        echo '" class="img-responsive img-circle"/>
        <div class="text-center">
            <span class="label ';
            if($usuario->getBloqueado()){
              echo 'label-danger"> Bloqueado em '.date("d/m/Y", strtotime($usuario->getDataBloqueio()));
            }else{
              echo 'label-info"> Ativo';
            }
            echo '</span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-xs-8">
          <div class="row panel panel-primary">
            <label class=""> CPF:</label> '.$usuario->getCpf().'
          </div>
          <div class="row panel panel-primary">
            <label class=""> Email:</label>'.$usuario->getEmail().'
          </div>
          <div class="row panel panel-primary">
            <label class=""> Nascimento:</label> '.date("d/m/Y", strtotime($usuario->getDataNascimento())).'
          </div>
          <div class="row panel panel-primary">
            <label class=""> Classificacao:</label>  '.$usuario->getClassificacao().'
          </div>
        </div>
        <div class="col-xs-4">
          <div class="row center-block">
            <div class="radio disabled">
              <label>
                <input type="radio" disabled ';
                if($usuario->getSexo() == "M") {echo 'checked';}
                echo '>
                Homem
              </label>
            </div>
            <div class="radio disabled">
              <label>
                <input type="radio" disabled ';
                if($usuario->getSexo() == "F") {echo 'checked';}
                echo '>
                Mulher
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <h4 class="page-header">Endereço</h4>
      <div class="col-md-12">
        <label class=""> Cep:</label>  '.$endereco['cep'].'
      </div>
      <div class="col-md-4">
        <label class=""> Estado:</label>  '.$endereco['estado'].'
      </div>
      <div class="col-md-4">
        <label class=""> Bairro:</label>  '.$endereco['bairro'].'
      </div>
      <div class="col-md-4">
        <label class=""> Cidade:</label> '.$endereco['cidade'].'
      </div>
      <div class="col-md-4">
        <label class=""> Logradouro:</label>'.$endereco['logradouro'].'
      </div>
      <div class="col-md-4">
        <label class=""> Numero:</label>  '.$endereco['numero'].'
      </div>
      <div class="col-md-4">
        <label class=""> Complemento:</label> '.$endereco['complemento'].'
      </div>
    </div>
    <div class="row">
      <h4 class="page-header">Opções</h4>
      <div class="col-md-4">
      <a href="listardenuncias.php?cpfCriador='.$usuario->getCpf().'" class="btn ';
      if($numDenunciasCriador == 0 ){echo 'btn-primary';}
      else if($numDenunciasCriador <10){echo 'btn-warning';}
      else{echo 'btn-danger';}
       echo ' btn-block" style="margin:5px;">Ver Denuncias sofridas <span class="badge"> '.$numDenunciasCriador.' </span></a>
      </div>
      <div class="col-md-4">
        <form method="post" action="rotas.php">';
        echo ' <input type="hidden" name="cpf" value="'.$usuario->getCpf().'" />';
        if(!$usuario->getBloqueado()){
          echo '<input type="submit" class="btn btn-danger btn-block" style="margin:5px;" name="botaoBloquearUsuario" value=" Bloquear Usuario">';
        }else{
          echo '<input type="submit" class="btn btn-danger btn-block" style="margin:5px;" name="botaoDesbloquearUsuario" value=" Desbloquear Usuario">';
        }
        echo'</form>
      </div>
      <div class="col-md-4">
        <form method="post" action="rotas.php">';
        echo ' <input type="hidden" name="cpf" value="'.$usuario->getCpf().'" />';
          echo '<input type="submit" class="btn btn-danger btn-block" style="margin:5px;" name="botaoExcluirUsuario" value=" Excluir Usuario">';

        echo'</form>
      </div>
    </div>
    <div class="row">
      <h4 class="page-header">Campanhas Criadas</h4>
    </div>';
  if(sizeof($campanhas) !=0){
  echo '<div class="table-responsive">';
  echo'
      <table class="table table-striped table-hover">
        <tr>
          <th>#id</th>
          <th>Nome</th>
          <th>Numero de Denuncias</th>
          <th>Link para Campanha</th>
        </tr>';

  for ($i=0; $i <sizeof($campanhas) ; $i++) {
    $numDenuncias =  AdministradorController::getInstance()->numDenunciasCampanha($campanhas[$i]->getIdCampanha());
    echo '<tr class="';
    if($numDenuncias ==0){echo 'success';}
    else if($numDenuncias < 10){echo 'warning';}
    else{echo 'danger';}
    echo '">
      <td >'.$campanhas[$i]->getIdCampanha().'</td>
      <td >'.$campanhas[$i]->getNome().'</td>
      <td >'.$numDenuncias.' - <a  href="listardenuncias.php?idCampanha='.$campanhas[$i]->getIdCampanha().'">Ver Denuncias</a></td>
      <td ><a  href="campanha.php?id='.$campanhas[$i]->getIdCampanha().'">Ver Campanha</a></td>
    </tr>
    ';
  }

  echo '</table>
    </div>';
  }else{

  echo '<div class="alert alert-warning row alert-dismissible" role="alert" style="margin:10px 0px 10px 0px;">
    <strong>Este usuário não possui campanhas criadas!</strong>
    </div>';
  }
  }
/*
  public function excluirContaUsuario(){

    //$cpfUsuario = $_POST['cpfUsuario'];
    $cpfUsuario = "123456";

    if(!isset ($_SESSION['cpfAdministrador'])) {
      unset($_SESSION['cpfAdministrador']);
      header('location:index.php');
    }

    $confirmacao =  AdministradorController::getInstance()->excluirUsuario($cpfUsuario);
    if($confirmacao){
      return True;//Usuario Deletado
    }
    return False; //Usuario Não Deletado
  }

  public function bloquearUsuario($cpfUsuarioBloquear){

    $_SESSION['cpfAdministrador'] = "123456";//Mudar para sessão de usuário

    if(!isset($_SESSION['cpfAdministrador'])) {
      unset($_SESSION['cpfAdministrador']);
      header('location:index.php');
    }
    $confirmacao =  UsuarioController::getInstance()->bloquearUsuario($cpfUsuarioBloquear);

    if($confirmacao){
      echo "Usuario Bloqueado com sucesso";
    } else{
      echo "Erro ao tentar Bloquear o Usuario";
    }


  }
*/
}

 ?>
