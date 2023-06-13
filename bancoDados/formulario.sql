CREATE TABLE dados_pessoais (id_dado INT PRIMARY KEY, dado VARCHAR(100));

CREATE TABLE tipo_tratamento (id_tipo_tratamento INT AUTO_INCREMENT PRIMARY KEY,tratamento VARCHAR(100));

CREATE TABLE base_legal (id_base INT AUTO_INCREMENT PRIMARY KEY,base_legal VARCHAR(200));

CREATE TABLE tratamento (id_tratamento INT AUTO_INCREMENT PRIMARY KEY,id_base INT,sensivel BIT,objetivo VARCHAR(4000),compartilhamento BIT,armazenamento VARCHAR(100),retencao VARCHAR(100),CONSTRAINT fk_base_legal FOREIGN KEY (id_base) REFERENCES base_legal (id_base));

CREATE TABLE tratamento_tipo_tratamento (id_tratamento INT,id_tipo_tratamento INT,CONSTRAINT fk_tratamento FOREIGN KEY (id_tratamento)REFERENCES tratamento (id_tratamento),CONSTRAINT fk_tipo_tratamento FOREIGN KEY (id_tipo_tratamento) REFERENCES tipo_tratamento (id_tipo_tratamento));

CREATE TABLE tratamento_dados_pessoais (id_tratamento INT,id_dado INT,CONSTRAINT fk_tratamento_dp FOREIGN KEY (id_tratamento) REFERENCES tratamento (id_tratamento),CONSTRAINT fk_dados_pessoais FOREIGN KEY (id_dado) REFERENCES dados_pessoais (id_dado));

INSERT INTO base_legal (base_legal)
VALUES
  ('I - Consentimento'),
  ('II - Cumprimento de obrigação legal ou regulatória'),
  ('III - Execução de políticas públicas'),
  ('IV - Estudos por órgão de pesquisa'),
  ('V - Execução de contrato'),
  ('VI - Exercício regular de direitos em processo judicial'),
  ('VII - Proteção da vida ou da incolumidade física do titular'),
  ('VIII - Tutela da saúde'),
  ('IX - Legítimo interesse'),
  ('X - Proteção do crédito');

INSERT INTO dados_pessoais (dado)
VALUES
  ('CPF'),
  ('Gênero'),
  ('Login'),
  ('Matrícula'),
  ('Nome'),
  ('RG'),
  ('Saúde'),
  ('Telefone celular');