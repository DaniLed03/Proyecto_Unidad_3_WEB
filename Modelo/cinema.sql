-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2024 a las 09:10:02
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
-- Base de datos: `cinema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `edad`) VALUES
(1, 'DANIEL', 18),
(3, 'Arylu', 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `edad`) VALUES
(1, 'Daniel Ledezma', 20),
(3, 'Moringa', 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre`) VALUES
(1, 'Accion'),
(3, 'Terror'),
(8, 'Romance'),
(13, 'Anime');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id_pelicula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `id_genero` int(11) DEFAULT NULL,
  `fecha_inicio_cartelera` date DEFAULT NULL,
  `fecha_fin_cartelera` date DEFAULT NULL,
  `boletos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id_pelicula`, `nombre`, `sinopsis`, `id_genero`, `fecha_inicio_cartelera`, `fecha_fin_cartelera`, `boletos`) VALUES
(1, 'Iron Man', 'Super heroe', 1, '2024-04-13', '2024-04-25', 1),
(10, 'Joker', 'Guason', 1, '2024-04-20', '2024-04-20', 4),
(18, 'Dragon Ball Super: Super Hero', 'Gohan vs Androides', 13, '2024-04-16', '2024-04-18', 3),
(20, 'Oppenheimer', 'Bomba nuclear', 1, '2024-04-14', '2024-04-16', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `inventario` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `costo`, `inventario`, `descripcion`) VALUES
(1, 'Kranki', 45.00, 19, 'Hojuelas sabor chocolate'),
(2, 'Palomitas', 120.00, 90, 'Palomitas sabor mantequilla'),
(3, 'Takis', 45.00, 26, 'Takis Morados'),
(4, 'Coca', 45.00, 60, 'Coca Cola'),
(5, 'Chips', 45.00, 68, 'Chips Morados\r\n'),
(6, 'Chocolate', 45.00, 34, 'Carlos V'),
(7, 'Gatorade', 45.00, 21, 'Gatorade Mora Azul'),
(8, 'Nachos', 45.00, 100, 'Nachos con queso derretido'),
(9, 'Jugos', 45.00, 150, 'Jugos del Valle'),
(10, 'Pizzas', 45.00, 66, 'Pizza Hot');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `id_sala` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horario` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_pelicula`
--

CREATE TABLE `ticket_pelicula` (
  `id_ticket_pelicula` int(11) NOT NULL,
  `id_pelicula` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket_pelicula`
--

INSERT INTO `ticket_pelicula` (`id_ticket_pelicula`, `id_pelicula`, `cantidad`, `id_cliente`, `id_empleado`, `fecha`, `total`) VALUES
(1, 1, 2, 1, 1, '2024-04-14', 150.00),
(2, 1, 1, 1, 1, '2024-04-15', 75.00),
(3, 1, 1, 3, 3, '2024-04-17', 75.00),
(4, 10, 1, 1, 1, '2024-04-16', 75.00),
(5, 1, 1, 3, 1, '2024-04-15', 75.00),
(6, 18, 4, 3, 3, '2024-04-14', 300.00),
(7, 1, 2, 1, 1, '2024-04-14', 150.00),
(8, 18, 1, 3, 3, '2024-04-15', 75.00),
(9, 20, 2, 1, 1, '2024-04-15', 150.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_producto`
--

CREATE TABLE `ticket_producto` (
  `id_ticket_snack` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket_producto`
--

INSERT INTO `ticket_producto` (`id_ticket_snack`, `id_cliente`, `id_empleado`, `total`) VALUES
(1, 1, 3, 45.00),
(2, 1, 1, 120.00),
(3, 1, 1, 45.00),
(4, 3, 1, 45.00),
(5, 1, 3, 45.00),
(6, 3, 1, 45.00),
(7, 3, 1, 45.00),
(8, 1, 1, 45.00),
(9, 1, 1, 45.00),
(10, 1, 1, 45.00),
(11, 3, 1, 45.00),
(12, 3, 3, 45.00),
(13, 3, 1, 45.00),
(14, 3, 3, 45.00),
(15, 1, 1, 45.00),
(25, 3, 1, 90.00),
(26, 1, 1, 180.00),
(27, 1, 1, 20700.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_producto_producto`
--

CREATE TABLE `ticket_producto_producto` (
  `id_ticket_producto_producto` int(11) NOT NULL,
  `id_ticket_snack` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket_producto_producto`
--

INSERT INTO `ticket_producto_producto` (`id_ticket_producto_producto`, `id_ticket_snack`, `id_producto`, `cantidad`, `fecha`) VALUES
(1, 1, 1, 2, '2024-04-16'),
(2, 2, 5, 2, '2024-04-15'),
(3, 3, 7, 6, '2024-04-10'),
(4, 4, 9, 2, '2024-04-10'),
(5, 5, 10, 6, '2024-04-17'),
(6, 6, 3, 4, '2024-04-16'),
(7, 7, 6, 4, '2024-04-13'),
(8, 8, 4, 3, '2024-04-13'),
(9, 9, 1, 3, '2024-04-24'),
(10, 10, 10, 4, '2024-04-16'),
(11, 11, 8, 1, '2024-04-17'),
(12, 12, 6, 5, '2024-05-08'),
(13, 13, 10, 2, '2024-04-20'),
(14, 14, 8, 3, '2024-05-10'),
(15, 15, 9, 4, '2024-04-29'),
(25, 25, 1, 2, '2024-04-15'),
(26, 26, 1, 4, '2024-04-15'),
(27, 27, 1, 1, '2024-04-15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id_pelicula`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id_sala`);

--
-- Indices de la tabla `ticket_pelicula`
--
ALTER TABLE `ticket_pelicula`
  ADD PRIMARY KEY (`id_ticket_pelicula`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `ticket_producto`
--
ALTER TABLE `ticket_producto`
  ADD PRIMARY KEY (`id_ticket_snack`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `ticket_producto_producto`
--
ALTER TABLE `ticket_producto_producto`
  ADD PRIMARY KEY (`id_ticket_producto_producto`),
  ADD KEY `id_ticket_snack` (`id_ticket_snack`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ticket_pelicula`
--
ALTER TABLE `ticket_pelicula`
  MODIFY `id_ticket_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ticket_producto`
--
ALTER TABLE `ticket_producto`
  MODIFY `id_ticket_snack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `ticket_producto_producto`
--
ALTER TABLE `ticket_producto_producto`
  MODIFY `id_ticket_producto_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `pelicula_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`);

--
-- Filtros para la tabla `ticket_pelicula`
--
ALTER TABLE `ticket_pelicula`
  ADD CONSTRAINT `ticket_pelicula_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `pelicula` (`id_pelicula`),
  ADD CONSTRAINT `ticket_pelicula_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `ticket_pelicula_ibfk_3` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `ticket_producto`
--
ALTER TABLE `ticket_producto`
  ADD CONSTRAINT `ticket_producto_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `ticket_producto_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `ticket_producto_producto`
--
ALTER TABLE `ticket_producto_producto`
  ADD CONSTRAINT `ticket_producto_producto_ibfk_1` FOREIGN KEY (`id_ticket_snack`) REFERENCES `ticket_producto` (`id_ticket_snack`),
  ADD CONSTRAINT `ticket_producto_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
