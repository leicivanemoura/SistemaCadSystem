tb_telefonepessoatb_funcionarioSET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `dfsystem` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `dfsystem` ;

-- -----------------------------------------------------
-- Table `dfsystem`.`table3`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`table3` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`table4`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`table4` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`table7`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`table7` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb_funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb_funcionario` (
  `idfuncionario` INT NOT NULL AUTO_INCREMENT,
  `tipofuncionario` VARCHAR(45) NOT NULL,
  `setorfuncionario` VARCHAR(45) NOT NULL,
  `funcaofuncionario` VARCHAR(45) NOT NULL,
  `statusfuncionario` VARCHAR(45) NULL,
  `motivoinativo` VARCHAR(45) NULL,
  PRIMARY KEY (`idfuncionario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb_pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb_pessoa` (
  `idpessoa` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sobrenome` VARCHAR(100) NOT NULL,
  `rg` VARCHAR(45) NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `email` VARCHAR(255) NULL,
  `sexo` CHAR(1) NULL,
  `datanascimento` DATE NULL,
  `datacadastro` DATE NOT NULL,
  `tb_funcionario_idfuncionario` INT NOT NULL,
  PRIMARY KEY (`idpessoa`),
  INDEX `fk_tb_pessoa_tb_funcionario1_idx` (`tb_funcionario_idfuncionario` ASC),
  CONSTRAINT `fk_tb_pessoa_tb_funcionario1`
    FOREIGN KEY (`tb_funcionario_idfuncionario`)
    REFERENCES `dfsystem`.`tb_funcionario` (`idfuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb_endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb_endereco` (
  `idendereco` INT NOT NULL AUTO_INCREMENT,
  `endereco` VARCHAR(255) NOT NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `uf` VARCHAR(2) NOT NULL,
  `cep` VARCHAR(7) NULL,
  `ptreferencia` LONGTEXT NULL,
  PRIMARY KEY (`idendereco`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb_telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb_telefone` (
  `idtelefone` INT NOT NULL AUTO_INCREMENT,
  `tipotelefone` VARCHAR(45) NULL,
  `dddtelefone` VARCHAR(45) NOT NULL,
  `numtelefone` VARCHAR(45) NOT NULL,
  `operadora` VARCHAR(45) NULL,
  `horariocontato` VARCHAR(45) NULL,
  PRIMARY KEY (`idtelefone`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb_telefonepessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb_telefonepessoa` (
  `tb_pessoa_idpessoa` INT NOT NULL,
  `tb_telefone_idtelefone` INT NOT NULL,
  PRIMARY KEY (`tb_pessoa_idpessoa`, `tb_telefone_idtelefone`),
  INDEX `fk_tb_pessoa_has_tb_telefone_tb_telefone1_idx` (`tb_telefone_idtelefone` ASC),
  INDEX `fk_tb_pessoa_has_tb_telefone_tb_pessoa1_idx` (`tb_pessoa_idpessoa` ASC),
  CONSTRAINT `fk_tb_pessoa_has_tb_telefone_tb_pessoa1`
    FOREIGN KEY (`tb_pessoa_idpessoa`)
    REFERENCES `dfsystem`.`tb_pessoa` (`idpessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_pessoa_has_tb_telefone_tb_telefone1`
    FOREIGN KEY (`tb_telefone_idtelefone`)
    REFERENCES `dfsystem`.`tb_telefone` (`idtelefone`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb_enderecopessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb_enderecopessoa` (
  `tb_pessoa_idpessoa` INT NOT NULL,
  `tb_endereco_idendereco` INT NOT NULL,
  PRIMARY KEY (`tb_pessoa_idpessoa`, `tb_endereco_idendereco`),
  INDEX `fk_tb_pessoa_has_tb_endereco_tb_endereco1_idx` (`tb_endereco_idendereco` ASC),
  INDEX `fk_tb_pessoa_has_tb_endereco_tb_pessoa1_idx` (`tb_pessoa_idpessoa` ASC),
  CONSTRAINT `fk_tb_pessoa_has_tb_endereco_tb_pessoa1`
    FOREIGN KEY (`tb_pessoa_idpessoa`)
    REFERENCES `dfsystem`.`tb_pessoa` (`idpessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_pessoa_has_tb_endereco_tb_endereco1`
    FOREIGN KEY (`tb_endereco_idendereco`)
    REFERENCES `dfsystem`.`tb_endereco` (`idendereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb-cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb-cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `tb_pessoa_idpessoa` INT NOT NULL,
  PRIMARY KEY (`idcliente`),
  INDEX `fk_tb-cliente_tb_pessoa1_idx` (`tb_pessoa_idpessoa` ASC),
  CONSTRAINT `fk_tb-cliente_tb_pessoa1`
    FOREIGN KEY (`tb_pessoa_idpessoa`)
    REFERENCES `dfsystem`.`tb_pessoa` (`idpessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb_os`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb_os` (
  `numos` INT NOT NULL AUTO_INCREMENT,
  `dataabertura` DATE NOT NULL,
  `datafinal` DATE NULL,
  `atendente` VARCHAR(45) NOT NULL,
  `statusos` VARCHAR(45) NULL,
  `executoros` VARCHAR(45) NULL,
  `descricaoos` LONGTEXT NOT NULL,
  `valor` DOUBLE(11,2) NULL,
  `formapagamento` VARCHAR(45) NULL,
  `observacoes` LONGTEXT NULL,
  `tb-cliente_idcliente` INT NOT NULL,
  PRIMARY KEY (`numos`, `tb-cliente_idcliente`),
  INDEX `fk_tb_os_tb-cliente1_idx` (`tb-cliente_idcliente` ASC),
  CONSTRAINT `fk_tb_os_tb-cliente1`
    FOREIGN KEY (`tb-cliente_idcliente`)
    REFERENCES `dfsystem`.`tb-cliente` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dfsystem`.`tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dfsystem`.`tb_usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `perfilusuario` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(12) NOT NULL,
  `tb_funcionario_idfuncionario1` INT NOT NULL,
  `tb_funcionario_tb_pessoa_idpessoa1` INT NOT NULL,
  PRIMARY KEY (`idusuario`),
  INDEX `fk_tb_usuario_tb_funcionario2_idx` (`tb_funcionario_idfuncionario1` ASC, `tb_funcionario_tb_pessoa_idpessoa1` ASC),
  CONSTRAINT `fk_tb_usuario_tb_funcionario2`
    FOREIGN KEY (`tb_funcionario_idfuncionario1`)
    REFERENCES `dfsystem`.`tb_funcionario` (`idfuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
