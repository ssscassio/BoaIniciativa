<?php

class CampanhaTag {
	private $idCampanha;
	private $idTag;

	public function __construct($idCampanha,$idTag){
		$this->idCampanha = $idCampanha;
		$this->idTag = $idTag;
	}

	public function getIdCampanha(){
		return $this->idCampanha;
	}

	public function getIdTag(){
		return $this->idTag;
	}
}
