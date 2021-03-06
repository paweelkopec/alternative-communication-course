-- MySQL Script generated by MySQL Workbench
-- pią, 15 kwi 2016, 14:28:21
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema acc
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema acc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `acc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `acc` ;

-- -----------------------------------------------------
-- Table `acc`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acc`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acc`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acc`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `role_id` INT(11) NULL COMMENT '',
  `email` VARCHAR(120) NOT NULL COMMENT '',
  `password` VARCHAR(120) NOT NULL COMMENT '',
  `note` TEXT NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `remember_token` VARCHAR(120) NULL COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_users_1_idx` (`role_id` ASC)  COMMENT '',
  CONSTRAINT `fk_users_1`
    FOREIGN KEY (`role_id`)
    REFERENCES `acc`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acc`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acc`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '');


-- -----------------------------------------------------
-- Table `acc`.`courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acc`.`courses` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  `category_id` INT(11) NOT NULL COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '',
  INDEX `fk_course_1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_course_2_idx` (`category_id` ASC)  COMMENT '',
  CONSTRAINT `fk_course_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `acc`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_course_2`
    FOREIGN KEY (`category_id`)
    REFERENCES `acc`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acc`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acc`.`files` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `course_id` INT(11) NOT NULL COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `file` VARCHAR(250) NOT NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  UNIQUE INDEX `file_UNIQUE` (`file` ASC)  COMMENT '',
  INDEX `fk_file_1_idx` (`course_id` ASC)  COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  CONSTRAINT `fk_file_1`
    FOREIGN KEY (`course_id`)
    REFERENCES `acc`.`courses` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `acc`.`roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `acc`;
INSERT INTO `acc`.`roles` (`id`, `name`) VALUES (1, 'user');
INSERT INTO `acc`.`roles` (`id`, `name`) VALUES (2, 'admin');

COMMIT;


-- -----------------------------------------------------
-- Data for table `acc`.`categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `acc`;
INSERT INTO `acc`.`categories` (`id`, `name`) VALUES (1, 'Alfabet');
INSERT INTO `acc`.`categories` (`id`, `name`) VALUES (2, 'Numery');

COMMIT;

