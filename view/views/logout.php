<?php
//encerra a sessao e redireciona o usuário para o index
   session_start();
   unset($_SESSION['cpf']);
   unset($_SESSION['senha']);
   header('location:index.php');

 ?>
