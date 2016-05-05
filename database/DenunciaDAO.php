<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Denuncia.php");
require_once('ConexaoDB.php');
require_once("Sql.php");
/**
*Classe DenunciaDAO
* Classe referente a manipulação de uma denúncia no banco de dados
*/
class DenunciaDao
{
  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new DenunciaDAO();
    return self::$instance;
  }

  /** Método responsável pela personificação das informações da tabela denúncia como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  public function popularDenuncia($row){
    $denuncia =  new Denuncia($row['coddenuncia'], $row['idcampanha'], $row['motivo'], $row['descricao'], $row['cpf']);
    return $denuncia;
  }

  /** Método responsável por adicionar uma denúncia
  * @param $denuncia informações da denúncia a ser adicionado
  * @return retorna o id da denúncia adicionado
  */
  public function adicionarDenuncia($denuncia){
    if(!$this->verificaDenunciaCadastrada($denuncia->getCpfUsuario(), $denuncia->getIdCampanha())) {
      try{
        $sql = Sql::getInstance()->adicionarDenunciaSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$denuncia->getIdCampanha());
        $stmt->bindParam(2,$denuncia->getMotivo());
        $stmt->bindParam(3,$denuncia->getDescricao());
        $stmt->bindParam(4,$denuncia->getCpfUsuario());
        $stmt->execute();
        $id = ConexaoDB::getConexaoPDO()->lastInsertId('BoaIniciativa.denuncia_coddenuncia_seq');
        return $id;
      }catch (Exception $e){

      }
    }else{
      echo "<br>Este usuário já realizou uma denúncia para estar campanha!<br>";
    }
  }

  /** Método responsável por listar uma denúncia
  * @return retorna uma lista de denúncia
  */
  public function listarDenuncias(){
    try{
      $sql = Sql::getInstance()->listarDenunciasSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->execute();
      $listaDenuncia = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $listaDenuncia[] = $this->popularDenuncia($row);
      }
      return $listaDenuncia;
    } catch (Exception $e){
      echo '<br> Erro: Código: ' . $e->getCode() . " Mensagem: " . $e->getMessage();
    }
  }


  /** Método responsável por remover denúncias de um usuário
  * @param $cpf cpf do usuário
  */
  public function removerDenunciasCPF($cpf){
    try {
      $sql = Sql::getInstance()->removerDenunciasCpfSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $cpf);
      $stmt->execute();
    } catch (Exception $e) {

    }
  }

  /** Método responsável por buscar denúncias
  * @param $cpfUsuario cpf do usuário
  * @param $idCampanha id da campanha
  */
  public function buscarDenuncia($cpfUsuario, $idCampanha){
    try{
      $sql = Sql::getInstance()->buscarDenunciaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpfUsuario);
      $stmt->bindParam(2,$idCampanha);
      $stmt->execute();
      return $this->popularDenuncia($stmt->fetch(PDO::FETCH_ASSOC));
    } catch (Exception $e){

    }
  }

  /** Método responsável por buscar denúncias efetuadas
  * @param $cpfUsuario cpf do usuário
  * @return lista de denúncias
  */
  public function buscarDenunciasEfetuadas($cpfUsuario){
    try{
      $sql = Sql::getInstance()->buscarDenunciasEfetuadasSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpfUsuario);
      $stmt->execute();

      $arrayDenunciasCpf = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $arrayDenunciasCpf[] = $this->popularDenuncia($row);
      }

      return $arrayDenunciasCpf;

    } catch (Exception $e){

    }
  }

  /** Método responsável por buscar denúncias de uma campanha
  * @param $idCampanha id da campanha que se deseja buscar as denúncias
  * @return lista de denúncias
  */
  public function buscarDenunciasPorIdCampanha($idCampanha){
    try{
      $sql = Sql::getInstance()->buscarDenunciasCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();
      if($stmt->rowCount()==0){
        return null;
      }
      $arrayDenunciasIdCampanha = array();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $arrayDenunciasIdCampanha[] = $this->popularDenuncia($row);
      }

      return $arrayDenunciasIdCampanha;
    } catch (Exception $e){

    }
  }

  /** Método responsável por verificar uma denúncias
  * @param $cpf cpf do usuário que fez as denúncias
  * @param $idCampanha id da campanha que se deseja buscar as denúncias
  * @return se o script do banco de dados roudou corretamente
  */
  public function verificaDenunciaCadastrada($cpf, $idCampanha){
    try{
      $sql = Sql::getInstance()->verificaDenunciaCadastradaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $cpf);
      $stmt->bindParam(2, $idCampanha);
      $stmt->execute();
      return ($stmt->rowCount() > 0);

    } catch (Excepetion $e){

    }
    return FALSE;
  }


}

?>
