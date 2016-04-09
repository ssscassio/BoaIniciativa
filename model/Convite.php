<?php

	/**
	* Esta classe tem as informações de um convite
	*/
	class Convite
	{

		private $cpfEmissor;
		private $codConvidado;
		private $idCampanha;
		private	$data;

		public function __construct($cpfEmissor, $codConvidado, $idCampanha, $data){
			$this->cpfEmissor = $cpfEmissor;
			$this->codConvidado = $codConvidado;
			$this->idCampanha = $idCampanha;
			$this->data = $data;
		}


		public function getCpfEmissor(){
			return $this->cpfEmissor;
		}

		public function getCodConvidado(){
			return $this->codConvidado;

		}

		public function getIdCampanha(){
			return $this->idCampanha;
		}

		public function getData(){
			return $this->data;
		}

		public function equals($cpfEmissor, $codConvidado, $idCampanha){
			if($this->cpfEmissor == $cpfEmissor){
				if($this->codConvidado == $codConvidado){
					if($this->idCampanha == $idCampanha){
						return true;
					}
				}
			}

			return false;
		}
	}
 ?>
