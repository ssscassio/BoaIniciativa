<?php
/*
*Classe Doacao
* Casse com informações referentes às doações feitas.
*/

//importação das classes necessárias para a composição da classe
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoMaterialDAO.php");

class Doacao
{

  /**
  * Atributo identificador da doação.
  */
  private $idDoacao;
  /**
  * Data da doação.
  */
  private $data;
  /**
  * Atriuto boolean que verifica se a doação já foi confirmada por um atendente ou não.
  */
  private $confirmado;
  /**
  * Id identificador da campanha que recebeu a doação.
  */
  private $idCampanha;
  /**
  * Atendente que confirmou a doação.
  */
  private $atendenteconfirma;
  /**
  * CPF do usuário que realizou a doação.
  */
  private $cpfDoador;

  /**< Construtor da classe Doacao que recebe como parâmetro suas características*/
  public function __construct($idDoacao, $cpfDoador, $confirmado, $data, $idCampanha)
  {
    $this->idDoacao = $idDoacao;
    $this->cpfDoador = $cpfDoador;
    $this->confirmado = $confirmado;
    $this->idCampanha = $idCampanha;
    $this->data = $data;
  }

  /**
  * Método responsável por confirmar uma doação
  * @param $atendenconfirma - parâmetro referente ao atendente que realizou a confirmação da doação
  */
  public function confirmarDoacao($atendenteconfirma){
    if(empty($this->atendenteconfirma)){
      $this->atendenteconfirma = $atendenteconfirma;
      $this->confirmado = true;
      return (new DoacaoDAO)->editarDoacao($this); //Conseguiu efetuar operação de associar atendente
    }
    return false;//Doacao já tem atendente associado
  }

  /**
  * Método responsável por adicionar um material a uma doação
  * @param $materialdoado - parâmetro referente a um material doado
  */
  public function adicionarMaterial($materialDoado){
    array_push($itens, $materialDoado);
    (new DoacaoMaterialDAO)->adicionarMaterialDoacao($this, $materialDoado);
  }


  /**
  * Getters e Setteres
  * Métodos de acessos às variáveis da classe Doacao.
  */
  public function setItens($itens){
    $this->itens = $itens;

  }

  public function setAtendente($atendente){
    $this->atendenteconfirma = $atendente;
  }

  public function setIdDoacao($idDoacao){
    $this->idDoacao = $idDoacao;
  }
  public function getIdDoacao(){
    return $this->idDoacao;
  }
  public function getData(){
    return $this->data;
  }
  public function getConfirmado(){
    return $this->confirmado;
  }
  public function getIdCampanha(){
    return $this->idCampanha;
  }
  public function getAtendente(){
    return $this->atendenteconfirma;
  }
  public function getItens(){
    return $this->itens;
  }
  public function getCpfDoador(){
    return $this->cpfDoador;
  }

}
?>
