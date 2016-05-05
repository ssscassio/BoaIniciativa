<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/DoacaoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AtendenteCampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MaterialDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MetaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AgradecimentoDAO.php");


/**
* Classe AtendenteController
* Classe responsável por controlar todas as solicitações referentes ao atedente.
*/
class AtendenteController
{

  /** Instancia Singleton da classe*/
  private static $instance;

  public function __construct(){

  }

  /**
  * Método que define o padrão Singleton na classe
  */
  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new AtendenteController();
    return self::$instance;
  }

  /**
  * Método que autentica um Atendente, verificando se ele pode atender na campanha
  * @param $cpf -Cpf do Atendente que deseja verificar se pode atender
  * @param $idCampanha -Código Identificador da campanha que deseja-se verificar o atendimento
  * @return True se o atendente pode atender na campanha, false caso contrário
  */
  public function autenticarAtendente($cpf, $idCampanha){
    return AtendenteCampanhaDAO::getInstance()->autenticarAtendente($cpf,$idCampanha);
  }

  /**
  * Método que efetua um cadastro Rápido no sistema
  * @param $cpf -Cpf que deseja-se cadastrar no banco
  * @param $email -Email do usuário que deseja-se cadastrar no banco
  * @param $senha -Senha, inseridade pelo atendente, da nova conta a ser cadastrada
  * @return True se conseguiu cadastrar ou se já existe um usuário com esse CPF, false caso contrário
  */
  public function cadastroRapido($cpf,$email,$senha){
    UsuarioDAO::getInstance()->adicionarCadastroRapido($cpf,$email,$senha);

    $usuario =UsuarioDAO::buscarUsuario($cpf);

    return ($usuario->getCpf() != null);
  }

  /**
  * Método que Verifica o número de campanhas que o Atendente atende
  * @param $cpf - Cpf do atendente que deseja-se verificar
  * @return Valor inteiro referente ao numero de campanhas que o atendente atende
  */
  public function numCampanhasAtendente($cpf){
    $campanhas = AtendenteController::getInstance()->listarCampanhas($cpf);
    if($campanhas == null){
      return 0;
    }else{
      return sizeof($campanhas);
    }
  }

  /**
  * Método que busca quais são as doações pendentes de um usuário em determinada campanah
  * @param $cpf - Cpf do usuário que deseja-se verificar as doações
  * @param $idCampanha - Código Identificador da campanha que deseja-se verificar as doações pendentes
  * @return Lista contendo objetos do tipo Doacao que dizem respeito as doações pendentes de um usuário em determinada campanha
  */
  public function buscarDoacoesPendentesNaCampanha($cpf,$idCampanha){
    $todasdoacoes = DoacaoDAO::getInstance()->buscarDoacaoNaCampanha($cpf,$idCampanha);
    $doacoespendentes = array();
    for($i = 0 ; $i < sizeof($todasdoacoes) ; $i++){
      if($todasdoacoes[$i]->getConfirmado()  == false){//se não foi confirmado
        $doacoespendentes[] = $todasdoacoes[$i];
      }
    }
    return $doacoespendentes;
  }

  /**
  * Método que verifica o número de convites pendentes para atendimento de um usuárequire_once
  * @param $cpf - O Cpf do usuário que deseja-se descobrir a quantidade de convites pendentes
  * @return Numero de convites pendentes
  */
  public function numConvitesPendentes($cpf){
    $campanhas = AtendenteCampanhaDAO::getInstance()->listarConfirmacoesPendentes($cpf);
    if($campanhas == null){
      return 0;
    }else{
      return sizeof($campanhas);
    }
  }

  /**
  * Método que lista todas as campanhas que determinado usuário atende e que tem o Status de ativa
  * @param $cpf - Cpf do atendente que deseja-se listar as campanhas que atende
  * @return Lista de objetos do tipo Campanha contendo todas as campanhas que o usuário atende e que estão Ativas
  */
  public function listarCampanhas($cpf){
    $campanhas = array();
    $todasCampanhas = AtendenteCampanhaDAO::getInstance()->listarCampanhasAtendente($cpf);

    for ($i=0; $i < sizeof($todasCampanhas) ; $i++) {
      if($todasCampanhas[$i]->getStatus() == true){
        $campanhas[] = $todasCampanhas[$i];
      }
    }
    return $campanhas;
  }

  /**
  * Procedimento que adiciona ao banco de dados a associação referente a uma doação e um material doado, com sua devida quantidade
  * @param $idDoacao - Código identificador da doação que está recebendo os Donativos
  * @param $materiaisDoados - Array contendo  materiais Doados no qual a chave é o código do material e o valor é a quantidade doada
  */
  public function receberMateriais($idDoacao,$materiaisDoados){
    foreach ($materiaisDoados as $key => $value) {
      DoacaoMaterialDAO::getInstance()->adicionarMaterialDoacao($idDoacao,$key, $value);
    }
  }

  /**
  * Método que confirma uma doação e define a data de confirmação como a data atual
  * @param $idDoacao - Código identificador da doação que deseja-se confirmar
  * @param $atendenteConfirma - cpf do Atendente que confirmou a doação
  */
  public function confirmarDoacao($idDoacao, $atendenteConfirma){
    $data = date('d/m/Y');
    DoacaoDAO::getInstance()->confirmarDoacao($data,$atendenteConfirma, $idDoacao);

    AtendenteController::getInstance()->enviarAgradecimento($idDoacao);
  }

  /**
  * Método que envia um agradecimento referente a uma campanha para um usuário
  * @param $idDoacao - Código identificador da doação que deseja-se agradecer
  */
  public function enviarAgradecimento($idDoacao){
    $doacao = DoacaoDAO::getInstance()->buscarDoacaoPorId($idDoacao);
    $campanha = CampanhaDAO::getInstance()->buscarCampanha($doacao->getIdCampanha());

    $agradecimento = new Agradecimento($campanha->getTituloAgradecimento(),$doacao->getCpfDoador(), $campanha->getAgradecimento(), '../img/agradecimento.png', $campanha->getidCampanha());
    AgradecimentoDAO::getInstance()->adicionarAgradecimento($agradecimento);
  }

  /**
  * Método que lista todos os materiais que podem ser recebidos em uma campanha, verificando na Tabela Meta no banco
  * @param $idCampanha - Código identificador da Campanha que deseja-se saber os possíveis materiais arrecadados
  * @return Lista de objetos do tipo Material contendo os materiais que a campanha pode arrecadar
  */
  public function listarMateriaisCampanha($idCampanha){
    $metas =array();
    $metas = MetaDAO::getInstance()->buscarMetasCampanha($idCampanha);
    $materiais = array();
    for ($i=0; $i < sizeof($metas); $i++) {
      $materiais[] = MaterialDAO::getInstance()->buscarMaterial($metas[$i]->getCodMaterial());
    }

    return $materiais;
  }
  /**
  * Método que lista todos os materiais cadastrados no banco
  * @return Lista de objetos do tipo Material contendo todos materiais cadastrados no banco
  */
  public function listarMateriais(){
    return MaterialDAO::getInstance()->listarMateriais();
  }

  /**
  * Método que lista todos as campanhas que o usuário foi convidado para atender, porém ainda não confirmou atendimento
  * @return Lista de objetos do tipo Campanha contendo todas campanhas que o usuário ainda não confirmou atendimento
  */
  public function listarConvitesPendentes($cpf){
    return AtendenteCampanhaDAO::getInstance()->listarConfirmacoesPendentes($cpf);
  }

  /**
  * Método no qual o atendente confirma o desejo de atender uma campanha
  * @param $cpf - Cpf do Atendente que confirmou o desejo de atender um campanha
  * @param $idCampanha - Código identificador da campanha que o usuário predenter atender
  * @return Confirmação de modificação do banco de dados
  */
  public function confirmarParticipacao($cpf, $idCampanha){
    return AtendenteCampanhaDAO::getInstance()->confirmarParticipacaoAtendente($cpf, $idCampanha);
  }

  /**
  * Método no qual o atendente cancela o desejo de atender uma campanha
  * @param $cpf - Cpf do Atendente que deseja cancelar o desejo de atender um campanha
  * @param $idCampanha - Código identificador da campanha que o usuário irá cancelar atendimento
  * @return Confirmação de modificação do banco de dados
  */
  public function cancelarParticipacao($cpf, $idCampanha){
    return AtendenteCampanhaDAO::getInstance()->cancelarParticipacaoAtendente($cpf, $idCampanha);
  }
}
?>
