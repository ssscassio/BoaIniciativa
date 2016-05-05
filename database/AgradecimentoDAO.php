<?php

require_once("Sql.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Agradecimento.php");

/**
*Classe AgradecimentoDAO
* Classe referente a manipulação de um administrador no banco de dados
*/
class AgradecimentoDAO
{
  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new AgradecimentoDAO();
    return self::$instance;
  }

  /** Método responsável pela personificação das informações da tabela Agradecimento como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  private function popularAgradecimento($row){
    $agradecimento = new Agradecimento($row['titulo'],
    $row['cpfusuario'],
    $row['mensagem'],
    $row['imagem'],
    $row['codcampanha']);
    $agradecimento->setIdAgradecimento($row['codagradecimento']);
    return $agradecimento;
  }

  /** Método responsável por adicionar um novo agradecimento
  * @param $agradecimento informações do agradecimento que deve ser cadastrado
  */
  public function adicionarAgradecimento($agradecimento){
    try{
      $sql = Sql::getInstance()->adicionarAgradecimentoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $agradecimento->getTitulo());
      $stmt->bindParam(2, $agradecimento->getMensagem());
      $stmt->bindParam(3, $agradecimento->getImagem());
      $stmt->bindParam(4, $agradecimento->getIdCampanha());
      $stmt->bindParam(5, $agradecimento->getCpfUsuario());
      $stmt->execute();
      return ConexaoDB::getConexaoPDO()->lastInsertId("BoaIniciativa.agradecimento_codagradecimento_seq");
    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar um agradecimento através de um usuário
  * @param $cpfUsuario cpf do usuário
  * @return uma lista de agradecimentos
  */
  public function buscarAgradecimentosUsuario($cpfUsuario){
    try{
      $agradecimentos = array();
      $sql = Sql::getInstance()->buscarAgradecimentosUsuarioSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpfUsuario);
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $agrad = $this->popularAgradecimento($row);
        $agradecimentos[] = $agrad;
      }
      return $agradecimentos;
    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar um agradecimento de uma campanha
  * @param $idCampanha id da campanha
  * @return uma lista de agradecimentos
  */
  public function buscarAgradecimentosCampanha($idCampanha){

    try{
      $agradecimentos = array();
      $sql = Sql::getInstance()->buscarAgradecimentosCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $agrad = $this->popularAgradecimento($row);
        $agradecimentos[] = $agrad;
      }
      return $agradecimentos;
    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar um agradecimento de um usuário de determinada campanha
  * @param $cpfUsuario cpf do usuário
  * @param $idCampanha id da campanha
  * @return uma lista de agradecimentos
  */
  public function buscarAgradecimento($cpfUsuario, $idCampanha){

    try{
      $agradecimentos = array();

      $sql = Sql::getInstance()->buscarAgradecimentoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpfUsuario);
      $stmt->bindParam(2,$idCampanha);
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $agrad = $this->popularAgradecimento($row);
        $agradecimentos[] = $agrad;
      }
      return $agradecimentos;
    }catch (Exception $e){

    }
  }
}

?>
