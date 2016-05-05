<?php
require_once('ConexaoDB.php');
require_once("Sql.php");
require_once('../model/Convidado.php');

/**
*Classe ConvidadoDAO
* Classe referente a manipulação de um convidado no banco de dados
*/
class ConvidadoDAO{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new ConvidadoDAO();
    return self::$instance;
  }

  private function popularConvidado($row){
    return new Convidado($row['email'], $row['classificacao'], $row['codconvidado']);
  }

  /** Método responsável por buscar um convidado pelo seu email
  * @param $email email do convidado a ser buscado
  * @return retorna informações do convidado buscado
  */
  public function buscarConvidadoPorEmail($email){
    try{
      $sql = Sql::getInstance()->buscarConvidadoPorEmailSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$email);
      $stmt->execute();
      return $this->popularConvidado($stmt->fetch(PDO::FETCH_ASSOC));

    } catch (Exception $e){

    }
  }

  /** Método responsável por adicionar um convidado
  * @param $convidado informações do convidado a ser adicionado
  * @return retorna o id do convidado adicionado
  */
  public function adicionarConvidado ($convidado){
    try{
      $sql = Sql::getInstance()->adicionarConvidadoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$convidado->getEmail());
      $stmt->bindParam(2,$convidado->getClassificacao());
      $stmt->execute();
      return ConexaoDB::getConexaoPDO()->lastInsertId('BoaIniciativa.convidado_codconvidado_seq');

    }catch (Exception $e){

    }
  }


  public function buscarEmailConvidado($codConvidado){
    try{
      $sql = Sql::getInstance()->buscarEmailConvidadoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$codConvidado);
      $stmt->execute();
      return $this->popularConvidado($stmt->fetch(PDO::FETCH_ASSOC));

    } catch (Exception $e){

    }
  }

  /** Método responsável verificar um convidado cadastrado
  * @param $email email do convidado
  * @return true caso o email seja de um usuário que já foi convidado
  */
  public function verificaConvidadoCadastrado($email){
    try{
      $sql = Sql::getInstance()->verificarConvidadoCadastradoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$email);
      $stmt->execute();
      return ($stmt->rowCount() > 0); //True = email já utilizado, False = cadastro liberado

    } catch (Excepetion $e){

    }
    return FALSE;
  }

}
?>
