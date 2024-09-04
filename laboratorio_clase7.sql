-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 04, 2024 at 06:32 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laboratorio_clase7`
--
CREATE DATABASE IF NOT EXISTS `laboratorio_clase7` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `laboratorio_clase7`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `DesactivarProveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DesactivarProveedor` (IN `pNIT` CHAR(20))   BEGIN
    UPDATE Proveedores SET Activo = 0 WHERE NIT = pNIT;
END$$

DROP PROCEDURE IF EXISTS `InsertarProveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarProveedor` (IN `pNIT` CHAR(20), IN `pNombre` VARCHAR(100), IN `pTelefono` VARCHAR(15), IN `pDireccion` VARCHAR(255))   BEGIN
    INSERT INTO Proveedores (NIT, Nombre, Telefono, Direccion) 
    VALUES (pNIT, pNombre, pTelefono, pDireccion);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `NIT` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`NIT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`NIT`, `Nombre`, `Telefono`, `Direccion`, `Activo`) VALUES
('000000000002', 'Maria Fernanda Lopez', '1111222233', 'Avenida Principal, San Salvador, El Salvador', 0),
('000000000003', 'Carlos Andres Ramirez', '2222333344', 'Barrio La Gran Vía, Tegucigalpa, Honduras', 1),
('000000000004', 'Andrea Gomez Martinez', '3333444455', 'Colonia Centro, Managua, Nicaragua', 1),
('000000000005', 'Jorge Luis Martinez', '4444555566', 'Calle Central, Ciudad de Guatemala, Guatemala', 1),
('000000000006', 'Diana Carolina Alvarez', '5555666677', 'Boulevard Los Proceres, San Pedro Sula, Honduras', 0),
('000000000007', 'Luis Alberto Mendez', '6666777788', 'Zona Norte, San José, Costa Rica', 1),
('000000000008', 'Ana Patricia Morales', '7777888899', 'Avenida Libertador, Caracas, Venezuela', 0),
('000000000009', 'Fernando Jose Ortiz', '8888999900', 'Urbanización El Bosque, San Juan, Puerto Rico', 1),
('00000000001', 'Christofer Alexander Vega', '1111111111', 'Sabana Vecindario en San José, Costa Rica', 0),
('000000000010', 'Valeria Rodriguez Cruz', '9999000011', 'Calle 50, Ciudad de Panamá, Panamá', 1),
('000000000011', 'Ricardo Alejandro Fernandez', '1111333355', 'Avenida Universidad, Quito, Ecuador', 1),
('00000000002', 'Cristian Alexander Vega', '1111111111', 'Sabana Vecindario en San José, Costa Rica', 0),
('00000000004', 'Jose Perez Gutierrez', '22221212', 'Sabana Vecindario en San José, Costa Rica', 1),
('00000000010', 'Redentor Perez', '299922222', 'El zapote zona 2, capital', 1),
('007', 'Velentino Cancun JCK', '66644433', '', 1),
('123456789', 'Proveedor A', '3555-1234', 'Calle Falsa 123, Ciudad A', 1),
('456789123', 'Proveedor C', '3555-9876', 'Boulevard de los Sueños 789, Ciudad C', 0),
('553626622', 'Blanca Celedon', '123123123', 'Guatemala, capital', 1),
('987654321', 'Proveedor B', '3555-5678', 'Avenida Siempre Viva 456, Ciudad B', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `full_name`, `password_hash`, `created_at`) VALUES
(1, 'admin@miumg.edu.gt', 'Super Admin', '$2y$10$Wj5nrFv91imc/ubXYVmv.eOY/1NykB4E95a0ezfGV09GAJ8jjpPwe', '2024-09-04 04:20:04'),
(2, 'toor@miumg.edu.gt', 'Christofer Enriquez', '$2y$10$igqklwpX60FzAX/WKGZQ5.sBGtjQ71PJEChNVmS21Uh1aeM8iY2Hm', '2024-09-04 04:20:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
