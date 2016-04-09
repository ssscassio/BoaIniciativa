<?php

  require_once("../model/Ponto.php");
  require_once("CampanhaDAO.php");
  require_once("Sql.php");
  require_once("PontoDAO.php");
  require_once('ConexaoDB.php');

  /**
   * Classe que faz manipulação da tabela PontoCampanha
   */
  class PontoCampanhaDAO
  {

    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
      self::$instance = new PontoCampanhaDAO();
      return self::$instance;
    }


    public function adicionarCampanhaPonto($idponto,$idcampanha){
        try{
              $sql = Sql::getInstance()->adicionarCampanhaPontoSQL();
              $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
              $stmt->bindParam(1,$idponto);
              $stmt->bindParam(2,$idcampanha);
              $stmt->execute();

        }catch (Exception $e){
                echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
        }
      }


      public function buscarPontosCampanha($idCampanha){
        try{
          $sql = Sql::getInstance()->buscarPontosCampanhaSQL();
          $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
          $stmt->bindParam(1,$idCampanha);
          $stmt->execute();
          $arrayPontos = array();
          $pontoDao = new PontoDAO();

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ponto = $pontoDao->buscarPontoColeta($row["idponto"]);
            $arrayPontos[] = $ponto;
          }
          return $arrayPontos;
        } catch (Exception $e){
          echo "<br> Erro: CÃ³digo: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
        }
      }



    public function buscarCampanhaPonto($idPonto){
      try{
        $sql = Sql::getInstance()->buscarCampanhaPontoSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$idPonto);
        $stmt->execute();
        $arrayCampanhas = array();
        $campanhaDAO = new CampanhaDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $campanha = $campanhaDAO->buscarCampanha($row["idcampanha"]);
          $arrayCampanhas[] =$campanha;
        }
        return $arrayCampanhas;
      } catch (Exception $e){
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }



  }

 ?>
