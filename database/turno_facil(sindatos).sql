-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2022 a las 23:36:09
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_os`
--

CREATE TABLE `medico_os` (
  `mos_id` int(11) NOT NULL,
  `mos_id_medico` int(11) NOT NULL,
  `mos_id_obrasocial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE `tarifa` (
  `tarifa_id` int(11) NOT NULL,
  `tarifa_motivo` varchar(100) NOT NULL,
  `tarifa_monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `turno_id_monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `turno_id_monto` (`turno_id_monto`);

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
  MODIFY `grupo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medico_os`
--
ALTER TABLE `medico_os`
  MODIFY `mos_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `paciente_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente_os`
--
ALTER TABLE `paciente_os`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `tarifa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `turno_ibfk_3` FOREIGN KEY (`turno_id_monto`) REFERENCES `tarifa` (`tarifa_id`) ON UPDATE CASCADE;

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
