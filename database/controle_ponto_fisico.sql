/*--------------------------
//--//--> CRIAR BANCO
--------------------------*/
CREATE DATABASE `controle_ponto`;

/*--------------------------
//--//--> USAR BANCO
--------------------------*/
USE `controle_ponto`;

/*--------------------------
//--//--> CRIAR TABELAS
--------------------------*/
CREATE TABLE `funcionarios` (
    `idfuncionario` INT,
    `nome` VARCHAR(25) NOT NULL,
    `sobrenome` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `telefone` VARCHAR(20) NOT NULL,
    `foto` VARCHAR(25) NOT NULL,
    `data_admissao` DATE DEFAULT (CURDATE()),
    `palavra_passe` VARCHAR(100) NOT NULL,
    `data_desligamento` DATE
);
ALTER TABLE `funcionarios` ADD CONSTRAINT `pk_funcionarios` PRIMARY KEY (`idfuncionario`);
ALTER TABLE `funcionarios` MODIFY COLUMN `idfuncionario` INT AUTO_INCREMENT;
ALTER TABLE `funcionarios` ADD CONSTRAINT `uc_funcionarios_email` UNIQUE (`email`);


CREATE TABLE `enderecos` (
    `idendereco` INT,
    `fk_idfuncionario` INT NOT NULL,
    `cep` CHAR(9) NOT NULL,
    `rua` VARCHAR(100) NOT NULL,
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(50) NOT NULL,
    `estado` CHAR(2) NOT NULL
);
ALTER TABLE `enderecos` ADD CONSTRAINT `pk_enderecos` PRIMARY KEY (`idendereco`);
ALTER TABLE `enderecos` MODIFY COLUMN `idendereco` INT AUTO_INCREMENT;
ALTER TABLE `enderecos` ADD CONSTRAINT `fk_funcionarios_enderecos` FOREIGN KEY (`fk_idfuncionario`) REFERENCES `funcionarios` (`idfuncionario`);
ALTER TABLE `enderecos` ADD CONSTRAINT `uc_enderecos_fk_idfuncionario` UNIQUE (`fk_idfuncionario`);


CREATE TABLE `status` (
	`idstatus` INT,
    `status` INT NOT NULL
);
ALTER TABLE `status` ADD CONSTRAINT `pk_status` PRIMARY KEY (`idstatus`);
ALTER TABLE `status` MODIFY COLUMN `idstatus` INT AUTO_INCREMENT;


CREATE TABLE `jornadas_trabalho` (
	`idjornada_trabalho` INT,
    `fk_idfuncionario` INT NOT NULL,
    `fk_idstatus` INT NOT NULL,
    `data` DATE DEFAULT (CURDATE()),
    `entrada` TIME,
    `inicio_intervalo` TIME,
    `volta_intervalo` TIME,
    `saida` TIME
);
ALTER TABLE `jornadas_trabalho` ADD CONSTRAINT `pk_jornadas_trabalho` PRIMARY KEY (`idjornada_trabalho`);
ALTER TABLE `jornadas_trabalho` MODIFY COLUMN `idjornada_trabalho` INT AUTO_INCREMENT;
ALTER TABLE `jornadas_trabalho` ADD CONSTRAINT `fk_funcionarios_jornadas_trabalho` FOREIGN KEY (`fk_idfuncionario`) REFERENCES `funcionarios` (`idfuncionario`);
ALTER TABLE `jornadas_trabalho` ADD CONSTRAINT `fk_status_jornadas_trabalho` FOREIGN KEY (`fk_idstatus`) REFERENCES `status` (`idstatus`);
ALTER TABLE `jornadas_trabalho` ADD CONSTRAINT `uc_jornadas_trabalho_fk_idfuncionario_data` UNIQUE (`fk_idfuncionario`, `data`);


CREATE TABLE `historico_atividades` (
    `idatividade` INT,
    `fk_idfuncionario` INT,
    `fk_idstatus` INT NOT NULL,
    `data` DATE DEFAULT (CURDATE())
);
ALTER TABLE `historico_atividades` ADD CONSTRAINT `pk_historico_atividades` PRIMARY KEY (`idatividade`);
ALTER TABLE `historico_atividades` MODIFY COLUMN `idatividade` INT AUTO_INCREMENT;
ALTER TABLE `historico_atividades` ADD CONSTRAINT `fk_funcionarios_historico_atividades` FOREIGN KEY (`fk_idfuncionario`) REFERENCES `funcionarios` (`idfuncionario`);
ALTER TABLE `historico_atividades` ADD CONSTRAINT `fk_status_historico_atividades` FOREIGN KEY (`fk_idstatus`) REFERENCES `status` (`idstatus`);

/*--------------------------
//--//--> CONFIGURAR TABELAS
--------------------------*/
INSERT INTO `status`(`status`)VALUES(1);
INSERT INTO `status`(`status`)VALUES(2);
INSERT INTO `status`(`status`)VALUES(3);
INSERT INTO `status`(`status`)VALUES(4)