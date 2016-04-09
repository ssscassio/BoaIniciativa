<?php
  require_once('../facade/CassioUsuarioFacade.php');


  if ( isset( $_POST['doarCampanha'] )) {//Apertou o botão de doar para Campanha no formulário
    if(isset($_POST['idCampanha']) && isset($_POST['cpfUsuario'])){

      $idCampanha= $_POST['idCampanha'];
      $cpfUsuario= $_POST['cpfUsuario'];//Substituir para verificação da sessão
      CassioUsuarioFacade::getInstance()->efetuarDoacao($idCampanha,$cpfUsuario);

    }else{
      echo "Preencha todos os campos";
    }

  }else if(isset( $_POST['bloquearUsuario'])){
    if(isset($_POST['cpfUsuarioBloquear'])){

      $cpfUsuarioBloquear = $_POST['cpfUsuarioBloquear'];
      CassioUsuarioFacade::getInstance()->bloquearUsuario($cpfUsuarioBloquear);

    }else{
      echo "Escolha um usuario para bloquear";
    }
  }
?>
