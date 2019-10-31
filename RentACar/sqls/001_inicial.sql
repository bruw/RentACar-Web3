
CREATE DATABASE rentacar COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios(
	id INT NOT NULL AUTO_INCREMENT,
    primeiro_nome VARCHAR(25) NOT NULL,
    sobrenome VARCHAR(60) NOT NULL,
    cpf CHAR(11) NOT NULL,
    email VARCHAR(60) DEFAULT NULL,
    celular VARCHAR(20) NOT NULL,
    cep CHAR(8) NOT NULL,
    numero CHAR(5) NOT NULL,
    
    PRIMARY KEY(id)
    
);

CREATE TABLE clientes(
	id INT NOT NULL AUTO_INCREMENT,
    primeiro_nome VARCHAR(25) NOT NULL,
    sobrenome VARCHAR(60) NOT NULL,
    cpf CHAR(11) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    email VARCHAR(60) DEFAULT NULL,
    cep CHAR(8) NOT NULL,
    numero CHAR(5) NOT NULL,
    
    PRIMARY KEY(id)
    
);

CREATE TABLE veiculos(
	id INT NOT NULL AUTO_INCREMENT,
    chassi CHAR(17) NOT NULL,
    montadora VARCHAR(60) NOT NULL,
    modelo VARCHAR(25) NOT NULL,
    categoria VARCHAR(20) NOT NULL,
    preco_diaria DOUBLE NOT NULL,
    descricao TEXT NOT NULL,
    status_oficina CHAR(1) NOT NULL,
    status_locacao CHAR(1) NOT NULL,

    PRIMARY KEY(id)
    
);

CREATE TABLE locacoes(
	id INT NOT NULL AUTO_INCREMENT,
   	data_locacao DATE NOT NULL,
    data_prevista_entrega DATE NOT NULL,
    data_devolucao DATE DEFAULT NULL,
    multa_atraso DOUBLE DEFAULT NULL,
    total DOUBLE NOT NULL,
    status_locacao CHAR(1) NOT NULL,
    id_veiculo INT NOT NULL,
    id_cliente INT NOT NULL, 
    
    PRIMARY KEY(id),
    FOREIGN KEY(id_veiculo) REFERENCES veiculos (id),
    FOREIGN KEY(id_cliente) REFERENCES clientes (id)
    
);

CREATE TABLE reparos(
	id INT NOT NULL AUTO_INCREMENT,
   	data_inicio DATE NOT NULL,
    data_fim DATE DEFAULT NULL,
    descricao_problema TEXT NOT NULL,
    total DOUBLE DEFAULT NULL,
    status_reparo CHAR(1) NOT NULL,
    id_veiculo INT NOT NULL,
    
    
    PRIMARY KEY(id),
    FOREIGN KEY(id_veiculo) REFERENCES veiculos (id)
   
);