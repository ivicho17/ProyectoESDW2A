-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2024 a las 12:17:55
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto1ev`
--
CREATE DATABASE IF NOT EXISTS `proyecto2ev` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proyecto2ev`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--
CREATE OR REPLACE TABLE `usuarios` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `teléfono` int(10),
  `biografia` varchar(500),
  `cumpleaños` varchar(10),
  `localidad` varchar(100),
  `ruta_pfp` varchar(100) DEFAULT 'pfps/default.png',
  `verificado` BOOLEAN DEFAULT 0,
  `cod_verificacion` varchar(8) UNIQUE,
  `amigos` varchar(5000) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `contraseña`, `biografia`, `verificado`, `ruta_pfp`, `amigos`) VALUES
(1, 'Isidoro', 'Gangrenado Poyato', 'isidorogangrenado@gmail.com', '1234', 'Actor', 1, '1.jpg', '3?4?5'),
(2, 'Marta', 'Pincho Moruno', 'martapincho@gmail.com', '1234', 'Politóloga', 1, '2.jpg', '5'),
(3, 'Dolores', 'Miasma Musgo', 'doloresmiasma@gmail.com', '1234', 'Enfermera especializada en enfermedades crónicas.', 1  , '3.jpg', '1'),
(4, 'Eva', 'Salmón Vejestorio', 'evasalmon@gmail.com', '1234', 'Antropóloga. Vivo culturas y plasmo aquí su magia. Especializada en tribus africanas con años de experiencia en trabajo de campo. Autora de "¿Son monos o negros? Una guía detallada para distinguirlos" ', 1, '4.jpg', '1'),
(5, 'Pinocho', 'Cromosoma Fútbol', 'pinochocromosoma@gmail.com', '1234', 'Bombero', 1, '5.jpg', '2?1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--
CREATE OR REPLACE TABLE `posts` (
  `num` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `título` varchar(50),
  `mensaje` varchar(500) NOT NULL,
  `etiquetas` varchar(150),
  `autor` int(11) DEFAULT NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(120) NOT NULL,
  `adulto` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE OR REPLACE TABLE `comentarios` (
  `num` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(500) NOT NULL,
  `autor` int(11) DEFAULT NULL,
  `post` int(11) DEFAULT NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
--

INSERT INTO `posts` (`num`, `título`, `mensaje`, `etiquetas`, `autor`, `ruta`, `adulto`) VALUES
(1, 'Disfrutando de la playita', 'Aquí estamos, en el Caribe disfrutando de unos mojitos con el sol acaricianos gentilmente', 'playa, cangrejos, vacaciones', 3, 'default.webp', 0),
(2, 'TRIBU SIRU', 'La tribu Siru, en Etiopía, se caracteriza por las dilataciones y las escarificaciones que usan como expresión artística y cultural.', 'antropología, nudismo', 4, 'TribuSuri.jpg', 1);

INSERT INTO `comentarios` (`num`, `mensaje`, `post`, `autor`) VALUES
(1, 'ALAAAAA vaya bubis tienes guapaaaaa', 1, 1  ),
(2, 'PERO Y COMO NO LES PICA TODO CON LAS PLANTAS Y LOS MOSQUITOS, q locura ir desnudo', 2, 2  );

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `usuarios`
  -- ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `tickets`
--
-- ALTER TABLE `tickets`
--   ADD PRIMARY KEY (`num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
