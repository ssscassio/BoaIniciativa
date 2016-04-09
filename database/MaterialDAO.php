<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/MaterialDoado.php");
require_once('ConexaoDB.php');
require_once("Sql.php");


/**
* Classe responsável pela manipulação da tabela de Material
*@author gordinh
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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function removerMaterial($codMaterial){
    try{
      $sql = Sql::getInstance()->removerMaterialSQL();
      $p_sql = ConexaoDB::getConexaoPDO()->prepare($sql);
      $p_sql->bindParam(1, $codMaterial);
      $p_sql->execute();
    }catch (Exception $e){
      echo "Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function popularMaterial($linha){
    return new Material( $linha['nome'], $linha['medida'], $linha['codmaterial']);
  }

  public function buscarMaterial($codMaterial){
    try{
      $sql = Sql::getInstance()->buscarMaterialSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $codMaterial);
      $stmt->execute();
      $mat = $this->popularMaterial($stmt->fetch(PDO::FETCH_ASSOC));
      return $mat;
    }catch (Exception $e){
      echo '<br> Erro: Código: ' . $e->getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function buscarMaterialNome($nome){
    try{
      $sql = Sql::getInstance()->buscarMaterialNomeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nome);
      $stmt->execute();
      return $this->popularMaterial($stmt->fetch(PDO::FETCH_ASSOC));
    }catch (Exception $e){
      echo '<br> Erro: Código: ' . $e->getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function buscarCodMaterial($nome){
    try{
      $sql = Sql::getInstance()->buscarCodMaterialSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nome);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row['codmaterial'];

    }catch (Exception $e){
      echo '<br> Erro: Código: ' . $e->getCode() . " Mensagem: " . $e->getMessage();
    }
  }



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
      echo '<br> Erro: Código: ' . $e->getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function verificaMaterial($nome){
    try{
      $sql = Sql::getInstance()->buscarMaterialNomeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nome);
      $stmt->execute();
      return ($stmt->rowCount() > 0);
    } catch (Exception $e){
      echo '<br> Erro: Código: ' . $e->getCode() . " Mensagem: " . $e->getMessage();
    }
  }
}
?>
