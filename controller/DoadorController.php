<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");

/**
*Classe DoadorController
* Classe responsável por controlar todas as solicitações referentes ao doador.
*/
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


  /** Método responsável por listar doações de um determinado usuário
  * @param $cpf cpf usado para buscar as doações de um determinado usuário
  * @param $filtro filtro que indica se a busca é por doações pendentes, confirmadas ou todas
  * @return retorna uma lista de doações
  */
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

  /** Método responsável por adicionar doações de um determinado usuário
  * @param $idcampanha id da campanha que receberá a doação
  * @param $doadorcpf cpf do usuário que realizou a doação
  * @return retorna o id da doação adicionada
  */
  public function adicionarDoacao($idcampanha, $doadorcpf){
    $data = date('d/m/Y');
    $doacao = new Doacao(null, $doadorcpf, FALSE, $data, $idcampanha);
    return DoacaoDAO::getInstance()->adicionarDoacao($doacao);
  }

  /** Método responsável por cancelar uma doaçõe
  * @param $iddoacao id da doação que deve ser cancelada
  * @return retorna o id da doação cancelada
  */
  public function cancelarDoacao($idDoacao){
    return DoacaoDAO::getInstance()->excluirDoacao($idDoacao);

  }

  /** Método responsável por verificar as metas de uma campanha
  * @param $idcampanha id da campanha em questão
  */
  public function verificarMeta($idcampanha){
    $todasmetas = MetaDAO::getInstance()->buscarMetasCampanha($idcampanha);
  }


}

 ?>
