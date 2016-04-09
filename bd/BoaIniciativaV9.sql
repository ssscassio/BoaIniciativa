-------Parte que deve ser removida depois, quando for colocar em produção-------

DROP DATABASE IF EXISTS "boaini_BoaIniciativa" ;
CREATE DATABASE "boaini_BoaIniciativa";
DROP SCHEMA IF EXISTS public CASCADE;
DROP SCHEMA IF EXISTS BoaIniciativa CASCADE;
CREATE SCHEMA IF NOT EXISTS BoaIniciativa;
ALTER SCHEMA BoaIniciativa OWNER TO boaini;
ALTER DATABASE "boaini_BoaIniciativa" SET DATESTYLE TO European;

--------------------------------------------------------------------------------
---------------Garantindo acesso e criando o usuario "boaini" -----------------

REVOKE ALL ON SCHEMA BoaIniciativa FROM boaini;
DROP USER boaini;
CREATE ROLE boaini LOGIN ENCRYPTED PASSWORD 'md59243db3cd06bd661bd7dca31b59e5f2a'
   VALID UNTIL 'infinity';

GRANT USAGE ON SCHEMA BoaIniciativa TO boaini;
--------------------------------------------------------------------------------

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
--SET client_min_messages = warning;

------------------------Tabela do Administrador---------------------------------
CREATE TABLE BoaIniciativa.Administrador (
    CPF character varying(15) CONSTRAINT cpfAdm PRIMARY KEY,
    sexo character(1) NOT NULL,
    dataNascimento date NOT NULL,
    email character varying(30) NOT NULL,
    senha character varying(100) NOT NULL,
    nome character varying(50) NOT NULL,
    CONSTRAINT emailAdm UNIQUE(email)
);

ALTER TABLE BoaIniciativa.Administrador OWNER TO boaini;

--Adicionar Comentarios na tabela Administrador
COMMENT ON TABLE BoaIniciativa.Administrador IS 'tabela que contém informações dos administradores do sistema';
COMMENT ON COLUMN BoaIniciativa.Administrador.CPF IS 'CPF do administrador.';
COMMENT ON COLUMN BoaIniciativa.Administrador.sexo IS 'Sexo do administrador';
COMMENT ON COLUMN BoaIniciativa.Administrador.dataNascimento IS 'Data de nascimento do administrador.';
COMMENT ON COLUMN BoaIniciativa.Administrador.email IS 'Email do administrador';
COMMENT ON COLUMN BoaIniciativa.Administrador.senha IS 'Senha do administrador';
COMMENT ON COLUMN BoaIniciativa.Administrador.nome IS 'Nome do administrador.';

--------------------------------------------------------------------------------

--------------------------Tabela de Usuario-------------------------------------
CREATE TABLE BoaIniciativa.Usuario (
    CPF character varying(15) CONSTRAINT cpfUsuario PRIMARY KEY,
    sexo character(1),
    dataNascimento date,
    foto character varying(100) NOT NULL,
    email character varying(30) NOT NULL,
    senha character varying(100) NOT NULL,
    nome character varying(50),
    classificacao integer,
    CEP character varying(30),
    Estado character varying(30),
    bairro character varying(30),
    cidade character varying(30),
    logradouro character varying(30),
    numero character varying(10),
    complemento character varying(30),
    bloqueado boolean DEFAULT false NOT NULL,
    dataBloqueio date,
    latitude double precision,
    longitude double precision

    CONSTRAINT emailUsuario UNIQUE (email)
);

ALTER TABLE BoaIniciativa.Usuario OWNER TO boaini;

