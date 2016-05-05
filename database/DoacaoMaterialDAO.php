<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Doacao.php");
require_once("ConexaoDB.php");
require_once("Sql.php");
require_once("MaterialDAO.php");


/**
*Classe DoacaoMaterialDAO
* Classe referente a manipulação de uma doação material no banco de dados
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

  /** Método responsável por adicionar um material a uma doação
  * @param $idDoacao id da doação
  * @param $codMaterial código do material
  * @param $quantidade quantidade do material a ser adicionado
  */
  public function adicionarMaterialDoacao($idDoacao,$codMaterial,$quantidade){
    try {
      $sql = Sql::getInstance()->adicionarMaterialDoacaoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $idDoacao);
      $stmt->bindParam(2, $codMaterial);
      $stmt->bindParam(3, $quantidade);

      $stmt->execute();
    } catch (Exception $e){

    }
  }

  /** Método responsável por listar os materiais de uma doação
  * @param $idDoacao id da doação
  * @return retorna uma lista de materiais
  */
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

    }

  }


  /** Método responsável por remover os materiais de uma doação
  * @param $doacaoId id da doação
  * @param $codMaterial material a ser removido
  * @return verifica se o script do banco de dados rodou corretamente
  */
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
