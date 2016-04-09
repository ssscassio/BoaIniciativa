<?php
/*
*Classe Administrador
*/

class Administrador{

	private $cpf;
    private $nome;
    private $senha;
    private $email;
    private $sexo;
    private $dataNascimento;

    public function __construct($cpf, $nome, $senha, $email, $sexo, $dataNascimento){
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->dataNascimento = $dataNascimento;
    }


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
