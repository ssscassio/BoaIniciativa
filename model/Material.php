<?php
	/**
	* Esta classe é referente ao Material de Doação.
	*@author Gordinh
	*/
	class Material
	{
		private $nome;
		private $medida;
		private $codigo;

		public function __construct($nome, $medida, $codigo){
			$this->nome = $nome;
			$this->medida = $medida;
			$this->codigo = $codigo;
		}

		public function getNome(){
			return $this->nome;
		}

		public function getMedida(){
			return $this->medida;
		}

		public function getCodigo(){
			return $this->codigo;
		}
		public function setCodigo($codigo){
			$this->codigo = $codigo;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function setMedida($medida){
			$this->medida = $medida;
		}

		public function equals($nome, $medida){
			if($this->nome == $nome){
				if($this->medida == $medida){
					return true;
				}
			}
			return false;
		}
	}


?>
