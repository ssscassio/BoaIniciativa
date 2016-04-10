<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AdministradorFacade.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AdministradorFacade.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");

if(isset($_POST['botaoLogar'])){
  session_start();
  if(isset($_POST['cpf']) && isset($_POST['senha'])){
    $cpf = $_POST['cpf'];
    $senha =  $_POST['senha'];




    $cpf = $_POST['cpf'];
    $senha =  $_POST['senha'];
    echo $cpf;
    echo $senha;

    $autenticado = UsuarioDAO::getInstance()->autenticarUsuariomd5($cpf, $senha);
    if ($autenticado){
      $_SESSION['cpf'] = $cpf;
      $_SESSION['senha'] = $senha;
      header('location:home.php');
    }else{
      unset($_SESSION['cpf']);
      unset($_SESSION['senha']);
      header('location:index.php');

    }
  }
}else if ( isset( $_POST['doarCampanha'] )) {//Apertou o botão de doar para Campanha no formulário
  if(isset($_POST['idCampanha']) && isset($_POST['cpfUsuario'])){
    $idCampanha= $_POST['idCampanha'];
    $cpfUsuario= $_POST['cpfUsuario'];//Substituir para verificação da sessão
    UsuarioFacade::getInstance()->efetuarDoacao($idCampanha,$cpfUsuario);
  }else{
    echo "Preencha todos os campos";
  }
}else if(isset($_POST['botaoCadastrar'])){
  if(isset($_SESSION['cpf']) && isset($_SESSION['senha'])){//Usuario já logado, mover para Home
    header('location:home.php');
  }else{ //Usuario deslogado, pode cadastrar
    if(isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['nascimento']) && isset($_POST['cep'])
    && isset($_POST['estado']) && isset($_POST['bairro']) && isset($_POST['cidade']) &&isset($_POST['longradouro']) && isset($_POST['numero']) && isset($_POST['complemento'])
    && isset($_POST['gender'])){
      $sexo = ($_POST['gender']=='male')? 'M': 'F';
      $nome = $_POST['nome'];
      $cpf = $_POST['cpf'];
      $email = $_POST['email'];
      $senha = $_POST['password'];
      $nascimento = $_POST['nascimento'];
      $cep = $_POST['cep'];
      $estado = $_POST['estado'];
      $bairro = $_POST['bairro'];
      $cidade = $_POST['cidade'];
      $longradouro = $_POST['longradouro'];
      $numero = $_POST['numero'];
      $complemento = $_POST['complemento'];
      echo "Tudo certo para cadastrar";
      $confirmacao = SistemaFacade::getInstance()->cadastrarNovoUsuario($nome,$cpf,$email,$senha,$nascimento,$cep,$estado,$bairro,$cidade,$longradouro,$numero,$complemento,$sexo);
      if($confirmacao){
        header('location:index.php');
        echo "Usuario Cadastrado com sucesso";
      }else{
        header('location:login.php');
        echo "Erro ao cadastrar";
      }
    }else{
      header('location:login.php');
      echo "Preencha todos os campos";
    }
    header('location:index.php');
  }
}
?>
