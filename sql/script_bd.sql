-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tcc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc` DEFAULT CHARACTER SET utf8 ;
USE `tcc` ;

-- -----------------------------------------------------
-- Table `tcc`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `email` VARCHAR(250) NULL,
  `senha` VARCHAR(250) NULL,
  `tipo` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tcc`.`projeto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `prazo` DATE NULL,
  `descricao` VARCHAR(550) NULL,
  `documento` VARCHAR(550) NULL,
  `idusu` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_projeto_usuario_idx` (`id` ASC),
  CONSTRAINT `fk_projeto_usuario`
    FOREIGN KEY (`idusu`)
    REFERENCES `tcc`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tcc`.`requisito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `prazo` DATE NULL,
  `descricao` VARCHAR(550) NULL,
  `documento` VARCHAR(550) NULL,
  `idpro` INT NOT NULL,
  `idusu` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_requisito_projeto_idx` (`id` ASC),
  CONSTRAINT `fk_requisito_projeto`
    FOREIGN KEY (`idpro`)
    REFERENCES `tcc`.`projeto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  INDEX `fk_requisito_usuario_idx` (`id` ASC),
  CONSTRAINT `fk_requisito_usuario`
    FOREIGN KEY (`idusu`)
    REFERENCES `tcc`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
