
CREATE database IF NOT EXISTS `dietacerta` DEFAULT CHARACTER SET utf8 ;
USE `dietacerta` ;

-- -----------------------------------------------------
-- Table `dietacerta`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dietacerta`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `act` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dietacerta`.`diet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dietacerta`.`diet` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `weight` DOUBLE(10,2) NOT NULL,
  `carb` DOUBLE(10,2) NOT NULL,
  `prot` DOUBLE(10,2) NOT NULL,
  `tfat` DOUBLE(10,2) NOT NULL,
  `calories` DOUBLE(10,2) NOT NULL,
  `act` TINYINT NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_diet_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_diet_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `dietacerta`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dietacerta`.`food`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dietacerta`.`food` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `weight` DOUBLE(10,2) NOT NULL,
  `user_id` INT NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `carb` DOUBLE(10,2) NOT NULL,
  `prot` DOUBLE(10,2) NOT NULL,
  `tfat` DOUBLE(10,2) NOT NULL,
  `fiber` DOUBLE(10,2) NOT NULL,
  `sodium` DOUBLE(10,2) NOT NULL,
  `calories` DOUBLE(10,2) NOT NULL,
  `unit` VARCHAR(20) NOT NULL DEFAULT 'g',
  `act` TINYINT NOT NULL DEFAULT 1,
  `group` VARCHAR(100),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dietacerta`.`meal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dietacerta`.`meal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `diet_id` INT NOT NULL,
  `food_id` INT NOT NULL,
  `qtd` DOUBLE(10,2) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `fk_meal_diet_id_idx` (`diet_id` ASC),
  INDEX `fk_meal_food_id_idx` (`food_id` ASC),
  CONSTRAINT `fk_meal_diet_id`
    FOREIGN KEY (`diet_id`)
    REFERENCES `dietacerta`.`diet` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_meal_food_id`
    FOREIGN KEY (`food_id`)
    REFERENCES `dietacerta`.`food` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
