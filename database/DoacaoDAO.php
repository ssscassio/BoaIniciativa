<?php

require_once("UsuarioDAO.php");
require_once("DoacaoMaterialDAO.php");
require_once("Sql.php");

/**
*Classe DoacaoDAO
* Classe referente a manipulação de uma doação no banco de dados
*/
class DoacaoDAO
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new DoacaoDAO();
    return self::$instance;
  }

  /** Método responsável pela personificação das informações da tabela doação como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  public function popularDoacao($linha){
    $doacao =new Doacao($linha['iddoacao'],
    $linha['doadorcpf'],
    $linha['confirmado'],
    $linha['data'],
    $linha['idcampanha']);
    $doacao->setAtendente($linha['atendenteconfirma']);
    return $doacao;
  }

  /** Método responsável por buscar doações de uma campanha
  * @param $idCampanha id da campanha
  * @return retorna uma lista de doações
  */
  public function buscarDoacoesDaCampanha($idCampanha){
    try{
      $sql = Sql::getInstance()->buscarDoacoesDaCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();

      if($stmt->rowCount()==0){
        return null;
      }

      $arrayDoacoes = array();

      while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        $doacao = $this->popularDoacao($linha);
        $arrayDoacoes[] = $doacao;
      }

      return $arrayDoacoes;

    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar doações pelo id
  * @param $idDoacao id da doação
  * @return retorna uma lista de doações
  */
  public function buscarDoacaoPorId($idDoacao){
    try{
      $sql = Sql::getInstance()->buscarDoacaoPorIdSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idDoacao);
      $stmt->execute();

      if($stmt->rowCount()==0){
        return null;
      }

      return $this->popularDoacao($stmt->fetch(PDO::FETCH_ASSOC));

    }catch(Exception $e){

    }

  }

  /** Método responsável por adicionar uma doação
  * @param $doacao informações da doação a ser adicionada
  * @return retorna o id da doação que foi adicionada
  */
  public function adicionarDoacao($doacao){
    try{
      $sql = Sql::getInstance()->adicionarDoacaoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$doacao->getData());
      $stmt->bindParam(2,$doacao->getIdCampanha());
      $stmt->bindParam(3,$doacao->getCpfDoador());
      $stmt->execute();

      return (int)ConexaoDB::getConexaoPDO()->lastInsertId('BoaIniciativa.doacao_iddoacao_seq');

    } catch (Exception $e){

    }

  }

  /** Método responsável por editar uma doação
  * @param $doacao informações da doação a ser editada
  */
  public function editarDoacao($doacao){
    try{
      $sql = Sql::getInstance()->editarDoacaoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$doacao->getConfirmado());
      $stmt->bindParam(2,$doacao->getData());
      $stmt->bindParam(3,$doacao->getAtendente());
      $stmt->bindParam(4,$doacao->getIdDoacao());
      $stmt->execute();

    }catch (Excepetion $e){

    }
  }

  /** Método responsável por confirmar uma doação
  * @param $dataConfirmacao data de confirmação da doação
  * @param $cpfAtendente cpf do atendente que realizou a confirmação da doação
  * @param $idDoacao id da doação confirmada
  */
  public function confirmarDoacao( $dataConfirmacao, $cpfAtendente, $idDoacao){
    try {
      $confirmado = "TRUE";
      $sql = Sql::getInstance()->editarDoacaoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $confirmado);
      $stmt->bindParam(2,$dataConfirmacao);
      $stmt->bindParam(3,$cpfAtendente);
      $stmt->bindParam(4,$idDoacao);
      $stmt->execute();

    } catch (Exception $e) {

    }
  }

  /** Método responsável por buscar doações de um determinado doador
  * @param $doadorcpf cpf do doador
  * @return retorna uma lista de doações
  */
  public function buscarDoacoesDoDoador($doadorcpf){
    try{
      $sql = Sql::getInstance()->buscarDoacoesDoDoadorSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$doadorcpf);
      $stmt->execute();

      if($stmt->rowCount()==0){
        return null;
      }

      $arrayDoacoes = array();

      while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        $doacao = $this->popularDoacao($linha);
        $arrayDoacoes[] = $doacao;
      }

      return $arrayDoacoes;

    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar doações de um determinado atendente
  * @param $cpfAtendente cpf do atendente
  * @return retorna uma lista de doações
  */
  public function buscarDoacoesPorAtendente($cpfAtendente){
    try{
      $sql = Sql::getInstance()->buscarDoacoesPorAtendenteSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpfAtendente);
      $stmt->execute();

      if($stmt->rowCount()==0){
        return null;
      }

      $arrayDoacoes = array();

      while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        $doacao = $this->popularDoacao($linha);
        $arrayDoacoes[] = $doacao;
      }

      return $arrayDoacoes;

    }catch (Exception $e){

    }
  }

  /** Método responsável por excluir doaçõe
  * @param $idDoacao id da doação a ser excluida
  * @return retorna se a doação foi realmente adiciona ou não
  */
  public function excluirDoacao($idDoacao){
    try {
      $sql = Sql::getInstance()->excluirDoacao();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $idDoacao);
      $stmt->execute();

      $doacao = DoacaoDAO::getInstance()->buscarDoacaoPorId($idDoacao);
      return ($doacao->getIdDoacao() != null);
    } catch (Exception $e) {


    }
  }

  /** Método responsável por buscar doações de um usuário em uma campanha
  * @param $cpfUsuario cpf do usuario
  * @param $idCampanha id da campanha
  * @return retorna uma lista de doações
  */
  public function buscarDoacaoNaCampanha($cpfUsuario, $idCampanha){
    try {
      $sql = Sql::getInstance()->buscarDoacaoNaCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $cpfUsuario);
      $stmt->bindParam(2, $idCampanha);
      $stmt->execute();


      if($stmt->rowCount()==0){
        return null;
      }

      $arrayDoacoes = array();

      while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        $doacao = $this->popularDoacao($linha);
        $arrayDoacoes[] = $doacao;
      }

      return $arrayDoacoes;


    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }
}
?>
