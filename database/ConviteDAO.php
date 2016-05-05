<?php
require_once('../model/convite.php');
require_once('ConexaoDB.php');
require_once("Sql.php");

/**
*Classe ConviteDAO
* Classe referente a manipulação de um convite no banco de dados
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


  /** Método responsável pela personificação das informações da tabela convite como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  private function popularConvite($row){
    return new Convite($row['cpf'],
                       $row['codconvidado'],
                       $row['idcampanha'],
                       $row['data']);
  }


  /** Método responsável por adicionar um convite
  * @param $convite informações do convite a ser adicionado
  * @return retorna o id do convidado adicionado
  */
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

    }

  }

  /** Método responsável por buscar convites de uma determinada campanha
  * @param $idCampanha id da campanha
  * @return retorna uma lista de convites
  */
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

    }
  }


  /** Método responsável por buscar convites de um usuário
  * @param $cpfConvidador cpf do usuário
  * @return retorna uma lista de convites
  */
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

    }
  }

  /** Método responsável por listar convites
  * @return retorna uma lista de convites
  */
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

    }
  }
}
?>
