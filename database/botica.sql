-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2025 a las 14:46:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `botica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(12, 16, 11, 1, 22.00),
(13, 16, 15, 1, 25.00),
(14, 16, 20, 1, 14.00),
(15, 17, 2, 1, 5.00),
(16, 17, 4, 1, 12.00),
(17, 17, 11, 1, 22.00),
(18, 17, 19, 1, 18.00),
(19, 18, 2, 1, 5.00),
(20, 18, 11, 3, 22.00),
(21, 18, 13, 1, 15.00),
(22, 19, 15, 2, 25.00),
(23, 19, 20, 3, 14.00),
(24, 20, 15, 1, 25.00),
(25, 20, 19, 1, 18.00),
(26, 20, 20, 1, 14.00),
(27, 21, 11, 3, 22.00),
(28, 22, 15, 2, 25.00),
(29, 22, 20, 2, 14.00),
(30, 23, 20, 1, 14.00),
(31, 24, 20, 1, 14.00),
(32, 25, 15, 1, 25.00),
(33, 25, 19, 1, 18.00),
(34, 26, 11, 1, 22.00),
(35, 26, 20, 1, 14.00),
(36, 27, 9, 1, 7.50),
(37, 27, 15, 1, 25.00),
(38, 28, 15, 1, 25.00),
(39, 28, 19, 1, 18.00),
(40, 29, 39, 1, 50.00),
(41, 30, 39, 1, 50.00),
(42, 31, 20, 1, 14.00),
(43, 31, 39, 1, 50.00),
(44, 32, 15, 4, 25.00),
(45, 33, 19, 9, 18.00),
(46, 34, 11, 9, 22.00),
(47, 34, 12, 20, 8.50),
(48, 35, 11, 1, 22.00),
(49, 35, 12, 2, 8.50),
(50, 36, 15, 1, 25.00),
(51, 37, 19, 1, 18.00),
(52, 38, 15, 1, 25.00),
(53, 38, 19, 1, 18.00),
(54, 39, 1, 1, 3.50),
(55, 40, 1, 1, 3.50),
(56, 40, 7, 1, 2.00),
(57, 41, 6, 1, 3.00),
(58, 41, 14, 1, 4.00),
(59, 42, 1, 1, 3.50),
(60, 43, 17, 1, 3.00),
(61, 44, 39, 1, 50.00),
(62, 45, 12, 1, 8.50),
(63, 46, 4, 2, 12.00),
(64, 47, 19, 1, 18.00),
(65, 48, 20, 1, 14.00),
(66, 49, 1, 3, 3.50),
(67, 50, 14, 1, 4.00),
(68, 51, 7, 1, 2.00),
(69, 52, 5, 1, 4.50),
(70, 53, 17, 1, 3.00),
(71, 54, 6, 1, 3.00),
(72, 55, 17, 1, 3.00),
(73, 56, 18, 1, 9.00),
(74, 57, 17, 4, 3.00),
(75, 58, 14, 1, 4.00),
(76, 59, 14, 1, 4.00),
(77, 60, 6, 1, 3.00),
(78, 60, 7, 1, 2.00),
(79, 61, 18, 1, 9.00),
(80, 62, 7, 2, 2.00),
(81, 63, 1, 1, 3.50),
(82, 64, 14, 1, 4.00),
(83, 65, 6, 1, 3.00),
(84, 65, 14, 1, 4.00),
(85, 66, 18, 1, 9.00),
(86, 67, 1, 1, 3.50),
(87, 68, 5, 1, 4.50),
(88, 68, 12, 2, 8.50),
(89, 68, 16, 1, 5.50),
(90, 69, 2, 1, 5.00),
(91, 69, 13, 1, 15.00),
(92, 70, 13, 1, 15.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_stock`
--

CREATE TABLE `historial_stock` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `tipo_movimiento` enum('entrada','salida','venta') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_stock`
--

INSERT INTO `historial_stock` (`id`, `id_producto`, `tipo_movimiento`, `cantidad`, `fecha`) VALUES
(20, 20, 'entrada', 1, '2025-12-07 18:33:32'),
(21, 15, 'entrada', 3, '2025-12-07 18:51:36'),
(22, 12, 'entrada', 2, '2025-12-07 18:51:44'),
(23, 19, 'entrada', 4, '2025-12-07 18:51:47'),
(24, 39, 'entrada', 2, '2025-12-07 18:51:51'),
(25, 11, 'entrada', 4, '2025-12-07 18:55:38'),
(26, 12, 'entrada', 5, '2025-12-07 18:55:42'),
(27, 20, 'entrada', 2, '2025-12-07 18:55:48'),
(28, 39, 'entrada', 1, '2025-12-07 18:56:03'),
(29, 39, 'entrada', 1, '2025-12-07 18:59:58'),
(30, 3, 'entrada', 1, '2025-12-07 19:00:14'),
(31, 20, 'entrada', 2, '2025-12-08 08:28:32'),
(32, 19, 'entrada', 1, '2025-12-08 08:32:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo_evento` enum('login','logout','registro','venta','carrito','producto','usuario','error') NOT NULL,
  `descripcion` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `nivel` enum('info','warning','error') DEFAULT 'info'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `id_usuario`, `tipo_evento`, `descripcion`, `ip_address`, `user_agent`, `fecha`, `nivel`) VALUES
