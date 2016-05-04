<?php

/**
* Classe referente a usuário, contém todas as suas informações do usuário.
*/
class Usuario{
	/** O nome do usuário*/
	private $nome;
	/** O Cpf do usuário*/
	private $cpf;
	/** O Email do usuário*/
	private $email;
	/** A senha do usuário*/
	private $senha;
	/** A Url da foto do usuário*/
	private $foto;
	/** O Sexo do usuário ("M" ou "F")*/
	private $sexo;
	/** A data de nascimento do usuário (dd-mm-aaaa)*/
	private $dataNascimento;
	/** Array contendo as informações do endereço do usuário (cep, Estado, Bairro, Cidade, longradouro, Numero, Complemento)*/
	private $endereco = array();//Array com os campos do endereco
	/** A classificação do usuário*/
	private $classificacao = 0;
	/** Status do usuário (true: bloqueado, false: desbloqueado)*/
	private $bloqueado;
	/** Data que o usuário foi bloqueado*/
	private $dataBloqueio;
	/** Latitude do endereço do usuário*/
	private $latitude;
	/** Longitude do endereço do usuário*/
	private $longitude;

	/** < Construtor da classe Usuário que recebe como parâmetro suas caracteristicas. */
	public function __construct($nome, $cpf, $email, $senha, $foto, $sexo, $dataNascimento, $endereco, $classificacao, $bloqueado, $dataBloqueio)
	{
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->email = $email;
		$this->senha = $senha;
		$this->foto = $foto;
		$this->sexo = $sexo;
		$this->dataNascimento = $dataNascimento;
		$this->endereco = $endereco;
		$this->classificacao =  $classificacao;
		$this->bloqueado = $bloqueado;
		$this->dataBloqueio = $dataBloqueio;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos e manipulação da classe Usuario
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

	public function getLongitude(){
		return $this->longitude;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	public function getBloqueado(){
		return $this->bloqueado;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function getDataBloqueio(){
		return $this->dataBloqueio;
	}

	public function getClassificacao(){
		return $this->classificacao;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function getFoto(){
		return $this->foto;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function getDataNascimento(){
		return $this->dataNascimento;
	}

	public function getAgradecimentos(){
		return $this->agradecimentos;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function setFoto($foto){
		$this->foto = $foto;
	}

	public function setSexo($sexo){
		$this->sexo = $sexo;
	}

	public function setDataNascimento($dataNascimento){
		$this->dataNascimento = $dataNascimento;
	}

	public function setContaPayPal($contaPayPal){
		$this->contaPayPal = $contaPayPal;
	}

	public function setClassificacao($classificacao){
		$this->classificacao = $classificacao;
	}

	public function setBloqueado($bloqueado){
		$this->bloqueado = $bloqueado;
	}

	/**
	* Metodo que verifica se dois usuários são iguais a partir de seus cpfs
	* @param $usuario Usuario que está se comparando com o usuário atual
	*/
	public function equals($usuario){
		if($this->cpf == $usuario->cpf){
			return true;
		}
		else {
			return false;
		}
	}
}
?>
