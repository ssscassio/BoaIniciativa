<?php
  require('MaterialDAO.php');
  require('../model/Meta.php');
  
  require_once('../database/CampanhaDAO.php');
  require_once("Sql.php");

  /**
   * Classe referente a Personificação da Meta de Campanha do Banco de Dados
   */
  class MetaDAO
  {
	private static $instance;

	public function __construct(){

	}
	
	public static function getInstance() {
	    if (!isset(self::$instance))
		  self::$instance = new MetaDAO();
		return self::$instance;
	}


	public function popularMeta($inha){
		$meta = new Meta($linha['idcampanha'], $linha['codcaterial'], $linha['quantidade']);
		return $meta;
	}
	
    public function adicionarMeta($meta){//Colocar para passar model Meta
		
		try{
			$sql = Sql::getInstance()->adicionarMetaSQL();
			$stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
		    $stmt->bindParam(1, $meta->getCodMaterial());
			$stmt->bindParam(2, $meta->getIdCampanha());
			$stmt->bindParam(3, $meta->getQuantidade());

			// Talvez não precise verificar
			$validar = ConexaoDB::getConexaoPDO()->prepare(Sql::getInstance()->validadeAdicionarMetaSQL());
			$validar->bindParam(1,$meta->getCodMaterial());
			$validar->bindParam(2,$meta->getIdCampanha());
			$validar->execute();

			if($validar->errorCode() != "00000"){
				echo "Erro ao verificar existencia da Meta no Banco. Codigo Erro: ". $stmt->errorCode(). ":";
				var_dump($validar->errorInfo());
				return false;
			}

			if($validar->rowCount()==0){
				$stmt->execute();
				if($stmt->errorCode() != "00000"){
					echo "Erro ao Adicionar a Meta no Banco. Codigo Erro: ". $stmt->errorCode(). ":";
					var_dump($stmt->errorInfo());
					return false;
				}
				return true;
			}
			else {
				echo "<br> Esta meta ja existe!<br>";
				return false;
			}

		}catch(Exception $e){
			echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
		}
	}

    public function buscarMetasCampanha($idCampanha){
	try{
        $sql = Sql::getInstance()->buscarmetasCampanhaSQL();
        $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
        $stmt->bindParam(1,$idCampanha);
        $stmt->execute(array($idCampanha));

		if($stmt->rowCount()==0){
			return null;
		}

		$arrayMetas = array();
		$campanhaDAO = new CampanhaDAO();//Pode remover

		while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
			$meta = new Meta($linha['idcampanha'], $linha['codmaterial'], $linha['quantidade']);		
			$arrayMetas[]=$meta;
		}
		
		return $arrayMetas;

      }catch (Exception $e){
        echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
      }

    }

  }

 ?>
