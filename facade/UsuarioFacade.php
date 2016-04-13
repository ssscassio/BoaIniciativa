<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/UsuarioController.php");

  class UsuarioFacade{

    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new UsuarioFacade();
      return self::$instance;
    }



    public function efetuarDoacao($idCampanha,$cpfUsuario){

      /**Parte para demover depois que colocar a sessão do usuario
      **/
      $_SESSION['cpf'] = $cpfUsuario;
      /*******/
      if(!isset ($_SESSION['cpf'])) {
        unset($_SESSION['cpfUsuario']);
        header('location:index.php');
      }
      echo $idCampanha;
      echo $cpfUsuario;
      return UsuarioController::getInstance()->efetuarDoacaoMaterial($cpfUsuario, $idCampanha);
    }


  public function excluirSuaConta(){
    /**Parte para demover depois que colocar a sessão do usuario
    **/
    $_SESSION['cpfUsuario'] = "123456";
    /*******/
    if(!isset ($_SESSION['cpfUsuario'])) {
      unset($_SESSION['cpfUsuario']);
      header('location:index.php');
    }

    $confirmacao = UsuarioController::getInstance()->excluirSuaConta($__SESSION['cpfUsuario']);
    if($confirmacao){
      unset($_SESSION['cpfUsuario']);
      header('location:index.php');
      return True;//Usuario Deletado
    }
    return False; //Usuario Não Deletado
  }

  function editarPerfil($cpf,$nome,$email,$sexo,$nascimento,$cep,$estado,$bairro,$cidade,$logradouro,$numero,$complemento){
      $usuario = UsuarioDAO::getInstance()->buscarUsuario($cpf);
      $usuario->setNome($nome);
      $usuario->setEmail($email);
      $usuario->setSexo($sexo);
      $usuario->setDataNascimento($nascimento);
      $endereco = array();
      $endereco['cep'] = $cep;
      $endereco['estado'] = $estado;
      $endereco['bairro'] = $bairro;
      $endereco['cidade'] = $cidade;
      $endereco['logradouro'] = $logradouro;
      $endereco['numero'] = $numero;
      $endereco['complemento'] = $complemento;
      $l = $endereco['logradouro'];
      $n = $endereco['numero'];
      $b = $endereco['bairro'];
      $c = $endereco['cidade'];
      $enderecoJunto = "$l, $n, $b, $c";

      $usuario->setEndereco($endereco);

    return UsuarioDAO::getInstance()->editarPerfil($usuario);
  }

  public function verCampanha ($idcampanha){
    return UsuarioController::getInstance()->verCampanha($idcampanha);
  }



}



 ?>
