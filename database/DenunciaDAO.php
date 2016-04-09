<?php

    require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."model/Denuncia.php");
    require_once('ConexaoDB.php');
    require_once("Sql.php");
	/**
	* Classe referente ao Data Acess Object da Denuncia
	*@author gordinh
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

	    public function popularDenuncia($row){
	    	$denuncia =  new Denuncia($row['coddenuncia'], $row['idcampanha'], $row['motivo'], $row['descricao'], $row['cpf']);
	    	return $denuncia;
	    }

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
	    			echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
	    		}
	    	}else{
	    		echo "<br>Este usuário já realizou uma denúncia para estar campanha!<br>";
	    	}
		}

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


		public function removerDenunciasCPF($cpf){
			try {
				$sql = Sql::getInstance()->removerDenunciasCpfSQL();
			    $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
			    $stmt->bindParam(1, $cpf);
			    $stmt->execute();
			} catch (Exception $e) {
				echo "Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
			}
		}

		public function buscarDenuncia($cpfUsuario, $idCampanha){
			try{
		      $sql = Sql::getInstance()->buscarDenunciaSQL();
		      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
		      $stmt->bindParam(1,$cpfUsuario);
		      $stmt->bindParam(2,$idCampanha);
		      $stmt->execute();
		      return $this->popularDenuncia($stmt->fetch(PDO::FETCH_ASSOC));
		    } catch (Exception $e){
		      	echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
		      }
		}


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
		      	echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
		      }
		}

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
		      	echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
		      }
		}

		public function verificaDenunciaCadastrada($cpf, $idCampanha){
		try{
	    	$sql = Sql::getInstance()->verificaDenunciaCadastradaSQL();
	    	$stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
	    	$stmt->bindParam(1, $cpf);
	    	$stmt->bindParam(2, $idCampanha);
	    	$stmt->execute();
	    	return ($stmt->rowCount() > 0);

		} catch (Excepetion $e){
			echo "<br> Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage();
		}
		return FALSE;
		}


	}

 ?>
