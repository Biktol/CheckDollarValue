-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2024 a las 15:19:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `check_dollar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `CurrencyValueInBs` varchar(255) NOT NULL,
  `date` varchar(10) NOT NULL,
  `IdProvider` int(11) NOT NULL,
  `IdSearchExpression` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `CurrencyValueInBs`, `date`, `IdProvider`, `IdSearchExpression`, `timestamp`) VALUES
(7, '36,65610000', '13-08-2024', 1, 1, '2024-08-13 16:11:38'),
(8, '40,15859035', '13-08-2024', 1, 2, '2024-08-13 16:15:41'),
(9, '5,12457710', '13-08-2024', 1, 3, '2024-08-13 16:15:41'),
(10, '1,09303733', '13-08-2024', 1, 4, '2024-08-13 16:15:41'),
(11, '0,40286298', '13-08-2024', 1, 5, '2024-08-13 16:15:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
--

CREATE TABLE `provider` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Url` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`Id`, `Name`, `Url`) VALUES
(1, 'BCV', 'https://www.bcv.org.ve/'),
(2, 'Binance', 'https://www.coinbase.com/es-la/converter/busd/ves');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `search_expression`
--

CREATE TABLE `search_expression` (
  `Id` int(11) NOT NULL,
  `IdProvider` int(11) NOT NULL,
  `HtmlSearch` varchar(2000) NOT NULL,
  `Currency` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `search_expression`
--

INSERT INTO `search_expression` (`Id`, `IdProvider`, `HtmlSearch`, `Currency`) VALUES
(1, 1, '#dolar .recuadrotsmc .centrado strong', 'Dolar'),
(2, 1, '#euro .recuadrotsmc .centrado strong', 'Euro'),
(3, 1, '#yuan .recuadrotsmc .centrado strong', 'Yuan'),
(4, 1, '#lira .recuadrotsmc .centrado strong', 'Lira'),
(5, 1, '#rublo .recuadrotsmc .centrado strong', 'Rublo'),
(6, 2, 'input#target', 'Dolar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_idProviderx` (`IdProvider`),
  ADD KEY `idSearch_idx` (`IdSearchExpression`);

--
-- Indices de la tabla `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `search_expression`
--
ALTER TABLE `search_expression`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `id_idx` (`IdProvider`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `search_expression`
--
ALTER TABLE `search_expression`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `idProvider` FOREIGN KEY (`IdProvider`) REFERENCES `provider` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idSearch` FOREIGN KEY (`IdSearchExpression`) REFERENCES `search_expression` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `search_expression`
--
ALTER TABLE `search_expression`
  ADD CONSTRAINT `id` FOREIGN KEY (`IdProvider`) REFERENCES `provider` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
