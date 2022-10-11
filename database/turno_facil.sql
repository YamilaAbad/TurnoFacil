-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2022 a las 22:00:00
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `turno_facil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `esp_id` int(11) NOT NULL,
  `esp_nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`esp_id`, `esp_nombre`) VALUES
(1, 'Cardiologia'),
(2, 'Endocrinologia'),
(3, 'hemoterapia'),
(4, 'Neumologia'),
(5, 'Neurologia'),
(6, 'Nutricion'),
(7, 'Pediatria'),
(8, 'Oncologia'),
(9, 'Psiquiatria'),
(10, 'Reumatologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `grupo_id` int(11) NOT NULL,
  `gruno_nro` int(11) NOT NULL,
  `grupo_id_secretaria` int(11) NOT NULL,
  `grupo_id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`grupo_id`, `gruno_nro`, `grupo_id_secretaria`, `grupo_id_medico`) VALUES
(1, 1, 4, 1),
(2, 1, 4, 2),
(3, 1, 4, 3),
(4, 1, 4, 5),
(5, 2, 7, 6),
(6, 2, 7, 8),
(7, 2, 7, 10),
(8, 2, 7, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_os`
--

CREATE TABLE `medico_os` (
  `mos_id` int(11) NOT NULL,
  `mos_id_medico` int(11) NOT NULL,
  `mos_id_obrasocial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medico_os`
--

INSERT INTO `medico_os` (`mos_id`, `mos_id_medico`, `mos_id_obrasocial`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 5, 4),
(5, 6, 3),
(6, 2, 5),
(7, 11, 1),
(8, 11, 7),
(9, 10, 10),
(10, 9, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_social`
--

CREATE TABLE `obra_social` (
  `os_id` int(11) NOT NULL,
  `os_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obra_social`
--

INSERT INTO `obra_social` (`os_id`, `os_nombre`) VALUES
(1, 'Avalian'),
(2, 'FEMEBA'),
(3, 'Galeno'),
(4, 'IOMA'),
(5, 'OSDE'),
(6, 'Osmedica'),
(7, 'OSPIN'),
(8, 'OSPRERA'),
(9, 'PAMI'),
(10, 'Sancor Salud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `paciente_id` int(11) NOT NULL,
  `paciente_dni` int(11) NOT NULL,
  `paciente_nombre` varchar(60) NOT NULL,
  `paciente_apellido` varchar(60) NOT NULL,
  `paciente_domicilio` varchar(100) NOT NULL,
  `paciente_telefono` varchar(20) NOT NULL,
  `paciente_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`paciente_id`, `paciente_dni`, `paciente_nombre`, `paciente_apellido`, `paciente_domicilio`, `paciente_telefono`, `paciente_email`) VALUES
(1, 23456789, 'Pedro', 'Frapiccini', 'Berutti 635', '423332', 'pfrappi@gmail.com'),
(2, 12435678, 'Ana', 'Aldaz', 'Betolaza 48', '433225', 'ani@gmail.com'),
(3, 45678983, 'Saul', 'Naveyra', 'Berutti 624', '425709', 'saul@gmail.com'),
(4, 24567345, 'Roberto', 'Colantonio', 'Bradzen 87', '422827', 'colan@gmail.com'),
(5, 57689543, 'Magdalena', 'Gervasi', 'Brandsen 134', '423219', 'magda@gmail.com'),
(6, 34567876, 'Norma', 'Errea', 'Bolivia 925', '425939', 'norma@gmail.com'),
(7, 12345654, 'Maria', 'Lopez', 'Castelli 48', '431926', 'maria@gmail.com'),
(8, 14321234, 'Raul', 'Poloniato', 'Cangallo 125', '425465', 'raulsito@gmail.com'),
(9, 11098273, 'Teresa', 'Mancini', 'Canada 35', '428178', 'tere@gmail.com'),
(10, 5678432, 'Hector', 'Garcia', 'Burchardo 40', '430908', 'hector@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_os`
--

CREATE TABLE `paciente_os` (
  `pos_id` int(11) NOT NULL,
  `pos_id_obrasocial` int(11) NOT NULL,
  `pos_id_paciente` int(11) NOT NULL,
  `pos_n_afiliado` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente_os`
--

INSERT INTO `paciente_os` (`pos_id`, `pos_id_obrasocial`, `pos_id_paciente`, `pos_n_afiliado`) VALUES
(1, 1, 1, 34565),
(2, 3, 2, 56743),
(3, 9, 3, 45321),
(4, 5, 4, 23412),
(5, 8, 5, 34212),
(6, 10, 6, 34567),
(7, 7, 7, 87654),
(8, 2, 8, 45678),
(9, 10, 9, 23456),
(10, 2, 10, 21234);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'Medico'),
(2, 'Secretaria'),
(3, 'Administrador'),
(4, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE `tarifa` (
  `tarifa_id` int(11) NOT NULL,
  `tarifa_motivo` varchar(100) NOT NULL,
  `tarifa_monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`tarifa_id`, `tarifa_motivo`, `tarifa_monto`) VALUES
(1, 'Adicional', '1000.00'),
(2, 'sin obra social', '3000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `turno_id` int(11) NOT NULL,
  `turno_id_paciente` int(11) NOT NULL,
  `turno_id_medico` int(11) NOT NULL,
  `turno_fecha` date NOT NULL,
  `turno_hora` time NOT NULL,
  `turno_id_tarifa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`turno_id`, `turno_id_paciente`, `turno_id_medico`, `turno_fecha`, `turno_hora`, `turno_id_tarifa`) VALUES
(1, 1, 1, '2022-10-27', '16:30:00', 1),
(2, 2, 5, '2022-10-27', '17:30:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(60) NOT NULL,
  `usuario_apellido` varchar(60) NOT NULL,
  `usuario_user` varchar(100) NOT NULL,
  `usuario_contrasenia` varchar(150) NOT NULL,
  `usuario_id_rol` int(11) NOT NULL,
  `usuario_id_especialidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_user`, `usuario_contrasenia`, `usuario_id_rol`, `usuario_id_especialidad`) VALUES
(1, 'Martin', 'Gonzales', 'martinG', '$2y$10$BMx0W06okg.lqU3OKI9CROJsosJrhtwt/UpZyT99LnKJj1h3CGN7W', 1, 1),
(2, 'Juan', 'Martinez', 'juanM', '$2y$10$KSHVkwQx7CbmbB0xNnhZ4.xvcWGsHQHsLo2Bqv57CoPT4TJjP244G', 1, 8),
(3, 'Cristian', 'Diaz', 'cristianD', '$2y$10$pB0bS8e7youT6fo2Hf5jxemBKoXA2yDiVrFmtGkyasJqOSaKttwE.', 1, 7),
(4, 'Sol', 'Roteta', 'solR', '$2y$10$4vpBwrpCgQBQqSAkAqK0muDvsx/J7KB3pJi5mV5FwOiDKhiK9ULQq', 2, 1),
(5, 'Maria', 'Cinalli', 'mariaC', '$2y$10$QTf4nta3yMoN.b3LwQ3vEeNBibi3HTmqJ57Rd356WwZ83jZoShvM6', 1, 6),
(6, 'Cruz', 'Cinalli', 'cruzC', '$2y$10$4ltU9LjOJ.z/VfLUddFZYuu2ioqs505eotfMIV7EZpo9ecWzJQbVa', 1, 5),
(7, 'Olivia', 'Centeno', 'oliC', '$2y$10$9d.TOLLB.A1V4XQ30qOdTubfYsufxOw5LNWI4/Ji2dtrBNOV1yLLW', 2, 1),
(8, 'David', 'Orlando', 'davidO', '$2y$10$DA94rA0hddTIEPfiyDpFce73L2fPrktxrMdpep9AlROr0EffE8ELG', 1, 5),
(9, 'Julian', 'Tormes', 'juliT', '$2y$10$KP0ANjHbyj9r/v7Yb5IJ0OcXdxkFB67UjRYwlGRqzhfq6A7gU63Nm', 1, 10),
(10, 'Jose', 'Lopez', 'joseL', '$2y$10$dZvU1OcVruxAR6Dv0UiqF.RFB4qVt3hJsJ7itZdkT8btrGF6/ptVe', 1, 2),
(11, 'Carla', 'Iriarte', 'carlI', '$2y$10$RDRYCGPH5QXPG7sgbm3o2u4DMqOZOJRBIOK481ADBhWZO0hb2lRea', 1, 2),
(12, 'Manuela', 'Centeno', 'manuC', '$2y$10$oBbZ1ITXpDRgAHSr5iActuiWZa3KRh34mGiVKTw2dYo898NmMqmx2', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`esp_id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`grupo_id`),
  ADD KEY `grupo_id_secretaria` (`grupo_id_secretaria`),
  ADD KEY `grupo_id_medico` (`grupo_id_medico`);

--
-- Indices de la tabla `medico_os`
--
ALTER TABLE `medico_os`
  ADD PRIMARY KEY (`mos_id`),
  ADD KEY `mos_id_medico` (`mos_id_medico`),
  ADD KEY `mos_id_obrasocial` (`mos_id_obrasocial`);

--
-- Indices de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  ADD PRIMARY KEY (`os_id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`paciente_id`);

--
-- Indices de la tabla `paciente_os`
--
ALTER TABLE `paciente_os`
  ADD PRIMARY KEY (`pos_id`),
  ADD KEY `pos_id_obrasocial` (`pos_id_obrasocial`),
  ADD KEY `pos_id_paciente` (`pos_id_paciente`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`tarifa_id`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`turno_id`),
  ADD KEY `turno_id_paciente` (`turno_id_paciente`),
  ADD KEY `turno_id_medico` (`turno_id_medico`),
  ADD KEY `turno_id_monto` (`turno_id_tarifa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `usuario_id_especialidad` (`usuario_id_especialidad`),
  ADD KEY `usuario_id_rol` (`usuario_id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `esp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `grupo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `medico_os`
--
ALTER TABLE `medico_os`
  MODIFY `mos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `paciente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paciente_os`
--
ALTER TABLE `paciente_os`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `tarifa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`grupo_id_medico`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`grupo_id_secretaria`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medico_os`
--
ALTER TABLE `medico_os`
  ADD CONSTRAINT `medico_os_ibfk_1` FOREIGN KEY (`mos_id_medico`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medico_os_ibfk_2` FOREIGN KEY (`mos_id_obrasocial`) REFERENCES `obra_social` (`os_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente_os`
--
ALTER TABLE `paciente_os`
  ADD CONSTRAINT `paciente_os_ibfk_1` FOREIGN KEY (`pos_id_paciente`) REFERENCES `paciente` (`paciente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paciente_os_ibfk_2` FOREIGN KEY (`pos_id_obrasocial`) REFERENCES `obra_social` (`os_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `turno_ibfk_1` FOREIGN KEY (`turno_id_paciente`) REFERENCES `paciente` (`paciente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turno_ibfk_2` FOREIGN KEY (`turno_id_medico`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turno_ibfk_3` FOREIGN KEY (`turno_id_tarifa`) REFERENCES `tarifa` (`tarifa_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usuario_id_rol`) REFERENCES `rol` (`rol_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`usuario_id_especialidad`) REFERENCES `especialidad` (`esp_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
