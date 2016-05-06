<?php
/*
*Classe Campanha
* Casse com informações referentes a Campanha.
*/

class Campanha{

	/**
	* Id identificador de uma campanha.
	*/
	private $idCampanha;
	/**
	* Nome de uma campanha.
	*/
	private $nome;
	/**
	* Descrição de uma campanha.
	*/
	private $descricao;
	/**
	* Status de uma campanha, true caso esteja ativa e false caso contrário.
	*/
	private $status;
	/**
	* Texto de agradecimento padrão de uma campanha.
	*/
	private $agradecimento;
	/**
	* Título do agradecimento padrão de uma campanha.
	*/
	private $tituloAgradecimento;
	/**
	* Data de início de uma campanha.
	*/
	private $dataDeInicio;
	/**
	* Imagem associada a uma campanha.
	*/
	private $imagem;
	/**
	* Tags de uma campanha (funciona como categorias).
	*/
	private $tags;
	/**
	* Indentificador da conta paypal do criador de uma campanha.
	*/
	private $criadorDaCampanha;
	/**
	* Booleano que verifica se uma campanha finaliza por data ou não (se não, finaliza por meta)
	*/
	private $finalizapordata;
	/**
	* Data de término de uma campanha.
	*/
	private $dataFim;
	/**
	* Valores pré definidos de uma campanha quando esta for monetária.
	*/
	private $valores = array();

	/**< Construtor da classe Campanha que recebe como parâmetro suas características*/
	public function __construct($idCampanha, $nome, $descricao, $dataDeInicio,
	$imagem, $cpfCriador, $finalizapordata, $dataFim){

		$this->idCampanha = $idCampanha;
		$this->dataDeInicio = $dataDeInicio;
		$this->imagem = $imagem;
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->dataFim = $dataFim;
		$this->finalizapordata = $finalizapordata;
		$this->criadorDaCampanha = $cpfCriador;
		$this->verificarFimCampanha();
	}

	/**Método que verifica se uma campanha já está finalizada ou não.
	*/
	public function verificarFimCampanha(){
		if ($this->finalizapordata){

			$hoje = date('d/m/Y');
			if(strtotime($hoje) < strtotime($this->getDataFim())){
				$this->status = true;
			}
			else{
				#dataFim
				$this->status = false;//Finalizada
			}
		}else{
			$this->status = true;
		}

	}


	/**
	* Getters e Setteres
	* Métodos de acessos às variáveis da classe campanha.
	*/
	public function getIdCampanha(){
		return $this->idCampanha;
	}
	public function getCriadorCpf(){
		return $this->criadorDaCampanha;
	}
	public function getCriadorDaCampanha(){
		return $this->criadorDaCampanha;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getdescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function setValores($valores){
		$this->valores = $valores;
	}
	public function getValores(){
		return $this->valores;
	}
	public function getAgradecimento(){
		return $this->agradecimento;
	}

	public function setAgradecimento($agradecimento){
		$this->agradecimento = $agradecimento;
	}

	public function getTituloAgradecimento(){
		return $this->tituloAgradecimento;
	}

	public function setTituloAgradecimento($tituloAgradecimento){
		$this->tituloAgradecimento = $tituloAgradecimento;
	}

	public function getDataInicio(){
		return $this->dataDeInicio;
	}

	public function getImagem(){
		return $this->imagem;
	}
	public function setImagem($imagem){
		$this->imagem = $imagem;
	}

	public function getTags(){
		return $this->tags;
	}
	//fiquei na duvida nesse setTag, se deixa ele com permissao pra apenas o administrador setar,
	//pq essa tag é a tag da barra lateral, entao nao vejo pq o usuario poder ter esse poder, ou
	//retirar esse stter

	public function setTags($tag){
		$this->tags = $tag;
	}

	public function getFinalizaPorData(){
		if($this->finalizapordata)
			return 'true';
		return 'false';
	}
	public function setFinalizaPorData($finalizapordata){
		$this->finalizapordata = $finalizapordata;
	}

	public function setIdCampanha($idCampanha){
		$this->idCampanha = $idCampanha;
	}
	public function getDataFim(){
		return $this->dataFim;
	}
	public function setDataFim($dataFim){
		$this->dataFim = $dataFim;
	}


}
?>
