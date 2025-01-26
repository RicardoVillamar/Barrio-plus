DROP DATABASE IF EXISTS barrioplusdb;
CREATE DATABASE barrioplusdb;
USE barrioplusdb;

CREATE TABLE `RolUsuario` (
  `idRol` INT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL
);

CREATE TABLE `Usuario` (
  `idUsuario` INT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `correo` VARCHAR(150) UNIQUE NOT NULL,
  `contrasena` VARCHAR(255) NOT NULL,
  `idRolFK` INT NOT NULL,
  `imagen` LONGBLOB
);

CREATE TABLE `Tipo` (
  `idTipo` INT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL
);

CREATE TABLE `Estado` (
  `idEstado` INT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL
);

CREATE TABLE `Herramienta` (
  `idHerramienta` INT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(150) NOT NULL,
  `descripcion` TEXT,
  `precio` DECIMAL(10,2) NOT NULL,
  `imagen` LONGBLOB,
  `fechaRegistro` DATE NOT NULL,
  `idEstadoFK` INT NOT NULL,
  `mantenimiento` VARCHAR(150) NOT NULL,
  `cantidad` INT NOT NULL
);

CREATE TABLE `Instalacion` (
  `idInstalacion` INT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(150) NOT NULL,
  `descripcion` TEXT,
  `precio` DECIMAL(10,2) NOT NULL,
  `tamano` VARCHAR(50),
  `idTipoFK` INT NOT NULL,
  `idEstadoFK` INT NOT NULL,
  `imagen` LONGBLOB
);

CREATE TABLE `ReservacionHerramienta` (
  `idReservacion` INT PRIMARY KEY AUTO_INCREMENT,
  `idEstadoFK` INT NOT NULL,
  `idHerramientaFK` INT NOT NULL,
  `idUsuarioFK` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `fechaInicio` DATE NOT NULL,
  `fechaFin` DATE NOT NULL,
  `proposito` TEXT,
  `capacitacion` BOOLEAN DEFAULT false
);

CREATE TABLE `ReservacionInstalacion` (
  `idReservacion` INT PRIMARY KEY AUTO_INCREMENT,
  `idEstadoFK` INT NOT NULL,
  `idInstalacionFK` INT NOT NULL,
  `idUsuarioFK` INT NOT NULL,
  `fechaInicio` DATE NOT NULL,
  `fechaFin` DATE NOT NULL,
  `personasEsperadas` INT NOT NULL,
  `observaciones` TEXT,
  `proposito` TEXT
);

CREATE TABLE TipoPublicacion (
  `idTipo` INT AUTO_INCREMENT PRIMARY KEY,
  `nombreTipo` VARCHAR(50) NOT NULL
);

CREATE TABLE Prioridad (
  `idPrioridad` INT AUTO_INCREMENT PRIMARY KEY,
  `nivel` VARCHAR(20) NOT NULL
);

CREATE TABLE Publicacion ( 
  `idPubli` INT AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(30) NOT NULL,
  `idTipoFK` INT NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `idPrioridadFK` INT NOT NULL,
  `fechaEvento` DATE NOT NULL,
  `notificarAdmin` INT(1) NOT NULL,
  `idUsuarioFK` INT NOT NULL
);

CREATE TABLE `Contribucion` (
  `idContribucion` INT PRIMARY KEY AUTO_INCREMENT,
  `estado` VARCHAR(50) NOT NULL,
  `idHerramientaFK` INT,
  `idInstalacionFK` INT,
  `idUsuarioFK` INT NOT NULL,
  FOREIGN KEY (`idHerramientaFK`) REFERENCES `Herramienta` (`idHerramienta`),
  FOREIGN KEY (`idInstalacionFK`) REFERENCES `Instalacion` (`idInstalacion`)
);

ALTER TABLE `Usuario` ADD FOREIGN KEY (`idRolFK`) REFERENCES `RolUsuario` (`idRol`);
ALTER TABLE `Herramienta` ADD FOREIGN KEY (`idEstadoFK`) REFERENCES `Estado` (`idEstado`);
ALTER TABLE `Instalacion` ADD FOREIGN KEY (`idTipoFK`) REFERENCES `Tipo` (`idTipo`);
ALTER TABLE `Instalacion` ADD FOREIGN KEY (`idEstadoFK`) REFERENCES `Estado` (`idEstado`);
ALTER TABLE `ReservacionHerramienta` ADD FOREIGN KEY (`idHerramientaFK`) REFERENCES `Herramienta` (`idHerramienta`);
ALTER TABLE `ReservacionHerramienta` ADD FOREIGN KEY (`idUsuarioFK`) REFERENCES `Usuario` (`idUsuario`);
ALTER TABLE `ReservacionHerramienta` ADD FOREIGN KEY (`idEstadoFK`) REFERENCES `Estado` (`idEstado`);
ALTER TABLE `ReservacionInstalacion` ADD FOREIGN KEY (`idInstalacionFK`) REFERENCES `Instalacion` (`idInstalacion`);
ALTER TABLE `ReservacionInstalacion` ADD FOREIGN KEY (`idUsuarioFK`) REFERENCES `Usuario` (`idUsuario`);
ALTER TABLE `ReservacionInstalacion` ADD FOREIGN KEY (`idEstadoFK`) REFERENCES `Estado` (`idEstado`);
ALTER TABLE `Publicacion` ADD FOREIGN KEY (`idUsuarioFK`) REFERENCES `Usuario` (`idUsuario`);
ALTER TABLE `Publicacion` ADD FOREIGN KEY (`idTipoFK`) REFERENCES `TipoPublicacion` (`idTipo`);
ALTER TABLE `Publicacion` ADD FOREIGN KEY (`idPrioridadFK`) REFERENCES `Prioridad` (`idPrioridad`);


