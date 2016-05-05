<?php


require_once('ConexaoDB.php');
require_once("Sql.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Usuario.php");

/**
* Classe UsuarioDAO
* Classe que manipula a tabela Usuario no Banco de Dados
*/
class UsuarioDAO{

  /** Instancia Singleton da classe*/
  private static $instance;

  public function __construct(){

  }
  /**
  * Método que define o padrão Singleton na classe
  */
  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new UsuarioDAO();
    return self::$instance;
  }

  /**
  * Método que adiciona as informações de um usuário no banco de dados salvando a senha com criptografia bcrypt
  * @param $usuario -Objeto do tipo usuário contendo as informações do usuário que deseja-se cadastrar no banco de dados
  * @return True caso não ocorra erro na inserção do usuário no banco, false caso contrário
  */
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
    $stmt->bindParam(8,$endereco["cep"]);
    $stmt->bindParam(9,$endereco["estado"]);
    $stmt->bindParam(10,$endereco["bairro"]);
    $stmt->bindParam(11,$endereco["cidade"]);
    $stmt->bindParam(12,$endereco["logradouro"]);
    $stmt->bindParam(13,$endereco["numero"]);
    $stmt->bindParam(14,$endereco["complemento"]);
    $stmt->bindParam(15,$usuario->getFoto());

    $stmt->execute();

    if($stmt->errorCode() != "00000"){//Bloco de erro
      return false;
    }else{
      return true;
    }
  }

  /**
  * Método que adiciona as informações de um usuário no banco de dados salvando a senha com md5
  * @param $usuario -Objeto do tipo usuário contendo as informações do usuário que deseja-se cadastrar no banco de dados
  * @return True caso não ocorra erro na inserção do usuário no banco, false caso contrário
  */
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

    $stmt->execute();

    if($stmt->errorCode() != "00000"){//Bloco de erro
      return false;
    }else{
      return true;

    }

    /**
    * Método responsável pela personificação das informações da tabela Usuario como um objeto PHP
    * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
    * @return objeto do tipo Usuario
    */
    private function popularUsuario($linha){

      $endereco = array('cep'=> $linha['cep'],
      'estado'=>$linha['estado'],
      'bairro'=>$linha['bairro'],
      'cidade'=>$linha['cidade'],
      'logradouro'=>$linha['logradouro'],
      'numero'=>$linha['numero'],
      'complemento'=>$linha['complemento']);
      $usuario = new Usuario($linha['nome'],$linha['cpf'],$linha['email'],$linha['senha'],$linha['foto'],$linha['sexo'],$linha['datanascimento'],$endereco,$linha['classificacao'],
      $linha['bloqueado'],$linha['databloqueio']);
      $usuario->setLatitude($linha['latitude']);
      $usuario->setLongitude($linha['longitude']);

      return $usuario;
    }

    /**
    * Método que adiciona as informações de um usuário cadastrado de forma rápida no banco de dados salvando a senha com criptografia bcrypt
    * @param $cpf - Cpf do usuário que deseja-se cadastrar de forma rapida
    * @param $email - Email do usuário
    * @param $senha - Senha do usuário
    * @return True caso não ocorra erro na inserção do usuário no banco, false caso contrário
    */
    public function adicionarCadastroRapido($cpf, $email, $senha){
      try{
        $sql = Sql::getInstance()->adicionarCadastroRapidoSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$cpf);
        $stmt->bindParam(2,$email);
        $stmt->bindParam(3,Criptografar::hash($usuario->getSenha()));

        $stmt->execute();
      }catch(Exception $e){

      }
    }

    /**
    * Método que adiciona as informações de um usuário cadastrado de forma rápida no banco de dados salvando a senha com md5
    * @param $cpf - Cpf do usuário que deseja-se cadastrar de forma rapida
    * @param $email - Email do usuário
    * @param $senha - Senha do usuário
    * @return True caso não ocorra erro na inserção do usuário no banco, false caso contrário
    */
    public function adicionarCadastroRapidomd5($cpf, $email, $senha){
      try{
        $sql = Sql::getInstance()->adicionarCadastroRapidomd5SQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$cpf);
        $stmt->bindParam(2,$email);
        $stmt->bindParam(3,$senha);

        $stmt->execute();
      }catch(Exception $e){

      }
    }

    /**
    * Método que busca um usuário no banco de dados através de seu cpf
    * @param $cpf - Cpf do usuário que deseja-se buscar no banco
    * @return Objeto do tipo usuário contendo as informações do usuário encontrado no banco
    */
    public function buscarUsuario($cpf){
      try{
        $sql = Sql::getInstance()->buscarUsuarioSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$cpf);
        $stmt->execute();

        return UsuarioDAO::getInstance()->popularUsuario($stmt->fetch(PDO::FETCH_ASSOC));
      } catch (Exception $e){
        return false;
      }

    }

    /**
    * Método que busca um usuário no banco de dados através de seu email
    * @param $email - Email do usuário que deseja-se buscar no banco
    * @return Objeto do tipo usuário contendo as informações do usuário encontrado no banco
    */
    public function buscarUsuarioEmail($email){
      try{
        $sql = Sql::getInstance()->buscarUsuarioEmailSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$email);
        $stmt->execute();
        return UsuarioDAO::getInstance()->popularUsuario($stmt->fetch(PDO::FETCH_ASSOC));
      } catch (Exception $e){
        return false;
      }
    }

    /**
    * Método que autentica um Usuario no banco de dados utilizado criptografia bcrypt
    * @param $cpf - Cpf do usuário que deseja-se autenticar
    * @param $senha - Senha do usuário que deseja-se autenticar
    * @return True caso a senha inserida confere com a senha cadastrada do banco, false caso contrário
    */
    public function autenticarUsuario($cpf, $senha){
      try{
        $hash = $this->buscarUsuario($cpf);
        return Criptografar::check($senha, $hash->getSenha());
      } catch (Excepetion $e){
        return false;
      }
    }

    /**
    * Método que autentica um Usuario no banco de dados utilizado md5
    * @param $cpf - Cpf do usuário que deseja-se autenticar
    * @param $senha - Senha do usuário que deseja-se autenticar
    * @return True caso a senha inserida confere com a senha cadastrada do banco, false caso contrário
    */
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

    /**
    * Método que modifica as informações de um Usuario no banco de dados
    * @param $usuario - Objeto do tipo Usuario contendo todas as informações que deseja-se ser modificada no banco de dados
    * @return Se conseguiu executar o script de edição
    */
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

    /**
    * Método que edita a senha de um usuário usando criptografia bcrypt
    * @param $senha - Nova Senha do usuário que deseja-se editar
    * @param $cpf - Cpf do usuário que deseja-se editar a senha
    * @return Se conseguiu executar o script de edição de senha
    */
    public function editarSenha($senha, $cpf){
      try{
        $sql = Sql::getInstance()->editarSenhaSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1, Criptografar::hash($senha));
        $stmt->bindParam(2, $cpf);

        $stmt->execute();
      }catch (Excepetion $e){
        return false;
      }
    }

    /**
    * Método que edita a senha de um usuário usando md5
    * @param $senha - Nova Senha do usuário que deseja-se editar
    * @param $cpf - Cpf do usuário que deseja-se editar a senha
    * @return Se conseguiu executar o script de edição de senha
    */
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

    /**
    * Método que deleta um usuário do banco
    * @param $cpf - Cpf do usuário que deseja-se deletar
    * @return True se o usuário com o cpf indicado ainda está no banco após a operação, False caso contrário
    */
    public function deletarUsuario($cpf){
      try {
        $sql = Sql::getInstance()->deletarUsuarioSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1, $cpf);
        $stmt->execute();

        // Verfica
        $sql = Sql::getInstance()->buscarUsuarioSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$cpf);
        $stmt->execute();
        return !($stmt->rowCount() >= 0);

      } catch (Exception $e) {
        return false;
      }
    }
    /**
    * Método que Bloqueia um usuário, adicionando essa informação no banco
    * @param $cpf - Cpf do usuário que deseja-se bloquear
    * @param $data - Data em que o usuário foi bloqueado
    */
    public function bloquearUsuario($cpf, $data){
      try{
        $sql = Sql::getInstance()->bloquearUsuarioSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1, $data);
        $stmt->bindParam(2, $cpf);
        $stmt->execute();

      } catch (Exception $e) {

      }
    }

    /**
    * Método que Desbloqueia um usuário, adicionando essa informação no banco
    * @param $cpf - Cpf do usuário que deseja-se desbloquear
    */
    public function desbloquearUsuario($cpf){
      try{
        $sql = Sql::getInstance()->desbloquearUsuarioSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1, $cpf);
        $stmt->execute();
      } catch (Exception $e) {

      }
    }

    /**
    * Método que verifica se um cpf ou email já está sendo usado, se estiver sendo usado, retorna True
    * @param $cpf - Cpf do usuário que deseja-se verificar
    * @param $email - Email do usuário que deseja-se verificar
    * @return True se o email ou cpf já foram utilizados, false caso contrário
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
        return false;
      }
      return false;
    }

    /**
    * Método que lista todos os usuários cadastrados no banco para questão de verificação pelo adm
    * @return Lista de objetos do tipo Usuario contendo informações de todos os usuários cadastrados no banco
    **/
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
        return false;
      }
    }

    /**
    * Método que lista todos os usuários bloqueados no banco para questão de verificação pelo adm
    * @return Lista de objetos do tipo Usuario contendo informações de todos os usuários bloqueados no banco
    **/
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
        return false;
      }
    }
  }
  ?>
