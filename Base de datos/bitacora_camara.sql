-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2024 a las 00:17:48
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bitacora_camara`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `grabando_video` varchar(3) DEFAULT NULL,
  `dias_video` int(11) NOT NULL,
  `almacena_dias` varchar(3) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacoras`
--

INSERT INTO `bitacoras` (`id`, `fecha`, `grabando_video`, `dias_video`, `almacena_dias`, `comentario`, `created_at`) VALUES
(18, '2024-09-26', 'Si', 30, 'Si', 'Sin detalles', '2024-09-26 20:19:37'),
(19, '2024-09-27', 'Si', 30, 'Si', 'Algunas cámaras se requiere que se cambien por la cálidad de video', '2024-09-27 17:12:47'),
(20, '2024-10-05', 'Si', 18, 'Si', 'Se presentaron que algunas cámaras evaluadas no presentan buena cálidad en la imagén', '2024-10-05 18:17:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_detalles`
--

CREATE TABLE `bitacora_detalles` (
  `id` int(11) NOT NULL,
  `bitacora_id` int(11) NOT NULL,
  `camara_id` int(11) NOT NULL,
  `sin_alimentacion` tinyint(1) DEFAULT 0,
  `imagen_borrosa` tinyint(1) DEFAULT 0,
  `obstruida` tinyint(1) DEFAULT 0,
  `frente_al_suelo` tinyint(1) DEFAULT 0,
  `mala_iluminacion` tinyint(1) DEFAULT 0,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora_detalles`
--

INSERT INTO `bitacora_detalles` (`id`, `bitacora_id`, `camara_id`, `sin_alimentacion`, `imagen_borrosa`, `obstruida`, `frente_al_suelo`, `mala_iluminacion`, `observaciones`, `created_at`) VALUES
(51, 18, 9, 0, 0, 1, 1, 0, 'gfggsdfd', '2024-09-26 20:19:37'),
(52, 18, 10, 0, 1, 0, 0, 0, '', '2024-09-26 20:19:37'),
(53, 19, 9, 0, 0, 0, 0, 0, '', '2024-09-27 17:12:47'),
(54, 19, 10, 0, 0, 0, 0, 0, '', '2024-09-27 17:12:47'),
(55, 20, 9, 1, 1, 0, 0, 0, 'Baja calidad en la imagen', '2024-10-05 18:17:19'),
(56, 20, 10, 0, 0, 0, 0, 0, '', '2024-10-05 18:17:19'),
(57, 20, 11, 0, 0, 1, 0, 0, 'objeto obstruye la vista', '2024-10-05 18:17:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_redes`
--

CREATE TABLE `bitacora_redes` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `politicas` text NOT NULL,
  `estado_cumplimiento` varchar(50) NOT NULL,
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora_redes`
--

INSERT INTO `bitacora_redes` (`id`, `fecha`, `responsable`, `politicas`, `estado_cumplimiento`, `comentarios`) VALUES
(8, '2024-10-17', 'Darío Reyes', '[\"Revisar bit\\u00e1coras del firewall\",\"Mantener actualizada la base de datos de vulnerabilidades en sistemas\"]', 'Completado', 'Se llevo con éxito el registro de todos los puntos'),
(12, '2024-10-17', 'Darío Reyes Tomás', '[\"Mantener actualizada la base de datos de vulnerabilidades en sistemas\"]', 'Completado', 'Se realizo con éxito dichas revisiones'),
(18, '2024-10-18', 'Darío Reyes Tomás', '[\"Monitoreo de red\",\"Actualizaci\\u00f3n del firewall\",\"Revisar bit\\u00e1coras del firewall\",\"Mantener actualizada la base de datos de vulnerabilidades en sistemas\",\"Monitoreo de puertos y Analizar el tr\\u00e1fico de red\",\"Monitoreo del uso de sistemas internos y accesos a sitios web externos\"]', 'Completado', 'Cumplí con todos los requisitos establecidos, asi que por ello que llevo con éxito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camaras`
--

CREATE TABLE `camaras` (
  `id` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `resolucion` varchar(50) NOT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camaras`
--

INSERT INTO `camaras` (`id`, `modelo`, `marca`, `resolucion`, `departamento`, `nombre`, `observacion`, `created_at`, `imagen`) VALUES
(9, 'honor', 'AMD', '1024*1800', 'Corte', 'Camara1', 'La cámara prenseta buena cálidad en la imagen', '2024-09-26 20:18:38', 'e33a7054971728d32f12e3f4418fda3e.jfif'),
(10, 'casio', 'huawei', '123x45', 'Terminado', 'Camara2', 'Sin observaciones', '2024-09-26 20:19:05', 'c72ca1dfd1bb7cc13aae5d5c937a2cc9.jfif'),
(11, 'honor', 'huawei', '1024*1800', 'empaque', 'Camara3', 'Todo correcto', '2024-10-05 18:16:04', '083be56f7414afca15d257ecb0909a79.jfif');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bitacora_detalles`
--
ALTER TABLE `bitacora_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bitacora_id` (`bitacora_id`),
  ADD KEY `camara_id` (`camara_id`);

--
-- Indices de la tabla `bitacora_redes`
--
ALTER TABLE `bitacora_redes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `camaras`
--
ALTER TABLE `camaras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `bitacora_detalles`
--
ALTER TABLE `bitacora_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `bitacora_redes`
--
ALTER TABLE `bitacora_redes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `camaras`
--
ALTER TABLE `camaras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora_detalles`
--
ALTER TABLE `bitacora_detalles`
  ADD CONSTRAINT `bitacora_detalles_ibfk_1` FOREIGN KEY (`bitacora_id`) REFERENCES `bitacoras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bitacora_detalles_ibfk_2` FOREIGN KEY (`camara_id`) REFERENCES `camaras` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
