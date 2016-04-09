<?php
/**
	* Esta classe tem as informações de uma campanha
	*/

//  require("../DataBase/UsuarioDAO.php");

class Campanha{

	private $idCampanha; 		//ida da campanha no banco caso seja retorno
	private $nome; 				//nome da campanha
	private $descricao; 		//descricao da campanha
	private $status; 		 //True = ativa, False = inativa
	private $agradecimento; 	//texto de agradecimento padrão da campanha
	private $tituloAgradecimento;
	private $dataDeInicio;		//data de inicio
	private $imagem;			//imagem associada a campanha
	private $tags; 				//tag que permite que a campanha seja classificada na barra lateral da aplicação
	private $criadorDaCampanha; //atributo que permite identificar qual conta do paypal será associada a campanha
	private $finalizapordata; 			#por definição se for finalizar por meta, repassar true, se finalizar por Data, repassar false
	private $dataFim;			//data de termino da campanha
	private $valores = array();

    //construtor da classe
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
    	}
    }


//getters e setters
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
			$this->valores= $valores;
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
    	return $this->finalizapordata;
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
