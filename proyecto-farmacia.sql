-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2024 a las 22:52:13
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
-- Base de datos: `proyecto-farmacia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID` varchar(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Cliente` varchar(30) NOT NULL,
  `Sintoma` varchar(30) NOT NULL,
  `Medicamento` varchar(30) NOT NULL,
  `Cantidad` int(30) NOT NULL,
  `Precio` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID`, `Fecha`, `Cliente`, `Sintoma`, `Medicamento`, `Cantidad`, `Precio`) VALUES
('1', '2024-10-26', 'Francisco', 'Dolor de cabeza', 'Paracetamol', 21, 50),
('2', '2024-11-26', 'Isaac', 'Resfriado', 'Sudagrip', 15, 15),
('3', '2024-12-26', 'Juan', 'Dolor de estomago', 'Omeprazol', 30, 75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `id` int(11) NOT NULL,
  `sintoma` varchar(255) NOT NULL,
  `medicamento` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `ingreso` date DEFAULT NULL,
  `vencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`id`, `sintoma`, `medicamento`, `cantidad`, `precio`, `ingreso`, `vencimiento`) VALUES
(1, 'Dolor de cabeza', 'Paracetamol', 20, 50.00, '2024-10-26', '2024-11-26'),
(2, 'Dolor de estomago', 'Omeprazol', 30, 75.00, '2024-10-26', '2024-12-26'),
(3, 'Resfriado', 'Sudagrip', 15, 15.00, '2024-10-26', '2024-12-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usua` varchar(30) NOT NULL,
  `Contra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usua`, `Contra`) VALUES
('admin', 'admin'),
('Andrea', '9480'),
('Ceseus', '8941'),
('Josue Moises', '8881'),
('Juanira', '9652'),
('Larissa', '9526'),
('Lizzy', '8884'),
('Orlin', '9589'),
('Rocio', '8955'),
('Teresa', '9368');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usua`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1202;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
