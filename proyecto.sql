-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-01-2016 a las 18:58:11
-- Versión del servidor: 5.5.46-0+deb8u1
-- Versión de PHP: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `secciones`(IN `ID` INT(10), IN `carrera` VARCHAR(20), IN `turno` VARCHAR(20), IN `nombre` VARCHAR(7))
    NO SQL
INSERT INTO bitacora(host, usuario, operacion, modificado, tabla) VALUES (host,nombre,"insertar", NOW(),"secciones")$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE IF NOT EXISTS `bitacora` (
`id` int(11) NOT NULL,
  `operacion` varchar(10) DEFAULT NULL,
  `usuario` varchar(40) DEFAULT NULL,
  `host` varchar(30) NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `tabla` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `l_quejas`
--

CREATE TABLE IF NOT EXISTS `l_quejas` (
`id` int(11) NOT NULL,
  `queja` varchar(100) NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `l_quejas`
--

INSERT INTO `l_quejas` (`id`, `queja`, `nivel`) VALUES
(1, 'Llegar tarde', 1),
(2, 'No entregar notas a tiempo', 2),
(3, 'Molestar compañeros', 2),
(4, 'Mala vestimenta', 1),
(5, 'Insultar autoridades', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE IF NOT EXISTS `profesores` (
`ID` int(100) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `cedula` int(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `condicion` varchar(30) NOT NULL,
  `formacion` varchar(20) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `banco` varchar(100) NOT NULL,
  `nr_cuenta` bigint(40) NOT NULL,
  `materia1` varchar(30) NOT NULL,
  `materia2` varchar(30) NOT NULL,
  `materia3` varchar(30) NOT NULL,
  `seguro_social` int(40) NOT NULL,
  `sueldo` int(255) NOT NULL,
  `quejas` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`ID`, `nombre`, `apellido`, `cedula`, `direccion`, `telefono`, `correo`, `genero`, `condicion`, `formacion`, `especialidad`, `estado`, `banco`, `nr_cuenta`, `materia1`, `materia2`, `materia3`, `seguro_social`, `sueldo`, `quejas`) VALUES
(6, 'Manuel', 'Santeliz', 141455040, 'Calle nueva esparta', '(0416)956-4705', 'Manuel@santeliz.com', 'Masculino', 'General', 'Magister', 'Matematica', 'Amazonas', '', 0, '', '', '', 0, 0, 0),
(7, 'Miguel', 'Suarez', 22261129, 'Carrera 9', '04169564705', 'jozhee@live.com', 'Femenino', 'General', 'Ingeniero', 'Matematico', 'Lara', 'Banesco', 11909129391, '', '', '', 0, 0, 0),
(8, 'Felipe', 'Contretas', 7845523, 'Calle monagas', '04248894654', 'FelipeC@gmail.com', 'Masculino', 'General', 'Magister', 'Ciencias Sociales', 'Lara', 'Banco del tesoro', 12312031923812481, '', '', '', 0, 0, 0),
(10, 'Gengins', 'Khan', 20132456, 'Harker Avenue', '1876453098', 'Khan.gengins@mongol.mn', 'Masculino', 'Medio', 'Doctor', 'Killing', 'Delta Amacuro', 'Mongol read bank', 939458387728, '', '', '', 0, 0, 0),
(11, 'juan', 'querales', 25137071, 'calle 51 entre carrera 13 y 13a', '04245734102', 'juancarlos15_2@hotmail.com', 'Masculino', 'Tiempo com', 'Ingeniero', 'matematico', 'Lara', 'Mercantil', 120312893123, '', '', '', 0, 0, 0),
(12, 'Marco', 'Aurelio', 30029303, 'Calle roma', '04269994034', 'Aurelio@rome.odt', 'Masculino', 'Tiempo completo', 'Licenciado', 'Magister', '', 'Banco de Venezuela', 11909129391, '', '', '', 0, 0, 0),
(13, 'Manuel', 'Mercado', 30029333, 'Calle roma', '04269994034', 'asdasdasdasd@asdasd.ssx', 'Masculino', 'Tiempo completo', 'Ingeniero', 'Ingeniero', 'Merida', 'Mercantil', 12312312, '', '', '', 12312, 5404, 0),
(14, 'Felipe', 'Antonio', 40300430, 'Roma', '30300430', 'FelipeC@gmail.com', 'Masculino', 'Tiempo completo', 'Licenciado', 'Licenciado', 'Vargas', 'Banco de Venezuela', 11909129391, '', '', '', 12312, 10000, 0),
(15, 'Ludwing', 'Beethoven', 8594403, 'Venice', '04269994021', 'beethoven@fth.de', 'Masculino', 'Pago por hora', 'Doctor', 'Magister', 'Bolivar', 'Banco de Venezuela', 11909129391293, '', '', '', 12312, 10000, 0),
(16, 'Cristobal', 'Colon', 30029301, 'calle 51 entre carrera 13 y 13a', '04245734102', 'jozhee@live.com', 'Masculino', 'Tiempo completo', 'Ingeniero', 'Ingeniero', 'Carabobo', 'Banco de Venezuela', 11909129391293, '', '', '', 12312, 10000, 0),
(17, 'Simon', 'Bolivar', 20132456, 'Panteon Nacional', '04269994034', 'Simon@lbt.cc', 'Masculino', 'Tiempo completo', 'Licenciado', 'Ingeniero', 'Dependencias Federales', 'Banco de Venezuela', 0, '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quejas`
--

CREATE TABLE IF NOT EXISTS `quejas` (
`id` int(100) NOT NULL,
  `cedula` int(10) NOT NULL,
  `quejas` varchar(200) NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `quejas`
--

INSERT INTO `quejas` (`id`, `cedula`, `quejas`, `nivel`) VALUES
(1, 141455040, 'Llega tarde', 1),
(2, 141455040, 'Llegar tarde', 1),
(3, 141455040, 'Llegar tarde', 1),
(4, 30029303, 'Mala vestimenta', 1),
(5, 30029303, 'Insultar autoridades', 4),
(6, 30029301, 'Insultar autoridades', 4),
(7, 141455040, 'Llegar tarde', 1),
(8, 141455040, 'No entregar notas a tiempo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE IF NOT EXISTS `secciones` (
`ID` int(10) NOT NULL,
  `carrera` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `turno` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(7) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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

CREATE TABLE IF NOT EXISTS `usuarios` (
`ID` int(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(28) NOT NULL,
  `cedula` int(10) NOT NULL,
  `nivel` int(1) NOT NULL,
  `cookie` int(10) NOT NULL,
  `logueado` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`, `password`, `salt`, `cedula`, `nivel`, `cookie`, `logueado`) VALUES
(10, 'MIGUEL', 'CERVANTES', 'MIGUEL@CERVANTES.DE', '0416000000', 'CALLE LARA', 'a3fddad261a4736063fb05a9d7ef7e5955bfae15b0d4fa0a30a53f5849fc438ad7d52f3dc6490c07e53ff97533395b27b5134d70a8c96d208dfa60bdc89180f4', 'Zg6nxtCu3qSysb/RXhobj9wJrig.', 204449039, 1, 807989883, 'NO'),
(11, 'JOSE', 'SUAREZ', 'JOZHEE@LIVE.COM', '04245559340', 'CALLE MONAGAS', '39f18d99a683ae05cf9883e7e7b0d4b98661a7838a10fe96900ee81f05122f36d032c3536024d7f63b22d65e8914df7351dde446bc1f776e656c203dc5400aae', 'EDg77wmsj2rQVZP5gWVpY2cPiUM.', 22261129, 1, 705771244, 'SI'),
(12, 'CARLOS', 'GUTIERREZ', 'CARLOS@CORREO.COM', '04245559340', 'CALLE MONAGAS', '66150d1e40fa9a0cd48b0d8b0d720227ad972b7e681c6ae056c1dfa02b0c4adbf653c9a17a8780cdaa688f97461be590cecb06143ba40af320b37356da37cc4d', 'QDZWNgEv4/U14fmyFt/iUTPf1LE.', 6842091, 1, 548863952, 'NO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `l_quejas`
--
ALTER TABLE `l_quejas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
 ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `quejas`
--
ALTER TABLE `quejas`
 ADD UNIQUE KEY `id` (`id`);

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
-- AUTO_INCREMENT de la tabla `l_quejas`
--
ALTER TABLE `l_quejas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `quejas`
--
ALTER TABLE `quejas`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
