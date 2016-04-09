<?php

require($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."database/Criptografar.php");
/**
* Classe que contém os scripts SQL usados nos DAO
*/
class Sql
{
  public static $instance;
  private $schema = "boainiciativa";

  protected function __construct(){
  }

  //Usando padrão de projeto Singleton
  public static function getInstance(){

    if (!isset(self::$instance))
    self::$instance = new Sql();

    return self::$instance;
  }


  /**Atributos da tabela de Administrador**/
  private $admTable = "administrador";
  private $admCpf = "cpf";
  private $admSexo = "sexo";
  private $admDataNascimento = "datanascimento";
  private $admEmail = "email";
  private $admSenha = "senha";
  private $admNome = "nome";



  public function adicionarNovoAdministradorSQL(){
    return "INSERT INTO {$this->schema}.{$this->admTable} ({$this->admCpf},{$this->admSexo},{$this->admDataNascimento},{$this->admEmail},{$this->admSenha},{$this->admNome}) VALUES (?,?,?,?,?,?)";
  }

  public function adicionarNovoAdministradormd5SQL(){
    return "INSERT INTO {$this->schema}.{$this->admTable} ({$this->admCpf},{$this->admSexo},{$this->admDataNascimento},{$this->admEmail},{$this->admSenha},{$this->admNome}) VALUES (?,?,?,?,md5(?),?)";
  }

  public function buscarAdministradorSQL(){
    return "SELECT * FROM {$this->schema}.{$this->admTable} WHERE {$this->admCpf} = ?";
  }

  public function buscarAdministradorEmailSQL(){
    return "SELECT * FROM {$this->schema}.{$this->admTable} WHERE {$this->admEmail} = ?";

  }

  public function autenticarAdministradorSQL(){
    return "SELECT * FROM {$this->schema}.{$this->admTable} WHERE {$this->admEmail} = ? AND {$this->admSenha} = ?";
  }

  public function autenticarAdministradorCpfSQL(){
    return "SELECT * FROM {$this->schema}.{$this->admTable} WHERE {$this->admCpf} = ? AND {$this->admSenha} = md5(?)";
  }

  public function verificaAdministradorCadastradoSQL(){
    return "SELECT * FROM {$this->schema}.{$this->admTable} WHERE {$this->admEmail} = ? OR {$this->admCpf} = ?";
  }

  /**Atributos da tabela de Agradecimento**/
  private $agradecimentoTable = "agradecimento";
  private $agradecimentoTitulo = "titulo";
  private $agradecimentoCpfUsuario = "cpfusuario";
  private $agradecimentoMensagem = "mensagem";
  private $agradecimentoImagem = "imagem";
  private $agradecimentoCodCampanha = "codcampanha";
  private $agradecimentoCodAgradecimento = "codagradecimento";

  public function adicionarAgradecimentoSQL(){
    return "INSERT INTO {$this->schema}.{$this->agradecimentoTable} ({$this->agradecimentoTitulo}, {$this->agradecimentoMensagem}, {$this->agradecimentoImagem}, {$this->agradecimentoCodCampanha}, {$this->agradecimentoCpfUsuario}) VALUES (?,?,?,?,?)";
  }

  public function buscarAgradecimentosUsuarioSQL(){
    return "SELECT * FROM {$this->schema}.{$this->agradecimentoTable} WHERE {$this->agradecimentoCpfUsuario} = ?";
  }

  public function buscarAgradecimentosCampanhaSQL(){
    return "SELECT * FROM {$this->schema}.{$this->agradecimentoTable} WHERE {$this->agradecimentoCodCampanha} = ?";
  }

  public function buscarAgradecimentoSQL(){
    return "SELECT * FROM {$this->schema}.{$this->agradecimentoTable} WHERE {$this->agradecimentoCpfUsuario} = ? AND {$this->agradecimentoCodCampanha} = ?";
  }



  /**Atributos da tabela de AtendenteCampanha**/
  private $atendeCampanhaTable = "atendentecampanha";
  private $atendeCampanhaCPF = "cpfatendente";
  private $atendeCampanhaIdCampanha = "idcampanha";
  private $confirmado = "confirmado";