--Adicionar comentários na tabela Usuario
COMMENT ON TABLE BoaIniciativa.Usuario IS 'Tabela que contém as informações de um usuario.';
COMMENT ON COLUMN BoaIniciativa.Usuario.cpf IS 'CPF do usuario, código identificador';
COMMENT ON COLUMN BoaIniciativa.Usuario.sexo IS 'Sexo do usuário';
COMMENT ON COLUMN BoaIniciativa.Usuario.dataNascimento IS 'Data de nascimento do usuário';
COMMENT ON COLUMN BoaIniciativa.Usuario.foto IS 'A foto de perfil do usuário';
COMMENT ON COLUMN BoaIniciativa.Usuario.email IS 'Email do usuário';
COMMENT ON COLUMN BoaIniciativa.Usuario.senha IS 'Senha do usuário';
COMMENT ON COLUMN BoaIniciativa.Usuario.nome IS 'Nome do usuário';
COMMENT ON COLUMN BoaIniciativa.Usuario.classificacao IS 'Classificação do usuário de acordo com o seu potencial de doador.';
COMMENT ON COLUMN BoaIniciativa.Usuario.CEP IS 'endereco';
COMMENT ON COLUMN BoaIniciativa.Usuario.Estado IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Usuario.bairro IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Usuario.cidade IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Usuario.logradouro IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Usuario.numero IS 'endereco';
COMMENT ON COLUMN BoaIniciativa.Usuario.complemento IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Usuario.bloqueado IS 'Atributo que define se o usuário está bloqueado ou não, false=não, true=sim';
COMMENT ON COLUMN BoaIniciativa.Usuario.dataBloqueio IS 'A data em que o usuário foi bloqueado';
COMMENT ON COLUMN BoaIniciativa.Usuario.latitude IS 'A latitude do endereço do usuário';
COMMENT ON COLUMN BoaIniciativa.Usuario.longitude IS 'A longitude do endereço do usuário';

--------------------------------------------------------------------------------

------------------------Tabela da Campanha--------------------------------------
CREATE TABLE BoaIniciativa.Campanha (
    idCampanha serial CONSTRAINT idCampanha PRIMARY KEY,
    nome character varying(30) NOT NULL,
    dataInicio date NOT NULL,
    dataFim date,
    imagem text NOT NULL,
    descricao character varying(100) NOT NULL,
    tituloAgradecimento character varying(30) NOT NULL,
    mensagemAgradecimento character varying(100),
    valor1 integer,
    valor2 integer,
    valor3 integer,
    finalizapordata boolean NOT NULL,
    criadorCPF character varying(15) NOT NULL
);

CREATE INDEX FKI_criadorCPF ON BoaIniciativa.Campanha USING btree (criadorCPF);
ALTER TABLE ONLY BoaIniciativa.Campanha
    ADD CONSTRAINT FK_criadorCPF FOREIGN KEY (criadorCPF) REFERENCES BoaIniciativa.Usuario(CPF) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE BoaIniciativa.Campanha OWNER TO boaini;

--Adicionar comentários na tabela Campanha
COMMENT ON TABLE BoaIniciativa.Campanha IS 'tabela que contém informações das campanhas.';
COMMENT ON COLUMN BoaIniciativa.Campanha.idCampanha IS 'Código identificador da campanha.';
COMMENT ON COLUMN BoaIniciativa.Campanha.nome IS 'Nome da campanha';
COMMENT ON COLUMN BoaIniciativa.Campanha.dataInicio IS 'Data do início da campanha.';
COMMENT ON COLUMN BoaIniciativa.Campanha.dataFim IS 'Data de término da campanha.';
COMMENT ON COLUMN BoaIniciativa.Campanha.imagem IS 'Imagem da campanha(URL)';
COMMENT ON COLUMN BoaIniciativa.Campanha.descricao IS 'Descrição da campanha';
COMMENT ON COLUMN BoaIniciativa.Campanha.tituloAgradecimento IS 'Agradecimento padrão';
COMMENT ON COLUMN BoaIniciativa.Campanha.mensagemAgradecimento IS 'Agradecimento padrão';
COMMENT ON COLUMN BoaIniciativa.Campanha.valor1 IS 'faixa de valores';
COMMENT ON COLUMN BoaIniciativa.Campanha.valor2 IS 'faixa de valores';
COMMENT ON COLUMN BoaIniciativa.Campanha.valor3 IS 'faixa de valores';
COMMENT ON COLUMN BoaIniciativa.Campanha.finalizapordata IS 'Define se a campanha finalizara por data=true ou por meta=false';
COMMENT ON COLUMN BoaIniciativa.Campanha.criadorCPF IS 'código identificador do criador da Campanha';

