<?php

  require_once("Sql.php");
  require_once("../model/Agradecimento.php");
  /**
   * Classe que referece ao acesso a tabela AgradecimentoDAO
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

      private function popularAgradecimento($row){
        $agradecimento = new Agradecimento($row['titulo'],
                                           $row['cpfusuario'],
                                           $row['mensagem'],
                                           $row['imagem'],
                                           $row['codcampanha']);
        $agradecimento->setIdAgradecimento($row['codagradecimento']);
        return $agradecimento;
      }

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
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }

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
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }

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
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
		}

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
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }
    }
  }

?>
