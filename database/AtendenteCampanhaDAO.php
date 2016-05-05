<?php

require_once('ConexaoDB.php');
require_once("Sql.php");
require_once('CampanhaDAO.php');
require_once('UsuarioDAO.php');
/**
*Classe AtendenteCampanhaDAO
* Classe referente a manipulação de um administrador no banco de dados
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


  /** Método responsável por deletar um convite de ser atendente em uma campanha
  * @param $cpfAtendente cpf do atendente
  * @param $idCampanha identificador da campanha
  */
  public function deletarAtendente ($cpfAtendente, $idCampanha){
    try {
      $sql = Sql::getInstance()->deletarAtendenteCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $idCampanha);
      $stmt->bindParam(2, $cpfAtendente);
      $stmt->execute();
    } catch (Exception $e) {

    }
  }

  /** Método responsável por autenticar um atendente em uma campanha
  * @param $cpf cpf do atendente
  * @param $idCampanha identificador da campanha
  * @return retorna se o atendente foi autenticado ou não
  */
  public function autenticarAtendente($cpf, $idCampanha){
    try {
      $sql = Sql::getInstance()->autenticarAtendenteSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $cpf);
      $stmt->bindParam(2, $idCampanha);
      $stmt->execute();
      return ($stmt->rowCount() > 0);
    } catch (Exception $e) {

    }
  }


  /** Método responsável por listar convites para um usuario ser atendente em determinada campanha
  * @param $usuarioCpf cpf do usuário
  * @return retorna uma lista de campanhas
  */
  public function listarConfirmacoesPendentes($usuarioCpf){
    try{
      $sql = Sql::getInstance()->listarConfirmacoesPendentesSQL();
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

    }
  }

  /** Método responsável por confirmar a participação de um atendente em determinada campanha
  * @param $usuarioCpf cpf do usuário
  * @param $idCampanha id de uma campanha
  * @return retorna se o script do banco foi rodado corretamente
  */
  public function confirmarParticipacaoAtendente($usuarioCpf, $idCampanha){
    try {
      $sql = Sql::getInstance()->aceitarConviteSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$usuarioCpf);
      $stmt->bindParam(2,$idCampanha);
      return $stmt->execute();

    } catch (Exception $e) {

    }
  }

  /** Método responsável por cancelar a participação de um atendente em determinada campanha
  * @param $usuarioCpf cpf do usuário
  * @param $idCampanha id de uma campanha
  * @return retorna se o script do banco foi rodado corretamente
  */
  public function cancelarParticipacaoAtendente($usuarioCpf, $idCampanha){
    try {
      $sql = Sql::getInstance()->cancelarConviteSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$usuarioCpf);
      $stmt->bindParam(2,$idCampanha);
      return $stmt->execute();

    } catch (Exception $e) {

    }
  }

  /** Método responsável por listar campanhas de um determinado atendente
  * @param $usuarioCpf cpf do usuário
  * @return retorna uma lista de campanhas
  */
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

    }
  }

  /** Método responsável por listar atendentes de um determinado campanha
  * @param $idCampanha id de uma campanha
  * @return retorna uma lista de atendentes
  */
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

    }

  }

  /** Método responsável por adicionar um atendentes em determinado campanha
  * @param $idCampanha id de uma campanha
  * @param $CpfAtendente cpf de um usuário
  * @return retorna um booleado que indica se o usuário foi adicionado ou não
  */
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

    }

  }

}

?>
