<?php

/**
* Classe referente a um Ponto de coleta, tendo todas as informações de endereço bem como latitude, longitude e id
*/
class Ponto{

	/** Id referente ao Ponto no banco */
	private $idponto;
	/** Endereço-CEP*/
	private $cep;
	/** Endereço-ESTADO*/
	private $estado;
	/** Endereço-CIDADE*/
	private $cidade;
	/** Endereço-BAIRRO*/
	private $bairro;
	/** Endereço-Longradouro*/
	private $logradouro;
	/** Endereço-Numero da casa*/
	private $numero;
	/** Endereço-Complemento do endereço*/
	private $complemento;
	/** Latitude do endereço do ponto*/
	private $latitude;
	/** Longitude do endereço do ponto*/
	private $longitude;


	/**< Construtor da classe Ponto
	* @param $cep Cep do endereço
	* @param $estado Estado do endereço
	* @param $bairro Bairro do endereço
	* @param $cidade Cidade do endereço
	* @param $logradouro Logradouro do endereço
	* @param $numero Numero do local do endereço
	* @param $complemento Complemento do endereço
	*/
	public function __construct($cep, $estado, $bairro, $cidade,  $logradouro, $numero, $complemento){
		$this->cep = $cep;
		$this->estado = $estado;
		$this->cidade = $cidade;
		$this->bairro = $bairro;
		$this->logradouro = $logradouro;
		$this->numero = $numero;
		$this->complemento = $complemento;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos e manipulação da classe Ponto
	*/
	public function setLatitude($latitude){
		$this->latitude = $latitude;
	}

	public function setLongitude($longitude){
		$this->longitude = $longitude;
	}

	public function getLatitude(){
		return $this->latitude;
	}

	public function getlongitude(){
		return $this->longitude;
	}

	public function setIdPonto($idponto){
		$this->idponto = $idponto;
	}

	public function getIdPonto(){
		return $this->idponto;
	}

	public function getCEP(){
		return $this->cep;
	}

	public function setCEP($endereco){
		$this->cep = $cep;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getBairro(){
		return $this->bairro;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
	}

	public function getLogradouro(){
		return $this->logradouro;
	}

	public function setLogradouro($logradouro){
		$this->logradouro = $logradouro;
	}

	public function getNumero(){
		return $this->numero;
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}

	public function getComplemento(){
		return $this->complemento;
	}

	public function setComplemento($complemento){
		$this->complemento = $complemento;
	}
}

?>
