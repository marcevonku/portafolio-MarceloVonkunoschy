-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-12-2025 a las 22:28:38
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
-- Base de datos: `calculator_scalping`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brokers`
--

CREATE TABLE `brokers` (
  `id` int(11) NOT NULL,
  `nombreBroker` varchar(255) NOT NULL,
  `comisionCompra` decimal(10,4) DEFAULT 0.0000 COMMENT 'Porcentaje de comisión',
  `derechoMercado` decimal(10,4) DEFAULT 0.0000 COMMENT 'Porcentaje de derecho de mercado',
  `ivaImpuesto` decimal(10,4) DEFAULT 0.0000 COMMENT 'Porcentaje de IVA',
  `activo` tinyint(1) DEFAULT 1 COMMENT '1 = Activo, 0 = Inactivo',
  `fec_registro` datetime DEFAULT current_timestamp(),
  `fec_modificado` datetime DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `brokers`
--

INSERT INTO `brokers` (`id`, `nombreBroker`, `comisionCompra`, `derechoMercado`, `ivaImpuesto`, `activo`, `fec_registro`, `fec_modificado`, `fec_baja`) VALUES
(1, 'Bull Market', 0.5000, 0.1000, 0.2100, 1, '2025-12-06 23:40:15', '2025-12-10 19:00:50', NULL),
(2, 'InvertirOnline', 0.4500, 0.0800, 0.2100, 1, '2025-12-06 23:40:15', '2025-12-10 19:01:23', NULL),
(3, 'Balanz Capital', 0.0500, 0.0080, 0.2100, 1, '2025-12-10 18:22:42', '2025-12-10 19:01:04', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `id` int(11) NOT NULL,
  `tasa_banco` decimal(15,6) DEFAULT NULL,
  `tn_365` decimal(10,6) DEFAULT NULL,
  `tn_260` decimal(10,6) DEFAULT NULL,
  `broker_id` int(11) NOT NULL,
  `nombre_accion` varchar(50) NOT NULL,
  `cantidad_acciones` int(11) NOT NULL,
  `valor_neto_compra` decimal(15,6) NOT NULL,
  `valor_comision_compra` decimal(15,6) NOT NULL,
  `derecho_mercado_compra` decimal(15,6) NOT NULL,
  `iva_compra` decimal(15,6) NOT NULL,
  `valor_bruto_compra` decimal(15,6) NOT NULL,
  `ganancia_neta_por_accion` decimal(15,6) NOT NULL,
  `precio_neto_venta` decimal(15,6) NOT NULL,
  `valor_comision_venta` decimal(15,6) NOT NULL,
  `derecho_mercado_venta` decimal(15,6) NOT NULL,
  `iva_venta` decimal(15,6) NOT NULL,
  `precio_bruto_venta` decimal(15,6) NOT NULL,
  `ganancia_neta_total` decimal(15,6) NOT NULL,
  `fecha_operacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_operacion_venta` date DEFAULT NULL,
  `vigente` tinyint(1) DEFAULT NULL,
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comision_porcentaje` decimal(10,5) DEFAULT 0.00000,
  `derecho_mercado_porcentaje` decimal(10,5) DEFAULT 0.00000,
  `iva_porcentaje` decimal(10,5) DEFAULT 0.00000,
  `ganancia_proyectada_porcentaje` decimal(10,5) DEFAULT 0.00000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`id`, `tasa_banco`, `tn_365`, `tn_260`, `broker_id`, `nombre_accion`, `cantidad_acciones`, `valor_neto_compra`, `valor_comision_compra`, `derecho_mercado_compra`, `iva_compra`, `valor_bruto_compra`, `ganancia_neta_por_accion`, `precio_neto_venta`, `valor_comision_venta`, `derecho_mercado_venta`, `iva_venta`, `precio_bruto_venta`, `ganancia_neta_total`, `fecha_operacion`, `fecha_operacion_venta`, `vigente`, `fecha_modificacion`, `comision_porcentaje`, `derecho_mercado_porcentaje`, `iva_porcentaje`, `ganancia_proyectada_porcentaje`) VALUES
