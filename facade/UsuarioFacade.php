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

  function editarPerfil($nome,$email,$sexo,$nascimento,$cep,$estado,$bairro,$cidade,$logradouro,$numero,$complemento){
    $controller = new UsuarioController();
    return $controller->editarPerfil($nome,$email,$sexo,$nascimento,$cep,$estado,$bairro,$cidade,$logradouro,$numero,$complemento);
  }



}



 ?>