--------------------------------------------------------------------------------

-------------------------Tabela do Agradecimento--------------------------------
CREATE TABLE BoaIniciativa.Agradecimento (
    codAgradecimento serial CONSTRAINT codAgradecimento PRIMARY KEY,
    titulo character varying(30) NOT NULL,
    mensagem character varying(100) NOT NULL,
    imagem character varying(100),
    codCampanha integer NOT NULL,
    cpfUsuario character varying(15) NOT NULL
);
CREATE INDEX FKI_codCampanha ON BoaIniciativa.Agradecimento USING btree (codCampanha);
ALTER TABLE ONLY BoaIniciativa.Agradecimento
    ADD CONSTRAINT FK_codCampanha FOREIGN KEY (codCampanha) REFERENCES BoaIniciativa.Campanha(idCampanha) ON UPDATE CASCADE ON DELETE SET NULL;
CREATE INDEX FKI_cpfUsuario ON BoaIniciativa.Agradecimento USING btree (cpfUsuario);
ALTER TABLE ONLY BoaIniciativa.Agradecimento
    ADD CONSTRAINT FK_cpfUsuario FOREIGN KEY (cpfUsuario) REFERENCES BoaIniciativa.Usuario(CPF) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE BoaIniciativa.Agradecimento OWNER TO boaini;

--Adicionar comentários na tabela Agradecimento
COMMENT ON TABLE BoaIniciativa.Agradecimento IS 'tabela que contém informações dos agradecimentos feitos por uma campanha para um usuario';
COMMENT ON COLUMN BoaIniciativa.Agradecimento.codAgradecimento IS 'Código identificador do agradecimento.';
COMMENT ON COLUMN BoaIniciativa.Agradecimento.titulo IS 'Titulo do agradecimento.';
COMMENT ON COLUMN BoaIniciativa.Agradecimento.mensagem IS 'Mensagem do agradecimento.';
COMMENT ON COLUMN BoaIniciativa.Agradecimento.imagem IS 'Imagem opcional referente ao agradecimento.';
COMMENT ON COLUMN BoaIniciativa.Agradecimento.codCampanha IS 'Código identificador da Campanha relacionada ao agradecimento.';
COMMENT ON COLUMN BoaIniciativa.Agradecimento.cpfUsuario IS 'Código identificador do usuario que recebeu o agradecimento.';

--------------------------------------------------------------------------------

----------------------Tabela do AtendenteCampanha-------------------------------

CREATE TABLE BoaIniciativa.AtendenteCampanha (
    idCampanha integer NOT NULL,
    cpfAtendente character varying(15) NOT NULL,
    confirmado boolean DEFAULT false NOT NULL
);
CREATE INDEX FKI_cpfAtendente ON BoaIniciativa.AtendenteCampanha USING btree (cpfAtendente);
ALTER TABLE ONLY BoaIniciativa.AtendenteCampanha
    ADD CONSTRAINT FK_cpfAtendente FOREIGN KEY (cpfAtendente) REFERENCES BoaIniciativa.Usuario(CPF) ON UPDATE CASCADE ON DELETE CASCADE;
CREATE INDEX FKI_idCampanhaAtendente ON BoaIniciativa.AtendenteCampanha USING btree (idCampanha);
ALTER TABLE ONLY BoaIniciativa.AtendenteCampanha
    ADD CONSTRAINT FK_idCampanhaAtendente FOREIGN KEY (idCampanha) REFERENCES BoaIniciativa.Campanha(idCampanha) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE BoaIniciativa.AtendenteCampanha OWNER TO boaini;

--Adicionar comentários na tabela AtendenteCampanha
COMMENT ON TABLE BoaIniciativa.AtendenteCampanha IS 'tabela que contém informações de um usuário que atende a determinada campanha.';
COMMENT ON COLUMN BoaIniciativa.AtendenteCampanha.idCampanha IS 'Código identificador da campanha em questão.';
COMMENT ON COLUMN BoaIniciativa.AtendenteCampanha.cpfAtendente IS 'Código identificador do atendente da campanha.';
COMMENT ON COLUMN BoaIniciativa.AtendenteCampanha.confirmado IS 'Diz se o atendente confirmou atendimento na campanha ou não.';

