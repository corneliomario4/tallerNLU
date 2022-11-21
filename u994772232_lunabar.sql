-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-11-2022 a las 16:11:10
-- Versión del servidor: 10.5.16-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u994772232_lunabar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'DESAYUNOS'),
(2, 'BEBIDAS'),
(3, 'SNACK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comandas`
--

CREATE TABLE `comandas` (
  `id_comanda` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `estatus` varchar(250) NOT NULL DEFAULT 'PENDING',
  `id_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comandas`
--

INSERT INTO `comandas` (`id_comanda`, `producto`, `cantidad`, `total`, `estatus`, `id_orden`) VALUES
(18, 16, 1, '70.00', 'PENDING', 571566),
(19, 9, 1, '80.00', 'PENDING', 571566),
(20, 2, 3, '210.00', 'PENDING', 653670),
(21, 10, 1, '80.00', 'PENDING', 549878);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id_orden` int(11) NOT NULL,
  `no_mesa` int(11) NOT NULL,
  `no_personas` int(11) NOT NULL DEFAULT 1,
  `total` decimal(7,2) DEFAULT NULL,
  `estatus` varchar(250) NOT NULL DEFAULT 'CREATED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id_orden`, `no_mesa`, `no_personas`, `total`, `estatus`) VALUES
(549878, 988, 2, '80.00', 'CREATED'),
(571566, 1, 2, '150.00', 'CREATED'),
(653670, 5, 8, '210.00', 'CREATED');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `precio` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `categoria`, `precio`) VALUES
(1, 'Huevos al gusto', 1, '50.00'),
(2, 'Chilaquiles', 1, '70.00'),
(3, 'Enchiladas', 1, '50.00'),
(4, 'Molletes', 1, '50.00'),
(5, 'Quesadillas', 1, '50.00'),
(6, 'Aguacate', 1, '40.00'),
(7, 'Luna Lunar', 2, '60.00'),
(8, 'Explosion de Orbita', 2, '100.00'),
(9, 'Piña colada', 2, '80.00'),
(10, 'La cremosa', 2, '80.00'),
(11, 'Mojito', 2, '65.00'),
(12, 'dakiri', 2, '70.00'),
(13, 'Alitas', 3, '200.00'),
(14, 'Boneles', 3, '200.00'),
(15, 'Sandwich', 3, '50.00'),
(16, 'Club Sandwich', 3, '70.00'),
(17, 'Papas a la francesa', 3, '50.00'),
(18, 'Papas Gajo', 3, '50.00'),
(19, 'Panini', 3, '70.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comandas`
--
ALTER TABLE `comandas`
  ADD PRIMARY KEY (`id_comanda`),
  ADD KEY `id_orden` (`id_orden`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id_orden`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria` (`categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comandas`
--
ALTER TABLE `comandas`
  MODIFY `id_comanda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comandas`
--
ALTER TABLE `comandas`
  ADD CONSTRAINT `comandas_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `ordenes` (`id_orden`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
