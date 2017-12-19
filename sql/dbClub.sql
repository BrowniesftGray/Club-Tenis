-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2017 a las 11:54:22
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `club`
--
DROP DATABASE IF EXISTS `club`;
CREATE DATABASE IF NOT EXISTS `club` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `club`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competiciones`
--

CREATE TABLE `competiciones` (
  `idCompeticion` int(11) NOT NULL,
  `nombreEvento` varchar(45) DEFAULT NULL,
  `fechaEvento` date DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `competiciones`
--

INSERT INTO `competiciones` (`idCompeticion`, `nombreEvento`, `fechaEvento`, `descripcion`) VALUES
(7, 'Torneo de prueba', '2017-12-06', 'Descripción de prueba de torneo'),
(13, 'Torneo Amateur', '2017-12-19', 'Torneo Amateur del club deportivo de tenis Or');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `idInscripcion` int(11) NOT NULL,
  `idJugadorFK` int(11) DEFAULT NULL,
  `idCompeticionFK` int(11) DEFAULT NULL,
  `idTransporteFK` int(11) DEFAULT NULL,
  `Comentario` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`idInscripcion`, `idJugadorFK`, `idCompeticionFK`, `idTransporteFK`, `Comentario`) VALUES
(9, 1, 7, 9, 'Comentario'),
(11, 15, 7, 9, 'Comentartio de prueba contrincante'),
(12, 1, 13, 11, 'Llevo el coche'),
(13, 14, 13, 11, 'Nos encontramos allí'),
(14, 30, 13, 11, 'Me voy con Darío y Paco'),
(15, 15, 13, 11, 'Me apunto al último sitio'),
(16, 16, 13, 12, 'Si alguien quiere venir adelante'),
(17, 31, 13, 12, 'Me voy con Juanito'),
(18, 32, 13, 12, 'Me apunto el último sitio del coche'),
(19, 33, 13, 13, 'Yo iré por mi cuenta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `idJugador` int(11) NOT NULL,
  `nombreJugador` varchar(45) DEFAULT NULL,
  `direccionJugador` varchar(45) DEFAULT NULL,
  `emailJugador` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`idJugador`, `nombreJugador`, `direccionJugador`, `emailJugador`) VALUES
(1, 'Administrador', 'avenida de prueba', 'admin@prueba.com'),
(14, 'dario', 'Avenida Sevilla', 'dario@prueba.com'),
(15, 'Mario', 'Avenida Sevilla', 'mario@prueba.com'),
(16, 'Juanito', 'Avenida Mallorca', 'juan@prueba.com'),
(19, 'Admin2', 'Avenida Admin', 'admin2@prueba.com'),
(30, 'Luis Miguel', 'Avenida de Canarias', 'luismiguel@gmail.com'),
(31, 'Carlos Rodriguez', 'Avenida palomares', 'carlos@gmail.com'),
(32, 'Felipe Trinidad', 'Pinomontano, avenida del pajar', 'felipe@gmail.com'),
(33, 'Ana María', 'Los palacios, calle Madrid, 43', 'ana@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticias` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `rutaImagen` varchar(45) DEFAULT NULL,
  `fechaPublicacion` date DEFAULT NULL,
  `emailUsuarioFK` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticias`, `titulo`, `descripcion`, `rutaImagen`, `fechaPublicacion`, `emailUsuarioFK`) VALUES
(1, 'Feliz Navidad', 'Felices fiestas tenistas', 'imagenes/FelizNavidad_portada.jpg', '2017-12-02', 'admin@prueba.com'),
(2, 'Wimbledon', 'Torneo de Wimbledon', 'imagenes/Wimbledon4_portada.jpg', '2017-12-09', 'admin@prueba.com'),
(3, 'Bollos', 'Los bollos se han convertido en una de las principales dietas de los tenistas amateur, no seas como ellos.', 'imagenes/Bollos7_portada.jpg', '2017-12-09', 'admin@prueba.com'),
(4, 'Roland Garros', 'El torneo de Roland Garros es uno de los cuatro grandes torneos del mundo del tenis.', 'imagenes/RolandGarros4_portada.jpg', '2017-12-09', 'admin@prueba.com'),
(5, 'Torneo Amateur', 'El 20 de diciembre comenzará el torneo amateur del club deportivo de tenis Oromana, aseguraros de uniros antes de ese día para competir, ¡suerte!', 'imagenes/TorneoAmateur5_portada.jpg', '2017-12-09', 'admin@prueba.com'),
(6, 'Rafa Nadal se lesiona', 'El jugador Español Rafa Nadal se ha lesionado de gravedad en la rodilla izquierda, esperamos recibir pronto noticias con respecto al tiempo que pasará en ese estado.', 'imagenes/RafaNadalselesiona6_portada.jpg', '2017-12-09', 'admin@prueba.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `idResultado` int(11) NOT NULL,
  `idPerdedor` int(11) DEFAULT NULL,
  `idGanador` int(11) DEFAULT NULL,
  `idCompeticionFK` int(11) DEFAULT NULL,
  `Fase` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`idResultado`, `idPerdedor`, `idGanador`, `idCompeticionFK`, `Fase`) VALUES
(1, 15, 1, 7, '1'),
(3, 19, 1, 7, '2'),
(4, 14, 19, 7, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `idTransporte` int(11) NOT NULL,
  `idJugadorFK` int(11) DEFAULT NULL,
  `espacioDisponible` int(11) DEFAULT NULL,
  `idCompeticionFK` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`idTransporte`, `idJugadorFK`, `espacioDisponible`, `idCompeticionFK`) VALUES
(9, 1, 0, 7),
(11, 1, 0, 13),
(12, 16, 0, 13),
(13, 33, 0, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `emailUsuario` varchar(45) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `contra` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `tipoPerfil` varchar(15) DEFAULT NULL,
  `idJugadorFK` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`emailUsuario`, `nombre`, `contra`, `direccion`, `telefono`, `tipoPerfil`, `idJugadorFK`) VALUES
('admin2@prueba.com', 'Admin2', 'admin2', 'Avenida Admin', 955678459, 'Administrador', 19),
('admin@prueba.com', 'Administrador', 'admin', 'Dos Hermanas, Avenida de Sevilla, 50', 955647834, 'Administrador', 1),
('mario@prueba.com', 'Mario', 'mario', 'Avenida Sevilla', 955678565, 'Usuario', 15),
('dario@prueba.com', 'Dario', 'dario', 'Avenida Sevilla', 955678565, 'Usuario', 14),
('juan@prueba.com', 'Juanito', 'juanito', 'Avenida Mallorca', 955653525, 'Usuario', 16),
('luismiguel@gmail.com', 'Luis Miguel', 'luismiguel', 'Avenida de Canarias', 955678765, 'Usuario', 30),
('carlos@gmail.com', 'Carlos Rodriguez', 'carlos', 'Avenida palomares', 955648565, 'Usuario', 31),
('felipe@gmail.com', 'Felipe Trinidad', 'felipe', 'Pinomontano, avenida del pajar', 955847595, 'Usuario', 32),
('ana@gmail.com', 'Ana María', 'anamaria', 'Los palacios, calle Madrid, 43', 955786541, 'Usuario', 33);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `competiciones`
--
ALTER TABLE `competiciones`
  ADD PRIMARY KEY (`idCompeticion`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`idInscripcion`),
  ADD KEY `emailJugadorFK_idx` (`idJugadorFK`),
  ADD KEY `idTransporteFK_idx` (`idTransporteFK`),
  ADD KEY `idCompeticionFK_idx` (`idCompeticionFK`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`idJugador`),
  ADD UNIQUE KEY `nombreJugador` (`nombreJugador`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticias`),
  ADD KEY `emailUsuarioFK_idx` (`emailUsuarioFK`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`idResultado`),
  ADD KEY `idGanadorFK_idx` (`idGanador`),
  ADD KEY `idPerdedorFK_idx` (`idPerdedor`),
  ADD KEY `idCompeticionFK3_idx` (`idCompeticionFK`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`idTransporte`),
  ADD KEY `idJugadorFK_idx` (`idJugadorFK`),
  ADD KEY `idCompeticionTransporte_idx` (`idCompeticionFK`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`emailUsuario`),
  ADD KEY `idJugadorFK_idx` (`idJugadorFK`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `competiciones`
--
ALTER TABLE `competiciones`
  MODIFY `idCompeticion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `idInscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `idJugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `idResultado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `transporte`
--
ALTER TABLE `transporte`
  MODIFY `idTransporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
