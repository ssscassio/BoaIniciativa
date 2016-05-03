<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Tag.php");
require_once('ConexaoDB.php');
require_once("Sql.php");
/**
* Classe referente a manipulação da tabela Tag
*/
class TagDAO {

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new TagDAO();
    return self::$instance;
  }



  private function popularTag($row){
    $tag = new Tag( $row['idtag'],$row['nome']);
    return $tag;
  }

  public function adicionarTag($tag){
    try{
      $sql = Sql::getInstance()->adicionarTagSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$tag->getNome());
      $stmt->execute();
      return ConexaoDB::getConexaoPDO()->lastInsertId("BoaIniciativa.tag_idtag_seq");

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function verificarTag($nome){
    try{
      $sql = Sql::getInstance()->buscarTagNomeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$nome);
      $stmt->execute();

      return ($stmt->rowCount() > 0);

    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }


  public function removerTag($idTag){
    try{
      $sql = Sql::getInstance()->removerTagSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idTag);
      $stmt->execute();

    }catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  function listarTags(){
    try{
      $sql = Sql::getInstance()->listarTagsSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->execute();
      $tags = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tag = $this->popularTag($row);
        $tags[] = $tag;
      }
      return $tags;
    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  function buscarTagNome($nome){
    try{
      $sql = Sql::getInstance()->buscarTagNomeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$nome);
      $stmt->execute();

      return $this->popularTag($stmt->fetch(PDO::FETCH_ASSOC));
    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  /*
  Retorna a tag com o id passado como parâmetro
  **/
  function buscarTagId($idTag){
    try{
      $sql = Sql::getInstance()->buscarTagIdSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idTag);
      $stmt->execute();

      return $this->popularTag($stmt->fetch(PDO::FETCH_ASSOC));
    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }
}
?>;
