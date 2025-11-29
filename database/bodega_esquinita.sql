-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2025 a las 03:56:25
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
-- Base de datos: `bodega_esquinita`
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
(1, 'Paracetamol 500mg', 'Analgésico y antipirético para dolor y fiebre.', 3.50, 'images/paracetamol.jpg', 'Analgésicos', 'No', 30),
(2, 'Ibuprofeno 400mg', 'Antiinflamatorio para dolor muscular y fiebre.', 5.00, 'images/ibuprofeno.jpg', 'Antiinflamatorios', 'Si', 18),
(3, 'Omeprazol 20mg', 'Protector gástrico para acidez estomacal.', 6.50, 'images/omeprazol.jpg', 'Gastrointestinal', 'No', 20),
(4, 'Amoxicilina 500mg', 'Antibiótico para infecciones comunes.', 12.00, 'images/amoxicilina.jpg', 'Antibióticos', 'No', 15),
(5, 'Loratadina 10mg', 'Antialérgico para rinitis y picazón.', 4.50, 'images/loratadina.jpg', 'Antialérgicos', 'Si', 48),
(6, 'Suero Oral 500ml', 'Solución hidratante para deshidratación.', 3.00, 'images/suero.jpg', 'Hidratantes', 'No', 60),
(7, 'Alcohol 70% 120ml', 'Desinfectante general.', 2.00, 'images/alcohol.jpg', 'Antisépticos', 'Si', 80),
(8, 'Agua Oxigenada 120ml', 'Antiséptico para heridas.', 2.50, 'images/agua_oxigenada.jpg', 'Antisépticos', 'No', 70),
(9, 'Diclofenaco Gel 1%', 'Gel antiinflamatorio tópico.', 7.50, 'images/diclofenaco_gel.jpg', 'Antiinflamatorios', 'No', 35),
(10, 'Vitamina C 1g', 'Refuerza el sistema inmunológico.', 6.00, 'images/vitamina_c.jpg', 'Vitaminas', 'Si', 55),
(11, 'Salbutamol Inhalador', 'Broncodilatador para crisis asmáticas.', 22.00, 'images/salbutamol.jpg', 'Respiratorio', 'No', 9),
(12, 'Acetaminofén Jarabe', 'Antifebril para niños.', 8.50, 'images/acetaminofen.jpg', 'Pediátricos', 'No', 20),
(13, 'Ketoconazol Shampoo', 'Antifúngico para caspa severa.', 15.00, 'images/ketoconazol.jpg', 'Dermatológicos', 'No', 18),
(14, 'Gasas Estériles x10', 'Insumos médicos para curaciones.', 4.00, 'images/gasas.jpg', 'Material de curación', 'No', 100),
(15, 'Termómetro Digital', 'Medidor de temperatura corporal.', 25.00, 'images/termometro.jpg', 'Equipos médicos', 'No', 12),
(16, 'Vendas Elásticas', 'Para soporte e inmovilización ligera.', 5.50, 'images/vendas.jpg', 'Material de curación', 'Si', 40),
(17, 'Clorfenamina 4mg', 'Antialérgico para resfriados.', 3.00, 'images/clorfenamina.jpg', 'Antialérgicos', 'No', 45),
(18, 'Pedialyte 500ml', 'Solución avanzada para hidratación.', 9.00, 'images/pedialyte.jpg', 'Hidratantes', 'No', 25),
(19, 'Azitromicina 500mg', 'Antibiótico de amplio espectro.', 18.00, 'images/azitromicina.jpg', 'Antibióticos', 'No', 12),
(20, 'Dicloxacilina 500mg', 'Antibiótico para infecciones de piel.', 14.00, 'images/dicloxacilina.jpg', 'Antibióticos', 'No', 10);

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
  `rol` enum('cliente','vendedor','admin') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `dni`, `edad`, `usuario`, `clave`, `correo`, `genero`, `promociones`, `direccion`, `telefono`, `rol`) VALUES
(6, 'Jesus Saldaña', '76586711', 22, 'Spectra', '$2y$10$4gcHUOkVUeZ.Z2rIQaO63uwnBXp7JUrJ7EGMSaH9SbvMiKvdwr.Ly', 'jesus2sald@gmail.com', 'Masculino', 'no', 'Orquídeas 160', '972466424', 'cliente'),
(7, 'Alessandra Salas', '71035754', 22, 'Jiyuu', '$2y$10$.XBUiDN38SGTBmTep0XtDerWC10n/Iby3nyqc8gC3QoK3dAobipoW', 'miraiinikii123@gmail.com', 'Femenino', 'no', 'Jr Miguel Grau 476', '953031029', 'cliente'),
(9, 'PEPE', NULL, NULL, 'PEPE', '$2y$10$If47wHQQDVLzeuSyypyavOI6YEXrqUMkC267sYlrkfyWE0Or60.72', 'PEPE@GMAIL.COM', NULL, NULL, 'CALLE 1', '789456123', 'vendedor'),
(10, 'PAPA', NULL, NULL, 'PAPA', '$2y$10$.JALiXBKHe.DAJHf5gBgXOKfLoDobfnFHjBJ8bkAXzWXpBhe9UL8y', 'PAPA@GMAIL.COM', NULL, NULL, '123456789', '123456789', 'cliente'),
(11, 'PP', NULL, NULL, 'PP', '$2y$10$VWkT0b4aXVf6KHPHucZN9.F4SlHNDkYce.E9HrwUOtcI9gQ17MdB2', 'PP@GMAIL.COM', NULL, NULL, 'PP', 'PP', 'admin'),
(12, 'GA', NULL, NULL, 'GA', '$2y$10$Mn/tSFWYzS4V6P3VwDLdHOcDyOnLoDB.g2GP9uuGRE7sO4Dle7hhe', NULL, NULL, NULL, NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `historial_stock`
--
ALTER TABLE `historial_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