--------------------------------------------------------------------------------

------------------------Tabela do Convidado-------------------------------------
CREATE TABLE BoaIniciativa.Convidado (
    codConvidado serial CONSTRAINT codConvidado PRIMARY KEY,
    classificacao integer NOT NULL,
    email character varying(30),
    CONSTRAINT emailConvidado UNIQUE (email)
);

ALTER TABLE BoaIniciativa.Convidado OWNER TO boaini;

--Adicionar comentários na tabela Convidado
COMMENT ON TABLE BoaIniciativa.Convidado IS 'Tabela que contém informações de um convidado.';
COMMENT ON COLUMN BoaIniciativa.Convidado.codConvidado IS 'Código identificador do convidado.';
COMMENT ON COLUMN BoaIniciativa.Convidado.classificacao IS 'Classificação do convidado de acordo com seu potencial de doador.';
COMMENT ON COLUMN BoaIniciativa.Convidado.email IS 'Email do convidado.';

--------------------------------------------------------------------------------

------------------------Tabela do Convite---------------------------------------
CREATE TABLE BoaIniciativa.Convite (
    idCampanha integer NOT NULL,
    codConvidado integer NOT NULL,
    data date NOT NULL,
    CPF character varying(15) NOT NULL
);

CREATE INDEX FKI_CPFconvidou ON BoaIniciativa.Convite USING btree (CPF);
CREATE INDEX FKI_codConvidado ON BoaIniciativa.Convite USING btree (codConvidado);
ALTER TABLE ONLY BoaIniciativa.Convite
    ADD CONSTRAINT FK_CPFconvidou FOREIGN KEY (CPF) REFERENCES BoaIniciativa.Usuario(CPF) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY BoaIniciativa.Convite
    ADD CONSTRAINT FK_codConvidado FOREIGN KEY (codConvidado) REFERENCES BoaIniciativa.Convidado(codConvidado) ON UPDATE CASCADE ON DELETE CASCADE;
CREATE INDEX FKI_idCampanhaConvite ON BoaIniciativa.Convite USING btree (idCampanha);
ALTER TABLE ONLY BoaIniciativa.Convite
    ADD CONSTRAINT FK_idCampanhaConvite FOREIGN KEY (idCampanha) REFERENCES BoaIniciativa.Campanha(idCampanha) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE BoaIniciativa.Convite OWNER TO boaini;
--Adicionar comentários na tabela Convidado
COMMENT ON TABLE BoaIniciativa.Convite IS 'Tabela que contém informações de um convite.';
COMMENT ON COLUMN BoaIniciativa.Convite.idCampanha IS 'Código identificador da campanha para a qual foi convidado.';
COMMENT ON COLUMN BoaIniciativa.Convite.codConvidado IS 'Código identificador do convidado em questão.';
COMMENT ON COLUMN BoaIniciativa.Convite.data IS 'Data em que foi feito o convite';
COMMENT ON COLUMN BoaIniciativa.Convite.CPF IS 'Código identificador do usuário que efetuou o convite';

--------------------------------------------------------------------------------

------------------------Tabela da Doação----------------------------------------
CREATE TABLE BoaIniciativa.Doacao (
    idDoacao serial CONSTRAINT idDoacao PRIMARY KEY,
    confirmado boolean DEFAULT false NOT NULL,
    data date NOT NULL,
    atendenteConfirma character varying(15),
    idCampanha integer NOT NULL,
    doadorCPF character varying(15) NOT NULL
);
CREATE INDEX FKI_atendenteConfirma ON BoaIniciativa.Doacao USING btree (atendenteConfirma);
CREATE INDEX FKI_doadorCPF ON BoaIniciativa.Doacao USING btree (doadorCPF);
ALTER TABLE ONLY BoaIniciativa.Doacao
    ADD CONSTRAINT FK_doadorCPF FOREIGN KEY (doadorCPF) REFERENCES BoaIniciativa.Usuario(CPF) ON UPDATE CASCADE ON DELETE SET NULL;
