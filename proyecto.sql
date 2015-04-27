-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2015 a las 20:53:55
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto`
--
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proyecto`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `secciones`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `secciones`(IN `ID` INT(10), IN `carrera` VARCHAR(20), IN `turno` VARCHAR(20), IN `nombre` VARCHAR(7))
    NO SQL
INSERT INTO bitacora(host, usuario, operacion, modificado, tabla) VALUES (host,nombre,"insertar", NOW(),"secciones")$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE IF NOT EXISTS `bitacora` (
`id` int(11) NOT NULL,
  `operacion` varchar(10) DEFAULT NULL,
  `usuario` varchar(40) DEFAULT NULL,
  `host` varchar(30) NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `tabla` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `operacion`, `usuario`, `host`, `modificado`, `tabla`) VALUES
(1, 'eliminar', NULL, 'root@localhost', '2015-04-02 13:34:47', 'secciones'),
(2, 'insertar', '1D03IS', '', '2015-04-02 14:16:56', 'secciones'),
(3, 'insertar', '1N10IE', '', '2015-04-02 14:23:55', 'secciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `carrera` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`carrera`) VALUES
('Sistemas'),
('Electrica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

DROP TABLE IF EXISTS `horarios`;
CREATE TABLE IF NOT EXISTS `horarios` (
  `cod_horario` varchar(10) NOT NULL,
  `dias` varchar(30) NOT NULL,
  `codigo_seccion` varchar(10) NOT NULL,
  `codigo_asignatura` varchar(10) NOT NULL,
  `hora_entrada` int(10) NOT NULL,
  `hora_salida` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

DROP TABLE IF EXISTS `profesores`;
CREATE TABLE IF NOT EXISTS `profesores` (
`ID` int(100) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `cedula` int(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `condicion` varchar(10) NOT NULL,
  `formacion` varchar(20) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `banco` varchar(30) NOT NULL,
  `nr_cuenta` bigint(40) NOT NULL,
  `materia1` varchar(30) NOT NULL,
  `materia2` varchar(30) NOT NULL,
  `materia3` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`ID`, `nombre`, `apellido`, `cedula`, `direccion`, `telefono`, `correo`, `genero`, `condicion`, `formacion`, `especialidad`, `estado`, `banco`, `nr_cuenta`, `materia1`, `materia2`, `materia3`) VALUES
(6, 'Manuel', 'Santeliz', 141455040, 'Calle nueva esparta', '(0416)956-4705', 'Manuel@santeliz.com', 'Masculino', 'General', 'Magister', 'Matematica', 'Amazonas', '', 0, '', '', ''),
(7, 'Miguel', 'Suarez', 22261129, 'Carrera 9', '04169564705', 'jozhee@live.com', 'Femenino', 'General', 'Ingeniero', 'Matematico', 'Lara', 'Banesco', 11909129391, '', '', ''),
(8, 'Felipe', 'Contretas', 7845523, 'Calle monagas', '04248894654', 'FelipeC@gmail.com', 'Masculino', 'General', 'Magister', 'Ciencias Sociales', 'Lara', 'Banco del tesoro', 12312031923812481, '', '', ''),
(10, 'Gengins', 'Khan', 20132456, 'Harker Avenue', '1876453098', 'Khan.gengins@mongol.mn', 'Masculino', 'Medio', 'Doctor', 'Killing', 'Delta Amacuro', 'Mongol read bank', 939458387728, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

DROP TABLE IF EXISTS `secciones`;
CREATE TABLE IF NOT EXISTS `secciones` (
`ID` int(10) NOT NULL,
  `carrera` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `turno` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(7) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`ID`, `carrera`, `turno`, `nombre`) VALUES
(1, 'Sistemas', 'Mañana', '1D04IS'),
(2, 'Sistemas', 'Tarde', '1T03IS'),
(3, 'Electrica', 'Mañana', '1D01IE'),
(4, 'Turismo', 'Noche', '1N4T'),
(5, 'Sistemas', 'Noche', '1N03IS'),
(6, 'Electrica', 'Noche', '1N01IE'),
(7, 'Electrica', 'Noche', '1N02IE'),
(9, 'Electrica', 'Noche', '1N04IE'),
(10, 'Electrica', 'Noche', '1N05IE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
`ID` int(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `password` char(64) NOT NULL,
  `salt` char(16) NOT NULL,
  `cedula` int(10) NOT NULL,
  `nivel` int(1) NOT NULL,
  `cookie` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`, `password`, `salt`, `cedula`, `nivel`, `cookie`) VALUES
(4, 'Miguel', 'Cervantes', 'miguel@cervantes.de', '04169564705', 'Carrera 9', 'e2816d99b3c19ff4546d79092b5765ec21c63ad49c6a50906e8c4c4fea709963', '3d9968c044a83583', 22261129, 1, 897537413);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
 ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
 ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
