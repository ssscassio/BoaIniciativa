<?php
require_once('ConexaoDB.php');
require_once("Sql.php");
require_once('../model/Convidado.php');

/**
* Classe que manipula os dados na tabela de Convidado
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

  public function buscarConvidadoPorEmail($email){
    try{
      $sql = Sql::getInstance()->buscarConvidadoPorEmailSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$email);
      $stmt->execute();
      return $this->popularConvidado($stmt->fetch(PDO::FETCH_ASSOC));

    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function adicionarConvidado ($convidado){
    try{
      $sql = Sql::getInstance()->adicionarConvidadoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$convidado->getEmail());
      $stmt->bindParam(2,$convidado->getClassificacao());
      $stmt->execute();
      return ConexaoDB::getConexaoPDO()->lastInsertId('BoaIniciativa.convidado_codconvidado_seq');

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function verificaConvidadoCadastrado($email){
    try{
      $sql = Sql::getInstance()->verificarConvidadoCadastradoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$email);
      $stmt->execute();
      return ($stmt->rowCount() > 0); //True = email já utilizado, False = cadastro liberado

    } catch (Excepetion $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
    return FALSE;
  }

}
?>
