<?php

/**
* Classe referente a uma meta a ser alcançada em uma campanha ou aos materiais que a campanha pode receber
*/
class Meta{

	/** Id referente a campanha que possui esta meta*/
	private $idCampanha;
	/** Codigo do máterial da meta*/
	private $codMaterial;
	/** Quantidade do material que a campanha deseja alcançar, (0 para campanha que não finaliza por meta)*/
	private $quantidade;

	/**< Construtor da classe meta
	*	@param $idCampanha - Id da campanha que possui a meta
	* @param $codMaterial - Codigo do material que pode ser recebido pela campanha
	* @param $quantidade - Quantidade do material que deseja-se receber
	**/
	public function __construct($idCampanha, $codMaterial, $quantidade){
		$this->idCampanha = $idCampanha;
		$this->codMaterial = $codMaterial;
		$this->quantidade = $quantidade;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos e manipulação da classe Meta
	*/
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
