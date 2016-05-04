<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");


class  DoadorController
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
      self::$instance = new DoadorController();
    return self::$instance;
  }

  public function listarDoacoes($cpf, $filtro){
    $todasdoacoes = DoacaoDAO::getInstance()->buscarDoacoesDoDoador($cpf);
      if($filtro === "pendentes"){
          $doacoespendentes = array();
          for($i = 0 ; $i < sizeof($todasdoacoes) ; $i++){
            if($todasdoacoes[$i]->getConfirmado()  == false){//se não foi confirmado
              $doacoespendentes[] = $todasdoacoes[$i];
            }
          }
          return $doacoespendentes;
      }else if ($filtro === "confirmadas"){
        $doacoesconfirmadas = array();
        for($i = 0 ; $i < sizeof($todasdoacoes) ; $i++){
          if($todasdoacoes[$i]->getConfirmado()  == true){//se está confirmada
            $doacoesconfirmadas[] = $todasdoacoes[$i];
          }
        }
        return $doacoesconfirmadas;
      }else {// se não for nem ativa nem finalizada ou o filtro for errado
        return $todasdoacoes;
      }
  }

  public function adicionarDoacao($idcampanha, $doadorcpf){
    $data = date('d/m/Y');
    $doacao = new Doacao(null, $doadorcpf, FALSE, $data, $idcampanha);
    return DoacaoDAO::getInstance()->adicionarDoacao($doacao);
  }

  public function cancelarDoacao($idDoacao){
    return DoacaoDAO::getInstance()->excluirDoacao($idDoacao);

  }

  public function verificarMeta($idcampanha){
    $todasmetas = MetaDAO::getInstance()->buscarMetasCampanha($idcampanha);
  }


}

 ?>
