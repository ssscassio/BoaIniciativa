<?php


require_once('ConexaoDB.php');
require_once("Sql.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Usuario.php");
/**
* Classe referente a Personificação do Usuario do Banco de Dados
*/
class UsuarioDAO{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new UsuarioDAO();
    return self::$instance;
  }

  public function adicionarNovoUsuario($usuario){

    $sql = Sql::getInstance()->adicionarNovoUsuarioSQL();
    $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
    $endereco = $usuario->getEndereco();
    $stmt->bindParam(1,$usuario->getCpf());
    $stmt->bindParam(2,$usuario->getSexo());
    $stmt->bindParam(3,$usuario->getDataNascimento());
    $stmt->bindParam(4,$usuario->getEmail());
    $stmt->bindParam(5,Criptografar::hash($usuario->getSenha()));
    $stmt->bindParam(6,$usuario->getNome());
    $stmt->bindParam(7,$usuario->getClassificacao());
    $stmt->bindParam(8,$endereco[0]);
    $stmt->bindParam(9,$endereco[1]);
    $stmt->bindParam(10,$endereco[2]);
    $stmt->bindParam(11,$endereco[3]);
    $stmt->bindParam(12,$endereco[4]);
    $stmt->bindParam(13,$endereco[5]);
    $stmt->bindParam(14,$endereco[6]);
    $stmt->bindParam(15,$usuario->getFoto());
    $stmt->bindParam(16, $usuario->getLatitude());
    $stmt->bindParam(17, $usuario->getlongitude());

    $stmt->execute();

    if($stmt->errorCode() != "00000"){//Bloco de erro
      echo "Erro código". $stmt->errorCode(). ":";
      var_dump($stmt->errorInfo());
    }else{
      return true;
    }

  }

  public function adicionarNovoUsuariomd5($usuario){

    $sql = Sql::getInstance()->adicionarNovoUsuariomd5SQL();
    $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
    $endereco = $usuario->getEndereco();
    $stmt->bindParam(1,$usuario->getCpf());
    $stmt->bindParam(2,$usuario->getSexo());
    $stmt->bindParam(3,$usuario->getDataNascimento());
    $stmt->bindParam(4,$usuario->getEmail());
    $stmt->bindParam(5,$usuario->getSenha());
    $stmt->bindParam(6,$usuario->getNome());
    $stmt->bindParam(7,$usuario->getClassificacao());
    $stmt->bindParam(8,$endereco["cep"]);
    $stmt->bindParam(9,$endereco["estado"]);
    $stmt->bindParam(10,$endereco["bairro"]);
    $stmt->bindParam(11,$endereco["cidade"]);
    $stmt->bindParam(12,$endereco["logradouro"]);
    $stmt->bindParam(13,$endereco["numero"]);
    $stmt->bindParam(14,$endereco["complemento"]);
    $stmt->bindParam(15,$usuario->getFoto());
    $stmt->bindParam(16, $usuario->getLatitude());
    $stmt->bindParam(17, $usuario->getlongitude());

    $stmt->execute();

    if($stmt->errorCode() != "00000"){//Bloco de erro
      echo "Erro código". $stmt->errorCode(). ":";
      var_dump($stmt->errorInfo());
    }else{
      return true;
    }

  }

  private function popularUsuario($linha){

    $endereco = array('cep'=> $linha['cep'],
    'estado'=>$linha['estado'],
    'bairro'=>$linha['bairro'],
    'cidade'=>$linha['cidade'],
    'logradouro'=>$linha['logradouro'],
    'numero'=>$linha['numero'],
    'complemento'=>$linha['complemento']);
    //$nome, $cpf, $email, $senha, $foto, $sexo, $dataNascimento, $endereco, $classificacao, $bloqueado, $dataBloqueio
    $usuario = new Usuario($linha['nome'],$linha['cpf'],$linha['email'],$linha['senha'],$linha['foto'],$linha['sexo'],$linha['datanascimento'],$endereco,$linha['classificacao'],
    $linha['bloqueado'],$linha['databloqueio']);
   // $usuario->setLatitude($linha['latitude']);
   // $usuario->setLongitude($linha['longitude']);

    return $usuario;
  }

  public function adicionarCadastroRapido($cpf, $email, $senha){

    try{
      $sql = Sql::getInstance()->adicionarCadastroRapidoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpf);
      $stmt->bindParam(2,$email);
      $stmt->bindParam(3,Criptografar::hash($usuario->getSenha()));

      $stmt->execute();
    }catch(Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }

  public function adicionarCadastroRapidomd5($cpf, $email, $senha){

    try{
      $sql = Sql::getInstance()->adicionarCadastroRapidomd5SQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpf);
      $stmt->bindParam(2,$email);
      $stmt->bindParam(3,$senha);

      $stmt->execute();
    }catch(Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }

  public function buscarUsuario($cpf){
    try{
      $sql = Sql::getInstance()->buscarUsuarioSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpf);
      $stmt->execute();
      return UsuarioDAO::getInstance()->popularUsuario($stmt->fetch(PDO::FETCH_ASSOC));
    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }

  public function buscarUsuarioEmail($email){
    try{
      $sql = Sql::getInstance()->buscarUsuarioEmailSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$email);
      $stmt->execute();
      return UsuarioDAO::getInstance()->popularUsuario($stmt->fetch(PDO::FETCH_ASSOC));
    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function autenticarUsuario($cpf, $senha){
    try{
      $hash = $this->buscarUsuario($cpf);
      return Criptografar::check($senha, $hash->getSenha());
    } catch (Excepetion $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }
  public function autenticarUsuariomd5($cpf, $senha){
    try{
      $sql = Sql::getInstance()->autenticarUsuarioSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpf);
      $stmt->bindParam(2,$senha);
      $stmt->execute();
      return ($stmt->rowCount() > 0);

    } catch (Excepetion $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function editarPerfil($usuario){
    try{
      $sql = Sql::getInstance()->editarPerfilSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $endereco = $usuario->getEndereco();
      $stmt->bindParam(1, $usuario->getSexo());
      $stmt->bindParam(2, $usuario->getDataNascimento());
      $stmt->bindParam(3, $usuario->getFoto());
      $stmt->bindParam(4, $usuario->getEmail());
      $stmt->bindParam(5, $usuario->getNome());
      $stmt->bindParam(6, $usuario->getClassificacao());
      $stmt->bindParam(7, $endereco["cep"]);
      $stmt->bindParam(8, $endereco["estado"]);
      $stmt->bindParam(9, $endereco["bairro"]);
      $stmt->bindParam(10, $endereco["cidade"]);
      $stmt->bindParam(11, $endereco["logradouro"]);
      $stmt->bindParam(12, $endereco["numero"]);
      $stmt->bindParam(13, $endereco["complemento"]);
      $stmt->bindParam(14, $usuario->getLatitude());
      $stmt->bindParam(15, $usuario->getLongitude());
      $stmt->bindParam(16, $usuario->getCpf());

      return $stmt->execute();
    }catch (Excepetion $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function editarSenha($senha, $cpf){
    try{
      $sql = Sql::getInstance()->editarSenhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, Criptografar::hash($senha));
      $stmt->bindParam(2, $cpf);

      $stmt->execute();
    }catch (Excepetion $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function editarSenhamd5($senha, $cpf){
    try{
      $sql = Sql::getInstance()->editarSenhamd5SQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $senha);
      $stmt->bindParam(2, $cpf);

      $stmt->execute();
    }catch (Excepetion $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }


  public function deletarUsuario($cpf){
    try {
      $sql = Sql::getInstance()->deletarUsuarioSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $cpf);
      $stmt->execute();
    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function bloquearUsuario($cpf, $data){
    try{
      $sql = Sql::getInstance()->bloquearUsuarioSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $data);
      $stmt->bindParam(2, $cpf);
      $stmt->execute();

    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function desbloquearUsuario($cpf){
    try{
      $sql = Sql::getInstance()->desbloquearUsuarioSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $cpf);
      $stmt->execute();
    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  /**
  * Método que verifica se um cpf ou email já está sendo usado, se estiver sendo usado, retorna True;
  **/

  public function verificaUsuarioCadastrado($cpf,$email){
    try{
      $sql = Sql::getInstance()->verificarUsuarioCadastradoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$email);
      $stmt->bindParam(2,$cpf);
      $stmt->execute();
      return ($stmt->rowCount() > 0); //True = usuario ou email já utilizado, False = cadastro liberado

    } catch (Excepetion $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
    return FALSE;
  }

  public function listarUsuarios(){
    try{
      $sql = Sql::getInstance()->listarUsuariosSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->execute();

      $usuarios = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $usuarios[] = $this->popularUsuario($row);
      }

      return $usuarios;

    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function listarUsuariosBloqueados(){
    try{
      $sql = Sql::getInstance()->listarUsuariosBloqueadosSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->execute();

      $usuarios = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $usuarios[] = $this->popularUsuario($row);
      }

      return $usuarios;

    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }
}
?>
