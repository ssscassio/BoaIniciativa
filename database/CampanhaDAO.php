<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Campanha.php");
require_once('ConexaoDB.php');
require_once("Sql.php");

/**
*Classe CampanhaDAO
* Classe referente a manipulação de uma campanha no banco de dados
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

  /** Método responsável por adicionar uma campanha
  * @param $campanha informações da campanha a ser adicionada
  * @return retorna o id da campanha inserida
  */
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
      $valores = $campanha->getValores();
      $stmt->bindParam(10,$valores[0]);
      $stmt->bindParam(11,$valores[1]);
      $stmt->bindParam(12,$valores[2]);

      $stmt->execute();

      return ConexaoDB::getConexaoPDO()->lastInsertId('BoaIniciativa.campanha_idcampanha_seq');

    }catch (Exception $e){
      echo "<br> Exception: Codigo: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
  }

  /** Método responsável por buscar uma campanha
  * @param $idCampanha id da campanha a ser buscada
  * @return retorna informações da campanha buscada
  */
  public function buscarCampanha($idCampanha){
    try{
      $sql = Sql::getInstance()->buscarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$idCampanha);
      $stmt->execute();

      return $this->popularCampanha($stmt->fetch(PDO::FETCH_ASSOC));

    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar campanhas em destaque
  * @param $quantidade quantidade de campanhas que devem ser buscadas
  * @return retorna uma lista de campanhas
  */
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

    }
  }

  /** Método responsável por buscar campanhas de forma aleatória
  * @param $quantidade quantidade de campanhas que devem ser buscadas
  * @return retorna uma lista de campanhas
  */
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

    }
  }

  /** Método responsável por buscar o id de uma campanha através do seu nome
  * @param $nomeCampanha nome da campanha buscada
  * @return retorna o id da campanha
  */
  public function buscarIdCampanha($nomeCampanha){
    try{
      return $this->procurarCampanha($nomeCampanha)->getIdCampanha();

    }catch (Exception $e){

    }
  }

  /** Método responsável pela personificação das informações da tabela Campanha como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  private function popularCampanha($linha){
    $campanha = new Campanha ($linha['idcampanha'],$linha['nome'],$linha['descricao'],$linha['datainicio'],$linha['imagem'],
    $linha['criadorcpf'],$linha['finalizapordata'],$linha['datafim']);
    $campanha->setTituloAgradecimento($linha['tituloagradecimento']);
    $campanha->setAgradecimento($linha['mensagemagradecimento']);
    $campanha->setValores(array($linha['valor1'], $linha['valor2'], $linha['valor3']));
    return $campanha;
  }

  /** Método responsável por buscar uma campanha através do seu nome
  * @param $nome nome da campanha buscada
  * @return retorna um objeto com  informações sobre a campanha buscada
  */
  public function procurarCampanha($nome){
    try{
      $sql = Sql::getInstance()->procurarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$nome);
      $stmt->execute();

      return $this->popularCampanha($stmt->fetch(PDO::FETCH_ASSOC));

    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar campanhas que contenham determinado caracter em seu nome
  * @param $nome nome da campanha buscada
  * @return retorna uma lista de campanhas
  */
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

    }
  }

  /** Método responsável por editar uma campanha
  * @param $campanha informações da campanha que deve ser editada
  */
  public function editarCampanha($campanha){
    try{
      $sql = Sql::getInstance()->editarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $campanha->getNome());
      $stmt->bindParam(2, $campanha->getAgradecimento());
      $stmt->bindParam(3, $campanha->getTituloAgradecimento());
      $stmt->bindParam(4, $campanha->getDescricao());
      $stmt->bindParam(5, $campanha->getImagem());
      $stmt->bindParam(6, $campanha->getIdCampanha());
      $stmt->execute();


    } catch (Exception $e) {

    }
  }

  /** Método responsável por encerrar uma campanha
  * @param $idCampanha id da campanha a ser encerrada
  * @param $data data atual do encerramento que será registrada no banco
  */
  public function encerrarCampanha($idCampanha, $data){
    try{
      $sql = Sql::getInstance()->encerrarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $data);
      $stmt->bindParam(2, $idCampanha);
      $stmt->execute();
    } catch (Exception $e) {

    }
  }

  /** Método responsável por listar todas campanha
  * @return uma lista de campanhas
  */
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

    }
  }

  /** Método responsável por buscar campanhas de determinado criador
  * @param $cpfCriador cpf do criador
  * @return uma lista de campanhas
  */
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

    }
  }


  /** Método responsável por verificar campanhas cadastradas através do nome
  * @param $nome nome da campanha a ser verificada
  * @return uma verificação se a execução do script banco de dados deu certo ou não
  */
  public function verificaCampanhaCadastrada($nome){
    try{
      $sql = Sql::getInstance()->verificarCampanhaCadastradaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$nome);
      $stmt->execute();

      return ($stmt->rowCount() > 0);

    }catch (Exception $e){

      return false;
    }
  }

  /** Método responsável por deletar uma campanha através do seu id
  * @param $idCampanha id da campanha
  */
  public function deletarCampanha($idCampanha){
    try {
      $sql = Sql::getInstance()->deletarCampanhaSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $idCampanha);
      $stmt->execute();

    } catch (Exception $e) {

    }
  }

  /** Método responsável por deletar uma campanha através do seu nome
  * @param $nomeCampanha nome da campanha
  */
  public function deletarCampanhas($nomeCampanha){
    try{
      $sql = Sql::getInstance()->deletarMuitasCampanhasSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $nomeCampanha);
      $stmt->execute();

    } catch (Exception $e) {

    }
  }
}
?>
