<?php

require_once("../model/CampanhaTag.php");
require_once("CampanhaDAO.php");
require_once("Sql.php");
/**
* Classe que manipula os dados que relacionam uma campanha a uma TAG
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


  public function associarCampanhaTag($idTag, $idCampanha){
    if(!$this->verificarTagCampanha($idTag, $idCampanha)){

      try{
        $sql = Sql::getInstance()->associarCampanhaTagSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$idCampanha);
        $stmt->bindParam(2,$idTag);
        $stmt->execute();
      }catch (Exception $e){
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }else{
      echo "Campanha já associada a esta tag";
    }
  }

  public function verificarTagCampanha($idTag,$idCampanha){
    try{
      $sql = Sql::getInstance()->verificarTagCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->bindParam(2,$idTag);
      $stmt->execute();
      return ($stmt->rowCount() > 0);

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }
  /*
  metodo para verificar total de campanhas de uma tag para esquematizacao da pesquisa de uma campanha
  por tags
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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function popularTagCampanha($row){

    return new CampanhaTag($row['idcampanha'],$row['idtag']);

  }

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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }
}
?>
