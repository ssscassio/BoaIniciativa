<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Campanha.php");
require_once('ConexaoDB.php');
require_once("Sql.php");

/**
* Classe referente ao acesso a tabela campanha no banco de dados
*/
class CampanhaDAO
{
  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new CampanhaDAO();
    return self::$instance;
  }

  public function adicionarCampanha($campanha){
    try{
      $sql = Sql::getInstance()->adicionarCampanhaSQL();

      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $campanha->getNome());
      $stmt->bindParam(2, $campanha->getDataInicio());
      $stmt->bindParam(3, $campanha->getDataFim());
      $stmt->bindParam(4, $campanha->getImagem());
      $stmt->bindParam(5, $campanha->getDescricao());
      $stmt->bindParam(6, $campanha->getTituloAgradecimento());
      $stmt->bindParam(7, $campanha->getAgradecimento());
      $stmt->bindParam(8, $campanha->getFinalizaPorData());
      $stmt->bindParam(9, $campanha->getCriadorDaCampanha());
      $stmt->execute();

      return ConexaoDB::getConexaoPDO()->lastInsertId('BoaIniciativa.campanha_idcampanha_seq');

    }catch (Exception $e){
      echo "<br> Exception: Codigo: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function buscarCampanha($idCampanha){
    try{
      $sql = Sql::getInstance()->buscarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();

      return $this->popularCampanha($stmt->fetch(PDO::FETCH_ASSOC));

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function buscarCampanhasDestaque($quantidade){
    try{
      $sql = Sql::getInstance()->buscarCampanhasDestaqueSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$quantidade);
      $stmt->execute();
      $listaCampanha = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $listaCampanha[] = CampanhaDAO::getInstance()->popularCampanha($row);
      }

      return $listaCampanha;
    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function buscarCampanhasAleatorias($quantidade){
  
    try{
      $sql = Sql::getInstance()->buscarCampanhasAleatoriasSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$quantidade);
      $stmt->execute();
      $listaCampanha = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $listaCampanha[] = CampanhaDAO::getInstance()->popularCampanha($row);
      }

      return $listaCampanha;
    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function buscarIdCampanha($nomeCampanha){
    try{
      return $this->procurarCampanha($nomeCampanha)->getIdCampanha();

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  private function popularCampanha($linha){
    $campanha = new Campanha ($linha['idcampanha'],$linha['nome'],$linha['descricao'],$linha['datainicio'],$linha['imagem'],
                              $linha['criadorcpf'],$linha['finalizapordata'],$linha['datafim']);
    $campanha->setTituloAgradecimento($linha['tituloagradecimento']);
    $campanha->setAgradecimento($linha['mensagemagradecimento']);
    $campanha->setValores(array($linha['valor1'], $linha['valor2'], $linha['valor3']));
    return $campanha;
  }

  public function procurarCampanha($nome){
    try{
      $sql = Sql::getInstance()->procurarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$nome);
      $stmt->execute();

      return $this->popularCampanha($stmt->fetch(PDO::FETCH_ASSOC));

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function procurarCampanhaNome($nome){
    try{
      $nome = strtolower($nome);
      $nome = "%".$nome."%"; //para a query de like
      $sql = Sql::getInstance()->procurarCampanhaNomeSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$nome);
      $stmt->execute();
      $listaCampanha = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $listaCampanha[] = $this->popularCampanha($row);
      }

      return $listaCampanha;
    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function editarCampanha($campanha){
    try{
      $sql = Sql::getInstance()->editarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $campanha->getNome());
      $stmt->bindParam(2, $campanha->getDataFim());
      $stmt->bindParam(3, $campanha->getDescricao());
      $stmt->bindParam(4, $campanha->getImagem());
      $stmt->bindParam(5, $campanha->getIdCampanha());
      $stmt->execute();


    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function encerrarCampanha($idCampanha, $data){
    try{
      $sql = Sql::getInstance()->encerrarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $data);
      $stmt->bindParam(2, $idCampanha);
      $stmt->execute();
    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function listarCampanhas(){
    try{
      $sql = Sql::getInstance()->listarCampanhasSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->execute();
      $listaCampanha = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $listaCampanha[] = $this->popularCampanha($row);
      }
      return $listaCampanha;
    } catch (Exception $e){
      echo '<br> Erro: Código: ' . $e->getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function buscarCampanhaPorCriador($cpfCriador){
    try{
      $sql = Sql::getInstance()->buscarCampanhaPorCriadorSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpfCriador);
      $stmt->execute();

      if($stmt->rowCount()==0){
        return null;
      }

      $arrayCampanhas = array();

      while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        $campanha = $this->popularCampanha($linha);
        $arrayCampanhas[]=$campanha;
      }

      return $arrayCampanhas;

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }



  public function verificaCampanhaCadastrada($nome){
    try{
      $sql = Sql::getInstance()->verificarCampanhaCadastradaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$nome);
      $stmt->execute();

      return ($stmt->rowCount() > 0);

    }catch (Exception $e){
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      return false;
    }
  }

  public function deletarCampanha($idCampanha){
    try {
      $sql = Sql::getInstance()->deletarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $idCampanha);
      $stmt->execute();

    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  public function deletarCampanhas($nomeCampanha){
    try{
      $sql = Sql::getInstance()->deletarMuitasCampanhasSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nomeCampanha);
      $stmt->execute();

    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

}


?>
