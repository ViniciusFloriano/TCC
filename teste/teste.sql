-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema wftutorials
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `wftutorials` DEFAULT CHARACTER SET utf8 ;
USE `wftutorials` ;

-- -----------------------------------------------------
-- Table `wftutorials`.`kaban_board`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wftutorials`.`kaban_board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(65) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
