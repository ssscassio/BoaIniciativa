<?php
require_once("Sql.php");
require_once('ConexaoDB.php');
require_once('../model/Ponto.php');
  /*
   * Classe referente a Personificação do Ponto de Coleta do Banco de Dados

   *Com erro ainda
   */
  class PontoDAO
  {
    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
      self::$instance = new PontoDAO();
      return self::$instance;
    }

    private function popularPonto($row){
      $ponto = new Ponto($row['cep'],$row['estado'],$row['bairro'],$row['cidade'],$row['logradouro'],$row['numero'],$row['complemento']);
      $ponto->setIdPonto((int) $row['idponto']);
      return $ponto;
    }

    public function adicionarPonto($ponto){
      try{
            $sql = Sql::getInstance()->adicionarPontoSQL();
            $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
            $stmt->bindParam(1,$ponto->getCEP());
            $stmt->bindParam(2,$ponto->getEstado());
            $stmt->bindParam(3,$ponto->getBairro());
            $stmt->bindParam(4,$ponto->getCidade());
            $stmt->bindParam(5,$ponto->getLogradouro());
            $stmt->bindParam(6,$ponto->getNumero());
            $stmt->bindParam(7,$ponto->getComplemento());

            $stmt->execute();
            return ConexaoDB::getConexaoPDO()->lastInsertId("BoaIniciativa.ponto_idponto_seq");

      }catch (Exception $e){
              echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }
    public function buscarPontoCidade($cidade){
      try{
        $sql = Sql::getInstance()->buscarPontoCidadeSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$cidade);
        $stmt->execute();

        $listaPontosCidade = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $ponto = $this->popularPonto($row);
          $listaPontosCidade[] = $ponto;
        }
        return $listaPontosCidade;
      } catch (Exception $e){
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }


    }

   public function buscarPontoRegiao($CEP){
      try{
        $sql = Sql::getInstance()->buscarPontoRegiaoSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$CEP);
        $stmt->execute();
        $listaPontosRegiao = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $ponto = $this->popularPonto($row);
          $listaPontosRegiao[] = $ponto;
        }

        return $listaPontosRegiao;
      } catch (Exception $e){
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }


    public function buscarPontoColeta($idPonto){
      try{
        $sql = Sql::getInstance()->buscarPontoColetaSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$idPonto);
        $stmt->execute();
        return $this->popularPonto($stmt->fetch(PDO::FETCH_ASSOC));
      } catch (Exception $e){
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }



    public function deletarPonto($idPonto){
      try{
        $sql = Sql::getInstance()->deletarPontoColetaSQL();
        $p_sql = ConexaoDB::getConexaoPDO()->prepare($sql);
        $p_sql->bindParam(1, $idPonto);
        $p_sql->execute();
      }catch (Exception $e){
        echo "Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage();
      }
    }



    public function verificaPontoCadastrado($ponto){
      try{
        $sql = Sql::getInstance()->verificarPontoCadastradoSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$ponto->getCEP());
        $stmt->bindParam(2,$ponto->getEstado());
        $stmt->bindParam(3,$ponto->getBairro());
        $stmt->bindParam(4,$ponto->getCidade());
        $stmt->bindParam(5,$ponto->getLogradouro());
        $stmt->bindParam(6,$ponto->getNumero());
        $stmt->bindParam(7,$ponto->getComplemento());
        $stmt->execute();
        if($stmt->rowCount() > 0){
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          return $row['idponto'];
        } //True = ponto já cadastrado
        else{
          return 0;
        }
      } catch (Excepetion $e){
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
      return FALSE;
    }


  }

 ?>
