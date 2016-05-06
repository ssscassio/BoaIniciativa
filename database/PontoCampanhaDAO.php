<?php
require_once("Sql.php");
require_once('ConexaoDB.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Ponto.php");

/**
*Classe PontoDAO
* Classe referente a manipulação de um ponto de coleta no banco de dados
*/
class PontoDAO
{
  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new PontoDAO();
    return self::$instance;
  }

  /** Método responsável pela personificação das informações da tabela ponto como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  private function popularPonto($row){
    $ponto = new Ponto($row['cep'],$row['estado'],$row['bairro'],$row['cidade'],$row['logradouro'],$row['numero'],$row['complemento']);
    $ponto->setIdPonto((int) $row['idponto']);
    $ponto->setLatitude($row['latitude']);
    $ponto->setLongitude($row['longitude']);
    return $ponto;
  }

  /** Método responsável por adicionar um ponto
  * @param $ponto informações do ponto a ser adicionado
  * @return retorna o id do ponto que foi adicionado
  */
  public function adicionarPonto($ponto){
    try{
      $sql = Sql::getInstance()->adicionarPontoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$ponto->getCEP());
      $stmt->bindParam(2,$ponto->getEstado());
      $stmt->bindParam(3,$ponto->getBairro());
      $stmt->bindParam(4,$ponto->getCidade());
      $stmt->bindParam(5,$ponto->getLogradouro());
      $stmt->bindParam(6,$ponto->getNumero());
      $stmt->bindParam(7,$ponto->getComplemento());
      $stmt->bindParam(8,$ponto->getLatitude());
      $stmt->bindParam(9,$ponto->getLongitude());

      $stmt->execute();
      
      return ConexaoDB::getConexaoPDO()->lastInsertId("BoaIniciativa.ponto_idponto_seq");

    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar pontos em determinada cidade
  * @param $cidade informações da cidade a ser buscada
  * @return retorna uma lista de pontos
  */
  public function buscarPontoCidade($cidade){
    try{
      $sql = Sql::getInstance()->buscarPontoCidadeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cidade);
      $stmt->execute();

      $listaPontosCidade = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ponto = $this->popularPonto($row);
        $listaPontosCidade[] = $ponto;
      }
      return $listaPontosCidade;
    } catch (Exception $e){

    }


  }

  /** Método responsável por buscar pontos em determinada região
  * @param $CEP informações da região a ser buscada
  * @return retorna uma lista de pontos
  */
  public function buscarPontoRegiao($CEP){
    try{
      $sql = Sql::getInstance()->buscarPontoRegiaoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$CEP);
      $stmt->execute();
      $listaPontosRegiao = array();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ponto = $this->popularPonto($row);
        $listaPontosRegiao[] = $ponto;
      }

      return $listaPontosRegiao;
    } catch (Exception $e){

    }
  }

  /** Método responsável por buscar um ponto
  * @param $idPonto identificador do ponto a ser buscado
  */
  public function buscarPontoColeta($idPonto){
    try{
      $sql = Sql::getInstance()->buscarPontoColetaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idPonto);
      $stmt->execute();
      return $this->popularPonto($stmt->fetch(PDO::FETCH_ASSOC));
    } catch (Exception $e){

    }
  }


  /** Método responsável por deletar um ponto
  * @param $idPonto identificador do ponto a ser excluido
  */
  public function deletarPonto($idPonto){
    try{
      $sql = Sql::getInstance()->deletarPontoColetaSQL();
      $p_sql = ConexaoDB::getConexaoPDO()->prepare($sql);
      $p_sql->bindParam(1, $idPonto);
      $p_sql->execute();
    }catch (Exception $e){

    }
  }


  /** Método responsável por verificar um ponto
  * @param $ponto informações do ponto a ser verificado
  * @return booleano se o ponto em questão já está cadastrado ou não
  */
  public function verificaPontoCadastrado($ponto){
    try{
      $sql = Sql::getInstance()->verificarPontoCadastradoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$ponto->getCEP());
      $stmt->bindParam(2,$ponto->getEstado());
      $stmt->bindParam(3,$ponto->getBairro());
      $stmt->bindParam(4,$ponto->getCidade());
      $stmt->bindParam(5,$ponto->getLogradouro());
      $stmt->bindParam(6,$ponto->getNumero());
      $stmt->bindParam(7,$ponto->getComplemento());
      $stmt->execute();
      if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['idponto'];
      } //True = ponto já cadastrado
      else{
        return 0;
      }
    } catch (Excepetion $e){

    }
    return FALSE;
  }


}

?>
