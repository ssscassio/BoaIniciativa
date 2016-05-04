<?php

/*
*Classe Agradecimento
* Casse com informações referentes a Agradecimento.
*/
class Agradecimento
{
	/**
	* Título do agradecimento.
	*/
	private $titulo;
	/**
	* CPf do usuário que recebeu o agradecimento da campanha.
	*/
	private $cpfUsuario;
	/**
	* Mensagem do agradecimento da campanha.
	*/
	private $mensagem;
	/**
	* Imagem do agradecimento.
	*/
	private $imagem;
	/**
	* Id identificador da campanha referente a este agradecimento.
	*/
	private $idCampanha;
	/**
	* Id identificador do agradecimento.
	*/
	private $idAgradecimento;

	/**< Construtor da classe Agradecimento que recebe como parâmetro suas características*/
	public function __construct($titulo, $idUsuario, $mensagem, $imagem, $idCampanha){
		$this->titulo = $titulo;
		$this->cpfUsuario = $idUsuario;
		$this->mensagem = $mensagem;
		$this->imagem = $imagem;
		$this->idCampanha = $idCampanha;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos às variáveis da classe agradecimento.
	*/
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

}
?>