CREATE INDEX FKI_idCampanha ON BoaIniciativa.Doacao USING btree (idCampanha);
ALTER TABLE ONLY BoaIniciativa.Doacao
    ADD CONSTRAINT FK_idCampanha FOREIGN KEY (idCampanha) REFERENCES BoaIniciativa.Campanha(idCampanha) ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE BoaIniciativa.Doacao OWNER TO boaini;

--------------------------------------------------------------------------------

-------------------Tabela de Doação - Material----------------------------------
CREATE TABLE BoaIniciativa.Material (
    codMaterial serial CONSTRAINT codMaterial PRIMARY KEY,
    nome character varying(30) NOT NULL,
    medida character varying(30) NOT NULL
);

ALTER TABLE BoaIniciativa.Material OWNER TO boaini;

--Adicionar comentários na tabela Material
COMMENT ON TABLE BoaIniciativa.Material IS 'Tabela que contém informações dos Materiais.';
COMMENT ON COLUMN BoaIniciativa.Material.codMaterial IS 'Código identificador do material.';
COMMENT ON COLUMN BoaIniciativa.Material.nome IS 'Nome do material cadastrado.';
COMMENT ON COLUMN BoaIniciativa.Material.medida IS 'Medida do material cadastrado.';

--------------------------------------------------------------------------------

-------------------Tabela de Doação - Material----------------------------------
CREATE TABLE BoaIniciativa.DoacaoMaterial (
    idDoacao integer NOT NULL,
    codMaterial integer NOT NULL,
    quantidade double precision NOT NULL
);
CREATE INDEX FKI_codMaterialDoacao ON BoaIniciativa.DoacaoMaterial USING btree (codMaterial);
ALTER TABLE ONLY BoaIniciativa.DoacaoMaterial
    ADD CONSTRAINT FK_codMaterialDoacao FOREIGN KEY (codMaterial) REFERENCES BoaIniciativa.Material(codMaterial) ON UPDATE CASCADE ON DELETE CASCADE;
CREATE INDEX FKI_idDoacao ON BoaIniciativa.DoacaoMaterial USING btree (idDoacao);
ALTER TABLE ONLY BoaIniciativa.DoacaoMaterial
    ADD CONSTRAINT FK_idDoacao FOREIGN KEY (idDoacao) REFERENCES BoaIniciativa.Doacao(idDoacao) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE BoaIniciativa.DoacaoMaterial OWNER TO boaini;

--Adicionar comentários na tabela DoacaoMaterial
COMMENT ON TABLE BoaIniciativa.DoacaoMaterial IS 'Tabela que contém informações dos Materiais doados em uma doação.';
COMMENT ON COLUMN BoaIniciativa.DoacaoMaterial.idDoacao IS 'Código identificador da doação em questão.';
COMMENT ON COLUMN BoaIniciativa.DoacaoMaterial.codMaterial IS 'Código identificador do material em questão.';
COMMENT ON COLUMN BoaIniciativa.DoacaoMaterial.quantidade IS 'A quantidade do Material que foi doada na Doação em questão.';

--------------------------------------------------------------------------------

---------------------Tabela de Meta Campanha------------------------------------

CREATE TABLE BoaIniciativa.MetaCampanha (
    codMaterial integer NOT NULL,
    idCampanha integer NOT NULL,
    quantidade double precision DEFAULT 0
);
CREATE INDEX FKI_codMaterial ON BoaIniciativa.MetaCampanha USING btree (codMaterial);
ALTER TABLE ONLY BoaIniciativa.MetaCampanha
    ADD CONSTRAINT FK_codMaterial FOREIGN KEY (codMaterial) REFERENCES BoaIniciativa.Material(codMaterial) ON UPDATE CASCADE ON DELETE CASCADE;
