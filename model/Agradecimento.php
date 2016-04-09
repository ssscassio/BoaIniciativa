<?php

	/**
	* Esta classe tem as informações de um agradecimento
	*/
	class Agradecimento
	{
		private $titulo;
		private $cpfUsuario; //CPF do usuario que recebeu o agradecimento
		private $mensagem;   //mensagem da campanha
		private $imagem;  //Imagem
		private $idCampanha; //id da campanha que agraeceu
		private $idAgradecimento;

		public function __construct($titulo, $idUsuario, $mensagem, $imagem, $idCampanha){
			$this->titulo = $titulo;
			$this->cpfUsuario = $idUsuario;
			$this->mensagem = $mensagem;
			$this->imagem = $imagem;
			$this->idCampanha = $idCampanha;
		}

		public function getTitulo(){
			return $this->titulo;
		}

		public function getCpfUsuario(){
			return $this->cpfUsuario;
		}

		public function getMensagem(){
			return $this->mensagem;
		}

		public function getImagem(){
			return $this->imagem;
		}

		public function getIdCampanha(){
			return $this->idCampanha;
		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}

		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}

		public function setTexto($texto){
			$this->texto = $texto;
		}

		public function setImagem($imagem){
			$this->imagem = $imagem;
		}

		public function setCampanha($idCampanha){
			$this->idCampanha = $idCampanha;
		}

		public function setIdAgradecimento($idAgradecimento){
			$this->idAgradecimento = $idAgradecimento;
		}
		// public function buscarUsuario{}
		// public function deletarUsuario{}
		// public function buscarCampanha{}
		// public function excluirCampanha{}
	}
 ?>