DELIMITER $$

CREATE TRIGGER `before_insert_reservacioninstalacion`
AFTER INSERT ON `ReservacionInstalacion`
FOR EACH ROW
BEGIN
    UPDATE `Instalacion`
    SET `idEstadoFK` = (SELECT `idEstado` FROM `Estado` WHERE `nombre` = 'Ocupado')
    WHERE `idInstalacion` = NEW.`idInstalacionFK`;
END$$

CREATE TRIGGER `after_delete_reservacioninstalacion`
AFTER DELETE ON `ReservacionInstalacion`
FOR EACH ROW
BEGIN
    UPDATE `Instalacion`
    SET `idEstadoFK` = (SELECT `idEstado` FROM `Estado` WHERE `nombre` = 'Libre')
    WHERE `idInstalacion` = OLD.`idInstalacionFK`;
END$$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER `before_insert_reservacionherramienta`
AFTER INSERT ON `ReservacionHerramienta`
FOR EACH ROW
BEGIN
    UPDATE `Herramienta`
    SET `idEstadoFK` = (SELECT `idEstado` FROM `Estado` WHERE `nombre` = 'Ocupado')
    WHERE `idHerramienta` = NEW.`idHerramientaFK`;
END$$

CREATE TRIGGER `after_delete_reservacionherramienta`
AFTER DELETE ON `ReservacionHerramienta`
FOR EACH ROW
BEGIN
    UPDATE `Herramienta`
    SET `idEstadoFK` = (SELECT `idEstado` FROM `Estado` WHERE `nombre` = 'Libre')
    WHERE `idHerramienta` = OLD.`idHerramientaFK`;
END$$

DELIMITER ;



INSERT INTO `Estado` (`nombre`) VALUES ('Libre'), ('Ocupado');
INSERT INTO `Tipo` (`nombre`) VALUES ('Aire libre'), ('Aula'), ('Salon'), ('Taller');
INSERT INTO `rolusuario` (`nombre`) VALUES ('Admin'), ('Vecino'), ('Contribuidor');


INSERT INTO `Prioridad` (`nivel`) VALUES ('Alta'), ('Media'), ('Baja');
INSERT INTO `TipoPublicacion` (`nombreTipo`) VALUES ('Reporte de daños'), ('Avisos generales'), ('Avisos de mantenimiento'), ('Solicitudes de recursos');



INSERT INTO `Usuario` (`nombre`, `apellido`, `correo`, `contrasena`, `idRolFK`) VALUES
('Miguel', 'Sanchez', 'miguel.sanchez@hotmail.com', 'migueADM', 1),
('Luisa', 'Garcia', 'luisa.garcia@outlook.com', 'garciaLuisa', 2), 
('Domenica', 'Rodriguez', 'domenica.rodriguez@hotmail.com', 'rodriguezDo', 2), 
('Maria', 'Herrera', 'maria.herrera@hotmail.com', 'herrMaria', 3), 
('Juan', 'Martinez', 'juan.martinez@gmail.com', 'juADM', 3); 



INSERT INTO `Publicacion` (`titulo`, `idTipoFK`, `descripcion`, `idPrioridadFK`, `fechaEvento`, `notificarAdmin`, `idUsuarioFK`) VALUES
('Reparación de alumbrado', 1, 'Se requiere reparar un poste de luz en la calle principal.', 1, '2025-02-01', 1, 4), 
('Taller de reciclaje', 4, 'Organización de un taller de reciclaje en el salón comunitario.', 2, '2025-02-10', 0, 3),
('Aviso de mantenimiento', 3, 'Cierre temporal del parque por mantenimiento.', 3, '2025-01-30', 1, 2), 
('Fugas de agua', 1, 'Reporte de fuga de agua cerca del aula 2.', 1, '2025-01-29', 1, 4), 
('Anuncio de reunión', 2, 'Aviso para reunión general de vecinos el próximo viernes.', 2, '2025-02-05', 0, 5); 
