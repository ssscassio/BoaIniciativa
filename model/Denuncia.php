<?php

	/**
	* Classe denuncia
	*/
	class Denuncia
	{
		private $codDenuncia;
		private $idCampanha;
		private $motivo;
		private $descricao = "";
		private $cpfUsuario;

		public function __construct($codDenuncia, $idCampanha, $motivo, $descricao,$cpfUsuario)
		{
			$this->codDenuncia = $codDenuncia;
			$this->idCampanha = $idCampanha;
			$this->motivo = $motivo;
			$this->descricao = $descricao;
			$this->cpfUsuario = $cpfUsuario;
		}

		public function getCodDenuncia(){
			return $this->codDenuncia;
		}

		public function getIdCampanha(){
			return $this->idCampanha;
		}

		public function getMotivo(){
			return $this->motivo;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function getCpfUsuario(){
			return $this->cpfUsuario;
		}

		public function setCodDenuncia($codDenuncia){
			$this->codDenuncia = $codDenuncia;
		}

		public function equals($cpfUsuario, $idCampanha){
			if($this->cpfUsuario == $cpfUsuario){
				if($this->idCampanha == $idCampanha){
					return true;
				}
			}

			return false;
		}
	}



 ?>