  public function listarCampanhasAtendenteSQL(){
    return "SELECT * FROM {$this->schema}.{$this->atendeCampanhaTable} WHERE {$this->atendeCampanhaCPF} = ?";
  }

  public function listarAtendentesCampanhaSQL(){
    return "SELECT * FROM {$this->schema}.{$this->atendeCampanhaTable} WHERE {$this->atendeCampanhaIdCampanha} = ?";
  }

  public function adicionarAtendenteCampanhaSQL(){
    return "INSERT INTO {$this->schema}.{$this->atendeCampanhaTable} ({$this->atendeCampanhaIdCampanha}, {$this->atendeCampanhaCPF}) VALUES (?,?)";
  }

  public function validarAtendenteCampanhaSQL(){
    return "SELECT * FROM {$this->schema}.{$this->atendeCampanhaTable} WHERE {$this->atendeCampanhaIdCampanha} = ? and {$this->atendeCampanhaCPF} = ?";
  }

  public function deletarAtendenteCampanhaSQL(){
    return "DELETE FROM {$this->schema}.{$this->atendeCampanhaTable} WHERE {$this->atendeCampanhaIdCampanha} = ? and {$this->atendeCampanhaCPF} = ?";
  }


  /**Atributos da tabela de Campanha**/
  private $campanhaTable = "campanha";
  private $campanhaId = "idcampanha";
  private $campanhaNome = "nome";
  private $campanhaInicio = "datainicio";
  private $campanhaFim = "dataFim";
  private $campanhaImagem = "imagem";
  private $campanhaDescricao = "descricao";
  private $campanhaTituloAgradecimento = "tituloagradecimento";
  private $campanhaMensagemAgradecimento = "mensagemagradecimento";
  private $campanhaFinalizaPorData = "finalizapordata";
  private $criadorCPF = "criadorcpf";

