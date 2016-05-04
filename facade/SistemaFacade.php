<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."controller/SistemaController.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MetaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MaterialDAO.php");


  class  SistemaFacade{

    private static $instance;

    public function __construct(){

    }

    public static function getInstance() {
      if (!isset(self::$instance))
        self::$instance = new  SistemaFacade();
      return self::$instance;
    }

    public function cadastrarNovoUsuario($nome,$cpf,$email,$senha,$nascimento,$cep,$estado,$bairro,$cidade,$longradouro,$numero,$complemento,$sexo){
      return  SistemaController::getInstance()->cadastrarUsuario($nome,$cpf,$email,$senha,$nascimento,$cep,$estado,$bairro,$cidade,$longradouro,$numero,$complemento,$sexo);
    }

  public function editarPerfil($nome, $email, $senha, $foto, $sexo, $nacimento, $classificacao, $cep, $estado,
  $bairro, $cidade, $logadouro, $numero, $complemento, $cpf, $bloqueado, $dataBloqueio, $latitude, $longitude){

	return SistemaController::getInstance()->editarPerfil($nome, $email, $senha, $foto, $sexo, $nacimento, $classificacao,
    $cep, $estado, $bairro, $cidade, $logadouro, $numero, $complemento, $cpf, $bloqueado, $dataBloqueio, $latitude, $longitude);
  }

  public function printProgressMeta($idCampanha){
    $doacoesNaCampanha = DoacaoDAO::getInstance()->buscarDoacoesDaCampanha($idCampanha);
    $metas = MetaDAO::getInstance()->buscarMetasCampanha($idCampanha);

    $materiaisDoados = array();
    for ($i=0; $i < sizeof($doacoesNaCampanha); $i++) {
      if ($doacoesNaCampanha[$i]->getConfirmado()) {
        $materiaisNaDoacao = DoacaoMaterialDAO::getInstance()->listarMateriaisDaDoacao($doacoesNaCampanha[$i]->getIdDoacao());
        for ($j=0; $j < sizeof($materiaisNaDoacao); $j++) {
          $materiaisDoados[] =$materiaisNaDoacao[$j];
        }
      }
    }

    $materiaisTotais = array();

    for ($i=0; $i < sizeof($materiaisDoados); $i++) {
      if (array_key_exists($materiaisDoados[$i]->getNomeMaterial(),$materiaisTotais)) {
        $materiaisTotais[$materiaisDoados[$i]->getNomeMaterial()] += $materiaisDoados[$i]->getQuantidade();
      }else{
        $materiaisTotais[$materiaisDoados[$i]->getNomeMaterial()] = $materiaisDoados[$i]->getQuantidade();
      }
    }

    for ($i=0; $i < sizeof($metas) ; $i++) {
      $material = MaterialDAO::getInstance()->buscarMaterial($metas[$i]->getCodMaterial());
      if (array_key_exists($material->getNome(),$materiaisTotais)){
        $valor = $materiaisTotais[$material->getNome()];
      }else{
        $valor = 0;
      }

      $max = $metas[$i]->getQuantidade();
      $tamanho = ($valor/$max)*100;
      echo '<h4>'.$material->getNome().'</h3>
      <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="'.$tamanho.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$tamanho.'%"> '.$valor.'/'.$max.'</div>
      </div>';
    }

  }


  public function excluirPerfil($cpf){
	return SistemaController::getInstance()->excluirPerfil($cpf);
  }

}

 ?>
