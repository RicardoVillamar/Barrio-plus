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
  `idRolFK` INT NOT NULL
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
  `imagen` VARCHAR(255),
  `fechaRegistro` DATE NOT NULL,
  `idEstadoFK` INT NOT NULL,
  `mantenimiento` BOOLEAN DEFAULT false,
  `cantidad` INT NOT NULL,
  `idContribuidorFK` INT
);

CREATE TABLE `Instalacion` (
  `idInstalacion` INT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(150) NOT NULL,
  `descripcion` TEXT,
  `precio` DECIMAL(10,2) NOT NULL,
  `tamano` VARCHAR(50),
  `idTipoFK` INT NOT NULL,
  `idEstadoFK` INT NOT NULL,
  `idContribuidorFK` INT,
  `imagen` VARCHAR(255)
);

CREATE TABLE `ReservacionHerramienta` (
  `idReservacion` INT PRIMARY KEY AUTO_INCREMENT,
  `estado` VARCHAR(50) NOT NULL,
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
  `estado` VARCHAR(50) NOT NULL,
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
  `descripcion` VARCHAR(50) NOT NULL
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
  `tipo` VARCHAR(50) NOT NULL,
  `idRecursoFK` INT NOT NULL,
  `idUsuarioFK` INT NOT NULL
);

ALTER TABLE `Usuario` ADD FOREIGN KEY (`idRolFK`) REFERENCES `RolUsuario` (`idRol`);

ALTER TABLE `Herramienta` ADD FOREIGN KEY (`idEstadoFK`) REFERENCES `Estado` (`idEstado`);

ALTER TABLE `Herramienta` ADD FOREIGN KEY (`idContribuidorFK`) REFERENCES `Usuario` (`idUsuario`);

ALTER TABLE `Instalacion` ADD FOREIGN KEY (`idTipoFK`) REFERENCES `Tipo` (`idTipo`);

ALTER TABLE `Instalacion` ADD FOREIGN KEY (`idEstadoFK`) REFERENCES `Estado` (`idEstado`);

ALTER TABLE `Instalacion` ADD FOREIGN KEY (`idContribuidorFK`) REFERENCES `Usuario` (`idUsuario`);

ALTER TABLE `ReservacionHerramienta` ADD FOREIGN KEY (`idHerramientaFK`) REFERENCES `Herramienta` (`idHerramienta`);

ALTER TABLE `ReservacionHerramienta` ADD FOREIGN KEY (`idUsuarioFK`) REFERENCES `Usuario` (`idUsuario`);

ALTER TABLE `ReservacionInstalacion` ADD FOREIGN KEY (`idInstalacionFK`) REFERENCES `Instalacion` (`idInstalacion`);

ALTER TABLE `ReservacionInstalacion` ADD FOREIGN KEY (`idUsuarioFK`) REFERENCES `Usuario` (`idUsuario`);

ALTER TABLE `Publicacion` ADD FOREIGN KEY (`idUsuarioFK`) REFERENCES `Usuario` (`idUsuario`);

ALTER TABLE `Publicacion` ADD FOREIGN KEY (`idTipoFK`) REFERENCES `TipoPublicacion` (`idTipo`);

ALTER TABLE `Publicacion` ADD FOREIGN KEY (`idPrioridadFK`) REFERENCES `Prioridad` (`idPrioridad`);

ALTER TABLE `Contribucion` ADD FOREIGN KEY (`idUsuarioFK`) REFERENCES `Usuario` (`idUsuario`);



--INSERT INTO `Estado` (`nombre`) VALUES ('Libre'), ('Ocupado');
--INSERT INTO `Tipo` (`nombre`) VALUES ('Aire libre'), ('Aula'), ('Salon'), ('Taller');
--INSERT INTO `rolusuario` (`nombre`) VALUES ('Admin'), ('Vecino'), ('Contribuidor');