<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Ponto.php");
require_once("CampanhaDAO.php");
require_once("Sql.php");
require_once("PontoDAO.php");
require_once('ConexaoDB.php');

/**
*Classe PontoCampanhaDAO
* Classe referente a manipulação de um ponto de coleta associado a uma campanha no banco de dados
*/
class PontoCampanhaDAO
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new PontoCampanhaDAO();
    return self::$instance;
  }

  /** Método responsável por adicionar uma campanha a um ponto
  * @param $idponto codigo identificador do ponto
  * @param $idcampanha codigo identificador da campanha
  */
  public function adicionarCampanhaPonto($idponto,$idcampanha){
    try{
      $sql = Sql::getInstance()->adicionarCampanhaPontoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idponto);
      $stmt->bindParam(2,$idcampanha);
      $stmt->execute();

    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar pontos de uma campanha
  * @param $idcampanha codigo identificador da campanha
  * @return retorna uma lista de pontos
  */
  public function buscarPontosCampanha($idCampanha){
    try{
      $sql = Sql::getInstance()->buscarPontosCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();
      $arrayPontos = array();
      $pontoDao = new PontoDAO();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ponto = $pontoDao->buscarPontoColeta($row["idponto"]);
        $arrayPontos[] = $ponto;
      }
      return $arrayPontos;
    } catch (Exception $e){

    }
  }


  /** Método responsável por buscar campanhas de um ponto
  * @param $idponto codigo identificador do ponto
  * @return retorna uma lista de campanhas
  */
  public function buscarCampanhaPonto($idPonto){
    try{
      $sql = Sql::getInstance()->buscarCampanhaPontoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idPonto);
      $stmt->execute();
      $arrayCampanhas = array();
      $campanhaDAO = new CampanhaDAO();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $campanha = $campanhaDAO->buscarCampanha($row["idcampanha"]);
        $arrayCampanhas[] =$campanha;
      }
      return $arrayCampanhas;
    } catch (Exception $e){

    }
  }



}

?>
