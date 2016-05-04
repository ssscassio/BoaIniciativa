<?php
/*
*Classe Material
* Casse com informações referentes aos materiais de uma doação.
*/
class Material
{
	/**
	* Nome do material em questão.
	*/
	private $nome;
	/**
	* Medida utilizada para o material (kg, m, cm...)
	*/
	private $medida;
	/**
	* Código identificador do material.
	*/
	private $codigo;

	/**< Construtor da classe Material que recebe como parâmetro suas características*/
	public function __construct($nome, $medida, $codigo){
		$this->nome = $nome;
		$this->medida = $medida;
		$this->codigo = $codigo;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos às variáveis da classe Material.
	*/
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
