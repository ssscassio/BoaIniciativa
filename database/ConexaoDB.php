<?php

/**
* Classe para conexao com banco de dados
*/
class ConexaoDB{

	private static $pdo;

	public function __construct() {

		//Servidor remoto
		/*
		$servidor = "69.167.172.78";
		$usuario = "boaini_usuario";
		$senha ="111111";
		$dbname = "boaini_boainiciativa";
		$porta = "2082";
		*/

	}

	public function getConexaoPDO(){

		if(!isset(self::$pdo)){

			$servidor = "localhost";
			$usuario = "postgres";
			$senha ="12345";
			$dbname = "boaini_BoaIniciativa";
			$porta = "5432";

			try{
				self::$pdo = new PDO("pgsql:host={$servidor};port={$porta};dbname={$dbname}",$usuario, $senha);
			} catch(PDOException $e){
				echo "Falha: ". $e->getMessage();
				exit();
			}
		}
		return self::$pdo;
	}
}
?>
