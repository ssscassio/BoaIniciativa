<?php

/*
*Classe Denuncia
* Casse com informações referentes às denúncias feitas.
*/
class Denuncia
{
	/**
	* Código identificador da denúncia feita.
	*/
	private $codDenuncia;
	/**
	* Id identificador da campanha que foi denunciada.
	*/
	private $idCampanha;
	/**
	* Motivo da denúncia.
	*/
	private $motivo;
	/**
	* Descrição da denúncia.
	*/
	private $descricao = "";
	/**
	* Cpf do usuário que realizou a denúncia.
	*/
	private $cpfUsuario;

	/**< Construtor da classe Denuncia que recebe como parâmetro suas características*/
	public function __construct($codDenuncia, $idCampanha, $motivo, $descricao,$cpfUsuario)
	{
		$this->codDenuncia = $codDenuncia;
		$this->idCampanha = $idCampanha;
		$this->motivo = $motivo;
		$this->descricao = $descricao;
		$this->cpfUsuario = $cpfUsuario;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos às variáveis da classe Denúncia.
	*/
	public function getCodDenuncia(){
		return $this->codDenuncia;
	}

	public function getIdCampanha(){
		return $this->idCampanha;
	}

	public function getMotivo(){
		return $this->motivo;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function getCpfUsuario(){
		return $this->cpfUsuario;
	}

	public function setCodDenuncia($codDenuncia){
		$this->codDenuncia = $codDenuncia;
	}

	public function equals($cpfUsuario, $idCampanha){
		if($this->cpfUsuario == $cpfUsuario){
			if($this->idCampanha == $idCampanha){
				return true;
			}
		}

		return false;
	}
}



?>
