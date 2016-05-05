<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/MaterialDoado.php");
require_once('ConexaoDB.php');
require_once("Sql.php");


/**
*Classe MaterialDAO
* Classe referente a manipulação de um material no banco de dados
*/
class MaterialDAO
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new MaterialDAO();
    return self::$instance;
  }

  /** Método responsável por adicionar um material
  * @param $material informações do material a ser adicionado
  * @return retorna o id do material que foi adicionado
  */
  public function adicionarMaterial($material){
    //Verifica se não tem um material com o mesmo nome
    try {
      $sql = Sql::getInstance()->adicionarMaterialSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $material->getNome());
      $stmt->bindParam(2, $material->getMedida());
      $stmt->execute();

      return ConexaoDB::getConexaoPDO()->lastInsertId('BoaIniciativa.material_codmaterial_seq');

    }catch (Exception $e){

    }
  }

  /** Método responsável por remover um material
  * @param $codMaterial codigo do material a ser removido
  */
  public function removerMaterial($codMaterial){
    try{
      $sql = Sql::getInstance()->removerMaterialSQL();
      $p_sql = ConexaoDB::getConexaoPDO()->prepare($sql);
      $p_sql->bindParam(1, $codMaterial);
      $p_sql->execute();
    }catch (Exception $e){

    }
  }
  /** Método responsável pela personificação das informações da tabela material como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  public function popularMaterial($linha){
    return new Material( $linha['nome'], $linha['medida'], $linha['codmaterial']);
  }

  /** Método responsável por buscar um material
  * @param $codMaterial codigo do material a ser buscado
  * @return informações do material buscado
  */
  public function buscarMaterial($codMaterial){
    try{
      $sql = Sql::getInstance()->buscarMaterialSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $codMaterial);
      $stmt->execute();
      $mat = $this->popularMaterial($stmt->fetch(PDO::FETCH_ASSOC));
      return $mat;
    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar um material por um nome
  * @param $nome nome do material a ser buscado
  * @return informações do material buscado
  */
  public function buscarMaterialNome($nome){
    try{
      $sql = Sql::getInstance()->buscarMaterialNomeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nome);
      $stmt->execute();
      return $this->popularMaterial($stmt->fetch(PDO::FETCH_ASSOC));
    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar o código de um material por um nome
  * @param $nome nome do material a ser buscado
  * @return código do material buscado
  */
  public function buscarCodMaterial($nome){
    try{
      $sql = Sql::getInstance()->buscarCodMaterialSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nome);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row['codmaterial'];

    }catch (Exception $e){

    }
  }


  /** Método responsável por listar todos os materiais
  * @return lista com os materiais
  */
  public function listarMateriais(){
    try{
      $sql = Sql::getInstance()->listarMateriaisSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->execute();
      $listaMateriais = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $material = $this->popularMaterial($row);
        $listaMateriais[] = $material;
      }
      return $listaMateriais;
    } catch (Exception $e){

    }
  }

  /** Método responsável por verificar um material
  * @param $nome nome do material a ser buscado
  * @return verifica se foi encontrado algum material
  */
  public function verificaMaterial($nome){
    try{
      $sql = Sql::getInstance()->buscarMaterialNomeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nome);
      $stmt->execute();
      return ($stmt->rowCount() > 0);
    } catch (Exception $e){

    }
  }
}
?>
