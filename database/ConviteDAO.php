<?php
require_once('../model/convite.php');
require_once('ConexaoDB.php');
require_once("Sql.php");

/**
*
*/
class ConviteDao
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new ConviteDAO();
    return self::$instance;
  }


  private function popularConvite($row){
    return new Convite($row['cpf'],
                       $row['codconvidado'],
                       $row['idcampanha'],
                       $row['data']);
  }


  public function adicionarConvite($convite){

    try{
      $sql = Sql::getInstance()->adicionarConviteSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$convite->getIdCampanha());
      $stmt->bindParam(2,$convite->getCodConvidado());
      $stmt->bindParam(3,$convite->getData());
      $stmt->bindParam(4,$convite->getCpfEmissor());

      $stmt->execute();

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }

  public function buscarConvitesCampanha($idCampanha){

    try{
      $sql = Sql::getInstance()->buscarConvitesCampanhaPorIdSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();
      $arrayConvites = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $convite = $this->popularConvite($row);
        $arrayConvites [] = $convite;
      }

      return $arrayConvites;
    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }


  public function buscarConvitesUsuario($cpfConvidador){
    try{
      $sql = Sql::getInstance()->buscarConvitesCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpfConvidador);
      $stmt->execute();
      $arrayConvites = array();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $convite = $this->popularConvite($row);
        $arrayConvites [] = $convite;
      }
      return $arrayConvites;
    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function listarConvites(){
    try{
      $sql = Sql::getInstance()->listarConvitesSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->execute();
      $arrayConvites = array();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $convite = $this->popularConvite($row);
        $arrayConvites[] = $convite;
      }
      return $arrayConvites;
    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }
}
?>