CREATE INDEX FKI_idCampanhaMeta ON BoaIniciativa.MetaCampanha USING btree (idCampanha);
ALTER TABLE ONLY BoaIniciativa.MetaCampanha
    ADD CONSTRAINT FK_idCampanhaMeta FOREIGN KEY (idCampanha) REFERENCES BoaIniciativa.Campanha(idCampanha) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE BoaIniciativa.MetaCampanha OWNER TO boaini;

--Adicionar comentários na tabela MetaCampanha
COMMENT ON TABLE BoaIniciativa.MetaCampanha IS 'Meta material de uma campanha';
COMMENT ON COLUMN BoaIniciativa.MetaCampanha.codMaterial IS 'Código identificador do material doado.';
COMMENT ON COLUMN BoaIniciativa.MetaCampanha.idCampanha IS 'Código identificador da campanha em questão.';
COMMENT ON COLUMN BoaIniciativa.MetaCampanha.quantidade IS 'Quantidade de doação do material que deseja ser alcançado.(Se 0, meta aberta)';

--------------------------------------------------------------------------------

---------------------------Tabela do Ponto--------------------------------------
CREATE TABLE BoaIniciativa.Ponto (
    idPonto serial CONSTRAINT idPonto PRIMARY KEY,
    CEP character varying(30),
    Estado character varying(30),
    bairro character varying(30),
    cidade character varying(30),
    logradouro character varying(30),
    numero character varying(10),
    complemento character varying(30),
    latitude double precision,
    longitude double precision
);

ALTER TABLE BoaIniciativa.Ponto OWNER TO boaini;

--Adicionar comentários na tabela Ponto
COMMENT ON TABLE BoaIniciativa.Ponto IS 'Tabela que contem informações de um local de arrecadação';
COMMENT ON COLUMN BoaIniciativa.Ponto.idPonto IS 'Código identificador de um Ponto';
COMMENT ON COLUMN BoaIniciativa.Ponto.CEP IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Ponto.Estado IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Ponto.bairro IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Ponto.cidade IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Ponto.logradouro IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Ponto.numero IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Ponto.complemento IS 'endereço';
COMMENT ON COLUMN BoaIniciativa.Ponto.latitude IS 'a latitude';
COMMENT ON COLUMN BoaIniciativa.Ponto.longitude IS 'a longitude';


--------------------------------------------------------------------------------

---------------------Tabela de Ponto Campanha-----------------------------------

CREATE TABLE BoaIniciativa.PontoCampanha (
    idPonto integer NOT NULL,
    idCampanha integer NOT NULL
);
CREATE INDEX FKI_idCampanhaPonto ON BoaIniciativa.PontoCampanha USING btree (idCampanha);
ALTER TABLE ONLY BoaIniciativa.PontoCampanha
    ADD CONSTRAINT FK_idCampanhaPonto FOREIGN KEY (idCampanha) REFERENCES BoaIniciativa.Campanha(idCampanha) ON UPDATE CASCADE ON DELETE CASCADE;
CREATE INDEX FKI_idPosto ON BoaIniciativa.PontoCampanha USING btree (idPonto);
ALTER TABLE ONLY BoaIniciativa.PontoCampanha
    ADD CONSTRAINT FK_idPonto FOREIGN KEY (idPonto) REFERENCES BoaIniciativa.Ponto(idPonto) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE BoaIniciativa.PontoCampanha OWNER TO boaini;

--Adicionar comentários na tabela PontoCampanha
COMMENT ON TABLE BoaIniciativa.PontoCampanha IS 'tabela que contém informações da associação entre um posto de coleta e uma campanha.';
COMMENT ON COLUMN BoaIniciativa.PontoCampanha.idPonto IS 'Código identificador do posto de coleta em questão.';
COMMENT ON COLUMN BoaIniciativa.PontoCampanha.idCampanha IS 'Código identificador da campanha em questão.';

--------------------------------------------------------------------------------

----------------------------Tabela de Tag---------------------------------------

CREATE TABLE BoaIniciativa.Tag (
    idTag serial CONSTRAINT idTag PRIMARY KEY,
    nome character varying(15) NOT NULL,
	CONSTRAINT nomeTag UNIQUE (nome)
);