    public function adicionarCampanhaSQL(){
      return "INSERT INTO {$this->schema}.{$this->campanhaTable} ({$this->campanhaNome}, {$this->campanhaInicio}, {$this->campanhaFim}, {$this->campanhaImagem}, {$this->campanhaDescricao},
        {$this->campanhaTituloAgradecimento}, {$this->campanhaMensagemAgradecimento}, {$this->campanhaFinalizaPorData}, {$this->criadorCPF}) VALUES (?,?,?,?,?,?,?,?,?)";
    }

    public function listarCampanhasSQL(){
      return "SELECT * FROM {$this->schema}.{$this->campanhaTable}";
    }

    public function deletarMuitasCampanhasSQL(){
      return "DELETE FROM {$this->schema}.{$this->campanhaTable} WHERE {$this->campanhaNome} = ?";
    }

    public function buscarIdCampanhaPorNomeSQL(){
      return "SELECT * FROM {$this->schema}.{$this->campanhaTable} WHERE {$this->$campanhaNome} = ?";
    }

    public function buscarCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->campanhaTable} WHERE {$this->campanhaId} = ?";
    }

    public function procurarCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->campanhaTable} WHERE {$this->campanhaNome} = ?";
    }

    public function procurarCampanhaNomeSQL(){
      return "SELECT * FROM {$this->schema}.{$this->campanhaTable} WHERE LOWER({$this->campanhaNome}) LIKE ?";
    }

    public function editarCampanhaSQL(){
      return "UPDATE {$this->schema}.{$this->campanhaTable} SET {$this->campanhaNome} = ? ,{$this->campanhaFim} = ?, {$this->campanhaDescricao} = ?, {$this->campanhaImagem} = ? WHERE {$this->campanhaId} = ?";
     }

    public function encerrarCampanhaSQL(){
      return "UPDATE {$this->schema}.{$this->campanhaTable} SET {$this->campanhaFim} = ? WHERE {$this->campanhaId} = ?";
    }

    public function buscarCampanhaPorCriadorSQL(){
      return "SELECT * FROM {$this->schema}.{$this->campanhaTable} WHERE {$this->criadorCPF} = ?";
    }

    public function verificarCampanhaCadastradaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->campanhaTable} WHERE {$this->campanhaNome} = ?";
    }

    public function deletarCampanhaSQL(){
      return "DELETE FROM {$this->schema}.{$this->campanhaTable} WHERE {$this->campanhaId} = ?";
    }

    /** Atributos da Tabela de Convidados**/
    private $convidadoTable = "convidado";
    private $convidadoEmail = "email";
    private $convidadoCodigo = "codconvidado";
    private $convidadoClassificacao = "classificacao";


    public function buscarConvidadoPorEmailSQL(){
      return "SELECT * FROM {$this->schema}.{$this->convidadoTable} WHERE {$this->convidadoEmail} = ?";
    }

    public function adicionarConvidadoSQL(){
      return "INSERT INTO {$this->schema}.{$this->convidadoTable} ({$this->convidadoEmail}, {$this->convidadoClassificacao}) VALUES ( ? , ? )";
    }

    public function buscarEmailConvidadoSQL(){
      return "SELECT * FROM {$this->schema}.{$this->convidadoTable} WHERE {$this->convidadoCodigo} = ?";
    }

    public function verificarConvidadoCadastradoSQL(){
      return "SELECT * FROM {$this->schema}.{$this->convidadoTable} WHERE {$this->convidadoEmail} = ?";
    }
    /** Atributos da Tabela de Convites**/
    private $conviteTable = "convite";
    private $conviteIdCampanha = "idcampanha";
    private $conviteCodConvidado = "codconvidado";
    private $conviteData = "data";
    private $conviteCPF = "cpf";

    public function adicionarConviteSQL(){
      return "INSERT INTO {$this->schema}.{$this->conviteTable} ({$this->conviteIdCampanha},{$this->conviteCodConvidado},{$this->conviteData},{$this->conviteCPF}) VALUES (?,?,?,?)";
    }

    public function buscarConvitesCampanhaPorIdSQL(){
      return "SELECT * FROM {$this->schema}.{$this->conviteTable} WHERE {$this->conviteIdCampanha} = ?";
    }

    public function buscarConvitesCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->conviteTable} WHERE {$this->conviteCPF} = ?";
    }

    public function listarConvitesSQL(){
      return "SELECT * FROM {$this->schema}.{$this->conviteTable}";
    }


    /** Atributos da Tabela de Denuncia**/
    private $denunciaTable = "denuncia";
    private $denunciaCod = "coddenuncia";
    private $denunciaIdCampanha = "idcampanha";
    private $denunciaMotivo = "motivo";
    private $denunciaDescricao = "descricao";
    private $denunciaCPF = "cpf";

    public function adicionarDenunciaSQL(){
      return "INSERT INTO {$this->schema}.{$this->denunciaTable} ({$this->denunciaIdCampanha}, {$this->denunciaMotivo}, {$this->denunciaDescricao}, {$this->denunciaCPF}) VALUES (?,?,?,?)";
    }

    public function buscarDenunciaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->denunciaTable} WHERE {$this->denunciaCPF} = ? AND {$this->denunciaIdCampanha} = ? ";
    }
    public function buscarDenunciasEfetuadasSQL(){
      return "SELECT * FROM {$this->schema}.{$this->denunciaTable} WHERE {$this->denunciaCPF} = ?";
    }

    public function buscarDenunciasCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->denunciaTable} WHERE {$this->denunciaIdCampanha} = ?";
    }

    public function verificaDenunciaCadastradaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->denunciaTable} WHERE {$this->denunciaCPF} = ? AND  {$this->denunciaIdCampanha} = ?";
    }
    public function listarDenunciasSQL(){
      return "SELECT * FROM {$this->schema}.{$this->denunciaTable}";
    }
    public function removerDenunciasCpfSQL(){
      return "DELETE FROM {$this->schema}.{$this->denunciaTable} WHERE {$this->denunciaCPF} = ?";
    }



    /** Atributos da Tabela de Doacao**/
    private $doacaoTable = "doacao";
    private $doacaoId = "iddoacao";
    private $doacaoConfirmado = "confirmado";
    private $doacaoData = "data";
    private $doacaoAtendenteConfirma = "atendenteconfirma";
    private $doacaoIdCampanha = "idcampanha";
    private $doacaoCpfDoador = "doadorcpf";

	public function excluirDoacaoPendente(){
	    return "DELETE FROM {$this->schema}.{$this->doacaoTable} WHERE {$this->doacaoCpfDoador} = ? and {$this->doacaoIdCampanha} = ?";
	}
    public function adicionarDoacaoSQL(){
      return "INSERT INTO {$this->schema}.{$this->doacaoTable} ({$this->doacaoConfirmado},{$this->doacaoData},{$this->doacaoAtendenteConfirma},{$this->doacaoIdCampanha},{$this->doacaoCpfDoador}) VALUES (FALSE,?,NULL,?,?)";
    }

    public function editarDoacaoSQL(){
      return "UPDATE {$this->schema}.{$this->doacaoTable} SET {$this->doacaoConfirmado} = ?, {$this->doacaoData} = ?, {$this->doacaoAtendenteConfirma} = ? WHERE {$this->doacaoId} = ?";
    }
    public function buscarDoacoesDaCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->doacaoTable} WHERE {$this->doacaoIdCampanha} = ?";
    }

    public function buscarDoacoesDoDoadorSQL(){
      return "SELECT * FROM {$this->schema}.{$this->doacaoTable}  WHERE {$this->doacaoCpfDoador} = ?";
    }

    public function buscarDoacaoPorIdSQL(){
      return "SELECT * FROM {$this->schema}.{$this->doacaoTable}  WHERE {$this->doacaoId} = ?";
    }

    public function buscarDoacoesPorAtendenteSQL(){
      return "SELECT * FROM {$this->schema}.{$this->doacaoTable}  WHERE {$this->doacaoAtendenteConfirma} = ?";
    }

    /** Atributos da Tabela DoacaoMaterial*/
    private $doacaoMaterialTable = "doacaomaterial";
    private $doacaoMaterialDoacaoId = "iddoacao";
    private $doacaoMaterialCodMaterial = "codmaterial";
    private $doacaoMaterialQuantidade = "quantidade";

    public function adicionarMaterialDoacaoSQL(){
      return "INSERT INTO {$this->schema}.{$this->doacaoMaterialTable} ({$this->doacaoMaterialDoacaoId},{$this->doacaoMaterialCodMaterial},{$this->doacaoMaterialQuantidade}) VALUES (?,?,?)";
    }

    public function listarMateriaisDaDoacaoSQL(){
      return "SELECT * FROM {$this->schema}.{$this->doacaoMaterialTable} WHERE {$this->doacaoMaterialDoacaoId} = ?";
    }

    public function buscarMaterialDoacaoPorCodigoSQL(){
      return "SELECT * FROM {$this->schema}.{$this->doacaoMaterialTable} WHERE {$this->doacaoMaterialCodMaterial} = ?";
    }

    public function removerMaterialDoacaoSQL(){
      return "DELETE FROM {$this->schema}.{$this->doacaoMaterialTable} WHERE {$this->doacaoMaterialDoacaoId} = ? AND {$this->doacaoMaterialCodMaterial} = ?";
    }



    /** Atributos da tabela Material*/
    private $materialTable = "material";
    private $materialCod = "codmaterial";
    private $materialNome = "nome";
    private $materialMedida = "medida";

    public function adicionarMaterialSQL(){
      return "INSERT INTO {$this->schema}.{$this->materialTable} ({$this->materialNome},{$this->materialMedida}) VALUES (?,?)";
    }

    public function removerMaterialSQL(){
      return "DELETE FROM {$this->schema}.{$this->materialTable} WHERE {$this->materialCod} = ?";
    }

    public function buscarMaterialSQL(){
      return "SELECT * FROM {$this->schema}.{$this->materialTable} WHERE {$this->materialCod} = ?";
    }

    public function buscarMaterialNomeSQL(){
      return "SELECT * FROM {$this->schema}.{$this->materialTable} WHERE {$this->materialNome} = ?";
    }

    public function buscarCodMaterialSQL(){
      return "SELECT * FROM {$this->schema}.{$this->materialTable} WHERE {$this->materialNome} = ?";
    }

    public function listarMateriaisSQL(){
      return "SELECT * FROM {$this->schema}.{$this->materialTable}";
    }


    /** Atributos da Tabela Meta*/
    private $metaTable = "metacampanha";
    private $metaCodMaterial = "codmaterial";
    private $metaIdCampanha = "idcampanha";
    private $metaQuantidade = "quantidade";


    public function adicionarMetaSQL () {
      return "INSERT INTO {$this->schema}.{$this->metaTable} ({$this->metaCodMaterial},{$this->metaIdCampanha},{$this->metaQuantidade}) VALUES (?,?,?)";
    }

    public function validadeAdicionarMetaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->metaTable} WHERE {$this->metaCodMaterial} = ? and {$this->metaIdCampanha} = ?";
    }

    public function buscarmetasCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->metaTable} WHERE {$this->metaIdCampanha} = ?";
    }

    /** Atributos da Tabela PontoCampanha*/
    private $pontoCampanhaTable = "pontocampanha";
    private $pontoCampanhaIdPonto = "idponto";
    private $pontoCampanhaIdCampanha = "idcampanha";

    public function buscarPontosCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->pontoCampanhaTable} WHERE {$this->pontoCampanhaIdCampanha} = ?";
    }
    public function buscarCampanhaPontoSQL (){
      return "SELECT * FROM {$this->schema}.{$this->pontoCampanhaTable} WHERE {$this->pontoCampanhaIdPonto} = ?";
    }

    public function adicionarCampanhaPontoSQL(){
      return "INSERT INTO {$this->schema}.{$this->pontoCampanhaTable} ({$this->pontoCampanhaIdPonto}, {$this->pontoCampanhaIdCampanha}) VALUES (?,?)";
    }



    /** Atributos da Tabela Ponto*/
    private $pontoTable = "ponto";
    private $pontoId = "idponto";
    private $pontoCEP = "cep";
    private $pontoEstado = "estado";
    private $pontoBairro = "bairro";
    private $pontoCidade = "cidade";
    private $pontoLogradouro = "logradouro";
    private $pontoNumero = "numero";
    private $pontoComplemento = "complemento";
    private $pontoLatitude = "latitude";
    private $pontoLongitude = "longitude";

    public function adicionarPontoSQL(){
      return "INSERT INTO {$this->schema}.{$this->pontoTable} ({$this->pontoCEP}, {$this->pontoEstado}, {$this->pontoBairro}, {$this->pontoCidade}, {$this->pontoLogradouro}, {$this->pontoNumero}, {$this->pontoComplemento}, {$this->pontoLatitude}, {$this->pontoLongitude}) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    }

    public function buscarPontoCidadeSQL(){
      return "SELECT * FROM {$this->schema}.{$this->pontoTable} WHERE {$this->pontoCidade} = ?";
    }

    public function buscarPontoRegiaoSQL(){
      return "SELECT * FROM {$this->schema}.{$this->pontoTable} WHERE {$this->pontoCEP} = ?";
    }

    public function buscarPontoColetaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->pontoTable} WHERE {$this->pontoId} = ?";
    }

    public function deletarPontoColetaSQL(){
      return "DELETE FROM {$this->schema}.{$this->pontoTable} WHERE {$this->pontoId} = ?";
    }

    public function verificarPontoCadastradoSQL(){
      return "SELECT * FROM {$this->schema}.{$this->pontoTable} WHERE {$this->pontoCEP} = ? AND {$this->pontoEstado} = ? AND {$this->pontoBairro} = ? AND {$this->pontoCidade} = ? AND {$this->pontoLogradouro} = ? AND {$this->pontoNumero} = ? AND {$this->pontoComplemento} = ?";
    }


    /** Atributos da Tabela TagCampanha*/
    private $tagCampanhaTable = "campanhatag";
    private $tagCampanhaIdCampanha = "idcampanha";
    private $tagCampanhaIdTag = "idtag";

    public function associarCampanhaTagSQL(){
      return "INSERT INTO {$this->schema}.{$this->tagCampanhaTable} ({$this->tagCampanhaIdCampanha}, {$this->tagCampanhaIdTag}) VALUES (?,?)";
    }

    public function buscarCampanhasPorTagSQL(){
      return "SELECT * FROM {$this->schema}.{$this->tagCampanhaTable} WHERE {$this->tagCampanhaIdTag} = ?";
    }

    public function buscarTagsDaCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->tagCampanhaTable} WHERE {$this->tagCampanhaIdCampanha} = ?";
    }

    public function verificarTagCampanhaSQL(){
      return "SELECT * FROM {$this->schema}.{$this->tagCampanhaTable} WHERE {$this->tagCampanhaIdCampanha} = ? AND {$this->tagCampanhaIdTag} = ? ";
    }

    public function buscarCampanhasPorTagLimiteSQL($totalPagina, $inicio){
      return "SELECT * FROM {$this->schema}.{$this->tagCampanhaTable} WHERE {$this->tagCampanhaIdTag} [LIMIT {$totalPagina}] [OFFSET {$inicio}]";
    }

    /**Atributos da Tabela Tag*/
    private $tagTable = "tag";
    private $tagId = "idtag";
    private $tagNome = "nome";

    public function adicionarTagSQL(){
      return "INSERT INTO {$this->schema}.{$this->tagTable} ({$this->tagNome}) VALUES (?)";
    }

    public function removerTagSQL(){
      return "DELETE FROM {$this->schema}.{$this->tagTable} WHERE {$this->tagId} = ?";
    }

    public function listarTagsSQL(){
      return "SELECT * FROM {$this->schema}.{$this->tagTable}";
    }

    public function buscarTagNomeSQL(){
      return "SELECT * FROM {$this->schema}.{$this->tagTable} WHERE {$this->tagNome} = ?";
    }

    public function buscarTagIdSQL(){
      return "SELECT * FROM {$this->schema}.{$this->tagTable} WHERE {$this->tagId} = ?";
    }

    /** Atributos da Tabela de Usuario*/
    private $usuarioTable = "usuario"  ;
    private $usuarioCPF = "cpf";
    private $usuarioSexo = "sexo";
    private $usuarioNascimento = "datanascimento";
    private $usuarioFoto = "foto";
    private $usuarioEmail = "email";
    private $usuarioSenha = "senha";
    private $usuarioNome = "nome";
    private $usuarioClassificacao = "classificacao";
    private $usuarioCEP = "cep";
    private $usuarioEstado = "estado";
    private $usuarioBairro = "bairro";
    private $usuarioCidade = "cidade";
    private $usuarioLogradouro = "logradouro";
    private $usuarioNumero = "numero";
    private $usuarioComplemento = "complemento";
    private $usuarioBloqueado = "bloqueado";
    private $usuarioDataBloqueio = "databloqueio";
    private $usuarioLatitude = "latitude";
    private $usuarioLongitude = "longitude";

    public function listarUsuariosSQL(){
      return "SELECT * FROM {$this->schema}.{$this->usuarioTable}";
    }

    public function listarUsuariosBloqueadosSQL(){
      return "SELECT * FROM {$this->schema}.{$this->usuarioTable} WHERE {$this->usuarioBloqueado} = TRUE";
    }

    public function adicionarNovoUsuarioSQL(){
      return "INSERT INTO {$this->schema}.{$this->usuarioTable} ({$this->usuarioCPF}, {$this->usuarioSexo}, {$this->usuarioNascimento},
        {$this->usuarioEmail}, {$this->usuarioSenha}, {$this->usuarioNome}, {$this->usuarioClassificacao}, {$this->usuarioCEP}, {$this->usuarioEstado}, {$this->usuarioBairro},
        {$this->usuarioCidade}, {$this->usuarioLogradouro}, {$this->usuarioNumero},{$this->usuarioComplemento}, {$this->usuarioBloqueado},{$this->usuarioDataBloqueio},{$this->usuarioFoto}) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?, DEFAULT, NULL,?)";
      }

      public function adicionarCadastroRapidoSQL(){
        return "INSERT INTO {$this->schema}.{$this->usuarioTable} ({$this->usuarioCPF},{$this->usuarioEmail},{$this->usuarioSenha}) VALUES (?,?,?)";
      }

      public function buscarUsuarioSQL(){
        return "SELECT * FROM {$this->schema}.{$this->usuarioTable} WHERE {$this->usuarioCPF} = ?";
      }

      public function buscarUsuarioEmailSQL(){
        return "SELECT * FROM {$this->schema}.{$this->usuarioTable} WHERE {$this->usuarioEmail} = ?";
      }

      public function autenticarUsuarioSQL(){
        return "SELECT * FROM {$this->schema}.{$this->usuarioTable} WHERE {$this->usuarioCPF} = ? AND {$this->usuarioSenha} = ? AND {$this->usuarioBloqueado} = 'FALSE'";
      }

      public function editarPerfilSQL(){
        return "UPDATE {$this->schema}.{$this->usuarioTable} SET {$this->usuarioSexo}=?, {$this->usuarioNascimento}=?,  {$this->usuarioFoto}=?,
        {$this->usuarioEmail}=?, {$this->usuarioNome}=?, {$this->usuarioClassificacao}=?, {$this->usuarioCEP}=?,
        {$this->usuarioEstado}=?, {$this->usuarioBairro}=?, {$this->usuarioCidade}=?, {$this->usuarioLogradouro}=?, {$this->usuarioNumero}=?,
        {$this->usuarioComplemento}=? WHERE {$this->usuarioCPF} = ?";
      }

      public function editarSenhaSQL(){
        return "UPDATE {$this->schema}.{$this->usuarioTable} SET {$this->$usuarioSenha}=? WHERE {$this->usuarioCPF} = ?";
      }

      public function deletarUsuarioSQL(){
        return "DELETE FROM {$this->schema}.{$this->usuarioTable} WHERE {$this->usuarioCPF} = ?";
      }

      public function bloquearUsuarioSQL(){
        return "UPDATE {$this->schema}.{$this->usuarioTable} SET {$this->usuarioBloqueado} = TRUE , {$this->usuarioDataBloqueio} = ? WHERE {$this->usuarioCPF} = ?";
      }

      public function desbloquearUsuarioSQL(){
        return "UPDATE {$this->schema}.{$this->usuarioTable} SET {$this->usuarioBloqueado} = FALSE, {$this->usuarioDataBloqueio} = NULL WHERE {$this->usuarioCPF} = ?";
      }

      public function verificarUsuarioCadastradoSQL(){
        return "SELECT * FROM {$this->schema}.{$this->usuarioTable} WHERE {$this->usuarioEmail} = ? OR {$this->usuarioCPF} = ?";
      }

      public function adicionarNovoUsuariomd5SQL(){
      return "INSERT INTO {$this->schema}.{$this->usuarioTable} ({$this->usuarioCPF}, {$this->usuarioSexo}, {$this->usuarioNascimento},
        {$this->usuarioEmail}, {$this->usuarioSenha}, {$this->usuarioNome}, {$this->usuarioClassificacao}, {$this->usuarioCEP}, {$this->usuarioEstado}, {$this->usuarioBairro},
        {$this->usuarioCidade}, {$this->usuarioLogradouro}, {$this->usuarioNumero},{$this->usuarioComplemento}, {$this->usuarioBloqueado},{$this->usuarioDataBloqueio},{$this->usuarioFoto},{$this->usuarioLatitude},{$this->usuarioLongitude}) VALUES (?,?,?,?,md5(?),?,?,?,?,?,?,?,?,?, DEFAULT, NULL,?,?,?)";
      }

      public function adicionarCadastroRapidomd5SQL(){
        return "INSERT INTO {$this->schema}.{$this->usuarioTable} ({$this->usuarioCPF},{$this->usuarioEmail},{$this->usuarioSenha}) VALUES (?,?,md5(?))";
      }
      public function editarSenhamd5SQL(){
        return "UPDATE {$this->schema}.{$this->usuarioTable} SET {$this->$usuarioSenha}=md5(?) WHERE {$this->usuarioCPF} = ?";
      }

    }

    ?>
