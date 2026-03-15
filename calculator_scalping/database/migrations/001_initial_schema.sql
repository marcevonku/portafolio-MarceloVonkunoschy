-- Migración para crear la tabla 'brokers'
-- Basado en la estructura de App/Controllers/PrincipalController.php

CREATE TABLE IF NOT EXISTS `brokers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreBroker` VARCHAR(255) NOT NULL,
  `comisionCompra` DECIMAL(10,4) DEFAULT 0.0000 COMMENT 'Porcentaje de comisión',
  `derechoMercado` DECIMAL(10,4) DEFAULT 0.0000 COMMENT 'Porcentaje de derecho de mercado',
  `ivaImpuesto` DECIMAL(10,4) DEFAULT 0.0000 COMMENT 'Porcentaje de IVA',
  `activo` TINYINT(1) DEFAULT 1 COMMENT '1 = Activo, 0 = Inactivo',
  `fec_registro` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `fec_modificado` DATETIME DEFAULT NULL,
  `fec_baja` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de prueba iniciales para brokers
INSERT INTO `brokers` (`nombreBroker`, `comisionCompra`, `derechoMercado`, `ivaImpuesto`, `activo`) VALUES
('Bull Market', 0.5000, 0.1000, 21.0000, 1),
('InvertirOnline', 0.4500, 0.0800, 21.0000, 1);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `operaciones`
-- Agregada desde dump de phpMyAdmin

CREATE TABLE IF NOT EXISTS `operaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `fk_operaciones_brokers` (`broker_id`),
  CONSTRAINT `fk_operaciones_brokers` FOREIGN KEY (`broker_id`) REFERENCES `brokers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
