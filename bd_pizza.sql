-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2022 a las 20:28:22
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `celular` varchar(11) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `nombre`, `apellido`, `celular`, `contraseña`) VALUES
(1, 'AdminRenato', 'Dio Renato', 'Soca', '977109379', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'AdminDenilson', 'Denilson', 'Vivanco', '936949245', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'AdminMayfer', 'Mayfer', 'Quispe', '978125654', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(4, 'AdminRoly', 'Roly', 'Ari', '978125654', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(5, 'AdminElias', 'Elias', 'Carmin', '936949245', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(7, '123', 'admin', '213', '977109379', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(100) NOT NULL,
  `usuario_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `usuario_id`, `pid`, `nombre`, `precio`, `cantidad`, `imagen`) VALUES
(17, 3, 10, 'pizza1', 21, 32, 'pizza-1.jpg'),
(40, 2, 12, 'pizza3', 32, 6, 'pizza-3.jpg'),
(41, 2, 11, 'pizza2', 32, 1, 'pizza-2.jpg'),
(42, 2, 15, 'producto6', 32, 1, 'pizza-6.jpg'),
(43, 2, 13, 'pizza4', 12, 1, 'pizza-4.jpg'),
(64, 1, 11, 'pizza2', 32, 1, 'pizza-2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(100) NOT NULL,
  `usuario_id` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `total_productos` varchar(1000) NOT NULL,
  `total_precios` int(100) NOT NULL,
  `fec_compra` date NOT NULL DEFAULT current_timestamp(),
  `estado_compra` varchar(20) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `usuario_id`, `nombre`, `celular`, `metodo`, `correo`, `direccion`, `total_productos`, `total_precios`, `fec_compra`, `estado_compra`) VALUES
(2, 1, 'renato', '987876347', 'rena@gmail.com', 'credit card', 'Huachipa Asoc. Hubert Lanssier, awe, aweasd, Lima, Lima, Lima, Perú - 15003', 'pizza2 (32 x 4) - pizza3 (32 x 5) - pizza4 (12 x 4) - ', 336, '2022-07-08', 'Cancelado'),
(3, 1, 'renato', '987876347', 'cash on delivery', 'rena@gmail.com', 'Huachipa Asoc. Hubert Lanssier, awe, aweasd, Lima, Lima, Lima, Perú - 15003', 'pizza2 (32 x 4) - pizza3 (32 x 5) - pizza4 (12 x 4) - ', 336, '2022-07-08', 'Pendiente'),
(4, 1, 'renato', '987876347', 'Tarjeta de Crédito', 'rena@gmail.com', 'Huachipa Asoc. Hubert Lanssier, awe, aweasd, Lima, Lima, Lima, Perú - 15003', 'pizza2 (32 x 4) - pizza3 (32 x 5) - pizza4 (12 x 4) - ', 336, '2022-07-09', 'pendiente'),
(5, 1, 'renato', '987876347', 'Tarjeta de Crédito', 'rena@gmail.com', 'Lima, Lima, Ate, Cajamarquilla, Asoc. Hubert Lanssier Mz E Lt 13', 'pizza3 (32 x 1) - pizza2 (32 x 4) - pizza1 (21 x 3) - producto7 (12 x 3) - ', 259, '2022-07-09', 'pendiente'),
(6, 1, 'renato', '987876347', 'Tarjeta de Crédito', 'rena@gmail.com', 'Lima, Lima, Lima, Cajamarquilla, Mz E Lt 8', 'pizza1 (21 x 1) - pizza2 (32 x 12) - pizza3 (32 x 4) - pizza4 (12 x 3) - ', 569, '2022-07-09', 'pendiente'),
(7, 1, 'renato', '987876347', 'Pago en Efectivo', 'rena@gmail.com', 'Lima, Lima, Lima, Cajamarquilla, Mz E Lt 8', 'producto6 (32 x 5) - producto7 (12 x 4) - ', 208, '2022-07-09', 'pendiente'),
(8, 1, 'renato', '987876347', 'Tarjeta de Crédito', 'rena@gmail.com', 'Lima, Lima, Lima, Cajamarquilla, Mz E Lt 8', 'pizza3 (32 x 1) - pizza2 (32 x 1) - pizza4 (12 x 1) - ', 76, '2022-07-09', 'Cancelado'),
(9, 1, 'renato soca', '987876347', 'Pago en Efectivo', 'rena@gmail.com', 'Lima, Lima, Lima, Cajamarquilla, Mz E Lt 8', 'pizza3 (32 x 3) - pizza2 (32 x 3) - pizza1 (21 x 1) - producto7 (12 x 1) - producto6 (32 x 1) - ', 257, '2022-07-10', 'pendiente'),
(10, 1, 'renato soca', '987876347', 'Pago en Efectivo', 'rena@gmail.com', 'Lima, Lima, Lima, Cajamarquilla, Mz E Lt 8', 'pizza1 (21 x 3) - ', 63, '2022-07-10', 'pendiente'),
(11, 1, 'renato soca', '987876347', 'Tarjeta de Crédito', 'rena@gmail.com', 'Lima, Lima, Lima, Cajamarquilla, Mz E Lt 8', 'pizza2 (32 x 1) - pizza1 (21 x 1) - pizza3 (32 x 1) - pizza4 (12 x 8) - ', 181, '2022-07-11', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` int(10) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`) VALUES
(10, 'Pizza Americana', 22, 'pizza-1.jpg'),
(11, 'Pizza Champiñon', 25, 'pizza-2.jpg'),
(12, 'Pizza Napolitana', 15, 'pizza-3.jpg'),
(13, 'Pizza Vegana', 18, 'pizza-4.jpg'),
(14, 'Pizza Hawaina', 21, 'pizza-5.jpg'),
(15, 'Pizza Mozarella', 27, 'pizza-6.jpg'),
(17, 'Pizza Red', 18, 'pizza7.webp'),
(18, 'Pizza Salchichon', 23, 'pizza8.webp'),
(19, 'Pizza Sistema', 18, 'pizza9.jpg'),
(20, 'Pizza Chedar', 19, 'pizza10.jpg'),
(21, 'Pizza vegy', 17, 'pizza11.jpg'),
(22, 'Pizza Paltes', 18, 'pizza12.jpg'),
(23, 'Pizza Hot-Peperony', 18, 'pizza13.jpg'),
(24, 'Pizza Jam', 17, 'pizza14.webp'),
(25, 'Pizza Lit', 15, 'pizza15.jpg'),
(26, 'Pizza Fruit', 19, 'pizza16.jpg'),
(27, 'Pizza Mega Peit', 17, 'pizza17.jpg'),
(28, 'Pizza yummy', 18, 'pizza18.jpg'),
(29, 'Pizza Sour', 25, 'pizza19.jpg'),
(30, 'Pizza VV', 24, 'pizza20.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(100) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `celular` varchar(11) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `correo`, `celular`, `contraseña`, `direccion`) VALUES
(1, 'renato', 'soca', 'rena@gmail.com', '987876347', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 'Lima, Lima, Lima, Cajamarquilla, Mz E Lt 8'),
(2, 'renato', 'ramirez', 'u18215194@gmail.com', '978125654', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(3, 'prueba3', '3333', '3333@gmail.com', '956862354', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(4, 'renato', 'ramirez', 'renato@gmail.com', '123456789', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`) USING HASH;

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
