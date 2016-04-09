<?php
	/**
	* Esta classe é referente ao Material de Doação.
	*/
	class Convidado
	{
		private $email;
		private $classificacao;
		private $codigo;
		
		public function __construct($email, $classificacao, $codigo){
			$this->email = $email;
			$this->classificacao = $classificacao;
			$this->codigo = $codigo;
		}

		public function getEmail(){
			return $this->email;
		}

		public function getClassificacao(){
			return $this->classificacao;
		}
		
		public function getCodigo(){
			return $this->codigo;
		}

		public function setClassificacao($classificacao){
			$this->classificacao += $classificacao;
			
			}	

		public function setCodigo($codigo){
			$this->codigo = $codigo;
			
			}


		public function equals($email, $classificacao){
			if($this->email == $email){
				if($this->classificacao == $classificacao){
					return true;
				}
			}
			return false;
		}
	}


?>
