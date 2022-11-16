-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: wccorp.duckdns.org
-- Tiempo de generación: 16-11-2022 a las 20:41:08
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendadb_2022`
--
DROP DATABASE IF EXISTS `agendadb_2022`;
CREATE DATABASE IF NOT EXISTS `agendadb_2022` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `agendadb_2022`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `sp_eliminar_cita`$$
CREATE DEFINER=`willcrackcorp`@`localhost` PROCEDURE `sp_eliminar_cita` (IN `param_idCita` VARCHAR(255))   BEGIN
    SET @s = CONCAT("DELETE FROM citas WHERE idcita='",param_idCita,"'");
	PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `sp_grabar_nuevas_citas`$$
CREATE DEFINER=`willcrackcorp`@`localhost` PROCEDURE `sp_grabar_nuevas_citas` (IN `param_diaCita` VARCHAR(255), IN `param_horaCita` VARCHAR(255), IN `param_asuntoCita` VARCHAR(255))   BEGIN
    SET @s = CONCAT("INSERT INTO citas (diacita, horacita, asuntocita) VALUES ('",param_diaCita,"','",param_horaCita,"','",param_asuntoCita,"')");
    PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `sp_listar_citas`$$
CREATE DEFINER=`willcrackcorp`@`localhost` PROCEDURE `sp_listar_citas` (IN `param_cita` VARCHAR(255))   BEGIN
    SET @s = CONCAT("SELECT * FROM citas WHERE diacita='",param_cita,"' ORDER BY horacita");
    PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `sp_listar_una_cita`$$
CREATE DEFINER=`willcrackcorp`@`localhost` PROCEDURE `sp_listar_una_cita` (IN `param_idCita` VARCHAR(255))   BEGIN
    SET @s = CONCAT("SELECT horacita, asuntocita FROM citas WHERE idcita='",param_idCita,"'");
	PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `sp_modificar_una_cita`$$
CREATE DEFINER=`willcrackcorp`@`localhost` PROCEDURE `sp_modificar_una_cita` (IN `param_nuevaFecha` VARCHAR(255), IN `param_nuevaHora` VARCHAR(255), IN `param_asuntoCita` VARCHAR(255), IN `param_idCita` VARCHAR(255))   BEGIN
    SET @s = CONCAT("UPDATE citas SET diacita='",param_nuevaFecha,"', horacita='",param_nuevaHora,"', asuntocita='",param_asuntoCita,"' WHERE idcita='",param_idCita,"'");
	PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--
-- Creación: 15-11-2022 a las 03:39:34
-- Última actualización: 16-11-2022 a las 19:20:04
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `idcita` tinyint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Para incrementar el numero de registros de la cita.',
  `horacita` time DEFAULT NULL COMMENT 'Para almacenar la hora en que se va a realizar la cita.',
  `diacita` date DEFAULT NULL COMMENT 'Para registrar el dia en que se haga la cita.',
  `asuntocita` varchar(256) COLLATE utf8mb4_spanish2_ci NOT NULL COMMENT 'En tal caso la descripcon de la misma.',
  `fecha_reg` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Uso exclusivo para auditoria interna.',
  PRIMARY KEY (`idcita`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `citas`:
--

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idcita`, `horacita`, `diacita`, `asuntocita`, `fecha_reg`) VALUES
(1, '18:54:35', '2022-10-18', 'Creacion de la primera cita.', '2022-11-15 04:03:25'),
(2, '18:54:35', '2022-10-18', 'Creacion de la primera cita.', '2022-11-15 04:03:25'),
(3, '18:54:35', '2022-10-18', 'Creacion de la segunda cita.', '2022-11-15 04:03:25'),
(4, '18:54:35', '2022-10-18', 'Creacion de la tercera cita.', '2022-11-15 04:03:25'),
(5, '18:54:35', '2022-10-18', 'Creacion de la cuarta cita.', '2022-11-15 04:03:25'),
(6, '18:54:35', '2022-11-10', 'Creacion de la quinta cita.', '2022-11-15 04:03:25'),
(7, '16:30:00', '0000-00-00', 'Creación de cita para parcial de hoy DS7. Es a las 6:00 PM.', '2022-11-16 16:46:18'),
(8, '18:20:00', '2022-11-17', 'Inicio del Parcial No. 2 de DS7, hay que hacerlo bien. Se modifica este registro.', '2022-11-16 16:48:58'),
(9, '22:00:00', '2022-11-16', 'Se Termina el parcial No.2 de la materia de DS7', '2022-11-16 19:11:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
