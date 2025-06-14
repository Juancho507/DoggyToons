-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2025 a las 04:56:33
-- Versión del servidor: 9.2.0
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `doggytoons`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Clave` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`idAdmin`, `Nombre`, `Apellido`, `Correo`, `Clave`) VALUES
(1021670976, 'Danna', 'Molina', 'dannamolina@gmail.com', '202cb962ac59075b964b07152d234b70'),
(1032798548, 'Juan', 'Ortiz', 'juanortiz@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dueño`
--

CREATE TABLE `dueño` (
  `idDueño` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Contacto` int NOT NULL,
  `Foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `dueño`
--

INSERT INTO `dueño` (`idDueño`, `Nombre`, `Apellido`, `Correo`, `Clave`, `Contacto`, `Foto`) VALUES
(101, 'Fred', 'Picapiedra', 'fred@gmail.com', '134afc4870bdd96fc193fda6eaea831a', 310123456, NULL),
(102, 'Homero', 'Simpson', 'homero@gmail.com', 'f3974bfce209a246c56049d6e27e7dfa', 320555112, NULL),
(103, 'Shaggy', 'Rogers', 'shaggy@gmail.com', 'd66bcc0e7de711e49d3a5abd29a75e01', 315789012, NULL),
(104, 'Charlie', 'Brown', 'charlie@gmail.com', 'cbaca0a0a39298908a7f0013b04bdc2a', 300111223, NULL),
(105, 'Jon', 'Arbuckle', 'jon@gmail.com', 'ce1b0e5c1c3bcc99b430af1cd64084e5', 311222334, NULL),
(106, 'Ryder', 'PawPatrol', 'ryder@gmail.com', 'd19495f1c7858d2e4a1084d4df5b70c2', 301333445, NULL),
(107, 'Heidi', 'Prado', 'heidi@gmail.com', '640ee581f58db025b43db67239abf074', 302444556, NULL),
(108, 'Ben', 'Tennyson', 'ben@gmail.com', '9660186406ddac0445b9f9b09785ac29', 303555667, NULL),
(109, 'Johnny', 'Bravo', 'johnny@gmail.com', '87faf1c4acd45c9602d06fa1a62f5f7e', 304666778, NULL),
(110, 'Muriel', 'Bagge', 'muriel@gmail.com', 'd0719c27ad2bed26f853ac1c1af83d65', 305777889, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopaseo`
--

CREATE TABLE `estadopaseo` (
  `idEstadoPaseo` int NOT NULL,
  `Valor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `estadopaseo`
--

INSERT INTO `estadopaseo` (`idEstadoPaseo`, `Valor`) VALUES
(1, 'Pendiente'),
(2, 'En Curso'),
(3, 'Completado'),
(4, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int NOT NULL,
  `FechaEmision` datetime NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `ArchivoPDF` varchar(45) DEFAULT NULL,
  `CodigoQR` varchar(45) DEFAULT NULL,
  `Paseo_idPaseo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `FechaEmision`, `Total`, `ArchivoPDF`, `CodigoQR`, `Paseo_idPaseo`) VALUES
(1, '2025-06-12 10:00:00', 30000, NULL, NULL, 1),
(2, '2025-06-13 11:00:00', 24000, NULL, NULL, 3),
(3, '2025-06-13 17:00:00', 59000, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseador`
--

CREATE TABLE `paseador` (
  `idPaseador` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Contacto` int NOT NULL,
  `Activo` tinyint NOT NULL,
  `Informacion` varchar(300) NOT NULL,
  `Foto` varchar(45) DEFAULT NULL,
  `Admin_idAdmin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `paseador`
--

INSERT INTO `paseador` (`idPaseador`, `Nombre`, `Apellido`, `Correo`, `Clave`, `Contacto`, `Activo`, `Informacion`, `Foto`, `Admin_idAdmin`) VALUES
(1, 'Mickey', 'Mouse', 'mickey@toons.com', '4d467a49990fe697121629ab9237ea3e', 300123000, 1, 'Especialista en \"Viajes Perrunos\" a parques temáticos, explorando los rincones más divertidos. Ofrece sesiones de juego con los \"Juguetes Toon\" más resistentes y siempre tiene a mano \"Alimentos Mágicos\" para un snack post-aventura. Siempre con una sonrisa.', NULL, 1021670976),
(2, 'Bugs', 'Bunny', 'bugs@toons.com', 'dd3fe76c3f5fbced0623e596f9955c72', 300123001, 1, 'Experto en \"Expediciones Saltarinas\" por campos y senderos. Conoce los mejores escondites para buscar \"Juguetes Escondidos\" y premia el buen comportamiento con \"Alimentos Crujientes\" a base de zanahorias. Siempre listo para una nueva travesura.', NULL, 1032798548),
(3, 'Bob', 'Esponja', 'bob@toons.com', 'f2f1d285a435bd0694da8cf3d780b670', 300123002, 1, 'Activo y listo para \"Paseos Submarinos\" imaginarios por la ciudad, buscando charcos y fuentes. Lleva consigo los \"Juguetes Burbujeantes\" más divertidos y \"Alimentos Marinos\" nutritivos para una energía inagotable. Amante de la vida marina y los paseos tranquilos.', NULL, 1021670976),
(4, 'Popeye', 'Marino', 'popeye@toons.com', 'b1f236bdf823f5dd942b256c79d4604c', 300123003, 1, 'Fuerte y energético, organiza \"Rutas Oceánicas\" por senderos costeros y muelles. Sus \"Juguetes de Nudo\" son irrompibles y siempre carga con \"Alimentos de Espinaca\" para un impulso de vitalidad que mantiene a los perros siempre listos para la acción.', NULL, 1032798548),
(5, 'Candace', 'Flynn', 'candace@toons.com', 'ebf4b55472e49d376a5fdf9aeaeea495', 300123004, 1, 'Paseadora \"Conspiradora\", siempre en busca de la \"Gran Aventura del Día\" que sus hermanos no puedan esconder. Equipada con \"Juguetes Innovadores\" y \"Alimentos Sorpresa\" que aparecen de la nada. ¡Va a contarles a tus padres lo divertido que es el paseo!', NULL, 1021670976);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseo`
--

CREATE TABLE `paseo` (
  `idPaseo` int NOT NULL,
  `FechaInicio` datetime NOT NULL,
  `FechaFin` datetime NOT NULL,
  `Paseador_idPaseador` int NOT NULL,
  `EstadoPaseo_idEstadoPaseo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `paseo`
--

INSERT INTO `paseo` (`idPaseo`, `FechaInicio`, `FechaFin`, `Paseador_idPaseador`, `EstadoPaseo_idEstadoPaseo`) VALUES
(1, '2025-06-12 09:00:00', '2025-06-12 10:00:00', 1, 3),
(2, '2025-06-12 14:00:00', '2025-06-12 15:00:00', 2, 3),
(3, '2025-06-13 10:00:00', '2025-06-13 11:00:00', 3, 3),
(4, '2025-06-13 16:00:00', '2025-06-13 17:00:00', 4, 3),
(5, '2025-06-14 09:00:00', '2025-06-14 10:00:00', 5, 2),
(6, '2025-06-15 11:00:00', '2025-06-15 12:00:00', 1, 1),
(7, '2025-06-16 14:00:00', '2025-06-16 15:00:00', 2, 1),
(8, '2025-06-17 09:00:00', '2025-06-17 10:00:00', 3, 1),
(9, '2025-06-18 10:00:00', '2025-06-18 11:00:00', 4, 4),
(10, '2025-06-19 15:00:00', '2025-06-19 16:00:00', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseoperro`
--

CREATE TABLE `paseoperro` (
  `Paseo_idPaseo` int NOT NULL,
  `Perro_idPerro` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `paseoperro`
--

INSERT INTO `paseoperro` (`Paseo_idPaseo`, `Perro_idPerro`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 4),
(4, 5),
(4, 7),
(5, 8),
(5, 9),
(6, 10),
(7, 11),
(7, 12),
(8, 13),
(9, 14),
(9, 16),
(10, 19),
(10, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perro`
--

CREATE TABLE `perro` (
  `idPerro` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Foto` varchar(45) DEFAULT NULL,
  `Raza_idRaza` int NOT NULL,
  `Dueño_idDueño` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `perro`
--

INSERT INTO `perro` (`idPerro`, `Nombre`, `Foto`, `Raza_idRaza`, `Dueño_idDueño`) VALUES
(1, 'Dino', NULL, 6, 101),
(2, 'Astro', NULL, 6, 101),
(3, 'Bandit', NULL, 5, 101),
(4, 'Ayudante de Santa', NULL, 12, 102),
(5, 'Niebla', NULL, 13, 102),
(6, 'Pluto', NULL, 14, 102),
(7, 'Scooby', NULL, 6, 103),
(8, 'Scrappy-Doo', NULL, 1, 103),
(9, 'Dug', NULL, 9, 103),
(10, 'Snoopy', NULL, 4, 104),
(11, 'Spike', NULL, 5, 104),
(12, 'Milú', NULL, 7, 104),
(13, 'Odie', NULL, 16, 105),
(14, 'Pongo', NULL, 1, 105),
(15, 'Chase', NULL, 3, 106),
(16, 'Marshall', NULL, 1, 106),
(17, 'Dodger', NULL, 10, 107),
(18, 'Sparky', NULL, 11, 107),
(19, 'Bolt', NULL, 3, 108),
(20, 'Clifford', NULL, 15, 108),
(21, 'Droopy', NULL, 2, 109),
(22, 'Jake', NULL, 5, 109),
(23, 'Coraje', NULL, 4, 110),
(24, 'Ren', NULL, 8, 110);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `idRaza` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Tamaño_idTamaño` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`idRaza`, `Nombre`, `Tamaño_idTamaño`) VALUES
(1, 'Dálmata', 2),
(2, 'Basset Hound', 2),
(3, 'Pastor Alemán', 3),
(4, 'Beagle', 2),
(5, 'Bulldog', 2),
(6, 'Gran Danés', 4),
(7, 'Fox Terrier', 1),
(8, 'Chihuahua', 1),
(9, 'Golden Retriever', 3),
(10, 'Terrier', 2),
(11, 'Bull Terrier', 2),
(12, 'Galgo', 3),
(13, 'San Bernardo', 4),
(14, 'Bloodhound', 3),
(15, 'Vizsla', 3),
(16, 'Mestiza', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamaño`
--

CREATE TABLE `tamaño` (
  `idTamaño` int NOT NULL,
  `Tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tamaño`
--

INSERT INTO `tamaño` (`idTamaño`, `Tipo`) VALUES
(1, 'Pequeño'),
(2, 'Mediano'),
(3, 'Grande'),
(4, 'Gigante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE `tarifa` (
  `idTarifa` int NOT NULL,
  `PrecioHora` decimal(10,0) NOT NULL,
  `Paseador_idPaseador` int NOT NULL,
  `Tamaño_idTamaño` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`idTarifa`, `PrecioHora`, `Paseador_idPaseador`, `Tamaño_idTamaño`) VALUES
(1, 16000, 2, 1),
(2, 21000, 2, 2),
(3, 26000, 2, 3),
(4, 31000, 2, 4),
(5, 14000, 3, 1),
(6, 19000, 3, 2),
(7, 24000, 3, 3),
(8, 29000, 3, 4),
(9, 17000, 4, 1),
(10, 22000, 4, 2),
(11, 27000, 4, 3),
(12, 32000, 4, 4),
(13, 15500, 5, 1),
(14, 20500, 5, 2),
(15, 25500, 5, 3),
(16, 30500, 5, 4),
(17, 15000, 1, 1),
(18, 20000, 1, 2),
(19, 25000, 1, 3),
(20, 30000, 1, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indices de la tabla `dueño`
--
ALTER TABLE `dueño`
  ADD PRIMARY KEY (`idDueño`);

--
-- Indices de la tabla `estadopaseo`
--
ALTER TABLE `estadopaseo`
  ADD PRIMARY KEY (`idEstadoPaseo`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_Factura_Paseo1_idx` (`Paseo_idPaseo`);

--
-- Indices de la tabla `paseador`
--
ALTER TABLE `paseador`
  ADD PRIMARY KEY (`idPaseador`),
  ADD KEY `fk_Paseador_Admin1_idx` (`Admin_idAdmin`);

--
-- Indices de la tabla `paseo`
--
ALTER TABLE `paseo`
  ADD PRIMARY KEY (`idPaseo`),
  ADD KEY `fk_Paseo_Paseador1_idx` (`Paseador_idPaseador`),
  ADD KEY `fk_Paseo_EstadoPaseo1_idx` (`EstadoPaseo_idEstadoPaseo`);

--
-- Indices de la tabla `paseoperro`
--
ALTER TABLE `paseoperro`
  ADD PRIMARY KEY (`Paseo_idPaseo`,`Perro_idPerro`),
  ADD KEY `fk_Paseo_has_Perro_Perro1_idx` (`Perro_idPerro`),
  ADD KEY `fk_Paseo_has_Perro_Paseo1_idx` (`Paseo_idPaseo`);

--
-- Indices de la tabla `perro`
--
ALTER TABLE `perro`
  ADD PRIMARY KEY (`idPerro`),
  ADD KEY `fk_Perro_Raza1_idx` (`Raza_idRaza`),
  ADD KEY `fk_Perro_Dueño1_idx` (`Dueño_idDueño`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`idRaza`),
  ADD KEY `fk_Raza_Tamaño_idx` (`Tamaño_idTamaño`);

--
-- Indices de la tabla `tamaño`
--
ALTER TABLE `tamaño`
  ADD PRIMARY KEY (`idTamaño`);

--
-- Indices de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`idTarifa`),
  ADD KEY `fk_Tarifa_Paseador1_idx` (`Paseador_idPaseador`),
  ADD KEY `fk_Tarifa_Tamaño1_idx` (`Tamaño_idTamaño`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dueño`
--
ALTER TABLE `dueño`
  MODIFY `idDueño` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `estadopaseo`
--
ALTER TABLE `estadopaseo`
  MODIFY `idEstadoPaseo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paseador`
--
ALTER TABLE `paseador`
  MODIFY `idPaseador` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `paseo`
--
ALTER TABLE `paseo`
  MODIFY `idPaseo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `perro`
--
ALTER TABLE `perro`
  MODIFY `idPerro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `idRaza` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tamaño`
--
ALTER TABLE `tamaño`
  MODIFY `idTamaño` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `idTarifa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Factura_Paseo1` FOREIGN KEY (`Paseo_idPaseo`) REFERENCES `paseo` (`idPaseo`);

--
-- Filtros para la tabla `paseador`
--
ALTER TABLE `paseador`
  ADD CONSTRAINT `fk_Paseador_Admin1` FOREIGN KEY (`Admin_idAdmin`) REFERENCES `admin` (`idAdmin`);

--
-- Filtros para la tabla `paseo`
--
ALTER TABLE `paseo`
  ADD CONSTRAINT `fk_Paseo_EstadoPaseo1` FOREIGN KEY (`EstadoPaseo_idEstadoPaseo`) REFERENCES `estadopaseo` (`idEstadoPaseo`),
  ADD CONSTRAINT `fk_Paseo_Paseador1` FOREIGN KEY (`Paseador_idPaseador`) REFERENCES `paseador` (`idPaseador`);

--
-- Filtros para la tabla `paseoperro`
--
ALTER TABLE `paseoperro`
  ADD CONSTRAINT `fk_Paseo_has_Perro_Paseo1` FOREIGN KEY (`Paseo_idPaseo`) REFERENCES `paseo` (`idPaseo`),
  ADD CONSTRAINT `fk_Paseo_has_Perro_Perro1` FOREIGN KEY (`Perro_idPerro`) REFERENCES `perro` (`idPerro`);

--
-- Filtros para la tabla `perro`
--
ALTER TABLE `perro`
  ADD CONSTRAINT `fk_Perro_Dueño1` FOREIGN KEY (`Dueño_idDueño`) REFERENCES `dueño` (`idDueño`),
  ADD CONSTRAINT `fk_Perro_Raza1` FOREIGN KEY (`Raza_idRaza`) REFERENCES `raza` (`idRaza`);

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `fk_Raza_Tamaño` FOREIGN KEY (`Tamaño_idTamaño`) REFERENCES `tamaño` (`idTamaño`);

--
-- Filtros para la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD CONSTRAINT `fk_Tarifa_Paseador1` FOREIGN KEY (`Paseador_idPaseador`) REFERENCES `paseador` (`idPaseador`),
  ADD CONSTRAINT `fk_Tarifa_Tamaño1` FOREIGN KEY (`Tamaño_idTamaño`) REFERENCES `tamaño` (`idTamaño`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
