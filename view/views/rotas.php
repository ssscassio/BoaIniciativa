<?php

  if ( isset( $_POST['login'] )) { //aperto o botao de login
    if(isset($_POST['cpf']) && isset($_POST['senha'])){
      $cpf = $_POST['cpf'];
      $senha = $_POST['senha'];
      UsuarioFacade::getInstance()->efetuarLogin($cpf,$senha);
    }else{
      echo "Preencha todos os campos.";
    }
  }

?>
