-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2015 at 12:07 
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `proyecto`
--
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proyecto`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `secciones`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `secciones`(IN `ID` INT(10), IN `carrera` VARCHAR(20), IN `turno` VARCHAR(20), IN `nombre` VARCHAR(7))
    NO SQL
INSERT INTO bitacora(host, usuario, operacion, modificado, tabla) VALUES (host,nombre,"insertar", NOW(),"secciones")$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE IF NOT EXISTS `bitacora` (
  `id` int(11) NOT NULL,
  `operacion` varchar(10) DEFAULT NULL,
  `usuario` varchar(40) DEFAULT NULL,
  `host` varchar(30) NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `tabla` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bitacora`
--

INSERT INTO `bitacora` (`id`, `operacion`, `usuario`, `host`, `modificado`, `tabla`) VALUES
(1, 'eliminar', NULL, 'root@localhost', '2015-04-02 13:34:47', 'secciones'),
(2, 'insertar', '1D03IS', '', '2015-04-02 14:16:56', 'secciones'),
(3, 'insertar', '1N10IE', '', '2015-04-02 14:23:55', 'secciones');

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `carrera` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuracion`
--

INSERT INTO `configuracion` (`carrera`) VALUES
('Sistemas'),
('Electrica');

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
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
-- Table structure for table `l_quejas`
--

DROP TABLE IF EXISTS `l_quejas`;
CREATE TABLE IF NOT EXISTS `l_quejas` (
  `id` int(11) NOT NULL,
  `queja` varchar(100) NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `l_quejas`
--

INSERT INTO `l_quejas` (`id`, `queja`, `nivel`) VALUES
(1, 'Llegar tarde', 1),
(2, 'No entregar notas a tiempo', 2),
(3, 'Molestar compañeros', 2),
(4, 'Mala vestimenta', 1),
(5, 'Insultar autoridades', 4);

-- --------------------------------------------------------

--
-- Table structure for table `profesores`
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
-- Dumping data for table `profesores`
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
-- Table structure for table `quejas`
--

DROP TABLE IF EXISTS `quejas`;
CREATE TABLE IF NOT EXISTS `quejas` (
  `id` int(100) NOT NULL,
  `cedula` int(10) NOT NULL,
  `quejas` varchar(200) NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quejas`
--

INSERT INTO `quejas` (`id`, `cedula`, `quejas`, `nivel`) VALUES
(1, 141455040, 'Llega tarde', 1),
(2, 141455040, 'Llegar tarde', 1),
(3, 141455040, 'Llegar tarde', 1),
(4, 30029303, 'Mala vestimenta', 1),
(5, 30029303, 'Insultar autoridades', 4),
(6, 30029301, 'Insultar autoridades', 4);

-- --------------------------------------------------------

--
-- Table structure for table `secciones`
--

DROP TABLE IF EXISTS `secciones`;
CREATE TABLE IF NOT EXISTS `secciones` (
  `ID` int(10) NOT NULL,
  `carrera` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `turno` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(7) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `secciones`
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
-- Table structure for table `usuarios`
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`, `password`, `salt`, `cedula`, `nivel`, `cookie`) VALUES
(4, 'Miguel', 'Cervantes', 'miguel@cervantes.de', '04169564705', 'Carrera 9', 'e2816d99b3c19ff4546d79092b5765ec21c63ad49c6a50906e8c4c4fea709963', '3d9968c044a83583', 22261129, 1, 655568098);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_quejas`
--
ALTER TABLE `l_quejas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `quejas`
--
ALTER TABLE `quejas`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `l_quejas`
--
ALTER TABLE `l_quejas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `profesores`
--
ALTER TABLE `profesores`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `quejas`
--
ALTER TABLE `quejas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `secciones`
--
ALTER TABLE `secciones`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
