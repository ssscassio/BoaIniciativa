-- ALTERAÇÕES PARA QUE O MÉTODO ExcluirPerfil FUNCIONE


-- Criação de um usuario anônimo
INSERT INTO BoaIniciativa.Usuario (cpf,sexo,datanascimento,foto,email,senha,nome,classificacao,cep,estado,bairro,cidade,logradouro,numero,complemento,bloqueado,databloqueio, latitude, longitude) Values ('12345678910','M','09-07-1986','default.jpg','teste1@teste.com',md5('12345678'),'Zilmar Souza',2,'44002-488','Bahia','Muchila','Feira de Santana','Avenida Eduardo Fróes da Mota','361',null,false,null, -12.2317073, -38.9564264);

--Depois de excluir as colunuas doadorCPF, idCampanha da tabela doação e codCampanha da tabela Agradecimento elas foram readicionadas da seguinte forma:

-- A coluna doadorCPF na tabela Doacao tem como default o usuario anonimo e é delete set default
ALTER TABLE ONLY BoaIniciativa.Doacao ADD doadorCPF character varying(15) DEFAULT 12345678910 NOT NULL constraint FK_doadorCPF references BoaIniciativa.Usuario(CPF) on delete set default 

-- A coluna idCampanha na tabela Doacao é delete cascade
ALTER TABLE ONLY BoaIniciativa.Doacao ADD idCampanha integer NOT NULL constraint FK_idCampanha references BoaIniciativa.Campanha(idCampanha) on delete cascade 

-- A coluna codCampanha na tabela Agradecimento é delete set null
ALTER TABLE ONLY BoaIniciativa.Agradecimento ADD codCampanha integer  constraint FK_codCampanha references BoaIniciativa.Campanha(idCampanha) on delete set null 

-- NOTA: Como a chave primaria da tabela Campanha é gerada pelo banco eu não coloque um id defaul nas tabelas que tem essa chave como chave estrangeira.
