<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/TagDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MaterialDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/TagCampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/AtendenteCampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/PontoDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/PontoCampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MetaDAO.php");


/**
*Classe CriadorController
* Classe responsável por controlar todas as solicitações referentes ao criador.
*/
class  CriadorController
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new CriadorController();
    return self::$instance;
  }

  /** Método responsável por listar campanhas de um determinado usuário
  * @param $cpf cpf usado para buscar as campanhas de um determinado usuário
  * @param $filtro filtro que indica se a busca é por campanhas ativas, finalizadas ou todas
  * @return retorna uma lista de campanhas
  */
  public function listarCampanhas($cpf, $filtro){
    $todascampanhas = CampanhaDAO::getInstance()->buscarCampanhaPorCriador($cpf);
    if($filtro == "ativas"){
      $campanhasativas = array();
      for($i = 0 ; $i < sizeof($todascampanhas) ; $i++){
        if($todascampanhas[$i]->getStatus()  == true){//se está ativa
          $campanhasativas[] = $todascampanhas[$i];
        }
      }
      return $campanhasativas;
    }else if ($filtro == "finalizadas"){
      $campanhasfinalizadas = array();
      for($i = 0 ; $i < sizeof($todascampanhas) ; $i++){
        if($todascampanhas[$i]->getStatus()  == false){//se está finalizada
          $campanhasfinalizadas[] = $todascampanhas[$i];
        }
      }
      return $campanhasfinalizadas;
    }else {// se não for nem ativa nem finalizada ou o filtro for errado
      return $todascampanhas;
    }
  }//fecha a funcao




  /** Método responsável por verificar campanhas cadastradas
  * @return retorna as campanhas
  */
  function verificaCampanhaCadastrada($nome){
    return CampanhaDAO::getInstance()->verificaCampanhaCadastrada($nome);
  }

  /** Método responsável por editar uma campanha
  * @param $campanha informações da campanha que deverá ser editada
  */
  function editarCampanha($campanha){
    CampanhaDAO::getInstance()->editarCampanha($campanha);
  }

  /** Método responsável por listar todas as tags
  * @return retorna uma lista de tags
  */
  function listarTags(){
    return TagDAO::getInstance()->listarTags();
  }

  /** Método responsável por buscar uma campanha
  * @param $id id da campanha que deve ser buscada
  * @return informações da campanha buscada
  */
  function buscarCampanha($id){
    return CampanhaDAO::getInstance()->buscarCampanha($id);
  }

  /** Método responsável por adicionar um atendente a uma campanha
  * @param $idcampanha id da campanha
  * @param $cpfAtendente CPF do usuário que será atendente nesta campanha
  */
  function adicionarAtendenteCampanha($idCampanha, $cpfAtendente){
    AtendenteCampanhaDAO::getInstance()->adicionarAtendenteCampanha($idCampanha, $cpfAtendente);
  }

  /** Método responsável por listar todos os atendentes de uma campanha
  * @param $idcampanha id da campanha em questão
  * @return lista dos atendentes da campanha
  */
  function listarAtendentesCampanha($idCampanha){
    return AtendenteCampanhaDAO::getInstance()->listarAtendentesCampanha($idCampanha);
  }

  /** Método responsável por buscar informações do usuário criador de uma campanha
  * @param $cpf cpf do usuário que está sendo buscado
  * @return informações do usuário buscado
  */
  function buscarCriadorCampanha($cpf){
    return UsuarioDAO::getInstance()->buscarUsuario($cpf);
  }

  /** Método responsável por buscar as metas de uma determinada campanha
  * @param $id identificador da campanha
  * @return metas da campanha
  */
  function buscarMetasCampanha($id){
    return MetaDAO::getInstance()->buscarMetasCampanha($id);
  }

  /** Método responsável por buscar todos os materiais
  * @return materiais
  */
  function listarMateriais(){
    return MaterialDAO::getInstance()->listarMateriais();
  }

  /** Método responsável por cadastrar materiais
  * @param $nome nome do material em questão
  * @param $medida medida do material
  * @return o id da inserção desse material
  */
  function cadastrarMaterial($nome, $medida){
    $material = new Material($nome, $medida, null);
    return MaterialDAO::getInstance()->adicionarMaterial($material);
  }

  /** Método responsável por cadastrar a meta de um material em uma campanha
  * @param $idcampanha id da campanha em que a meta deverá ser inserida
  * @param $codmaterial codigo identificador do material que será inserido
  * @param $qtd quantidade desse material que se deseja alcançar como meta
  * @return booleano se a operação deu certo ou não
  */
  function cadastrarMetaMaterial($idCampanha, $codMaterial, $qtd){
    $meta = new Meta(intval($idCampanha), intval($codMaterial), intval($qtd));
    MetaDAO::getInstance()->adicionarMeta($meta);
  }


  /** Método responsável por cadastrar a meta de um material em uma campanha
  $nome, $descricao, $dataInicio, $imagem, $cpf, $metaOuData, $dataFim, $agradecimento, $titulo, $valores, $categoria
  * @param $nome nome da campanha a ser cadastrada
  * @param $descricao descrição da campanha a ser cadastrada
  * @param $dataInicio data do início da campanha a ser cadastrada
  * @param $imagem imagem da campanha a ser cadastrada
  * @param $cpf CPF do usuário que está criando a campanha
  * @param $metaOuData identifica se a campanha finaliza por meta ou data
  * @param $dataFim data do fim da campanha
  * @param $agradecimento agradecimento padrão da campanha
  * @param $titulo título do agradecimento padrão da campanha
  * @param $valores valores pré definidos caso seja uma campanha monetária
  * @param $categoria categoria a qual essa campanha pertence
  * @return id da campanha que acabou de ser cadastrada
  */
  function criarCampanha($nome, $descricao, $dataInicio, $imagem, $cpf, $metaOuData, $dataFim, $agradecimento, $titulo, $valores, $categoria){
    $campanha = new Campanha(null, $nome, $descricao, $dataInicio, $imagem, $cpf, $metaOuData, $dataFim);
    $campanha->setAgradecimento($agradecimento);
    $campanha->setTituloAgradecimento($titulo);
    $campanha->setValores($valores);
    
    $id = CampanhaDAO::getInstance()->adicionarCampanha($campanha);
    TagCampanhaDAO::getInstance()->associarCampanhaTag($categoria, $id);
    return $id;
  }

  /** Método responsável por buscar um material específico
  * @param $codigo código do material que se deseja buscar
  * @return booleano se a operação deu certo ou não
  */
  function buscarMaterial($codigo){
    return MaterialDAO::getInstance()->buscarMaterial($codigo);
  }

  /** Método responsável por cadastrar a meta de um material em uma campanha
  * @param $idcampanha id da campanha que se deseja excluir
  */
  function excluirCampanha($idCampanha){
    CampanhaDAO::getInstance()->deletarCampanha($idCampanha);
  }

  /** Método responsável por cadastrar os endereços dos pontos de coleta de uma campanha
  *@param $idCampanha id da campanha a qual será adicionada os pontos de coleta
  *@param $endereco uma string que contém o endereço do ponto de coleta
  */

  function cadastrarEndereco($idCampanha, $endereco){
    $idPonto = PontoDAO::getInstance()->adicionarPonto($endereco);
    PontoCampanhaDAO::getInstance()->adicionarCampanhaPonto($idPonto, $idCampanha);
  }


}

?>
