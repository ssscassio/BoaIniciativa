<?php

require_once('ConexaoDB.php');
require_once("Sql.php");
require_once('CampanhaDAO.php');
require_once('UsuarioDAO.php');
/**
* Classe que manipula a tabela Que associa um atendente a uma Campanha
*/
class AtendenteCampanhaDAO {

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new AtendenteCampanhaDAO();
    return self::$instance;
  }


  //deleta um convite de ser atendente em uma campanha
  public function deletarAtendente ($cpfAtendente, $idCampanha){
    try {
      $sql = Sql::getInstance()->deletarAtendenteCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $idCampanha);
      $stmt->bindParam(2, $cpfAtendente);
      $stmt->execute();
    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function listarCampanhasAtendente($usuarioCpf){
    try{
      $sql = Sql::getInstance()->listarCampanhasAtendenteSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$usuarioCpf);
      $stmt->execute();

      if($stmt->rowCount()==0)
      return null;

      $arrayCampanhas = array();

      while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        $campanha = CampanhaDAO::getInstance()->buscarCampanha($linha['idcampanha']);
        $arrayCampanhas[]=$campanha;
      }

      return $arrayCampanhas;

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function listarAtendentesCampanha($idCampanha){

    try{
      $sql = Sql::getInstance()->listarAtendentesCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();

      if($stmt->rowCount()==0){
        return null;
      }

      $arrayAtendentes = array();

      while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        $atendente = UsuarioDAO::getInstance()->buscarUsuario($linha['cpfatendente']);
        $arrayAtendentes[]=$atendente;
      }

      return $arrayAtendentes;

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }

  public function adicionarAtendenteCampanha($idCampanha, $CpfAtendente){
    try{

      $sql = Sql::getInstance()->adicionarAtendenteCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $idCampanha);
      $stmt->bindParam(2, $CpfAtendente);

      $validar = ConexaoDB::getConexaoPDO()->prepare(Sql::getInstance()->validarAtendenteCampanhaSQL());
      $validar->bindParam(1,$idCampanha);
      $validar->bindParam(2,$CpfAtendente);
      $validar->execute();

      if($validar->errorCode() != "00000"){
        echo "Erro ao verificar existencia do atendente no Banco. Codigo Erro: ". $stmt->errorCode(). ":";
        return false;
      }

      if ($validar->rowCount()==0) {
        $stmt->execute();
        if($stmt->errorCode() != "00000"){
          echo "Erro ao Adicionar o Atendente no Banco. Codigo Erro: ". $stmt->errorCode(). ":";
          var_dump($stmt->errorInfo());
          return false;
        }
        return true;
      }
      else {
        echo "<br> Este usuario ja etende nesta campanha!<br>";
        return false;
      }

    }catch (Exception $e){
      echo "<br> Exception: Codigo: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }

}

?>
