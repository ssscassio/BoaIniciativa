<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AdministradorFacade.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/AtendenteController.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/DoadorController.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/UsuarioFacade.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."PHPMailer/PHPMailerAutoload.php");

if(isset($_POST['botaoLogar'])){
  session_start();
    if(isset($_POST['cpf']) && isset($_POST['senha'])){
    $cpf = $_POST['cpf'];
    $senha =  $_POST['senha'];

    $autenticado = UsuarioDAO::getInstance()->autenticarUsuariomd5($cpf, $senha);
    $usuario = UsuarioDAO::getInstance()->buscarUsuario($cpf);

    if ($autenticado){
      $_SESSION['cpf'] = $cpf;
      $_SESSION['senha'] = $senha;
      echo "<div class='alert alert-success'> <strong>Usuario logado com sucesso!</strong></div>";
    }else{
      unset($_SESSION['cpf']);
      unset($_SESSION['senha']);
      if($usuario->getCpf() == ""){
        echo "<div class='alert alert-warning'> <strong>Erro na autenticação!</strong> Usuario não cadastrado</div>";
      }else{
        echo "<div class='alert alert-warning'> <strong>Erro na autenticação!</strong> Senha incorreta</div>";
      }
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
}else if(isset($_POST['botaoEditar'])){
  if(isset($_POST['cpf']) &&isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['sexo']) && isset($_POST['nascimento']) && isset($_POST['cep'])
  && isset($_POST['estado']) && isset($_POST['bairro']) && isset($_POST['cidade']) &&isset($_POST['logradouro']) && isset($_POST['numero']) && isset($_POST['complemento'])){

    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sexo = ($_POST['sexo']=='male')? 'M': 'F';
    $nascimento = $_POST['nascimento'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];


    $confirmacao = UsuarioFacade::getInstance()->editarPerfil($cpf,$nome,$email,$sexo,$nascimento,$cep,$estado,$bairro,$cidade,$logradouro,$numero,$complemento);

    if($confirmacao){
      header('location:perfil.php');//funcionou
    }else{
      header('location:perfil.php');//nao funcionou
    }
  }else{
      header('location:perfil.php'); //falta informações
  }


}else if(isset($_POST['botaoConfirmarParticipacao'])){
  $cpf = $_POST['cpf'];
  $idCampanha = $_POST['idCampanha'];

  $confirmacao = AtendenteController::getInstance()->confirmarParticipacao($cpf,$idCampanha);


  if($confirmacao){
    header('location:campanhasAtendente.php');//funcionou
  }else{
    header('location:convites-atendente.php');//nao funcionou
  }
}else if(isset($_POST['botaoCancelarParticipacao'])){
  $cpf = $_POST['cpf'];
  $idCampanha = $_POST['idCampanha'];

  $confirmacao = AtendenteController::getInstance()->cancelarParticipacao($cpf,$idCampanha);


  if($confirmacao){
    header('location:convites-atendente.php');//funcionou
  }else{
    header('location:campanhasAtendente.php');//nao funcionou
  }
}else if(isset($_POST['botaoCadastroRapido'])){
  $cpf = $_POST['cpf'];
  $senha = $_POST['password'];
  $email = $_POST['email'];

  $confirmacao = AtendenteController::getInstance()->cadastroRapido($cpf,$email,$senha);
  if($confirmacao){
    header('location:cadastrorapido.php');//funcionou
  }else{
    header('location:cadastrorapido.php');//nao funcionou
  }
}else if(isset($_POST['botaoCancelarDoacao'])){

  $idDoacao = $_POST['idDoacao'];

   $confirmacao = DoadorController::getInstance()->cancelarDoacao($idDoacao);

   if($confirmacao){
     header('location:doador.php');//funcionou
   }else{
     header('location:doador.php');//nao funcionou
   }
}else if(isset($_POST['botaoEnviarDenuncia'])){
  $idCampanha = $_POST['idCampanha'];
  $motivo = $_POST['motivo'];
  $descricao = $_POST['descricao'];
  $cpf =$_POST['cpf'];
  $confirmacao = UsuarioController::getInstance()->enviarDenuncia($idCampanha, $motivo, $descricao, $cpf);

  header('location:doador.php');
}else if(isset($_POST['botaoConfirmarDoacao'])){

    $idDoacao = $_POST['idDoacao'];
    $cpf = $_POST['cpfAtendente'];
    $quantidade_itens = $_POST['quantidade_itens'];
    $materiaisDoados = array();
    for ( $x = 1; $x <= $quantidade_itens ; $x++ ){

        $item = $_POST["material$x"];
        $quantidade = $_POST["quantidade$x"];
        $materiaisDoados[$item]+=$quantidade;
    }
    unset($_POST['botaoConfirmarDoacao']);
    unset($_POST['quantidade_itens']);
    unset($_POST['idDoacao']);

    AtendenteController::getInstance()->receberMateriais($idDoacao, $materiaisDoados);
    AtendenteController::getInstance()->confirmarDoacao($idDoacao,$_POST['cpfAtendente']);


}else if(isset($_POST['botaoSenha'])){
session_start();
if(isset($_SESSION['cpf']) && isset($_SESSION['senha'])){//Usuario já logado, mover para Home
    $senhaAtual = $_SESSION['senha'];
    $senhaForm = $_POST['senha'];
    $novaSenha = $_POST['novasenha'];
    if($senhaAtual == $senhaForm){
      UsuarioFacade::getInstance()->editarSenha($novaSenha,$_SESSION['cpf']);
      echo 'OK';
      header('location:perfil.php');//colocar confirmação na tela de alteração
    }
    else{
      echo 'Senha Invalida';//colocar que senha está errada!
    }
}else{
    header('location:index.php');
}
}else if(isset($_POST['botaoRecuperarSenha'])){
  $cpf = $_POST["cpf"];
  $user = UsuarioDAO::getInstance()->buscarUsuario($cpf);
  $senha = rand(100000,999999);
  UsuarioFacade::getInstance()->editarSenha($senha, $cpf);
  $nome = $user->getNome();
  $email = $user->getEmail();
  // Instância do objeto PHPMailer
  $mail = new PHPMailer;
  // Configura para envio de e-mails usando SMTP
  $mail->isSMTP();
  // Servidor SMTP
  $mail->Host = 'smtp.gmail.com';
  // Usar autenticação SMTP
  $mail->SMTPAuth = true;
  // Usuário da conta
  $mail->Username = 'boainiciativa@gmail.com';
  // Senha da conta
  $mail->Password = 'MP4F9W6C8VHTCCTT7M7RY7K3Y';
  // Tipo de encriptação que será usado na conexão SMTP
  $mail->SMTPSecure = 'ssl';
  // Porta do servidor SMTP
  $mail->Port = 465;
  // Informa se vamos enviar mensagens usando HTML
  $mail->IsHTML(true);
  // Email do Remetente
  $mail->From = 'boainiciativa@gmail.com';
  // Nome do Remetente
  $mail->FromName = 'Boa Iniciativa';
  // Endereço do e-mail do destinatário
  $mail->addAddress($email);
  // Assunto do e-mail
  $mail->Subject = 'Recuperacao de Senha';
  // Mensagem que vai no corpo do e-mail
  $mail->Body = '<h1>Recuperacao de Senha</h1><br>
  <p> Caro(a) ';
  $mail->Body .= $nome;
  $mail->Body .=',<br> Consta em nosso sistema a sua solicitacao de recuperacao de senha.<br>Segue os seus dados:<br><br><br>';
  $mail->Body .= 'CPF: '.$cpf.'.<br> Senha: '.$senha.'.<br><br><br>';
  $mail->Body .= 'Caso nao tenha feito esta solicitacao, por favor ignorar este e-mail. Favor nao responder essa mensagem!<br>
  Obrigado!<br>
  Equipe do Boa Iniciativa.<br></p>';
  // Envia o e-mail e captura o sucesso ou erro
  if($mail->Send()){
    //echo 'Recuperação de senha enviada com sucesso'; MOSTRAR CONFIRMAÇÃO DE SENHA ALTERADA
      //echo 'Recuperação enviada para '+ $email +' com sucesso !';
     header('location:index.php');
  }
  else{
      //echo 'Erro ao enviar Email:'; MOSTRAR QUE CONTA NÃO EXISTE
    if($mail->ErrorInfo){
      //echo 'Conta Inexistente';
    }
  }
}
?>