(1, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 21:58:09', 'info'),
(2, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 21:58:24', 'info'),
(3, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 21:58:29', 'info'),
(4, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 21:58:31', 'info'),
(5, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 21:58:35', 'info'),
(6, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:12:37', 'info'),
(7, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:33:02', 'warning'),
(8, NULL, 'login', 'Intento de login fallido para usuario: ga', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:34:36', 'warning'),
(9, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:34:40', 'info'),
(10, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:35:22', 'info'),
(11, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:35:28', 'info'),
(12, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:35:40', 'info'),
(13, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:35:45', 'info'),
(14, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:36:32', 'info'),
(15, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:36:33', 'warning'),
(16, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:36:38', 'warning'),
(17, NULL, 'login', 'Intento de login fallido para usuario: ga', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:36:43', 'warning'),
(18, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:36:47', 'info'),
(19, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:37:44', 'info'),
(20, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:39:57', 'info'),
(21, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:41:28', 'info'),
(22, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:41:40', 'info'),
(23, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:45:48', 'info'),
(24, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:45:56', 'info'),
(25, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:48:23', 'info'),
(26, NULL, 'login', 'Intento de login fallido para usuario: pepe', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:48:29', 'warning'),
(27, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:48:34', 'info'),
(28, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:48:47', 'info'),
(29, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:48:53', 'info'),
(30, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 22:49:09', 'info'),
(31, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 18:56:53', 'info'),
(32, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 18:57:19', 'info'),
(33, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 18:57:26', 'info'),
(34, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:05:19', 'info'),
(35, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:05:26', 'info'),
(36, 12, 'venta', 'Venta registrada - ID: 16, Total: S/ 61', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:05:44', 'info'),
(37, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:07:43', 'info'),
(38, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:07:49', 'info'),
(39, 9, 'venta', 'Venta registrada - ID: 17, Total: S/ 57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:08:18', 'info'),
(40, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:08:46', 'info'),
(41, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:08:48', 'warning'),
(42, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:08:56', 'info'),
(43, 10, 'venta', 'Venta registrada - ID: 18, Total: S/ 86', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:09:15', 'info'),
(44, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:11:04', 'info'),
(45, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:11:08', 'info'),
(46, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:12:25', 'info'),
(47, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:12:29', 'info'),
(48, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:14:43', 'info'),
(49, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:14:47', 'info'),
(50, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:15:14', 'info'),
(51, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:15:20', 'info'),
(52, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:15:46', 'info'),
(53, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:15:51', 'info'),
(54, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:16:24', 'info'),
(55, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:16:29', 'info'),
(56, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:23:12', 'info'),
(57, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:23:21', 'info'),
(58, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:28:36', 'info'),
(59, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:30:17', 'info'),
(60, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:30:18', 'info'),
(61, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:30:23', 'info'),
(62, 10, 'venta', 'Venta registrada - ID: 19, Total: S/ 92', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:30:42', 'info'),
(63, 10, 'venta', 'Venta registrada - ID: 20, Total: S/ 57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:31:04', 'info'),
(64, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:31:46', 'info'),
(65, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:37:40', 'warning'),
(66, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:37:46', 'warning'),
(67, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:37:58', 'warning'),
(68, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:38:24', 'info'),
(69, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:38:48', 'info'),
(70, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:38:53', 'info'),
(71, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:38:59', 'info'),
(72, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:39:00', 'warning'),
(73, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:39:09', 'info'),
(74, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:43:45', 'info'),
(75, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:44:26', 'info'),
(76, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:45:18', 'info'),
(77, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:45:22', 'info'),
(78, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:45:49', 'info'),
(79, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:45:55', 'info'),
(80, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:46:15', 'info'),
(81, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:49:04', 'info'),
(82, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:49:08', 'info'),
(83, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:53:26', 'info'),
(84, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:53:35', 'info'),
(85, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:53:39', 'info'),
(86, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:54:02', 'info'),
(87, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:54:07', 'info'),
(88, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:55:03', 'info'),
(89, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:55:05', 'warning'),
(90, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:55:26', 'info'),
(91, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:55:43', 'info'),
(92, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:56:58', 'info'),
(93, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:59:26', 'info'),
(94, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:59:31', 'info'),
(95, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:59:47', 'info'),
(96, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:59:51', 'info'),
(97, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 19:59:58', 'info'),
(98, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:00:02', 'info'),
(99, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:00:06', 'info'),
(100, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:00:09', 'info'),
(101, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:00:24', 'info'),
(102, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:00:30', 'info'),
(103, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:03:33', 'info'),
(104, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:03:38', 'info'),
(105, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:03:40', 'info'),
(106, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:03:43', 'info'),
(107, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:04:56', 'info'),
(108, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:06:37', 'info'),
(109, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:06:49', 'info'),
(110, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:06:54', 'info'),
(111, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:07:01', 'info'),
(112, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:07:11', 'info'),
(113, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:07:26', 'info'),
(114, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:09:06', 'info'),
(115, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:10:28', 'info'),
(116, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:10:36', 'info'),
(117, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:10:49', 'info'),
(118, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:10:59', 'info'),
(119, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:11:02', 'info'),
(120, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:11:07', 'info'),
(121, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:15:09', 'info'),
(122, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:15:14', 'info'),
(123, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:15:20', 'info'),
(124, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:15:25', 'info'),
(125, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:15:27', 'info'),
(126, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:15:31', 'info'),
(127, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:18:53', 'info'),
(128, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:18:57', 'info'),
(129, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:22:29', 'info'),
(130, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:24:47', 'info'),
(131, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:30:18', 'info'),
(132, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:30:25', 'info'),
(133, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:32:01', 'info'),
(134, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:32:06', 'info'),
(135, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:32:14', 'info'),
(136, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:36:00', 'info'),
(137, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:43:22', 'info'),
(138, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:43:31', 'warning'),
(139, NULL, 'login', 'Intento de login fallido para usuario: ga', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:43:36', 'warning'),
(140, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:43:41', 'info'),
(141, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:43:50', 'info'),
(142, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:43:55', 'info'),
(143, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:43:57', 'info'),
(144, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:46:20', 'info'),
(145, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:46:23', 'info'),
(146, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:46:29', 'info'),
(147, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:46:31', 'info'),
(148, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:46:35', 'info'),
(149, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:49:25', 'info'),
(150, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:50:02', 'info'),
(151, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:50:03', 'info'),
(152, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:50:09', 'info'),
(153, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:51:26', 'info'),
(154, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:53:21', 'info'),
(155, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:53:38', 'info'),
(156, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:53:42', 'info'),
(157, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:54:00', 'info'),
(158, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:54:05', 'info'),
(159, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:54:16', 'info'),
(160, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:55:10', 'info'),
(161, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:56:24', 'info'),
(162, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:57:30', 'info'),
(163, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:57:56', 'info'),
(164, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:58:00', 'info'),
(165, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:58:25', 'info'),
(166, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:58:29', 'info'),
(167, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:58:43', 'info'),
(168, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:58:44', 'warning'),
(169, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 20:58:47', 'info'),
(170, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 21:01:57', 'info'),
(171, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 21:02:01', 'info'),
(172, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 21:02:13', 'info'),
(173, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 21:02:16', 'info'),
(174, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 21:02:18', 'info'),
(175, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 21:02:23', 'info'),
(176, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 21:02:27', 'info'),
(177, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 21:02:32', 'info'),
(178, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:53:38', 'info'),
(179, NULL, 'login', 'Intento de login fallido para usuario: ga', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:53:43', 'warning'),
(180, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:53:47', 'info'),
(181, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:54:16', 'info'),
(182, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:54:21', 'info'),
(183, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:54:34', 'info'),
(184, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:54:39', 'info'),
(185, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:55:53', 'info'),
(186, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:56:16', 'info'),
(187, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:56:23', 'info'),
(188, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:56:28', 'info'),
(189, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:58:55', 'info'),
(190, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 18:59:45', 'info'),
(191, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:00:01', 'info'),
(192, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:00:05', 'info'),
(193, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:00:19', 'info'),
(194, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:00:25', 'info'),
(195, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:00:44', 'info'),
(196, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:04:31', 'info'),
(197, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:09:00', 'info'),
(198, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:09:04', 'info'),
(199, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:09:12', 'info'),
(200, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:09:17', 'info'),
(201, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:09:22', 'info'),
(202, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:09:25', 'info'),
(203, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:12:26', 'info'),
(204, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:13:34', 'info'),
(205, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:53:16', 'info'),
(206, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 19:53:20', 'info'),
(207, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 20:14:43', 'info'),
(208, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 20:14:49', 'info'),
(209, 12, 'venta', 'Venta registrada - ID: 21, Total: S/ 66', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 20:43:56', 'info'),
(210, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 20:50:18', 'info'),
(211, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 20:50:28', 'info'),
(212, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 20:51:45', 'info'),
(213, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 20:51:50', 'info'),
(214, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 20:55:07', 'info'),
(215, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-02 20:13:57', 'warning'),
(216, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-02 20:31:30', 'warning'),
(217, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-03 00:06:42', 'warning'),
(218, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-03 00:06:46', 'info'),
(219, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 19:13:31', 'info'),
(220, NULL, 'login', 'Intento de login fallido para usuario: http://localhost/dashboard/Botica/?route=admin/logs', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 19:13:40', 'warning'),
(221, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 19:13:44', 'info'),
(222, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 20:28:34', 'info'),
(223, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 21:54:02', 'info'),
(224, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 21:54:13', 'info'),
(225, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 21:54:49', 'info'),
(226, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 21:54:53', 'info'),
(227, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 21:55:32', 'info'),
(228, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:22:32', 'info');
INSERT INTO `logs` (`id`, `id_usuario`, `tipo_evento`, `descripcion`, `ip_address`, `user_agent`, `fecha`, `nivel`) VALUES
(229, 10, 'venta', 'Venta registrada - ID: 22, Total: S/ 86', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:22:46', 'info'),
(230, 10, 'venta', 'Venta registrada - ID: 23, Total: S/ 14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:22:57', 'info'),
(231, 10, 'venta', 'Venta registrada - ID: 24, Total: S/ 22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:23:04', 'info'),
(232, 10, 'venta', 'Venta registrada - ID: 25, Total: S/ 51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:28:59', 'info'),
(233, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:35:50', 'info'),
(234, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:41:27', 'info'),
(235, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:41:31', 'info'),
(236, 12, 'venta', 'Venta registrada - ID: 26, Total: S/ 36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:41:44', 'info'),
(237, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:45:33', 'info'),
(238, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:45:34', 'warning'),
(239, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:45:41', 'info'),
(240, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:45:45', 'info'),
(241, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:45:49', 'info'),
(242, 10, 'venta', 'Venta registrada - ID: 27, Total: S/ 40.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-04 22:48:49', 'info'),
(243, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:28:38', 'info'),
(244, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:28:45', 'info'),
(245, 12, 'venta', 'Venta registrada - ID: 28, Total: S/ 43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:28:58', 'info'),
(246, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:29:34', 'info'),
(247, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:29:40', 'info'),
(248, 9, 'venta', 'Venta registrada - ID: 29, Total: S/ 50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:31:29', 'info'),
(249, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:31:36', 'info'),
(250, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:31:42', 'info'),
(251, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:32:33', 'info'),
(252, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:32:37', 'info'),
(253, 12, 'usuario', 'Administración de usuarios - Crear usuario: PABLO - Rol: cliente', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:33:00', 'info'),
(254, 12, 'usuario', 'Administración de usuarios - Eliminar usuario: PP', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:33:11', 'info'),
(255, 12, 'venta', 'Venta registrada - ID: 30, Total: S/ 50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:34:28', 'info'),
(256, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:34:29', 'info'),
(257, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:34:35', 'info'),
(258, 9, 'venta', 'Venta registrada - ID: 31, Total: S/ 64', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:38:20', 'info'),
(259, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:38:23', 'info'),
(260, NULL, 'login', 'Intento de login fallido para usuario: ga', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:38:29', 'warning'),
(261, NULL, 'login', 'Intento de login fallido para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:38:32', 'warning'),
(262, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:38:36', 'info'),
(263, 12, 'venta', 'Venta registrada - ID: 32, Total: S/ 100', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:39:15', 'info'),
(264, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:39:39', 'info'),
(265, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:39:45', 'info'),
(266, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:43:37', 'info'),
(267, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:43:43', 'info'),
(268, 10, 'venta', 'Venta registrada - ID: 33, Total: S/ 170', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:44:08', 'info'),
(269, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:44:23', 'info'),
(270, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:44:25', 'warning'),
(271, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:44:32', 'info'),
(272, 12, 'venta', 'Venta registrada - ID: 34, Total: S/ 368', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:51:10', 'info'),
(273, 12, 'venta', 'Venta registrada - ID: 35, Total: S/ 39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 18:55:20', 'info'),
(274, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 19:00:42', 'info'),
(275, NULL, 'login', 'Intento de login fallido para usuario: admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 19:00:44', 'warning'),
(276, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:40:50', 'info'),
(277, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:41:01', 'info'),
(278, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:41:06', 'info'),
(279, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:41:13', 'info'),
(280, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:41:17', 'info'),
(281, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:41:41', 'info'),
(282, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:41:44', 'info'),
(283, 12, 'venta', 'Venta registrada - ID: 36, Total: S/ 25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:49:55', 'info'),
(284, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:51:44', 'info'),
(285, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:51:49', 'info'),
(286, 10, 'venta', 'Venta registrada - ID: 37, Total: S/ 26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:51:57', 'info'),
(287, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:52:32', 'info'),
(288, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:52:35', 'info'),
(289, 12, 'venta', 'Venta registrada - ID: 38, Total: S/ 43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:54:05', 'info'),
(290, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:56:08', 'info'),
(291, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:56:13', 'info'),
(292, 9, 'venta', 'Venta registrada - ID: 39, Total: S/ 3.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 21:56:24', 'info'),
(293, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 22:46:57', 'info'),
(294, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 22:47:05', 'info'),
(295, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 22:47:45', 'info'),
(296, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 22:47:49', 'info'),
(297, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:13:19', 'info'),
(298, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:13:25', 'info'),
(299, 9, 'venta', 'Venta registrada - ID: 40, Total: S/ 5.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:19:15', 'info'),
(300, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:19:37', 'info'),
(301, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:19:42', 'info'),
(302, 9, 'venta', 'Venta registrada - ID: 41, Total: S/ 7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:19:55', 'info'),
(303, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:20:10', 'info'),
(304, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:20:14', 'info'),
(305, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:20:32', 'info'),
(306, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:20:46', 'info'),
(307, 12, 'venta', 'Venta registrada - ID: 42, Total: S/ 3.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:22:31', 'info'),
(308, 12, 'venta', 'Venta registrada - ID: 43, Total: S/ 3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:26:48', 'info'),
(309, 12, 'venta', 'Venta registrada - ID: 44, Total: S/ 50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:27:58', 'info'),
(310, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:28:08', 'info'),
(311, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:28:11', 'info'),
(312, 9, 'venta', 'Venta registrada - ID: 45, Total: S/ 8.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:28:22', 'info'),
(313, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:28:32', 'info'),
(314, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:28:36', 'info'),
(315, 10, 'venta', 'Venta registrada - ID: 46, Total: S/ 24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:28:47', 'info'),
(316, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:29:06', 'info'),
(317, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:29:10', 'info'),
(318, 12, 'venta', 'Venta registrada - ID: 47, Total: S/ 18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:29:44', 'info'),
(319, 12, 'venta', 'Venta registrada - ID: 48, Total: S/ 14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:33:58', 'info'),
(320, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:47:47', 'info'),
(321, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:47:58', 'info'),
(322, 9, 'venta', 'Venta registrada - ID: 49, Total: S/ 10.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:48:14', 'info'),
(323, 9, 'venta', 'Venta registrada - ID: 50, Total: S/ 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:48:42', 'info'),
(324, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:48:48', 'info'),
(325, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:48:51', 'info'),
(326, 10, 'venta', 'Venta registrada - ID: 51, Total: S/ 10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:49:04', 'info'),
(327, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:49:18', 'info'),
(328, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:49:29', 'info'),
(329, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:49:31', 'info'),
(330, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:49:35', 'info'),
(331, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:55:40', 'info'),
(332, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:55:51', 'info'),
(333, 10, 'venta', 'Venta registrada - ID: 52, Total: S/ 12.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:55:58', 'info'),
(334, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:56:03', 'info'),
(335, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:56:06', 'info'),
(336, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:56:18', 'info'),
(337, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-07 23:56:24', 'info'),
(338, 9, 'venta', 'Venta registrada - ID: 53, Total: S/ 3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 00:01:13', 'info'),
(339, 9, 'venta', 'Venta registrada - ID: 54, Total: S/ 3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 00:01:54', 'info'),
(340, 9, 'venta', 'Venta registrada - ID: 55, Total: S/ 3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 00:05:28', 'info'),
(341, 9, 'venta', 'Venta registrada - ID: 56, Total: S/ 9', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 00:17:08', 'info'),
(342, 9, 'venta', 'Venta registrada - ID: 57, Total: S/ 12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 00:21:38', 'info'),
(343, 9, 'venta', 'Venta registrada - ID: 58, Total: S/ 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 00:21:55', 'info'),
(344, 9, 'venta', 'Venta registrada - ID: 59, Total: S/ 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 00:22:12', 'info'),
(345, 9, 'venta', 'Venta registrada - ID: 60, Total: S/ 5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:27:42', 'info'),
(346, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:28:07', 'info'),
(347, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:28:14', 'info'),
(348, 10, 'venta', 'Venta registrada - ID: 61, Total: S/ 17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:28:35', 'info'),
(349, 10, 'logout', 'Logout de usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:29:30', 'info'),
(350, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:29:36', 'info'),
(351, 9, 'venta', 'Venta registrada - ID: 62, Total: S/ 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:30:04', 'info'),
(352, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:32:02', 'info'),
(353, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:33:09', 'info'),
(354, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:33:45', 'info'),
(355, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:33:49', 'info'),
(356, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:33:56', 'info'),
(357, 16, 'login', 'Login exitoso para usuario: POOL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:38:07', 'info'),
(358, 16, 'venta', 'Venta registrada - ID: 63, Total: S/ 11.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:38:22', 'info'),
(359, 16, 'logout', 'Logout de usuario: NATANIEL PABLO PUMA QUICAÑO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:38:48', 'info'),
(360, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:38:52', 'info'),
(361, 12, 'venta', 'Venta registrada - ID: 64, Total: S/ 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:39:06', 'info'),
(362, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:39:16', 'info'),
(363, 16, 'login', 'Login exitoso para usuario: POOL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:39:22', 'info'),
(364, 16, 'logout', 'Logout de usuario: NATANIEL PABLO PUMA QUICAÑO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:39:31', 'info'),
(365, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:39:37', 'info'),
(366, 12, 'venta', 'Venta registrada - ID: 65, Total: S/ 7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:40:20', 'info'),
(367, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:41:14', 'info'),
(368, NULL, 'login', 'Login exitoso para usuario: CARLOS', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:42:01', 'info'),
(370, 17, 'login', 'Login exitoso para usuario: 72144172', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:50:24', 'info'),
(371, 17, 'logout', 'Logout de usuario: CARLO PILARES', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:51:58', 'info'),
(372, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:52:01', 'info'),
(373, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:52:30', 'info'),
(374, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:52:35', 'info'),
(375, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:52:46', 'info'),
(376, 10, 'login', 'Login exitoso para usuario: PAPA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 07:52:50', 'info'),
(377, 10, 'logout', 'Logout de usuario: PAPA NOEL PUMA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:01:33', 'info'),
(378, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:01:38', 'info'),
(379, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:01:45', 'info'),
(380, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:01:50', 'info'),
(381, 9, 'usuario', 'Administración de usuarios - Cambiar contraseña: Contraseña actualizada', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:02:04', 'info'),
(382, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:02:08', 'info'),
(383, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:02:12', 'info'),
(384, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:04:53', 'info'),
(385, 16, 'login', 'Login exitoso para usuario: POOL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:04:59', 'info'),
(386, 16, 'logout', 'Logout de usuario: NATANIEL PABLO PUMA QUICAÑO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:05:10', 'info'),
(387, 17, 'login', 'Login exitoso para usuario: 72144172', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:05:25', 'info'),
(388, 17, 'usuario', 'Administración de usuarios - Cambiar contraseña: Contraseña actualizada', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:05:45', 'info'),
(389, 17, 'usuario', 'Administración de usuarios - Actualizar perfil: Perfil actualizado', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:05:54', 'info'),
(390, 17, 'logout', 'Logout de usuario: CARLO PILARES', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:06:54', 'info'),
(391, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:06:58', 'info'),
(392, 12, 'venta', 'Venta registrada - ID: 66, Total: S/ 9', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:07:42', 'info'),
(393, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:07:49', 'info'),
(394, 19, 'login', 'Login exitoso para usuario: 87654321', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:07:56', 'info'),
(395, 19, 'usuario', 'Administración de usuarios - Actualizar perfil: Perfil actualizado', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:08:06', 'info'),
(396, 19, 'usuario', 'Administración de usuarios - Cambiar contraseña: Contraseña actualizada', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:08:27', 'info'),
(397, 19, 'logout', 'Logout de usuario: CARLOS PILARES CHAMO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:08:30', 'info'),
(398, 19, 'login', 'Login exitoso para usuario: CARLOS ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:08:34', 'info'),
(399, 19, 'logout', 'Logout de usuario: CARLOS PILARES CHAMO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:08:46', 'info'),
(400, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:09:09', 'info'),
(401, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:13:42', 'info'),
(402, 17, 'login', 'Login exitoso para usuario: CHAMO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:13:49', 'info'),
(403, 17, 'venta', 'Venta registrada - ID: 67, Total: S/ 11.5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:13:59', 'info'),
(404, 17, 'logout', 'Logout de usuario: CARLO PILARES', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:14:06', 'info'),
(405, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:14:10', 'info'),
(406, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:14:27', 'info'),
(407, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:24:56', 'info'),
(408, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:25:54', 'info'),
(409, 16, 'login', 'Login exitoso para usuario: POOL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:26:01', 'info'),
(410, 16, 'venta', 'Venta registrada - ID: 68, Total: S/ 35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:27:22', 'info'),
(411, 16, 'usuario', 'Administración de usuarios - Actualizar perfil: Perfil actualizado', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:28:00', 'info'),
(412, 16, 'usuario', 'Administración de usuarios - Cambiar contraseña: Contraseña actualizada', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:28:08', 'info'),
(413, 16, 'logout', 'Logout de usuario: NATANIEL PABLO PUMA QUICAÑO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:28:11', 'info'),
(414, NULL, 'login', 'Intento de login fallido para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:28:15', 'warning'),
(415, 9, 'login', 'Login exitoso para usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:28:22', 'info'),
(416, 9, 'logout', 'Logout de usuario: PEPE', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:30:57', 'info'),
(417, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:31:00', 'info'),
(418, 12, 'usuario', 'Administración de usuarios - Crear usuario: ANO - Rol: vendedor', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:32:28', 'info'),
(419, 12, 'usuario', 'Administración de usuarios - Eliminar usuario: ANO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:32:37', 'info'),
(420, 12, 'venta', 'Venta registrada - ID: 69, Total: S/ 20', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:33:10', 'info'),
(421, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:34:12', 'info'),
(422, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:34:29', 'info'),
(423, 12, 'usuario', 'Administración de usuarios - Desactivar usuario: ID: 17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:42:59', 'info'),
(424, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:43:24', 'info'),
(425, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:43:36', 'info'),
(426, 12, 'usuario', 'Administración de usuarios - Desactivar usuario: ID: 16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:43:45', 'info'),
(427, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:43:49', 'info'),
(428, NULL, 'login', 'Intento de login fallido para usuario: POOL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:43:56', 'warning'),
(429, NULL, 'login', 'Intento de login fallido para usuario: POOL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:44:02', 'warning'),
(430, 12, 'login', 'Login exitoso para usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:44:38', 'info'),
(431, 12, 'venta', 'Venta registrada - ID: 70, Total: S/ 15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:45:25', 'info'),
(432, 12, 'usuario', 'Administración de usuarios - Activar usuario: ID: 16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:45:36', 'info'),
(433, 12, 'logout', 'Logout de usuario: GA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:45:38', 'info'),
(434, 16, 'login', 'Login exitoso para usuario: POOL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:45:42', 'info'),
(435, 16, 'logout', 'Logout de usuario: NATANIEL PABLO PUMA QUICAÑO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', '2025-12-08 08:45:55', 'info');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `oferta` varchar(50) DEFAULT NULL,
  `cantidad` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria`, `oferta`, `cantidad`) VALUES
(1, 'Paracetamol 500mg', 'Analgésico y antipirético para dolor y fiebre.', 3.50, 'images/paracetamol.jpg', 'Analgésicos', 'No', 22),
(2, 'Ibuprofeno 400mg', 'Antiinflamatorio para dolor muscular y fiebre.', 5.00, 'images/ibuprofeno.jpg', 'Antiinflamatorios', 'Si', 15),
(3, 'Omeprazol 20mg', 'Protector gástrico para acidez estomacal.', 6.50, 'images/omeprazol.jpg', 'Gastrointestinal', 'No', 21),
(4, 'Amoxicilina 500mg', 'Antibiótico para infecciones comunes.', 12.00, 'images/amoxicilina.jpg', 'Antibióticos', 'No', 12),
(5, 'Loratadina 10mg', 'Antialérgico para rinitis y picazón.', 4.50, 'images/loratadina.jpg', 'Antialérgicos', 'Si', 46),
(6, 'Suero Oral 500ml', 'Solución hidratante para deshidratación.', 3.00, 'images/suero.jpg', 'Hidratantes', 'No', 56),
(7, 'Alcohol 70% 120ml', 'Desinfectante general.', 2.00, 'images/alcohol.jpg', 'Antisépticos', 'Si', 75),
(8, 'Agua Oxigenada 120ml', 'Antiséptico para heridas.', 2.50, 'images/agua_oxigenada.jpg', 'Antisépticos', 'No', 70),
(9, 'Diclofenaco Gel 1%', 'Gel antiinflamatorio tópico.', 7.50, 'images/diclofenaco_gel.jpg', 'Antiinflamatorios', 'No', 34),
(10, 'Vitamina C 1g', 'Refuerza el sistema inmunológico.', 6.00, 'images/vitamina_c.jpg', 'Vitaminas', 'Si', 55),
(11, 'Salbutamol Inhalador', 'Broncodilatador para crisis asmáticas.', 22.00, 'images/salbutamol.jpg', 'Respiratorio', 'No', 4),
(12, 'Acetaminofén Jarabe', 'Antifebril para niños.', 8.50, 'images/acetaminofen.jpg', 'Pediátricos', 'No', 2),
(13, 'Ketoconazol Shampoo', 'Antifúngico para caspa severa.', 15.00, 'images/ketoconazol.jpg', 'Dermatológicos', 'No', 15),
(14, 'Gasas Estériles x10', 'Insumos médicos para curaciones.', 4.00, 'images/gasas.jpg', 'Material de curación', 'No', 94),
(15, 'Termómetro Digital', 'Medidor de temperatura corporal.', 25.00, 'images/termometro.jpg', 'Equipos médicos', 'No', 0),
(16, 'Vendas Elásticas', 'Para soporte e inmovilización ligera.', 5.50, 'images/vendas.jpg', 'Material de curación', 'Si', 39),
(17, 'Clorfenamina 4mg', 'Antialérgico para resfriados.', 3.00, 'images/clorfenamina.jpg', 'Antialérgicos', 'No', 38),
(18, 'Pedialyte 500ml', 'Solución avanzada para hidratación.', 9.00, 'images/pedialyte.jpg', 'Hidratantes', 'No', 22),
(19, 'Azitromicina 500mg', 'Antibiótico de amplio espectro.', 18.00, 'images/azitromicina.jpg', 'Antibióticos', 'No', 1),
(20, 'Dicloxacilina 500mg', 'Antibiótico para infecciones de piel.', 14.00, 'images/dicloxacilina.jpg', 'Antibióticos', 'No', 3),
(39, 'PRUEBA 1', NULL, 50.00, 'images/default.jpg', 'Equipos Médicos', NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `promociones` varchar(10) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `rol` enum('cliente','vendedor','admin') DEFAULT 'cliente',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `dni`, `edad`, `usuario`, `clave`, `correo`, `genero`, `promociones`, `direccion`, `telefono`, `rol`, `activo`) VALUES
(6, 'Jesus Saldaña', '76586711', 22, 'Spectra', '$2y$10$4gcHUOkVUeZ.Z2rIQaO63uwnBXp7JUrJ7EGMSaH9SbvMiKvdwr.Ly', 'jesus2sald@gmail.com', 'Masculino', 'no', 'Orquídeas 160', '972466424', 'cliente', 1),
(7, 'Alessandra Salas', '71035754', 22, 'Jiyuu', '$2y$10$.XBUiDN38SGTBmTep0XtDerWC10n/Iby3nyqc8gC3QoK3dAobipoW', 'miraiinikii123@gmail.com', 'Femenino', 'no', 'Jr Miguel Grau 476', '953031029', 'cliente', 1),
(9, 'PEPE', NULL, NULL, 'PEPE', '$2y$10$En3HZVLxomxc7S5TUYuTW.tkWEnpTBYQld/pOsPbSwqy936u7JXAO', 'PEPE@GMAIL.COM', NULL, NULL, 'CALLE 1', '789456123', 'vendedor', 1),
(10, 'PAPA NOEL PUMA', '72144170', NULL, 'PAPA', '$2y$10$.JALiXBKHe.DAJHf5gBgXOKfLoDobfnFHjBJ8bkAXzWXpBhe9UL8y', 'PAPA@GMAIL.COM', NULL, NULL, '123456789', '123456789', 'cliente', 1),
(12, 'GA', NULL, NULL, 'GA', '$2y$10$Mn/tSFWYzS4V6P3VwDLdHOcDyOnLoDB.g2GP9uuGRE7sO4Dle7hhe', NULL, NULL, NULL, NULL, NULL, 'admin', 1),
(13, 'PABLO PUMA', NULL, NULL, 'PABLO', '$2y$10$uidAPSxWeyOyw9jNwVlgLeKaC1lECfcU3gWmQpR13/KjSgAkNus9G', NULL, NULL, NULL, NULL, NULL, 'cliente', 1),
(14, 'ga', '12345678', NULL, '12345678', '$2y$10$7d3d404Xj1EQD5NhjB/8meEK6AqOtgfUWk0eYDzMOUD9CXUEaoRZ.', NULL, NULL, NULL, '-', '-', 'cliente', 1),
(15, 'carlos alvarez', '72144173', NULL, '72144173', '$2y$10$MV5Vat.b2kYz6BrOwQfYiuhsNn4pL1jZ6ymR7NbmKB4k4plBzaI1K', NULL, NULL, NULL, 'calles/n', '935453527', 'cliente', 1),
(16, 'NATANIEL PABLO PUMA QUICAÑO', '72144171', NULL, 'POOL', '$2y$10$Zz3UfBWIADqoxNyn5RYNKukuclRLZrZFTAjM25Gwy20PUkUOuNN8e', 'A@GMAIL.COM', NULL, NULL, 'CALLE MQ', '935453526', 'cliente', 1),
(17, 'CARLO PILARES', '72144172', NULL, 'CHAMO', '$2y$10$v6Q/3wILTOQOyiKmK7888eAahLjkf4Ws6GMb4ZyOpza7oSanXqvCa', '', NULL, NULL, 'CALLE MAJES S/N', '9354593582', 'cliente', 0),
(19, 'CARLOS PILARES CHAMO', '87654321', NULL, 'CARLOS', '$2y$10$ZmGlcatuy/r6Ue3wgUf5FO9xprVnmxwHa3ypy1GRzGEHQBpojHzeG', '', NULL, NULL, 'GA', '789456123', 'cliente', 1),
(21, 'VALERIA', '78956324', NULL, '78956324', '$2y$10$JU5HOoG76oMxcoXYY8GCHuyUTK5cDsyeM/mSGAnf9WYXa8IYYMmma', NULL, NULL, NULL, 'C', 'C', 'cliente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `metodo_entrega` enum('tienda','delivery') DEFAULT 'tienda',
  `costo_delivery` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_usuario`, `id_vendedor`, `fecha`, `total`, `metodo_entrega`, `costo_delivery`) VALUES
(16, 12, NULL, '2025-11-30 19:05:44', 61.00, 'tienda', 0.00),
(17, 9, NULL, '2025-11-30 19:08:18', 57.00, 'tienda', 0.00),
(18, 10, NULL, '2025-11-30 19:09:15', 86.00, 'tienda', 0.00),
(19, 10, NULL, '2025-11-30 19:30:42', 92.00, 'tienda', 0.00),
(20, 10, NULL, '2025-11-30 19:31:04', 57.00, 'delivery', 0.00),
(21, 12, NULL, '2025-12-01 20:43:56', 66.00, 'tienda', 0.00),
(22, 10, NULL, '2025-12-04 22:22:46', 86.00, 'delivery', 8.00),
(23, 10, NULL, '2025-12-04 22:22:57', 14.00, 'tienda', 0.00),
(24, 10, NULL, '2025-12-04 22:23:04', 22.00, 'delivery', 8.00),
(25, 10, NULL, '2025-12-04 22:28:59', 51.00, 'delivery', 8.00),
(26, 12, NULL, '2025-12-04 22:41:44', 36.00, 'tienda', 0.00),
(27, 10, NULL, '2025-12-04 22:48:49', 40.50, 'delivery', 8.00),
(28, 12, NULL, '2025-12-07 18:28:58', 43.00, 'tienda', 0.00),
(29, 9, NULL, '2025-12-07 18:31:29', 50.00, 'tienda', 0.00),
(30, 12, NULL, '2025-12-07 18:34:28', 50.00, 'tienda', 0.00),
(31, 9, NULL, '2025-12-07 18:38:20', 64.00, 'tienda', 0.00),
(32, 12, NULL, '2025-12-07 18:39:15', 100.00, 'tienda', 0.00),
(33, 10, NULL, '2025-12-07 18:44:08', 170.00, 'delivery', 8.00),
(34, 12, NULL, '2025-12-07 18:51:10', 368.00, 'tienda', 0.00),
(35, 12, NULL, '2025-12-07 18:55:20', 39.00, 'tienda', 0.00),
(36, 12, NULL, '2025-12-07 21:49:55', 25.00, 'tienda', 0.00),
(37, 10, NULL, '2025-12-07 21:51:57', 26.00, 'delivery', 8.00),
(38, 12, NULL, '2025-12-07 21:54:05', 43.00, 'tienda', 0.00),
(39, 9, NULL, '2025-12-07 21:56:24', 3.50, 'tienda', 0.00),
(40, 9, NULL, '2025-12-07 23:19:15', 5.50, 'tienda', 0.00),
(41, 9, NULL, '2025-12-07 23:19:55', 7.00, 'tienda', 0.00),
(42, 12, NULL, '2025-12-07 23:22:31', 3.50, 'tienda', 0.00),
(43, 12, 12, '2025-12-07 23:26:48', 3.00, 'tienda', 0.00),
(44, 12, 12, '2025-12-07 23:27:58', 50.00, 'tienda', 0.00),
(45, 9, 9, '2025-12-07 23:28:22', 8.50, 'tienda', 0.00),
(46, 10, 10, '2025-12-07 23:28:47', 24.00, 'tienda', 0.00),
(47, 12, 12, '2025-12-07 23:29:44', 18.00, 'tienda', 0.00),
(48, 12, 12, '2025-12-07 23:33:58', 14.00, 'tienda', 0.00),
(49, 9, 9, '2025-12-07 23:48:14', 10.50, 'tienda', 0.00),
(50, 9, 9, '2025-12-07 23:48:42', 4.00, 'tienda', 0.00),
(51, 10, 10, '2025-12-07 23:49:04', 10.00, 'delivery', 8.00),
(52, 10, 10, '2025-12-07 23:55:58', 12.50, 'delivery', 8.00),
(53, 9, 9, '2025-12-08 00:01:13', 3.00, 'tienda', 0.00),
(54, 9, 9, '2025-12-08 00:01:54', 3.00, 'tienda', 0.00),
(55, 9, 9, '2025-12-08 00:05:28', 3.00, 'tienda', 0.00),
(56, 9, 9, '2025-12-08 00:17:08', 9.00, 'tienda', 0.00),
(57, 14, 9, '2025-12-08 00:21:38', 12.00, 'tienda', 0.00),
(58, 10, 9, '2025-12-08 00:21:55', 4.00, 'tienda', 0.00),
(59, 10, 9, '2025-12-08 00:22:12', 4.00, 'tienda', 0.00),
(60, 15, 9, '2025-12-08 07:27:42', 5.00, 'tienda', 0.00),
(61, 10, 10, '2025-12-08 07:28:35', 17.00, 'delivery', 8.00),
(62, 10, 9, '2025-12-08 07:30:04', 4.00, 'tienda', 0.00),
(63, 16, 16, '2025-12-08 07:38:22', 11.50, 'delivery', 8.00),
(64, 16, 12, '2025-12-08 07:39:06', 4.00, 'tienda', 0.00),
(65, 17, 12, '2025-12-08 07:40:20', 7.00, 'tienda', 0.00),
(66, 19, 12, '2025-12-08 08:07:42', 9.00, 'tienda', 0.00),
(67, 17, 17, '2025-12-08 08:13:59', 11.50, 'delivery', 8.00),
(68, 16, 16, '2025-12-08 08:27:22', 35.00, 'delivery', 8.00),
(69, 21, 12, '2025-12-08 08:33:10', 20.00, 'tienda', 0.00),
(70, 16, 12, '2025-12-08 08:45:25', 15.00, 'tienda', 0.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_usuario`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `historial_stock`
--
ALTER TABLE `historial_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `tipo_evento` (`tipo_evento`),
  ADD KEY `nivel` (`nivel`),
  ADD KEY `fecha` (`fecha`),
  ADD KEY `idx_logs_fecha_tipo` (`fecha`,`tipo_evento`),
  ADD KEY `idx_logs_usuario_fecha` (`id_usuario`,`fecha`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `historial_stock`
--
ALTER TABLE `historial_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `historial_stock`
--
ALTER TABLE `historial_stock`
  ADD CONSTRAINT `historial_stock_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
