<?php
/**
*Classe Administrador
* Casse referente à Administrador.
*/

class Administrador{

	/**
	* CPF do administrador.
	*/
	private $cpf;
	/**
	* Nome do administrador.
	*/
	private $nome;
	/**
	* Senha do administrador.
	*/
	private $senha;
	/**
	* Email do administrador.
	*/
	private $email;
	/**
	* Sexo do administrador.
	*/
	private $sexo;
	/**
	* Data de nascimento do administrador.
	*/
	private $dataNascimento;


	/**< Construtor da classe Administrador que recebe como parâmetro suas características*/
	public function __construct($cpf, $nome, $senha, $email, $sexo, $dataNascimento){
		$this->cpf = $cpf;
		$this->nome = $nome;
		$this->senha = $senha;
		$this->email = $email;
		$this->sexo = $sexo;
		$this->dataNascimento = $dataNascimento;
	}

	/**
	* Getters e Setteres
	* Métodos de acessos às variáveis da classe administrador.
	*/
	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function setSexo($sexo){
		$this->sexo = $sexo;
	}

	public function getDataNascimento(){
		return $this->dataNascimento;
	}

	public function setDataNascimento($data){
		$this->dataNascimento = $data;
	}

	public function equals($cpf){
		if($this->cpf ===$cpf)
		return true;
		else
		return false;
	}
}
?>
