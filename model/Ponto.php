<?php
/*
*classe Ponto
*/

class Ponto{

	private $idponto;
	private $cep;
	private $estado;
	private $cidade;
	private $bairro;
	private $logradouro;
	private $numero;
	private $complemento;



	public function __construct($cep, $estado, $bairro, $cidade,  $logradouro, $numero, $complemento){
		$this->cep = $cep;
		$this->estado = $estado;
		$this->cidade = $cidade;
		$this->bairro = $bairro;
		$this->logradouro = $logradouro;
		$this->numero = $numero;
		$this->complemento = $complemento;
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
