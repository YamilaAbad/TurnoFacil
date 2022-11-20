-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2022 a las 01:35:21
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

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
(3, 'Hemoterapia'),
(4, 'Neumologia'),
(5, 'Neurologia'),
(6, 'Nutricion'),
(7, 'Pediatria'),
(8, 'Oncologia'),
(9, 'Psiquiatria'),
(10, 'Reumatologia'),
(11, 'Generalista'),
(12, 'Diabetologo'),
(13, 'Oculista'),
(14, 'Psicologia');

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
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `medico_id` int(11) NOT NULL,
  `medico_dni` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `medico_nombre` varchar(125) COLLATE utf8_spanish_ci NOT NULL,
  `medico_apellido` varchar(145) COLLATE utf8_spanish_ci NOT NULL,
  `medico_telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `medico_id_especialidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`medico_id`, `medico_dni`, `medico_nombre`, `medico_apellido`, `medico_telefono`, `medico_id_especialidad`) VALUES
(1, '74125896', 'Martin', 'Gonzalez', '29835689785', 1),
(2, '85247111', 'Juan', 'Martinez', '29835689785', 8),
(3, '852369', 'Cristian', 'Diaz', '2983534569', 7),
(4, '30258748', 'Maria', 'Cinalli', '29835689785', 6),
(5, '45632158', 'Juan Cruz', 'Cinalli', '29835689785', 5),
(6, '1235896', 'David', 'Orlando', '29835689785', 5),
(7, '74125896', 'Julian', 'Tormes', '29835689785', 10),
(8, '5896741', 'Jose', 'Lopez', '29835689785', 2),
(9, '12345687', 'Carla', 'Iriarte', '29835689785', 2),
(10, '12355687', 'Antonia', 'Navarro', '29835689785', 3),
(11, '30218748', 'Maria Jose', 'Perez', '29835689785', 4),
(12, '74133896', 'Laura', 'Gonzalez', '298315030303', 1),
(13, '85247888', 'Juana', 'Martinez Lacos', '29835611785', 8),
(14, '11155687', 'Anacleta', 'Lazarte', '22238689785', 3),
(15, '30288748', 'Mario Jose', 'Carrozi', '29835689785', 4),
(16, '45002158', 'Juana Margarita', 'Cinalli', '29835611785', 5),
(17, '50258748', 'Maria Paula', 'Martin', '29835689785', 6),
(18, '25236989', 'Cristiana', 'Diaz Velez', '2983514569', 7),
(19, '74125226', 'Juana', 'Viale', '29835689785', 10),
(20, '35558748', 'Martina', 'Leggareta', '29835689785', 6),
(21, '25231189', 'Juan Pedro', 'Pandora', '2983514569', 7),
(22, '82347111', 'Anastacio', 'Dolagaray', '29835689785', 8),
(23, '74125008', 'Julian Martin', 'Gomez', '29835689785', 10),
(24, '85247333', 'Anastacia', 'Martinez', '29835689785', 9),
(25, '74125236', 'Cristian', 'Viale', '29835689785', 11),
(26, '74125866', 'Daiana', 'Galli', '29835689785', 11),
(27, '74125338', 'Julian', 'Cardoso', '29835689785', 11),
(28, '85111333', 'Gabriela', 'Martinez', '29835689785', 9),
(29, '74125276', 'Cristiana', 'Viale', '29835689785', 13),
(30, '74133866', 'Daiana Maria', 'Gallindo', '29835689785', 12),
(31, '74125448', 'Juliana', 'Cardoso', '29835689785', 12),
(32, '14125888', 'Damiana', 'Galli Garcia', '29835689785', 13),
(33, '374125311', 'Julian', 'Carrozi', '29835689785', 13),
(34, '34133866', 'Milagros Antonia', 'Gallindo', '29835689785', 12),
(35, '34125276', 'Cristiana', 'Viale', '29835689785', 13);

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
(2, 1, 2),
(3, 1, 9),
(4, 2, 5),
(5, 10, 1),
(6, 10, 8),
(7, 1, 3),
(8, 1, 4),
(9, 1, 5),
(10, 2, 1),
(11, 2, 3),
(12, 10, 10),
(13, 2, 9),
(14, 10, 3),
(15, 10, 4),
(16, 3, 2),
(17, 3, 1),
(18, 3, 3),
(19, 3, 5),
(20, 5, 4),
(21, 5, 3),
(22, 5, 10),
(23, 5, 1),
(24, 5, 8),
(25, 4, 1),
(26, 4, 2),
(27, 4, 9),
(28, 4, 5),
(29, 6, 1),
(30, 6, 2),
(31, 6, 9),
(32, 7, 1),
(33, 7, 2),
(34, 7, 9),
(35, 7, 5),
(36, 7, 8),
(37, 23, 1),
(38, 23, 5),
(39, 12, 4),
(40, 12, 3),
(41, 12, 9),
(42, 11, 2),
(43, 15, 3),
(44, 15, 4),
(45, 12, 8),
(46, 12, 10);

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
(10, 'Sancor Salud'),
(11, 'OSPRERA RURAL'),
(12, 'OSECAD'),
(13, 'OSPRERA'),
(14, 'NO POSEE');

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
(10, 5678432, 'Hector', 'Garcia', 'Burchardo 40', '430908', 'hector@gmail.com'),
(11, 34509257, 'Noelia Daiana', 'Carrizo', '25 de mayo 445', '2983510330', 'noeliacarrizo22@gmail.com'),
(12, 0, 'Martina', 'Carrizo', 'Balcarce 445', '(298) 351-0330', 'martinac22@gmail.com');

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
(10, 2, 10, 21234),
(11, 11, 12, 675845);

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
(4, 'Superadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretaria`
--

CREATE TABLE `secretaria` (
  `id_secretaria` int(11) NOT NULL,
  `nombre` varchar(56) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(56) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `secretaria`
--

INSERT INTO `secretaria` (`id_secretaria`, `nombre`, `apellido`, `usuario_id`) VALUES
(1, 'Noelia', 'Millara', 13),
(2, 'Juana Matilda', 'Martinez', 2),
(3, 'Gabriela', 'Martin', 10),
(4, 'Maria', 'Catalina', 5),
(5, 'Maria Lucia', 'Cardoso', 11),
(6, 'Maria Antonieta', 'Carrozi', 1),
(7, 'Julieta', 'Trueba', 9),
(8, 'Monica', 'Straser', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretaria_de_medicos`
--

CREATE TABLE `secretaria_de_medicos` (
  `id_sec_med` int(11) NOT NULL,
  `id_secretaria` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `secretaria_de_medicos`
--

INSERT INTO `secretaria_de_medicos` (`id_sec_med`, `id_secretaria`, `id_medico`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 4),
(8, 2, 3),
(9, 3, 6),
(10, 3, 8),
(11, 1, 13),
(12, 1, 12);

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
  `turno_id_paciente` int(11) DEFAULT NULL,
  `turno_id_medico` int(11) NOT NULL,
  `turno_fecha` date NOT NULL,
  `turno_hora` time NOT NULL,
  `turno_id_tarifa` int(11) DEFAULT NULL,
  `turno_ocupado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`turno_id`, `turno_id_paciente`, `turno_id_medico`, `turno_fecha`, `turno_hora`, `turno_id_tarifa`, `turno_ocupado`) VALUES
(1, 1, 1, '2022-10-27', '16:30:00', 1, 1),
(2, 11, 5, '2022-10-27', '17:30:00', 1, 1),
(3, NULL, 10, '2022-10-19', '10:00:00', NULL, 0),
(4, NULL, 3, '2022-10-28', '09:30:00', NULL, 0),
(5, NULL, 10, '2022-10-25', '18:00:00', NULL, 0),
(9, NULL, 12, '2022-10-19', '09:30:00', NULL, 0),
(10, NULL, 3, '2022-10-28', '10:30:00', NULL, 0),
(11, NULL, 3, '2022-10-28', '10:00:00', NULL, 0),
(12, NULL, 5, '2022-10-19', '10:00:00', NULL, 0),
(13, NULL, 1, '2022-10-19', '09:30:00', NULL, 0),
(14, NULL, 4, '2022-10-28', '10:30:00', NULL, 0),
(15, NULL, 4, '2022-10-28', '10:00:00', NULL, 0),
(16, NULL, 4, '2022-10-28', '18:30:00', NULL, 0),
(17, NULL, 4, '2022-10-28', '18:00:00', NULL, 0),
(18, NULL, 5, '2022-10-19', '18:00:00', NULL, 0),
(19, NULL, 2, '2022-10-19', '18:00:00', NULL, 0),
(20, NULL, 2, '2022-10-28', '18:30:00', NULL, 0),
(21, NULL, 5, '2022-11-21', '10:00:00', NULL, 0),
(22, 11, 1, '2022-11-24', '09:30:00', 2, 1),
(23, 11, 4, '2022-11-23', '10:30:00', 2, 1),
(24, NULL, 4, '2022-11-28', '10:00:00', NULL, 0),
(25, NULL, 4, '2022-10-28', '18:30:00', NULL, 0),
(26, NULL, 4, '2022-10-28', '18:00:00', NULL, 0),
(27, NULL, 5, '2022-10-19', '18:00:00', NULL, 0),
(28, NULL, 2, '2022-10-19', '18:00:00', NULL, 0),
(29, NULL, 2, '2022-10-28', '18:30:00', NULL, 0),
(30, NULL, 4, '2022-11-30', '18:30:00', NULL, 0),
(31, NULL, 4, '2022-11-28', '18:00:00', NULL, 0),
(32, NULL, 4, '2022-10-28', '10:30:00', NULL, 0),
(33, NULL, 4, '2022-10-28', '18:40:00', NULL, 0),
(34, NULL, 5, '2022-10-19', '17:00:00', NULL, 0),
(35, NULL, 2, '2022-10-19', '18:40:00', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_user` varchar(100) NOT NULL,
  `usuario_contrasenia` varchar(150) NOT NULL,
  `usuario_id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_user`, `usuario_contrasenia`, `usuario_id_rol`) VALUES
(1, 'martinG', '$2y$10$BMx0W06okg.lqU3OKI9CROJsosJrhtwt/UpZyT99LnKJj1h3CGN7W', 1),
(2, 'juanM', '$2y$10$KSHVkwQx7CbmbB0xNnhZ4.xvcWGsHQHsLo2Bqv57CoPT4TJjP244G', 1),
(3, 'cristianD', '$2y$10$pB0bS8e7youT6fo2Hf5jxemBKoXA2yDiVrFmtGkyasJqOSaKttwE.', 1),
(4, 'solR', '$2y$10$4vpBwrpCgQBQqSAkAqK0muDvsx/J7KB3pJi5mV5FwOiDKhiK9ULQq', 2),
(5, 'mariaC', '$2y$10$QTf4nta3yMoN.b3LwQ3vEeNBibi3HTmqJ57Rd356WwZ83jZoShvM6', 1),
(6, 'cruzC', '$2y$10$4ltU9LjOJ.z/VfLUddFZYuu2ioqs505eotfMIV7EZpo9ecWzJQbVa', 1),
(7, 'oliC', '$2y$10$9d.TOLLB.A1V4XQ30qOdTubfYsufxOw5LNWI4/Ji2dtrBNOV1yLLW', 2),
(8, 'davidO', '$2y$10$DA94rA0hddTIEPfiyDpFce73L2fPrktxrMdpep9AlROr0EffE8ELG', 1),
(9, 'juliT', '$2y$10$KP0ANjHbyj9r/v7Yb5IJ0OcXdxkFB67UjRYwlGRqzhfq6A7gU63Nm', 1),
(10, 'joseL', '$2y$10$dZvU1OcVruxAR6Dv0UiqF.RFB4qVt3hJsJ7itZdkT8btrGF6/ptVe', 1),
(11, 'carlI', '$2y$10$RDRYCGPH5QXPG7sgbm3o2u4DMqOZOJRBIOK481ADBhWZO0hb2lRea', 1),
(12, 'monis', '$2y$10$oBbZ1ITXpDRgAHSr5iActuiWZa3KRh34mGiVKTw2dYo898NmMqmx2', 3),
(13, 'noelia', '17d7cd52cd18e7bab99bb71de1669d95', 2);

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
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`medico_id`);

--
-- Indices de la tabla `medico_os`
--
ALTER TABLE `medico_os`
  ADD PRIMARY KEY (`mos_id`);

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
-- Indices de la tabla `secretaria`
--
ALTER TABLE `secretaria`
  ADD PRIMARY KEY (`id_secretaria`);

--
-- Indices de la tabla `secretaria_de_medicos`
--
ALTER TABLE `secretaria_de_medicos`
  ADD PRIMARY KEY (`id_sec_med`);

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
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `esp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `grupo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `medico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `medico_os`
--
ALTER TABLE `medico_os`
  MODIFY `mos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `paciente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `paciente_os`
--
ALTER TABLE `paciente_os`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `secretaria`
--
ALTER TABLE `secretaria`
  MODIFY `id_secretaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `secretaria_de_medicos`
--
ALTER TABLE `secretaria_de_medicos`
  MODIFY `id_sec_med` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `tarifa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