ALTER TABLE BoaIniciativa.Tag OWNER TO boaini;

--Adicionar comentários na tabela Tag
COMMENT ON TABLE BoaIniciativa.Tag IS 'Tabela que contém informações de uma Tag.';
COMMENT ON COLUMN BoaIniciativa.Tag.idTag IS 'Código identificador da tag.';
COMMENT ON COLUMN BoaIniciativa.Tag.nome IS 'Nome da tag.';

--------------------------------------------------------------------------------

------------------------Tabela de Campanha Tag----------------------------------
CREATE TABLE BoaIniciativa.CampanhaTag (
    idCampanha integer NOT NULL,
    idTag integer NOT NULL
);
CREATE INDEX FKI_idCampanhaTag ON BoaIniciativa.CampanhaTag USING btree (idCampanha);
ALTER TABLE ONLY BoaIniciativa.CampanhaTag
    ADD CONSTRAINT FK_idCampanhaTag FOREIGN KEY (idCampanha) REFERENCES BoaIniciativa.Campanha(idCampanha) ON UPDATE CASCADE ON DELETE CASCADE;
CREATE INDEX FKI_idTagCampanha ON BoaIniciativa.CampanhaTag USING btree (idTag);
ALTER TABLE ONLY BoaIniciativa.CampanhaTag
    ADD CONSTRAINT FK_idTagCampanha FOREIGN KEY (idTag) REFERENCES BoaIniciativa.Tag(idTag) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE BoaIniciativa.CampanhaTag OWNER TO boaini;

--Adicionar comentários na tabela CampanhaTag
COMMENT ON TABLE BoaIniciativa.CampanhaTag IS 'Tabela que associa uma tag a uma campanha.';
COMMENT ON COLUMN BoaIniciativa.CampanhaTag.idCampanha IS 'Código identificador da campanha em questão.';
COMMENT ON COLUMN BoaIniciativa.CampanhaTag.idTag IS 'Código identificador da tag em questão.';

--------------------------------------------------------------------------------

------------------------Tabela da Denuncia--------------------------------------
CREATE TABLE BoaIniciativa.Denuncia (
    codDenuncia serial CONSTRAINT codDenuncia PRIMARY KEY,
    idCampanha integer NOT NULL,
    motivo character varying(100) NOT NULL,
    descricao character varying(100),
    CPF character varying(15)
);

CREATE INDEX FKI_CPF ON BoaIniciativa.Denuncia USING btree (CPF);
ALTER TABLE ONLY BoaIniciativa.Denuncia
    ADD CONSTRAINT FK_CPF FOREIGN KEY (CPF) REFERENCES BoaIniciativa.Usuario(CPF) ON UPDATE CASCADE ON DELETE SET NULL;
CREATE INDEX FKI_idCampanhaDenuncia ON BoaIniciativa.Denuncia USING btree (idCampanha);
ALTER TABLE ONLY BoaIniciativa.Denuncia
    ADD CONSTRAINT FK_idCampanhaDenuncia FOREIGN KEY (idCampanha) REFERENCES BoaIniciativa.Campanha(idCampanha) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE BoaIniciativa.Denuncia OWNER TO boaini;

--Adicionar comentários na tabela Convidado
COMMENT ON TABLE BoaIniciativa.Denuncia IS 'Tabela que contém informações de uma Denuncia.';
COMMENT ON COLUMN BoaIniciativa.Denuncia.codDenuncia IS 'Código identificador da Denuncia';
COMMENT ON COLUMN BoaIniciativa.Denuncia.idCampanha IS 'Código identificador da campanha que foi denunciada.';
COMMENT ON COLUMN BoaIniciativa.Denuncia.motivo IS 'O motivo selecionado pelo usuario';
COMMENT ON COLUMN BoaIniciativa.Denuncia.descricao IS 'Descrição do motivo para a denuncia';
COMMENT ON COLUMN BoaIniciativa.Denuncia.CPF IS 'Código identificador do usuário que efetuou a Denuncia';

--------------------------------------------------------------------------------
