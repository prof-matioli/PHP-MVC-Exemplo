CREATE TABLE `matioli`.`aluno` (
  `idaluno` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `ra` VARCHAR(8) NOT NULL,
  `email` VARCHAR(100) NULL,
  `celular` VARCHAR(50) NULL,
  PRIMARY KEY (`idaluno`),
  UNIQUE INDEX `idaluno_UNIQUE` (`idaluno` ASC),
  UNIQUE INDEX `ra_UNIQUE` (`ra` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));
