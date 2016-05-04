<?php

/*
*Classe Convite
* Casse com informações referentes aos convites enviados para potenciais novos usuários.
*/
class Convite
{

	/**
	* Cpf do usuário que realizou o convite.
	*/
	private $cpfEmissor;
	/**
	* Codigo do convidado.
	*/
	private $codConvidado;
	/**
	* Id identificador da campanha da qual o convite foi realizado.
	*/
	private $idCampanha;
	/**
	* Data do convite.
	*/
	private	$data;

	/**< Construtor da classe Convite que recebe como parâmetro suas características*/
	public function __construct($cpfEmissor, $codConvidado, $idCampanha, $data){
		$this->cpfEmissor = $cpfEmissor;
		$this->codConvidado = $codConvidado;
		$this->idCampanha = $idCampanha;
		$this->data = $data;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos às variáveis da classe Convite.
	*/
	public function getCpfEmissor(){
		return $this->cpfEmissor;
	}

	public function getCodConvidado(){
		return $this->codConvidado;

	}

	public function getIdCampanha(){
		return $this->idCampanha;
	}

	public function getData(){
		return $this->data;
	}

	public function equals($cpfEmissor, $codConvidado, $idCampanha){
		if($this->cpfEmissor == $cpfEmissor){
			if($this->codConvidado == $codConvidado){
				if($this->idCampanha == $idCampanha){
					return true;
				}
			}
		}

		return false;
	}
}
?>
