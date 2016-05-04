<?php

/**
* Classe referente a uma Categoria de uma campanha
**/
class Tag{

	/** Id referente a categoria no banco */
	private $idTag;
	/** Nome da categoria*/
	private $nome;

	/** < Construtor da classe Tag
	* @param idTag Id referente a categoria em questão
	* @param nome Nome da categoria
  */
	public function __construct($idTag, $nome){
		$this->idTag = $idTag;
		$this->nome = $nome;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos e manipulação da classe Tag
	*/
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
