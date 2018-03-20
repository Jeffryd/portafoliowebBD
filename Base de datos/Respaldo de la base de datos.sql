-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-03-2018 a las 23:41:06
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdatcompleta`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `prmostrarProd_Cat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prmostrarProd_Cat` (IN `NomCat` TINYINT(2))  BEGIN
SELECT  pro.Cliente, pro.Trabajo_Realizado, pro.IdImagen, cat.Nombre
  FROM proyecto pro LEFT OUTER JOIN categoria cat
  on pro.IdCategoria = cat.IdCategoria WHERE cat.IdCategoria = (NomCat); 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `IdCategoria` tinyint(2) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `Nombre`) VALUES
(5, 'Publicidad'),
(6, 'Dibujo Digital'),
(7, 'Fotografia'),
(9, 'Multimedia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `IdImagen` int(11) NOT NULL AUTO_INCREMENT,
  `Imagen_Boceto` varchar(50) NOT NULL,
  `Imagen_Desarrollo` varchar(50) NOT NULL,
  `Imagen_Final` varchar(50) NOT NULL,
  PRIMARY KEY (`IdImagen`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Imagenes de proyecto';

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`IdImagen`, `Imagen_Boceto`, `Imagen_Desarrollo`, `Imagen_Final`) VALUES
(1, 'imagen boceto', 'imagen  desarrollo', 'imagen fnal'),
(2, 'imagen boceto', 'imagen  desarrollo', 'imagen fnal'),
(3, 'imagen boceto 2', 'imagen desarrollo 2', 'imagen final 2'),
(4, 'imagen boceto 3', 'imagen desarrollo 3', 'imagen fina 3'),
(5, 'para eliminar', 'para elliminar', 'para eliminar'),
(6, 'de video', 'de video 2', 'de video 3'),
(7, 'ima1', 'ima2', 'ima3'),
(8, 'fjdafjdfdadsd', 'dfafadsf', 'fdassfads');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE IF NOT EXISTS `proyecto` (
  `IdProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `Cliente` varchar(50) NOT NULL,
  `Descripcion` text NOT NULL,
  `Tiempo_Invertido` int(11) NOT NULL,
  `Programas_Utilizados` varchar(255) NOT NULL,
  `Trabajo_Realizado` varchar(255) NOT NULL,
  `Fecha_Elaborado` date NOT NULL,
  `IdCategoria` tinyint(2) NOT NULL,
  `IdImagen` int(11) NOT NULL,
  PRIMARY KEY (`IdProyecto`),
  KEY `FK_PROYECTO_CATEGORIA` (`IdCategoria`),
  KEY `FK_PROYECTO_IMAGEN` (`IdImagen`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`IdProyecto`, `Cliente`, `Descripcion`, `Tiempo_Invertido`, `Programas_Utilizados`, `Trabajo_Realizado`, `Fecha_Elaborado`, `IdCategoria`, `IdImagen`) VALUES
(1, 'Enfermeria UNAV', 'Cartel jornadas', 20140518, 'Photoshop e Illustaror', 'Diseno de cartel', '2014-05-18', 5, 1),
(2, 'Cuarteto Exaltad', 'Logo para imagen coroportativa', 20140518, 'Photoshop e Illustaror', 'Logo y papeleria', '2014-05-18', 5, 2),
(4, 'UNAV PROYECTO FINAL', 'Diseno para camisa', 20140518, 'Photoshop e Illustaror', 'Propuesta de Diseno', '2014-05-18', 5, 4),
(7, 'UNAV', 'Pensamiento QVS', 20140518, 'Photoshop e Illustaror', 'Propuesta de Diseno', '2014-05-18', 7, 4),
(14, 'Video Biblioteca', 'Video para promo biblioteca', 20140518, ' Premiere pro Photoshop e Illustaror', 'Propuesta de video', '2014-05-18', 9, 7),
(15, 'Video Biblioteca', 'Video para promo biblioteca', 20140518, ' Premiere pro Photoshop e Illustaror', 'Propuesta de video', '2014-05-18', 9, 8),
(16, 'Video Biblioteca', 'Video para promo biblioteca', 20140518, ' Premiere pro Photoshop e Illustaror', 'Propuesta de video', '2014-05-18', 6, 5),
(18, 'Hla', 'jak', 2, 'jkljkl', 'jkljkl', '2014-03-18', 5, 7),
(19, 'Hla', 'jak', 2, 'jkljkl', 'jkljkl', '2014-03-18', 5, 7),
(20, 'Hla', 'jak', 2, 'jkljkl', 'jkljkl', '2014-03-18', 5, 7),
(22, 'yo sooy', 'jak', 2, 'jkljkl', 'jkljkl', '2014-03-18', 5, 7),
(23, 'hola hola', 'jak', 2, 'jkljkl', 'jkljkl', '2014-03-18', 5, 7),
(26, 'hola hola', 'jak', 2, 'jkljkl', 'jkljkl', '2014-03-18', 5, 7),
(27, 'fdsafadsf', 'fdasfadsfads fadsfadsf', 4, 'fdsfadsdf', 'fdsafads', '2014-03-18', 7, 7),
(28, 'Primer proyec desde Angular 4 y 5', 'fdasfadsfads fadsfadsf', 8, 'fdsfadsdf', 'fdsafads', '2014-03-18', 7, 7),
(42, 'fdsaf', 'fdasf', 5, 'fdsa', 'fdsafafdasf', '2015-03-18', 7, 7),
(43, 'Bingo', 'fdasf', 5, 'fdsa', 'fdsafafdasf', '2015-03-18', 7, 8),
(44, 'jajajaja', 'fdsafads fadsfads', 4, 'fdsa', 'fdsafasdd', '2012-01-18', 7, 7),
(45, 'jajajaja', 'fdsafads fadsfads', 4, 'fdsa', 'fdsafasdd', '2012-01-18', 7, 7),
(47, 'Angular funciona', 'fdsafads fadsfads', 4, 'fdsa', 'fdsafasdd', '2012-01-18', 5, 7),
(48, 'fdsaf', 'fdsafds', 7, 'fdasfas', 'fdasfas', '2014-03-18', 5, 7),
(49, 'Probando mi select', 'fdasfs', 10, 'fadfas', 'Agregamos un select al formulario', '2014-03-18', 9, 1),
(50, 'tres', 'fdasfdadsf fdasfad', 5, 'fdafadsf', 'fdasf', '2014-10-12', 7, 3),
(51, 'Viernes prueba', 'fdasfdasf', 8, 'fasfdsa', 'fdafdas', '2012-05-15', 9, 7),
(52, 'Quedo funcionando correctamente', 'fdasfadsfd', 8, 'fdsafdas', 'fadfads', '2012-07-18', 6, 7),
(53, 'prueba domingo 18', 'fjdasfdas jfdasfdas', 3, 'dfsafdas', 'fdasfasd', '2018-03-18', 6, 6);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `FK_PROYECTO_CATEGORIA` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PROYECTO_IMAGEN` FOREIGN KEY (`IdImagen`) REFERENCES `imagen` (`IdImagen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
