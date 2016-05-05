<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Tag.php");
require_once('ConexaoDB.php');
require_once("Sql.php");

/**
* Classe TagDAO
* Classe que manipula a tabela Tag no Banco de Dados referente as Categorias das Campanhas
*/
class TagDAO {

  /** Instancia Singleton da classe*/
  private static $instance;

  public function __construct(){

  }

  /**
  * Método que define o padrão Singleton na classe
  */
  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new TagDAO();
    return self::$instance;
  }

  /**
  * Método responsável pela personificação das informações da tabela Tag como um objeto PHP
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo  Tag
  */
  private function popularTag($row){
    $tag = new Tag( $row['idtag'],$row['nome']);
    return $tag;
  }

  /**
  * Método que adiciona uma nova tag no banco de dados
  * @param $tag - Objeto do tipo Tag que contem o nome da Categoria a ser adicionada no banco
  * @return O código identificador da tag que acabou de ser registrada no banco
  */
  public function adicionarTag($tag){
    try{

      $sql = Sql::getInstance()->adicionarTagSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$tag->getNome());
      $stmt->execute();
      return ConexaoDB::getConexaoPDO()->lastInsertId("BoaIniciativa.tag_idtag_seq");

    }catch (Exception $e){

    }
  }

  /**
  * Método que verifica se uma Categoria já foi cadastrada no banco através de seu nome
  * @param $nome Nome da categoria que deseja-se verificar se o banco já possui
  * @return True se o nome da Tag já está cadastrado, false caso contrário.
  */
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

  /**
  * Método que Remove uma tag do banco de dados através de seu id
  * @param $idTag - Código Identificador da Categoria que deseja-se remover do Banco
  */
  public function removerTag($idTag){
    try{
      $sql = Sql::getInstance()->removerTagSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idTag);
      $stmt->execute();

    }catch (Exception $e) {

    }
  }

  /**
  * Método que lista todas as tags cadastradas no banco
  * @return Lista contendo Objetos do tipo Tag referentes a todas as tag cadastradas no banco
  */
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

    }
  }

  /**
  * Método que busca uma Tag pelo seu nome
  * @param $nome - Nome da tag que deseja-se buscar
  * @return Objeto de Tag referente ao resultado da busca do método
  */
  function buscarTagNome($nome){
    try{
      $sql = Sql::getInstance()->buscarTagNomeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$nome);
      $stmt->execute();

      return $this->popularTag($stmt->fetch(PDO::FETCH_ASSOC));
    } catch (Exception $e){
    }
  }

  /**
  * Método que Remove uma tag do banco de dados através de seu id
  * @param $idTag - Código Identificador da Categoria que deseja-se remover do Banco
  * @return Objeto de Tag referente ao resultado da busca do método
  */
  function buscarTagId($idTag){
    try{
      $sql = Sql::getInstance()->buscarTagIdSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idTag);
      $stmt->execute();

      return $this->popularTag($stmt->fetch(PDO::FETCH_ASSOC));
    }catch (Exception $e){

    }
  }
}
?>;
