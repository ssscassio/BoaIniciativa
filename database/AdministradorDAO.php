<?php

require_once("ConexaoDB.php");
require_once("Sql.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Administrador.php");
/**
*Classe AdministradorDAO
* Classe referente a manipulação de um administrador no banco de dados
*/
class AdministradorDAO{

  private static $instance;

  protected function __construct(){

  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new AdministradorDAO();
    return self::$instance;
  }

  /** Método responsável pela personificação das informações da tabela Administrador como um objeto php
  * @param $row array que contém as informações de uma linha onde as chaves são os nomes das colunas e os valores são referentes ao valor da coluna daquela linha
  * @return objeto do tipo Administrador
  */
  private function popularAdm($row){
    $adm = new Administrador($row['cpf'],
    $row['nome'],
    $row['senha'],
    $row['email'],
    $row['sexo'],
    $row['datanascimento']);
    return $adm;
  }

  /** Método responsável por buscar um administrador através do e-mail
  * @param $email email do administrador
  * @return objeto do tipo Administrador
  */
  public static function buscarAdministradorEmail($email){
    try{
      $sql = Sql::getInstance()->buscarAdministradorEmailSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$email);
      $stmt->execute();
      return self::popularAdm($stmt->fetch(PDO::FETCH_ASSOC));

    }catch (Exception $e){

    }
  }

  /** Método responsável por buscar um administrador através do cpf
  * @param $cpf cpf do administrador
  * @return objeto do tipo Administrador
  */
  public static function buscarAdministrador($cpf){
    try{
      $sql = Sql::getInstance()->buscarAdministradorSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpf);
      $stmt->execute();
      return self::popularAdm($stmt->fetch(PDO::FETCH_ASSOC));

    }catch (Exception $e){

    }
  }

  /** Método responsável por adicionar um novo administrador
  * @param $administrador informações do administrador que deve ser cadastrado
  */
  public static function adicionarNovoAdministrador($administrador){

    try{
      $sql = Sql::getInstance()->adicionarNovoAdministradorSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$administrador->getCpf());
      $stmt->bindParam(2,$administrador->getSexo());
      $stmt->bindParam(3,$administrador->getDataNascimento());
      $stmt->bindParam(4,$administrador->getEmail());
      $stmt->bindParam(5,Criptografar::hash($administrador->getSenha()));
      $stmt->bindParam(6,$administrador->getNome());
      $stmt->execute();

    }catch (Exception $e){

    }
  }

  /** Método responsável por adicionar um novo administrador utilizando criptografia md5
  * @param $administrador informações do administrador que deve ser cadastrado
  */
  public static function adicionarNovoAdministradormd5($administrador){

    try{
      $sql = Sql::getInstance()->adicionarNovoAdministradormd5SQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$administrador->getCpf());
      $stmt->bindParam(2,$administrador->getSexo());
      $stmt->bindParam(3,$administrador->getDataNascimento());
      $stmt->bindParam(4,$administrador->getEmail());
      $stmt->bindParam(5,$administrador->getSenha());
      $stmt->bindParam(6,$administrador->getNome());
      $stmt->execute();

    }catch (Exception $e){

    }
  }

  /** Método responsável por autenticar um administrador com uso da criptografia
  * @param $cpfAdm cpf do administrador
  * @param $senhaAdm senha do administrador
  * @return retorna confirmação se ele foi autenticado ou não
  */
  public static function autenticarAdministrador($cpf, $senha){
    try{
      $hash = self::buscarAdministrador($cpf);
      return Criptografar::check($senha, $hash->getSenha());
    } catch (Excepetion $e){

    }
  }

  /** Método responsável por autenticar um administrador
  * @param $cpfAdm cpf do administrador
  * @param $senhaAdm senha do administrador
  * @return retorna confirmação se ele foi autenticado ou não
  */
  public static function autenticarAdministradorCpf($cpf, $senha){
    try{
      $sql = Sql::getInstance()->autenticarAdministradorCpfSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$cpf);
      $stmt->bindParam(2,$senha);
      $stmt->execute();
      return ($stmt->rowCount() > 0);

    } catch (Excepetion $e){

    }
    return FALSE;
  }


  /** Método que verifica se um cpf ou email já está sendo usado
  * @param $cpfAdm cpf do administrador
  * @param $email email do administrador
  * @return retorna true caso o email já esteja sendo usado
  */
  public static function verificaAdministradorCadastrado($cpf,$email){
    try{
      $sql = Sql::getInstance()->verificaAdministradorCadastradoSQL();
      $stmt = ConexaoDB::getConexaoPDO()->prepare($sql);
      $stmt->bindParam(1,$email);
      $stmt->bindParam(2,$cpf);
      $stmt->execute();
      return ($stmt->rowCount() > 0); //True = Administrador ou email já utilizado, False = cadastro liberado

    } catch (Excepetion $e){
      
    }
    return FALSE;
  }

}
?>
