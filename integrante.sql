-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2016 a las 00:41:45
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrante`
--

CREATE TABLE `integrante` (
  `DOCUMENTO` int(12) NOT NULL,
  `NOMBRES` varchar(25) CHARACTER SET utf8 NOT NULL,
  `PRIMER_APELLIDO` varchar(15) CHARACTER SET utf8 NOT NULL,
  `SEGUNDO_APELLIDO` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `GENERO` char(2) CHARACTER SET utf8 DEFAULT NULL,
  `FECHA_NACIMIENTO` date NOT NULL,
  `DIRECCION` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `CELULAR` bigint(200) DEFAULT NULL,
  `CORREO` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `ACOLITO` tinyint(1) DEFAULT NULL,
  `COORDINADOR` tinyint(1) DEFAULT NULL,
  `IMAGEN` longtext CHARACTER SET utf8,
  `FECHA_INGRESO` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `integrante`
--

INSERT INTO `integrante` (`DOCUMENTO`, `NOMBRES`, `PRIMER_APELLIDO`, `SEGUNDO_APELLIDO`, `GENERO`, `FECHA_NACIMIENTO`, `DIRECCION`, `CELULAR`, `CORREO`, `ACOLITO`, `COORDINADOR`, `IMAGEN`, `FECHA_INGRESO`) VALUES
(1, 'Andres Leonardo ', 'Blandon', '', 'M', '1999-05-21', 'SMZ 6 MZ 12 CASA 2 N/CASTILLA', 3132890052, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(2, 'Anggie Natalia ', 'Amortegui', '', 'F', '2000-05-09', 'MZ L CASA 15 LA CIMA', 3005266552, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(3, 'Angie Tatiana ', 'Gonzalez', '', 'F', '2001-07-06', 'MZ 33 CASA 7 PROTECHO B', 3124333821, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(4, 'Cesar Augusto', '', '', 'M', '2000-07-03', 'SMZ 11 MZ 7 CASA 3 N/CASTILLA', 0, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(5, 'Cesar Luis  ', 'Ortiz', 'Montoya', 'M', '2001-01-10', 'SMZ 4 MZ 1 CASA 7 N/CASTILLA', 3134322973, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(6, 'Daniel ', 'Castro', 'PiÃ±eros', 'M', '2000-02-03', 'SMZ 6 MZ 21 CASA 8 N/CASTILLA', 3183650540, '', 0, 0, '', '2016-04-26 17:41:30'),
(7, 'Daniela  ', 'Yara', 'CastaÃ±o', 'F', '2006-01-10', 'MZ L CASA 28 LA CIMA 2', 3204872253, '', 0, 0, '', '2016-04-26 17:40:51'),
(8, 'Edwin Camilo ', 'Mahecha', '', 'M', '1999-09-30', 'SMZ 4 MZ 6 CASA 5 M/CASTILLA', 3214501143, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(9, 'Elian Santiago ', 'CaÃ±as', '', 'M', '2001-05-31', 'MZ B CASA 5 VASCONIA RESERVADA', 3124755243, '/eliansantiago.canas', 1, 0, '', '2016-04-26 17:40:19'),
(10, 'Erickson Jimmy  ', 'Fernandez', 'Navarro', 'M', '1999-03-15', '', 3184373536, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(11, 'Fredy Estiven ', 'Amaya', '', 'M', '1998-10-31', 'SMZ 4 MZ 24 CASA 26 N/CASTILLA', 3115575288, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(12, 'Gabriela  ', 'Andrade', 'Trujullo', 'F', '2001-12-31', 'SMZ 3 MZ 6 CASA 10 N/CASTILLA', 3178703915, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(13, 'Hugo Ferney  ', 'Otavo', 'Varon', 'M', '1998-08-31', 'MZ 33 CASA 21 PROTECHO B', 3217518570, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(14, 'Javier  ', 'Tellez', 'Ariza', 'M', '1997-03-02', 'SMZ 10 MZ 7 CASA 10 N/CASTILLA', 3133600136, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(15, 'Jeimy Tatiana ', 'Estepa', 'Lopez', 'F', '2002-03-13', 'SMZ 25 MZ 27 CASA 7 N/CASTILLA', 3156151421, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(16, 'Jesus David ', 'Conde', '', 'M', '1999-02-07', 'MZ 10 CASA 15 PROTECHO B', 3115806121, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(17, 'Jhoana  ', 'Yara', 'CastaÃ±o', 'F', '2003-06-01', 'MZ 3 CASA 28 LA CIMA', 3005196567, '/yoana.yaracastano.7', 0, 0, '', '2016-04-26 17:39:44'),
(18, 'Jhorjan Stiven ', 'Gonzalez', 'Romero', 'M', '1998-03-07', 'MZ 33 CASA 7 PROTECHO B', 3124333821, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(19, 'Johan Sebastian  ', 'Gomez', 'Lara', 'M', '1998-03-05', 'MZ L CASA 7 PORTALES DEL NORTE', 3173036408, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(20, 'Jose Luis  ', 'Andrade', '', 'M', '1999-11-24', 'MZ 27 CASA 8 PROTECHO B', 3142162424, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(21, 'Juan Daniel ', 'Guzman', '', 'M', '1999-04-07', 'MZ 34 CASA 4 PROTECHO B', 3005266552, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(22, 'Julian Esteban ', 'Cano', '', 'M', '2002-04-30', 'SMZ 4 MZ 2 CASA 7 N/CASTILLA', 3144136750, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(23, 'Katerine  ', 'Salazar', 'Endo', 'F', '1999-12-29', 'CASA 10 SAN GELATO', 3223835254, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(24, 'Kervlyn Alexis ', 'Guzman', '', 'M', '2001-12-14', '', 3174265468, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(25, 'Laura Daniela ', 'BergaÃ±o', 'Moreno', 'F', '1998-12-26', 'MZ B CASA 3 SAN LUCAS 2', 3188934855, 'profile.php?id=100006432927823', 0, 0, '', '2016-04-26 17:39:00'),
(26, 'Laura Valentina  ', 'Vargas', '', 'F', '2001-11-17', 'SMZ 7 MZ 5 CASA 8 N/CASTILLA', 3154066759, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(27, 'Lilian Yineth  ', 'Reina', '', 'F', '1999-04-08', 'SMZ 11 MZ 3 CASA 10 NUEVA CASTILLA', 3138718654, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(28, 'Lizeth ', 'Gonzalez', '', 'F', '2001-10-26', 'MZ 19 CASA 18 PROTECHO B', 3127819071, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(29, 'Maicol Steven ', 'Galicia', '', 'M', '2003-04-22', 'MZ 34 CASA 6 PROTECHO B', 3114989979, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(30, 'Maicol Steven  ', 'Guzman', '', 'M', '2003-04-30', 'MZ 34 CASA 4 PROTECHO B', 3204024355, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(31, 'Maria Camila ', 'Tangarife', '', 'F', '2002-03-31', '', 3124507085, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(32, 'Maria Paula ', 'Barrios', '', 'F', '0000-00-00', '', 3003218696, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(33, 'Mariam Paola ', 'Betancourt', '', 'F', '2002-08-11', 'MZ 31 CASA 9 PROTECHO B', 3008075178, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(34, 'Mateo  ', 'Cortes', 'Perez', 'M', '2000-10-31', 'SMZ 4 MZ 5 CASA 6 N/CASTILLA', 2672517, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(35, 'Monica Alejandra ', 'Palacios', '', 'F', '2003-06-26', 'SMZ 26MZ 8 CASA 6 N/CASTILLA', 3015412925, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(36, 'Natalia  ', 'Perez', 'Miranda', 'F', '2000-12-24', '', 3214735595, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(37, 'Nicol Dahiana  ', 'Mesa', 'Rengifo', 'F', '2001-11-28', 'SMZ4 MZ 9 CASA 2 N/CASTILLA', 3222193580, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(38, 'Paula  Andrea', 'CastaÃ±eda', '', 'F', '2000-05-05', 'MZ 24 CASA 6 PROTECHO B', 3106698499, '/profile.php?id=10000071326821', 1, 0, '', '2016-04-26 17:38:35'),
(39, 'Sandra Milena  ', 'Ceballos', 'Martinez', 'F', '1998-04-01', 'MZ 31 CASA 9 PROTECHO B', 3112925984, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(40, 'Shirley Dayaba ', 'Cruz', '', 'F', '2004-03-26', 'SMZ 4 MZ 5 CASA 4 N/CASTILLA', 2673848, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(41, 'Tatiana ', 'Mosquera', '', 'F', '2002-07-26', 'MZ B CASA 21 BRISAS DE VASCONIA', 3124265295, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(42, 'Valentina  ', 'Sandoval', 'Sosa', 'F', '2002-01-07', 'MZ 26 CASA 20 PROTECHO B', 3213713308, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(43, 'Viviana Mayerly', 'Yara', 'CastaÃ±o', 'F', '2000-07-16', 'MZ L CASA 28 LA CIMA 3', 3112013780, '/yerlyviviana.yara', 0, 0, '', '2016-04-26 17:36:48'),
(44, 'Yuliana  ', 'Mosquera', 'Varon', 'F', '2001-07-26', 'MZ 24 CASA 3 PROTECHO B', 3108048927, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(45, 'Jhon Freddy ', 'Gonzalez', 'Ducuara', 'M', '0000-00-00', '', 0, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00'),
(46, 'Catalina ', 'Gonzalez', 'Ducuara', 'F', '0000-00-00', '', 0, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `integrante`
--
ALTER TABLE `integrante`
  ADD PRIMARY KEY (`DOCUMENTO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `integrante`
--
ALTER TABLE `integrante`
  MODIFY `DOCUMENTO` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
