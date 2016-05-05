<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/CampanhaTag.php");
require_once("CampanhaDAO.php");
require_once("Sql.php");
/**
*Classe TagCampanhaDAO
* Classe referente a manipulação da tag de uma campanha no banco de dados
*/
class TagCampanhaDAO
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new TagCampanhaDAO();
    return self::$instance;
  }

  /** Método responsável por associar uma campanha a uma tag
  * @param $idTag identificador da tag
  * @param $idCampanha identificador da campanha
  */
  public function associarCampanhaTag($idTag, $idCampanha){
    if(!$this->verificarTagCampanha($idTag, $idCampanha)){

      try{
        $sql = Sql::getInstance()->associarCampanhaTagSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$idCampanha);
        $stmt->bindParam(2,$idTag);
        $stmt->execute();
      }catch (Exception $e){

      }
    }else{
      echo "Campanha já associada a esta tag";
    }
  }

  /** Método responsável por verificar a tag de uma campanha
  * @param $idTag identificador da tag
  * @param $idCampanha identificador da campanha
  * @return verifica se a busca retornou algum objeto
  */
  public function verificarTagCampanha($idTag,$idCampanha){
    try{
      $sql = Sql::getInstance()->verificarTagCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->bindParam(2,$idTag);
      $stmt->execute();
      return ($stmt->rowCount() > 0);

    }catch (Exception $e){

    }

  }

  /** Método responsável por buscar uma determinada quantidade de campanhas de uma tag
  * @param $nome da tag
  * @param $inicio início da pesquisa
  * @param $totalPorPagina total de campanhas que devem ter por pagina
  * @return retorna uma lista de campanhas
  */
  public function buscarCampanhasPorTagLimite($nome, $inicio, $totalPorPagina){
    try{
      $sql = Sql::getInstance()->buscarCampanhasPorTagLimiteSQL($inicio, $totalPorPagina);
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nome);
      $stmt->bindParam(2, $inicio);
      $stmt->bindParam(3, $totalPorPagina);
      $stmt->execute();
      $campanhas = array();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $campanha = CampanhaDAO::getInstance()->buscarCampanha($row['idcampanha']);
        $campanhas[] = $campanha;
      }
      return $campanhas;
    } catch (Exception $e){

    }
  }

  /** Método responsável por buscar uma campanhas por uma tag
  * @param $idTag identificador da tag
  * @return retorna uma lista de campanhas
  */
  public function buscarCampanhasPorTag($idTag){
    try{
      $sql = Sql::getInstance()->buscarCampanhasPorTagSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idTag);
      $stmt->execute();
      $campanhas = array();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $campanha = CampanhaDAO::getInstance()->buscarCampanha($row['idcampanha']);
        $campanhas[] = $campanha;
      }
      return $campanhas;
    } catch (Exception $e){

    }
  }

  /** Método responsável pela personificação das informações da tabela tagCampanha como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  public function popularTagCampanha($row){

    return new CampanhaTag($row['idcampanha'],$row['idtag']);

  }

  /** Método responsável por buscar tags de uma campanha
  * @param $idCampanha identificador da campanha
  * @return retorna uma lista de tag
  */
  public function buscarTagsDaCampanha($idCampanha){
    try{
      $sql = Sql::getInstance()->buscarTagsDaCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();
      $tags = array();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tag = TagDAO::getInstance()->buscarTagId($row['idtag']);
        $tags[] = $tag;
      }
      return $tags;
    }catch (Exception $e){

    }
  }
}
?>
