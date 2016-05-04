<?php
/*
*Classe CampanhaTag
* Casse com informações referentes a tag associada a uma campanha.
*/

class CampanhaTag {

	/**
	* Id identificador de uma determinada campanha
	*/
	private $idCampanha;
	/**
	* Id identificador de uma determinada tag.
	*/
	private $idTag;

	/**< Construtor da classe CampanhaTag que recebe como parâmetro suas características*/
	public function __construct($idCampanha,$idTag){
		$this->idCampanha = $idCampanha;
		$this->idTag = $idTag;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos às variáveis da classe CampanhaTag.
	*/
	public function getIdCampanha(){
		return $this->idCampanha;
	}

	public function getIdTag(){
		return $this->idTag;
	}
}
