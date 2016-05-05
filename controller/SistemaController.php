<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/UsuarioDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MetaDAO.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/MaterialDAO.php");

/**
*Classe SistemaController
* Classe responsável por controlar todas as solicitações referentes ao sistema.
*/
class SistemaController
{

  private static $instance;

  public function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new SistemaController();
    return self::$instance;
  }



  /** Método responsável por realizar o cadastro de um usuário
  * @param $nome nome do usuário que será cadastrado
  * @param $cpf CPF do usuário que será cadastrado
  * @param $email email do usuário que será cadastrado
  * @param $senha senha do usuário que será cadastrado
  * @param $nascimento data de nascimento do usuário que será cadastrado
  * @param $cep cep do usuário que será cadastrado
  * @param $estado estado do usuário que será cadastrado
  * @param $bairro bairro do usuário que será cadastrado
  * @param $cidade cidade do usuário que será cadastrado
  * @param $longradouro logradouro do usuário que será cadastrado
  * @param $numero numero do usuário que será cadastrado
  * @param $complemento complemento do usuário que será cadastrado
  * @param $sexo sexo do usuário que será cadastrado
  * @return o usuário cadastrado se a operação houver sido realizada com sucesso
  */
  public function cadastrarUsuario($nome,$cpf,$email,$senha,$nascimento,$cep,$estado,$bairro,$cidade,$longradouro,$numero,$complemento,$sexo){
    $endereco = array('cep'=> $cep,
    'estado'=>$estado,
    'bairro'=>$bairro,
    'cidade'=>$cidade,
    'logradouro'=>$longradouro,
    'numero'=>$numero,
    'complemento'=>$complemento);
    $usuario = new Usuario($nome, $cpf, $email, $senha, 'default.jpg', $sexo, $nascimento, $endereco, 0, false, null);

    $confirmacao = UsuarioDAO::getInstance()->adicionarNovoUsuario($usuario);
    //tenta encontrar o usuario
    $usuariobusca = UsuarioDAO::getInstance()->buscarUsuario($cpf);
    return ($usuariobusca->getCpf() != null);

  }

  /** Método responsável por buscar uma campanha a partir do seu id
  * @param $idcampanha id da campanha que se deseja buscar
  * @return informações da campanha que foi buscada
  */
  public function buscarCampanha($idCampanha){
    return CampanhaDAO::getInstance()->buscarCampanha($idCampanha);
  }

  /** Método responsável por verificar se uma campanha é monetária
  * @param $idcampanha id da campanha que se deseja verificar
  * @return booleano se a campanha é monetária ou não
  */
  public function verificarCampanhaMonetaria($idCampanha){
    $materiais = SistemaController::getInstance()->listarMateriaisCampanha($idCampanha);
    $isMonetaria = false;
    for($i=0; $i < sizeof($materiais); $i++){
      if($materiais[$i]->getNome() =="Dinheiro"){
        $isMonetaria = true;
      }
    }
    return $isMonetaria;
  }

  /** Método responsável por listar os materiais de uma campanha
  * @param $idcampanha id da campanha que se deseja buscar
  * @return materiais daquela campanha
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

  /** Método responsável por realizar a edição das informações de um usuário
  * @param $nome nome do usuário
  * @param $email email do usuário
  * @param $senha senha do usuário
  * @param $foto foto do usuário
  * @param $sexo sexo do usuário
  * @param $nascimento data de nascimento do usuário
  * @param $classificacao classificação do usuário
  * @param $cep cep do usuário que será cadastrado
  * @param $estado estado do usuário
  * @param $bairro bairro do usuário
  * @param $cidade cidade do usuário
  * @param $longradouro logradouro do usuário
  * @param $numero numero do usuário
  * @param $complemento complemento do usuário
  * @param $cpf CPF do usuário
  * @param $bloqueado blooleano que indica se o usuário está bloqueado ou não
  * @param $databloqueio data do bloqueio do usuário (caso ele esteja bloqueado)
  * @param $latitude latituode referente ao endereço do usuário
  * @param $longitude longitude referente ao endereço do usuário
  * @return o usuário editado
  */
  function editarPerfil($nome, $email, $senha, $foto, $sexo, $nascimento, $classificacao, $cep, $estado,
  $bairro, $cidade, $logadouro, $numero, $complemento, $cpf, $bloqueado, $dataBloqueio, $latitude, $longitude){

    $endereco = array("cep"=> $cep,
    "estado"=> $estado,
    "bairro"=> $bairro,
    "cidade"=> $cidade,
    "logradouro"=> $logadouro,
    "numero"=>$numero,
    "complemento"=> $complemento);

    $usuario = new Usuario($nome, $cpf, $email, $senha, $foto, $sexo, $nascimento, $endereco, $classificacao, $bloqueado, $dataBloqueio);
    $usuario->setLatitude($latitude);
    $usuario->setLongitude($longitude);
    return UsuarioDao::getInstance()->editarPerfil($usuario);
  }

  /** Método responsável por excluir o perfil de um usuário
  * @param $cpf CPF do usuário que deve ser excluído
  * @return confirmação se o usuário foi deletado ou não
  */
  function excluirPerfil($cpf){
    return UsuarioDao::getInstance()->deletarUsuario($cpf);
  }

}

?>
