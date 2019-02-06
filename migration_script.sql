-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: engrcapstone
-- Source Schemata: engrcapstone
-- Created: Wed May  9 09:46:54 2018
-- Workbench Version: 6.3.10
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema engrcapstone
-- ----------------------------------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `engrcapstone` ;

-- ----------------------------------------------------------------------------
-- Table engrcapstone.APP_USERS
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `engrcapstone`.`APP_USERS` (
  `USER_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `PASSWORD` VARCHAR(40) CHARACTER SET 'utf8' NOT NULL,
  `IS_ADMIN` BIT(1) NOT NULL DEFAULT b'0',
  `FIRST_NAME` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL,
  `LAST_NAME` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`USER_ID`),
  UNIQUE INDEX `APP_USERS_UK` (`EMAIL` ASC),
  INDEX `SYS_C003939` (`IS_ADMIN` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

-- ----------------------------------------------------------------------------
-- Table engrcapstone.ATTACHMENT
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `engrcapstone`.`ATTACHMENT` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NAME` VARCHAR(45) NOT NULL,
  `DATA` LONGBLOB NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table engrcapstone.CONTACT
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `engrcapstone`.`CONTACT` (
  `CONTACT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `SPONSOR_ID` INT(11) NULL DEFAULT NULL,
  `FIRST_NAME` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL,
  `LAST_NAME` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL,
  `EMAIL` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `TITLE` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `PHONE` INT(45) NULL DEFAULT NULL,
  PRIMARY KEY (`CONTACT_ID`),
  INDEX `contact_sponsor_id_fk_idx` (`SPONSOR_ID` ASC),
  CONSTRAINT `contact_sponsor_id_fk`
    FOREIGN KEY (`SPONSOR_ID`)
    REFERENCES `engrcapstone`.`SPONSOR` (`SPONSOR_ID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

-- ----------------------------------------------------------------------------
-- Table engrcapstone.DEPARTMENT
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `engrcapstone`.`DEPARTMENT` (
  `DEPARTMENT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NAME` VARCHAR(70) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`DEPARTMENT_ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

-- ----------------------------------------------------------------------------
-- Table engrcapstone.PROJECT
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `engrcapstone`.`PROJECT` (
  `PROJECT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `SPONSOR_ID` INT(11) NULL DEFAULT NULL,
  `PROJECT_NAME` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `PROJECT_NUMBER` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `MENTOR` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `FACULTY_ADVISOR` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `DEPARTMENT_ID` INT(11) NOT NULL,
  `INDEX_CODE` INT(11) NULL DEFAULT NULL,
  `DONATION` INT(11) NULL DEFAULT NULL,
  `YEAR` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `STATUS_ID` INT(11) NOT NULL,
  `IS_SERVICE_LEARNING` BIT(1) NOT NULL DEFAULT b'0',
  `IS_IP_ASSIGNMENT` BIT(1) NOT NULL DEFAULT b'0',
  `IS_IP_DISCLOSURE` BIT(1) NOT NULL DEFAULT b'0',
  `IS_STERNHEIMER` BIT(1) NOT NULL DEFAULT b'0',
  `CAPSTONE_BUDGET` DOUBLE(20,2) NOT NULL,
  `AMOUNT_SPENT` DOUBLE(20,2) NOT NULL DEFAULT '0.00',
  `SUPPLEMENTAL_FUNDING` DOUBLE(20,2) NULL DEFAULT NULL,
  `IS_PARTNER` BIT(1) NOT NULL DEFAULT b'0',
  `IS_CITIZENSHIP_REQUIRED` BIT(1) NOT NULL DEFAULT b'0',
  `IS_NONDISCLOSURE_AGREEMENT` BIT(1) NOT NULL DEFAULT b'0',
  `NOTE` VARCHAR(3000) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `PROJECT_TYPE` VARCHAR(45) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `SPONSOR_ABSTRACT` INT(11) NULL DEFAULT NULL,
  `STUDENT_ABSTRACT` INT(11) NULL DEFAULT NULL,
  `STUDENT_POSTER` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`PROJECT_ID`),
  INDEX `SYS_C003969` (`IS_IP_DISCLOSURE` ASC),
  INDEX `SYS_C003970` (`IS_STERNHEIMER` ASC),
  INDEX `SYS_C003971` (`IS_PARTNER` ASC),
  INDEX `SYS_C003972` (`IS_CITIZENSHIP_REQUIRED` ASC),
  INDEX `SYS_C003973` (`IS_NONDISCLOSURE_AGREEMENT` ASC),
  INDEX `project_sponsor_id_fk_idx` (`SPONSOR_ID` ASC),
  INDEX `project_department_id_fk_idx` (`DEPARTMENT_ID` ASC),
  INDEX `project_status_id_fk_idx` (`STATUS_ID` ASC),
  INDEX `project_sponsor_abstract_fk_idx` (`SPONSOR_ABSTRACT` ASC),
  INDEX `project_student_abstract_fk_idx` (`STUDENT_ABSTRACT` ASC),
  INDEX `project_student_poster_fk_idx` (`STUDENT_POSTER` ASC),
  CONSTRAINT `project_department_id_fk`
    FOREIGN KEY (`DEPARTMENT_ID`)
    REFERENCES `engrcapstone`.`DEPARTMENT` (`DEPARTMENT_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `project_sponsor_abstract_fk`
    FOREIGN KEY (`SPONSOR_ABSTRACT`)
    REFERENCES `engrcapstone`.`ATTACHMENT` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `project_sponsor_id_fk`
    FOREIGN KEY (`SPONSOR_ID`)
    REFERENCES `engrcapstone`.`SPONSOR` (`SPONSOR_ID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `project_status_id_fk`
    FOREIGN KEY (`STATUS_ID`)
    REFERENCES `engrcapstone`.`STATUS` (`STATUS_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `project_student_abstract_fk`
    FOREIGN KEY (`STUDENT_ABSTRACT`)
    REFERENCES `engrcapstone`.`ATTACHMENT` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `project_student_poster_fk`
    FOREIGN KEY (`STUDENT_POSTER`)
    REFERENCES `engrcapstone`.`ATTACHMENT` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

-- ----------------------------------------------------------------------------
-- Table engrcapstone.SPONSOR
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `engrcapstone`.`SPONSOR` (
  `SPONSOR_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ORGANIZATION` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `ADDRESS` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `CITY` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL,
  `STATE` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `ZIP` INT(11) NOT NULL,
  `SPONSOR_TYPE` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `PARTNER_TYPE` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `IS_STRATEGIC` BIT(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`SPONSOR_ID`),
  INDEX `SYS_C003948` (`IS_STRATEGIC` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

-- ----------------------------------------------------------------------------
-- Table engrcapstone.STATUS
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `engrcapstone`.`STATUS` (
  `STATUS_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `PROJECT_STATUS` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`STATUS_ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

-- ----------------------------------------------------------------------------
-- Table engrcapstone.STUDENT
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `engrcapstone`.`STUDENT` (
  `STUDENT_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `DEPARTMENT_ID` INT(11) NOT NULL,
  `ACADEMIC_YEAR` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `FIRST_NAME` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL,
  `LAST_NAME` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL,
  `EMAIL` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL,
  `PROJECT_ID` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`STUDENT_ID`),
  INDEX `student_department_id_fk_idx` (`DEPARTMENT_ID` ASC),
  INDEX `student_project_id_fk_idx` (`PROJECT_ID` ASC),
  CONSTRAINT `student_department_id_fk`
    FOREIGN KEY (`DEPARTMENT_ID`)
    REFERENCES `engrcapstone`.`DEPARTMENT` (`DEPARTMENT_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `student_project_id_fk`
    FOREIGN KEY (`PROJECT_ID`)
    REFERENCES `engrcapstone`.`PROJECT` (`PROJECT_ID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

-- ----------------------------------------------------------------------------
-- View engrcapstone.PROJECT_INFO
-- ----------------------------------------------------------------------------
USE `engrcapstone`;
CREATE  OR REPLACE VIEW `engrcapstone`.`PROJECT_INFO` AS select distinct `p`.`PROJECT_ID` AS `PROJECT_ID`,`d`.`DEPARTMENT_ID` AS `DEPARTMENT_ID`,`d`.`NAME` AS `DEPARTMENT`,`p`.`PROJECT_NAME` AS `PROJECT_NAME`,`p`.`PROJECT_NUMBER` AS `PROJECT_NUMBER`,`p`.`PROJECT_TYPE` AS `PROJECT_TYPE`,`p`.`STATUS_ID` AS `STATUS_ID`,`p`.`NOTE` AS `NOTE`,`p`.`MENTOR` AS `MENTOR`,`p`.`FACULTY_ADVISOR` AS `FACULTY_ADVISOR`,`p`.`YEAR` AS `YEAR`,`p`.`INDEX_CODE` AS `INDEX_CODE`,`p`.`DONATION` AS `DONATION`,`p`.`CAPSTONE_BUDGET` AS `CAPSTONE_BUDGET`,`p`.`AMOUNT_SPENT` AS `AMOUNT_SPENT`,`p`.`SUPPLEMENTAL_FUNDING` AS `SUPPLEMENTAL_FUNDING`,`st`.`PROJECT_STATUS` AS `PROJECT_STATUS`,`p`.`IS_IP_DISCLOSURE` AS `IS_IP_DISCLOSURE`,`p`.`IS_IP_ASSIGNMENT` AS `IS_IP_ASSIGNMENT`,`p`.`IS_SERVICE_LEARNING` AS `IS_SERVICE_LEARNING`,`p`.`IS_STERNHEIMER` AS `IS_STERNHEIMER`,`p`.`IS_PARTNER` AS `IS_PARTNER`,`p`.`IS_CITIZENSHIP_REQUIRED` AS `IS_CITIZENSHIP_REQUIRED`,`p`.`IS_NONDISCLOSURE_AGREEMENT` AS `IS_NONDISCLOSURE_AGREEMENT`,`p`.`SPONSOR_ABSTRACT` AS `SPONSOR_ABSTRACT_ID`,`p`.`STUDENT_ABSTRACT` AS `STUDENT_ABSTRACT_ID`,`p`.`STUDENT_POSTER` AS `STUDENT_POSTER_ID`,`sp`.`SPONSOR_ID` AS `SPONSOR_ID`,`sp`.`ORGANIZATION` AS `SPONSOR`,`sp`.`ADDRESS` AS `ADDRESS`,`sp`.`CITY` AS `CITY`,`sp`.`STATE` AS `STATE`,`sp`.`ZIP` AS `ZIP`,`sp`.`IS_STRATEGIC` AS `IS_STRATEGIC`,`sp`.`SPONSOR_TYPE` AS `SPONSOR_TYPE`,`sp`.`PARTNER_TYPE` AS `PARTNER_TYPE`,`s`.`STUDENT_ID` AS `STUDENT_ID` from ((((`engrcapstone`.`PROJECT` `p` left join `engrcapstone`.`DEPARTMENT` `d` on((`p`.`DEPARTMENT_ID` = `d`.`DEPARTMENT_ID`))) left join `engrcapstone`.`STATUS` `st` on((`p`.`STATUS_ID` = `st`.`STATUS_ID`))) left join `engrcapstone`.`SPONSOR` `sp` on((`p`.`SPONSOR_ID` = `sp`.`SPONSOR_ID`))) left join `engrcapstone`.`STUDENT` `s` on((`p`.`PROJECT_ID` = `s`.`PROJECT_ID`)));

-- ----------------------------------------------------------------------------
-- Routine engrcapstone.add_user
-- ----------------------------------------------------------------------------
DELIMITER $$

DELIMITER $$
USE `engrcapstone`$$
CREATE PROCEDURE `add_user`(IN p_email   VARCHAR(4000),
                      IN p_password   VARCHAR(4000),
                      IN p_is_admin BIT,
                      p_first_name VARCHAR(4000),
                      p_last_name VARCHAR(4000))
BEGIN
	INSERT INTO APP_USERS (
      email,
      `PASSWORD`,
      is_admin,
      first_name,
      last_name
    )
    VALUES (
      UPPER(p_email),
      get_hash(p_email, p_password),
      p_is_admin,
      p_first_name,
      p_last_name
    );
END$$

DELIMITER ;

-- ----------------------------------------------------------------------------
-- Routine engrcapstone.change_password
-- ----------------------------------------------------------------------------
DELIMITER $$

DELIMITER $$
USE `engrcapstone`$$
CREATE PROCEDURE `change_password`(IN p_email VARCHAR(4000),
                             IN p_old_password   VARCHAR(4000),
                             IN p_new_password   VARCHAR(4000))
BEGIN
    DECLARE v_USER_ID CHAR(10);
   
    DECLARE EXIT HANDLER FOR NOT FOUND BEGIN
		SIGNAL SQLSTATE 'XAE07' SET MESSAGE_TEXT = 'Invalid email/PASSWORD.';
    END;
    
    SELECT USER_ID
    INTO   v_USER_ID
    FROM   APP_USERS
    WHERE  EMAIL = UPPER(p_email)
    AND    `PASSWORD` = get_hash(p_email, p_old_password)
    FOR UPDATE;
    
    UPDATE APP_USERS
    SET    `PASSWORD` = get_hash(p_email, p_new_password)
    WHERE  USER_ID    = v_USER_ID;
    
    COMMIT;
   END$$

DELIMITER ;

-- ----------------------------------------------------------------------------
-- Routine engrcapstone.get_hash
-- ----------------------------------------------------------------------------
DELIMITER $$

DELIMITER $$
USE `engrcapstone`$$
CREATE FUNCTION `get_hash`(p_email VARCHAR(4000), p_password VARCHAR(4000)) RETURNS varchar(4000) CHARSET latin1
    DETERMINISTIC
BEGIN
	DECLARE l_salt VARCHAR(30) DEFAULT 'SaltPasswordText';
	RETURN MD5(concat(UPPER(p_email), l_salt,UPPER(p_password)));
END$$

DELIMITER ;

-- ----------------------------------------------------------------------------
-- Routine engrcapstone.valid_user
-- ----------------------------------------------------------------------------
DELIMITER $$

DELIMITER $$
USE `engrcapstone`$$
CREATE FUNCTION `valid_user`(p_email VARCHAR(4000), p_password VARCHAR(4000)) RETURNS varchar(1) CHARSET latin1
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
      RETURN '0';
    END;
    
    CALL valid_user(p_email, p_password);
    RETURN '1';
END$$

DELIMITER ;
DELIMITER $$
CREATE PROCEDURE `valid_user`(IN p_email   VARCHAR(4000),
                        IN p_password   VARCHAR(4000))
BEGIN
    DECLARE v_dummy VARCHAR(1);
   
    DECLARE EXIT HANDLER FOR NOT FOUND BEGIN
		SIGNAL SQLSTATE 'XAE07' SET MESSAGE_TEXT = 'Invalid email/PASSWORD.';
    END;
    
    SELECT '1'
    INTO   v_dummy
    FROM   APP_USERS
    WHERE  EMAIL = UPPER(p_email)
    AND    `PASSWORD` = get_hash(p_email, p_password);
 END$$
DELIMITER ;
SET FOREIGN_KEY_CHECKS = 1;
