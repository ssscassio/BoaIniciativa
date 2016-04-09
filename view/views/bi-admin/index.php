<?php include_once("cabecalho.php"); ?>

<?php
session_start();
  if( (isset($_SESSION['cpfAdm'])) && (isset ($_SESSION['senhaAdm'])) ){//Verifica se já está logado
    header('location:home.php');
  }
?>

<?php include_once("login.php"); ?>
