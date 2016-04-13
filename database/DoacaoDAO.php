<?php

require_once("UsuarioDAO.php");
require_once("DoacaoMaterialDAO.php");
require_once("Sql.php");

/**
 * Classe que manipula a tabela de Doações
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

  public function popularDoacao($linha){
      $doacao =new Doacao($linha['iddoacao'],
                        $linha['doadorcpf'],
                        $linha['confirmado'],
                        $linha['data'],
                        $linha['idcampanha']);
              $doacao->setAtendente($linha['atendenteconfirma']);
      return $doacao;
  }

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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
  }

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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }

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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }

  }

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
      echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }


  }
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
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }

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
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
        }
    }

	public function excluirDoacaoPendente($idCampanha, $cpfUsuario){ // em edição por Jussara return boolean
	try {
      $sql = Sql::getInstance()->excluirDoacaoPendente();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1, $cpfUsuario);
      $stmt->bindParam(2, $idCampanha);
      $stmt->execute();

      if($stmt->errorCode() != "00000"){
        return false;
      }

	  return true;

    } catch (Exception $e) {
      echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
    }
	}
}
?>