(1, 0.000000, 0.000000, 0.000000, 3, 'aapl', 10, 100000.000000, 50.000000, 8.000000, 0.121800, 100058.121800, 29.016855, 100348.290353, 50.174145, 8.027863, 0.122224, 100406.614586, 2.901686, '2025-12-14 13:10:06', '2025-12-14', 1, '2025-12-14 13:10:06', 0.00000, 0.00000, 0.00000, 0.00000),
(2, 0.000000, 0.000000, 0.000000, 1, 'aapl', 10, 100000.000000, 500.000000, 100.000000, 1.260000, 100601.260000, 39.234491, 100993.604914, 504.968025, 100.993605, 1.272519, 101600.839063, 3.923449, '2025-12-14 13:10:47', '2025-12-14', 1, '2025-12-14 13:10:47', 0.00000, 0.00000, 0.00000, 0.00000),
(3, 0.000000, 0.000000, 0.000000, 1, 'aapl', 10, 100000.000000, 500.000000, 100.000000, 1.260000, 100601.260000, 39.234491, 100993.604914, 504.968025, 100.993605, 1.272519, 101600.839063, 3.923449, '2025-12-14 13:11:11', '2025-12-14', 1, '2025-12-14 13:11:11', 0.00000, 0.00000, 0.00000, 0.00000),
(4, 0.000000, 0.000000, 0.000000, 1, 'aapl', 10, 100000.000000, 500.000000, 100.000000, 1.260000, 100601.260000, 39.234491, 100993.604914, 504.968025, 100.993605, 1.272519, 101600.839063, 3.923449, '2025-12-14 13:11:11', '2025-12-14', 1, '2025-12-14 13:11:11', 0.00000, 0.00000, 0.00000, 0.00000),
(5, 45.000000, 0.123288, 0.173077, 3, 'aapl', 10, 100000.000000, 50.000000, 8.000000, 0.121800, 100058.121800, 36.020924, 100418.331038, 50.209166, 8.033466, 0.122310, 100476.695980, 3.602092, '2025-12-14 15:12:26', '2025-12-14', 1, '2025-12-14 15:12:26', 0.00000, 0.00000, 0.00000, 0.00000),
(6, 45.000000, 0.123288, 0.173077, 3, 'aapl', 10, 100000.000000, 50.000000, 8.000000, 0.121800, 100058.121800, 36.020924, 100418.331038, 50.209166, 8.033466, 0.122310, 100476.695980, 3.602092, '2025-12-14 15:12:56', '2025-12-14', 1, '2025-12-14 15:26:02', 0.00000, 0.00000, 0.00000, 0.00000),
(7, 33.000000, 0.090411, 0.126923, 2, 'hjki', 10, 100000.000000, 450.000000, 80.000000, 1.113000, 100531.113000, 45.239001, 100983.503009, 454.425764, 80.786802, 1.123946, 101519.839521, 4.523900, '2025-12-14 15:59:34', '2025-12-14', 1, '2025-12-14 15:59:34', 0.45000, 0.08000, 0.21000, 0.45000),
(8, 23.000000, 0.063014, 0.088462, 2, 'jkl', 10, 100000.000000, 450.000000, 80.000000, 1.113000, 100531.113000, 50.265557, 101033.768565, 454.651959, 80.827015, 1.124506, 101570.372044, 5.026556, '2025-12-14 16:08:06', '2025-12-14', 1, '2025-12-14 16:08:06', 0.45000, 0.08000, 0.21000, 0.50000),
(9, 23.000000, 0.063014, 0.088462, 2, 'jkl', 10, 100000.000000, 450.000000, 80.000000, 1.113000, 100531.113000, 50.265557, 101033.768565, 454.651959, 80.827015, 1.124506, 101570.372044, 5.026556, '2025-12-14 16:13:13', '2025-12-14', 1, '2025-12-14 16:13:13', 0.45000, 0.08000, 0.21000, 0.50000),
(10, 32.000000, 0.087671, 0.123077, 2, 'asd', 10, 100000.000000, 450.000000, 80.000000, 1.113000, 100531.113000, 50.265557, 101033.768565, 454.651959, 80.827015, 1.124506, 101570.372044, 5026.555650, '2025-12-14 16:14:19', '2025-12-14', 1, '2025-12-14 16:14:19', 0.45000, 0.08000, 0.21000, 0.50000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brokers`
--
ALTER TABLE `brokers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_operaciones_brokers` (`broker_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brokers`
--
ALTER TABLE `brokers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD CONSTRAINT `fk_operaciones_brokers` FOREIGN KEY (`broker_id`) REFERENCES `brokers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
