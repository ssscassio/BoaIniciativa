<?php

class Tag{

	private $idTag;
	private $nome;

	public function __construct($idTag, $nome){
		$this->idTag = $idTag;
		$this->nome = $nome;
	}

	public function getIdTag(){
		return $this->idTag;
	}

	public function setIdTag($idTag){
		$this->idTag = $idTag;
	}
	public function getNome(){
		return $this->nome;
	}
}

?>
