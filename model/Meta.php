<?php

	class Meta
	{
		private $idCampanha;
		private $codMaterial;
		private $quantidade;

		public function __construct($idCampanha, $codMaterial, $quantidade){
			$this->idCampanha = $idCampanha;
			$this->codMaterial = $codMaterial;
			$this->quantidade = $quantidade;
		}

		public function getIdCampanha(){
			return $this->idCampanha;
		}

		public function getCodMaterial(){
			return $this->codMaterial;
		}

		public function getQuantidade(){
			return $this->quantidade;
		}
		
		public function setQuantidade($quantidade){
			$this->quantidade = $quantidade;
		}
	}

?>