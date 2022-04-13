-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2022 a las 02:03:05
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

--DROP DATABASE inversio;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de datos: `inversio`
-- Estructura de tabla para la tabla `cliente`

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `uuario` varchar(25) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido_paterno` varchar(20) NOT NULL,
  `apellido_materno` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `telefono_celular` int(10) NOT NULL,
 -- `clabe` int(19) NOT NULL,
  `edad` int(2) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `identificacion_oficial` varchar(70) NOT NULL,
  `foto_perfil` varchar(70) NOT NULL,
  `autorizacion` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estructura de tabla para la tabla `cuenta_bancaria`

CREATE TABLE `cuenta_bancaria` (
  `id_numero_cuenta` int(10) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `clabe` varchar(19) NOT NULL,
  `id_numero_tarjeta_debito` int(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estructura de tabla para la tabla `egresos`

CREATE TABLE `egresos` (
  `id_egresos` int(5) NOT NULL,
  `id_numero_tarjeta_debito` int(19) NOT NULL,
  `concepto` varchar(20) NOT NULL,
  `monto` int(5) NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `cuenta_destino` int(19) NOT NULL,
  `saldo_inicial` int(5) NOT NULL,
  `saldo_final` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estructura de tabla para la tabla `estado_cuenta`

CREATE TABLE `estado_cuenta` (
  `id_estado_cuenta` int(10) NOT NULL,
  `id_numero_cuenta` int(10) NOT NULL,
  `mes` varchar(10) NOT NULL,
  `saldo_inicial` int(5) NOT NULL,
  `saldo_final` int(5) NOT NULL,
  `ingresos` int(5) NOT NULL,
  `egresos` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estructura de tabla para la tabla `ingresos`

CREATE TABLE `ingresos` (
  `id_ingresos` int(5) NOT NULL,
  `id_numero_tarjeta_debito` int(19) NOT NULL,
  `concepto` varchar(20) NOT NULL,
  `monto` int(5) NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `saldo_inicial` int(5) NOT NULL,
  `saldo_final` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estructura de tabla para la tabla `tarjeta_debito`

CREATE TABLE `tarjeta_debito` (
  `id_numero_tarjeta_debito` int(19) NOT NULL,
  `id_numero_cuenta` int(10) NOT NULL,
  `saldo` int(5) NOT NULL,
  `fecha_apertura` date NOT NULL,
  `fecha_expiracion` date NOT NULL,
  `cvv` int(4) NOT NULL,
  `nip` int(4) NOT NULL,
  `limite_movimientos` int(70) NOT NULL,
  `limite_retiros` int(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Indices de la tabla `cliente`
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

-- Indices de la tabla `cuenta_bancaria`
ALTER TABLE `cuenta_bancaria`
  ADD PRIMARY KEY (`id_numero_cuenta`),
  ADD KEY `id_numero_tarjeta_debito` (`id_numero_tarjeta_debito`),
  ADD KEY `id_cliente` (`id_cliente`);

-- Indices de la tabla `egresos`
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id_egresos`),
  ADD KEY `id_numero_tarjeta_debito` (`id_numero_tarjeta_debito`);

-- Indices de la tabla `estado_cuenta`
ALTER TABLE `estado_cuenta`
  ADD PRIMARY KEY (`id_estado_cuenta`),
  ADD KEY `id_numero_cuenta` (`id_numero_cuenta`);

-- Indices de la tabla `ingresos`
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id_ingresos`),
  ADD KEY `id_numero_tarjeta_debito` (`id_numero_tarjeta_debito`);

-- Indices de la tabla `tarjeta_debito`
ALTER TABLE `tarjeta_debito`
  ADD PRIMARY KEY (`id_numero_tarjeta_debito`),
  ADD KEY `id_numero_cuenta` (`id_numero_cuenta`);

-- AUTO_INCREMENT de las tablas volcadas

-- AUTO_INCREMENT de la tabla `cliente`
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT de la tabla `egresos`
ALTER TABLE `egresos`
  MODIFY `id_egresos` int(5) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT de la tabla `estado_cuenta`
ALTER TABLE `estado_cuenta`
  MODIFY `id_estado_cuenta` int(10) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT de la tabla `ingresos`
ALTER TABLE `ingresos`
  MODIFY `id_ingresos` int(5) NOT NULL AUTO_INCREMENT;

-- Restricciones para tablas volcadas

-- Filtros para la tabla `cuenta_bancaria`
ALTER TABLE `cuenta_bancaria`
  ADD CONSTRAINT `cuenta_bancaria_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cuenta_bancaria_ibfk_2` FOREIGN KEY (`id_numero_tarjeta_debito`) REFERENCES `tarjeta_debito` (`id_numero_tarjeta_debito`) ON UPDATE CASCADE;

-- Filtros para la tabla `egresos`
ALTER TABLE `egresos`
  ADD CONSTRAINT `egresos_ibfk_1` FOREIGN KEY (`id_numero_tarjeta_debito`) REFERENCES `tarjeta_debito` (`id_numero_tarjeta_debito`) ON UPDATE CASCADE;

-- Filtros para la tabla `estado_cuenta`
ALTER TABLE `estado_cuenta`
  ADD CONSTRAINT `estado_cuenta_ibfk_1` FOREIGN KEY (`id_numero_cuenta`) REFERENCES `cuenta_bancaria` (`id_numero_cuenta`) ON UPDATE CASCADE;

-- Filtros para la tabla `ingresos`
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`id_numero_tarjeta_debito`) REFERENCES `tarjeta_debito` (`id_numero_tarjeta_debito`) ON UPDATE CASCADE;

-- Filtros para la tabla `tarjeta_debito`
ALTER TABLE `tarjeta_debito`
  ADD CONSTRAINT `tarjeta_debito_ibfk_1` FOREIGN KEY (`id_numero_cuenta`) REFERENCES `cuenta_bancaria` (`id_numero_cuenta`) ON UPDATE CASCADE;
COMMIT;