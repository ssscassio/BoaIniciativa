<?php

	/**
	* Classe referente a usuário
	*/
	class Usuario{

		private $nome;
		private $cpf; //Chave primaria
		private $email;
		private $senha;
		private $foto;
		private $sexo;
		private $dataNascimento;
		private $endereco = array();//Array com os campos do endereco
		private $classificacao = 0;
		private $contaPayPal;
		private $bloqueado;
		private $dataBloqueio;
		private $longitude;
		private $latitude;

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

		public function setLatitude($latitude){
			$this->latitude = $latitude;
		}

		public function setLatitude($longitude){
			$this->longitude = $longitude;
		}

		public function getLatitude(){
			return $this->latitude;
		}

		public function getlongitude(){
			return $this->longitude;
		}
		
		public function getCpf(){
			return $this->cpf;
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


		public function getContaPayPal(){
			return $this->contaPayPal;
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
