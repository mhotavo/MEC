-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2016 a las 22:52:34
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
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE `familiar` (
  `DOCUMENTO` int(11) NOT NULL,
  `IDENTIFICACION_INTEGRANTE` int(11) NOT NULL,
  `NOMBRES` varchar(50) NOT NULL,
  `PRIMER_APELLIDO` int(25) NOT NULL,
  `SEGUNDO_APELLIDO` varchar(25) DEFAULT NULL,
  `PARENTESCO` varchar(20) NOT NULL,
  `CELULAR` int(30) NOT NULL,
  `DIRECCION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrante`
--

CREATE TABLE `integrante` (
  `DOCUMENTO` int(12) NOT NULL,
  `NOMBRES` varchar(25) NOT NULL,
  `PRIMER_APELLIDO` varchar(15) NOT NULL,
  `SEGUNDO_APELLIDO` varchar(15) DEFAULT NULL,
  `FECHA_NACIMIENTO` date NOT NULL,
  `DIRECCION` varchar(50) DEFAULT NULL,
  `CELULAR` bigint(200) DEFAULT NULL,
  `CORREO` varchar(30) DEFAULT NULL,
  `ACOLITO` tinyint(1) DEFAULT NULL,
  `COORDINADOR` tinyint(1) DEFAULT NULL,
  `IMAGEN` longtext,
  `FECHA_INGRESO` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `integrante`
--

INSERT INTO `integrante` (`DOCUMENTO`, `NOMBRES`, `PRIMER_APELLIDO`, `SEGUNDO_APELLIDO`, `FECHA_NACIMIENTO`, `DIRECCION`, `CELULAR`, `CORREO`, `ACOLITO`, `COORDINADOR`, `IMAGEN`, `FECHA_INGRESO`) VALUES
(1, 'Milton', 'Hernando', 'Otavo Varon', '1995-11-04', 'MZ 33 CASA 21 PROTECHO B a', 3112002546, 'MILTON.OTAVO@GMAIL.COM', 1, 1, '1-3254avatar.jpg', '2016-04-22 11:26:23'),
(2, 'Hugo', 'Ferney', 'Otavo', '2016-04-13', 'MZ 33 CASA 21 PROTECHO B', 3112002546, '', 0, 0, '2-3303avatar2.jpg', '2016-04-21 11:33:03'),
(4, 'Nicol Dahiana', 'Mesa', 'Rengifo', '2001-11-28', 'SP MZ 1 MZ 2 CASA 3 NUEVA CASTILLA', 3222195580, 'nicol.mesa@gmail.com', 1, 0, '4-010916215_10203344202754048_8237009553896869607_n.jpg', '2016-04-21 15:01:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` bigint(255) NOT NULL,
  `DOC` int(20) NOT NULL,
  `USER` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PASS` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ROL` int(1) NOT NULL DEFAULT '0',
  `NOMBRES` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `P_APELLIDO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `S_APELLIDO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `KEYPASS` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NEWPASS` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ULTIMA_CONEXION` int(32) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `DOC`, `USER`, `PASS`, `EMAIL`, `ROL`, `NOMBRES`, `P_APELLIDO`, `S_APELLIDO`, `KEYPASS`, `NEWPASS`, `ULTIMA_CONEXION`) VALUES
(1, 1110540682, 'admin', 'FE5C3EE9', 'milton.otavo@gmail.com', 2, 'MILTON', 'OTAVO', 'VARON', '573e5feb61b20121114c322b050f0dfd', '9699F73A', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`DOCUMENTO`),
  ADD KEY `FK_FAMILIAR` (`IDENTIFICACION_INTEGRANTE`),
  ADD KEY `IDENTIFICACION_INTEGRANTE` (`IDENTIFICACION_INTEGRANTE`);

--
-- Indices de la tabla `integrante`
--
ALTER TABLE `integrante`
  ADD PRIMARY KEY (`DOCUMENTO`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `integrante`
--
ALTER TABLE `integrante`
  MODIFY `DOCUMENTO` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD CONSTRAINT `FK_FAMILIAR` FOREIGN KEY (`IDENTIFICACION_INTEGRANTE`) REFERENCES `integrante` (`DOCUMENTO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
