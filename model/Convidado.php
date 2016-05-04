<?php
/*
*Classe Convidado
* Casse com informações referentes aos usuários convidados para o sistema.
*/
class Convidado
{
	/**
	* Email do usuário convidado.
	*/
	private $email;
	/**
	* Classificação do usuário convidado.
	*/
	private $classificacao;
	/**
	* Código do usuário convidado.
	*/
	private $codigo;

	/**< Construtor da classe Convidado que recebe como parâmetro suas características*/
	public function __construct($email, $classificacao, $codigo){
		$this->email = $email;
		$this->classificacao = $classificacao;
		$this->codigo = $codigo;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos às variáveis da classe Convidado.
	*/
	public function getEmail(){
		return $this->email;
	}

	public function getClassificacao(){
		return $this->classificacao;
	}

	public function getCodigo(){
		return $this->codigo;
	}

	public function setClassificacao($classificacao){
		$this->classificacao += $classificacao;

	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;

	}


	public function equals($email, $classificacao){
		if($this->email == $email){
			if($this->classificacao == $classificacao){
				return true;
			}
		}
		return false;
	}
}


?>
