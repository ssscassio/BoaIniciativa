<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."model/Doacao.php");
require_once("ConexaoDB.php");
require_once("Sql.php");
require_once("MaterialDAO.php");

/**
* Classe referente a Personificação da Doação Material do Banco de Dados
*/
class DoacaoMaterialDAO{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new DoacaoMaterialDAO();
    return self::$instance;
  }


  public function adicionarMaterialDoacao($idDoacao,$codMaterial,$quantidade){
    try {
      $sql = Sql::getInstance()->adicionarMaterialDoacaoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $idDoacao);
      $stmt->bindParam(2, $codMaterial);
      $stmt->bindParam(3, $quantidade);

      $stmt->execute();
    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function listarMateriaisDaDoacao($idDocao){
    try{
      $sql = Sql::getInstance()->listarMateriaisDaDoacaoSQL();
      $stmt =ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idDocao);
      $stmt->execute();

      if($stmt->rowCount()==0){
        return null;
      }

      $arrayMateriais = array();

      while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        $material = MaterialDAO::getInstance()->buscarMaterial($linha['codmaterial']);
        $materialDoado = new MaterialDoado($material, $linha['quantidade']);
        $arrayMateriais[]= $materialDoado;
      }

      return $arrayMateriais;

    } catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }



  public function removerMaterialDoacao($doacaoId, $codMaterial){
    try {
      $sql = Sql::getInstance()->removerMaterialDoacaoSQL();
      $p_sql = ConexaoDB::getConexaoPDO()->prepare($sql);
      $p_sql->bindParam(1, $doacaoId);
      $p_sql->bindParam(2, $codMaterial);

      return $p_sql->execute();
    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }
}
?>
