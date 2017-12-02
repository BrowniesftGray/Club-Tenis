-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-11-2017 a las 12:53:08
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `club`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competiciones`
--

CREATE TABLE IF NOT EXISTS `competiciones` (
  `idCompeticion` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEvento` varchar(45) DEFAULT NULL,
  `fechaEvento` date DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCompeticion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE IF NOT EXISTS `inscripciones` (
  `idInscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `idJugadorFK` int(11) DEFAULT NULL,
  `idCompeticionFK` int(11) DEFAULT NULL,
  `idTransporte` int(11) DEFAULT NULL,
  `Comentario` varchar(50) NOT NULL,
  PRIMARY KEY (`idInscripcion`),
  KEY `emailJugadorFK_idx` (`idJugadorFK`),
  KEY `idTransporteFK_idx` (`idTransporte`),
  KEY `idCompeticionFK_idx` (`idCompeticionFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE IF NOT EXISTS `jugadores` (
  `idJugador` int(11) NOT NULL AUTO_INCREMENT,
  `nombreJugador` varchar(45) DEFAULT NULL,
  `direccionJugador` varchar(45) DEFAULT NULL,
  `emailJugador` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idJugador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`idJugador`, `nombreJugador`, `direccionJugador`, `emailJugador`) VALUES
(1, 'admin', 'avenida de prueba', 'admin@prueba.com'),
(14, 'dario', 'Avenida Sevilla', 'dario@prueba.com'),
(15, 'dario', 'Avenida Sevilla', 'dario2@prueba.com'),
(16, 'Juanito', 'Avenida Mallorca', 'juan@prueba.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `idNoticias` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `rutaImagen` varchar(45) DEFAULT NULL,
  `fechaPublicacion` date DEFAULT NULL,
  `emailUsuarioFK` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idNoticias`),
  KEY `emailUsuarioFK_idx` (`emailUsuarioFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE IF NOT EXISTS `partidos` (
  `idPartido` int(11) NOT NULL AUTO_INCREMENT,
  `idParticipante1` int(11) DEFAULT NULL,
  `idParticipante2` int(11) DEFAULT NULL,
  `idCompeticionFK` int(11) DEFAULT NULL,
  `Fase` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPartido`),
  KEY `idCompeticionFK_idx` (`idCompeticionFK`),
  KEY `idJugador2FK_idx` (`idParticipante2`),
  KEY `idJugador1FK_idx` (`idParticipante1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE IF NOT EXISTS `resultados` (
  `idResultado` int(11) NOT NULL AUTO_INCREMENT,
  `idPartidoFK` int(11) DEFAULT NULL,
  `idPerdedor` int(11) DEFAULT NULL,
  `idGanador` int(11) DEFAULT NULL,
  `idCompeticionFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`idResultado`),
  KEY `idPartidoFK_idx` (`idPartidoFK`),
  KEY `idGanadorFK_idx` (`idGanador`),
  KEY `idPerdedorFK_idx` (`idPerdedor`),
  KEY `idCompeticionFK3_idx` (`idCompeticionFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE IF NOT EXISTS `transporte` (
  `idTransporte` int(11) NOT NULL AUTO_INCREMENT,
  `idJugadorFK` int(11) DEFAULT NULL,
  `espacioDisponible` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTransporte`),
  KEY `idJugadorFK_idx` (`idJugadorFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `emailUsuario` varchar(45) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `contra` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `tipoPerfil` varchar(15) DEFAULT NULL,
  `idJugadorFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`emailUsuario`),
  KEY `idJugadorFK_idx` (`idJugadorFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`emailUsuario`, `nombre`, `contra`, `direccion`, `telefono`, `tipoPerfil`, `idJugadorFK`) VALUES
('admin@prueba.com', 'admin', 'admin', 'avenida prueba', 95564783, 'Administrador', 1),
('dario2@prueba.com', 'dario', 'dario', 'Avenida Sevilla', 955678565, 'Usuario', 15),
('dario@prueba.com', 'dario', 'dario', 'Avenida Sevilla', 955678565, 'Usuario', 14),
('juan@prueba.com', 'Juanito', 'juanito', 'Avenida Mallorca', 955653525, 'Usuario', 16);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `idCompeticionFK` FOREIGN KEY (`idCompeticionFK`) REFERENCES `competiciones` (`idCompeticion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idJugadorFK3` FOREIGN KEY (`idJugadorFK`) REFERENCES `jugadores` (`idJugador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTransporteFK` FOREIGN KEY (`idTransporte`) REFERENCES `transporte` (`idTransporte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `emailUsuarioFK` FOREIGN KEY (`emailUsuarioFK`) REFERENCES `usuarios` (`emailUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `idCompeticionFK1` FOREIGN KEY (`idCompeticionFK`) REFERENCES `competiciones` (`idCompeticion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idJugador1FK` FOREIGN KEY (`idParticipante1`) REFERENCES `jugadores` (`idJugador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idJugador2FK` FOREIGN KEY (`idParticipante2`) REFERENCES `jugadores` (`idJugador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `idCompeticionFK3` FOREIGN KEY (`idCompeticionFK`) REFERENCES `competiciones` (`idCompeticion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idGanadorFK` FOREIGN KEY (`idGanador`) REFERENCES `jugadores` (`idJugador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idPartidoFK` FOREIGN KEY (`idPartidoFK`) REFERENCES `partidos` (`idPartido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idPerdedorFK` FOREIGN KEY (`idPerdedor`) REFERENCES `jugadores` (`idJugador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD CONSTRAINT `idJugadorFK2` FOREIGN KEY (`idJugadorFK`) REFERENCES `jugadores` (`idJugador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `idJugadorFK1` FOREIGN KEY (`idJugadorFK`) REFERENCES `jugadores` (`idJugador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
