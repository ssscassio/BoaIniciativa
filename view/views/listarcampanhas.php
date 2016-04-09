<?php
if(isset($_SESSION['cpf']) && isset($_SESSION['senha'])){
  include('cabecalhoLogado.php');
}else{
  include('cabecalho.php');
}
 ?>
