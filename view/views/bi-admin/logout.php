<?php

  //encerra a sessao e redireciona o usuário para o index
  session_start();
  unset($_SESSION['cpfAdm']);
  unset($_SESSION['senhaAdm']);
  unset($_SESSION['nomeAdm']);
  header('location:index.php');

 ?>
