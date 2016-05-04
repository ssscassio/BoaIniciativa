<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AdministradorFacade.php");

		if(isset($_POST['botaoLoginAdm'])){//Botão Login
    $val = "";


          session_start();
    if(isset($_POST['cpf']) && isset($_POST['senha'])){

        $cpf = $_POST['cpf'];
        $senha =  $_POST['senha'];
        $confirmacao = AdministradorFacade::getInstance()->autenticarAdm($cpf, $senha);
        $administrador = AdministradorDAO::getInstance()->buscarAdministrador($cpf);
        if ($confirmacao){
          $_SESSION['cpfAdm'] = $cpf;
          $_SESSION['senhaAdm'] = $senha;
          $_SESSION['nomeAdm'] = $administrador->getNome();
          $atualiza = true;
          $val =  "<div class='alert alert-success'> <strong>Administrador logado com sucesso!</strong></div>";
        }else{
          unset($_SESSION['cpfAdm']);
          unset($_SESSION['senhaAdm']);
          unset($_SESSION['nomeAdm']);
          $atualiza = false;
          if($administrador->getCpf() == ""){
            $val = "<div class='alert alert-warning'> <strong>Erro na autenticação!</strong> Usuario não cadastrado</div>";
          }else{
            $val = "<div class='alert alert-warning'> <strong>Erro na autenticação!</strong> Senha incorreta</div>";
          }
        }
      echo json_encode( array( 'mensagem' => $val, 'atualiza' => $atualiza) );
      }

    } else if(isset($_POST['botaoCadastrarAdm'])){//Botão Cadastro
      if(isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['nascimento']) && isset($_POST['gender'])){
         $sexo = ($_POST['gender']=='male')? 'M': 'F';
         $nome = $_POST['nome'];
         $cpf = $_POST['cpf'];
         $senha = $_POST['password'];
         $email = $_POST['email'];
         $nascimento = $_POST['nascimento'];
         $confirmacao = AdministradorFacade::getInstance()->cadastrarNovoAdministrador($nome,$cpf,$email,$senha,$nascimento,$sexo);
         if($confirmacao){ //Cadastrou com sucesso
           echo "Cadastro com sucesso";
           header('location:home.php');
         }else{//Usuario já utilizado ou erro no cadastro
           echo "Administrador já cadastrado";

           header('location:cadastro.php');
         }
       }else{
         echo "Preencha todos os campos";
         header('location:cadastro.php');
       }

    } else if(isset($_POST['botaoBloquearUsuario'])){
      if(isset($_POST['cpf'])){
        AdministradorController::getInstance()->bloquearUsuario($_POST['cpf']);
        header('location:usuario.php?cpf='.$_POST['cpf']);
      }

    } else if(isset($_POST['botaoDesbloquearUsuario'])){
      if(isset($_POST['cpf'])){
        AdministradorController::getInstance()->desbloquearUsuario($_POST['cpf']);
        header('location:usuario.php?cpf='.$_POST['cpf']);
      }
    } else if(isset($_POST['botaoExcluirUsuario'])){
      if(isset($_POST['cpf'])){
        $confirmacao = AdministradorController::getInstance()->excluirUsuario($_POST['cpf']);
        if ($confirmacao) {
          header('location:listarusuarios.php');
        }else{
          header('location:usuario.php?cpf='.$_POST['cpf']);
        }
      }
    }else if(isset($_POST['botaoEncerrarCampanha'])){
      if(isset($_POST['idCampanha'])){
        $confirmacao = AdministradorController::getInstance()->encerrarCampanha($_POST['idCampanha']);
          header('location:campanha.php?id='.$_POST['idCampanha']);

      }
    }


?>
