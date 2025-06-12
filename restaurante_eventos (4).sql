-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-06-2025 a las 12:59:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante_eventos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `id_usuario`, `accion`, `ip`, `fecha`, `created_at`, `updated_at`) VALUES
(1, 1, 'Inicio de sesión', '::1', '2025-06-02 21:13:37', '2025-06-02 19:13:37', '2025-06-02 19:13:37'),
(2, 1, 'Actualización de usuario: joaquina', '::1', '2025-06-02 21:25:13', '2025-06-02 19:25:13', '2025-06-02 19:25:13'),
(3, 1, 'Actualización de usuario: Joaquina', '::1', '2025-06-02 21:32:47', '2025-06-02 19:32:47', '2025-06-02 19:32:47'),
(4, 1, 'Inicio de sesión', '::1', '2025-06-02 22:05:10', '2025-06-02 22:05:10', '2025-06-02 22:05:10'),
(5, 2, 'Inicio de sesión', '::1', '2025-06-02 22:09:49', '2025-06-02 22:09:49', '2025-06-02 22:09:49'),
(6, 2, 'Inicio de sesión', '::1', '2025-06-02 22:10:07', '2025-06-02 22:10:07', '2025-06-02 22:10:07'),
(7, 2, 'Inicio de sesión', '::1', '2025-06-02 22:11:16', '2025-06-02 22:11:16', '2025-06-02 22:11:16'),
(8, 1, 'Inicio de sesión', '::1', '2025-06-02 22:11:31', '2025-06-02 22:11:31', '2025-06-02 22:11:31'),
(9, 1, 'Inicio de sesión', '::1', '2025-06-02 22:16:04', '2025-06-02 22:16:04', '2025-06-02 22:16:04'),
(10, 1, 'Actualización de usuario: Joaquina', '::1', '2025-06-02 22:16:28', '2025-06-02 22:16:28', '2025-06-02 22:16:28'),
(11, 2, 'Inicio de sesión', '::1', '2025-06-02 22:16:49', '2025-06-02 22:16:49', '2025-06-02 22:16:49'),
(12, 1, 'Inicio de sesión', '::1', '2025-06-04 21:29:17', '2025-06-04 21:29:17', '2025-06-04 21:29:17'),
(13, 1, 'Inicio de sesión', '::1', '2025-06-05 21:13:03', '2025-06-05 21:13:03', '2025-06-05 21:13:03'),
(14, 2, 'Inicio de sesión', '::1', '2025-06-05 21:15:17', '2025-06-05 21:15:17', '2025-06-05 21:15:17'),
(15, 2, 'Inicio de sesión', '::1', '2025-06-08 23:38:51', '2025-06-08 23:38:51', '2025-06-08 23:38:51'),
(16, 1, 'Inicio de sesión', '::1', '2025-06-08 23:46:16', '2025-06-08 23:46:16', '2025-06-08 23:46:16'),
(17, 2, 'Inicio de sesión', '::1', '2025-06-08 23:46:34', '2025-06-08 23:46:34', '2025-06-08 23:46:34'),
(18, 1, 'Inicio de sesión', '::1', '2025-06-08 23:48:06', '2025-06-08 23:48:06', '2025-06-08 23:48:06'),
(19, 1, 'Inicio de sesión', '::1', '2025-06-09 21:09:39', '2025-06-09 21:09:39', '2025-06-09 21:09:39'),
(20, 1, 'Inicio de sesión', '::1', '2025-06-09 22:04:00', '2025-06-09 22:04:00', '2025-06-09 22:04:00'),
(21, 1, 'Envió de notificación a usuario ID: 1', '::1', '2025-06-09 22:04:31', '2025-06-09 22:04:31', '2025-06-09 22:04:31'),
(22, 1, 'Inicio de sesión', '::1', '2025-06-09 22:05:11', '2025-06-09 22:05:11', '2025-06-09 22:05:11'),
(23, 1, 'Envió de notificación a usuario ID: 2', '::1', '2025-06-09 22:05:41', '2025-06-09 22:05:41', '2025-06-09 22:05:41'),
(24, 2, 'Inicio de sesión', '::1', '2025-06-09 22:06:01', '2025-06-09 22:06:01', '2025-06-09 22:06:01'),
(25, 2, 'Envió de notificación a usuario ID: 1', '::1', '2025-06-09 22:14:12', '2025-06-09 22:14:12', '2025-06-09 22:14:12'),
(26, 2, 'Notificación leída ID: 2', '::1', '2025-06-09 22:14:52', '2025-06-09 22:14:52', '2025-06-09 22:14:52'),
(27, 1, 'Inicio de sesión', '::1', '2025-06-09 22:15:18', '2025-06-09 22:15:18', '2025-06-09 22:15:18'),
(28, 1, 'Notificación leída ID: 1', '::1', '2025-06-09 22:19:02', '2025-06-09 22:19:02', '2025-06-09 22:19:02'),
(29, 1, 'Notificación leída ID: 3', '::1', '2025-06-09 22:19:04', '2025-06-09 22:19:04', '2025-06-09 22:19:04'),
(30, 3, 'Inicio de sesión', '::1', '2025-06-09 22:30:29', '2025-06-09 22:30:29', '2025-06-09 22:30:29'),
(31, 1, 'Inicio de sesión', '::1', '2025-06-09 22:30:49', '2025-06-09 22:30:49', '2025-06-09 22:30:49'),
(32, 2, 'Inicio de sesión', '::1', '2025-06-09 23:02:24', '2025-06-09 23:02:24', '2025-06-09 23:02:24'),
(33, 1, 'Inicio de sesión', '::1', '2025-06-10 11:39:27', '2025-06-10 11:39:27', '2025-06-10 11:39:27'),
(34, 1, 'Inicio de sesión', '::1', '2025-06-10 13:03:51', '2025-06-10 13:03:51', '2025-06-10 13:03:51'),
(35, 1, 'Inicio de sesión', '::1', '2025-06-10 16:38:12', '2025-06-10 16:38:12', '2025-06-10 16:38:12'),
(36, 1, 'Inicio de sesión', '::1', '2025-06-10 19:26:29', '2025-06-10 19:26:29', '2025-06-10 19:26:29'),
(37, 1, 'Eliminación del role con ID: 3', '::1', '2025-06-10 22:11:20', '2025-06-10 22:11:20', '2025-06-10 22:11:20'),
(38, 1, 'Inicio de sesión', '::1', '2025-06-11 23:27:43', '2025-06-11 23:27:43', '2025-06-11 23:27:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueos_salon`
--

CREATE TABLE `bloqueos_salon` (
  `id` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_fin` time NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `dni_nie` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `dni_nie`, `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `created_at`, `updated_at`) VALUES
(1, '5656532', 'Ana', 'cano', '12345678', 'calle 3', 'ana@gmail.coom', '2025-06-10 17:31:34', '2025-06-10 17:31:34'),
(2, '', '', '', '', '', '', '2025-06-10 17:59:01', '2025-06-10 17:59:01'),
(3, 'z444444z', 'Ana', 'cano', '12345678', 'calle duque', 'ana@gmail.coom', '2025-06-10 20:08:02', '2025-06-10 20:08:02'),
(4, '', '', '', '', '', '', '2025-06-10 20:08:20', '2025-06-10 20:08:20'),
(5, 'z3333333z', 'Ana', 'cano', '12345678', 'calle duque', 'ana@gmail.coom', '2025-06-10 20:18:01', '2025-06-10 20:18:01'),
(6, 'z3333333z', 'Ana', 'Cano', '12345678', 'calle 3', 'ana@gmail.coom', '2025-06-10 20:21:18', '2025-06-10 20:21:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `fecha_evento` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` enum('Pendiente','Confirmado','Cancelado') DEFAULT 'Pendiente',
  `total` double(10,2) DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `id_cliente`, `id_empleado`, `id_salon`, `fecha_evento`, `hora_inicio`, `hora_fin`, `estado`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, '2025-06-13', '18:30:00', '02:30:00', 'Confirmado', 358.60, '2025-06-10 17:31:34', '2025-06-10 17:31:34'),
(2, 1, 1, 1, '2025-06-10', '20:25:00', '23:25:00', 'Pendiente', 3300.00, '2025-06-10 19:24:47', '2025-06-10 19:24:47'),
(5, 6, 1, 1, '2025-06-20', '15:20:00', '22:20:00', 'Pendiente', 7014.99, '2025-06-10 20:21:18', '2025-06-10 20:21:18'),
(6, 1, 1, 1, '2025-06-12', '16:22:00', '20:22:00', 'Pendiente', 7000.00, '2025-06-10 20:22:21', '2025-06-10 20:22:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_menus`
--

CREATE TABLE `eventos_menus` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos_menus`
--

INSERT INTO `eventos_menus` (`id`, `id_evento`, `id_menu`, `cantidad`, `created_at`, `updated_at`) VALUES
(5, 6, 1, 100, '2025-06-10 18:22:21', '2025-06-10 18:22:21'),
(6, 5, 1, 100, '2025-06-10 20:49:25', '2025-06-10 20:49:25'),
(7, 5, 2, 1, '2025-06-10 20:49:25', '2025-06-10 20:49:25'),
(8, 2, 4, 150, '2025-06-10 20:49:53', '2025-06-10 20:49:53'),
(13, 1, 1, 3, '2025-06-10 21:07:41', '2025-06-10 21:07:41'),
(14, 1, 3, 1, '2025-06-10 21:07:41', '2025-06-10 21:07:41'),
(15, 1, 5, 4, '2025-06-10 21:07:41', '2025-06-10 21:07:41'),
(16, 1, 6, 1, '2025-06-10 21:07:41', '2025-06-10 21:07:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_evento` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` double(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `tipo_evento`, `descripcion`, `precio`, `created_at`, `updated_at`) VALUES
(1, 'Menu1', 'Ejecutivo', 'ejemplo de menu1', 70.00, '2025-05-29 09:01:15', '2025-06-02 07:05:47'),
(2, 'Menú Ejecutivo Clásico', 'Ejecutivo', 'Carne asada, arroz blanco, ensalada mixta y agua mineral.', 14.99, '2025-06-02 20:54:29', '2025-06-02 20:54:29'),
(3, 'Menú Ejecutivo Premium', 'Ejecutivo', 'Filete de salmón, quinoa, vegetales salteados y vino blanco.', 19.50, '2025-06-02 20:54:29', '2025-06-02 20:54:29'),
(4, 'Menú Boda Tradicional', 'Boda', 'Pechuga rellena, puré de papa, ensalada César y vino tinto.', 22.00, '2025-06-02 20:54:29', '2025-06-02 20:54:29'),
(5, 'Menú Boda Gourmet', 'Boda', 'Solomillo en salsa de champiñones, risotto y vino reserva.', 29.90, '2025-06-02 20:54:29', '2025-06-02 20:54:29'),
(6, 'Menú Infantil para Boda', 'Boda', 'Mini hamburguesas, papas fritas y jugo.', 9.50, '2025-06-02 20:54:29', '2025-06-02 20:54:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_remitente` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `estado` enum('No leído','Leído') DEFAULT 'No leído',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `id_usuario`, `id_remitente`, `mensaje`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Hola, estoy probando los mensajes si se envian correctamente', 'Leído', '2025-06-09 20:04:31', '2025-06-09 20:19:02'),
(2, 2, 1, 'Hola, estoy probando si se envia correctamente', 'Leído', '2025-06-09 20:05:41', '2025-06-09 20:14:52'),
(3, 1, 2, 'si se ha enviado correctamente', 'Leído', '2025-06-09 20:14:12', '2025-06-09 20:19:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `monto` double(10,2) NOT NULL,
  `metodo_pago` enum('Efectivo','Tarjeta','Transferencia') NOT NULL,
  `estado` enum('Pendiente','Pagado','Rechazado') DEFAULT 'Pendiente',
  `fecha_pago` datetime DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_evento`, `monto`, `metodo_pago`, `estado`, `fecha_pago`, `created_at`, `updated_at`) VALUES
(1, 1, 358.60, 'Tarjeta', 'Pagado', '2025-06-10 17:31:34', '2025-06-10 17:31:34', '2025-06-10 17:31:34'),
(2, 2, 3300.00, 'Efectivo', 'Pagado', '2025-06-10 19:24:47', '2025-06-10 19:24:47', '2025-06-10 19:24:47'),
(3, 5, 7014.99, 'Efectivo', 'Pagado', '2025-06-10 20:21:18', '2025-06-10 20:21:18', '2025-06-10 20:21:18'),
(4, 6, 7000.00, 'Efectivo', 'Pagado', '2025-06-10 20:22:21', '2025-06-10 20:22:21', '2025-06-10 20:22:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2025-05-26 19:19:05', '2025-05-26 19:19:05'),
(2, 'Empleado', '2025-05-26 19:19:05', '2025-05-26 19:19:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salones`
--

CREATE TABLE `salones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salones`
--

INSERT INTO `salones` (`id`, `nombre`, `capacidad`, `created_at`, `updated_at`) VALUES
(1, 'Salón Aura', 50, '2025-05-29 06:09:12', '2025-05-29 06:09:32'),
(2, 'Salón Bosque Mágico', 70, '2025-05-29 06:10:05', '2025-05-29 06:10:17'),
(3, 'Salón Luna', 100, '2025-05-29 06:10:43', '2025-05-29 06:10:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_roles` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_roles`, `usuario`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-05-26 19:20:01', '2025-05-26 19:20:01'),
(2, 2, 'Joaquina', 'joaquina@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-05-26 06:07:25', '2025-06-02 08:16:28'),
(3, 2, 'Ana', 'ana@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-05-29 05:30:13', '2025-05-29 05:35:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `bloqueos_salon`
--
ALTER TABLE `bloqueos_salon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_salon` (`id_salon`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_salom` (`id_salon`);

--
-- Indices de la tabla `eventos_menus`
--
ALTER TABLE `eventos_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `fk_id_remitente` (`id_remitente`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salones`
--
ALTER TABLE `salones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`email`),
  ADD KEY `id_role` (`id_roles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `bloqueos_salon`
--
ALTER TABLE `bloqueos_salon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `eventos_menus`
--
ALTER TABLE `eventos_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salones`
--
ALTER TABLE `salones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `bloqueos_salon`
--
ALTER TABLE `bloqueos_salon`
  ADD CONSTRAINT `bloqueos_salon_ibfk_1` FOREIGN KEY (`id_salon`) REFERENCES `salones` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `eventos_ibfk_3` FOREIGN KEY (`id_salon`) REFERENCES `salones` (`id`);

--
-- Filtros para la tabla `eventos_menus`
--
ALTER TABLE `eventos_menus`
  ADD CONSTRAINT `eventos_menus_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `eventos_menus_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_id_remitente` FOREIGN KEY (`id_remitente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
