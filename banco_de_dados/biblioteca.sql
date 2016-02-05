-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `biblioteca` ;

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;
SHOW WARNINGS;
USE `biblioteca` ;

-- -----------------------------------------------------
-- Table `categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categoria` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria_descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`categoria_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `categoria_id_UNIQUE` ON `categoria` (`categoria_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipo` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `tipo` (
  `tipo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`tipo_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `tipo_id_UNIQUE` ON `tipo` (`tipo_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `editora`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `editora` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `editora` (
  `editora_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `editora_nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`editora_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `editora_id_UNIQUE` ON `editora` (`editora_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `autor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `autor` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `autor` (
  `autor_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `autor_nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`autor_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `autor_id_UNIQUE` ON `autor` (`autor_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `livro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `livro` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `livro` (
  `livro_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `livro_titulo` VARCHAR(100) NOT NULL,
  `livro_edicao` DECIMAL(9,0) NOT NULL,
  `livro_publicacao` DECIMAL(4,0) NOT NULL,
  `livro_locado` TINYINT(1) NOT NULL DEFAULT 0,
  `categoria_id` INT UNSIGNED NOT NULL,
  `tipo_id` INT UNSIGNED NOT NULL,
  `editora_id` INT UNSIGNED NOT NULL,
  `autor_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`livro_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `livro_Id_UNIQUE` ON `livro` (`livro_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estado` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `estado` (
  `estado_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `estado_nome` VARCHAR(100) NOT NULL,
  `estado_sigla` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`estado_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `estado_id_UNIQUE` ON `estado` (`estado_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cidade` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cidade` (
  `cidade_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cidade_nome` VARCHAR(100) NOT NULL,
  `cidade_codigo_ibge` INT UNSIGNED NOT NULL,
  `cidade_populacao_2010` INT NOT NULL,
  `cidade_populacao` INT UNSIGNED NOT NULL,
  `cidade_densidade_demo` DECIMAL(10,2) NOT NULL,
  `cidade_gentilico` VARCHAR(255) NOT NULL,
  `cidade_area` DECIMAL(10,2) NOT NULL,
  `estado_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`cidade_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `cidade_id_UNIQUE` ON `cidade` (`cidade_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `endereco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `endereco` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `endereco` (
  `endereco_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `endereco_lagradouro` VARCHAR(45) NOT NULL,
  `endereco_numero` VARCHAR(45) NOT NULL,
  `endereco_complemento` VARCHAR(45) NULL,
  `endereco_cep` VARCHAR(9) NOT NULL,
  `endereco_bairro` VARCHAR(45) NOT NULL,
  `cidade_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`endereco_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `endereco_id_UNIQUE` ON `endereco` (`endereco_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `serie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `serie` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `serie` (
  `serie_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `serie_ano` DECIMAL(1,0) NOT NULL,
  `serie_turma` VARCHAR(1) NOT NULL,
  `serie_turno` ENUM('m', 't', 'n') NOT NULL,
  PRIMARY KEY (`serie_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `serie_id_UNIQUE` ON `serie` (`serie_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `vinculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vinculo` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `vinculo` (
  `vinculo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `vinculo_descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`vinculo_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `vinculo_id_UNIQUE` ON `vinculo` (`vinculo_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pessoa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pessoa` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `pessoa_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pessoa_nome` VARCHAR(100) NOT NULL,
  `pessoa_pai` VARCHAR(100) NULL,
  `pessoa_mae` VARCHAR(100) NOT NULL,
  `pessoa_data` DATE NOT NULL,
  `pessoa_cpf` VARCHAR(14) NULL,
  `pessoa_rg` BIGINT UNSIGNED NULL,
  `pessoa_email` VARCHAR(100) NULL,
  `pessoa_telefone` VARCHAR(13) NULL,
  `pessoa_status` TINYINT(1) NOT NULL DEFAULT 0,
  `endereco_id` INT UNSIGNED NOT NULL,
  `serie_id` INT UNSIGNED NOT NULL,
  `vinculo_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`pessoa_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `pessoa_id_UNIQUE` ON `pessoa` (`pessoa_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `emprestimo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimo` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `emprestimo` (
  `emprestimo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `emprestimo_data_inicio` DATE NOT NULL,
  `emprestimo_data_fim` DATE NOT NULL,
  `pessoa_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`emprestimo_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `emprestimo_id_UNIQUE` ON `emprestimo` (`emprestimo_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `lista_livros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lista_livros` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `lista_livros` (
  `lista_livro_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `livro_id` INT UNSIGNED NOT NULL,
  `emprestimo_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`lista_livro_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `lista_livro_id_UNIQUE` ON `lista_livros` (`lista_livro_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuario` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_login` VARCHAR(100) NOT NULL,
  `usuario_senha` VARCHAR(255) NOT NULL,
  `usuario_email` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`usuario_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `usuario_id_UNIQUE` ON `usuario` (`usuario_id` ASC);

SHOW WARNINGS;
CREATE UNIQUE INDEX `usuario_login_UNIQUE` ON `usuario` (`usuario_login` ASC);

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
