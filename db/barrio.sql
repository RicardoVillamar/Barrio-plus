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

CREATE TABLE `EstadoContribucion` (
  `idEstadoContribucion` INT PRIMARY KEY AUTO_INCREMENT,
  `nombreEstado` VARCHAR(50) NOT NULL
);

CREATE TABLE `Contribucion` (
  `idContribucion` INT PRIMARY KEY AUTO_INCREMENT,
  `idEstadoContribucionFK` INT NOT NULL,
  `idHerramientaFK` INT,
  `idInstalacionFK` INT,
  `idUsuarioFK` INT NOT NULL,
  FOREIGN KEY (`idEstadoContribucionFK`) REFERENCES `EstadoContribucion` (`idEstadoContribucion`),
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



INSERT INTO `Estado` (`nombre`) VALUES ('Libre'), ('Ocupado'), ('Aprobado'), ('Cancelado');
INSERT INTO `Tipo` (`nombre`) VALUES ('Aire libre'), ('Aula'), ('Salon'), ('Taller');
INSERT INTO `rolusuario` (`nombre`) VALUES ('Admin'), ('Vecino'), ('Contribuidor');
INSERT INTO `EstadoContribucion` (`nombreEstado`) VALUES ('En espera'), ('Aprobado');


INSERT INTO `Prioridad` (`nivel`) VALUES ('Alta'), ('Media'), ('Baja');
INSERT INTO `TipoPublicacion` (`nombreTipo`) VALUES ('Reporte de daños'), ('Avisos generales'), ('Avisos de mantenimiento'), ('Solicitudes de recursos');



INSERT INTO `Usuario` (`nombre`, `apellido`, `correo`, `contrasena`, `idRolFK`) VALUES
('Admin', 'Admin', 'Admin.Admin@hotmail.com', '123', 1),
('Miguel', 'Sanchez', 'miguel.sanchez@hotmail.com', '123', 1),
('Luisa', 'Garcia', 'luisa.garcia@outlook.com', '123', 2), 
('Vecino', 'Vecino', 'Vecino.Vecino@outlook.com', '123', 2), 
('Domenica', 'Rodriguez', 'domenica.rodriguez@hotmail.com', '123', 2), 
('Maria', 'Herrera', 'maria.herrera@hotmail.com', '123', 3), 
('Juan', 'Martinez', 'juan.martinez@gmail.com', '123', 3); 



INSERT INTO `Publicacion` (`titulo`, `idTipoFK`, `descripcion`, `idPrioridadFK`, `fechaEvento`, `notificarAdmin`, `idUsuarioFK`) VALUES
('Reparación de alumbrado', 1, 'Se requiere reparar un poste de luz en la calle principal.', 1, '2025-02-01', 1, 4), 
('Taller de reciclaje', 4, 'Organización de un taller de reciclaje en el salón comunitario.', 2, '2025-02-10', 0, 3),
('Aviso de mantenimiento', 3, 'Cierre temporal del parque por mantenimiento.', 3, '2025-01-30', 1, 2), 
('Fugas de agua', 1, 'Reporte de fuga de agua cerca del aula 2.', 1, '2025-01-29', 1, 4), 
('Anuncio de reunión', 2, 'Aviso para reunión general de vecinos el próximo viernes.', 2, '2025-02-05', 0, 5); 

INSERT INTO `Instalacion` (`nombre`, `descripcion`, `precio`, `tamano`, `idTipoFK`, `idEstadoFK`, `imagen`) 
VALUES 
('Cancha de fútbol', 'Cancha al aire libre para jugar fútbol', 200.00, '30x50 metros', 1, 1, NULL),
('Aula de capacitación', 'Aula equipada para talleres educativos', 100.00, '20x15 metros', 2, 1, NULL),
('Salón de eventos', 'Espacio para reuniones y eventos sociales', 300.00, '50x30 metros', 3, 2, NULL),
('Taller de carpintería', 'Espacio con herramientas para trabajos en madera', 150.00, '25x20 metros', 4, 1, NULL),
('Cancha de tenis', 'Cancha adecuada para practicar tenis', 180.00, '20x40 metros', 1, 1, NULL);

INSERT INTO `Herramienta` (`nombre`, `descripcion`, `precio`, `imagen`, `fechaRegistro`, `idEstadoFK`, `mantenimiento`, `cantidad`) 
VALUES 
('Martillo', 'Herramienta básica para golpear objetos', 15.50, NULL, '2025-01-01', 1, 'Revisión anual', 10),
('Taladro', 'Taladro eléctrico para perforar superficies', 120.00, NULL, '2025-01-05', 1, 'Lubricar mensualmente', 5),
('Destornillador', 'Conjunto de destornilladores de varias puntas', 25.00, NULL, '2025-01-10', 1, 'Limpieza semestral', 20),
('Llave inglesa', 'Llave ajustable para apretar o aflojar tuercas', 18.75, NULL, '2025-01-15', 2, 'Engrasar regularmente', 8),
('Sierra manual', 'Sierra para cortes en madera o plástico', 22.30, NULL, '2025-01-20', 1, 'Reemplazo de hoja según uso', 15);

INSERT INTO `Contribucion` (`idEstadoContribucionFK`, `idHerramientaFK`, `idInstalacionFK`, `idUsuarioFK`) 
VALUES 
(1, 1, NULL, 4), 
(2, NULL, 1, 3), 
(1, 3, NULL, 5), 
(2, NULL, 4, 2), 
(1, 2, NULL, 4); 
